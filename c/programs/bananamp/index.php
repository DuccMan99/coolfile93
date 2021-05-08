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
<body>
<div class="ui_layout ui_unselectable">
  <article>
    <aside class="_skin_outset skin_base _mr5 mb1" style="width:300px;">
      <div class="ui_layout">
        <header class="_pa5 _mr5" ondrop="drop(event)" ondragover="allowDrop(event)">
          <div id="bView" class="skin_inset _skin_nerd">
            <div id="bLoaded">
              <div>&nbsp;</div>
              <div id="bamp_info_loaded">Loading...</div>
              <div id="bamp_time_loaded"><span>--:--</span><span>--:--<span></div>
              <canvas id="bLoaded_spectrum"></canvas>
            </div>
            <div id="bPlayed">
              <div>&nbsp;</div>
              <div id="bamp_info_played">Loading...</div>
              <div id="bamp_time_played">
                <span id="bamp_time_played_progress">--:--</span>
                <span id="bamp_time_played_duration">--:--<span>
              </div>
              <canvas id="bPlayed_spectrum"></canvas>
            </div>
            <div id="bamp_buffer"></div>
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
  </article>
</div>

  <script src="js/aurora.js"></script>
  <script src="js/codecs/mp3.js"></script>
  <script src="js/codecs/flac.js"></script>
  <!--
  <script src="js/codecs/alac.js"></script>
  <script src="js/codecs/aac.js"></script>
  -->
  <script src="js/codecs/ogg.js"></script>
  <script src="js/codecs/vorbis.js"></script>
  <script src="js/codecs/opus.js"></script>

  <script src="js/webXmp.js"></script>
  <script src="js/sample_player.js"></script>
  <script src="js/pt.js"></script>

  <script src="/c/sys42.js?v=2.4.2"></script>

  <script src="bananamp.js"></script>

<script>

// var stats = new Stats();
// stats.domElement.style.position = 'absolute';
// stats.domElement.style.zIndex = '99999';
// stats.domElement.style.right = '0px';
// stats.domElement.style.top = '0px';
// stats.domElement.style.display = 'none';
// document.body.appendChild( stats.domElement );

/////////////////////////////////////////////////////////////////////////////
var THREE;

$player.color = '#0f8';

var bPlayedEl = document.getElementById('bPlayed');
var playlistEl = document.getElementById('bamp_playlist');
var time_played_progressEl = document.getElementById('bamp_time_played_progress');
var time_played_durationEl = document.getElementById('bamp_time_played_duration');

function changeBampColor(color) {
  bPlayedEl.style.color = color;
  playlistEl.style.color = color;
  time_played_progressEl.setAttribute('style',
      'text-shadow:'
    + '  -1px -1px 0 '+ color +','
    + '   1px -1px 0 '+ color +','
    + '   -1px 1px 0 '+ color +','
    + '    1px 1px 0 '+ color +';'
  );
  $player.color = color;
}
changeBampColor($player.color);

/////////////////////////////////////////////////////////////////////////////

//!function() { 'use strict';


  var songs = [];
  var baseUrl = '/c/programs/bananamp/';

  var info_loadedEl = document.getElementById("bamp_info_loaded");
  var info_playedEl = document.getElementById("bamp_info_played");
  var time_loadedEl = document.getElementById("bamp_time_loaded");
  var time_playedEl = document.getElementById("bamp_time_played");

  var bufferEl = document.getElementById("bamp_buffer");
  var playlistEl = document.getElementById("bamp_playlist");
  //var cover_artEl = document.getElementById("bamp_cover_art");
  var playEl = document.getElementById("bamp_play");
  var stopEl = document.getElementById("bamp_stop");
  var previousEl = document.getElementById("bamp_previous");
  var nextEl = document.getElementById("bamp_next");
  var volumeEl = document.getElementById("bamp_volume");
  var bananalogoEl = document.getElementById("bananalogo");

  var bLoaded_spectrum = document.getElementById('bLoaded_spectrum');
  var bPlayed_spectrum = document.getElementById('bPlayed_spectrum');


  /*
    88   88 88
    88   88 88
    Y8   8P 88
    `YbodP' 88
  */
  volumeEl.oninput = volumeEl.onchange = function(e) {
    $player.volume(currentVolume = this.value);
  }
  playEl.onclick = function() {
    if ($player.playing()) $player.pause();
    else $player.play();
  };
  stopEl.onclick = function() {
    playEl.firstChild.className='bamp__ico bamp__ico--play';
    $player.stop();
  };

  $player.on('play', function(percent) {
    playEl.firstChild.className='bamp__ico bamp__ico--pause';
  });

  $player.on('pause', function(percent) {
    playEl.firstChild.className='bamp__ico bamp__ico--play';
  });

  $player.on('error', function(data) {
    console.error(data)
    info_playedEl.textContent = info_loadedEl.textContent = 'Error...'
  });

  var currentInfos;
  $player.infos = {};
  $player.on('metadata', function(data) {
    currentInfos = '';
    if (data.artist && data.title) currentInfos = data.artist + ' - ' + data.title;
    else if (data.title) currentInfos = data.title;
    else currentInfos = 'Unknown';
    if (data.player) currentInfos += ' (' + data.player + ')';
    info_playedEl.textContent = info_loadedEl.textContent = currentInfos;
    $player.infos.song = currentInfos;
    $player.infos.cover = data.bamp_cover_art ? data.bamp_cover_art.toBlobURL() : 'blank.png';
    //cover_artEl.style.backgroundImage = 'url(' + (data.bamp_cover_art ? data.bamp_cover_art.toBlobURL() : 'blank.png') + ')';
  });

  $player.on('buffer', function(percent) {
    bufferEl.style.width = (100 - percent) + '%';
  });

  function pad(input) {
    return ("00" + input).slice(-2);
  }
  function formatTime(time) {
    var t = time / 1000,
            seconds = Math.floor(t % 60),
            minutes = Math.floor((t /= 60) % 60);
    return pad(minutes) + ':' + pad(seconds);
  }
  var currentTime, oldPercent, currentTime, currentDuration = '--:--', oldDuration;
  $player.on('progress', function(percent, time, duration) {

    //console.log('time', time);
    //console.log('duration', duration);



    currentTime = time > -1 ? formatTime(time) : '--:--';
    if (duration !== oldDuration) {
      currentDuration = duration > 0 ? formatTime(duration) : '--:--';
      time_played_durationEl.textContent = currentDuration;
      oldDuration = duration;
    }

    /*time_loadedEl.innerHTML =
    time_playedEl.innerHTML = '<span>' + time + '</span><span>' + duration + '<span>';*/
    time_loadedEl.innerHTML = '<span>' + currentTime + '</span><span>' + currentDuration + '<span>';
    time_played_progressEl.textContent = currentTime;

    setTimeout(function() {
      if (percent !== oldPercent) {
        bPlayedEl.style.width = percent + '%';
        oldPercent = percent;
      }
      $player.infos.milisecond = time;
      $player.infos.time = currentTime;
    }, 0);
    //$player.infos.duration = currentDuration;

  });


  /*
    Yb    dP 88   88 8b    d8 888888 888888 88""Yb 888888
     Yb  dP  88   88 88b  d88 88__     88   88__dP 88__
      YbdP   Y8   8P 88YbdP88 88""     88   88"Yb  88""
       YP    `YbodP' 88 YY 88 888888   88   88  Yb 888888
  */
  bananalogoEl.onclick = function() {
    isFreq = !isFreq;
  }

  bPlayed_spectrum.onclick = function(e) {
    e.preventDefault();
  }

  bLoaded_spectrum.onclick = function(e) {
    var percent = (e.layerX / bLoaded_spectrum.offsetWidth) * 100;
    $player.seek(percent);
  }

  var isFreq = true;
  var ctxLoaded_spectrum = bLoaded_spectrum.getContext('2d');
  var ctxPlayed_spectrum = bPlayed_spectrum.getContext('2d');
  var spectrumW = bLoaded_spectrum.clientWidth;
  var spectrumH = bLoaded_spectrum.clientHeight;
  bLoaded_spectrum.width = bPlayed_spectrum.width = spectrumW;
  bLoaded_spectrum.height = bPlayed_spectrum.height = spectrumH;

  info_loadedEl.style.width =
  info_playedEl.style.width =
  time_loadedEl.style.width =
  time_playedEl.style.width = spectrumW + 'px';

  // ctxLoaded_spectrum.webkitImageSmoothingEnabled =
  ctxLoaded_spectrum.oImageSmoothingEnabled =
  ctxLoaded_spectrum.mozImageSmoothingEnabled =
  ctxLoaded_spectrum.imageSmoothingEnabled =

  // ctxPlayed_spectrum.webkitImageSmoothingEnabled =
  ctxPlayed_spectrum.oImageSmoothingEnabled =
  ctxPlayed_spectrum.mozImageSmoothingEnabled =
  ctxPlayed_spectrum.imageSmoothingEnabled = false;

  var styleLoaded_spectrum = window.getComputedStyle(bLoaded_spectrum.parentNode);
  var COLORLoaded_spectrum = styleLoaded_spectrum.color;
  var stylePlayed_spectrum = window.getComputedStyle(bPlayed_spectrum.parentNode);
  var COLORPlayed_spectrum = stylePlayed_spectrum.color;

  function cloneCanvas(arg) { 'use strict';
    ctxPlayed_spectrum.clearRect(0, 0, spectrumW, spectrumH);
    ctxPlayed_spectrum.fillStyle = $player.color; //COLORPlayed_spectrum; //'#00ffff'
    ctxPlayed_spectrum.fillRect(0,0, spectrumW, spectrumH);
    ctxPlayed_spectrum.globalCompositeOperation = "destination-atop";
    ctxPlayed_spectrum.drawImage(bLoaded_spectrum, 0, 0, spectrumW, spectrumH);
  }

  $player.displayWaveform(bLoaded_spectrum, COLORLoaded_spectrum, function() {
    cloneCanvas();
  });

  var SPACER_WIDTH = 1;
  var BAR_WIDTH = 1;
  var REZ = 5;
  var numBars = Math.ceil((spectrumW+SPACER_WIDTH) / SPACER_WIDTH);
  var offset = 256 / numBars;

  $player.on('visualization', function(frequencyData, timeDomainData) {
    var STEP = 0;
    var data = isFreq ? frequencyData : timeDomainData;
    ctxLoaded_spectrum.clearRect(0, 0, spectrumW, spectrumH);
    ctxLoaded_spectrum.fillStyle = COLORLoaded_spectrum; //'#c3ff00';
    for (var i = 0; i < numBars; ++i) {
      STEP += offset;
      var magnitude = Math.floor(data[Math.floor(STEP)] * spectrumH / 255);
      ctxLoaded_spectrum.fillRect(i * SPACER_WIDTH, spectrumH, BAR_WIDTH, -magnitude);
    }
    cloneCanvas();
  });


  /*
    8888b.  888888 8b    d8  dP"Yb
     8I  Yb 88__   88b  d88 dP   Yb
     8I  dY 88""   88YbdP88 Yb   dP
    8888Y"  888888 88 YY 88  YbodP
  */
  // var canvasDemo = document.getElementById('canvasDemo');
  // var ctxDemo = canvasDemo.getContext('2d');
  // var tab_demo = document.getElementById('tab_demo');
  // //var tab_cover = document.getElementById('tab_cover');
  // var divDemo = document.getElementById('divDemo');
  // function resizeCanvasDemo() {
  //   var spectrumW = canvasDemo.clientWidth;
  //   var spectrumH = canvasDemo.clientHeight;
  //   canvasDemo.width = spectrumW;
  //   canvasDemo.height = spectrumH;
  //   ctxDemo = canvasDemo.getContext('2d');
  // }


  /*var btn_coverEl = document.getElementById("btn_cover");
  var btn_infoEl = document.getElementById("btn_info");
  btn_coverEl.onclick = function() {
    tab_demo.className = 'hide';
    tab_cover.className = '';
    btn_infoEl.className = '';
    this.className = 'pressed';
  }
  btn_infoEl.onclick = function() {
    tab_demo.className = '';
    tab_cover.className = 'hide';
    btn_coverEl.className = '';
    this.className = 'pressed';
  }*/

  var demoDefault = {
    adaptSize: true,
    pixelArt: true,
    canvas: true,
    stats: false,
    fftSize: 1024,
    fps: 60,
    playerColor: '#0f8',
    assets: [],
    fileType: '*'
  }

  var renderFunction;
  var destroyFunction;
  var VERSIONS = {};

  var
    currentSong,
    currentVisual,
    currentVolume,
    playerData
  ;

  $player.on('ready', function(data) {
    playerData = data;
    // loadVisu(select_visu.value, data);
  });

  $player.on('end', function(data) {
    if (renderFunction) $player.off('visualization', renderFunction);
    playEl.firstChild.className='bamp__ico bamp__ico--play';
    launchSong(++currentSong);
  });


  /*
    88""Yb 88        db    Yb  dP 88     88 .dP"Y8 888888
    88__dP 88       dPYb    YbdP  88     88 `Ybo."   88
    88"""  88  .o  dP__Yb    8P   88  .o 88 o.`Y8b   88
    88     88ood8 dP""""Yb  dP    88ood8 88 8bodP'   88
  */

  var songEl = document.createElement('div');

  songEl.className = 'bamp_song';
  songEl.setAttribute('tabindex', '0');

  previousEl.onclick = function() {
    if (currentSong === 0) return;
    launchSong(--currentSong);
  };
  nextEl.onclick = function() {
    if (currentSong === songs.length) return;
    launchSong(++currentSong);
  };

  function loadSongs (list) {
    // console.log(111, list)
    songs = list
    var playlistSong;
    var docfrag = document.createDocumentFragment();
    for (var i = 0; i < songs.length; i++) {
      var playlistSong = songEl.cloneNode(false);
      playlistSong.id = 'bamp_song_' + i;
      playlistSong.textContent = songs[i];
      playlistSong.ondblclick = playlistSong.touchstart = function(e) {
        launchSong(this.id.replace('bamp_song_','') * 1);
      }
      docfrag.appendChild(playlistSong);
    };
    playlistEl.appendChild(docfrag);
  }

  // function loadSong (path, i) {
  //   var playlistSong = songEl.cloneNode(false);
  //   playlistSong.id = 'bamp_song_' + i;
  //   playlistSong.textContent = path;
  //   playlistSong.ondblclick = playlistSong.touchstart = function(e) {
  //     launchSong(this.id.replace('bamp_song_','') * 1);
  //   }
  //   return playlistSong
  // }

  function launchSong(id) {
    var song = document.getElementById('bamp_song_' + id);
    if (song) {
      currentSong = id;
      if ($player.playing()) $player.destroy();
      var bamp_song_playing = document.querySelector('.bamp_song_playing');
      if (bamp_song_playing) bamp_song_playing.classList.remove('bamp_song_playing');
      song.classList.add('bamp_song_playing');
      // var url = baseUrl + song.textContent;
      var url = song.textContent;
      // console.log(url)
      if (url.indexOf('/a/') === 0) {
        $file.open(url, 'Blob', function(blob) {
          $player(url, blob).play();
        })
      } else {
        $player(url).play();
      }

      // $file.getUrl(url, function(val) {
      //   // console.log(val)
      //   // var player = new window.Audio();
      //   // player.src = val; // window.URL.createObjectURL(this.response);
      //   // player.play();
      //   // openedAs = 'URL';
      //   // processFile(filePath, $fs.utils.getInfo(filePath), val);

      //   // that.el.iframe.contentWindow.loadSongs([val])
      //   $player(url, val).play();
      // });
    }
  }

  var def = {
     song: 0
    ,visual: 'visual/mod.tracker.js'
    ,volume: 50
  }
  $db(def, 'bamp_settings',
    function(err, val) {
      setTimeout(function() {
        if (val.song > -1) launchSong(val.song);
        // if (val.visual) select_visu.value = val.visual;
        currentVolume = volumeEl.value = val.volume;
        $player.volume(currentVolume);
      }, 500);
    },
    function() {
      return {
         song: currentSong
        ,visual: currentVisual
        ,volume: currentVolume
      };
    })
  ;



//}();


</script>

</body>
</html>
