// resampler.js
/////////////////////////////////////////////////////////////////////////////
/*
 * This resampler is from XAudioJS: https://github.com/grantgalitz/XAudioJS
 * Planned to be replaced with src.js, eventually: https://github.com/jussi-kalliokoski/src.js
 */

//JavaScript Audio Resampler (c) 2011 - Grant Galitz
function Resampler(fromSampleRate, toSampleRate, channels, outputBufferSize, noReturn) {
	this.fromSampleRate = fromSampleRate;
	this.toSampleRate = toSampleRate;
	this.channels = channels | 0;
	this.outputBufferSize = outputBufferSize;
	this.noReturn = !!noReturn;
	this.initialize();
}
Resampler.prototype.initialize = function () {
	//Perform some checks:
	if (this.fromSampleRate > 0 && this.toSampleRate > 0 && this.channels > 0) {
		if (this.fromSampleRate == this.toSampleRate) {
			//Setup a resampler bypass:
			this.resampler = this.bypassResampler;		//Resampler just returns what was passed through.
			this.ratioWeight = 1;
		}
		else {
			if (this.fromSampleRate < this.toSampleRate) {
				/*
					Use generic linear interpolation if upsampling,
					as linear interpolation produces a gradient that we want
					and works fine with two input sample points per output in this case.
				*/
				this.compileLinearInterpolationFunction();
				this.lastWeight = 1;
			}
			else {
				/*
					Custom resampler I wrote that doesn't skip samples
					like standard linear interpolation in high downsampling.
					This is more accurate than linear interpolation on downsampling.
				*/
				this.compileMultiTapFunction();
				this.tailExists = false;
				this.lastWeight = 0;
			}
			this.ratioWeight = this.fromSampleRate / this.toSampleRate;
			this.initializeBuffers();
		}
	}
	else {
		throw(new Error("Invalid settings specified for the resampler."));
	}
}
Resampler.prototype.compileLinearInterpolationFunction = function () {
	var toCompile = "var bufferLength = buffer.length;\
	var outLength = this.outputBufferSize;\
	if ((bufferLength % " + this.channels + ") == 0) {\
		if (bufferLength > 0) {\
			var ratioWeight = this.ratioWeight;\
			var weight = this.lastWeight;\
			var firstWeight = 0;\
			var secondWeight = 0;\
			var sourceOffset = 0;\
			var outputOffset = 0;\
			var outputBuffer = this.outputBuffer;\
			for (; weight < 1; weight += ratioWeight) {\
				secondWeight = weight % 1;\
				firstWeight = 1 - secondWeight;";
	for (var channel = 0; channel < this.channels; ++channel) {
		toCompile += "outputBuffer[outputOffset++] = (this.lastOutput[" + channel + "] * firstWeight) + (buffer[" + channel + "] * secondWeight);";
	}
	toCompile += "}\
			weight -= 1;\
			for (bufferLength -= " + this.channels + ", sourceOffset = Math.floor(weight) * " + this.channels + "; outputOffset < outLength && sourceOffset < bufferLength;) {\
				secondWeight = weight % 1;\
				firstWeight = 1 - secondWeight;";
	for (var channel = 0; channel < this.channels; ++channel) {
		toCompile += "outputBuffer[outputOffset++] = (buffer[sourceOffset" + ((channel > 0) ? (" + " + channel) : "") + "] * firstWeight) + (buffer[sourceOffset + " + (this.channels + channel) + "] * secondWeight);";
	}
	toCompile += "weight += ratioWeight;\
				sourceOffset = Math.floor(weight) * " + this.channels + ";\
			}";
	for (var channel = 0; channel < this.channels; ++channel) {
		toCompile += "this.lastOutput[" + channel + "] = buffer[sourceOffset++];";
	}
	toCompile += "this.lastWeight = weight % 1;\
			return this.bufferSlice(outputOffset);\
		}\
		else {\
			return (this.noReturn) ? 0 : [];\
		}\
	}\
	else {\
		throw(new Error(\"Buffer was of incorrect sample length.\"));\
	}";
	this.resampler = Function("buffer", toCompile);
}
Resampler.prototype.compileMultiTapFunction = function () {
	var toCompile = "var bufferLength = buffer.length;\
	var outLength = this.outputBufferSize;\
	if ((bufferLength % " + this.channels + ") == 0) {\
		if (bufferLength > 0) {\
			var ratioWeight = this.ratioWeight;\
			var weight = 0;";
	for (var channel = 0; channel < this.channels; ++channel) {
		toCompile += "var output" + channel + " = 0;"
	}
	toCompile += "var actualPosition = 0;\
			var amountToNext = 0;\
			var alreadyProcessedTail = !this.tailExists;\
			this.tailExists = false;\
			var outputBuffer = this.outputBuffer;\
			var outputOffset = 0;\
			var currentPosition = 0;\
			do {\
				if (alreadyProcessedTail) {\
					weight = ratioWeight;";
	for (channel = 0; channel < this.channels; ++channel) {
		toCompile += "output" + channel + " = 0;"
	}
	toCompile += "}\
				else {\
					weight = this.lastWeight;";
	for (channel = 0; channel < this.channels; ++channel) {
		toCompile += "output" + channel + " = this.lastOutput[" + channel + "];"
	}
	toCompile += "alreadyProcessedTail = true;\
				}\
				while (weight > 0 && actualPosition < bufferLength) {\
					amountToNext = 1 + actualPosition - currentPosition;\
					if (weight >= amountToNext) {";
	for (channel = 0; channel < this.channels; ++channel) {
		toCompile += "output" + channel + " += buffer[actualPosition++] * amountToNext;"
	}
	toCompile += "currentPosition = actualPosition;\
						weight -= amountToNext;\
					}\
					else {";
	for (channel = 0; channel < this.channels; ++channel) {
		toCompile += "output" + channel + " += buffer[actualPosition" + ((channel > 0) ? (" + " + channel) : "") + "] * weight;"
	}
	toCompile += "currentPosition += weight;\
						weight = 0;\
						break;\
					}\
				}\
				if (weight == 0) {";
	for (channel = 0; channel < this.channels; ++channel) {
		toCompile += "outputBuffer[outputOffset++] = output" + channel + " / ratioWeight;"
	}
	toCompile += "}\
				else {\
					this.lastWeight = weight;";
	for (channel = 0; channel < this.channels; ++channel) {
		toCompile += "this.lastOutput[" + channel + "] = output" + channel + ";"
	}
	toCompile += "this.tailExists = true;\
					break;\
				}\
			} while (actualPosition < bufferLength && outputOffset < outLength);\
			return this.bufferSlice(outputOffset);\
		}\
		else {\
			return (this.noReturn) ? 0 : [];\
		}\
	}\
	else {\
		throw(new Error(\"Buffer was of incorrect sample length.\"));\
	}";
	this.resampler = Function("buffer", toCompile);
}
Resampler.prototype.bypassResampler = function (buffer) {
	if (this.noReturn) {
		//Set the buffer passed as our own, as we don't need to resample it:
		this.outputBuffer = buffer;
		return buffer.length;
	}
	else {
		//Just return the buffer passsed:
		return buffer;
	}
}
Resampler.prototype.bufferSlice = function (sliceAmount) {
	if (this.noReturn) {
		//If we're going to access the properties directly from this object:
		return sliceAmount;
	}
	else {
		//Typed array and normal array buffer section referencing:
		try {
			return this.outputBuffer.subarray(0, sliceAmount);
		}
		catch (error) {
			try {
				//Regular array pass:
				this.outputBuffer.length = sliceAmount;
				return this.outputBuffer;
			}
			catch (error) {
				//Nightly Firefox 4 used to have the subarray function named as slice:
				return this.outputBuffer.slice(0, sliceAmount);
			}
		}
	}
}
Resampler.prototype.initializeBuffers = function () {
	//Initialize the internal buffer:
	try {
		this.outputBuffer = new Float32Array(this.outputBufferSize);
		this.lastOutput = new Float32Array(this.channels);
	}
	catch (error) {
		this.outputBuffer = [];
		this.lastOutput = [];
	}
}

// demuxer.js
/////////////////////////////////////////////////////////////////////////////

/*
 * mod.js - MOD decoder in JavaScript, using Aurora.js
 * Original JavaScript version from jsmodplayer Copyright (C) 2010 Matt Westcott ("Gasman"),
 * William Wenge-Murphy ("BillyWM"), and Sean Neilan ("sneilan").
 *
 * Aurora.js port by Nick Markwell ("duckinator")
 *
 * Licensed under the same terms as the original. The original license follows.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 */

MODDemuxer = Demuxer.extend(function() {
    Demuxer.register(this);

    this.channelCountByIdentifier = {
        'TDZ1': 1, '1CHN': 1, 'TDZ2': 2, '2CHN': 2, 'TDZ3': 3, '3CHN': 3,
        'M.K.': 4, 'FLT4': 4, 'M!K!': 4, '4CHN': 4, 'TDZ4': 4, '5CHN': 5, 'TDZ5': 5,
        '6CHN': 6, 'TDZ6': 6, '7CHN': 7, 'TDZ7': 7, '8CHN': 8, 'TDZ8': 8, 'OCTA': 8, 'CD81': 8,
        '9CHN': 9, 'TDZ9': 9,
        '10CH': 10, '11CH': 11, '12CH': 12, '13CH': 13, '14CH': 14, '15CH': 15, '16CH': 16, '17CH': 17,
        '18CH': 18, '19CH': 19, '20CH': 20, '21CH': 21, '22CH': 22, '23CH': 23, '24CH': 24, '25CH': 25,
        '26CH': 26, '27CH': 27, '28CH': 28, '29CH': 29, '30CH': 30, '31CH': 31, '32CH': 32
    }

    this.prototype.getIdentifier = function(stream) {
        // Bytes 1080-1084 contain 1 of the 47(?) "magic cookies" in channelCountByIdentifier.
        return stream.peekString(1080, 4);
    }

    this.probe = function(stream) {
        var identifier = this.prototype.getIdentifier(stream);
        return (identifier in MODDemuxer.channelCountByIdentifier);
    }

    // Remove null bytes from a string
	function trimNulls(str) {
		return str.replace(/\x00+$/, '');
	}

    this.prototype.readChunk = function() {
        var stream = this.stream,
            pos    = stream.offset;

        if (pos > 0) {
            console.log("[demuxer] Found more data @ " + pos);
            while (stream.available(1)) {
                buf = stream.readSingleBuffer(stream.remainingBytes());
                this.emit('data', buf);
            }
            return;
        }

        if (!stream.available(1084)) {
            console.log("[demuxer] Only " + stream.remainingBytes() + " of required 1084 bytes available. Waiting.");
            this.once('available', this.readChunk);
            return;
        }

        // The title is 20 bytes long, with all null bytes trimmed.
        var title = trimNulls(stream.peekString(0, 20));
        this.emit('metadata', {
            'Title': title
        });

        console.log("[demuxer] Title: " + title);

        // Store identifier if it's not already there.
        if (!('identifier' in this)) {
            this.identifier = this.getIdentifier(stream);

            if (!(this.identifier in MODDemuxer.channelCountByIdentifier)) {
                this.emit('error', "Invalid MOD file.");
            }
        }

        this.emit('format', {
            formatID: 'mod',
            sampleRate: 44100, // is this right?
            channelsPerFrame: MODDemuxer.channelCountByIdentifier[this.identifier],
            bitsPerChannel: 16   // is this right?
        });

        while (stream.available(1)) {
            buf = stream.readSingleBuffer(stream.remainingBytes());
            this.emit('data', buf);
        }
    }
});


// decoder.js
/////////////////////////////////////////////////////////////////////////////
/*
 * mod.js - MOD decoder in JavaScript, using Aurora.js
 * Original JavaScript version from jsmodplayer Copyright (C) 2010 Matt Westcott ("Gasman"),
 * William Wenge-Murphy ("BillyWM"), and Sean Neilan ("sneilan").
 *
 * Aurora.js port by Nick Markwell ("duckinator")
 *
 * Licensed under the same terms as the original. The original license follows.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 */

/*
 * Notes:
 * - The first 20 bytes of the file are *ALWAYS* taken by the demuxer, for the title.
 */

MODDecoder = Decoder.extend(function() {
    Decoder.register('mod', this);

    // Remove null bytes from a string
    function trimNulls(str) {
        return str.replace(/\x00+$/, '');
    }

    // Get a word. Mmmmm, magic. Tastes like chicken.
    function getWord(str, pos) {
        return (str.charCodeAt(pos) << 8) + str.charCodeAt(pos+1)
    }

    this.prototype.sampleCount     = 31;
    this.prototype.samplePositions = [];
    for (var i = 0; i < this.prototype.sampleCount; i ++) {
        this.prototype.samplePositions[i] = 20 + i * 30;
    }

    this.prototype.isSample = function(pos) {
        return (this.samplePositions.indexOf(pos) > -1);
    }

    this.prototype.init = function() {
        this.rate = 44100; // This was hard-coded in jsmodplayer, too.

        this.samples = [];
        this.sampleData = [];
        this.positions = [];
        this.patternCount = 0;
        this.patterns = [];
        this.channelCount = 0;
        this.title = undefined;

        /* timing calculations */
        this.ticksPerSecond = 7093789.2; /* PAL frequency */
        this.ticksPerFrame; /* calculated by setBpm */
        this.ticksPerOutputSample = Math.round(this.ticksPerSecond / this.rate);
        this.ticksSinceStartOfFrame = 0;

        /* initial player state */
        this.framesPerRow = 6;
        this.currentFrame = 0;
        this.currentPattern = undefined;
        this.currentPosition = undefined;
        this.currentRow = undefined;
        this.exLoop = false;        //whether E6x looping is currently set
        this.exLoopStart = 0;    //loop point set up by E60
        this.exLoopEnd = 0;        //end of loop (where we hit a E6x cmd) for accurate counting
        this.exLoopCount = 0;    //loops remaining
        this.doBreak = false;    //Bxx, Dxx - jump to order and pattern break
        this.breakPos = 0;
        this.breakRow = 0;
        this.delayRows = false; //EEx pattern delay.

        this.channels = [];

        //this.bufferSeconds = 1.5;
        //this.bufferLength = this.rate * 2 * this.bufferSeconds;
        this.bufferLength = 200;

        this.floatingPoint = true;
    }

    // Chrome doesn't support changing the sample rate, and uses whatever the hardware supports.
    this.prototype.hardwareSampleRate = (function() {
        var AudioContext = (window.AudioContext || window.webkitAudioContext);
        if (!AudioContext)
            return 44100;

        return new AudioContext().sampleRate;
    }());

    this.prototype.resampleHack = function(sample) {
        if (this.hardwareSampleRate != this.rate) {
            var resampler = new Resampler(this.rate, this.hardwareSampleRate, this.channelCount, this.bufferLength, false /* always return */);
            return resampler.resampler(sample);
        } else {
            return sample;
        }
    }

    this.prototype.getSample = function(str) {
        if (!this.stream.available(30))
            return; // return if there isn't a full sample loaded.

        var sampleInfo = this.stream.readString(30),
            sampleName = trimNulls(sampleInfo.substr(0, 22));

        return {
            name: sampleName,
            length: getWord(sampleInfo, 22) * 2,
            finetune: sampleInfo.charCodeAt(24),
            volume: sampleInfo.charCodeAt(25),
            repeatOffset: getWord(sampleInfo, 26) * 2,
            repeatLength: getWord(sampleInfo, 28) * 2,
        };
    }

    this.prototype.readPositionData = function() {
        this.positionCount = this.stream.readUInt8();
        this.positionLoopPoint = this.stream.readUInt8();
        for (var i = 0; i < 128; i++) {
            this.positions[i] = this.stream.readUInt8();
            if (this.positions[i] >= this.patternCount) {
                this.patternCount = this.positions[i]+1;
            }
        }
    }

    this.prototype.readPatterns = function() {
        var pattern = undefined;

        for (var pat = 0; pat < this.patternCount; pat++) {
            this.patterns[pat] = [];
            //console.log("[decoder] patterns[" + pat + "][0..64] @ " + this.stream.offset);
            for (var row = 0; row < 64; row++) {
                this.patterns[pat][row] = [];

                for (var chan = 0; chan < this.channelCount; chan++) {
                    b0 = this.stream.readUInt8();
                    b1 = this.stream.readUInt8();
                    b2 = this.stream.readUInt8();
                    b3 = this.stream.readUInt8();
                    var eff = b2 & 0x0f;
                    this.patterns[pat][row][chan] = {
                        sample: (b0 & 0xf0) | (b2 >> 4),
                        period: ((b0 & 0x0f) << 8) | b1,
                        effect: eff,
                        effectParameter: b3
                    };

                    if (eff == 0x0E) {
                        this.patterns[pat][row][chan].extEffect = (b3 & 0xF0) >> 4;
                        this.patterns[pat][row][chan].extEffectParameter = (b3 & 0x0F);
                    }
                }
            }
        }
    }

    this.prototype.readSampleData = function() {
        for (var s = 0; s < this.sampleCount; s++) {
            //console.log("[decoder] Sample data @ " + this.stream.offset);

            this.samples[s].startOffset = this.stream.offset;
            this.sampleData[s] = new Uint8Array(this.samples[s].length, "uint8");
            for (var i = 0; i < this.samples[s].length; i++) {
                this.sampleData[s][i] = this.stream.readUInt8();
            }
        }
    }

    this.prototype.readChunk = function() {
        var stream    = this.stream;

        if (stream.offset == 0) {
            // Need 20 bytes for title
            if (stream.remainingBytes() < 20) {
                return this.once('available', this.readChunk);
            }

            stream.advance(20);
        }

        while (this.isSample(stream.offset)) {
            var sample,
                pos = stream.remainingBytes();

            // Need 30 bytes for sample.
            if (pos < 30) {
                return this.once('available', this.readChunk);
            }

            sample = this.samples[this.samples.length] = this.getSample();
            //console.log("[decoder] Found sample @ " + pos + ", length: " + sample['length']);
            //console.log("          Name: " + sample['name']);
        }

        if (stream.offset == 950) {
            this.readPositionData();

            var identifier = stream.readString(4);

            this.channelCount = MODDemuxer.channelCountByIdentifier[identifier];
            if (!this.channelCount) {
                this.channelCount = 4;
            }

            this.readPatterns();

            this.readSampleData();

            // Play the audio!
            this.setBpm(125);
            this.setChannels();
            this.loadPosition(0);
        }

        //console.log("[decoder] Found something @ " + stream.offset);
        //console.log("[decoder] Remaining: " + stream.remainingBytes());

        if (stream.offset >= 950) {
            var samples = this.getSamples();
//console.log(samples);return;
            this.emit('data', samples);
        }

        //console.log("[decoder] Offset:    " + stream.offset);
        //console.log("[decoder] Remaining: " + stream.remainingBytes());
    }



/*
    Useful docs
        Explains effect calculations: http://www.mediatel.lu/workshop/audio/fileformat/h_mod.html

*/

/*
this.modPeriodTable[ft][n] = the period to use for note number n at finetune value ft.
Finetune values are in twos-complement, i.e. [0,1,2,3,4,5,6,7,-8,-7,-6,-5,-4,-3,-2,-1]
The first table is used to generate a reverse lookup table, to find out the note number
for a period given in the MOD file.
*/
this.modPeriodTable = [
    [1712, 1616, 1524, 1440, 1356, 1280, 1208, 1140, 1076, 1016, 960 , 906,
     856 , 808 , 762 , 720 , 678 , 640 , 604 , 570 , 538 , 508 , 480 , 453,
     428 , 404 , 381 , 360 , 339 , 320 , 302 , 285 , 269 , 254 , 240 , 226,
     214 , 202 , 190 , 180 , 170 , 160 , 151 , 143 , 135 , 127 , 120 , 113,
     107 , 101 , 95  , 90  , 85  , 80  , 75  , 71  , 67  , 63  , 60  , 56 ],
    [1700, 1604, 1514, 1430, 1348, 1274, 1202, 1134, 1070, 1010, 954 , 900,
     850 , 802 , 757 , 715 , 674 , 637 , 601 , 567 , 535 , 505 , 477 , 450,
     425 , 401 , 379 , 357 , 337 , 318 , 300 , 284 , 268 , 253 , 239 , 225,
     213 , 201 , 189 , 179 , 169 , 159 , 150 , 142 , 134 , 126 , 119 , 113,
     106 , 100 , 94  , 89  , 84  , 79  , 75  , 71  , 67  , 63  , 59  , 56 ],
    [1688, 1592, 1504, 1418, 1340, 1264, 1194, 1126, 1064, 1004, 948 , 894,
     844 , 796 , 752 , 709 , 670 , 632 , 597 , 563 , 532 , 502 , 474 , 447,
     422 , 398 , 376 , 355 , 335 , 316 , 298 , 282 , 266 , 251 , 237 , 224,
     211 , 199 , 188 , 177 , 167 , 158 , 149 , 141 , 133 , 125 , 118 , 112,
     105 , 99  , 94  , 88  , 83  , 79  , 74  , 70  , 66  , 62  , 59  , 56 ],
    [1676, 1582, 1492, 1408, 1330, 1256, 1184, 1118, 1056, 996 , 940 , 888,
     838 , 791 , 746 , 704 , 665 , 628 , 592 , 559 , 528 , 498 , 470 , 444,
     419 , 395 , 373 , 352 , 332 , 314 , 296 , 280 , 264 , 249 , 235 , 222,
     209 , 198 , 187 , 176 , 166 , 157 , 148 , 140 , 132 , 125 , 118 , 111,
     104 , 99  , 93  , 88  , 83  , 78  , 74  , 70  , 66  , 62  , 59  , 55 ],
    [1664, 1570, 1482, 1398, 1320, 1246, 1176, 1110, 1048, 990 , 934 , 882,
     832 , 785 , 741 , 699 , 660 , 623 , 588 , 555 , 524 , 495 , 467 , 441,
     416 , 392 , 370 , 350 , 330 , 312 , 294 , 278 , 262 , 247 , 233 , 220,
     208 , 196 , 185 , 175 , 165 , 156 , 147 , 139 , 131 , 124 , 117 , 110,
     104 , 98  , 92  , 87  , 82  , 78  , 73  , 69  , 65  , 62  , 58  , 55 ],
    [1652, 1558, 1472, 1388, 1310, 1238, 1168, 1102, 1040, 982 , 926 , 874,
     826 , 779 , 736 , 694 , 655 , 619 , 584 , 551 , 520 , 491 , 463 , 437,
     413 , 390 , 368 , 347 , 328 , 309 , 292 , 276 , 260 , 245 , 232 , 219,
     206 , 195 , 184 , 174 , 164 , 155 , 146 , 138 , 130 , 123 , 116 , 109,
     103 , 97  , 92  , 87  , 82  , 77  , 73  , 69  , 65  , 61  , 58  , 54 ],
    [1640, 1548, 1460, 1378, 1302, 1228, 1160, 1094, 1032, 974 , 920 , 868,
     820 , 774 , 730 , 689 , 651 , 614 , 580 , 547 , 516 , 487 , 460 , 434,
     410 , 387 , 365 , 345 , 325 , 307 , 290 , 274 , 258 , 244 , 230 , 217,
     205 , 193 , 183 , 172 , 163 , 154 , 145 , 137 , 129 , 122 , 115 , 109,
     102 , 96  , 91  , 86  , 81  , 77  , 72  , 68  , 64  , 61  , 57  , 54 ],
    [1628, 1536, 1450, 1368, 1292, 1220, 1150, 1086, 1026, 968 , 914 , 862,
     814 , 768 , 725 , 684 , 646 , 610 , 575 , 543 , 513 , 484 , 457 , 431,
     407 , 384 , 363 , 342 , 323 , 305 , 288 , 272 , 256 , 242 , 228 , 216,
     204 , 192 , 181 , 171 , 161 , 152 , 144 , 136 , 128 , 121 , 114 , 108,
     102 , 96  , 90  , 85  , 80  , 76  , 72  , 68  , 64  , 60  , 57  , 54 ],
    [1814, 1712, 1616, 1524, 1440, 1356, 1280, 1208, 1140, 1076, 1016, 960,
     907 , 856 , 808 , 762 , 720 , 678 , 640 , 604 , 570 , 538 , 508 , 480,
     453 , 428 , 404 , 381 , 360 , 339 , 320 , 302 , 285 , 269 , 254 , 240,
     226 , 214 , 202 , 190 , 180 , 170 , 160 , 151 , 143 , 135 , 127 , 120,
     113 , 107 , 101 , 95  , 90  , 85  , 80  , 75  , 71  , 67  , 63  , 60 ],
    [1800, 1700, 1604, 1514, 1430, 1350, 1272, 1202, 1134, 1070, 1010, 954,
     900 , 850 , 802 , 757 , 715 , 675 , 636 , 601 , 567 , 535 , 505 , 477,
     450 , 425 , 401 , 379 , 357 , 337 , 318 , 300 , 284 , 268 , 253 , 238,
     225 , 212 , 200 , 189 , 179 , 169 , 159 , 150 , 142 , 134 , 126 , 119,
     112 , 106 , 100 , 94  , 89  , 84  , 79  , 75  , 71  , 67  , 63  , 59 ],
    [1788, 1688, 1592, 1504, 1418, 1340, 1264, 1194, 1126, 1064, 1004, 948,
     894 , 844 , 796 , 752 , 709 , 670 , 632 , 597 , 563 , 532 , 502 , 474,
     447 , 422 , 398 , 376 , 355 , 335 , 316 , 298 , 282 , 266 , 251 , 237,
     223 , 211 , 199 , 188 , 177 , 167 , 158 , 149 , 141 , 133 , 125 , 118,
     111 , 105 , 99  , 94  , 88  , 83  , 79  , 74  , 70  , 66  , 62  , 59 ],
    [1774, 1676, 1582, 1492, 1408, 1330, 1256, 1184, 1118, 1056, 996 , 940,
     887 , 838 , 791 , 746 , 704 , 665 , 628 , 592 , 559 , 528 , 498 , 470,
     444 , 419 , 395 , 373 , 352 , 332 , 314 , 296 , 280 , 264 , 249 , 235,
     222 , 209 , 198 , 187 , 176 , 166 , 157 , 148 , 140 , 132 , 125 , 118,
     111 , 104 , 99  , 93  , 88  , 83  , 78  , 74  , 70  , 66  , 62  , 59 ],
    [1762, 1664, 1570, 1482, 1398, 1320, 1246, 1176, 1110, 1048, 988 , 934,
     881 , 832 , 785 , 741 , 699 , 660 , 623 , 588 , 555 , 524 , 494 , 467,
     441 , 416 , 392 , 370 , 350 , 330 , 312 , 294 , 278 , 262 , 247 , 233,
     220 , 208 , 196 , 185 , 175 , 165 , 156 , 147 , 139 , 131 , 123 , 117,
     110 , 104 , 98  , 92  , 87  , 82  , 78  , 73  , 69  , 65  , 61  , 58 ],
    [1750, 1652, 1558, 1472, 1388, 1310, 1238, 1168, 1102, 1040, 982 , 926,
     875 , 826 , 779 , 736 , 694 , 655 , 619 , 584 , 551 , 520 , 491 , 463,
     437 , 413 , 390 , 368 , 347 , 328 , 309 , 292 , 276 , 260 , 245 , 232,
     219 , 206 , 195 , 184 , 174 , 164 , 155 , 146 , 138 , 130 , 123 , 116,
     109 , 103 , 97  , 92  , 87  , 82  , 77  , 73  , 69  , 65  , 61  , 58 ],
    [1736, 1640, 1548, 1460, 1378, 1302, 1228, 1160, 1094, 1032, 974 , 920,
     868 , 820 , 774 , 730 , 689 , 651 , 614 , 580 , 547 , 516 , 487 , 460,
     434 , 410 , 387 , 365 , 345 , 325 , 307 , 290 , 274 , 258 , 244 , 230,
     217 , 205 , 193 , 183 , 172 , 163 , 154 , 145 , 137 , 129 , 122 , 115,
     108 , 102 , 96  , 91  , 86  , 81  , 77  , 72  , 68  , 64  , 61  , 57 ],
    [1724, 1628, 1536, 1450, 1368, 1292, 1220, 1150, 1086, 1026, 968 , 914,
     862 , 814 , 768 , 725 , 684 , 646 , 610 , 575 , 543 , 513 , 484 , 457,
     431 , 407 , 384 , 363 , 342 , 323 , 305 , 288 , 272 , 256 , 242 , 228,
     216 , 203 , 192 , 181 , 171 , 161 , 152 , 144 , 136 , 128 , 121 , 114,
     108 , 101 , 96  , 90  , 85  , 80  , 76  , 72  , 68  , 64  , 60  , 57 ]];

this.sineTable = [
    0,24,49,74,97,120,141,161,180,197,212,224,235,244,250,253,
    255,253,250,244,235,224,212,197,180,161,141,120,97,74,49,
    24,0,-24,-49,-74,-97,-120,-141,-161,-180,-197,-212,-224,
    -235,-244,-250,-253,-255,-253,-250,-244,-235,-224,-212,-197,
    -180,-161,-141,-120,-97,-74,-49,-24
];

this.modPeriodToNoteNumber = {};
for (var i = 0; i < this.modPeriodTable[0].length; i++) {
    this.modPeriodToNoteNumber[this.modPeriodTable[0][i]] = i;
}

    this.prototype.setBpm = function(bpm) {
        /* x beats per minute => x*4 rows per minute */
        this.ticksPerFrame = Math.round(this.ticksPerSecond * 2.5/bpm);
    }

    this.prototype.setChannels = function() {
        for (var chan = 0; chan < this.channelCount; chan++) {
            this.channels[chan] = {
                playing: false,
                sample: this.samples[0],
                finetune: 0,
                volume: 0,
                pan: 0x7F,    //unimplemented
                volumeDelta: 0,
                periodDelta: 0,
                fineVolumeDelta: 0,
                finePeriodDelta: 0,
                tonePortaTarget: 0, //target for 3xx, 5xy as period value
                tonePortaDelta: 0,
                tonePortaVolStep: 0, //remember pitch slide step for when 5xx is used
                tonePortaActive: false,
                cut: false,            //tick to cut at, or false if no cut
                delay: false,        //tick to delay note until, or false if no delay
                arpeggioActive: false
            };
        }
    }

    this.prototype.loadRow = function(rowNumber) {
        this.currentRow = rowNumber;
        this.currentFrame = 0;
        this.doBreak = false;
        this.breakPos = 0;
        this.breakRow = 0;

        for (var chan = 0; chan < this.channelCount; chan++) {
            var channel = this.channels[chan];
            var prevNote = channel.prevNote;
            var note = this.currentPattern[this.currentRow][chan];
            if (channel.sampleNum == undefined) {
                    channel.sampleNum = 0;
            }
            if (note.period != 0 || note.sample != 0) {
                channel.playing = true;
                channel.samplePosition = 0;
                channel.ticksSinceStartOfSample = 0; /* that's 'sample' as in 'individual volume reading' */
                if (note.sample != 0) {
                    channel.sample = this.samples[note.sample - 1];
                    channel.sampleNum = note.sample - 1;
                    channel.volume = channel.sample.volume;
                    channel.finetune = channel.sample.finetune;
                }
                if (note.period != 0) { // && note.effect != 0x03
                    //the note specified in a tone porta command is not actually played
                    if (note.effect != 0x03) {
                        channel.noteNumber = MODDecoder.modPeriodToNoteNumber[note.period];
                        channel.ticksPerSample = MODDecoder.modPeriodTable[channel.finetune][channel.noteNumber] * 2;
                    } else {
                        channel.noteNumber = MODDecoder.modPeriodToNoteNumber[prevNote.period]
                        channel.ticksPerSample = MODDecoder.modPeriodTable[channel.finetune][channel.noteNumber] * 2;
                    }
                }
            }
            channel.finePeriodDelta = 0;
            channel.fineVolumeDelta = 0;
            channel.cut = false;
            channel.delay = false;
            channel.retrigger = false;
            channel.tonePortaActive = false;
            if (note.effect != 0 || note.effectParameter != 0) {
                channel.volumeDelta = 0; /* new effects cancel volumeDelta */
                channel.periodDelta = 0; /* new effects cancel periodDelta */
                channel.arpeggioActive = false;
                switch (note.effect) {
                    case 0x00: /* arpeggio: 0xy */
                        channel.arpeggioActive = true;
                        channel.arpeggioNotes = [
                            channel.noteNumber,
                            channel.noteNumber + (note.effectParameter >> 4),
                            channel.noteNumber + (note.effectParameter & 0x0f)
                        ]
                        channel.arpeggioCounter = 0;
                        break;
                    case 0x01: /* pitch slide up - 1xx */
                        channel.periodDelta = -note.effectParameter;
                        break;
                    case 0x02: /* pitch slide down - 2xx */
                        channel.periodDelta = note.effectParameter;
                        break;
                    case 0x03: /* slide to note 3xy - */
                        channel.tonePortaActive = true;
                        channel.tonePortaTarget = (note.period != 0) ? note.period : channel.tonePortaTarget;
                        var dir = (channel.tonePortaTarget < prevNote.period) ? -1 : 1;
                        channel.tonePortaDelta = (note.effectParameter * dir);
                        channel.tonePortaVolStep = (note.effectParameter * dir);
                        channel.tonePortaDir = dir;
                        break;
                    case 0x05: /* portamento to note with volume slide 5xy */
                        channel.tonePortaActive = true;
                        if (note.effectParameter & 0xf0) {
                            channel.volumeDelta = note.effectParameter >> 4;
                        } else {
                            channel.volumeDelta = -note.effectParameter;
                        }
                        channel.tonePortaDelta = channel.tonePortaVolStep;
                        break;
                    case 0x09: /* sample offset - 9xx */
                        channel.samplePosition = 256 * note.effectParameter;
                        break;
                    case 0x0A: /* volume slide - Axy */
                        if (note.effectParameter & 0xf0) {
                            /* volume increase by x */
                            channel.volumeDelta = note.effectParameter >> 4;
                        } else {
                            /* volume decrease by y */
                            channel.volumeDelta = -note.effectParameter;
                        }
                        break;
                    case 0x0B: /* jump to order */
                        doBreak = true;
                        breakPos = note.effectParameter;
                        breakRow = 0;
                        break;
                    case 0x0C: /* volume */
                        if (note.effectParameter > 64) {
                            channel.volume = 64;
                        } else {
                            channel.volume = note.effectParameter;
                        }
                        break;
                    case 0x0D: /* pattern break; jump to next pattern at specified row */
                        doBreak = true;
                        breakPos = this.currentPosition + 1;
                        //Row is written as DECIMAL so grab the high part as a single digit and do some math
                        breakRow = ((note.effectParameter & 0xF0) >> 4) * 10 + (note.effectParameter & 0x0F);
                        break;

                    case 0x0E:
                        switch (note.extEffect) {    //yes we're doing nested switch
                            case 0x01: /* fine pitch slide up - E1x */
                                channel.finePeriodDelta = -note.extEffectParameter;
                                break;
                            case 0x02: /* fine pitch slide down - E2x */
                                channel.finePeriodDelta = note.extEffectParameter;
                                break;
                            case 0x05: /* set finetune - E5x */
                                channel.finetune = note.extEffectParameter;
                                break;
                            case 0x09: /* retrigger sample - E9x */
                                channel.retrigger = note.extEffectParameter;
                                break;
                            case 0x0A: /* fine volume slide up - EAx */
                                channel.fineVolumeDelta = note.extEffectParameter;
                                break;
                            case 0x0B: /* fine volume slide down - EBx */
                                channel.fineVolumeDelta = -note.extEffectParameter;
                                break;
                            case 0x0C: /* note cute - ECx */
                                channel.cut = note.extEffectParameter;
                                break;
                            case 0x0D: /* note delay - EDx */
                                channel.delay = note.extEffectParameter;
                                break;
                            case 0x0E: /* pattern delay EEx */
                                delayRows = note.extEffectParameter;
                                break;
                            case 0x06:
                                //set loop start with E60
                                if (note.extEffectParameter == 0) {
                                    this.exLoopStart = this.currentRow;
                                } else {
                                    //set loop end with E6x
                                    this.exLoopEnd = this.currentRow;
                                    //activate the loop only if it's new
                                    if (!this.exLoop) {
                                        this.exLoop = true;
                                        this.exLoopCount = note.extEffectParameter;
                                    }
                                }
                                break;
                        }

                        break;

                    case 0x0F: /* tempo change. <=32 sets ticks/row, greater sets beats/min instead */
                        var newSpeed = (note.effectParameter == 0) ? 1 : note.effectParameter; /* 0 is treated as 1 */
                        if (newSpeed <= 32) {
                            framesPerRow = newSpeed;
                        } else {
                            this.setBpm(newSpeed);
                        }
                        break;
                }
            }

            //for figuring out tone portamento effect
            if (note.period != 0) { channel.prevNote = note; }
            // FIXME: channel.prevNote isn't always defined before it's needed. See Ode to Protracker.

            if (channel.tonePortaActive == false) {
                channel.tonePortaDelta = 0;
                channel.tonePortaTarget = 0;
                channel.tonePortaVolStep = 0;
            }
        }
    }

    this.prototype.loadPattern = function(patternNumber) {
        var row = this.doBreak ? this.breakRow : 0;
        this.currentPattern = this.patterns[patternNumber];
        this.loadRow(row);
    }

    this.prototype.loadPosition = function(positionNumber) {
        //Handle invalid position numbers that may be passed by invalid loop points
        positionNumber = (positionNumber > this.positionCount - 1) ? 0 : positionNumber;
        this.currentPosition = positionNumber;
        this.loadPattern(this.positions[this.currentPosition]);
    }

    this.prototype.getNextPosition = function() {
        if (this.currentPosition + 1 >= this.positionCount) {
            this.loadPosition(this.positionLoopPoint);
        } else {
            this.loadPosition(this.currentPosition + 1);
        }
    }

    this.prototype.getNextRow = function() {
        /*
            Determine where we're gonna go based on active effect.
            Either:
                break (jump to new pattern),
                do extended loop,
                advance normally
        */
        if (this.doBreak) {
            //Dxx commands at the end of modules are fairly common for some reason
            //so make sure jumping past the end loops back to the start
            this.breakPos = (this.breakPos >= this.positionCount) ? this.positionLoopPoint : this.breakPos;
            this.loadPosition(this.breakPos);
        } else if (this.exLoop && this.currentRow == this.exLoopEnd && this.exLoopCount > 0) {
            //count down the loop and jump back
            this.loadRow(this.exLoopStart);
            this.exLoopCount--;
        } else {
            if (this.currentRow == 63) {
                this.getNextPosition();
            } else {
                this.loadRow(this.currentRow + 1);
            }
        }

        if (this.exLoopCount < 0) { this.exLoop = false; }
    }

    this.prototype.doFrame = function() {
        /* apply volume/pitch slide before fetching row, because the first frame of a row does NOT
        have the slide applied */

        for (var chan = 0; chan < this.channelCount; chan++) {
            var channel = this.channels[chan];
            var finetune = channel.finetune;
            if (this.currentFrame == 0) { /* apply fine slides only once */
                channel.ticksPerSample += channel.finePeriodDelta * 2;
                channel.volume += channel.fineVolumeDelta;
            }
            channel.volume += channel.volumeDelta;
            if (channel.volume > 64) {
                channel.volume = 64;
            } else if (channel.volume < 0) {
                channel.volume = 0;
            }
            if (channel.cut !== false && this.currentFrame >= channel.cut) {
                channel.volume = 0;
            }
            if (channel.delay !== false && this.currentFrame <= channel.delay) {
                channel.volume = 0;
            }
            if (channel.retrigger !== false) {
                //short-circuit prevents x mod 0
                if (channel.retrigger == 0 || this.currentFrame % channel.retrigger == 0) {
                    channel.samplePosition = 0;
                }
            }
            channel.ticksPerSample += channel.periodDelta * 2;
            if (channel.tonePortaActive) {
                channel.ticksPerSample += channel.tonePortaDelta * 2;
                //don't slide below or above allowed note, depending on slide direction
                if (channel.tonePortaDir == 1 && channel.ticksPerSample > channel.tonePortaTarget * 2) {
                    channel.ticksPerSample = channel.tonePortaTarget * 2;
                } else if (channel.tonePortaDir == -1 && channel.ticksPerSample < channel.tonePortaTarget * 2)  {
                    channel.ticksPerSample = channel.tonePortaTarget * 2;
                }
            }

            if (channel.ticksPerSample > 4096) {
                channel.ticksPerSample = 4096;
            } else if (channel.ticksPerSample < 96) { /* equivalent to period 48, a bit higher than the highest note */
                channel.ticksPerSample = 96;
            }
            if (channel.arpeggioActive) {
                channel.arpeggioCounter++;
                var noteNumber = channel.arpeggioNotes[channel.arpeggioCounter % 3];
                channel.ticksPerSample = MODDecoder.modPeriodTable[finetune][noteNumber] * 2;
            }
        }

        this.currentFrame++;
        if (this.currentFrame == this.framesPerRow) {
            this.currentFrame = 0;
            //Don't advance to reading more rows if pattern delay effect is active
            if (this.delayRows !== false) {
                this.delayRows--;
                if (this.delayRows < 0) { this.delayRows = false; }
            } else {
                this.getNextRow();
            }
        }
    }

    this.prototype.getSamples = function(sampleCount) {
        if (typeof sampleCount == "undefined")
            sampleCount = this.bufferLength;

        var samples = new Float32Array(sampleCount);
        var i = 0;
        while (i < sampleCount) {
            this.ticksSinceStartOfFrame += this.ticksPerOutputSample;
            while (this.ticksSinceStartOfFrame >= this.ticksPerFrame) {
                this.doFrame();
                this.ticksSinceStartOfFrame -= this.ticksPerFrame;
            }

            this.leftOutputLevel = 0;
            this.rightOutputLevel = 0;
            for (var chan = 0; chan < this.channelCount; chan++) {
                var channel = this.channels[chan];
                if (channel.playing) {
                    channel.ticksSinceStartOfSample += this.ticksPerOutputSample;
                    while (channel.ticksSinceStartOfSample >= channel.ticksPerSample) {
                        channel.samplePosition++;
                        if (channel.sample.repeatLength > 2 && channel.samplePosition >= channel.sample.repeatOffset + channel.sample.repeatLength) {
                            channel.samplePosition = channel.sample.repeatOffset;
                        } else if (channel.samplePosition >= channel.sample.length) {
                            channel.playing = false;
                            break;
                        } else {
                            channel.ticksSinceStartOfSample -= channel.ticksPerSample;
                        }
                    }

                    if (channel.playing) {
                        var rawVol = this.sampleData[channel.sampleNum][channel.samplePosition];
                        var vol = (((rawVol + 128) & 0xff) - 128) * channel.volume; /* range (-128*64)..(127*64) */
                        if (chan & 3 == 0 || chan & 3 == 3) { /* hard panning(?): left, right, right, left */
                            this.leftOutputLevel += (vol + channel.pan) * 3;
                            this.rightOutputLevel += (vol + 0xFF - channel.pan);
                        } else {
                            this.leftOutputLevel += (vol + 0xFF - channel.pan)
                            this.rightOutputLevel += (vol + channel.pan) * 3;
                        }
                        /* range of outputlevels is 128*64*2*channelCount */
                        /* (well, it could be more for odd channel counts) */
                    }
                }
            }

            samples[i] = this.rightOutputLevel / (128 * 128 * this.channelCount);
            samples[i+1] = this.leftOutputLevel / (128 * 128 * this.channelCount);
            i += 2;
        }

        //console.log("Got " + sampleCount + " samples.");

        return this.resampleHack(samples);
    }

});
