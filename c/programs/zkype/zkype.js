
!function() { 'use strict';

  // when everything is ready, automatically start everything ?

  var vid = document.getElementById('videoel');
  var overlay = document.getElementById('overlay');
  var ctx = overlay.getContext('2d');
  var contactsDiv = document.getElementById('contacts');

  /*********** Setup of video/webcam and checking for webGL support *********/

  var videoReady = false;
  var imagesReady = false;
  var currentMask = 0;

  function enablestart() {
    if (videoReady && imagesReady) {
      var r = $io.arr.random(document.querySelectorAll('.select_user'))
      r.click()
      /*var startbutton = document.getElementById('startbutton');
      startbutton.value = "start";
      startbutton.disabled = null;*/
    }
  }

  // create canvases for all the faces
  var imageCanvases = {};

  var faceImages = {};
  var masks;
  function displayContacts(obj) {
    //var frag = document.createDocumentFragment();
    //console.log(obj);
    masks = obj;
    $io.obj.each(obj, function(val, key) {
      var div = document.createElement('div');
      div.className = 'select_user';
      div.textContent = key.split('.')[0];
      var img = new Image();
      img.onload = function() {
        // copy the images to canvases
        var imagecanvas = document.createElement('CANVAS');
        imagecanvas.width = img.width;
        imagecanvas.height = img.height;
        imagecanvas.getContext('2d').drawImage(img,0,0);
        imageCanvases[key] = imagecanvas;
        document.body.appendChild(img)
      }
      img.src = '/c/programs/zkype/contacts/internet/' + key;
      //frag.appendChild(contact);
      div.onclick = function() {
        $el.each('.select_user.active', function () {
          this.classList.remove('active');
        })
        this.classList.add('active');
        setTimeout(function () {
          if (!started) startVideo();
          currentMask = key; //parseInt(this.dataset.id, 10);
          updateMask();
        }, 0)
      }
      contactsDiv.appendChild(div);
    });
    imagesReady = true;
  }

  var contacts;
  $ajax.get('/c/programs/zkype/contacts.json').done(function(arg) {
    //console.log(arg);
    contacts = arg;
    displayContacts(contacts.internet);
  });

  // check whether browser supports webGL
  var webGLContext;
  var webGLTestCanvas = document.createElement('canvas');
  if (window.WebGLRenderingContext) {
    webGLContext = webGLTestCanvas.getContext('webgl') || webGLTestCanvas.getContext('experimental-webgl');
    if (!webGLContext || !webGLContext.getExtension('OES_texture_float')) {
      webGLContext = null;
    }
  }
  if (webGLContext == null) {
    alert("Your browser does not seem to support WebGL. Unfortunately this face mask example depends on WebGL, so you'll have to try it in another browser. :(");
  }

  window.URL = window.URL || window.webkitURL || window.msURL || window.mozURL;

  ;(function() {

    var promisifiedOldGUM = function(constraints, successCallback, errorCallback) {

      // First get ahold of getUserMedia, if present
      var getUserMedia = (navigator.getUserMedia ||
          navigator.webkitGetUserMedia ||
          navigator.mozGetUserMedia ||
          navigator.msGetUserMedia);

      // Some browsers just don't implement it - return a rejected promise with an error
      // to keep a consistent interface
      if (!getUserMedia) {
        return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
      }

      // Otherwise, wrap the call to the old navigator.getUserMedia with a Promise
      return new Promise(function(successCallback, errorCallback) {
        getUserMedia.call(navigator, constraints, successCallback, errorCallback);
      });

    }

    // Older browsers might not implement mediaDevices at all, so we set an empty object first
    if (navigator.mediaDevices === undefined) {
      navigator.mediaDevices = {};
    }

    // Some browsers partially implement mediaDevices. We can't just assign an object
    // with getUserMedia as it would overwrite existing properties.
    // Here, we will just add the getUserMedia property if it's missing.
    if (navigator.mediaDevices.getUserMedia === undefined) {
      navigator.mediaDevices.getUserMedia = promisifiedOldGUM;
    }

  })();

  var zkypeStream;
  navigator.mediaDevices.getUserMedia({ video: true, audio: false }).then(function(stream) {
    zkypeStream = stream;
    if (vid.mozCaptureStream) {
      vid.mozSrcObject = stream;
    } else {

      if (navigator.vendor=="Google Inc.") {
        // chrome fix
        vid.srcObject=stream;
      }else{
        vid.src = (window.URL && window.URL.createObjectURL(stream)) || stream;
      }
      //
      
    }
    vid.play();
  }, function(error) {
    console.log(error)
    $alert("There was some problem trying to fetch video from your webcam.<br>" +
      'Try using zkype with HTTPS : <a href="https://www.windows93.net/#!zkype">https://www.windows93.net/#!zkype</a>');
  });

  vid.addEventListener('canplay', function() {videoReady = true; enablestart();}, false);

  /*********** Code for face substitution *********/

  var animationRequest;
  var positions;

  window.zkype = {
    vid: vid,
    getAnimation: function() {
      return animationRequest;
    },
    getAnimationGrid: function() {
      return animGrid;
    },
    getStream: function() {
      return zkypeStream;
    },
    getCtrack: function() {
      return ctrack;
    }
  }

  var ctrack = new clm.tracker();
  ctrack.init(pModel);

  //document.getElementById('selectmask').addEventListener('change', updateMask, false);

  function updateMask(el) {
    //currentMask = parseInt(el.target.value, 10);
    var positions = ctrack.getCurrentPosition(vid);
    if (positions) {
      switchMasks(positions);
    }
  }

  var started = false;
  function startVideo() {
    started = true;
    // start video
    vid.play();
    // start tracking
    ctrack.start(vid);
    // start drawing face grid
    drawGridLoop();
  }

  var fd = new faceDeformer();
  fd.init(document.getElementById('webgl'));
  var wc1 = document.getElementById('webgl').getContext('webgl') || document.getElementById('webgl').getContext('experimental-webgl')
  if (wc1) wc1.clearColor(0,0,0,0);

  var fd2 = new faceDeformer();
  fd2.init(document.getElementById('webgl2'));
  var wc2 = document.getElementById('webgl2').getContext('webgl') || document.getElementById('webgl2').getContext('experimental-webgl')
  if (wc2) wc2.clearColor(0,0,0,0);

  // canvas for copying the warped face to
  var newcanvas = document.createElement('CANVAS');
  newcanvas.width = vid.width;
  newcanvas.height = vid.height;
  // canvas for copying videoframes to
  var videocanvas = document.createElement('CANVAS');
  videocanvas.width = vid.width;
  videocanvas.height = vid.height;
  // canvas for masking
  var maskcanvas = document.createElement('CANVAS');
  maskcanvas.width = vid.width;
  maskcanvas.height = vid.height;

  var extended_vertices = [
    [0,71,72,0],
    [0,72,1,0],
    [1,72,73,1],
    [1,73,2,1],
    [2,73,74,2],
    [2,74,3,2],
    [3,74,75,3],
    [3,75,4,3],
    [4,75,76,4],
    [4,76,5,4],
    [5,76,77,5],
    [5,77,6,5],
    [6,77,78,6],
    [6,78,7,6],
    [7,78,79,7],
    [7,79,8,7],
    [8,79,80,8],
    [8,80,9,8],
    [9,80,81,9],
    [9,81,10,9],
    [10,81,82,10],
    [10,82,11,10],
    [11,82,83,11],
    [11,83,12,11],
    [12,83,84,12],
    [12,84,13,12],
    [13,84,85,13],
    [13,85,14,13],
    [14,85,86,14],
    [14,86,15,14],
    [15,86,87,15],
    [15,87,16,15],
    [16,87,88,16],
    [16,88,17,16],
    [17,88,89,17],
    [17,89,18,17],
    [18,89,90,18],
    [18,90,22,18],
    [22,90,21,22],
    [21,90,91,21],
    [21,20,91,21],
    [20,91,92,20],
    [20,92,19,20],
    [19,92,93,19],
    [19,93,71,19],
    [19,0,71,19],
    [44,61,56,44],
    [60,61,56,60],
    [60,56,57,60],
    [60,59,57,60],
    [58,59,57,58],
    [58,59,50,58]
  ];

  var animGrid;
  function drawGridLoop() {
    // get position of face
    positions = ctrack.getCurrentPosition(vid);

    //ctx.clearRect(0, 0, 500, 375);
    ctx.clearRect(0, 0, 500, 375);
    if (positions) {
      // draw current grid
      ctrack.draw(overlay);
    }
    // check whether mask has converged
    var pn = ctrack.getConvergence();
    if (pn < 0.4) {
      switchMasks(positions);
    } else {
      animGrid = requestAnimationFrame(drawGridLoop);
    }
  }

  function switchMasks(pos) {
    videocanvas.getContext('2d').drawImage(vid,0,0,videocanvas.width,videocanvas.height);

    // we need to extend the positions with new estimated points in order to get pixels immediately outside mask
    var newMaskPos = masks[currentMask].slice(0);
    var newFacePos = pos.slice(0);
    var extInd = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,22,21,20,19];
    var newp;
    for (var i = 0;i < 23;i++) {
      newp = [];
      newp[0] = (newMaskPos[extInd[i]][0]*1.3) - (newMaskPos[62][0]*0.3);// short for ((newMaskPos[extInd[i]][0]-newMaskPos[62][0])*1.1)+newMaskPos[62][0]
      newp[1] = (newMaskPos[extInd[i]][1]*1.3) - (newMaskPos[62][1]*0.3);
      newMaskPos.push(newp);
      newp = [];
      newp[0] = (newFacePos[extInd[i]][0]*1.3) - (newFacePos[62][0]*0.3);
      newp[1] = (newFacePos[extInd[i]][1]*1.3) - (newFacePos[62][1]*0.3);
      newFacePos.push(newp);
    }
    // also need to make new vertices incorporating area outside mask
    var newVertices = pModel.path.vertices.concat(extended_vertices);

    // deform the mask we want to use to face form
    //console.log(imageCanvases, imageCanvases[currentMask], currentMask, currentMask);
    fd2.load(imageCanvases[currentMask], newMaskPos, pModel, newVertices);
    fd2.draw(newFacePos);
    // and copy onto new canvas
    newcanvas.getContext('2d').drawImage(document.getElementById('webgl2'),0,0);

    // create masking
    var tempcoords = positions.slice(0,18);
    tempcoords.push(positions[21]);
    tempcoords.push(positions[20]);
    tempcoords.push(positions[19]);
    createMasking(maskcanvas, tempcoords);

    /*
    document.body.appendChild(newcanvas);
    document.body.appendChild(videocanvas);
    document.body.appendChild(maskcanvas);
    */

    // do poisson blending
    Poisson.load(newcanvas, videocanvas, maskcanvas, function() {
      var result = Poisson.blend(100, 0, 0);
      // render to canvas
      newcanvas.getContext('2d').putImageData(result, 0, 0);
      // get mask

      //var maskname = Object.keys(masks)[currentMask];
      fd.load(newcanvas, pos, pModel);
      requestAnimationFrame(drawMaskLoop);
    });
  }

  function drawMaskLoop() {
    // get position of face
    positions = ctrack.getCurrentPosition();

    /*for (var i = 0;i < positions.length;i++) {
      positions[i][1] += 1;
    }*/

    ctx.clearRect(0, 0, 500, 375);
    if (positions) {
      // draw mask on top of face
      fd.draw(positions);
    }
    //console.log(1);
    animationRequest = requestAnimationFrame(drawMaskLoop);
  }

  function createMasking(canvas, modelpoints) {
    // fill canvas with black
    var cc = canvas.getContext('2d');
    cc.fillStyle="#000000";
    cc.fillRect(0,0,canvas.width, canvas.height);
    cc.beginPath();
    cc.moveTo(modelpoints[0][0], modelpoints[0][1]);
    for (var i = 1;i < modelpoints.length;i++) {
      cc.lineTo(modelpoints[i][0], modelpoints[i][1]);
    }
    cc.lineTo(modelpoints[0][0], modelpoints[0][1]);
    cc.closePath();
    cc.fillStyle="#ffffff";
    cc.fill();
  }
}();