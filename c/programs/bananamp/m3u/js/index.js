
/////////////////////////////////////////////////////////////////////////////
// $player.color = '#0f8';

var bPlayedEl = document.getElementById('bPlayed');
var bRestEl = document.getElementById('bRest');
var playlistEl = document.getElementById('bamp_playlist');
var time_played_progressEl = document.getElementById('bamp_time_played_progress');
var time_played_durationEl = document.getElementById('bamp_time_played_duration');

// function changeBampColor(color) {
//   bPlayedEl.style.color = color;
//   playlistEl.style.color = color;
//   $player.color = color;
// }
// changeBampColor($player.color);
/////////////////////////////////////////////////////////////////////////////

var info_loadedEl = document.getElementById("bamp_info_loaded");
var time_loadedEl = document.getElementById("bamp_time_loaded");

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

// fix chrome
var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
var wait4click=true; 
var toPlayChrome;

/*
  88   88 88
  88   88 88
  Y8   8P 88
  `YbodP' 88
*/
volumeEl.oninput = volumeEl.onchange = function(e) {
  $player.volume(currentVolume = this.value);
}

document.body.onkeyup = function(e){
    if(e.keyCode == 32){
        console.log('play')
    }
}

playEl.onclick = function() {
	if (isChrome&&wait4click) {
		launchSong(toPlayChrome);
		wait4click = false;
	}else{
		if ($player.playing()) $player.pause();
  		else $player.play();
	}
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
  info_loadedEl.textContent = 'Error...'
});

var currentInfos;
$player.infos = {};
$player.on('metadata', function(data) {
  currentInfos = '';
  if (data.artist && data.title) currentInfos = data.artist + ' - ' + data.title;
  else if (data.title) currentInfos = data.title;
  else currentInfos = 'Unknown';
  if (data.player) currentInfos += ' (' + data.player + ')';
  info_loadedEl.textContent = currentInfos;
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

  currentTime = time > -1 ? formatTime(time) : '--:--';
  if (duration !== oldDuration) {
    currentDuration = duration > 0 ? formatTime(duration) : '--:--';
    time_played_durationEl.textContent = currentDuration;
    oldDuration = duration;
  }

  time_loadedEl.innerHTML = '<span>' + currentTime + '</span><span>' + currentDuration + '<span>';
  time_played_progressEl.textContent = currentTime;

  setTimeout(function() {
    if (percent !== oldPercent) {
      bPlayedEl.style.width = percent + '%';
      bRestEl.style.width = (100 - percent) + '%';
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

bLoaded_spectrum.onclick = function(e) {
  var percent = (e.layerX / bLoaded_spectrum.offsetWidth) * 100;
  $player.seek(percent);
}

var isFreq = true;
var ctxLoaded_spectrum = bLoaded_spectrum.getContext('2d');
var spectrumW = bLoaded_spectrum.clientWidth;
var spectrumH = bLoaded_spectrum.clientHeight;
bLoaded_spectrum.width = spectrumW;
bLoaded_spectrum.height = spectrumH;

info_loadedEl.style.width =
time_loadedEl.style.width = spectrumW + 'px';

ctxLoaded_spectrum.oImageSmoothingEnabled =
ctxLoaded_spectrum.mozImageSmoothingEnabled =
ctxLoaded_spectrum.imageSmoothingEnabled = false

var styleLoaded_spectrum = window.getComputedStyle(bLoaded_spectrum.parentNode);
var COLORLoaded_spectrum = styleLoaded_spectrum.color;

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

var divDemo = document.getElementById('divDemo');

var
  currentSong,
  currentVisual,
  currentVolume,
  playerData
;

function loadTrackerView(arg) {
  divDemo.innerHTML = "";
  var res = trackerview.call({
     playerData: playerData
    ,div: divDemo
    ,width: divDemo.clientWidth
    ,height: divDemo.clientHeight
    ,title: currentInfos
    ,frequencyBinCount: 256
  }, divDemo);

  var render = res.render

  var now = 0;
  var delta = 0;
  var then = performance.now();//Date.now();
  var fps = 1000 / 30;
  renderFunction = function(f, t, now) {
    //now = Date.now();
    delta = now - then;
    //console.log(delta);
    if (delta > fps) {
      then = now - (delta % fps); // Update time stuffs
      render(f, t, now);
    }
  }

  $player.on('visualization', renderFunction);
}

$player.on('ready', function(data) {
  playerData = data;
  // console.log('???');
  // loadTrackerView();


  loadVisu({
    options: {
      fps: 25,
      canvas: false
    },
    init: trackerview
  }, playerData)



  // loadVisu(select_visu.value, data);
});

$player.on('end', function(data) {
  if (renderFunction) $player.off('visualization', renderFunction);
  playEl.firstChild.className='bamp__ico bamp__ico--play';
  // launchSong(++currentSong);
  if (currentSong.nextElementSibling) {
    launchSong(currentSong.nextElementSibling)
  }
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
  // console.dir(currentSong);
  // if (currentSong === 0) return;
  // launchSong(--currentSong);
  if (currentSong.previousElementSibling) {
    launchSong(currentSong.previousElementSibling)
  }
};
nextEl.onclick = function() {
  if (currentSong.nextElementSibling) {
    launchSong(currentSong.nextElementSibling)
  }
  // launchSong(++currentSong);
};

// console.log($menu);

var cnt = 0

function loadSongs (list) {
  // console.log(111, list)
  songs = list
  var toPlay;
  var playlistSong;
  var docfrag = document.createDocumentFragment();
  songs.forEach(function(song, i) {
    var playlistSong = songEl.cloneNode(false);
    playlistSong.id = 'bamp_song_' + cnt++;
    playlistSong.dataset.url = song;
    playlistSong.textContent = song.split('/').pop();
    playlistSong.ondblclick = playlistSong.touchstart = function(e) {
      // launchSong(this.id.replace('bamp_song_','') * 1);
      launchSong(this);
    }
    if (i === 0) toPlay = playlistSong;
    var menu = $menu(playlistSong, [
      {name: "Play", action: function() { this.ondblclick } },
      {name: "Download", action: function() { console.log(this);} },
      {name: "---" },
      {name: "Remove", key: "del", action: function() { menu.destroy(); this.remove(); } },
    ], {mode: 'context'})
    docfrag.appendChild(playlistSong);
  })
  playlistEl.appendChild(docfrag);
  // console.log(toPlay);

  if (isChrome) {
  	console.log('chrome...')
  	toPlayChrome=toPlay;

  }else{
  	 launchSong(toPlay)
  }
  //
}


function launchSong(song) {
  // var song = document.getElementById('bamp_song_' + id);
  if (song) {
    currentSong = song;
    if ($player.playing()) $player.destroy();
    var bamp_song_playing = document.querySelector('.bamp_song_playing');
    if (bamp_song_playing) bamp_song_playing.classList.remove('bamp_song_playing');
    song.classList.add('bamp_song_playing');
    var url = song.dataset.url;
    // console.log(url)
    if (url.indexOf('/a/') === 0) {
      $file.open(url, 'Blob', function(blob) {
        $player(url, blob).play();
      })
    } else {
      $player(url).play();
    }
  }
}

var def = {
   song: 0
  // ,visual: 'visual/mod.tracker.js'
  ,volume: 50
}
// $db(def, 'bamp_settings',
//   function(err, val) {
//     setTimeout(function() {
//       if (val.song > -1) launchSong(val.song);
//       // if (val.visual) select_visu.value = val.visual;
//       // console.log(playerData);
//       // loadVisu(trackerview, playerData);

//       currentVolume = volumeEl.value = val.volume;
//       $player.volume(currentVolume);
//     }, 500);
//   },
//   function() {
//     return {
//        song: currentSong
//       // ,visual: currentVisual
//       ,volume: currentVolume
//     };
//   })
// ;

// setTimeout(function() {
//   // if (val.song > -1) launchSong(val.song);
//   // if (val.visual) select_visu.value = val.visual;
//   // console.log(playerData);
//   // loadVisu(trackerview, playerData);

//   // launchSong();
//   currentVolume = volumeEl.value = 50;
//   $player.volume(currentVolume);
// }, 1);

currentVolume = volumeEl.value = 50;
$player.volume(currentVolume);

if (window.top === window) {
  loadSongs(songs);
}
