<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Recorder</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
    <title>Recorder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div id="top">
      <div id="controls">
    	 <button id="recordButton">Record</button>
    	 <button id="pauseButton" disabled>Pause</button>
    	 <button id="stopButton" disabled>Stop</button>
      </div>
      <div id="formats">Format: start recording to see sample rate</div>
    	<h4>Recordings</h4>
    </div>

  	<ol id="recordingsList"></ol>

    <!-- inserting these scripts at the end to be able to use all the elements in the DOM -->
  	<script src="js/recorder.js"></script>
  	<script src="js/app.js"></script>
    
  </body>
</html>