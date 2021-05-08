
!function(global) { 'use strict';

  var
    UNSUPPORTED,
    SHARED_CONTEXT,
    SHARED_PROCESSOR,
    SHARED_PLAYER,
    SHARED_GAIN,
    SHARED_VOLUME = 50
  ;

  if (!window.Audio || !('mozWriteAudio' in new Audio())
    && !window.AudioContext
    && !window.webkitAudioContext) UNSUPPORTED = true;

  if (UNSUPPORTED) {
    alert('Web Audio API is not supported in this browser');
    global.$player = {ok: false};
    return;
  }

  // multiple context creation limitation workaround
  // create a dummy aurorajs audio context as shared audio context
  // @todo : write aurora demuxer and decoder for modules
  SHARED_CONTEXT = AV.AudioDevice.create(44100, 2).context

  var playerDefault = {
    play: null,
    pause: $noop,
    stop: $noop,
    seek: $noop,
    playing: $noop,
    volume: function(val) {
      if (val >= 0) SHARED_GAIN.gain.value = (val/100);
      return SHARED_GAIN.gain.value * 100;
    }
  }
  SHARED_PLAYER = playerDefault;

  function connectSharedGain(processor) {
    SHARED_GAIN = SHARED_CONTEXT.createGain();
    try {
      processor.disconnect(SHARED_CONTEXT.destination);
    } catch (err) {

    }
    processor.connect(SHARED_GAIN);
    SHARED_GAIN.connect(SHARED_CONTEXT.destination);
    SHARED_GAIN.gain.value = SHARED_VOLUME/100;
  }

  /*
       db    88   88 8888b.  88  dP"Yb
      dPYb   88   88  8I  Yb 88 dP   Yb
     dP__Yb  Y8   8P  8I  dY 88 Yb   dP
    dP""""Yb `YbodP' 8888Y"  88  YbodP
  */
  /////////////////////////////////////////////////////////////////////////////
  // mp3|ogg|aac|flac|alac
  // https://github.com/audiocogs/aurora.js/
  /////////////////////////////////////////////////////////////////////////////

  var OGGinit = false;
  var avPlayer, duration = 0;
  function playAudio(url, blob) {
    // console.log(1111, url)
    var onmetadata, onduration, onbuffer, onprogress, onready, onerror, onend;


    // big ugly patch for ogg not working with the first load
    if (!OGGinit && /\.(ogg)$/i.test(url)) {
      avPlayer = AV.Player.fromURL('blank.ogg' + '?v=' + Date.now());
      avPlayer.volume = 0;
      try {avPlayer.play()} catch(e) {}
      OGGinit = true;
    }

    // reset;
    duration = 0;


    if (blob) {
      // console.log('blob', blob)
      avPlayer = AV.Player.fromFile(blob);
    } else {
      // cached tracks sadly cause player bug
      // https://github.com/audiocogs/aurora.js/issues/99
      avPlayer = AV.Player.fromURL(url + '?v=' + Date.now());
    }


    avPlayer.on('metadata', onmetadata = function(data) {
      // console.log(data)
      $player.trigger('metadata', data);
    });

    avPlayer.on('duration', onduration = function(data) {
      // console.log('duration', data);
      duration = data;
    });

    avPlayer.on('buffer', onbuffer = function(percent) {
      $player.trigger('buffer', percent);
    });

    avPlayer.on('progress', onprogress = function(seekTime) {
      if (duration === 0) $player.trigger('progress', 100, seekTime, duration);
      else $player.trigger('progress', ((seekTime / duration) * 100), seekTime, duration);
    });

    avPlayer.on('end', onend = function() {
      $player.trigger('end');
    });

    avPlayer.on('ready', onready = function() {
      SHARED_CONTEXT = avPlayer.device.device.context;
      SHARED_PROCESSOR = avPlayer.device.device.node;
      connectSharedGain(SHARED_PROCESSOR);

      avPlayer.volume = 100;

      avPlayer.asset.demuxer.seek = function(timestamp) {
        var index, seekPoint;
        if (this.format && this.format.framesPerPacket > 0 && this.format.bytesPerPacket > 0) {
          seekPoint = {
            timestamp: timestamp,
            offset: this.format.bytesPerPacket * timestamp / this.format.framesPerPacket
          };
          return seekPoint;
        } else if (!this.seekPoints.length) {
          seekPoint = {
            timestamp: 0,
            offset: 0
          };
          return seekPoint;
        } else {
          index = this.searchTimestamp(timestamp);
          return this.seekPoints[index];
        }
      };

      /*context.decodeAudioData(avPlayer.asset.source.xhr.response,
        function(buffer) {
          displayWaveform(buffer.getChannelData(0));
        }
      );*/

      $player.trigger('ready', avPlayer);

    });

    /*avPlayer.asset.decodeToBuffer(function(arg) {
      console.log('decodeToBuffer');
      displayWaveform(arg);
    });*/

    avPlayer.on('error', onerror = function(data) {
      // console.log('error', data);
      $player.trigger('error', data);
    });

    var RESETED = false;

    return SHARED_PLAYER = {
      playing: function() {
        return avPlayer.playing
      },
      play: function() {
        if (RESETED) playAudio(url, blob);
        avPlayer.play();
      },
      pause: avPlayer.togglePlayback.bind(avPlayer),
      stop: function() {
        avPlayer.stop();
        RESETED = true;
      },
      destroy: function() {
        avPlayer.stop();
      },
      seek: function(time) {
        avPlayer.seek(time);
      },
      volume: playerDefault.volume
    };
  }


  /*
    8b    d8  dP"Yb  8888b.
    88b  d88 dP   Yb  8I  Yb
    88YbdP88 Yb   dP  8I  dY
    88 YY 88  YbodP  8888Y"
  */
  /////////////////////////////////////////////////////////////////////////////
  // mod
  // https://github.com/jhalme/webaudio-mod-player
  /////////////////////////////////////////////////////////////////////////////
  var modPlayer, timer;
  function playMod(url, blob) {

    var autoplay = false;

    if (modPlayer) {
      modPlayer.playing=false; // a precaution
      modPlayer.clearsong();
      modPlayer.ready=false;
    } else {
      modPlayer = new Protracker();
      modPlayer.sharedContext = SHARED_CONTEXT;
    }
    modPlayer.bufferstodelay=10;
    //modPlayer.setseparation(1);


    // var asset = AV.Asset.fromURL(url + '?v=' + Date.now());
    var asset;
    if (blob) {
      // console.log('blob', blob)
      asset = AV.Asset.fromFile(blob);
    } else {
      // cached tracks sadly cause player bug
      // https://github.com/audiocogs/aurora.js/issues/99
      asset = AV.Asset.fromURL(url + '?v=' + Date.now());
    }

    asset.source.on('data', function(buffer) {
      modPlayer.playing = false; // a precaution
      modPlayer.loading = true;
      modPlayer.clearsong();
      modPlayer.buffer = buffer.data;
      modPlayer.parse();
      if (autoplay) modPlayer.play();
      $player.trigger('metadata', {title: modPlayer.title});
    });
    var onbuffer;
    asset.on('buffer', onbuffer = function(percent) {
      $player.trigger('buffer', percent);
    });
    asset.start();



    modPlayer.onStop = function(){
      if (modPlayer.endofsong) {
        setTimeout(function() {
          $player.trigger('progress', 100);
          $player.trigger('end');
          stopTimer();
        }, 100);
      }
    };
    /*modPlayer.onProgress = function(){
      if (oldpos != modPlayer.position) {
        $player.trigger('progress', (modPlayer.position / modPlayer.songlen) * 100);
        oldpos = modPlayer.position;
      }
    };*/

    modPlayer.onReady = function(){
      duration = modPlayer.songlen;
      $player.trigger('metadata', {title: modPlayer.title});
      var jsonData = modData2Json(modPlayer);
      $player.trigger('ready', jsonData);
    };

    modPlayer.onPlay = function(){
      //console.log('mod play');
      SHARED_PROCESSOR = modPlayer.mixerNode;
      connectSharedGain(modPlayer.compressorNode);
      $player.trigger('play');
      startTimer();
    };

    var oldpos=-1;
    var secondPlayed = 0;
    var trustedTimer = true;
    var timer;
    function startTimer() {
      timer = setInterval(function() {
        secondPlayed = trustedTimer ? secondPlayed + 500 : -1;
        //if (oldpos != modPlayer.position) {
          $player.trigger('progress', (modPlayer.position / modPlayer.songlen) * 100, secondPlayed, null);
          //oldpos = modPlayer.position;
        //}
      }, 500);
    }
    function stopTimer() {
      clearInterval(timer);
    }

    return SHARED_PLAYER = {
      mod: true,
      playing: function() {
        return modPlayer.playing;
      },
      play: function() {
        if (modPlayer.ready) modPlayer.play();
        else autoplay = true;
      },
      pause: function() {
        if (modPlayer.playing) modPlayer.pause();
        stopTimer();
      },
      stop: function() {
        modPlayer.stop();
        //stopTimer();
      },
      destroy: function() {
        modPlayer.stop();
        stopTimer();
      },
      seek: function(seek) {
        trustedTimer = false;
        modPlayer.position = seek;
      },
      volume: playerDefault.volume
    };
  }

  /*
    Yb  dP 8b    d8 88""Yb
     YbdP  88b  d88 88__dP
     dPYb  88YbdP88 88"""
    dP  Yb 88 YY 88 88
  */
  /////////////////////////////////////////////////////////////////////////////
  // amd|s3m|xm|rad|hsc|it
  // https://github.com/wothke/libxmp-4.3.0
  /////////////////////////////////////////////////////////////////////////////
  var samplayer, scriptNode;
  function playXmp(url, blob) {

    if (!samplayer) samplayer = new SamplePlayer(SHARED_CONTEXT.sampleRate);

    samplayer.onEnd = function() {};
    var onEnd = function() {
      // console.log('end?');
      if (samplayer.playing) {
        // console.log('end2?');
        $player.trigger('end');
      }
    }

    samplayer.onMetadata = function() {
      $player.trigger('metadata', {
        title: samplayer.title,
        player: samplayer.player,
      });
    }

    samplayer.onReady = function(e) {
      //console.log(e);
      //displayWaveform(e);
      $player.trigger('ready', samplayer);
      $player.trigger('progress', 100);
      setTimeout(function() {
        samplayer.onEnd = onEnd;
      }, 500);
    }

    if (!scriptNode) {
      scriptNode = samplayer.createScriptProcessor(SHARED_CONTEXT);
      // scriptNode.onaudioprocess = function(arg) { 'use strict';
      //   console.log(arg)
      // }
    }

    SHARED_PROCESSOR = scriptNode;
    // SHARED_CONTEXT = scriptNode.context
    // console.log(SHARED_PROCESSOR)
    // console.log(SHARED_CONTEXT)
    connectSharedGain(SHARED_PROCESSOR);
    //SHARED_GAIN.gain.value = SHARED_VOLUME/100;

    // var asset = AV.Asset.fromURL(url + '?v=' + Date.now());

    var asset;
    if (blob) {
      // console.log('blob', blob)
      asset = AV.Asset.fromFile(blob);
    } else {
      // cached tracks sadly cause player bug
      // https://github.com/audiocogs/aurora.js/issues/99
      asset = AV.Asset.fromURL(url + '?v=' + Date.now());
    }

    asset.source.on('data', function(buffer) {
      samplayer.playSong(buffer.data, 0);
      //$player.trigger('ready', samplayer);
      //$player.trigger('progress', 100);
      //$player.trigger('buffer', 100);
    });
    var onbuffer;
    $player.trigger('buffer', 0);
    asset.on('buffer', onbuffer = function(percent) {
      $player.trigger('buffer', percent);
      //console.log(percent);
      /*if (percent === 100) {
        //console.log(asset);
        samplayer.playSong(asset.source.xhr.response, 0);
        $player.trigger('ready', samplayer);
        $player.trigger('progress', 100);
      }*/
    });
    //console.log(onbuffer);
    asset.start();

    samplayer.playing = false;
    return SHARED_PLAYER = {
      playing: function() {
        return samplayer.playing;
      },
      play: function() {
        samplayer.playing = true;
      },
      pause: function() {
        samplayer.playing = false;
      },
      stop: function() {
        //samplayer.stop();
        samplayer.playing = false;
        //asset.stop();
      },
      destroy: function() {
        //console.log('deztroy');
        samplayer.playing = false;
        samplayer.stop();
        asset.stop();
        //asset = samplayer = scriptNode = false;
        samplayer.onEnd = function() {};
      },
      seek: function(seek) {
        //modPlayer.position = seek;
      },
      volume: playerDefault.volume
    };
  }
  /////////////////////////////////////////////////////////////////////////////


  /*
    88""Yb 88        db    Yb  dP 888888 88""Yb
    88__dP 88       dPYb    YbdP  88__   88__dP
    88"""  88  .o  dP__Yb    8P   88""   88"Yb
    88     88ood8 dP""""Yb  dP    888888 88  Yb
  */
  /////////////////////////////////////////////////////////////////////////////
  // little function wrapper mess before the big refactoring
  /////////////////////////////////////////////////////////////////////////////
  function $player(url, bloburl) {
    // bloburl = bloburl || url;
    if (/((\/|^)mod\.|\.mod$)/i.test(url)) { // https://regex101.com/r/xF1qQ1/1
      //createSharedContext(playMod, url);
      return playMod(url, bloburl);
    } else if (/\.(amd|s3m|xm|rad|hsc|it)$/i.test(url)) {
      //createSharedContext(playXmp, bloburl);
      return playXmp(url, bloburl);
    } else {
      // console.log('bim', bloburl)
      return playAudio(url, bloburl);
    }
    //return $player;
  }

  $player = $watch($player);

  $player.play = function() {
    if (!SHARED_PLAYER.playing()) {
      SHARED_PLAYER.play();
      $player.trigger('play');
    }
  }
  $player.mod = function() {
    return SHARED_PLAYER.mod;
  }
  $player.pause = function() {
    SHARED_PLAYER.pause();
    $player.trigger('pause');
  }
  $player.playing = function() {
    return SHARED_PLAYER.playing();
  }
  $player.stop = function() {

    function stopNow() {
      SHARED_PLAYER.stop();
      SHARED_PLAYER.seek(0);
      $player.trigger('progress', 0);
      $player.trigger('stop');
    }
    stopNow();

    /*var iter = 0;
    var oldVolume = SHARED_PLAYER.volume();
    //console.log(volume);
    if (oldVolume) {
      var fadeOut = setInterval(function() {
        iter++;
        var newVolume = oldVolume-iter;
        SHARED_PLAYER.volume(newVolume);
        if (newVolume <= 0) {
          clearInterval(fadeOut);
          stopNow();
          setTimeout(function() {
            SHARED_PLAYER.volume(oldVolume);
          }, 500);
        }
      }, 15);
    } else {
      stopNow();
    }*/
  }
  $player.seek = function(percent) {
    var seek = ~~((duration / 100) * percent);
    SHARED_PLAYER.seek(seek);
  }
  $player.volume = function(percent) {
    SHARED_VOLUME = percent;
    if (SHARED_GAIN) return SHARED_PLAYER.volume(percent);
  }
  $player.destroy = function() {
    SHARED_PLAYER.destroy();
    $player.trigger('metadata', {title: 'loading...'});
    $player.trigger('progress', 0);
    $player.trigger('buffer', 0);
    SHARED_PLAYER = playerDefault;
  }
  $player.ok = true;

  /*
    88""Yb 888888    db    88  dP     8888b.  888888 888888 888888  dP""b8 888888 88  dP"Yb  88b 88
    88__dP 88__     dPYb   88odP       8I  Yb 88__     88   88__   dP   `"   88   88 dP   Yb 88Yb88
    88"""  88""    dP__Yb  88"Yb       8I  dY 88""     88   88""   Yb        88   88 Yb   dP 88 Y88
    88     888888 dP""""Yb 88  Yb     8888Y"  888888   88   888888  YboodP   88   88  YbodP  88  Y8
  */
  function getAverage(frequency, fft) {
    var
      sum = 0,
      freq = frequency[ 0 ],
      endFreq = frequency[ 1 ]
    ;
    if ( endFreq !== undefined ) {
      for ( var i = freq; i <= endFreq; i++ ) {
        sum += fft[ i ];
      }
      return sum / ( endFreq - freq + 1 );
    } else {
      return fft[ freq ];
    }
  }
  function getMax(frequency, fft) {
    var max = 0;
    for ( var i = frequency[ 0 ], l = frequency[ 1 ]; i <= l; i++ ) {
      if ( fft[ i ] > max ) { max = fft[ i ]; }
    }
    return max;
  }
  var Peack = function ( o ) {
    o = o || {};
    this.frequency = o.frequency !== undefined ? o.frequency : [ 0, 5 ];
    this.threshold = o.threshold !== undefined ? o.threshold :  10;
    this.decay     = o.decay     !== undefined ? o.decay     :  0.8;
    this.current = this.threshold;
  };
  Peack.prototype.update = function(fft) {
    var max = 0;
    for ( var i = this.frequency[ 0 ], l = this.frequency[ 1 ]; i <= l; i++ ) {
      if ( fft[ i ] > max ) { max = fft[ i ]; }
    }
    if ( max >= this.current && max >= this.threshold ) {
      this.current = max;
    } else {
      this.current -= this.decay;
    }
    return this.current > this.threshold;
  }
  $player.createPeack = function(opt) {
    return new Peack(opt)
  }

  var Kick = function ( o ) {
    o = o || {};
    this.threshold = 150;
    this.difference = 10;
    this.frequency = [ 0, 3 ];
    this.maxDecay  = 0.09;
    this.minDecay  = 0.09;

    this.current = this.threshold;
    this.average = this.threshold;
    this.max = this.threshold;
    this.min = this.threshold;
  };

  Kick.prototype.update = function(fft) {

    //var max = getAverage(this.frequency, fft);
    var max = getMax(this.frequency, fft);
    var couldBeKick = false;
    if (max < 2) return false;

    this.current = max;

    if (this.current > this.average) {
      this.max -= (max > this.max) ? -5 : 0;
      this.min += (max < this.min) ? -5 : 1;
      couldBeKick = true;
    } else {
      this.max -= (max > this.max) ? -5 : this.maxDecay;
      this.min += (max < this.min) ? -5 : this.minDecay;
    }

    if (this.min < this.threshold) this.min = this.threshold;
    this.average = (this.max + this.min) / 2;

    return couldBeKick && (this.max - this.min > this.difference);
  }
  $player.createKick = function(opt) {
    return new Kick(opt)
  }


  /*
    Yb    dP 88 .dP"Y8 88   88    db    88     88 8888P    db    888888 88  dP"Yb  88b 88
     Yb  dP  88 `Ybo." 88   88   dPYb   88     88   dP    dPYb     88   88 dP   Yb 88Yb88
      YbdP   88 o.`Y8b Y8   8P  dP__Yb  88  .o 88  dP    dP__Yb    88   88 Yb   dP 88 Y88
       YP    88 8bodP' `YbodP' dP""""Yb 88ood8 88 d8888 dP""""Yb   88   88  YbodP  88  Y8
  */
  /////////////////////////////////////////////////////////////////////////////

  $player.on('end stop pause', function(data) {
    stopDrawing();
  });
  $player.on('play ready', function(data) {
    //if (!ANIMLOOP && SHARED_CONTEXT && SHARED_PROCESSOR) startDrawing();
    startDrawing();
  });

  // sinewave, frequencybars, spectrogram
  /////////////////////////////////////////////////////////////////////////////
  function Analyser(opt) {
    this.analyser = null;
    this.frequencyData = [];
    this.timeDomainData = [];
    if (opt) this.connect(opt);
  }
  Analyser.prototype.connect = function(opt) {
    this.analyser = SHARED_CONTEXT.createAnalyser();
    var cfg = $extend({
      smoothingTimeConstant: 0.7,
      fftSize: 2048,
      minDecibels: -100,
      maxDecibels: -30
    }, opt);
    this.analyser.smoothingTimeConstant = cfg.smoothingTimeConstant;
    this.analyser.fftSize = cfg.fftSize;
    this.analyser.minDecibels = cfg.minDecibels;
    this.analyser.maxDecibels = cfg.maxDecibels;

    SHARED_PROCESSOR.connect(this.analyser);
    this.frequencyData = new Uint8Array(this.analyser.frequencyBinCount);
    this.timeDomainData = new Uint8Array(this.analyser.frequencyBinCount);
  };
  Analyser.prototype.disconnect = function() {
    this.analyser = null;
    this.frequencyData = [];
    this.timeDomainData = [];
  };
  Analyser.prototype.sinewave = function() {
    this.analyser.getByteTimeDomainData(this.timeDomainData);
    return this.timeDomainData;
  };
  Analyser.prototype.frequency = function() {
    this.analyser.getByteFrequencyData(this.frequencyData);
    return this.frequencyData;
  };
  //window.Analyser = Analyser;
  $player.createAnalyser = function(opt) {
    return new Analyser(opt);
  }
  /////////////////////////////////////////////////////////////////////////////

  var analyser;
  var ANIMLOOP;
  var frequencyData, timeDomainData;
  //var lastUpdate = 0;
  function startDrawing() {
    stopDrawing();
    if (SHARED_CONTEXT && SHARED_PROCESSOR && $player.observers.visualization && $player.observers.visualization.length) {
      var analyser = new Analyser({fftSize: 512, maxDecibels:-5, minDecibels:-110});
      draw();
    }
    function draw(now) {
      ANIMLOOP = requestAnimationFrame(draw);
      //$player.trigger('visualization', analyser.frequency(), analyser.sinewave(), (now - lastUpdate) / 1000);
      $player.trigger('visualization', analyser.frequency(), analyser.sinewave(), now);
      //lastUpdate = performance.now();
    }
  }
  function stopDrawing() {
    if (ANIMLOOP) cancelAnimationFrame(ANIMLOOP);
    ANIMLOOP = null;
  }
  /////////////////////////////////////////////////////////////////////////////


  /*
    Yb        dP    db    Yb    dP 888888 888888  dP"Yb  88""Yb 8b    d8
     Yb  db  dP    dPYb    Yb  dP  88__   88__   dP   Yb 88__dP 88b  d88
      YbdPYbdP    dP__Yb    YbdP   88""   88""   Yb   dP 88"Yb  88YbdP88
       YP  YP    dP""""Yb    YP    888888 88      YbodP  88  Yb 88 YY 88
  */
  /////////////////////////////////////////////////////////////////////////////
  var canvasWaveform, ctxWaveform, colorWaveform, callbackWaveform;
  $player.displayWaveform = function(canvas, color, cb) {
    canvasWaveform = canvas;
    colorWaveform = color;
    callbackWaveform = cb;
  }

  function displayWaveform(buff) {
    // thanks : http://stackoverflow.com/a/22103150

    if (canvasWaveform) {
      ctxWaveform = canvasWaveform.getContext('2d');
      spectrumW = canvasWaveform.clientWidth;
      spectrumH = canvasWaveform.clientHeight;

      var resampled = new Float64Array(spectrumW * 2 );
      var i=0, j=0, buckIndex = 0;
      var thisValue=0, res=0;
      var sampleCount = buff.length;
      // first pass for mean
      for (i=0; i<sampleCount; i+=5) {
        // in which bucket do we fall ?
        buckIndex = 0 | ( spectrumW * i / sampleCount );
        buckIndex *= 2;
        // positive or negative ?
        thisValue = buff[i];
        if (thisValue>0) {
          resampled[buckIndex    ] += thisValue;
          resampled[buckIndex + 1] +=1;
        }
      }

      var SPACER_WIDTH = 1;
      var BAR_WIDTH = 1;

      renderCanvas(resampled);

    }

    function renderCanvas(resampled) {
      ctxWaveform.clearRect(0, 0, spectrumW, spectrumH);
      ctxWaveform.fillStyle = colorWaveform;
      for (var i=0; i< spectrumW; i++) {
        j=i*2;
        // compute mean now
        if (resampled[j+1]!= 0)  resampled[j] /= resampled[j+1];
        var magnitude = spectrumH * (resampled[j] );
        var y = spectrumH - ((spectrumH/2) - magnitude);
        var h = (spectrumH - y*2)+1;
        ctxWaveform.fillRect(i, ~~y, BAR_WIDTH, ~~(h)+1);
      }
      callbackWaveform();
    }
  }
  /////////////////////////////////////////////////////////////////////////////

  /*
    8b    d8  dP"Yb  8888b.  8888b.     db    888888    db    oP"Yb.  88888 .dP"Y8  dP"Yb  88b 88
    88b  d88 dP   Yb  8I  Yb  8I  Yb   dPYb     88     dPYb   "' dP'     88 `Ybo." dP   Yb 88Yb88
    88YbdP88 Yb   dP  8I  dY  8I  dY  dP__Yb    88    dP__Yb    dP'  o.  88 o.`Y8b Yb   dP 88 Y88
    88 YY 88  YbodP  8888Y"  8888Y"  dP""""Yb   88   dP""""Yb .d8888 "bodP' 8bodP'  YbodP  88  Y8
  */
  /////////////////////////////////////////////////////////////////////////////
  function modData2Json(modData) { 'use strict';
    var notelist = ['C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B'];
    var pdata = [], sdata = [], shtml = [];

    function hb(n) {
      var s=n.toString(16);
      if (s.length==1) s='0'+s;
      return s;
    }

    function pad(s,l) {
      var ps=s;
      if (ps.length > l) ps=ps.substring(0,l-1);
      while (ps.length < l) ps+=" ";
      return ps;
    }

    function getNote(n) {
      var trackerNote = notelist[n%12];
      return (trackerNote + (trackerNote.length==1 ? '-' : ''))+Math.floor(1+n/12)
    }

    function notef(n,s,c,d,cc) {
      return {
        note: n ? getNote(n) : '',
        sample: s ? hb(s) : '',
        command: c.toString(16)+hb(d)
      }
    }

    for(i=0;i<31;i++) {
      sdata.push(pad(modData.sample[i].name, 22));
    }

    for(var p=0; p < modData.patterns; p++) {
      var pp, pd = {hexa: hb(p), rows: []};
      for(var i=0; i<64; i++) {
        var ch = [];
        pp=i*4*modData.channels;
        for(var c=0; c < modData.channels; c++) {
          ch[c] = notef(modData.note[p][i*modData.channels+c], (modData.pattern[p][pp+0]&0xf0 | modData.pattern[p][pp+2]>>4), modData.pattern[p][pp+2]&0x0f, modData.pattern[p][pp+3]);
          pp+=4;
        }
        pd.rows.push({hexa:hb(i), channels: ch});
      }
      pdata.push(pd);
    }

    return {patterns: pdata, samples:sdata, player: modData, toHexa: hb, getNote: getNote}
  }
  /////////////////////////////////////////////////////////////////////////////

  global.$player = $player;
}(this);
