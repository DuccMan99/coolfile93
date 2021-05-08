<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Bytebeat</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>


<style>
  canvas{
    background-color: #000;
  }

  #controls > button:first-child {
    width:80px;
  }
  #controls > button:nth-child(2) {
    width:60px;
  }
  #code{
    background:transparent;
    border: 0 none;
    box-shadow: none;
    resize:none;
    color: #fff;
    font-family: _tomo, monospace;
    font-size: 16px;
    //line-height: 36px;
    line-height: 1.3;
    text-indent: 0;
    padding: 15px 18px;
    text-shadow: 0px 0px 10px #000;
  }
  #toutou{
    background-image: url('img/iHaveNoIdeaWahtImDoing.png');
    background-position: bottom right;
    background-repeat: no-repeat;
    pointer-events: none;
  }
</style>

<body class="skin_base">

<div class="ui_layout">
  <header class="pa0">
    <div id="controls" class="ui_combo"></div>
    <select name="" id="collec">
      <option value="t">trivial minimum: plain sawtooth</option>
      <option value="t&t>>8">minimal sierpinski harmony</option>
      <option value="t*(42&t>>10)">"the 42 melody", separately discovered by several people on irc etc</option>
      <option value="t|t%255|t%257">danharaj 2011-10-03 http://www.reddit.com/r/programming/comments/kyj77/algorithmic_symphonies_from_one_line_of_code_how/ "fractal trees", 216's version</option>
      <option value="t>>6&1?t>>5:-t>>4">droid 2011-10-05 http://pouet.net/topic.php?which=8357&page=10</option>
      <option value="t*(t>>9|t>>13)&16">Niklas_Roy 2011-10-14 http://countercomplex.blogspot.com/2011/10/algorithmic-symphonies-from-one-line-of.html</option>
      <option value="(t&t>>12)*(t>>4|t>>8)">krcko 2011-10-04 http://rafforum.rs/index.php/topic,123.0.html</option>
      <option value="(t*5&t>>7)|(t*3&t>>10)">viznut 2011-10-10 http://www.youtube.com/watch?v=tCRPUv8V22o</option>
      <option value="(t*(t>>5|t>>8))>>(t>>16)">tejeez 2011-09-18 http://www.youtube.com/watch?v=GtQdIYUtAHg</option>
      <option value="t*5&(t>>7)|t*3&(t*4>>10)">miiro 2011-09-30 http://www.youtube.com/watch?v=qlrs2Vorw2Y</option>
      <option value="(t>>13|t%24)&(t>>7|t%19)">robert 2011-10-11 http://countercomplex.blogspot.com/2011/10/algorithmic-symphonies-from-one-line-of.html</option>
      <option value="(t*((t>>9|t>>13)&15))&129">Niklas_Roy 2011-10-14 http://countercomplex.blogspot.com/2011/10/algorithmic-symphonies-from-one-line-of.html</option>
      <option value="(t&t%255)-(t*3&t>>13&t>>6)">viznut 2011-10-10 http://www.youtube.com/watch?v=tCRPUv8V22o  </option>
      <option value="(t&t>>12)*(t>>4|t>>8)^t>>6">krcko 2011-10-04 http://rafforum.rs/index.php/topic,123.0.html</option>
      <option value="t*(((t>>9)^((t>>9)-1)^1)%13)">blueberry 2011-10-05 http://pouet.net/topic.php?which=8357&page=12 11kHz</option>
      <option value="t*(0xCA98>>(t>>9&14)&15)|t>>8">rrola 2011-10-04 http://pouet.net/topic.php?which=8357&page=9 optimized by ryg</option>
      <option value="(t/8)>>(t>>9)*t/((t>>14&3)+4)">tonic 2011-10-01 http://pouet.net/topic.php?which=8357&page=5 "mr. arpeggiator playing a solo"</option>
      <option value="(~t/100|(t*3))^(t*3&(t>>5))&t">FreeFull 2011-10-12 http://countercomplex.blogspot.com/2011/10/algorithmic-symphonies-from-one-line-of.html</option>
      <option value="(t|(t>>9|t>>7))*t&(t>>11|t>>9)">red- 2011-09-30 http://www.youtube.com/watch?v=qlrs2Vorw2Y</option>
      <option value="((t>>1%128)+20)*3*t>>14*t>>18 ">harism 2011-10-09 http://0xa.kuri.mu/2011/10/09/bitop-videos/</option>
      <option value="t&(sin(t&t&3)*t>>5)/(t>>3&t>>6)">droid 2011-10-04 http://pouet.net/topic.php?which=8357&page=9</option>
      <option value="t*(((t>>12)|(t>>8))&(63&(t>>4)))">viznut 2011-09-18 http://www.youtube.com/watch?v=GtQdIYUtAHg</option>
      <option value="t*(((t>>9)|(t>>13))&(25&(t>>6)))">visy 2011-09-18 http://www.youtube.com/watch?v=GtQdIYUtAHg</option>
      <option value="t*(t^t+(t>>15|1)^(t-1280^t)>>10)">216 2011-10-10 http://www.youtube.com/watch?v=tCRPUv8V22o</option>
      <option value="t*(((t>>11)&(t>>8))&(123&(t>>3)))">tejeez 2011-09-18 http://www.youtube.com/watch?v=GtQdIYUtAHg</option>
      <option value="(t>>7|t|t>>6)*10+4*(t&t>>13|t>>6)">viznut 2011-09-30 http://www.youtube.com/watch?v=qlrs2Vorw2Y (xpansive+varjohukka)</option>
      <option value="(t*9&t>>4|t*5&t>>7|t*3&t/1024)-1">stephth 2011-10-03 http://news.ycombinator.com/item?id=3063359</option>
      <option value="t*(t>>((t>>9)|(t>>8))&(63&(t>>4)))">visy 2011-09-18 http://www.youtube.com/watch?v=GtQdIYUtAHg "Space Invaders vs Pong"</option>
      <option value="(t>>6|t|t>>(t>>16))*10+((t>>11)&7)">viznut 2011-09-30 http://www.youtube.com/watch?v=qlrs2Vorw2Y</option>
      <option value="(t>>1)*(0xbad2dea1>>(t>>13)&3)|t>>5">yumeji 2011-10-04 http://pouet.net/topic.php?which=8357&page=9</option>
      <option value="(t>>4)*(13&(0x8898a989>>(t>>11&30)))">ryg 2011-10-04 http://pouet.net/topic.php?which=8357&page=8</option>
      <option value="(t>>(t&7))|(t<<(t&42))|(t>>7)|(t<<5)">marmakoide 2011-10-04 http://pouet.net/topic.php?which=8357&page=8</option>
      <option value="(t>>7|t%45)&(t>>8|t%35)&(t>>11|t%20)">robert 2011-10-11 http://countercomplex.blogspot.com/2011/10/algorithmic-symphonies-from-one-line-of.html</option>
      <option value="(t>>6|t<<1)+(t>>5|t<<3|t>>3)|t>>2|t<<1">lucasvb 2011-10-03 http://www.reddit.com/r/programming/comments/kyj77/algorithmic_symphonies_from_one_line_of_code_how/</option>
      <option value="t+(t&t^t>>6)-t*((t>>9)&(t%16?2:6)&t>>9)">bear @ celephais</option>
      <option value="((t*(t>>8|t>>9)&46&t>>8))^(t&t>>13|t>>6)">xpansive 2011-09-29 http://pouet.net/topic.php?which=8357&page=2 "Lost in Space"</option>
      <option value='t*(1+"4451"[t>>13&3]/10)&t>>9+(t*0.003&3)'>rez 2011-10-05 http://pouet.net/topic.php?which=8357&page=11 js-only optimized by ryg</option>
      <option value="(t>>5)|(t<<4)|((t&1023)^1981)|((t-67)>>4)">marmakoide 2011-10-03 http://pouet.net/topic.php?which=8357&page=7 "Lemmings March"</option>
      <option value="t>>4|t&(t>>5)/(t>>7-(t>>15)&-t>>7-(t>>15))">droid 2011-10-04 http://pouet.net/topic.php?which=8357&page=9</option>
      <option value="t*(t/256)-t*(t/255)+t*(t>>5|t>>6|t<<2&t>>1)">rez 2011-10-03 http://pouet.net/topic.php?which=8357&page=7</option>
      <option value="((t>>5&t)-(t>>5)+(t>>5&t))+(t*((t>>14)&14))">viznut 2011-10-06 #countercomplex "moon scanner generalization", based on jaffa's formula</option>
      <option value="(t*((3+(1^t>>10&5))*(5+(3&t>>14))))>>(t>>8&3)">viznut 2011-10-04 http://pouet.net/topic.php?which=8357&page=9</option>
      <option value="t>>4|t&DIV((t>>5),(t>>7-(t>>15)&-t>>7-(t>>15)))">droid 2011-10-10 http://www.youtube.com/watch?v=tCRPUv8V22o</option>
      <option value="v=(v>>1)+(v>>4)+t*(((t>>16)|(t>>6))&(69&(t>>9)))">pyryp 2011-09-30 http://www.youtube.com/watch?v=qlrs2Vorw2Y</option>
      <option value="(int)(t/1e7*t*t+t)%127|t>>4|t>>5|t%127+(t>>16)|t">bst 2011-10-10 http://www.youtube.com/watch?v=tCRPUv8V22o</option>
      <option value="t*(((t>>9)&10)|((t>>11)&24)^((t>>10)&15&(t>>15)))">tangent128 2011-10-09 http://0xa.kuri.mu/2011/10/09/bitop-videos/</option>
      <option value="(~t>>2)*((127&t*(7&t>>10))<(245&t*(2+(5&t>>14))))">tejeez 2011-10-05 #countercomplex</option>
      <option value="(t+(t>>2)|(t>>5))+(t>>3)|((t>>13)|(t>>7)|(t>>11))">lokori 2011-10-04 #suomiscene</option>
      <option value="t*(t>>8*((t>>15)|(t>>8))&(20|(t>>19)*5>>t|(t>>3)))">visy 2011-09-18 http://www.youtube.com/watch?v=GtQdIYUtAHg</option>
      <option value="(t>>4)|(t%10)|(((t%101)|(t>>14))&((t>>7)|(t*t%17)))">Aaron_Krister_Johnson 2011-10-14 http://countercomplex.blogspot.com/2011/10/algorithmic-symphonies-from-one-line-of.html</option>
      <option value="((t&((t>>5)))+(t|((t>>7))))&(t>>6)|(t>>5)&(t*(t>>7))">jounim 2011-10-04 #suomiscene</option>
      <option value="((t&((t>>23)))+(t|(t>>2)))&(t>>3)|(t>>5)&(t*(t>>7))">spikey 2011-10-04 #suomiscene based on jounim's formula</option>
      <option value="(((((t*((t>>9|t>>13)&15))&255/15)*9)%(1<<7))<<2)%6<<4">akx 2011-10-05 http://twitter.com/#!/akx</option>
      <option value="((t%42)*(t>>4)|(0x15483113)-(t>>4))/(t>>16)^(t|(t>>4))">bst 2011-10-05 http://pouet.net/topic.php?which=8357&page=10</option>
      <option value="t*(t>>((t&4096)?((t*t)/4096):(t/4096)))|(t<<(t/256))|(t>>4)">skurk 2011-10-04 http://pouet.net/topic.php?which=8357&page=8</option>
      <option value="((t&4096)?((t*(t^t%255)|(t>>4))>>1):(t>>3)|((t&8192)?t<<2:t))">skurk+raer 2011-09-30 http://www.youtube.com/watch?v=qlrs2Vorw2Y</option>
      <option value="t*((0xbadbea75>>((t>>12)&30)&3)*0.25*(0x5afe5>>((t>>16)&28)&3))">yumeji 2011-10-06 http://pouet.net/topic.php?which=8357&page=12 "badbeats & safe"</option>
      <option value="t>>16|((t>>4)%16)|((t>>4)%192)|(t*t%64)|(t*t%96)|(t>>16)*(t|t>>5)">bst 2011-10-11 http://pouet.net/topic.php?which=8357&page=18</option>
      <option value="t>>6^t&37|t+(t^t>>11)-t*((t%24?2:6)&t>>11)^t<<1&(t&598?t>>4:t>>10) ">bear @ celephais</option>
      <option value="((t/2*(15&(0x234568a0>>(t>>8&28))))|t/2>>(t>>11)^t>>12)+(t/16&t&24)">kb 2011-10-04 http://pouet.net/topic.php?which=8357&page=8 44kHz</option>
      <option value="(t>>5)|(t>>4)|((t%42)*(t>>4)|(0x15483113)-(t>>4))/(t>>16)^(t|(t>>4))">bst 2011-10-05 http://pouet.net/topic.php?which=8357&page=12</option>
      <option value="(-t&4095)*(255&t*(t&(t>>13)))>>12)+(127&t*(234&t>>8&t>>3)>>(3&t>>14))">tejeez 2011-09-18 http://www.youtube.com/watch?v=GtQdIYUtAHg</option>
      <option value="(t*t/256)&(t>>((t/1024)%16))^t%64*(0xC0D3DE4D69>>(t>>9&30)&t%32)*t>>18">ultrageranium 2011-10-12 http://0xa.kuri.mu/2011/10/09/bitop-videos/</option>
      <option value="(t%25-(t>>2|t*15|t%227)-t>>3)|((t>>5)&(t<<5)*1663|(t>>3)%1544)/(t%17|t%2048)">visy 2011-10-06 http://pouet.net/topic.php?which=8357&page=13</option>
      <option value='((t*("36364689"[t>>13&7]&15))/12&128)+(((((t>>12)^(t>>12)-2)%11*t)/4|t>>13)&127)'>ryg 2011-10-10 http://www.youtube.com/watch?v=tCRPUv8V22o 44.1 kHz</option>
      <option value='(3e3/(y=t&16383)&1)*35 +(x=t*"6689"[t>>16&3]/24&127)*y/4e4 +((t>>8^t>>10|t>>14|x)&63)'>mu6k http://www.youtube.com/watch?v=tCRPUv8V22o 32.0 kHz</option>
      <option value="((1-(((t+10)>>((t>>9)&((t>>14))))&(t>>4&-2)))*2)*(((t>>10)^((t+((t>>6)&127))>>10))&1)*32+128">Ola 2011-10-11 http://countercomplex.blogspot.com/2011/10/algorithmic-symphonies-from-one-line-of.html</option>
      <option value="L: ((t&4096)?((t*(t^t%255)|(t>>4))>>1):(t>>3)|((t&8192)?t<<2:t)) R: t*(((t>>9)^((t>>9)-1)^1)%13)">raer 2011-10-07 http://pouet.net/topic.php?which=8357&page=16 stereo 11kHz</option>
      <option value="((t>>4)*(13&(0x8898a989>>(t>>11&30)))&255)+((((t>>9|(t>>2)|t>>8)*10+4*((t>>2)&t>>15|t>>8))&255)>>1)">ryg 2011-10-04 http://pouet.net/topic.php?which=8357&page=8</option>
      <option value="(t<<3)*[8/9,1,9/8,6/5,4/3,3/2,0][[0xd2d2c8,0xce4088,0xca32c8,0x8e4009][t>>14&3]>>(0x3dbe4688>>((t>>10&15)>9?18:t>>10&15)*3&7)*3&7]">gasman 2011-10-05 http://pouet.net/topic.php?which=8357&page=12 js-only</option>
      <option value='SS=function(s,o,r,p){var c=s.charCodeAt((t>>r)%p);return c==32?0:31&t*Math.pow(2,c/12-o)},SS("0 0     7 7     037:<<",6,10,32) + (t&4096?SS("037",4,8,3)*(4096-(t&4095))>>12 : 0)'>a1k0n http://news.ycombinator.com/item?id=3063359 js-only</option>
      <option value='w=t>>9,k=32,m=2048,a=1-t/m%1,d=(14*t*t^t)%m*a,y=[3,3,4.7,2][p=w/k&3]*t/4,h="IQNNNN!!]]!Q!IW]WQNN??!!W]WQNNN?".charCodeAt(w/2&15|p/3<<4)/33*t-t,s=y*.98%80+y%80+(w>>7&&a*((5*t%m*a&128)*(0x53232323>>w/4&1)+(d&127)*(0xa444c444>>w/4&1)*1.5+(d*w&1)+(h%k+h*1.99%k+h*.49%k+h*.97%k-64)*(4-a-a))),s*s>>14?127:s'>mu6k 2011-10-10 http://www.youtube.com/watch?v=tCRPUv8V22o "Long-line Theory", Chaos Theory cover, optimized by ryg, p01 et al., JS-only</option>
      <option value="((((t>>10)&(sin((t>>10)/100)+1)*42)<<t)/tan(t>>10))&(t>>100)%t">Ponali 2021-01-29</option>
    </select>
  </header>

  <section class="noscroll">
    <canvas id="visualization" class="fullscreen"></canvas>
    <textarea spellcheck="false" id="code" class="fullscreen"></textarea>
    <div id="toutou" class="fullscreen animated lightSpeedIn hide"></div>
  </section>

</div>

<div id="savedialog" style="display:none;">
  <div id="savecontainer">
    <div id="saveform">
      <div>
        <img id="screenshot" />
      </div>
      <div><button id="save">save</button><button id="cancel">cancel</button></div>
    </div>
  </div>
</div>

<script src="js/lzma.js"></script>
<script type="text/javascript" src="js/tdl/tdl-min.js"></script>

<script id="waveVertexShader" type="not-js">
attribute float column;
attribute float height;
uniform float position;
void main() {
  gl_Position = vec4(mod(column - position, 1.0) * 2.0 - 1.0, height, 0, 1);
}
</script>
<script id="waveFragmentShader" type="not-js">
precision mediump float;
uniform vec4 color;
void main() {
  gl_FragColor = color;
}
</script>
<script id="sampleVertexShader" type="not-js">
attribute vec2 position;
uniform float offset;
varying vec2 v_texCoord;
void main() {
  gl_Position = vec4(position, 0, 1);
  v_texCoord = vec2(position * 0.5 + 0.5) + vec2(offset, 0);
}
</script>
<script id="sampleFragmentShader" type="not-js">
precision mediump float;
varying vec2 v_texCoord;
uniform sampler2D tex;
uniform vec4 color;
void main() {
  float height = texture2D(tex, v_texCoord).r * 0.5;
  float m = v_texCoord.y > height ? 0.0 : 1.0;
  gl_FragColor = color * m;
}
</script>
<script id="dataVertexShader" type="not-js">
attribute vec2 position;
uniform float offset;
varying vec2 v_texCoord;
void main() {
  gl_Position = vec4(position, 0, 1);
  v_texCoord = vec2(position * 0.5 + 0.5) + vec2(offset, 0);
}
</script>
<script id="dataFragmentShader" type="not-js">
precision mediump float;
varying vec2 v_texCoord;
uniform sampler2D tex;
uniform vec4 color;
void main() {
  int c = int(texture2D(tex, v_texCoord).r * 255.0);
  int y = int(v_texCoord.y * 8.0);
  int p = int(pow(2.0, float(y)));
  c = c / p;
  float m = mod(float(c), 2.0);
  float line = mod(gl_FragCoord.y, 3.0) / 2.0;
  gl_FragColor = color * m;
}
</script>
<script type="string" id="postfix-template">
return function(t, i, stack) {
  $(exp)
};
</script>



<script>
tdl.require('tdl.buffers');
tdl.require('tdl.fast');
tdl.require('tdl.models');
tdl.require('tdl.primitives');
tdl.require('tdl.programs');
tdl.require('tdl.textures');
tdl.require('tdl.webgl');

window.addEventListener('load', main);

function $(id) {
  return document.getElementById(id);
}

var g_byteBeat;
var g_visualizer;
var g_screenshot;
var g_saving = false;
var g_saveDialogInitialized = false;
var g_screenshotCanvas;
var g_screenshotContext;
var gl;
var playing = false;
var play;
var codeElem;
var canvas;
var requestId;
var compressor;
var dontSet = true;
var g_slow = false;
var g_needUserGesture = false;

function log(msg) {
  if (window.console && window.console.log) {
    window.console.log(msg);
  }
}

function main() {
  var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
  g_slow = iOS;
  g_needUserGesture = iOS;
  compressor = new LZMA( "js/lzma_worker.js" );
  canvas = $("visualization");
  controls = $("controls");

  g_byteBeat = new ByteBeat();
  if (!g_byteBeat.good) {
    alert("This page needs a browser the supports the Web Audio API or the Audio Data API: Chrome, Chromium, Firefox, or WebKit");
  }

  g_screenshotCanvas = document.createElement("canvas");
  //g_screenshotCanvas.width = 400;
  //g_screenshotCanvas.height = 100;
  g_screenshotContext = g_screenshotCanvas.getContext("2d");

  function resetToZero() {
    g_byteBeat.reset();
    g_visualizer.reset();
    g_visualizer.render();
    updateTimeDisplay();
  }

  /*
  helpElem = document.createElement('a');
  helpElem.href = "https://github.com/greggman/html5bytebeat";
  helpElem.innerHTML = "?";
  helpElem.className = "buttonstyle";
  controls.appendChild(helpElem);
  */
  timeElem = document.createElement('button');
  timeElem.textContent = 0;
  controls.appendChild(timeElem);
  timeElem.addEventListener('click', resetToZero);

  function playPause() {
    playing = !playing;
    if (playing) {
      g_byteBeat.play();
      playElem.textContent = "pause ■";
    } else {
      g_byteBeat.pause();
      playElem.textContent = " play ▶";
      updateTimeDisplay();
    }
  }
  playElem = document.createElement('button');
  playElem.addEventListener('click', playPause);
  playElem.textContent = " play ▶";
  controls.appendChild(playElem);

  function addSelection(options, selectedIndex) {
    var select = document.createElement('select');
    for (var i = 0; i < options.length; ++i) {
      option = document.createElement('option');
      option.textContent = options[i];
      if (i == selectedIndex) {
        option.selected = true;
      }
      select.appendChild(option);
    }
    return select;
  }

  beatTypeElem = addSelection(["bytebeat", "floatbeat"], 0);
  beatTypeElem.addEventListener('change', function(event) {
    g_byteBeat.setType(event.target.selectedIndex);
    setURL();
  }, false);
  controls.appendChild(beatTypeElem);

  expressionTypeElem = addSelection(["infix", "postfix(rpn)", "glitch"], 0);
  //expressionTypeElem = addSelection(["infix", "postfix(rpn)"], 0);
  expressionTypeElem.addEventListener('change', function(event) {
    g_byteBeat.setExpressionType(event.target.selectedIndex);
    g_byteBeat.recompile();
  }, false);
  controls.appendChild(expressionTypeElem);

  var sampleRates = [8000, 11000, 22000, 32000, 44100];
  sampleRateElem = addSelection(["8kHz", "11kHz", "22kHz", "32kHz", "44kHz"], 0);
  sampleRateElem.addEventListener('change', function(event) {
    g_byteBeat.setDesiredSampleRate(sampleRates[event.target.selectedIndex]);
  }, false);
  controls.appendChild(sampleRateElem);

  visualTypeElem = addSelection(["none", "wave"], 1);
  visualTypeElem.addEventListener('change', function(event) {
    g_visualizer.setType(event.target.selectedIndex);
  }, false);
  controls.appendChild(visualTypeElem);

  if (false) {
    saveElem = document.createElement("button");
    saveElem.textContent = "save";
    saveElem.addEventListener('click', startSave);
    controls.appendChild(saveElem);
  }

  //compileStatusElem = document.createElement('button');
  //compileStatusElem.textContent = "---";
  //controls.appendChild(compileStatusElem);

  if (g_slow) {
    g_visualizer = new NullVisualizer();
  } else {
    gl = tdl.webgl.setupWebGL(
      canvas,
      { alpha:false,
        antialias:false,
        preserveDrawingBuffer:true
      },
      function(){});

    g_visualizer = gl ? new WebGLVisualizer(canvas) : new CanvasVisualizer(canvas);
  }
  g_byteBeat.setVisualizer(g_visualizer);

  codeElem = $("code");
  codeElem.addEventListener('keyup', function(event) {
    if (event.keyCode == 37 ||
        event.keyCode == 38 ||
        event.keyCode == 39 ||
        event.keyCode == 40) {
      return;
    }
    var val = codeElem.value
    val.replace(/\s*/g, '')
    compile(val);
  }, false );

  document.getElementById('collec').addEventListener('change', function(event) {
    //console.log('forkable');
    codeElem.value = this.value;
    compile(codeElem.value);
  }, false );

  codeElem.addEventListener('keydown', function(event) {
      if (event.keyCode == 9) {
          // Fake TAB
          event.preventDefault();

          var start = codeElem.selectionStart;
          var end = codeElem.selectionEnd;

          codeElem.value = codeElem.value.substring(0, start) + '\t' + codeElem.value.substring(end, codeElem.value.length);

          codeElem.selectionStart = codeElem.selectionEnd = start + 1;
          codeElem.focus();
      }
  }, false);

  g_byteBeat.setOnCompile(handleCompileError);
  g_visualizer.setOnCompile(handleCompileError);

  if (window.location.hash) {
    var hash = window.location.hash.substr(1);
    readURL(hash);
  } else {
    readURL('t=0&e=1&s=8000&bb=5d00000100820000000000000000141d0398331485f67e0b28b0c176664eb1ec3bdae84654e054dc46ca9f83a3798889d917d3a224d0c4f5fbae609e8b4c91e47e82a89af25991299636276d2aaa41d468b25b8445f9bfcca0b20f213938200c485b6af72d3e38b2abbefca7f4e3df60bba8415142bbb0ffe803c800');
  }

  onWindowResize();
  window.addEventListener('resize', onWindowResize, false);
  //playPause();
  if (g_needUserGesture) {
    playPause();  // Pause it because play didn't work.
    var s = $("startContainer");
    s.style.display = "table";
    s.addEventListener('click', function() {
      s.style.display = "none";
      playPause();
    }, false);
  }

  function render() {
    if (playing) {
      updateTimeDisplay();
      g_visualizer.render();
    }
    requestId = tdl.webgl.requestAnimationFrame(render, canvas);
  }
  render();

  function setSelectOption(select, selectedIndex) {
    select.options[select.selectedIndex].selected = false;
    select.options[selectedIndex].selected = true;
  }

  function readURL(hash) {
    var args = hash.split("&");
    var data = {};
    for (var i = 0; i < args.length; ++i) {
      var parts = args[i].split("=");
      data[parts[0]] = parts[1];
    }
    var t = data.t !== undefined ? data.t : 1
    var e = data.e !== undefined ? data.e : 0;
    var s = data.s !== undefined ? data.s : 8000;
    for (var i = 0; i < sampleRates.length; ++i) {
      if (s == sampleRates[i]) {
        setSelectOption(sampleRateElem, i);
        break;
      }
    }
    setSelectOption(beatTypeElem, t);
    setSelectOption(expressionTypeElem, e);
    g_byteBeat.setType(parseInt(t));
    g_byteBeat.setExpressionType(parseInt(e));
    g_byteBeat.setDesiredSampleRate(parseInt(s));
    var bytes = convertHexToBytes(data.bb);
    compressor.decompress(bytes, function(text) {
      /*console.log(text);
      if (text == '((t >> 10) & 42) * t') {
        text =
            't 16 >> 4 % 1 +\n'+
            't 10 >> 5 % 2 + +\n'+
            't 12 >> 3 % -\n'+
            't * 3 /\n'+
            'DUP\n'+
            '9 + |\n'+
            't 4 >> & 19 +\n'+
            't 12 >> 127 % ^';
      }*/
      codeElem.value = text.trim();
      compile(text);
    },
    dummyFunction);
  }

  function onWindowResize(event) {
   /*
    codeElem.style.top = '75px';
    codeElem.style.width = ( window.innerWidth - 75 ) + 'px';
    codeElem.style.height = ( window.innerHeight - 125 ) + 'px';
    */
    g_byteBeat.resize(canvas.clientWidth, canvas.clientHeight);
    g_visualizer.resize(canvas.clientWidth, canvas.clientHeight);
  }
}
//  var dataURL = captureScreenshot(400, 100, firstLine);

function captureScreenshot(ctx, canvas, text) {
  var width = ctx.canvas.width;
  var height = ctx.canvas.height;
  ctx.fillStyle = "#008";
  ctx.fillRect(0, 0, width, height);
  ctx.drawImage(canvas, 0, 0, width, height);
  ctx.font = "bold 20px monospace";
  var infos = [
    {x: 2, y: 2, color: "#000"},
    {x: 0, y: 1, color: "#000"},
    {x: 1, y: 0, color: "#000"},
    {x: 0, y: 0, color: "#FFF"}
  ];
  for (var i = 0; i < infos.length; ++i) {
    var info = infos[i];
    ctx.fillStyle = info.color;
    ctx.fillText(text, 20 + info.x, height - 20 + info.y, width - 40);
  }
  return g_screenshotCanvas.toDataURL();
}

function startSave() {
  if (!g_saving) {
    g_saving = true;
    var firstLine = strip(strip(codeElem.value.split("\n")[0]).replace(/^\/\//, ''));
    g_screenshot = captureScreenshot(g_screenshotContext, canvas, firstLine);
    showSaveDialog();
  }
}

function showSaveDialog() {
  function closeSave() {
    $("savedialog").style.display = "none";
    window.removeEventListener('keypress', handleKeyPress);
    g_saving = false;
    g_screenshot = "";  // just cuz.
  }
  function handleKeyPress(event) {
    log(event.keyCode);
    if (event.keyCode == 27) {
      closeSave()
    }
  }
  function save() {
    log("do something to save");
    closeSave();
  }

  window.addEventListener('keypress', handleKeyPress);
  if (!g_saveDialogInitialized) {
    g_saveDialogInitialized = true;
    $("save").addEventListener('click', save);
    $("cancel").addEventListener('click', closeSave);
  }
  var saveDialogElem = $("savedialog");
  var screenshotElem = $("screenshot");
  saveDialogElem.style.display = "table";
  screenshotElem.src = g_screenshot;
}

function dummyFunction() {};

function updateTimeDisplay() {
  timeElem.innerHTML = g_byteBeat.getTime();
};

// Splits a string, looking for //:name
var g_splitRE = new RegExp(/\/\/\:([a-zA-Z0-9_-]+)(.*)/);
function splitBySections(str) {
  var sections = {};

  function getNextSection(str) {
    var pos = str.search(g_splitRE);
    if (pos < 0) {
      return str;
    }
    var m = str.match(g_splitRE);
    var sectionName = m[1];
    newStr = getNextSection(str.substring(pos + 3 + sectionName.length));
    sections[sectionName] = newStr;
    return str.substring(0, pos);
  }
  str = getNextSection(str);
  if (str.length) {
    sections.default = str;
  }
  return sections;
}
function compile(text) {
  var sections = splitBySections(text);
  if (sections.default || sections.channel1) {
    var expressions = [sections.default || sections.channel1];
    if (sections.channel2) {
      expressions.push(sections.channel2);
    }
    g_byteBeat.setExpressions(expressions);
  }
  g_byteBeat.setOptions(sections);
  // comment in to allow live GLSL editing
  //g_visualizer.setEffects(sections);
}

function handleCompileError(error) {
  if (error == null) {
    document.getElementById('code').style.color = '#fff';
    //compileStatusElem.textContent = "compiled successfully";
    //compileStatusElem.style.color = "#0F0";
    setURL();
  } else {
    document.getElementById('code').style.color = 'rgb(248, 54, 51)';
    toutou();
    //compileStatusElem.textContent = error;
    //compileStatusElem.style.color = "#F00";
  }
}

function convertHexToBytes(text) {
  var array = [];
  for (var i = 0; i < text.length; i += 2) {
    var tmpHex = text.substring(i, i + 2);
    array.push(parseInt(tmpHex, 16));
  }
  return array;
}

function convertBytesToHex(byteArray) {
  var hex = "";
  for (var i = 0, il = byteArray.length; i < il; i++) {
    if (byteArray[i] < 0) {
      byteArray[i] = byteArray[i] + 256;
    }
    var tmpHex = byteArray[i].toString(16);
    // add leading zero
    if (tmpHex.length == 1) {
      tmpHex = "0" + tmpHex;
    }
    hex += tmpHex;
  }
  return hex;
}

var nstrip = function(v) {
  return v;
}

var replaceRE = /\$\((\w+)\)/g;

/**
 * Replaces strings with property values.
 * Given a string like "hello $(first) $(last)" and an object
 * like {first:"John", last:"Smith"} will return
 * "hello John Smith".
 * @param {string} str String to do replacements in
 * @param {...} 1 or more objects conaining properties.
 */
var replaceParams = function(str) {
  var args = arguments;
  return str.replace(replaceRE, function(str, p1, offset, s) {
    for (var ii = 1; ii < args.length; ++ii) {
      if (args[ii][p1] !== undefined) {
        return args[ii][p1];
      }
    }
    throw "unknown string param '" + p1 + "'";
  });
};

function setURL() {
  if (dontSet) {
    dontSet = false;
    return;
  }
  compressor.compress(codeElem.value, 1, function(bytes) {
    var hex = convertBytesToHex(bytes);
    window.location.replace(
      '#t=' + g_byteBeat.getType() +
      '&e=' + g_byteBeat.getExpressionType() +
      '&s=' + g_byteBeat.getDesiredSampleRate() +
      '&bb=' + hex);
  },
  dummyFunction);
}

WrappingStack = function(opt_stackSize) {
  var stackSize = opt_stackSize || 256;
  var sp = 0;
  var stack = [];
  for (var ii = 0; ii < stackSize; ++ii) {
    stack.push(0);
  }

  var push = function(v) {
    stack[sp++] = v;
    sp = sp % stackSize;
  };

  var pop = function() {
    sp = (sp == 0) ? (stackSize - 1) : (sp - 1);
    return stack[sp];
  };

  var pick = function(index) {
    var i = sp - Math.floor(index) - 1;
    while (i < 0) {
      i += stackSize;
    }
    return stack[i % stackSize];
  };

  var put = function(index, value) {
    i = sp - Math.floor(index);
    while (i < 0) {
      i += stackSize;
    }
    stack[i % stackSize] = value;
  };

  var getSP = function() {
    return sp;
  };

  return {
    pop: pop,
    push: push,
    pick: pick,
    put: put,
    sp: getSP,
  };
};

ByteBeat = function() {
  var that = this;
  this.buffer0 = new Float32Array(4096);
  this.buffer1 = new Float32Array(4096);
  this.desiredSampleRate = 8000;
  this.time = 0;
  this.expandMode = 0;
  this.floatBeat = false;
  this.expressionType = 0;
  this.functions = [function(t) {
    return Math.sin(t) * 0.1;
  }]
  this.expressions = ["Math.sin(t) * 0.1"];
  this.extra = {
    mouseX: 0,
    mouseY: 0,
    width: 1,
    height: 1,
    tiltX: 0,
    tiltY: 0,
    compass: 0,
  };
  this.postfixTemplate = $("postfix-template").text;
  this.stacks = [new WrappingStack(), new WrappingStack()];
  this.tempStack = [new WrappingStack(), new WrappingStack()];

  window.addEventListener('mousemove', function(event) {
    var extra = that.extra;
    extra.mouseX = event.clientX;
    extra.mouseY = event.clientY;
  }, true);

  if (window.DeviceOrientationEvent) {
    // Listen for the deviceorientation event and handle the raw data
    window.addEventListener('deviceorientation', function(eventData) {
      var extra = that.extra;
      // gamma is the left-to-right tilt in degrees, where right is positive
      extra.tiltX = eventData.gamma;

      // beta is the front-to-back tilt in degrees, where front is positive
      extra.tiltY = eventData.beta;

      // alpha is the compass direction the device is facing in degrees
      extra.compass = eventData.alpha;
    }, false);
  }

  var webAudioAPI = window.AudioContext || window.webkitAudioContext || window.mozAudioContext || window.oAudioContext || window.msAudioContext;
  if (webAudioAPI) {
    this.context = new webAudioAPI();
    this.node = this.context.createScriptProcessor(4096, 2, 2);
    //this.context = { };
    //this.node = {
    //  connect: function() { },
    //  disconnect: function() { }
    //};
    this.actualSampleRate = this.context.sampleRate;
    this.node.onaudioprocess = function(e) {
      var data = e.outputBuffer.getChannelData(0);
      that.process(data.length, data,
                   e.outputBuffer.getChannelData(1));
    };
    this.good = true;
  } else {
    var audio = new Audio()
    this.audio = audio;
    if (!audio.mozSetup) {
      return;
    }
    this.good = true;

    function AudioDataDestination(sampleRate, readFn) {
      // Initialize the audio output.
      var audio = new Audio();
      var channels = 2
      audio.mozSetup(channels, sampleRate);

      var currentWritePosition = 0;
      var prebufferSize = sampleRate * channels / 2; // buffer 500ms
      var tail = null, tailPosition;

      // The function called with regular interval to populate
      // the audio output buffer.
      setInterval(function() {
        var written;
        // Check if some data was not written in previous attempts.
        if(tail) {
          written = audio.mozWriteAudio(tail.subarray(tailPosition));
          currentWritePosition += written;
          tailPosition += written;
          if(tailPosition < tail.length) {
            // Not all the data was written, saving the tail...
            return; // ... and exit the function.
          }
          tail = null;
        }

        // Check if we need add some data to the audio output.
        var currentPosition = audio.mozCurrentSampleOffset();
        var available = currentPosition + prebufferSize - currentWritePosition;
        if(available > 0) {
          // Request some sound data from the callback function.
          var soundData = new Float32Array(available);
          readFn(soundData);

          // Writting the data.
          written = audio.mozWriteAudio(soundData);
          if(written < soundData.length) {
            // Not all the data was written, saving the tail.
            tail = soundData;
            tailPosition = written;
          }
          currentWritePosition += written;
        }
      }, 100);
    }

    this.actualSampleRate = 44100;//this.desiredSampleRate;
    var audioDestination = new AudioDataDestination(this.actualSampleRate, function(buffer) {
      if (playing) {
        that.process(buffer.length >> 1, buffer);
      }
    });
  }
};

function strip(s) {
  return s.replace(/^\s+/,"").replace(/\s+$/,"");
}

ByteBeat.prototype.resize = function(width, height) {
  this.extra.width = width;
  this.extra.height = height;
};

ByteBeat.prototype.setVisualizer = function(visualizer) {
  this.visualizer = visualizer;
};

ByteBeat.prototype.reset = function() {
  this.time = 0;
};

ByteBeat.prototype.getTime = function() {
  return this.convertToDesiredSampleRate(this.time);
};

function removeCommentsAndLineBreaks(x) {
  // remove comments (hacky)
  x = x.replace(/\/\/.*/g, " ");
  x = x.replace(/\n/g, " ");
  x = x.replace(/\/\*.*?\*\//g, " ");
  return x;
}

var glitchToPostfix = (function() {
  var glitchToPostfixConversion = {
      'a': 't',
      'b': 'put',
      'c': 'drop',

      'd': '*',
      'e': '/',
      'f': '+',
      'g': '-',
      'h': '%',

      'j': '<<',
      'k': '>>',
      'l': '&',
      'm': '|',
      'n': '^',
      'o': '~',

      'p': 'dup',
      'q': 'pick',
      'r': 'swap',

      's': '<',
      't': '>',
      'u': '=',
      '/': '//',

      '!': '\n',
      '.': ' ',
  };

  var isCapitalHex = function(c) {
    return ((c >= '0' && c <= '9') || (c >= 'A' && c <= 'F'));
  };

  return function(x) {
    // Convert to postfix
    var postfix = [];

    x = x.replace("glitch://", ""); // remove "glitch:"
    x = removeCommentsAndLineBreaks(x);
    x = x.replace("glitch:", ""); // remove "glitch:"
    x = x.replace(/^[^!]*!/, ""); // remove label

    for (var i = 0; i < x.length; ++i) {
      var done = false;
      var imd = "";

      // NOTE: works by magic when number is at end. While gathering
      // imd if we're at the end of the string 'c' will be undefined
      // which will fail isCapitalHex and so the last imd will be put in
      // correctly.
      while (!done) {
        var c = x[i];
        if (isCapitalHex(c)) {
          imd = imd + c;
          ++i;
        } else {
          done = true;
          if (imd.length) {
            --i;
            c = "0x" + imd;
          }
        }
      }
      postfix.push(glitchToPostfixConversion[c] || c);
    }
    return postfix.join(" ");
  };

}());

ByteBeat.prototype.setOnCompile = function(callback) {
  this.onCompileCallback = callback;
};

ByteBeat.prototype.recompile = function() {
  this.setExpressions(this.getExpressions());
};

ByteBeat.prototype.setOptions = function(sections) {
  this.expandMode = (sections['linear'] !== undefined)
};

ByteBeat.prototype.setExpressions = function(expressions, extra) {
  var postfixTemplate = this.postfixTemplate;

  function expressionStringToFn(x, extra) {
    x = removeCommentsAndLineBreaks(x);
    // Translate a few things.
    function replacer(str, obj, p1, name) {
      return obj.hasOwnProperty(p1) ? (name + p1) : str;
    }
    x = x.replace(/\bint\b/g, "floor");
    x = x.replace(/(?:Math\.)?(\w+)/g, function(substr, p1) {
      return replacer(substr, Math, p1, "Math.");
    });
    x = x.replace(/(?:extra\.)?(\w+)/g, function(substr, p1) {
      return replacer(substr, extra, p1, "extra.");
    });

    log(x);
    var c = "temp = {fn: function(stack) { " + x + " }()}";
    var f = eval(c).fn;

    var stack = new WrappingStack();
    for (var i = 0; i < 1000; i += 100) {
      var s = f(i, i, stack);
      if (i == 0) {
        log("stack: " + stack.sp());
      }
      //log("" + i + ": " + s);
      if (typeof s != "number") {
        throw "NaN";
      }
    }

    return f;
  }

  function postfixToInfix(x) {
    x = removeCommentsAndLineBreaks(x);
    // compress space
    x = x.replace(/(\r\n|\r|\n|\t| )+/gm, " ");
    var tokens = strip(x).split(" ");
    var steps = [];
    for (var i = 0; i < tokens.length; ++i) {
      var token = tokens[i];
      switch (token.toLowerCase()) {
      case '>':
        steps.push("var v1 = stack.pop();");
        steps.push("var v2 = stack.pop();");
        steps.push("stack.push((v1 < v2) ? 0xFFFFFFFF : 0);");
        break;
      case '<':
        steps.push("var v1 = stack.pop();");
        steps.push("var v2 = stack.pop();");
        steps.push("stack.push((v1 > v2) ? 0xFFFFFFFF : 0);");
        break;
      case '=':
        steps.push("var v1 = stack.pop();");
        steps.push("var v2 = stack.pop();");
        steps.push("stack.push((v2 == v1) ? 0xFFFFFFFF : 0);");
        break;
      case 'drop':
        steps.push("stack.pop();");
        break;
      case 'dup':
        steps.push("stack.push(stack.pick(0));");
        break;
      case 'swap':
        steps.push("var a1 = stack.pop();");
        steps.push("var a0 = stack.pop();");
        steps.push("stack.push(a1);");
        steps.push("stack.push(a0);");
        break;
      case 'pick':
        steps.push("var a0 = stack.pop();");
        steps.push("stack.push(stack.pick(a0));");
        break;
      case 'put':
        steps.push("var a0 = stack.pop();");
        steps.push("var a1 = stack.pick(0);");
        steps.push("stack.put(a0, a1);");
        break;
      case 'abs':
      case 'sqrt':
      case 'round':
      case 'tan':
      case 'log':
      case 'exp':
      case 'sin':
      case 'cos':
      case 'tan':
      case 'floor':
      case 'ceil':
      case 'int':
        steps.push("var a0 = stack.pop();");
        steps.push("stack.push(" + token + "(a0));");
        break;
      case 'max':
      case 'min':
      case 'pow':
        steps.push("var a0 = stack.pop();");
        steps.push("var a1 = stack.pop();");
        steps.push("stack.push(" + token + "(a1, a0));");
        break;
      case 'random':
        steps.push("stack.push(" + token + "());");
        break;
      case '/':
        steps.push("var a1 = stack.pop();");
        steps.push("var a0 = stack.pop();");
        steps.push("stack.push(floor(a0 / a1));");
        break;
      case '+':
      case '-':
      case '*':
      case '%':
      case '>>':
      case '<<':
      case '|':
      case '&':
      case '^':
      case '&&':
      case '||':
        steps.push("var a1 = stack.pop();");
        steps.push("var a0 = stack.pop();");
        steps.push("stack.push(a0 " + token + " a1);");
        break;
      case '~':
        steps.push("var a0 = stack.pop();");
        steps.push("stack.push(~a0);");
        break;
      default:
        steps.push("stack.push(" + token + ");");
        break;
      }
    }

    steps.push("return stack.pop();");

    var exp = replaceParams(postfixTemplate, {
      exp: steps.join("\n")
    });
    return exp;
  }

  function compileExpression(x, expressionType, extra, window) {
    if (expressionType == 2) { // glitch
      x = glitchToPostfix(x);
      expressionType = 1;
    }
    if (expressionType == 1) {  // postfix
      x = postfixToInfix(x);
    } else {  // infix
      x = "  return function(t, i) { " +
          "    return " + strip(x) + "; " +
          "  }";
    }
    return expressionStringToFn(x, extra);
  }

  var funcs = [];
  try {
    for (var i = 0; i < expressions.length; ++i) {
      var exp = expressions[i];
      if (exp != this.expressions[i]) {
        funcs.push(compileExpression(exp, this.expressionType, this.extra));
      } else {
        if (this.functions[i]) {
          funcs.push(this.functions[i]);
        }
      }
    }
  } catch(e) {
    if (this.onCompileCallback) {
      this.onCompileCallback(e.toString());
    }
    return;
  }

  // copy the expressions
  this.expressions = expressions.slice(0);
  this.functions = funcs;
  if (this.onCompileCallback) {
    this.onCompileCallback(null);
  }
};

ByteBeat.prototype.convertToDesiredSampleRate = function(rate) {
  return Math.floor(rate * this.desiredSampleRate / this.actualSampleRate);
};

ByteBeat.prototype.setDesiredSampleRate = function(rate) {
  this.desiredSampleRate = rate;
};

ByteBeat.prototype.getDesiredSampleRate = function() {
  return this.desiredSampleRate;
};

ByteBeat.prototype.setExpressionType = function(type) {
  this.expressionType = type;
};

ByteBeat.prototype.getExpressions = function() {
  return this.expressions.slice(0);
};

ByteBeat.prototype.getExpressionType = function() {
  return this.expressionType;
};

ByteBeat.prototype.setType = function(floatBeat) {
  this.floatBeat = floatBeat;
};

ByteBeat.prototype.getType = function() {
  return this.floatBeat;
};

ByteBeat.prototype.process = function(dataLength, leftData, rightData) {
  var time = this.convertToDesiredSampleRate(this.time);
  var lastSample = this.convertToDesiredSampleRate(dataLength) + 2;
  if (this.buffer0.length < lastSample) {
    this.buffer0 = new Float32Array(lastSample);
    this.buffer1 = new Float32Array(lastSample);
  }
  var buffer0 = this.buffer0;
  var buffer1;
  //
  var fn0 = this.functions[0];
  var fn1 = this.functions[1];
  var stack0 = this.stacks[0];
  var stack1 = this.stacks[1];
  if (fn1) {
    buffer1 = this.buffer1;
    if (this.floatBeat) {
      for (var i = 0; i < lastSample; ++i) {
        buffer0[i] = fn0(time  , undefined, stack0);
        buffer1[i] = fn1(time++, undefined, stack1);
      }
    } else {
      for (var i = 0; i < lastSample; ++i) {
        buffer0[i] = (fn0(time  , undefined, stack0) & 255) / 127 - 1;
        buffer1[i] = (fn1(time++, undefined, stack1) & 255) / 127 - 1;
      }
    }
  } else {
    buffer1 = this.buffer0;
    if (this.floatBeat) {
      for (var i = 0; i < lastSample; ++i) {
        buffer0[i] = fn0(time++, undefined, stack0);
      }
    } else {
      for (var i = 0; i < lastSample; ++i) {
        buffer0[i] = (fn0(time++, undefined, stack0) & 255) / 127 - 1;
      }
    }
  }
  if (dataLength) {
    var step = this.convertToDesiredSampleRate(dataLength) / dataLength;
    var ndx = 0;

    function interp(buf) {
      var n = Math.floor(ndx);
      var f = ndx % 1;
      var v0 = buf[n];
      var v1 = buf[n + 1];
      return v0 + (v1 - v0) * f;
    }

    function trunc(buf) {
      return buf[Math.floor(ndx)];
    }

    var expandFn = this.expandMode ? interp : trunc;

    if (rightData) {
      for (var i = 0; i < dataLength; ++i) {
        leftData[i] = expandFn(buffer0);
        rightData[i] = expandFn(buffer1);
        ndx += step;
      }
    } else {
      for (var i = 0; i < dataLength; ++i) {
        leftData[i * 2] = expandFn(buffer0);
        leftData[i * 2 + 1] = expandFn(buffer1);
        ndx += step;
      }
    }
  }

  if (this.visualizer) {
    this.visualizer.update(buffer0, lastSample - 1);
  }

  this.time += dataLength;
};

ByteBeat.prototype.getSampleForTime = function(time) {
  if (this.floatBeat) {
    return this.functions[0](time, undefined, this.tempStack[0]);
  }
  return (this.functions[0](time, undefined, this.tempStack[0]) & 255) / 127 - 1;
};

ByteBeat.prototype.startOnUserGesture = function() {
  if (!this.startOnUserGestureCount || this.startOnUserGestureCount < 2) {
    this.startOnUserGestureCount = this.startOnUserGestureCount || 0;
    ++this.startOnUserGestureCount;
    if (this.startOnUserGestureCount == 2) {
      // iOS requires starting a sound during a user input event.
      var source = this.context.createOscillator();
      source.frequency.value = 440;
      source.connect(this.context.destination);
      if (source.start) {
        source.start(0);
      }
      setTimeout(function() {
        source.disconnect();
      }, 100);
    }
  }
};

ByteBeat.prototype.play = function() {
  if (this.node) {
    this.startOnUserGesture();
    this.node.connect(this.context.destination);
  }
};

ByteBeat.prototype.pause = function() {
  if (this.node) {
    this.node.disconnect();
  }
};

Visualizer = function(canvas) {
  this.canvas = canvas;
  this.type = 1;
};

Visualizer.prototype.setType = function(type) {
  this.type = type;

};

Visualizer.prototype.setOnCompile = function(callback) {
  this.onCompileCallback = callback;
};

Visualizer.prototype.capture = function(callback) {
  this.captureCallback = callback;
};

Visualizer.prototype.handleCapture = function() {
  var fn = this.captureCallback;
  if (fn) {
    this.captureCallback = undefined;
    fn(this.canvas);
  }
};

WebGLVisualizer = function(canvas) {
  Visualizer.call(this, canvas);
  this.type = 1;
  this.temp = new Float32Array(1);
  this.resolution = new Float32Array(2);
  this.effects = {
    wave: {
      uniforms: {
        position: 0,
        time: 0,
        resolution: this.resolution,
        color: new Float32Array([0, 1, 1, 1])
      }
    },
    sample: {
      uniforms: {
        offset: 0,
        time: 0,
        resolution: this.resolution,
        color: new Float32Array([0, 1, 0, 1])
      }
    },
    data: {
      uniforms: {
        offset: 0,
        time: 0,
        resolution: this.resolution,
        color: new Float32Array([1, 0, 1, 1])
      }
    }
  };

  this.effects.wave[gl.VERTEX_SHADER] = {
    defaultSource: $("waveVertexShader").text
  };
  this.effects.wave[gl.FRAGMENT_SHADER] = {
    defaultSource: $("waveFragmentShader").text
  };
  this.effects.sample[gl.VERTEX_SHADER] = {
    defaultSource: $("sampleVertexShader").text
  };
  this.effects.sample[gl.FRAGMENT_SHADER] = {
    defaultSource: $("sampleFragmentShader").text
  };
  this.effects.data[gl.VERTEX_SHADER] = {
    defaultSource: $("dataVertexShader").text
  };
  this.effects.data[gl.FRAGMENT_SHADER] = {
    defaultSource: $("dataFragmentShader").text
  };

  this.resize(512, 512);
};

tdl.base.inherit(WebGLVisualizer, Visualizer);

WebGLVisualizer.prototype.resize = function(width, height) {
  var canvas = this.canvas;
  canvas.width = canvas.clientWidth;
  canvas.height = canvas.clientHeight;
  gl.viewport(0, 0, canvas.clientWidth, canvas.clientHeight);
  var height = new tdl.primitives.AttribBuffer(1, width * 2);
  var column = new tdl.primitives.AttribBuffer(1, width * 2);
  for (var ii = 0; ii < width * 2; ++ii) {
    height.setElement(ii, [Math.sin(ii / width * Math.PI * 2)]);
    column.setElement(ii, [(ii >> 1) / width]);
  }
  var arrays = {
    height: height,
    column: column
  }
  var effects = this.effects;
  var wave = effects.wave;
  if (!wave.model) {
    var program = tdl.programs.loadProgram(
        wave[gl.VERTEX_SHADER].defaultSource,
        wave[gl.FRAGMENT_SHADER].defaultSource);
    wave.model = new tdl.models.Model(program, arrays, {}, gl.LINES/*gl.LINE_STRIP*/ /*gl.POINTS*/);
  } else {
    wave.model.setBuffers(arrays, true);
  }

  var data = effects.data;
  if (!data.model) {
    var tex = new tdl.textures.ExternalTexture(gl.TEXTURE_2D);
    var arrays = tdl.primitives.createPlane(2, 2, 1, 1);
    // Don't need the normals.
    delete arrays.normal;
    delete arrays.texCoord;
    // rotate from xz plane to xy plane
    tdl.primitives.reorient(arrays,
        [1, 0, 0, 0,
         0, 0, 1, 0,
         0, -1, 0, 0,
         0, 0, 0, 1]);
    var textures = {
        tex: tex,
    };
    var program = tdl.programs.loadProgram(
        data[gl.VERTEX_SHADER].defaultSource,
        data[gl.FRAGMENT_SHADER].defaultSource);
    data.model = new tdl.models.Model(program, arrays, textures);
    this.dataTex = tex;
  }

  this.dataWidth = 1024;
  var dataBuf = new Uint8Array(this.dataWidth);
  this.dataPos = 0;
  this.dataPixel = new Uint8Array(1);
  this.dataTex.setParameter(gl.TEXTURE_MIN_FILTER, gl.NEAREST);
  this.dataTex.setParameter(gl.TEXTURE_MAG_FILTER, gl.NEAREST);
  gl.texImage2D(
      gl.TEXTURE_2D, 0, gl.LUMINANCE, this.dataWidth, 1, 0,
      gl.LUMINANCE, gl.UNSIGNED_BYTE, dataBuf);
  this.dataBuf = dataBuf;
  this.dataTime = 0;

  var sample = effects.sample;
  if (!sample.model) {
    var tex = new tdl.textures.ExternalTexture(gl.TEXTURE_2D);
    var arrays = tdl.primitives.createPlane(2, 2, 1, 1);
    // Don't need the normals.
    delete arrays.normal;
    delete arrays.texCoord;
    // rotate from xz plane to xy plane
    tdl.primitives.reorient(arrays,
        [1, 0, 0, 0,
         0, 0, 1, 0,
         0, -1, 0, 0,
         0, 0, 0, 1]);
    var textures = {
        tex: tex,
    };
    var program = tdl.programs.loadProgram(
        sample[gl.VERTEX_SHADER].defaultSource,
        sample[gl.FRAGMENT_SHADER].defaultSource);
    sample.model = new tdl.models.Model(program, arrays, textures);
    this.sampleTex = tex;
  }

  this.sampleWidth = 1024;
  var sampleBuf = new Uint8Array(this.sampleWidth);
  this.samplePos = 0;
  this.samplePixel = new Uint8Array(1);
  this.sampleTex.setParameter(gl.TEXTURE_MIN_FILTER, gl.NEAREST);
  this.sampleTex.setParameter(gl.TEXTURE_MAG_FILTER, gl.NEAREST);
  gl.texImage2D(
      gl.TEXTURE_2D, 0, gl.LUMINANCE, this.sampleWidth, 1, 0,
      gl.LUMINANCE, gl.UNSIGNED_BYTE, sampleBuf);
  this.sampleBuf = sampleBuf;
  this.sampleTime = 0;

  this.oneVerticalPixel = 2 / canvas.height;
  this.width = width;
  this.height = height;
  this.position = 0;
  this.then = (new Date()).getTime() * 0.001;
  this.compiling = false;
};

WebGLVisualizer.prototype.reset = function() {
  this.then = (new Date()).getTime() * 0.001;
  for (var i = 0; i < this.height.numElements; ++i) {
    this.height.setElement(i, [0]);
  }
  this.position = 0;
  this.effects.wave.model.buffers.height.set(this.height);

  this.dataTime = 0;
  this.dataPos = 0;
  for (var i = 0; i < this.dataWidth; ++i) {
    this.dataBuf[i] = 0;
  }
  this.dataTex.setParameter(gl.TEXTURE_MAG_FILTER, gl.NEAREST);
  gl.texImage2D(
      gl.TEXTURE_2D, 0, gl.LUMINANCE, this.dataWidth, 1, 0,
      gl.LUMINANCE, gl.UNSIGNED_BYTE, this.dataBuf);

  this.sampleTime = 0;
  this.samplePos = 0;
  for (var i = 0; i < this.sampleWidth; ++i) {
    this.sampleBuf[i] = 0;
  }
  this.sampleTex.setParameter(gl.TEXTURE_MAG_FILTER, gl.NEAREST);
  gl.texImage2D(
      gl.TEXTURE_2D, 0, gl.LUMINANCE, this.sampleWidth, 1, 0,
      gl.LUMINANCE, gl.UNSIGNED_BYTE, this.sampleBuf);
};

WebGLVisualizer.prototype.setShaderGLSL = function(effect, vertexShaderSource, fragmentShaderSource) {
  if (!vertexShaderSource) {
    vertexShaderSource = effect[gl.VERTEX_SHADER].defaultSource;
  }
  if (!fragmentShaderSource) {
    fragmentShaderSource = effect[gl.FRAGMENT_SHADER].defaultSource;
  }

  effect[gl.VERTEX_SHADER].pending = vertexShaderSource;
  effect[gl.FRAGMENT_SHADER].pending = fragmentShaderSource;
}

WebGLVisualizer.prototype.compileIfPending = function() {
  if (this.compiling) {
    return;
  }

  if (this.compileShaderIfPending(this.effects.wave)) {
    return;
  }

  if (this.compileShaderIfPending(this.effects.sample)) {
    return;
  }

  if (this.compileShaderIfPending(this.effects.data)) {
    return;
  }
};

WebGLVisualizer.prototype.compileShaderIfPending = function(effect) {
  var pendingVertexShader = effect[gl.VERTEX_SHADER].pending;
  var pendingFragmentShader = effect[gl.FRAGMENT_SHADER].pending;

  // If there was nothing pending exit
  if (pendingVertexShader === undefined && pendingFragmentShader === undefined) {
    return false;
  }

  // clear pending
  effect[gl.VERTEX_SHADER].pending = undefined;
  effect[gl.FRAGMENT_SHADER].pending = undefined;

  // If there was no change exit.
  if (pendingVertexShader == effect[gl.VERTEX_SHADER].source &&
      pendingFragmentShader == effect[gl.FRAGMENT_SHADER].source) {
    //this.onCompileCallback(null);
    return false;
  }

  this.compiling = true;
  var that = this;
  this.programBeingCompiled = tdl.programs.loadProgram(pendingVertexShader, pendingFragmentShader, function(error) {
    that.handleCompile(error, effect, pendingVertexShader, pendingFragmentShader);
  });
  return true;
};

WebGLVisualizer.prototype.handleCompile = function(error, effect, vertexShaderSource, fragmentShaderSource) {
  this.compiling = false;
  if (error !== undefined) {
    if (this.onCompileCallback) {
      this.onCompileCallback(tdl.programs.lastError);
    }
  } else {
    effect.model.setProgram(this.programBeingCompiled);
    effect[gl.VERTEX_SHADER].source = vertexShaderSource;
    effect[gl.FRAGMENT_SHADER].source = fragmentShaderSource;
    if (this.onCompileCallback) {
      this.onCompileCallback(null);
    }
  }
  this.compileIfPending();
};

WebGLVisualizer.prototype.setEffects = function(sections) {
  this.setShaderGLSL(this.effects.wave, sections['glsl-wave-vs'], sections['glsl-wave-fs']);
  this.setShaderGLSL(this.effects.data, this.effects.data[gl.VERTEX_SHADER].defaultSource, sections['glsl-data-fs']);
  this.setShaderGLSL(this.effects.sample, this.effects.data[gl.VERTEX_SHADER].defaultSource, sections['glsl-sample-fs']);
  this.compileIfPending();
};

WebGLVisualizer.prototype.update = function(buffer, length) {
  if (!this.type) {
    return;
  }
  // Yes I know this is dumb. I should just do the last 2 at most.
  var dest = this.height.buffer;
  var offset = 0;
  var v = this.oneVerticalPixel;
  var v2 = v * 2;
  while (length) {
    var max = Math.min(length, this.width - this.position);
    var d = this.position * 2;
    var h1 = buffer[offset];
    for (i = 0; i < max; ++i) {
      var h2 = buffer[++offset];
      var dy = h1 - h2;
      dest[d++] = h1;
      dest[d++] = Math.abs(dy) > v ? h2 : (h2 + (dy > 0 ? v2 : -v2));
      h1 = h2;
    }
    var view = new Float32Array(dest.buffer, this.position * 4 * 2, max * 2);
    this.effects.wave.model.buffers.height.setRange(view, this.position * 4 * 2);
    this.position = (this.position + max) % this.width;
    length -= max;
  }
};

WebGLVisualizer.prototype.render = function() {
  if (!this.type && !this.captureCallback) {
    return;
  }

  gl.clearColor(0,0,0.3,1);
  gl.clear(gl.COLOR_BUFFER_BIT);

  var effects = this.effects;
  var wave = this.effects.wave;
  var data = this.effects.data;
  var sample = this.effects.sample;

  var canvas = this.canvas;
  this.resolution[0] = canvas.width;
  this.resolution[1] = canvas.height;

  this.dataTex.setParameter(gl.TEXTURE_MAG_FILTER, gl.NEAREST);
  this.dataPixel[0] = g_byteBeat.getSampleForTime(this.dataTime++) * 127 + 127;
  gl.texSubImage2D(gl.TEXTURE_2D, 0, this.dataPos, 0, 1, 1, gl.LUMINANCE, gl.UNSIGNED_BYTE, this.dataPixel);
  this.dataPos = (this.dataPos + 1) % this.dataWidth;

  this.sampleTex.setParameter(gl.TEXTURE_MAG_FILTER, gl.NEAREST);
  for (var ii = 0; ii < 2; ++ii) {
    this.samplePixel[0] = g_byteBeat.getSampleForTime(this.sampleTime++) * 127 + 127;
    gl.texSubImage2D(gl.TEXTURE_2D, 0, this.samplePos, 0, 1, 1, gl.LUMINANCE, gl.UNSIGNED_BYTE, this.samplePixel);
    this.samplePos = (this.samplePos + 1) % this.sampleWidth;
  }

  var now = (new Date()).getTime() * 0.001;

  data.uniforms.offset = this.dataPos / this.dataWidth;
  data.uniforms.time = now - this.then;
  data.model.drawPrep(data.uniforms);
  data.model.draw();

  if (false) {
    gl.enable(gl.BLEND);
    gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);
    sample.uniforms.offset = this.samplePos / this.sampleWidth;
    sample.uniforms.time = now - this.then;
    sample.model.drawPrep(sample.uniforms);
    sample.model.draw();
    gl.disable(gl.BLEND);
  }

  wave.uniforms.position = this.position / this.width;
  wave.uniforms.time = now - this.then;
  wave.model.drawPrep(wave.uniforms);
  wave.model.draw();

  this.handleCapture();
};

CanvasVisualizer = function(canvas) {
  Visualizer.call(this, canvas);
  this.ctx = canvas.getContext("2d");
  this.temp = new Float32Array(1);
  this.resize(512, 512);
  this.type = 1;
};

tdl.base.inherit(CanvasVisualizer, Visualizer);

CanvasVisualizer.prototype.resize = function(width, height) {
  var canvas = this.canvas;
  canvas.width = canvas.clientWidth;
  canvas.height = canvas.clientHeight;
  this.positions = new Float32Array(width);
  this.oldPositions = new Float32Array(width);
  this.width = width;
  this.height = height;
  this.position = 0;
  this.drawPosition = 0;
  this.drawCount = 0;
};

CanvasVisualizer.prototype.reset = function() {
  this.position = 0;
  this.drawPosition = 0;
  this.drawCount = 0;
  var canvas = this.canvas;
  ctx.clearRect(0, 0, canvas.width, canvas.height);
};

CanvasVisualizer.prototype.setEffects = function(sections) {
};

CanvasVisualizer.prototype.update = function(buffer, length) {
  if (!this.type && !this.captureCallback) {
    return;
  }
  // Yes I know this is dumb. I should just do the last 2 at most.
  var s = 0;
  var p = this.position;
  var ps = this.positions;
  while (length) {
    var max = Math.min(length, this.width - p);
    for (var i = 0; i < max; ++i) {
      ps[p++] = buffer[s++];
    }
    p = p % this.width;
    this.drawCount += max;
    length -= max;
  }
  this.position = p;
  this.handleCapture();
};

CanvasVisualizer.prototype.render = function() {
  if (!this.type) {
    return;
  }
  var count = Math.min(this.drawCount, this.width);
  var dp = this.drawPosition;
  var ctx = this.ctx;
  var old = this.oldPositions;
  var ps = this.positions;
  var halfHeight = this.height / 2;
  ctx.fillStyle = "#FF00FF";
  /* horizontal */
  while (count) {
    ctx.clearRect(dp, old[dp], 1, 1);
    var newPos = Math.floor(-ps[dp] * halfHeight + halfHeight);
    ctx.fillRect(dp, newPos, 1, 1);
    old[dp] = newPos;
    dp = (dp + 1) % this.width;
    --count;
  }

  /* vertical hack (drawing the wave vertically should be faster */
  /*
  var w = this.width;
  var h = this.height;
  var hw = Math.floor(w * 0.5);
  while (count) {
    var y = Math.floor(dp * h / w);
    var oldX = Math.floor(old[dp] * w / h * 0.3);
    ctx.clearRect(hw - oldX, y, oldX * 2, 1);
    var newPos = Math.floor(-ps[dp] * halfHeight + halfHeight);
    var x = Math.floor(newPos * w / h * 0.3);
    ctx.fillRect(hw - x, y, x * 2, 1, 1);
    old[dp] = newPos;
    dp = (dp + 1) % this.width;
    --count;
  }
  */
  this.drawCount = 0;
  this.drawPosition = dp;
};

NullVisualizer = function(canvas) {
  Visualizer.call(this, canvas);
};

tdl.base.inherit(NullVisualizer, Visualizer);

NullVisualizer.prototype.resize = function(width, height) {
};

NullVisualizer.prototype.reset = function() {
};

NullVisualizer.prototype.setEffects = function(sections) {
};

NullVisualizer.prototype.update = function(buffer, length) {
};

NullVisualizer.prototype.render = function() {
};
</script>


<script>
  var fail = 0;
  var toutouOk = false
  function toutou(){
  if (toutouOk) return
  fail++;

  if (fail>=6){

    fail = 0;

  //  document.getElementById('toutou').classList.add('animated lightSpeedIn');
    document.getElementById('toutou').classList.remove('hide');
    document.getElementById('toutou').classList.remove('rotateOutDownRight');
    document.getElementById('toutou').classList.remove('lightSpeedIn');
    document.getElementById('toutou').classList.add('anim_3000');
    document.getElementById('toutou').classList.add('lightSpeedIn');

    setTimeout(function(){
      document.getElementById('toutou').classList.remove('lightSpeedIn');
      document.getElementById('toutou').classList.remove('anim_3000');
      document.getElementById('toutou').classList.add('rotateOutDownRight');
      toutouOk = true
    }, 5000);
  }
}

//toutou();

</script>

</body>
</html>
