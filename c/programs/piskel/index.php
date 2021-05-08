<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Piskel</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>

<link rel="stylesheet" href="css/style.css">

<style>
  #div_cursor {
    width: 16px;
    height: 16px;
    position: absolute;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.5), inset 0 0 0 1px rgba(255,255,255,0.5);
    z-index: 9999999;
    pointer-events: none;
  }
</style>

<body class="_skin_base _ui_loading">
  <div class="ui_layout skin_scrollbar">
    <article  id="main-wrapper">
      <aside class="skin_base" id="cont_toolbox" style="width:105px;padding-right:5px;overflow:auto">
        <div id="tool-section">
    <div id="tools-container" class="tools-wrapper ui_combo">
      <!-- Drawing tools will be inserted here -->
    </div>
    <div class="palette-wrapper">
      <div
        class="tool-icon tool-color-picker"
        title="Primary - left mouse button"
        rel="tooltip"
        data-placement="right"
      >
        <input id="color-picker" class="color" type="text"/>
      </div>
      <div
        class="tool-icon tool-color-picker"
        title="Secondary - right mouse button"
        rel="tooltip"
        data-placement="right"
      >
        <input id="secondary-color-picker" class="secondary-color-picker color" type="text" />
      </div>
      <div
        class="swap-colors-icon"
        title="Swap colors (X)"
        rel="tooltip"
        data-placement="right"
      ></div>
    </div>

  <!-- Templates -->

  <!-- Drawing tool icon-button -->
  <script type="text/template" id="drawingTool-item-template">
    <button rel="tooltip" data-placement="{{tooltipposition}}" class="{{cssclass}}" data-tool-id="{{toolid}}" title="{{title}}"></button>
  </script>

  <!-- Drawing tool tooltip container -->
  <script type="text/template" id="drawingTool-tooltipContainer-template">
    <div class='tools-tooltip-container'>
      <div>{{helptext}} <span class='tools-tooltip-shortcut'>{{shortcut}}</span></div>
      {{descriptors}}
    </div>
  </script>

  <!-- Drawing tool tooltip line for modifier -->
  <script type="text/template" id="drawingTool-tooltipDescriptor-template">
    <div class='tools-tooltip-descriptor'>
      <span class='tools-tooltip-descriptor-button'>{{key}}</span>
      {{description}}
    </div>
  </script>

  <!-- Drawing tool tooltip line -->
  <script type="text/template" id="drawingTool-simpleTooltipDescriptor-template">
    <div class='tools-tooltip-descriptor'>
      {{description}}
    </div>
  </script>
</div>        <div class="cursor-coordinates"></div>
      </aside>
      <section>
        <div class="ui_layout">
          <section class="noscroll skin_inset mb1 mr1 _skin_dark" id="section_drawing">
            <div id="drawing-canvas-container" class="drawing-canvas-container canvas-container">
            </div>
          </section>
          <footer class="skin_base" id="cont_timeline" style="height:135px;padding-top:4px;padding-bottom:1px;">
            <div class="preview-list skin_inset _skin_light _mt5 _mb1" _style="margin-top:4px;" id="preview-list"></div>
          </footer>
        </div>

      </section>
      <aside class="skin_base" id="cont_rightpane" style="width:200px;">
        <div class="ui_layout" style="padding-left:5px;padding-right:4px">
          <header>
            <div id="animated-preview-container" class="preview-container">
  <div class="canvas-container-wrapper minimap-container  skin_inset mr1 mb1">
    <div id="animated-preview-canvas-container" class="canvas-container">
      <div class="canvas-background"></div>
    </div>
  </div>
  <div class="ui_form_combo mt1 mb1">
    <button title="Toggle onion skin (alt+O)"
         rel="tooltip"
         data-placement="bottom"
         class="piskel-icon-onion preview-toggle-onion-skin"></button>
    <input id="preview-fps" class="range-fps" type="number" min="0" max="24"/>
    <span class="display-fps ui_combo__small">FPS</span>
  </div>
</div>          </header>
          <section class="noscroll">
            <div class="ui_layout skin_inset toolbox-container layers-list-container">
  <header>
    <div class="skin_outset mr1 mb1 toolbox-title layers-title bold">Layers
      <div title="Toggle layer preview (alt+L)"
           rel="tooltip"
           data-placement="left"
           class="layers-toggle-preview piskel-icon-eye"></div>
    </div>
    <div class="layers-button-container ui_combo">
      <button data-action="add"
        class="skin_outset button layers-button piskel-icon-plus"
        title="Create a new layer" rel="tooltip" data-placement="top" ></button>

      <button data-action="up"
        class="skin_outset button layers-button piskel-icon-arrow-up-fat"
        title="Move layer up" rel="tooltip" data-placement="top" ></button>

      <button data-action="down"
        class="skin_outset button layers-button piskel-icon-arrow-down-fat"
        title="Move layer down" rel="tooltip" data-placement="top" ></button>

      <button data-action="edit"
        class="skin_outset button layers-button piskel-icon-pencil"
        title="Edit layer name" rel="tooltip" data-placement="top"></button>

      <button data-action="merge"
        class="skin_outset button layers-button piskel-icon-merge"
        title="Merge with layer below" rel="tooltip" data-placement="top" ></button>

      <button data-action="delete"
        class="skin_outset button layers-button piskel-icon-close"
        title="Delete selected layer" rel="tooltip" data-placement="left" ></button>

    </div>
  </header>
  <section class="mt1">
    <ul class="layers-list"></ul>
  </section>

  <script type="text/template" id="layer-item-template">
    <li class="layer-item {{isselected:current-layer-item}}" data-layer-index="{{layerindex}}">{{layername}}</li>
  </script>
</div>          </section>
          <section class="noscroll">
            <div class="ui_layout skin_inset mb1 mr1 toolbox-container palettes-list-container">
  <header>
    <div class="toolbox-title palettes-title bold">Palettes</div>
    <div class="palettes-list-actions ui_form_combo">
      <button
        class="skin_outset button palettes-list-button create-palette-button piskel-icon-plus" data-action="add"
        title="Create a new palette" rel="tooltip" data-placement="top" ></button>
      <select class="skin_outset skin_base button palettes-list-select"></select>
      <button
        class="skin_outset button palettes-list-button edit-palette-button  piskel-icon-pencil" data-action="edit"
        title="Manage this palette" rel="tooltip" data-placement="left"></button>
    </div>
  </header>
  <section class="mt1">
    <div class="palettes-list-colors"></div>
  </section>
  <script type="text/template" id="palette-color-template">
    <div class="palettes-list-color" data-color="{{color}}" data-color-index="{{index}}" title="{{color}}">
      <div data-color="{{color}}" style="background:{{color}}"></div>
    </div>
  </script>

  <script type="text/template" id="palettes-list-no-colors-partial">
    <div class="palettes-list-no-colors">
      No color in the selected palette ...
    </div>
  </script>

</div>


          </section>
        </div>
      </aside>
    </article>
  </div>

  <div id="div_cursor"></div>

  <div id="dialog-container-wrapper">
    <div id="dialog-container">
      <script type="text/html" id="templates/dialogs/create-palette.html"><div class="dialog-wrapper">
  <h3 class="dialog-head">
    <span class="dialog-title">Create palette</span>
    <span class="dialog-close">X</span>
  </h3>
  <div class="dialog-create-palette">
      <div class="create-palette-section form-section">
        <span class="create-palette-name-label">Name</span>
        <input type="text" class="textfield create-palette-name-input" name="palette-name" placeholder="palette name ..."/>
        <div class="create-palette-import-section">
          <button
            type="button"
            rel="tooltip" data-placement="right" title="Import palette from an existing Image or from a palette file"
            class="button  button-primary create-palette-import-button">Import from file</button>
          <button
            type="button"
            rel="tooltip" data-placement="right" title="Download the palette as a GPL file"
            class="button  button-primary create-palette-download-button">Download as file</button>
          <input style="display:none"
            class="create-palette-import-input"
            type="file" value="file" accept="*"/>
        </div>
      </div>
      <div class="colors-container">
        <ul class="colors-list"></ul>
        <div class="color-picker-container">
          <div class="color-picker-spectrum"></div>
          <div class="color-picker-slider">
            <span>H</span>
            <input type="range" data-model="hsv" data-dimension="h" value="0" min="0" max="359" tabindex="-1"/>
            <input type="text"  data-model="hsv" data-dimension="h" class="textfield" value="0" />
          </div>
          <div class="color-picker-slider">
            <span>S</span>
            <input type="range" data-model="hsv" data-dimension="s" value="0" min="0" max="100" tabindex="-1"/>
            <input type="text"  data-model="hsv" data-dimension="s" class="textfield" value="0" />
          </div>
          <div class="color-picker-slider">
            <span>V</span>
            <input type="range" data-model="hsv" data-dimension="v" value="0" min="0" max="100" tabindex="-1"/>
            <input type="text"  data-model="hsv" data-dimension="v" class="textfield" value="0" />
          </div>
          <br/>
          <div class="color-picker-slider">
            <span>R</span>
            <input type="range" data-model="rgb" data-dimension="r" value="0" min="0" max="255" tabindex="-1"/>
            <input type="text"  data-model="rgb" data-dimension="r" class="textfield" value="0" />
          </div>
          <div class="color-picker-slider">
            <span>G</span>
            <input type="range" data-model="rgb" data-dimension="g" value="0" min="0" max="255" tabindex="-1"/>
            <input type="text"  data-model="rgb" data-dimension="g" class="textfield" value="0" />
          </div>
          <div class="color-picker-slider">
            <span>B</span>
            <input type="range" data-model="rgb" data-dimension="b" value="0" min="0" max="255" tabindex="-1"/>
            <input type="text"  data-model="rgb" data-dimension="b" class="textfield" value="0" />
          </div>
          <div class="color-preview"></div>
        </div>
      </div>
      <div class="create-palette-actions">
        <button type="button" name="create-palette-cancel" data-action="cancel" class="button create-palette-cancel">Cancel</button>
        <button type="button" name="create-palette-delete" data-action="delete" class="button button-primary create-palette-delete">Delete</button>
        <!-- <button type="button" name="create-palette-clone" class="button button-primary create-palette-clone">Save as new</button> -->
        <button type="button" name="create-palette-submit" data-action="submit" class="button button-primary create-palette-submit">Save</button>
      </div>
  </div>

  <script type="text/template" id="create-palette-color-template">
    <li
      class="create-palette-color {{:selected}} {{:light-color}}"
      style="background:{{color}}"
      data-palette-index="{{index}}"
      data-palette-color="{{color}}">
      <div class="create-palette-remove-color">X</div>
    </li>
  </script>

</div></script>
      <script type="text/html" id="templates/dialogs/import-image.html"><div class="dialog-wrapper">
  <h3 class="dialog-head">
    Import Image
    <span class="dialog-close">X</span>
  </h3>
  <div class="dialog-import-body">
    <form action="" method="POST" name="import-image-form">
      <div class="import-section">
        <span class="dialog-section-title">Name :</span><span class="import-image-file-name"></span>
      </div>
      <div class="import-section">
        <span class="dialog-section-title" style="vertical-align:top">Info :</span>
        <div class="import-section-preview"></div>
      </div>
      <div class="import-section">
        <span class="dialog-section-title">Size :</span>
        <input type="text" class="textfield import-size-field" name="resize-width"/>x
        <input type="text" class="textfield import-size-field" name="resize-height"/>
      </div>
      <div class="import-section">
        <span class="import-section-title">Smooth resize :</span>
        <input type="checkbox" checked="checked" name="smooth-resize-checkbox" value="1"/>
      </div>
      <input type="submit" name="import-submit" class="button button-primary import-button" value="Import" />
    </form>
  </div>
</div></script>
      <script type="text/html" id="templates/dialogs/browse-local.html"><div class="dialog-wrapper">
  <h3 class="dialog-head">
    Browse Local Piskels
    <span class="dialog-close">X</span>
  </h3>
  <div style="padding:10px 20px; font-size:1.5em">
    <table class="local-piskel-list">
      <thead>
        <tr class="local-piskel-list-head">
          <td class="local-piskel-name">Name</td>
          <td class="local-piskel-save-date">Date</td>
          <td colspan=2>Actions</td>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <script type="text/template" id="local-storage-item-template">
    <tr class="local-piskel-item">
      <td class="local-piskel-name">{{name}}</td>
      <td class="local-piskel-save-date">{{date}}</td>
      <td><button type="button" data-action="load" data-name="{{name}}" class="button button-primary local-piskel-load-button">Load</button></td>
      <td><button type="button" data-action="delete" data-name="{{name}}" class="button local-piskel-delete-button">Delete</button></td>
    </tr>
  </script>
</div></script>
    </div>
  </div>

  <div id="cheatsheet-wrapper" style="display:none">
  <div class="cheatsheet-container">
    <div class="cheatsheet-section">
      <h3>Tool shortcuts</h3>
      <ul class="cheatsheet-tool-shortcuts"></ul>
    </div>
    <div class="cheatsheet-section">
      <h3>Misc shortcuts</h3>
      <ul class="cheatsheet-misc-shortcuts"></ul>
    </div>
    <div class="cheatsheet-section">
      <h3>Selection shortcuts</h3>
      <ul class="cheatsheet-selection-shortcuts"></ul>
    </div>
  </div>
</div>
<span class="cheatsheet-link">Keyboard shortcuts</a>
<script type="text/template" id="cheatsheet-shortcut-template">
  <li class="cheatsheet-shortcut">
    <div class="cheatsheet-icon {{shortcutIcon}}"></div>
    <span class="cheatsheet-key">{{shortcutKey}}</span>
    <span class="cheatsheet-description">{{shortcutDescription}}</span>
  </li>
</script>  <div style="display:none">
  <script type="text/template" id="progress-bar-template">
    <div class="progress-bar-container">
      <div class="progress-bar-name">{{name}}</div>
      <div class="progress-bar-item progress-bar"></div>
      <div class="progress-bar-item progress-bar-status">{{status}}%</div>
    </div>
  </script>
</div>
  <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/piskel.js"></script>


  <script>

  var divCursur = document.getElementById('div_cursor');
  var drawingZone = document.getElementById('drawing-canvas-container');
  var cursorHidden = true;
  function _drawCursor(x,y) {
    if (isCursorOnDrawingZone) {

      var coo = pskl.app.drawingController.getScreenCoordinates(x,y);
      var z = psklPos.zoom;
      var z2 = z/2;
      var size = Math.round(z);
      if (cursorHidden) divCursur.style.display = 'block', cursorHidden = false;
      //drawingZone.classList.add('nocursor');
      //drawingZone.style.cursor = 'none';
      divCursur.style.left = Math.round(coo.x - z2) + 'px';
      divCursur.style.top = Math.round(coo.y - z2) + 'px';
      divCursur.style.height = size + 'px';
      divCursur.style.width = size + 'px';
    } else {
      _hideCursor()
    }
  }
  function _hideCursor() {
    divCursur.style.display = 'none';
    cursorHidden = true;
  }

  var isCursorOnDrawingZone = false;
  drawingZone.addEventListener('mouseover', function() {
    isCursorOnDrawingZone = true;
  }, false);
  drawingZone.addEventListener('mouseout', function() {
    isCursorOnDrawingZone = false;
  }, false);

  var cont_toolbox = document.getElementById('cont_toolbox');
  var cont_rightpane = document.getElementById('cont_rightpane');
  var cont_timeline = document.getElementById('cont_timeline');

  pskl.app.init();

  function _createFramesFromImages(images) {
    var frames = images.map(function (image) {
      return pskl.utils.FrameUtils.createFromImage(image);
    });
    return frames;
  };
  function _createPiskelFromImages(images) {
    var frames = _createFramesFromImages(images);
    var layer = pskl.model.Layer.fromFrames('Layer 1', frames);
    var descriptor = new pskl.model.piskel.Descriptor('Imported piskel', '');
    var piskel = pskl.model.Piskel.fromLayers([layer], descriptor);

    pskl.app.piskelController.setPiskel(piskel);
    pskl.app.animationController.setFPS(Constants.DEFAULT.FPS);
  }
  function _openImage(urlO) {
    var url = window.URL.createObjectURL(urlO)
    var image = new Image();
    image.src = url;

    var gifLoader = new window.SuperGif({
      gif : image
    });

    gifLoader.load({
      success : function(){
        var images = gifLoader.getFrames().map(function (frame) {
          return pskl.utils.CanvasUtils.createFromImageData(frame.data);
        });
        _createPiskelFromImages(images);
      },
      error : function () {
        _createPiskelFromImages([image]);
      }
    });
  }

  function _exportAsGif(cb) {
    var fps = pskl.app.piskelController.getFPS();
    var colors = pskl.app.currentColorsService.getCurrentColors();
    var colorCount = colors.length;
    var preserveColors = colorCount < 256;

    var hasTransparency = false;
    if (colors.indexOf(Constants.TRANSPARENT_COLOR) > -1) {
      hasTransparency = true;
      // make sure the transparent color is not in the palette
      var GIF_transparent = '00ff00'; //tinycolor.random().toHex();
      while (colors.indexOf('#'+GIF_transparent) > -1) {GIF_transparent = tinycolor.random().toHex()};
    }

    var gif = new window.GIF({
       workers: 5
      ,quality: 1
      ,width: pskl.app.piskelController.getWidth()
      ,height: pskl.app.piskelController.getHeight()
      ,preserveColors : preserveColors
      ,transparent: hasTransparency ? parseInt(GIF_transparent, 16) : null
    });

    for (var i = 0; i < pskl.app.piskelController.getFrameCount(); i++) {
      var frame = pskl.app.piskelController.getFrameAt(i);
      var canvasRenderer = new pskl.rendering.CanvasRenderer(frame, 1);
      canvasRenderer.drawTransparentAs('#'+GIF_transparent);
      var canvas = canvasRenderer.render();
      gif.addFrame(canvas.getContext('2d'), {
        delay: 1000 / fps
      });
    }

    $.publish(Events.SHOW_PROGRESS, [{"name": 'Building animated GIF ...'}]);
    gif.on('progress', function(percentage) {
      $.publish(Events.UPDATE_PROGRESS, [{"progress": (percentage*100).toFixed(1)}]);
    });
    gif.on('finished', function(blob) {
      $.publish(Events.HIDE_PROGRESS);
      cb(blob);
    });
    gif.render();
  }

  function _openPiskel(blob) {
    pskl.utils.PiskelFileUtils.loadFromFile(blob, function (piskel, descriptor, fps) {
      pskl.app.piskelController.setPiskel(piskel);
      pskl.app.animationController.setFPS(fps);
    });
  }


  function $iframeInit() { 'use strict';
    return {
      readFile: function(val) {
        if (val.type === 'application/piskel+json') {
          _openPiskel(val);
        } else {
          _openImage(val);
        }
      },
      setValue: function(val) {
        var size = {
          height : Constants.DEFAULT.HEIGHT,
          width : Constants.DEFAULT.WIDTH
        };
        var descriptor = new pskl.model.piskel.Descriptor('New Piskel', '');
        var piskel = new pskl.model.Piskel(size.width, size.height, descriptor);
        var layer = new pskl.model.Layer("Layer 1");
        var frame = new pskl.model.Frame(size.width, size.height);
        layer.addFrame(frame);
        piskel.addLayer(layer);
        pskl.app.piskelController.setPiskel(piskel);
      },
      getValue: function(cb, type) {
        if (type === "image/gif") {
          _exportAsGif(function(blob) {
            cb(blob);
          })
        } else if (type === "application/piskel+json") {
          cb(pskl.app.piskelController.serialize());
        } else {
          pskl.app.getFramesheetAsBlob(function(blob) {
            cb(blob);
          }, type);
        }
      },
      beforeSaveAs: function(doSaveAS) {
        var html = document.createElement('div');
        var btn1 = document.createElement('button');
        var btn2 = document.createElement('button');
        var btn3 = document.createElement('button');
        btn1.textContent = 'Piskel file (.piskel)';
        btn2.textContent = 'Spritesheet (.png)';
        btn3.textContent = 'Animated GIF (.gif)';
        btn1.addEventListener('click', function() {
          doSaveAS("application/piskel+json");
          winInst.close();
        }, false);
        btn2.addEventListener('click', function() {
          doSaveAS("image/png", 'Blob');
          winInst.close();
        }, false);
        btn3.addEventListener('click', function() {
          doSaveAS("image/gif", 'Blob');
          winInst.close();
        }, false);
        html.appendChild(btn1);
        html.appendChild(btn2);
        html.appendChild(btn3);
        var winInst
        setTimeout(function () {
          winInst = window.parent.$window({
            animationIn: '',
            animationOut: '',
            center: true,
            title: 'Save As...',
            model: 'simple',
            bodyClass: 'ui_button_list',
            height: 'auto',
            html: html,
            onclose: function(ok, val) {
              console.log(arguments);
            }
          });
        }, 0)
      }
    }
  }

  </script>
</body>
</html>