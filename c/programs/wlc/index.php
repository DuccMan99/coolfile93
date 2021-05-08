<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>WLC</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
	<title>WLC</title>
	<style>
		html,body {
			margin:0;
			padding:0;
			width:100%;
			height:100%;
			background: silver;
		}
		body {

		}
		figure {
			width: 100%;
    		height: calc(100% - 27px);
    		margin: 0px;
    		padding: 0px;
		}
		figcaption {
			display:block;
			font-size:16px;
			font-size:1rem;
		}
		video {
			height: 100%;
			width: 100%;
			background: #000;
		}

		/* controls */
		.controls, .controls li {
			padding:0;
			margin:0;
		}
		.controls {
			display:none;
			list-style-type:none;
			overflow:hidden;
			background:transparent;
		}
		.controls li {
			float:left;
			width:10%;
			margin-left:0.3%;
		}
		.controls li:first-child {
			margin-left:0;
		}
		.controls .progress {
			width:38%;
			cursor:pointer;
		}
		.controls button {
			width:100%;
			text-align:center;
			overflow:hidden;
			white-space:nowrap;
		  	text-overflow:ellipsis;
		  	height: 24px;
		}
		.controls progress {
			display:block;
			width:100%;
			height: 24px;

		}
		.controls progress span {
			width:0%;
			height:100%;
			display:inline-block;
			background-color:#2a84cd;	
		}

		/* fullscreen */
		html:-ms-fullscreen {
			width:100%;
		}
		:-webkit-full-screen {
			background-color:transparent;
		}
		/* hide controls on fullscreen with WebKit */
		figure[data-fullscreen=true] video::-webkit-media-controls {
			display:none !important;
		}
		figure[data-fullscreen=true] {
			max-width:100%;
			width:100%;
			margin:0;
			padding:0;
		}
		figure[data-fullscreen=true] video {
			height:auto;
		}
		figure[data-fullscreen=true] figcaption {
			display:none;
		}
		figure[data-fullscreen=true] .controls {
			position:absolute;
			bottom:2%;
			width:100%;
			z-index:2147483647;
		}
		figure[data-fullscreen=true] .controls li {
			width:5%;
		}
		figure[data-fullscreen=true] .controls .progress {
			width:68%;
		}
	</style>
</head>
<body>
	<figure id="videoContainer" data-fullscreen="false">
		<video id="video" controls preload="metadata" src="" loop autoplay></video>
		<ul id="video-controls" class="controls">
			<li><button id="playpause" type="button">►</button></li>
			<li><button id="stop" type="button">◼︎</button></li>
			<li class="progress">
				<progress id="progress" value="0" min="0">
					<span id="progress-bar"></span>
				</progress>
			</li>
			<li><button id="mute" type="button">🔇</button></li>
			<li><button id="voldec" type="button">-</button></li>
			<li><button id="volinc" type="button">+</button></li>			
			<li><button id="fs" type="button">📺</button></li>
		</ul>
	</figure>

	<script src="/c/sys42.js?v=2.4.2"></script>

	<script>

		function getParameterByName(name, url) {
		    if (!url) url = window.location.href;
		    name = name.replace(/[\[\]]/g, '\\$&');
		    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
		        results = regex.exec(url);
		    if (!results) return null;
		    if (!results[2]) return '';
		    return decodeURIComponent(results[2].replace(/\+/g, ' '));
		}


      function openVideo(path) {
        window.parent.$file.open(path, 'URL', function(val) {
          $state.loaded();
          document.getElementById('video').setAttribute('src', val);
        });
      }

      $state.loading();
      if ($url.query.w) {
        openVideo($url.query.w)
      } else {
      	
        parent.$explorer('c/files/movies/', {browse: true, explorer: true, onclose: function(ok, file) {
          if (ok) openVideo(file);
        }})
      	
      }

		(function () {
		  'use strict';

		  // Does the browser actually support the video element?
		  var supportsVideo = !!document.createElement('video').canPlayType;

		  if (supportsVideo) {
		  	// Obtain handles to main elements
		  	var videoContainer = document.getElementById('videoContainer');
		   	var video = document.getElementById('video');
		   	var videoControls = document.getElementById('video-controls');

		   	// Hide the default controls
		   	video.controls = false;

		   	// Display the user defined video controls
		   	videoControls.style.display = 'block';

		   	// Obtain handles to buttons and other elements
		   	var playpause = document.getElementById('playpause');
		   	var stop = document.getElementById('stop');
		   	var mute = document.getElementById('mute');
		   	var volinc = document.getElementById('volinc');
		   	var voldec = document.getElementById('voldec');
		   	var progress = document.getElementById('progress');
		    var progressBar = document.getElementById('progress-bar');
		   	var fullscreen = document.getElementById('fs');

		    // Check if the browser supports the Fullscreen API
		    var fullScreenEnabled = !!(document.fullscreenEnabled || document.mozFullScreenEnabled || document.msFullscreenEnabled || document.webkitSupportsFullscreen || document.webkitFullscreenEnabled || document.createElement('video').webkitRequestFullScreen);
		    // If the browser doesn't support the Fulscreen API then hide the fullscreen button
		    if (!fullScreenEnabled) {
		      fullscreen.style.display = 'none';
		    }

		   	// Change the volume
		   	var alterVolume = function(dir) {
		   		var currentVolume = Math.floor(video.volume * 10) / 10;
		   		if (dir === '+') {
		   			if (currentVolume < 1) video.volume += 0.1;
		   		}
		   		else if (dir === '-') {
		  			if (currentVolume > 0) video.volume -= 0.1;
		   		}
		   	}

		   	// Set the video container's fullscreen state
		  	var setFullscreenData = function(state) {
		  		videoContainer.setAttribute('data-fullscreen', !!state);
		  	}

		  	// Checks if the document is currently in fullscreen mode
		   	var isFullScreen = function() {
		   		return !!(document.fullScreen || document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || document.fullscreenElement);
		   	}

		   	// Fullscreen
		   	var handleFullscreen = function() {
		   		// If fullscreen mode is active...	
		    		if (isFullScreen()) {
		    			// ...exit fullscreen mode
		    			// (Note: this can only be called on document)
		    			if (document.exitFullscreen) document.exitFullscreen();
		    			else if (document.mozCancelFullScreen) document.mozCancelFullScreen();
		    			else if (document.webkitCancelFullScreen) document.webkitCancelFullScreen();
		    			else if (document.msExitFullscreen) document.msExitFullscreen();
		    			setFullscreenData(false);
		    		}
		    		else {
		    		  // ...otherwise enter fullscreen mode
		    			// (Note: can be called on document, but here the specific element is used as it will also ensure that the element's children, e.g. the custom controls, go fullscreen also)
		          if (videoContainer.requestFullscreen) videoContainer.requestFullscreen();
		    		  else if (videoContainer.mozRequestFullScreen) videoContainer.mozRequestFullScreen();
		    		  else if (videoContainer.webkitRequestFullScreen) {
		    				// Safari 5.1 only allows proper fullscreen on the video element. This also works fine on other WebKit browsers as the following CSS (set in styles.css) hides the default controls that appear again, and 
		            // ensures that our custom controls are visible:
		            // figure[data-fullscreen=true] video::-webkit-media-controls { display:none !important; }
		            // figure[data-fullscreen=true] .controls { z-index:2147483647; }
		    				video.webkitRequestFullScreen();
		    			}
		    			else if (videoContainer.msRequestFullscreen) videoContainer.msRequestFullscreen();
		    			setFullscreenData(true);
		    		}
		  	}

		   	// Only add the events if addEventListener is supported (IE8 and less don't support it, but that will use Flash anyway)
		   	if (document.addEventListener) {
		   		// Wait for the video's meta data to be loaded, then set the progress bar's max value to the duration of the video
		   		video.addEventListener('loadedmetadata', function() {
		   			progress.setAttribute('max', video.duration);
		   		});

		   		// Add events for all buttons
		   		playpause.addEventListener('click', function(e) {
		   			if (video.paused || video.ended) video.play();
		   			else video.pause();
		   		});

		   		// The Media API has no 'stop()' function, so pause the video and reset its time and the progress bar
		   		stop.addEventListener('click', function(e) {
		   			video.pause();
		   			video.currentTime = 0;
		   			progress.value = 0;
		   		});
		   		mute.addEventListener('click', function(e) {
		   			video.muted = !video.muted;
		   		});
		   		volinc.addEventListener('click', function(e) {
		   			alterVolume('+');
		   		});
		   		voldec.addEventListener('click', function(e) {
		   			alterVolume('-');
		   		});
		   		fs.addEventListener('click', function(e) {
		   			handleFullscreen();
		   		});

		   		// As the video is playing, update the progress bar
		   		video.addEventListener('timeupdate', function() {
		        // For mobile browsers, ensure that the progress element's max attribute is set
		        if (!progress.getAttribute('max')) progress.setAttribute('max', video.duration);
		        progress.value = video.currentTime;
		        progressBar.style.width = Math.floor((video.currentTime / video.duration) * 100) + '%';
		   		});

		      // React to the user clicking within the progress bar
		      progress.addEventListener('click', function(e) {
		        var pos = (e.pageX  - this.offsetLeft) / this.offsetWidth;
		        video.currentTime = pos * video.duration;
		      });

		   		// Listen for fullscreen change events (from other controls, e.g. right clicking on the video itself)
		   		document.addEventListener('fullscreenchange', function(e) {
		   			setFullscreenData(!!(document.fullScreen || document.fullscreenElement));
		   		});
		   		document.addEventListener('webkitfullscreenchange', function() {
		   			setFullscreenData(!!document.webkitIsFullScreen);
		   		});
		   		document.addEventListener('mozfullscreenchange', function() {
		   			setFullscreenData(!!document.mozFullScreen);
		   		});
		   		document.addEventListener('msfullscreenchange', function() {
		   			setFullscreenData(!!document.msFullscreenElement);
		   		});
		   	}
		  }

		})();
	</script>
</body>
</html>