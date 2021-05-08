
var basePath= '';
var songs = [
	'music/getup.rad',
	'music/zap.rad',
	'music/traced_d.amd',
	'music/adlib.s3m',
	'music/1power.amd',


	'music/HIJACK.AMD',
	'music/adattack.rad',
	'music/adlibsp.rad',

	'music/castra.hsc',
	'music/con-girl.amd',
	'music/crystal2.rad',
	'music/dirtyold.amd',
	'music/eternity.amd',
	'music/intovoid.rad',
	'music/laugh.amd',
	'music/moonwalk.amd',

	'music/ork.rad',
	'music/prian.amd',
	'music/spass.amd',
	'music/star.amd',
	'music/subwave.rad',
	'music/zap.rad',
	'music/wasted.s3m',
	'music/traced_d.amd',
	'music/peloponn.s3m',
	'music/J-ETRNTY.S3M',
	'music/adlib.s3m',
	'music/animal-comitek_bbs_intro_tune.amd',
	'music/69424-acidrain.s3m',
		'music/popcorn.s3m',

];

var player= new SamplePlayer(basePath, doOnEnd, doOnUpdate);

function doOnEnd(){ audio.playNextSong(); player.isPaused= false; }
function doOnUpdate(){ 
	audio.initialAudioSetup();
	audio.startMusicPlayback();		
}

// ---------------------------- WebAudio stuff ----------------------------

Audio = function(songs) {
	this.audioCtx;
	this.bufferSource;
	this.gainNode;
	this.analyzerNode;
	
	this.current=-1;
	this.someSongs= songs;
	this.isReady= false;
	
	// preload all the intrastructure files so we won't run into async load issues later
	var files = [
		"res/icepatch.003",		// needed for SCI - HACK: each SCI file need its own *patch.003 file, i.e. when used in a playlist 1st list the .003 file so it gets loaded
		"res/insts.dat",		// needed for KSM
		"res/standard.bnk",		// needed for ROL
		"res/adplug.db"
	];		
	var f= window.player['preloadFiles'].bind(window.player);
	f(files, function() {
		this.isReady= true;
		this.playNextSong();
		
	}.bind(this));
};

Audio.prototype = {
	initialAudioSetup: function() {
		if (typeof this.bufferSource != 'undefined') { 
			this.bufferSource.stop(0);
		} else {
			this.setupAudioNodes();
		}
	},
	setupAudioNodes: function() {
		if (typeof this.audioCtx == 'undefined') {
			try {
				window.AudioContext = window.AudioContext||window.webkitAudioContext;
				this.audioCtx = new AudioContext();
			} catch(e) {
				alert('Web Audio API is not supported in this browser (get Chrome 18 or Firefox 26)');
			}
			this.analyzerNode = this.audioCtx.createAnalyser();

			var scriptNode= player.createScriptProcessor(this.audioCtx);
			
			this.gainNode = this.audioCtx.createGain();
						
			scriptNode.connect(this.gainNode);
			this.gainNode.connect(this.analyzerNode);
			this.analyzerNode.connect(this.audioCtx.destination);
		}
	},
	
	removeFromPlaylist: function(songname) {
		if (this.someSongs[this.current] == songname) {
			this.someSongs.splice(this.current, 1);
			if (this.current + 1 == this.someSongs.length) this.current= 0;
		}
	},
	playNextSong: function() {
		if (this.isReady && this.someSongs.length) {	
			this.current= (++this.current >=this.someSongs.length) ? 0 : this.current;
			var someSong= this.someSongs[this.current];
			this.playSong(someSong);
		}
	},
	playPreviousSong: function() {
		if (this.isReady && this.someSongs.length) {	
			this.current= (--this.current<0) ? this.current+this.someSongs.length : this.current;
			var someSong= this.someSongs[this.current];
			this.playSong(someSong);
		}
	},
	playSong: function(someSong) {
		var arr= someSong.split(";");	
		var track= arr.length>1?parseInt(arr[1]):0;
		var fn= arr[0];
		
		var xhr = new XMLHttpRequest();
		xhr.open("GET", someSong, true);
		xhr.responseType = "arraybuffer";
		xhr.onload = function (oEvent) {		
				if(!player.playSong(fn, xhr.response, track)) {
					this.removeFromPlaylist(someSong);	// no point trying to play this again
				}		
		}.bind(this);
		xhr.send(null);
	},
	startMusicPlayback: function() {
		player.isPaused= false;

		if (typeof this.bufferSource === 'undefined') {
			this.bufferSource = this.audioCtx.createBufferSource();
			if (!this.bufferSource.start) {
			  this.bufferSource.start = this.bufferSource.noteOn;
			  this.bufferSource.stop = this.bufferSource.noteOff;
			}
			this.bufferSource.start(0);		
		}
	}
};

function initFM() {
	audio= new Audio(songs);
	

	/*
	document.getElementById("previous").onclick = audio.playPreviousSong.bind(audio);
	document.getElementById("next").onclick = audio.playNextSong.bind(audio);
			
	document.getElementById("play").onclick = function(e){
		player.isPaused= false;
	};
	document.getElementById("pause").onclick = function(e){
		player.isPaused= true;
	};
	document.getElementById("gain").onchange = function(e){
		audio.gainNode.gain.value= this.value/255;
	};
	*/

	audio.playNextSong();
}
