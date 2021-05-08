<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>pukeData</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
<style>
  #svg, #svg svg, textarea {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
  }
  textarea {
    resize: none;
    font-family: _tomo, monospace;
    line-height: 1.5;
    width: 100%;
    height: 100%;
  }
  #svg svg {
    font-family: _tomo, monospace;
  }
</style>
<body class="noscroll">
  <div class="ui_layout">
    <article>
    <section class="ui_unselectable cursor_pointer" title="Randomize patch"><div id="svg"></div></section>
    <aside style="width:200px"><textarea spellcheck="false" name="" id="patch" cols="20" rows="5"></textarea></aside>

    </article>
  </div>

  <script src="js/webpd-latest.min.js"></script>
  <script src="js/pd-fileutils-latest.js"></script>
  <script src="js/randomDrone.js"></script>

  <script src="/c/sys42.js?v=2.4.2"></script>

<script>

var svg_EL = document.getElementById('svg');
var patch_EL = document.getElementById('patch');

var current
patch_EL.onkeydown = function(arg) {
  current = this.value;
}
patch_EL.onkeyup = _.debounce(function(arg) {
  if (current !== this.value) loadPatch(this.value)
}, 100);

svg_EL.onclick = function() {
  randomPatch()
}

function displayPatchCode(patchPd) {
  patch_EL.value = patchPd
}

var webpdPatch;
function playPatch(patch, generated) {
  if (webpdPatch) Pd.destroyPatch(webpdPatch);

  // Rendering and updating the page
  var patchSvg = pdfu.renderSvg(patch, {svgFile: false})
  var patchPd = pdfu.renderPd(patch)
  webpdPatch = Pd.loadPatch(patchPd)
  // Adding to DOM
  svg_EL.innerHTML = patchSvg;
  if (generated) displayPatchCode(patchPd);

  Pd.start();
}

function randomPatch() {
  getRandomPatch(playPatch);
}


function loadPatch(pd, generated) {
  try {
    var patch = pdfu.parse(pd)
    playPatch(patch, generated)
  } catch(e) {
    webpdPatch = null;
    parent.$alert('<strong>Unsupported Pure Data Elements</strong>\n(' + e.message + ')');
    if (generated) displayPatchCode(pd);
  }
  //var patchSvg = pdfu.renderSvg(patch, {svgFile: false});
  //console.log(patch);
}
//loadPatch('#N canvas 778 17 450 300 10;\n#X obj 14 13 loadbang;\n#X obj 14 34 print bla;\n#X connect 0 0 1 0;');

</script>

<script>

function $iframeInit() { 'use strict';
  if (this.menu.key) {
    $key(this.menu.key.fn, $extend({}, this.menu.key.opt));
    this.menu.key.destroy;
  }
  return  {
    readFile: function(val) {
      //console.log(1);
      //console.log(val);
      loadPatch(val, true)
    },
    setValue: function(val) {
      //console.log(2);
      //console.log(val);
      if (!val) {
        randomPatch()
      } else {
        loadPatch(val);
      }
    },
    getValue: function(cb) {
      cb(patch_EL.value);
    },
    undo: function(cb) {

    },
    redo: function(cb) {

    }
  }
}
</script>
</body>
</html>