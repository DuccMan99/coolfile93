/**
* sample_player.js
* version 1.0 (xmp)
*
* 	Copyright (C) 2014 Juergen Wothke
*
* Terms of Use: This software is licensed under a CC BY-NC-SA 
* (http://creativecommons.org/licenses/by-nc-sa/4.0/).
*/

var fetchSamples= function(e) { 		
	// it seems that it is necessary to keep this explicit reference to the event-handler
	// in order to pervent the dumbshit Chrome GC from detroying it eventually
	
	var f= window.player['genSamples'].bind(window.player); // need to re-bind the instance.. after all this 
															// joke language has no real concept of OO	
	f(e);
};


SamplePlayer = function(bp, onEnd, onUpdate) {
	this.title;
	this.author;
	this.desc;
	this.player;
	this.speed;
	this.tracks;

	this.basePath= bp;
	this.isPaused= false;
	this.initialized= false;
	
	this.onEnd= onEnd;
	this.onUpdate= onUpdate;
	
	this.sourceBuffer;
	this.sourceBufferLen;

	this.numberOfSamplesRendered= 0;
	this.numberOfSamplesToRender= 0;
	this.sourceBufferIdx=0;	
	
	this.binaryFileMap = {};	// cache for loaded "file" binaries
	this.pendingFileMap = {};	

	this.isWaitingForFile= false;
	this.initInProgress=false;

	try {
		window.AudioContext = window.AudioContext||window.webkitAudioContext;
		this.sampleRate = new AudioContext().sampleRate;
	} catch(e) {
		alert('Web Audio API is not supported in this browser (get Chrome 18 or Firefox 26)');
	}

	this.SAMPLES_PER_BUFFER = 8192;	// allowed: buffer sizes: 256, 512, 1024, 2048, 4096, 8192, 16384
	
	window.player= this;
};

SamplePlayer.prototype = {
	createScriptProcessor: function(audioCtx) {
		var scriptNode = audioCtx.createScriptProcessor(this.SAMPLES_PER_BUFFER, 0, 2);
		scriptNode.onaudioprocess = fetchSamples;
	//	scriptNode.onaudioprocess = player.generateSamples.bind(player);	// doesn't work with dumbshit Chrome GC
		return scriptNode;
	},
	playSong: function (filename, data, track) {
		this.isPaused= true;
		if (this.loadData(filename, data) == 0) {
			this.selectTrack(filename, track);
			
			this.onUpdate();
			
			this.isPaused= false;
			return true;
		}
		
		return false;
	},
	playTmpFile: function (file) {
		var reader = new FileReader();
		reader.onload = function() {
			this.playSong(file.name, reader.result, 0);
		}.bind(this);
		reader.readAsArrayBuffer(file);
	},
	
	preloadFiles: function(files, onCompletionHandler) {
		// avoid the async trial&error loading for those
		// files that we already know we'll be needing
		this.isPaused= true;
		this.preload(files, files.length, onCompletionHandler);
	},
	
	preload: function(files, id, onCompletionHandler) {
		if (id == 0) {
			// we are done preloading
			onCompletionHandler();
		} else {
			id--;
			var funcCompleted= function() {this.preload(files, id, onCompletionHandler);}.bind(this); // trigger next load
			return this.preloadFile(files[id], funcCompleted);	
		}
	},
	preloadFile: function (filename, onLoadedHandler) {
		if (filename in this.binaryFileMap)	{
			// the respective file has already been setup
			if (this.binaryFileMap[filename]) {	
			
				return 0;
			}
			return 1;	// error file does not exist
		}
		// Emscripten will be stuck without this file and we better make 
		// sure to not use it before it has been properly reinitialized
		this.isPaused= true;
		this.isWaitingForFile= true;
		this.initialized= false;
		
		
		// requested data not available.. we better load it for next time
		if (!(filename in this.pendingFileMap)) {		// avoid duplicate loading
		
			this.pendingFileMap[filename] = 1;

			var oReq = new XMLHttpRequest();
			oReq.open("GET", filename, true);
			oReq.responseType = "arraybuffer";

			oReq.onload = function (oEvent) {
				var arrayBuffer = oReq.response;
				if (arrayBuffer) {
					console.log("loaded file: "+filename);

				// setup data in our virtual FS (the next access should then be OK)
					var d= new Uint8Array(arrayBuffer);	

					var sp = filename.split('/');	// avoid folders in our virtual Emscripten fs
					var fn = sp[sp.length-1];					
					
					var f= Module.FS_createDataFile("/", fn, d, true, true);
					this.binaryFileMap[filename]= f;
					
					// now that we have an additional file loaded we can retry the initialization
					this.isWaitingForFile= false;

					onLoadedHandler();
				}
				delete this.pendingFileMap[filename]; 
			}.bind(this);
			oReq.onreadystatuschange = function (oEvent) {
			  if (oReq.readyState==4 && oReq.status==404) {
				this.binaryFileMap[filename]= 0;	// file not found
				this.isWaitingForFile= false;
			  }
			}.bind(this);
			oReq.onerror  = function (oEvent) {
				this.binaryFileMap[filename]= 0;	// marker for non existing file
				this.isWaitingForFile= false;
			}.bind(this);

			oReq.send(null);
		}
		return -1;	
	},	
	
	
	loadData: function(filename, arrayBuffer) {
		if(!this.initialized) {
			this.initialized= true;
		} else {
			Module.ccall('emu_teardown', 'number');	// just in case
		}

		if (arrayBuffer) {
			var byteArray = new Uint8Array(arrayBuffer);

			var sp = filename.split('/');
			var fn = sp[sp.length-1];
			var path= '/'; // make it flat... filename.substring(0, filename.lastIndexOf("/"));	if (path.lenght) path= path+"/";
			
			// create a virtual emscripten FS for all the songs that are touched.. so the compiled code will
			// always find what it is looking for.. some players will look to additional resource files in the same folder..
			
			try {
				Module.FS_createDataFile(path, fn, byteArray, true, true);
			} catch(err) {
				// file may already exist, e.g. drag/dropped again.. just keep entry
			}
		
			// load the song's binary data
			var ret = Module.ccall('emu_init', 'number', 
								['number', 'string', 'string'], 
								[this.sampleRate, path, fn]);
			
			return ret;
		}
	},
	updateTrackInfos: function(filename) {
		ret = Module.ccall('emu_get_track_info', 'number');
		
		var array = Module.HEAP32.subarray(ret>>2, (ret>>2)+6);
		this.title= Module.Pointer_stringify(array[0]);
		if (!this.title.length) this.title= filename;		
		this.author= Module.Pointer_stringify(array[1]);		
		this.desc= Module.Pointer_stringify(array[2]);
		this.player= Module.Pointer_stringify(array[3]);
		this.speed= Module.Pointer_stringify(array[4]);
		this.tracks= Module.Pointer_stringify(array[5]);
	},
	selectTrack: function(filename, id) {
		ret = Module.ccall('emu_set_subsong', 'number', ['number'], [id]);
			
		this.updateTrackInfos(filename);	  
	},
	genSamples: function(event) {
		var output1 = event.outputBuffer.getChannelData(0);
		var output2 = event.outputBuffer.getChannelData(1);

		if (this.isPaused) {
			var i;
			for (i= 0; i<output1.length; i++) {
				output1[i]= 0;
				output2[i]= 0;
			}		
		} else {
			var outSize= output1.length;
			
			this.numberOfSamplesRendered = 0;		

			while (this.numberOfSamplesRendered < outSize)
			{
				if (this.numberOfSamplesToRender == 0) {
				
					var status = Module.ccall('emu_compute_audio_samples', 'number');
					if (status != 0) {
console.log("genSamples no frame left - pausing now");					
						// no frame left
						this.fillEmpty(outSize, output1, output2);	
						if (this.onEnd) this.onEnd();
						this.isPaused= true;
						return;
					}
					// refresh just in case they are not using one fixed buffer..
					this.sourceBuffer= Module.ccall('emu_get_audio_buffer', 'number');
					this.sourceBufferLen= Module.ccall('emu_get_audio_buffer_length', 'number')/4;
					
					this.numberOfSamplesToRender = this.sourceBufferLen;
					this.sourceBufferIdx=0;			
				}
				
				var srcBufI16= this.sourceBuffer>>1;	// 2 x 16 bit samples
				if (this.numberOfSamplesRendered + this.numberOfSamplesToRender > outSize) {
					var availableSpace = outSize-this.numberOfSamplesRendered;
					
					var i;
					for (i= 0; i<availableSpace; i++) {
						var r16= Module.HEAP16[srcBufI16 + (this.sourceBufferIdx++)];
						var l16= Module.HEAP16[srcBufI16 + (this.sourceBufferIdx++)];
						output1[i+this.numberOfSamplesRendered]= r16/0x7fff;
						output2[i+this.numberOfSamplesRendered]= l16/0x7fff;
					}				
					this.numberOfSamplesToRender -= availableSpace;
					this.numberOfSamplesRendered = outSize;
				} else {
					var i;
					for (i= 0; i<this.numberOfSamplesToRender; i++) {
						var r16= Module.HEAP16[srcBufI16 + (this.sourceBufferIdx++)];
						var l16= Module.HEAP16[srcBufI16 + (this.sourceBufferIdx++)];
						output1[i+this.numberOfSamplesRendered]= r16/0x7fff;
						output2[i+this.numberOfSamplesRendered]= l16/0x7fff;
					}						
					this.numberOfSamplesRendered += this.numberOfSamplesToRender;
					this.numberOfSamplesToRender = 0;
				} 
			}  
		}	
	},
	fillEmpty: function(outSize, output1, output2) {
		var availableSpace = outSize-this.numberOfSamplesRendered;
		for (i= 0; i<availableSpace; i++) {
			output1[i+this.numberOfSamplesRendered]= 0;
			output2[i+this.numberOfSamplesRendered]= 0;
		}				
		this.numberOfSamplesToRender = 0;
		this.numberOfSamplesRendered = outSize;			
	}
};