<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Speech Synthesis</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>

<body class="skin_base noscroll">

  <style>
  body {
    padding: 4px;
    padding-right: 5px;
  }
  #msg {
    font-size: 0.9em;
    line-height: 1.4em;
  }
  #msg.not-supported strong {
    color: #CC0000;
  }
  textarea, select {
    width: 100%;
  }
  input[type="range"] {
    width: 100%;
  }
  label {
    display: inline-block;
    float: left;
    width: 150px;
  }
  .option {
    margin: 1em 0;
  }

  button {
    display: inline-block;
    width: 100%;
    text-align: center;
  }
  </style>

  <div id="page-wrapper">

  <p id="msg"></p>

  <!-- <input type="text" name="speech-msg" id="speech-msg" x-webkit-speech> -->
  <textarea name="speech-msg" id="speech-msg" x-webkit-speech cols="30" rows="7"></textarea>

	<div class="option">
		<label for="voice">Voice</label>
		<select name="voice" id="voice"></select>
	</div>
	<div class="option">
		<label for="volume">Volume</label>
		<input type="range" min="0" max="1" step="0.1" name="volume" id="volume" value="1">
	</div>
	<div class="option">
		<label for="rate">Rate</label>
		<input type="range" min="0.1" max="10" step="0.1" name="rate" id="rate" value="1">
	</div>
	<div class="option">
		<label for="pitch">Pitch</label>
		<input type="range" min="0" max="2" step="0.1" name="pitch" id="pitch" value="1">
	</div>

	<button id="speak">Speak</button>

</div>

  <script src="js/index.js"></script>

</body>
</html>
