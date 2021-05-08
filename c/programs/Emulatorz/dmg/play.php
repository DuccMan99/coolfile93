<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>DMG-01</title>

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

    <canvas id="origin" width="160" height="144">No Canvas Support</canvas>

    <script src="/c/sys42.js?v=2.4.2"></script>

    <script src="js/other/base64.js"></script>
    <script src="js/other/json2.js"></script>
    <script src="js/other/swfobject.js"></script>
    <script src="js/other/resampler.js"></script>
    <script src="js/other/XAudioServer.js"></script>
    <script src="js/other/resize.js"></script>
    <script src="js/GameBoyCore.js"></script>
    <script src="js/GameBoyIO.js"></script>

    <script>
    window.onresize = initNewCanvasSize;
    window.onunload = autoSave;
    var mainCanvas = document.getElementById("origin");

    function cout() {}

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
            start(mainCanvas, this.result);
            settings[13] = false;
            if (GameBoyEmulatorInitialized()) {
              gameboy.initLCD();
            }
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
      parent.$explorer('c/files/roms/dmg/', {browse: true, explorer: true, onclose: function(ok, file) {
        if (ok) openRom(file);
      }})
    }


    var keyZone = {
      'shift' : 'select',
      'num_0' : 'select',
      'space' : 'start',
      '¾' : 'start',
      'a' : 'a',
      'j' : 'a',
      'x' : 'a',
      'enter' : 'a',
      'b' : 'b',
      'z' : 'b',
      'y' : 'b',
      'q' : 'b',
      'num_3' : 'b',
    }

    $key(mainCanvas).up(function(key, code) {
      GameBoyKeyUp(keyZone[key] ? keyZone[key] : key);
    });
    $key(mainCanvas).down(function(key, code) {
      GameBoyKeyDown(keyZone[key] ? keyZone[key] : key);
    });
    </script>
  </body>
</html>
