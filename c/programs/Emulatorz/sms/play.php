<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Miracle - a JavaScript Sega Master System emulator</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
  <body class="app_emulator">

    <canvas id="origin" style="min-width:256px" width="256" height="192"></canvas><!--
    <canvas id="display" width="512" height="384"></canvas> -->

    <script src="/c/sys42.js?v=2.4.2"></script>

    <script type="text/javascript" src="z80/z80_full.js"></script>
    <script type="text/javascript" src="z80/z80_ops_full.js"></script>
    <script type="text/javascript" src="z80/z80_dis.js"></script>
    <script type="text/javascript" src="vdp.js"></script>
    <script type="text/javascript" src="soundchip.js"></script>
    <script type="text/javascript" src="play.js"></script>

    <script>
      var running;
      var tstates = 0;

      !function(global) { 'use strict';
        // https://developer.mozilla.org/en-US/docs/Web/Guide/API/Gamepad
        var interval;
        var start;
        var a = 0;
        var b = 0;

        var rAF = window.requestAnimationFrame ||
          window.mozRequestAnimationFrame ||
          window.webkitRequestAnimationFrame;

        var rAFStop = window.cancelRequestAnimationFrame ||
          window.mozCancelRequestAnimationFrame ||
          window.webkitCancelRequestAnimationFrame;

        if (!('ongamepadconnected' in window)) {
          // No gamepad events available, poll instead.
          interval = setInterval(pollGamepads, 500);
        } else {
          window.addEventListener("gamepadconnected", function(e) {
            var gp = navigator.getGamepads()[e.gamepad.index];
            console.log("Gamepad connected at index " + gp.index + ": " + gp.id + ". It has " + gp.buttons.length + " buttons and " + gp.axes.length + " axes.");;

            gameLoop();
          });
        }

        function pollGamepads() {
          var gamepads = navigator.getGamepads ? navigator.getGamepads() : (navigator.webkitGetGamepads ? navigator.webkitGetGamepads : []);
          for (var i = 0; i < gamepads.length; i++) {
            var gp = gamepads[i];
            if (gp) {
              console.log("Gamepad connected at index " + gp.index + ": " + gp.id + ". It has " + gp.buttons.length + " buttons and " + gp.axes.length + " axes.");;
              gameLoop();
              clearInterval(interval);
            }
          }
        }


        function buttonPressed(b) {
          if (typeof(b) == "object") {
            return b.pressed;
          }
          return b > .75;
        }

        function gameLoop() {
        //  var gamepads = navigator.getGamepads ? navigator.getGamepads() : (navigator.webkitGetGamepads ? navigator.webkitGetGamepads : []);
        //  if (!gamepads) {
        //    return;
        //  }
//
        //  var gp = gamepads[0];
        //  //if (buttonPressed(gp.buttons[0])) {joystick &= ~16} else {joystick |= 16};
        //  //if (buttonPressed(gp.buttons[1])) {joystick &= ~key} else {};
        //  //if (buttonPressed(gp.buttons[2])) {joystick &= ~32} else {joystick |= 32};
        //  //if (buttonPressed(gp.buttons[3])) {joystick &= ~key  } else {};
//
        //  if (buttonPressed(gp.buttons[2])) {joystick &= ~16} else {joystick |= 16};
        //  if (buttonPressed(gp.buttons[0])) {joystick &= ~32} else {joystick |= 32};
        //  if (gp.axes[4] > .5) {joystick &= ~8} else {joystick |= 8};
        //  if (gp.axes[4] < -0.5) {joystick &= ~4} else {joystick |= 4};
        //  if (gp.axes[5] > .5) {joystick &= ~2} else {joystick |= 2};
        //  if (gp.axes[5] < -0.5) {joystick &= ~1} else {joystick |= 1};
//
//
        //  start = rAF(gameLoop);
        }

        //global.$gamepad = $gamepad;
      }(this);


      var keys = {
        /*
          87: 1,  // W = JP1 up
          83: 2,  // S = JP1 down
          65: 4,  // A = JP1 left
          68: 8,  // D = JP1 right
          32: 16, // Space = JP1 fire 1
          13: 32, // Enter = JP1 fire 2
        */
          38: 1,  // Arrow keys
          40: 2,
          37: 4,
          39: 8,
          81: 16, // Q/A for fire 1
          65: 16, // 
          87: 32, // W/Z for fire 2
          90: 32, // 

          82: 1 << 12,  // R for reset button
      };




        var origin = document.getElementById('origin');

      var PP;

      function loadRomData(path) {
        "use strict";

        //var path = "roms/" + name;
        console.log("Loading ROM from " + path);
        var request = new XMLHttpRequest();
        request.open("GET", path, false);
        request.overrideMimeType('text/plain; charset=x-user-defined');
        request.send(null);
        $state.loaded();
        if (request.status != 200) return [];
        return request.response;
      }

      function miracle_init() {
        vdp_init();
        audio_init();
        ram = new Uint8Array(0x2000);
        cartridgeRam = new Uint8Array(0x8000);
        pages = new Uint8Array(3);
        miracle_reset();

        //PP = $pixelperfect('origin', 'display');
        origin.onclick = function() {
          /*
          if (running) {stop(); $state.pause();}
          else {start(); $state.play();}
          */
        }
        origin.ondblclick = function() {
          $fullscreen();
        }

        canvas = origin;
        ctx = origin.getContext('2d');
        ctx.webkitImageSmoothingEnabled = false;
        ctx.oImageSmoothingEnabled = false;
        ctx.mozImageSmoothingEnabled = false;
        ctx.imageSmoothingEnabled = false;

        if (ctx.getImageData) {
          imageData = ctx.getImageData(0, 0, 256, 192);
          fb8 = imageData.data;
          fb32 = new Uint32Array(fb8.buffer);
        } else {
          $alert('upgrade your browser, dude');
        }

        document.onkeydown = keyDown;
        document.onkeyup = keyUp;
        //document.onkeypress = keyPress;


      }

      function paintScreen() {
        ctx.putImageData(imageData, 0, 0);
        //PP.sync();
      }


      /*
      function openRom(path) {
        $state.loaded();
        z80_init();
        miracle_init();
        miracle_reset();
        loadRom(loadRomData(path));
        //const defaultRom = getDefaultRom();
        //loadRom(loadRomData(path));
        //loadRom(loadRomData('/d/roms/sms/games/Jurassic Park.sms'));
        //loadRom(loadRomData('/d/roms/sms/games/Sonic Chaos.sms'));
        //loadRom(loadRomData('/d/roms/sms/games/R-Type.sms'));
        //loadRom(loadRomData('/d/roms/sms/games/Ecco the Dolphin.sms'));
        //loadRom(loadRomData('/d/roms/sms/music/CWP.sms'));
        //loadRom(loadRomData('/d/roms/sms/music/TRG.sms'));
        start();
      }
      */
      

      function openRom(path) {
        window.parent.$file.open(path, 'Blob', function(val) {
          $state.loaded();
          startGame(val);
        });
      }

      function startGame (blob) {
        var binaryHandle = new FileReader();
        binaryHandle.onload = function () {
          if (this.readyState === 2) {
            try {
              z80_init();
              miracle_init();
              miracle_reset();
              //loadRom(loadRomData(path));
              loadRom(this.result);
              start();
            } catch (e) {
              parent.$alert('Invalid rom: ' + e.message);
            }
          }
        };
        binaryHandle.readAsBinaryString(blob);
      };


      $state.loading();

      if ($url.query.rom) {
        openRom($url.query.rom)
      } else {
        parent.$explorer('c/files/roms/sms/', {browse: true, explorer: true, onclose: function(ok, file) {
          if (ok) openRom(file);
        }})
      }

      //openRom('/c/files/roms/sms/games/Shinobi.sms');


      /////////////////////////////////////////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////

      /*var gamepad_count = 0;
      function pollGamepads() {
        var gamepads = navigator.getGamepads();
        //console.log(gamepads);
        if (gamepads.length != gamepad_count) {
          gamepad_count = gamepads.length;
          for (var i = 0; i < gamepads.length; i++) {
            if (gamepads[i]) {
              //console.log("Gamepad %d: %s. %d buttons, %d axes",
              //  i, gamepads[i].id,
              //  gamepads[i].buttons.length, gamepads[i].axes.length);
              console.log(gamepads[i].buttons);
            }
          }
        }
      }
      setInterval(pollGamepads, 100);*/
    </script>
  </body>
</html>
