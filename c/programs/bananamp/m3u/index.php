<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>bananamp</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
<link rel="stylesheet" href="./bananamp.css">
<body class="skin_base">
<div class="ui_layout ui_unselectable">
  <article>
    <aside class="_skin_outset _skin_base _mr5 mb1" style="width:300px;">
      <div class="ui_layout">
        <header class="_pa5 _mr5" ondrop="drop(event)" ondragover="allowDrop(event)">
          <div id="bView" class="skin_inset _skin_nerd">
            <div id="bFilter">
              <div id="bLoaded">
                <div>&nbsp;</div>
                <div id="bamp_info_loaded">01 world of wonders</div>
                <div id="bamp_time_loaded">
                  <span id="bamp_time_played_progress">--:--</span>
                  <span id="bamp_time_played_duration">--:--<span>
                </div>
                <canvas id="bLoaded_spectrum"></canvas>
              </div>
              <div id="bPlayed"></div>
              <div id="bamp_buffer"></div>
            </div>
            <div id="bRest"></div>
          </div>
          <div id="bamp_controls">
            <button class="bamp__control" id="bamp_previous"><i class="bamp__ico bamp__ico--previous"></i></button>
            <button class="bamp__control" id="bamp_play"><i class="bamp__ico bamp__ico--play"></i></button>
            <button class="bamp__control" id="bamp_stop"><i class="bamp__ico bamp__ico--stop"></i></button>
            <button class="bamp__control" id="bamp_next"><i class="bamp__ico bamp__ico--next"></i></button>
            <input style="margin-left:5px" type="range" id="bamp_volume" min="0" max="100" value="50" step="1">
            <div id="bananalogo" style="flex:1 0 16px; width:16px; padding-top:3px; margin-left:5px; margin-right:4px">
              <img src="icon.png" width="16" height="16" alt="">
            </div>
          </div>
        </header>
        <section>
          <div id="bamp_playlist" class="skin_inset"></div>
        </section>
      </div>
    </aside>
    <section id="bamp_sideview" class="skin_inset">
      <div class="ui_layout">
        <section id="bamp_viewer">
          <div id="tab_demo" class="ui_layout">
            <canvas id="canvasDemo"></canvas>
            <div id="divDemo"></div>
          </div>
        </section>
      </div>
    </section>
  </article>
</div>

  <script src="js/engine/aurora.js"></script>
  <script src="js/engine/codecs/mp3.js"></script>
  <script src="js/engine/codecs/flac.js"></script>
  <!--
  <script src="js/engine/codecs/alac.js"></script>
  <script src="js/engine/codecs/aac.js"></script>
  -->
  <script src="js/engine/codecs/ogg.js"></script>
  <script src="js/engine/codecs/vorbis.js"></script>
  <script src="js/engine/codecs/opus.js"></script>

  <script src="js/engine/webXmp.js"></script>
  <script src="js/engine/sample_player.js"></script>
  <script src="js/engine/pt.js"></script>

  <script src="/c/sys42.js?v=2.4.2"></script>

  <script src="js/bananamp.js"></script>
  <script src="js/trackerview.js"></script>
  <script src="js/loadvisu.js"></script>
  <script>
    var songs = [];
  </script>
  <script src="js/index.js"></script>

<script>



</script>

</body>
</html>
