var canvasDemo = document.getElementById('canvasDemo');
var ctxDemo = canvasDemo.getContext('2d');
var tab_demo = document.getElementById('tab_demo');
//var tab_cover = document.getElementById('tab_cover');
var divDemo = document.getElementById('divDemo');
function resizeCanvasDemo() {
  var spectrumW = canvasDemo.clientWidth;
  var spectrumH = canvasDemo.clientHeight;
  canvasDemo.width = spectrumW;
  canvasDemo.height = spectrumH;
  ctxDemo = canvasDemo.getContext('2d');
}

function loadVisu(visu, playerData) {

  // console.log(111, playerData);

  //$player.stop();

  // reset
  /////////////////////////////////////////////////////////////////////////////
  function reset() {
    // changeBampColor(opt.playerColor);
    divDemo.innerHTML = '';
    divDemo.setAttribute('style','');
    canvasDemo.setAttribute('style', '');
    divDemo.className = '';
    canvasDemo.className = '';
    tab_demo.className = 'ui_layout';
    if (opt.adaptSize) { tab_demo.classList.add('bamp_canvas_fullscreen') };
    if (!opt.canvas) tab_demo.classList.add('bamp_canvas_hide');

    // stats.domElement.style.display = opt.stats ? 'block' : 'none';

    // destroy any previous visualization initialization
    if (typeof destroyFunction == 'function') destroyFunction();
    // remove any previous visualization listener
    if (typeof renderFunction == 'function') $player.off('visualization', renderFunction);

    resizeCanvasDemo();
    ctxDemo.webkitImageSmoothingEnabled =
    ctxDemo.oImageSmoothingEnabled =
    ctxDemo.mozImageSmoothingEnabled =
    ctxDemo.imageSmoothingEnabled = opt.pixelArt;
  }


  var opt = $extend({}, demoDefault, visu.options);

  if (opt.assets.length) {
    $loader( opt.assets , function() {
      if (window['THREE']) {
        if (!VERSIONS[visuFile]) {
          VERSIONS[visuFile] = {
            THREE: window.THREE,
            REVISION: window.THREE.REVISION
          }
        }

        //console.log('before check', window.THREE.REVISION);
        if (VERSIONS[visuFile].REVISION !== window.THREE.REVISION) {
          window.THREE = VERSIONS[visuFile].THREE;
        }
        //console.log('after check', window.THREE.REVISION);
      }

      startVisu(arguments);
    }, {amd: false})
  } else {
    startVisu([]);
  }

  function startVisu(assets) {
    var init;
    if (opt.adaptSize) { // re-init on window resize
      init = function() {
        setTimeout(function() {
          //resizeCanvasDemo();
          reset();
          render(assets);
        }, 0);
      }
      window.onresize = $io.fn.debounce(init, 300);
      init();
    } else {
      window.onresize = null;
      reset();
      render(assets);
    }
  }

  function render(assets) {

    // console.log(opt.fileType, $player.mod());
    if (opt.fileType === 'mod' && $player.mod() !== true) {
      //console.log('This visual preset only work with .mod files...');
      divDemo.className = 'bamp_visu-error _bold';
      divDemo.innerHTML = 'This visual preset work only with .mod files...';
      return;
    };

    var temp = visu.init.call({
       playerData: playerData
      ,div: divDemo
      ,canvas: canvasDemo
      ,ctx: ctxDemo
      ,width: divDemo.clientWidth
      ,height: divDemo.clientHeight
      ,title: currentInfos
      ,assets: assets
      ,frequencyBinCount: 256
    }, divDemo, canvasDemo, ctxDemo, 256);

    if (temp && typeof temp.render == 'function') {

      // var renderFun = opt.stats ? function(f, t, now) {stats.begin(); temp.render(f, t, now); stats.end();} : temp.render;
      var renderFun = temp.render;

      destroyFunction = temp.destroy;

      if (opt.fps < 60) {
        var now = 0;
        var delta = 0;
        var then = performance.now();//Date.now();
        var fps = 1000 / opt.fps;
        renderFunction = function(f, t, now) {
          //now = Date.now();
          delta = now - then;
          //console.log(delta);
          if (delta > fps) {
            then = now - (delta % fps); // Update time stuffs
            renderFun(f, t, now);
          }
        }
      } else {
        renderFunction = renderFun;
      }

      $player.on('visualization', renderFunction);
    }
  }

};