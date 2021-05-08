// main block for EstyJs
// written by Darren Coles

function EstyJs(output) {

	//var d = new Date();
	//var startTime = d.getTime();
	//var lastFrame = startTime;
    var frameCount = 0;
    var lastFrame = window.performance.now();

	var running = true;

	var soundEnabled = true;

	var requestAnimationFrame = (
		//window.requestAnimationFrame || window.msRequestAnimationFrame ||
		//window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame ||
		//window.oRequestAnimationFrame ||
		function(callback) {
			setTimeout(function() {
				callback();
			}, 20);
		}
	);

	var self = {};

	var firstFrame = true;

	var bug = EstyJs.bug({
	});

	var fileManager = EstyJs.fileManager({
	});


	var mfp = EstyJs.mfp( {
		bug: bug
	});

    var keyboard = EstyJs.Keyboard({
		mfp: mfp,
		control: output
	});

    var fdc = EstyJs.fdc({
        bug: bug,
        fileManager: fileManager,
        mfp: mfp
    });

    var sound = EstyJs.Sound({
        fdc: fdc
    });

    var io = EstyJs.io({
		sound : sound,
		bug: bug,
		mfp: mfp,
		fdc: fdc,
		keyboard: keyboard
	});

	var memory = EstyJs.Memory({
		io: io,
		bug: bug
	});


	var processor = EstyJs.Processor({
		memory : memory,
		mfp : mfp,
		bug: bug
	});

	var display = EstyJs.Display({
		memory : memory,
		io : io,
		fdc : fdc,
		processor : processor,
		output: output
	});

	var snapshot = EstyJs.SnapshotFile({
		memory : memory,
		io : io,
		display: display,
		keyboard: keyboard,
		mfp: mfp,
		processor: processor,
        fileManager : fileManager
	});

    mfp.setDisplay(display);
    fdc.setMemory(memory);
	io.setDisplay(display);
	processor.setup();
	sound.setProcessor(processor);
	memory.setProcessor(processor);

	setTimeout(runframe, 20);
	//requestAnimationFrame(runframe);

	function runframe() {
		if (running & memory.loaded==1) {
			if (firstFrame) {
				self.reset();
				firstFrame = false;
			}
            var currTime = window.performance.now();

			//var reqFrames = (currTime - startTime)/20;
			//while (frameCount< reqFrames)
			{
				display.startFrame();
				sound.startFrame();
				processor.vblInterrupt();
				while (display.beamRow<313) {
					display.startRow();
					mfp.startRow();
					processor.hblInterrupt();
					processor.runCode();
					display.processRow();
					fdc.processRow();
					sound.processRow();
					//fix: knightmare - HACK! delay keyboard processing
					if (!(display.beamRow & 3)) keyboard.processRow();
					mfp.endRow();
				}
				sound.endFrame(soundEnabled);
				frameCount++;
			}
        }
        display.setFrameRate(Math.floor(2000 / Math.max(20, window.performance.now() - currTime)));

		var nextframe = Math.max(1,20-(window.performance.now()-currTime));

		setTimeout(runframe, nextframe );
	}

	self.reset = function(){
		memory.reset();
		display.reset();
		sound.reset();
		processor.reset(0);

	};

	self.pauseResume = function() {
		running = !running;
		return running;
	}

	self.soundToggle = function() {
		soundEnabled = !soundEnabled;
		return soundEnabled;
	}

    self.openSnapshotFile = function (file) {
		snapshot.loadSnapshot(file);
	}

	// http://windows93.net/c/files/roms/atarist/r0x.st
	// estyjs.openFloppyFile('A','/c/files/roms/atarist/r0x.st')
	// estyjs.openFloppyFile('A','/c/files/roms/atarist/games/Vroom (1991)(Lankhor).st')
	// estyjs.openFloppyFile('A','/c/files/roms/atarist/games/JunkDemo.st')
	// estyjs.openSnapshotFile('A','/c/files/roms/atarist/games/speedball2.sts')
    self.openFloppyFile = function (drive,file) {
        fdc.loadFile(drive,file);
    }

    self.openZipFile = function (drive, file) {
        function zipCallback(files) {
            for (var i = 0; i < files.length; i++) {
                var fname = files[i];
                var ext = fname.substr(fname.lastIndexOf('.')).toLowerCase();
                if (ext == '.sts') {
                    snapshot.loadSnapshot(file);
                    break;
                }
                if (ext == '.st') {
                    fdc.loadFile(drive, file);
                    break;
                }
            }
        }

        fileManager.getZipFilenames(file,zipCallback);
    }

    self.setJoystick = function (joyEnabled) {
		keyboard.KeypadJoystick = joyEnabled;
	}

	self.setMemory = function (mem1mb) {
	    if (mem1mb) {
	        memory.setMemSize(1024);
	        io.setRamBanks(2);
	    } else {
	        memory.setMemSize(512);
	        io.setRamBanks(1);
	    }
	    this.reset();
	}

	self.lockMouse = function () {
	    keyboard.lockMouse();
	}

	self.getMouseLocked = function() {
        return keyboard.mouseLocked();
	}

	return self;
}
