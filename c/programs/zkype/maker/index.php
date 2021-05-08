<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>PDM annotation</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
<link rel="stylesheet" type="text/css" href="./css/imgareaselect-default.css" />

<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/jquery.imgareaselect.pack.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="./js/json2.js"></script>
<script src="./js/BlobBuilder.min.js"></script>
<script src="./js/Filesaver.min.js"></script>

<script src="./js/utils.js"></script>
<script src="./js/clmtrackr.js"></script>
<script src="./js/model_pca_20_svm.js"></script>

<style>
  #container {
    position : relative;
  }

  #vis {
    position : absolute;
    z-index : 10;
  }

  #imageholder {
    /*position : absolute;*/
  }

  #sketch {
    display : none;
  }

  .t, .controltext {
    font-size: .6em;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    display: none;
  }

  .control {
    /*fill: #ccc;*/
    stroke: #000;
    stroke-width: .5px;
  }
</style>
<body>
  <canvas id="sketch" width="138" height="138"></canvas>
  <p>
    Load images:
    <input type="file" id="files" name="files[]" multiple />
    <span id="imagenumber"></span>
    <button value="prev" id="back" disabled >prev</button>
    <button value="next" id="forward" disabled >next</button>
  </p>
  <p>
    <button value="save annotations to csv" id="savefile">save annotations to csv</button>
    <button value="clear all stored annotations" id="cleardata">clear all stored annotations</button>
    Load annotations from csv:<input type="file" value="load points from csv" id="loadcsv"/>
  </p>
  <p>
    <button value="manually select face" id="manualselect">manually select face</button>
    Zoom:<button value="+" id="zoomin">+</button>
    <button value="-" id="zoomout">-</button>
  </p>
  <script>
    var paths = [
      [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],
      [15,16,17,18],
      [19,20,21,22],
      [23,63,24,64,25,65,26,66,23],
      [28,67,29,68,30,69,31,70,28],
      [34,35,36,42,37,43,38,39,40],
      [33,41,62],
      [44,45,46,47,48,49,50,51,52,53,54,55,44,56,57,58,50,59,60,61,44]
    ];

    /*var paths = [
      [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],
      [15,16,17,18],
      [19,20,21,22],
      [23,63,24,64,25,65,26,66,23],
      [28,67,29,68,30,69,31,70,28],
      [33,34,35,36,42,37,43,38,39,40,41],
      [44,45,46,47,48,49,50,51,52,53,54,55,44,56,57,58,50,59,60,61,44]
    ];*/

    /*var paths = [
      [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],
      [15,16,17,18,19,20],
      [21,22,23,24,25,26],
      [27,68,28,69,29,70,30,71,27],
      [32,72,33,73,34,74,35,75,32],
      [37,38,39,40,46,41,47,42,43,44,45],
      [48,49,50,51,52,53,54,55,56,57,58,59,48,60,61,62,54,63,64,65,48]
    ];*/

  </script>
  <script src="./main.js"></script>
  <div id="container">
  <div id="vis">
  </div>
  <span id="imageholder"></span>
  </div>
  <button value="export current coordinates" id="exportCoord">export current coordinates</button>
  <br>

  <textarea onclick="this.select()" name="" id="coordinates" cols="80" rows="20"></textarea>
  <script>
    document.getElementById('back').addEventListener("click", function() {prevImage();});
    document.getElementById('forward').addEventListener("click", function() {nextImage();});
    document.getElementById('savefile').addEventListener("click", function() {storeToCSV("annotations.csv");});
    document.getElementById('cleardata').addEventListener("click", function() {localStorage.clear();});
    document.getElementById('manualselect').addEventListener("click", function() {selectBox();});
    document.getElementById('exportCoord').addEventListener("click", function() {var te = exportToString();document.getElementById('coordinates').value = te;});
    document.getElementById('zoomin').addEventListener("click", function() {scaleUp();});
    document.getElementById('zoomout').addEventListener("click", function() {scaleDown();});
  </script>
</body>
</html>