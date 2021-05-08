/////////////////////////////////////////////////////////////////////////////
var XmDemuxer = AV.Demuxer.extend(function() {
  AV.Demuxer.register(this);


  this.probe = function(buffer) {
    //console.log('?', buffer);
    //console.log(buffer.peekBuffer(90, 19).data); // s3m kinda magic seq
    //console.log(buffer.peekString(0, 255).indexOf('SCRM@')); // s3m kinda magic seq

    //console.log(' '); // s3m kinda magic seq
    //console.log('/////////////////////////////////////////////////////////////////////////////'); // s3m kinda magic seq
    //console.log(buffer.peekString(0, 2000).toLowerCase().indexOf('animal')); // s3m kinda magic seq
    //console.log(buffer.peekString(0, 255)); // s3m kinda magic seq

    return buffer.peekString(0, 15) == 'Extended Module'
        || buffer.peekString(0, 4) == 'IMPM'
        || buffer.peekString(0, 3) == 'RAD'
        || buffer.peekString(44, 4) == 'SCRM'
  };

  this.prototype.readChunk = function() {
    var stream = this.stream;

    /*if (!this.readHeader && stream.available(15)) {
      if (stream.readString(15) !== 'Extended Module')
        return this.emit('error', 'Invalid XM file.');
      this.readHeader = true;
    }*/

    this.emit('format', {
      formatID: 'xm',
      sampleRate: 44100, // is this right?
      channelsPerFrame: 2, //MODDemuxer.channelCountByIdentifier[this.identifier],
      bitsPerChannel: 16   // is this right?
    });

    //console.log(this);

    var byteArray = stream.list.first.data;
    // load the song's binary data
    //console.log(byteArray);
    var buf = Module._malloc(byteArray.length);
    Module.HEAPU8.set(byteArray, buf);
    var ret = Module.ccall('loadXmpModule', 'number', ['number', 'number'], [buf, byteArray.length]);
    Module._free(buf);

    ret = Module.ccall('startXmpPlayer', 'number', ['number'], [44100]);

    // get song infos (so far we only use some top level module infos)
    ret = Module.ccall('getMusicInfo', 'number');

    var array = Module.HEAP32.subarray(ret>>2, (ret>>2)+2);
    var title = Module.Pointer_stringify(array[0]);
    var player = Module.Pointer_stringify(array[1]);
    this.emit('metadata', {
      title: title,
      player: player
    });

    //this.emit('data', stream.list.first.data);

    //while (stream.available(1) && this.last) {
    while (stream.available(1)) {
      var buffer = stream.readSingleBuffer(stream.remainingBytes());
      this.emit('data', buffer);
    }
  };

});


var XmDecoder = AV.Decoder.extend(function() {
  AV.Decoder.register('xm', this);

  this.isPaused= false;

  // internals
  this.initialized= false;
  this.onEnd = function() {};

  this.sourceBuffer;
  this.sourceBufferLen;

  this.numberOfSamplesRendered= 0;
  this.numberOfSamplesToRender= 0;
  this.sourceBufferIdx=0;

  this.prototype.init = function() {
    Module.ccall('initXmp', 'number');
  }

  this.prototype.readChunk = function() {
    var stream = this.stream;
    //console.log(this);
    //console.log(stream);

    /*while (stream.available(1)) {
      var status = Module.ccall('playXmpFrame', 'number');
      //console.log(status);
      status = Module.ccall('getXmpFrameInfo', 'number');
      //console.log(status);
      status = Module.ccall('getXmpLoopCount', 'number');
      //console.log(status);
    }*/



    //this.emit('data', 'samples');
    //console.log(stream);
  }

  this.prototype.genSamples = function(event) {
    //console.log(event);
    var output1 = event.outputBuffer.getChannelData(0);
    var output2 = event.outputBuffer.getChannelData(1);

    //console.log(output1);

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

          var status = Module.ccall('playXmpFrame', 'number');
          if (status != 0) {
            // no frame left
            this.fillEmpty(outSize, output1, output2);
            if (this.onEnd) this.onEnd();
            this.isPaused= true;
            return;
          }
          status = Module.ccall('getXmpFrameInfo', 'number');

          status = Module.ccall('getXmpLoopCount', 'number');
          if (status > 0) {
            this.fillEmpty(outSize, output1, output2);
            if (this.onEnd) this.onEnd();
            this.isPaused= true;
            return;
          }

          // refresh just in case they are not using one fixed buffer..
          this.sourceBuffer= Module.ccall('getXmpSoundBuffer', 'number');
          this.sourceBufferLen= Module.ccall('getXmpSoundBufferLen', 'number')/4;

          this.numberOfSamplesToRender = this.sourceBufferLen;
          this.sourceBufferIdx=0;
        }

        var srcBufI16= this.sourceBuffer>>1;  // 2 x 16 bit samples
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
  }

  this.prototype.fillEmpty = function(outSize, output1, output2) {
    var availableSpace = outSize-this.numberOfSamplesRendered;
    for (i= 0; i<availableSpace; i++) {
      output1[i+this.numberOfSamplesRendered]= 0;
      output2[i+this.numberOfSamplesRendered]= 0;
    }
    this.numberOfSamplesToRender = 0;
    this.numberOfSamplesRendered = outSize;
  }

});
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

