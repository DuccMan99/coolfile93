<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>jsspeccy</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
<style></style>
</head>
  <body class="app_emulator">

    <div id="jsspeccy-viewport"></div>

    <script src="jdataview.js"></script>
    <script src="jsspeccy-core.js"></script>

    <script src="/c/sys42.js?v=2.4.2"></script>

    <script>
      var jsspeccy = JSSpeccy('jsspeccy-viewport', {'autostart': true, scaleFactor:1});

      var viewport = document.getElementById('jsspeccy-viewport');
      
      viewport.onclick = function() {
        if (jsspeccy.isRunning) {
          jsspeccy.stop();
        } else {
          jsspeccy.start();
        }
      }
      
    </script>
  </body>
</html>
