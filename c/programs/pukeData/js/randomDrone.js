var width = window.innerWidth, height = window.innerHeight
  , patch, patchSvg, patchPd, webpdPatch
  // Function to generate the args of sound oscillators
  , genOscArgs = function() { return [Math.round(getRandomInt(1, 15) / 10 * 440)] }
  // Function to generate the args of modulators
  , modOscArgs = function() { return [Math.round(Math.random() * 10 * 10) / 10] }
  , emptyArgs = function() { return [] }
  , modAmount = 40, fmModAmount = 20
  , genList = [ ['osc~', 50, genOscArgs], ['phasor~', 20, genOscArgs], ['noise~', 10, emptyArgs], ['*~', 60, emptyArgs], ['+~', 50, emptyArgs] ]
  , modList = [ ['osc~', 10, modOscArgs], ['*~', 10, emptyArgs]]

// =============== Patch generation =============== //
// Generates a random Pd graph that makes sound
var randomSoundGen = function() {
  return randomTree(genList, 5, function(node) {
    // Each time a node is created, we pick randomly whether we modulate it or not.
    if (Math.random() * 100 > (100 - modAmount)) {
      var mod = null
      while(mod === null) mod = randomTree(modList, 3)
      // Freq modulation if `node` is an oscillator
      if (_.contains(['osc~', 'phasor~'], node.proto) && Math.random() * 100 > (100 - fmModAmount)) {
        var freq = node.args[0]
          , mult = {proto: '*~', args: [Math.round(Math.random() * 100)]}
          , add = {proto: '+~', args: [freq]}
        patch.addNode(mult)
        patch.addNode(add)
        patch.connections.push({source: {id: mod.id, port: 0}, sink: {id: mult.id, port: 0}})
        patch.connections.push({source: {id: mult.id, port: 0}, sink: {id: add.id, port: 0}})
        patch.connections.push({source: {id: add.id, port: 0}, sink: {id: node.id, port: 0}})
        return node
      // Amplitude modulation otherwise
      } else {
        var mult = {proto: '*~', args: []}
        patch.addNode(mult)
        patch.connections.push({source: {id: node.id, port: 0}, sink: {id: mult.id, port: 0}})
        patch.connections.push({source: {id: mod.id, port: 0}, sink: {id: mult.id, port: 1}})
        return mult
      }
    } else return node
  })
}

// Generic function for generating a random tree of Pd objects.
var randomTree = function(objList, maxDepth, nodeCb, curDepth) {
  curDepth = (curDepth === undefined) ? -1 : curDepth
  curDepth++

  // If max depth is reached, we return null, the parent will take care of picking a leaf
  if (curDepth >= maxDepth) {
    curDepth--
    return null
  }

  var proto, node, randVal, i, cum
    // For picking a leaf, when the tree is too big
    , getLeaf = function(parent) {
      var leaf = {proto: 'sig~'}
      if (_.contains(['+~', '-~'], parent.proto)) leaf.args = [0]
      else leaf.args = [1]
      patch.addNode(leaf)
      return leaf
    }

  // Pick a random proto
  randVal = Math.random() * _.reduce(objList, function(memo, obj) { return memo + obj[1] }, 0)
  i = 0
  cum = 0
  while(true) {
    cum += objList[i][1]
    if (cum >= randVal) break
    i++
  }
  proto = objList[i][0]
  node = {proto: proto, args: objList[i][2]()}

  // If it is a dsp arithmetic, we call the function recursively
  // to get 2 subtrees that we'll connect together.
  if (isArithm(node)) {
    var subtree1 = randomTree(objList, maxDepth, nodeCb, curDepth)
      , subtree2 = randomTree(objList, maxDepth, nodeCb, curDepth)

    // If both subtrees are null, we simply discard the node
    if (subtree1 === null && subtree2 === null) {
      curDepth--
      return null
    } else {
      patch.addNode(node)
      if (subtree1 === null) subtree1 = getLeaf(node)
      if (subtree2 === null) subtree2 = getLeaf(node)
      patch.connections.push({source: {id: subtree1.id, port: 0}, sink: {id: node.id, port: 0}})
      patch.connections.push({source: {id: subtree2.id, port: 0}, sink: {id: node.id, port: 1}})
      // If addition, we normalize the volume
      if (node.proto === '+~') {
        var norm = {proto: '*~', args: [0.5]}
        patch.addNode(norm)
        patch.connections.push({source: {id: node.id, port: 0}, sink: {id: norm.id, port: 0}})
        node = norm
      }
    }
  } else patch.addNode(node)

  curDepth--
  if (nodeCb) node = nodeCb(node)
  return node
}

// Function for generating our random patch, and updating the page
var getRandomPatch = function(cb) {
  //if (webpdPatch) stopSound()
  //Pd.stop()
  patch = new pdfu.Patch({nodes: [], connections: []})

  var dac = {proto: 'dac~', args: []}
    , treeLayout = d3.layout.tree()
    , root

  // We don't want too simple patches
  while(patch.nodes.length <= 2) {
    patch = new pdfu.Patch({nodes: [], connections: []})
    root = randomSoundGen()
  }

  // Connect the root of the tree with [dac~]
  patch.addNode(dac)
  patch.connections.push({source: {id: root.id, port: 0}, sink: {id: dac.id, port: 0}})
  patch.connections.push({source: {id: root.id, port: 0}, sink: {id: dac.id, port: 1}})

  // Create the tree layout
  treeLayout.children(function(node) {
    var sources = patch.getSources(node)
    return sources.length ? sources : null
  })
  treeLayout.nodes(dac)
  _.each(patch.nodes, function(node) {
    node.layout = {}
    node.layout.x = Math.round(node.x * width / 2)
    node.layout.y = Math.round(2 * height / 3 - node.y * height / 2)
    delete node.parent ; delete node.children
  })




  //$('#pd textarea').val(patchPd)

  cb(patch, true);
  //$('#svg svg').css({ top: $(window).height() - $('#svg svg').height() - 20 })
}

// Returns a random integer between `min` and `max`
var getRandomInt = function(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min
}

// Returns true if the node is a dsp arithmetic operation
var isArithm = function(node) {
  return _.contains(['+~', '-~', '*~', '/~'], node.proto)
}

