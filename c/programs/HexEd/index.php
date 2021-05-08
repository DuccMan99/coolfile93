<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>hexedit</title>

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
footer, pre, #ed_ui_binedit button {
  font-family: _tomo, monospace;
  //font-size: 10px;
}
pre {
  white-space: pre-wrap;
  white-space: -moz-pre-wrap;
  white-space: -pre-wrap;
  white-space: -o-pre-wrap;
  padding: 0;
  padding-top: 0.5ch;
  padding-bottom: 2ch;
  margin: 0;
  overflow: hidden;
}
pre:focus {
  outline: 0 none;
  background-color: #fff;
}
pre {
  padding-left: 0.5ch;
  padding-left: 0.5ch;
}
#ed_section {
  background-color: #eee;
  outline: 0 none;
  display: flex;
  flex-direction: row;
  align-content: stretch;
  overflow-y: hidden;
  overflow-x: auto;

  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 8px;
  width: auto;
  height: auto;
}

#ed_addr {
  background-color: rgb(136, 135, 155);
  color: rgb(220, 218, 255);
  padding-left: 1ch;
  padding-left: 1ch;
  width: 10ch;
  min-width: 10ch;
}
#ed_addr span {
  display: block
}
#ed_hexa {
  width: calc(32ch + (16 * 4px) + 2ch);
  min-width: calc(32ch + (16 * 4px) + 2ch);
}
#ed_ascii {
  width: calc(16ch + (16 * 2px) + 1ch);
  min-width: calc(16ch + (16 * 2px) + 1ch);
}
#ed_ascii span {
  display: inline-block;
  text-align: center;
  padding-left: 1px;
  padding-right: 1px;
}
#ed_hexa span {
  display: inline-block;
  padding-left: 2px;
  padding-right: 2px;
}
/*#ed_hexa span:nth-child(odd) {
  opacity: 0.6;
}*/
#ed_hexa span:nth-child(16n-8) {
  margin-right: 1ch;
}
.noprint {
  color: rgba(255,0,255,0.5);
  opacity: 0.6;
}
.edited {
  background-color: rgb(202, 202, 255); //rgb(170, 170, 255);
}
span.selected {
  //background-color: rgb(200, 0, 200);
  //color: #fff;
  opacity: 1 !important;
  position: relative;
  z-index: 5;
  box-shadow: 0 0 0 1px rgb(200, 0, 200);
}
@-webkit-keyframes anim_cursor {
  0% {box-shadow: 0 0 0 1px rgba(200, 0, 200, 1);}
  30% {box-shadow: 0 0 0 1px rgba(10, 0, 100, 0);}
  31% {box-shadow: 0 0 0 1px rgba(10, 0, 100, 0);}
  100% {box-shadow: 0 0 0 1px rgba(200, 0, 200, 1);}
}
@keyframes anim_cursor {
  0% {box-shadow: 0 0 0 1px rgba(200, 0, 200, 1);}
  30% {box-shadow: 0 0 0 1px rgba(10, 0, 100, 0);}
  31% {box-shadow: 0 0 0 1px rgba(10, 0, 100, 0);}
  100% {box-shadow: 0 0 0 1px rgba(200, 0, 200, 1);}
}
span.selected_edit {
  /*animation:anim_cursor 1s linear infinite;
  -webkit-animation:anim_cursor 1s linear infinite;*/
  box-shadow: 0 0 0 1px rgb(255, 200, 255), 0 0 0 2px rgb(200, 0, 200);
}
/*@-webkit-keyframes anim_cursor {
  0% {background-color: rgb(200, 0, 200);}
  50% {background-color: rgb(200, 0, 200);}
  51% {background-color: rgb(100, 0, 100);}
  100% {background-color: rgb(100, 0, 100);}
}
@keyframes anim_cursor {
  0% {background-color: rgb(200, 0, 200);}
  50% {background-color: rgb(200, 0, 200);}
  51% {background-color: rgb(100, 0, 100);}
  100% {background-color: rgb(100, 0, 100);}
}
span.selected_edit {
  animation:anim_cursor 1s linear infinite;
  -webkit-animation:anim_cursor 1s linear infinite;
}*/
span.over,
#ed_hexa span:hover,
#ed_ascii span:hover {
  /*color: #fff;
  background-color: rgb(100, 100, 255);*/
  opacity: 1 !important;
  position: relative;
  z-index: 5;
  box-shadow: 0 0 0 1px rgb(50, 50, 255);
}
span.over.selected_edit,
#ed_hexa span.selected_edit:hover,
#ed_ascii span.selected_edit:hover {
  box-shadow: 0 0 0 1px rgb(50, 50, 255), 0 0 0 2px rgb(200, 0, 200);
}

#ed_ui_binedit button {
  display: inline-block;
  width: calc(2ch + 3px);
  height: calc(2ch + 3px);
  border-radius: 2ch;
  padding: 0;
  line-height: 8px;
  padding-bottom: 2px;
  outline: 0 none;
}

#ed_ui_scrolltrack {
  background-color: rgb(220, 218, 255);
  position: absolute;
  top: 0;
  bottom: 0;
  right: 0;
  width: 8px;
  height: auto;
}
#ed_ui_scrollbar {
  background-color: rgb(136, 135, 155);
  position: absolute;
  top: 0;
  right: 0;
  width: 8px;
  height: 20px;
}

html, body {
  overflow: hidden;
}
</style>

<body class="skin_light">

<div class="ui_layout">
  <section>
    <div id="ed_section">
      <pre id="ed_addr"></pre><pre class="_cursor_crosshair" tabindex="1" id="ed_hexa"></pre><pre class="_cursor_crosshair" tabindex="2" id="ed_ascii"></pre>
    </div>
    <div id="ed_ui_scrolltrack"><div id="ed_ui_scrollbar"></div></div>
  </section>
  <footer class="skin_base skin_outset mb1 mr1 pa2 pr5">
    <span id="ed_ui_binedit" class="skin_base_text_info">
      <button>0</button><button>0</button><button>0</button><button>0</button>&nbsp;<button>0</button><button>0</button><button>0</button><button>0</button>
    </span>
    <span class="skin_base_text_info" id="ed_nfo_offset">.</span>&nbsp;
    <div class="right">
      <span class="skin_base_text_info" id="ed_nfo_addr">.</span>
    </div>
  </footer>
</div>

<script src="/c/sys42.js?v=2.4.2"></script>

<script>

var
  BLOB
, ed_section = document.getElementById('ed_section')
, ed_addr = document.getElementById('ed_addr')
, ed_ascii = document.getElementById('ed_ascii')
, ed_hexa = document.getElementById('ed_hexa')
, ed_ui_scrollbar = document.getElementById('ed_ui_scrollbar')
, ed_ui_binedit = document.getElementById('ed_ui_binedit')
, ed_nfo_addr = document.getElementById('ed_nfo_addr')
, ed_nfo_offset = document.getElementById('ed_nfo_offset')
, span_byte = document.createElement('span')
;

var ED_HEIGTH;
var CURRENT_LINES_NUMBER;
var CURRENT_LIMIT;
var CURRENT_START = 0;
var CURRENT_SELECTED;
var CURRENT_OFFSET = 0;

function getLineHeight(element){
  // thanks: http://stackoverflow.com/a/4515470
   var temp = document.createElement(element.nodeName);
   temp.setAttribute("style","margin:0px;padding:0px;font-family:"+element.style.fontFamily+";font-size:"+element.style.fontSize);
   temp.innerHTML = "test";
   temp = element.parentNode.appendChild(temp);
   var ret = temp.clientHeight;
   temp.parentNode.removeChild(temp);
   return ret;
}

// must preload font-face before =_=
var LINEHEIGHT = 12 // getLineHeight(ed_ascii);
//console.log(LINEHEIGHT);

function setConstants() {
  ED_HEIGTH = ed_section.offsetHeight;
  CURRENT_LINES_NUMBER = Math.floor((ED_HEIGTH) / LINEHEIGHT);
}
function reset() {
  undoManager.clear();
  CURRENT_START = 0;
  ed_ui_scrollbar.style.top = '0px';
}
function init() {
  setConstants();
  createSpans();
  if (BLOB) {
    CURRENT_LIMIT = BLOB.size - ((CURRENT_LINES_NUMBER * 16)/2);
    displayChunck(CURRENT_START);
  }
}

var resize = $io.fn.debounce(function() {
  init()
}, 100);

window.onresize = resize;

// events
/////////////////////////////////////////////////////////////////////////////

$el(ed_section)
  .on('mouseover', '#ed_hexa span, #ed_ascii span', function(arg) {
    (this.parentNode.id === 'ed_hexa' ? ed_ascii : ed_hexa)
      .querySelector('[data-offset="' + this.dataset.offset + '"]').classList.add('over');
  })
  .on('mouseout', '#ed_hexa span, #ed_ascii span', function(arg) {
    removeOver();
  })
  .on('click', '#ed_hexa span, #ed_ascii span', function(arg) {
    setCursor(this);
  })
;

$wheel(ed_section, function(dt, factor) {
  var start;
  if (dt === -1) {
    if (CURRENT_START + 16 * ~~factor < CURRENT_LIMIT) {
      start = CURRENT_START + 16 * ~~factor;
      displayChunck(start);
    } else if (CURRENT_START + 16 < CURRENT_LIMIT) {
      start = CURRENT_START + 16;
      displayChunck(start);
    }
  } else if (CURRENT_START > 0) {
    start = CURRENT_START - 16 * ~~factor;
    if (start < 0) start = 0;
    displayChunck(start);
  }
}, {acceleration: 30});


var nibble = 0;
$key(ed_section).down(function(key, code, event) {
       if (key==='left')  moveCursor(-1);
  else if (key==='right') moveCursor(1);
  else if (key==='up')    moveCursor(-16);
  else if (key==='down')  moveCursor(16);
  else {
    if (/num_\d/.test(key)) key = key.replace('num_',''), code = key.charCodeAt(0);
    if (CURRENT_SELECTED.parentNode.id === 'ed_hexa') {
      if (key==='space') {nibble++; if (nibble >= 2) moveCursor(1); return false};
      if (key==='enter') {moveCursor(16); return false};
      if (key==='backspace') {moveCursor(-1); return false};
      key = key.toLowerCase();
      if (key.length === 1 && isHexChar(key)) {
        var text = CURRENT_SELECTED.textContent.split('');
        text[nibble] = key
        editOffset(text.join(''));
        nibble++;
        if (nibble === 2) moveCursor(1);
      } else {
        return false;
      }
    } else {
      if (key==='space') key = ' ';
      if (key==='enter') key = '\n';
      if (key==='backspace') {moveCursor(-1); return false};
      if (/tab|shift|ctrl|alt|altgr/.test(key)) return false;
      if (key.length === 1) {
        editOffset(asHex(key.charCodeAt(0)));
        moveCursor(1);
      }
    }
  }
});


var undoManager = $undo();

function forEachEditedBytes(cb) {
  undoManager.each(function(hist) {
    cb(hist[0], hist[1]);
  })
}

function displayEditedBytes() {
  forEachEditedBytes(function(offset, hex) {
    var c = offset - CURRENT_START;
    if (c >= 0 && c <= CURRENT_LINES_NUMBER * 16) setOffset(offset, hex);
  });
}

function editOffset(hex) {
  setOffset(CURRENT_OFFSET, hex);
  undoManager.add([CURRENT_OFFSET, hex]);

  displayBinary(hex);
}

function setOffset(offset, hex) {
  var asciiByteEL = ed_ascii.querySelector('[data-offset="' + (offset - CURRENT_START) + '"]');
  var hexaByteEL = ed_hexa.querySelector('[data-offset="' + (offset - CURRENT_START) + '"]');
  var asciiCode = parseInt(hex, 16);
  if (isPrintable(asciiCode)) {
    asciiByteEL.textContent = String.fromCharCode(asciiCode);
    asciiByteEL.classList.remove('noprint');
  } else {
    asciiByteEL.textContent = '·';
    asciiByteEL.classList.add('noprint');
  }
  asciiByteEL.classList.add('edited');
  hexaByteEL.classList.add('edited');
  hexaByteEL.textContent = hex;
}

/////////////////////////////////////////////////////////////////////////////

function moveCursor(dir, noretry) {
  if (CURRENT_OFFSET + dir >= 0 && CURRENT_OFFSET + dir < BLOB.size) {
    CURRENT_OFFSET += dir;
    var n = CURRENT_SELECTED.parentNode.querySelector('[data-offset="' + (CURRENT_OFFSET - CURRENT_START) + '"]');

    if (n) setCursor(n);
    else if (!noretry) {
      var start = CURRENT_START + (dir > 0 ? 16 : -16);
      if (start < 0) start = 0;
      displayChunck(start);
    }
  }
}

function setCursorByOffset(off) {
  var n = ((CURRENT_SELECTED||'').parentNode || ed_hexa).querySelector('[data-offset="' + (off - CURRENT_START) + '"]');
  if (n) setCursor(n);
}

function setCursor(el) {
  nibble = 0;
  selectByte(el.dataset.offset);
  el.classList.add('selected_edit');
  el.parentNode.focus();
  CURRENT_SELECTED = el;
}

var asciiByteEL;
var hexaByteEL;
function selectByte(offset) {
  CURRENT_OFFSET = CURRENT_START + offset*1;
  removeSelect();
  asciiByteEL = ed_ascii.querySelector('[data-offset="' + offset + '"]');
  hexaByteEL = ed_hexa.querySelector('[data-offset="' + offset + '"]');
  asciiByteEL.classList.add('selected');
  hexaByteEL.classList.add('selected');
  displayBinary(hexaByteEL.textContent);
  displayOffset(CURRENT_OFFSET);
}

function displayOffset(off) {
  ed_nfo_offset.innerHTML = 'Offset : 0x' + parseInt(off).toString(16) + ' (' + off + ')';
}
var bin_btns = ed_ui_binedit.querySelectorAll('button');
function changeBinayBtn(el, bin) {
  bin += '';
  el.textContent = bin;
  if (bin === '1')
    el.classList.add('skin_inset'),
    el.classList.remove('skin_outset');
  else
    el.classList.add('skin_outset'),
    el.classList.remove('skin_inset');
}
function displayBinary(hex) {
  var byt = (lpad(parseInt(hex.charAt(0), 16).toString(2), 4) + lpad(parseInt(hex.charAt(1), 16).toString(2), 4)).split('');
  for (var i = 0, l = byt.length; i < l; i++) {
    changeBinayBtn(bin_btns[i], byt[i]);
  }
}

$io.arr.all(bin_btns, function(item) {
  item.addEventListener('click', function() {
    changeBinayBtn(this, this.textContent === '0' ? '1' : '0');
    var byte1 = '';
    var byte2 = '';
    $io.arr.all(bin_btns, function(item) {
      if (byte1.length < 4) {
        byte1 += item.textContent;
      } else {
        byte2 += item.textContent;
      }
    });
    //setOffset(CURRENT_OFFSET, parseInt(byte1, 2).toString(16) + parseInt(byte2, 2).toString(16));
    editOffset(parseInt(byte1, 2).toString(16) + parseInt(byte2, 2).toString(16));
  }, false);
});

// helpers
/////////////////////////////////////////////////////////////////////////////
function isPrintable(asciiCode) {
  return (asciiCode >= 0x20 && asciiCode < 0x7f) || (asciiCode >= 0xa1 && asciiCode <= 0xff) && asciiCode !== 0xad;
}
function isHexChar(c) {
  return (c >= 'a' && c <= 'f') || (c >= '0' && c <= '9');
}
function lpad(s, length, paddingChar) {
  if (paddingChar == null) paddingChar = '0';
  while (s.length < length) s = paddingChar + s;
  return s;
}
function asHex(i) {
  var h = parseInt(i).toString(16);
  return (h.length % 2 != 0) ? '0' + h : h;
}
function removeOver() {
  $io.arr.all(document.querySelectorAll('.over'), function(item) {item.classList.remove('over')});
}
function removeSelect() {
  $io.arr.all(document.querySelectorAll('.selected'), function(item) {
    item.classList.remove('selected');
    item.classList.remove('selected_edit')});
}


// parse binary
/////////////////////////////////////////////////////////////////////////////
var asciiByteELs;
var hexaByteELs;
var addrByteELs;
function createSpans() {
  ed_ascii.innerHTML = '';
  ed_hexa.innerHTML = '';
  ed_addr.innerHTML = '';

  var asciifrag = document.createDocumentFragment();
  var hexafrag = document.createDocumentFragment();
  var addrfrag = document.createDocumentFragment();
  for (var i = 0; i < CURRENT_LINES_NUMBER * 16; i++) {
    var asciiByteEL = span_byte.cloneNode(false);
    var hexaByteEL = span_byte.cloneNode(false);
    asciiByteEL.dataset.offset = i;
    hexaByteEL.dataset.offset = i;
    if (i % 16 == 0) {
      var addrByteEL = span_byte.cloneNode(false);
      addrByteEL.textContent = lpad(asHex(i), 8);
      addrfrag.appendChild(addrByteEL);
    }
    asciifrag.appendChild(asciiByteEL);
    hexafrag.appendChild(hexaByteEL);
  }
  ed_ascii.appendChild(asciifrag);
  ed_hexa.appendChild(hexafrag);
  ed_addr.appendChild(addrfrag);
  asciiByteELs = ed_ascii.querySelectorAll('span');
  hexaByteELs = ed_hexa.querySelectorAll('span');
  addrByteELs = ed_addr.querySelectorAll('span');
}

function displayChunckFn(start) {
  if (start < BLOB.size && start >= 0) {
    var end = start + CURRENT_LINES_NUMBER * 16;
    if (end > BLOB.size) end = BLOB.size;

    $io.Blob.BinaryString(BLOB.slice(start, end), function(val) {

      CURRENT_START = start;
      ed_nfo_addr.textContent = CURRENT_START;
      ed_ui_scrollbar.style.top = (CURRENT_START / CURRENT_LIMIT) * (ED_HEIGTH - ed_ui_scrollbar.offsetHeight) + 'px';

      $io.arr.each(addrByteELs, function(item, i) {
        item.textContent = lpad(asHex(CURRENT_START + i * 16), 8);
      });

      for (var i = 0; i < CURRENT_LINES_NUMBER * 16; i++) {
        var asciiByteEL = asciiByteELs[i];
        var hexaByteEL = hexaByteELs[i];
        var asciiCode = val.charCodeAt(i);
        if (asciiCode*1 === asciiCode) {
          if (isPrintable(asciiCode)) {
            asciiByteEL.textContent = val.charAt(i);
            asciiByteEL.className = '';
          } else {
            asciiByteEL.textContent = '·';
            asciiByteEL.className = 'noprint';
          }
          var byteStr = asciiCode.toString(16);
          if (byteStr.length < 2) byteStr = '0' + byteStr;
          hexaByteEL.className = '';

        } else {
          byteStr = '..';
          asciiByteEL.textContent = '.';
          asciiByteEL.className = 'invisible';
          hexaByteEL.className = 'invisible';
        }
        hexaByteEL.textContent = byteStr;
      }
      setCursorByOffset(CURRENT_OFFSET);
      displayEditedBytes();
    });
  }
}

var displayChunck = $io.fn.debounce(displayChunckFn, 1);

/////////////////////////////////////////////////////////////////////////////

function setCursorOnHistoryCursor(historyCursor) {
  try {
    //setCursorByOffset(undoHistory[undoHistCursor-1][0]);
    setCursorByOffset(historyCursor[0]);
  } catch(e) {/*console.error(e)*/}
}

function $iframeInit(cb) { 'use strict';

  if (this.menu.key) {
    var cfg = this.menu.key.config();
    delete cfg.el;
    var kkk = $key().config(cfg);
    this.menu.key.destroy();
  }

  return  {
    readFile: function(val) {
      BLOB = val;
      reset();
      init();
    },
    setValue: function(val) {
      if (!val) {
        var buffer = new ArrayBuffer(256);
        var int8View = new Int8Array(buffer);
        for (var i = 0; i < int8View.length; i++) int8View[i] = i;
        BLOB = new Blob([int8View], {type: 'text/plain'})
      } else {
        BLOB = val;
      }
      reset();
      init();
    },
    getValue: function(cb) {
      $io.Blob.ArrayBuffer(BLOB, function(buffer) {
        var int8View = new Int8Array(buffer);
        forEachEditedBytes(function(offset, hex) {
          int8View[offset] = parseInt(hex, 16);
        });
        cb(new Blob([int8View], {type: BLOB.type}));
      });
    },
    undo: function(cb) {
      undoManager.undo(function(historyCursor) {
        displayChunckFn(CURRENT_START);
        setCursorOnHistoryCursor(historyCursor);
      });
    },
    redo: function(cb) {
      undoManager.redo(function(historyCursor) {
        displayChunckFn(CURRENT_START);
        setCursorOnHistoryCursor(historyCursor);
      });
    }
  }
}

</script>

<!--

Complete List of ASCii codes     Format: plain text www.theasciicode.com.ar


    symbol
ascii code  0 NULL  (Null character)
ascii code  1 SOH (Start of Header)
ascii code  2 STX (Start of Text)
ascii code  3 ETX (End of Text)
ascii code  4 EOT (End of Transmission)
ascii code  5 ENQ (Enquiry)
ascii code  6 ACK (Acknowledgement)
ascii code  7 BEL (Bell)
ascii code  8 BS  (Backspace)
ascii code  9 HT  (Horizontal Tab)
ascii code  10  LF  (Line feed)
ascii code  11  VT  (Vertical Tab)
ascii code  12  FF  (Form feed)
ascii code  13  CR  (Carriage return)
ascii code  14  SO  (Shift Out)
ascii code  15  SI  (Shift In)
ascii code  16  DLE (Data link escape)
ascii code  17  DC1 (Device control 1)
ascii code  18  DC2 (Device control 2)
ascii code  19  DC3 (Device control 3)
ascii code  20  DC4 (Device control 4)
ascii code  21  NAK (Negative acknowledgement)
ascii code  22  SYN (Synchronous idle)
ascii code  23  ETB (End of transmission block)
ascii code  24  CAN (Cancel)
ascii code  25  EM  (End of medium)
ascii code  26  SUB (Substitute)
ascii code  27  ESC (Escape)
ascii code  28  FS  (File separator)
ascii code  29  GS  (Group separator)
ascii code  30  RS  (Record separator)
ascii code  31  US  (Unit separator)

ascii code  32    (space)
ascii code  33  ! (exclamation mark)
ascii code  34  " (Quotation mark)
ascii code  35  # (Number sign)
ascii code  36  $ (Dollar sign)
ascii code  37  % (Percent sign)
ascii code  38  & (Ampersand)
ascii code  39  ' (Apostrophe)
ascii code  40  ( (round brackets or parentheses)
ascii code  41  ) (round brackets or parentheses)
ascii code  42  * (Asterisk)
ascii code  43  + (Plus sign)
ascii code  44  , (Comma)
ascii code  45  - (Hyphen)
ascii code  46  . (Full stop , dot)
ascii code  47  / (Slash)
ascii code  48  0 (number zero)
ascii code  49  1 (number one)
ascii code  50  2 (number two)
ascii code  51  3 (number three)
ascii code  52  4 (number four)
ascii code  53  5 (number five)
ascii code  54  6 (number six)
ascii code  55  7 (number seven)
ascii code  56  8 (number eight)
ascii code  57  9 (number nine)
ascii code  58  : (Colon)
ascii code  59  ; (Semicolon)
ascii code  60  < (Less-than sign )
ascii code  61  = (Equals sign)
ascii code  62  > (Greater-than sign ; Inequality)
ascii code  63  ? (Question mark)
ascii code  64  @ (At sign)
ascii code  65  A (Capital A )
ascii code  66  B (Capital B )
ascii code  67  C (Capital C )
ascii code  68  D (Capital D )
ascii code  69  E (Capital E )
ascii code  70  F (Capital F )
ascii code  71  G (Capital G )
ascii code  72  H (Capital H )
ascii code  73  I (Capital I )
ascii code  74  J (Capital J )
ascii code  75  K (Capital K )
ascii code  76  L (Capital L )
ascii code  77  M (Capital M )
ascii code  78  N (Capital N )
ascii code  79  O (Capital O )
ascii code  80  P (Capital P )
ascii code  81  Q (Capital Q )
ascii code  82  R (Capital R )
ascii code  83  S (Capital S )
ascii code  84  T (Capital T )
ascii code  85  U (Capital U )
ascii code  86  V (Capital V )
ascii code  87  W (Capital W )
ascii code  88  X (Capital X )
ascii code  89  Y (Capital Y )
ascii code  90  Z (Capital Z )
ascii code  91  [ (square brackets or box brackets)
ascii code  92  \ (Backslash)
ascii code  93  ] (square brackets or box brackets)
ascii code  94  ^ (Caret or circumflex accent)
ascii code  95  _ (underscore , understrike , underbar or low line)
ascii code  96  ` (Grave accent)
ascii code  97  a (Lowercase  a )
ascii code  98  b (Lowercase  b )
ascii code  99  c (Lowercase  c )
ascii code  100 d (Lowercase  d )
ascii code  101 e (Lowercase  e )
ascii code  102 f (Lowercase  f )
ascii code  103 g (Lowercase  g )
ascii code  104 h (Lowercase  h )
ascii code  105 i (Lowercase  i )
ascii code  106 j (Lowercase  j )
ascii code  107 k (Lowercase  k )
ascii code  108 l (Lowercase  l )
ascii code  109 m (Lowercase  m )
ascii code  110 n (Lowercase  n )
ascii code  111 o (Lowercase  o )
ascii code  112 p (Lowercase  p )
ascii code  113 q (Lowercase  q )
ascii code  114 r (Lowercase  r )
ascii code  115 s (Lowercase  s )
ascii code  116 t (Lowercase  t )
ascii code  117 u (Lowercase  u )
ascii code  118 v (Lowercase  v )
ascii code  119 w (Lowercase  w )
ascii code  120 x (Lowercase  x )
ascii code  121 y (Lowercase  y )
ascii code  122 z (Lowercase  z )
ascii code  123 { (curly brackets or braces)
ascii code  124 | (vertical-bar, vbar, vertical line or vertical slash)
ascii code  125 } (curly brackets or braces)
ascii code  126 ~ (Tilde ; swung dash)
ascii code  127 DEL (Delete)

ascii code  128 Ç (Majuscule C-cedilla )
ascii code  129 ü (letter "u" with umlaut or diaeresis ; "u-umlaut")
ascii code  130 é (letter "e" with acute accent or "e-acute")
ascii code  131 â (letter "a" with circumflex accent or "a-circumflex")
ascii code  132 ä (letter "a" with umlaut or diaeresis ; "a-umlaut")
ascii code  133 à (letter "a" with grave accent)
ascii code  134 å (letter "a"  with a ring)
ascii code  135 ç (Minuscule c-cedilla)
ascii code  136 ê (letter "e" with circumflex accent or "e-circumflex")
ascii code  137 ë (letter "e" with umlaut or diaeresis ; "e-umlaut")
ascii code  138 è (letter "e" with grave accent)
ascii code  139 ï (letter "i" with umlaut or diaeresis ; "i-umlaut")
ascii code  140 î (letter "i" with circumflex accent or "i-circumflex")
ascii code  141 ì (letter "i" with grave accent)
ascii code  142 Ä (letter "A" with umlaut or diaeresis ; "A-umlaut")
ascii code  143 Å (letter "A"  with a ring)
ascii code  144 É (Capital letter "E" with acute accent or "E-acute")
ascii code  145 æ (Latin diphthong "ae")
ascii code  146 Æ (Latin diphthong "AE")
ascii code  147 ô (letter "o" with circumflex accent or "o-circumflex")
ascii code  148 ö (letter "o" with umlaut or diaeresis ; "o-umlaut")
ascii code  149 ò (letter "o" with grave accent)
ascii code  150 û (letter "u" with circumflex accent or "u-circumflex")
ascii code  151 ù (letter "u" with grave accent)
ascii code  152 ÿ (letter "y" with diaeresis)
ascii code  153 Ö (letter "O" with umlaut or diaeresis ; "O-umlaut")
ascii code  154 Ü (letter "U" with umlaut or diaeresis ; "U-umlaut")
ascii code  155 ø (slashed zero or empty set)
ascii code  156 £ (Pound sign ; symbol for the pound sterling)
ascii code  157 Ø (slashed zero or empty set)
ascii code  158 × (multiplication sign)
ascii code  159 ƒ (function sign ; f with hook sign ; florin sign )
ascii code  160 á (letter "a" with acute accent or "a-acute")
ascii code  161 í (letter "i" with acute accent or "i-acute")
ascii code  162 ó (letter "o" with acute accent or "o-acute")
ascii code  163 ú (letter "u" with acute accent or "u-acute")
ascii code  164 ñ (letter "n" with tilde ; enye)
ascii code  165 Ñ (letter "N" with tilde ; enye)
ascii code  166 ª (feminine ordinal indicator )
ascii code  167 º (masculine ordinal indicator)
ascii code  168 ¿ (Inverted question marks)
ascii code  169 ® (Registered trademark symbol)
ascii code  170 ¬ (Logical negation symbol)
ascii code  171 ½ (One half)
ascii code  172 ¼ (Quarter or  one fourth)
ascii code  173 ¡ (Inverted exclamation marks)
ascii code  174 « (Guillemets or  angle quotes)
ascii code  175 » (Guillemets or  angle quotes)
ascii code  176 ░
ascii code  177 ▒
ascii code  178 ▓
ascii code  179 │ (Box drawing character)
ascii code  180 ┤ (Box drawing character)
ascii code  181 Á (Capital letter "A" with acute accent or "A-acute")
ascii code  182 Â (letter "A" with circumflex accent or "A-circumflex")
ascii code  183 À (letter "A" with grave accent)
ascii code  184 © (Copyright symbol)
ascii code  185 ╣ (Box drawing character)
ascii code  186 ║ (Box drawing character)
ascii code  187 ╗ (Box drawing character)
ascii code  188 ╝ (Box drawing character)
ascii code  189 ¢ (Cent symbol)
ascii code  190 ¥ (YEN and YUAN sign)
ascii code  191 ┐ (Box drawing character)
ascii code  192 └ (Box drawing character)
ascii code  193 ┴ (Box drawing character)
ascii code  194 ┬ (Box drawing character)
ascii code  195 ├ (Box drawing character)
ascii code  196 ─ (Box drawing character)
ascii code  197 ┼ (Box drawing character)
ascii code  198 ã (letter "a" with tilde or "a-tilde")
ascii code  199 Ã (letter "A" with tilde or "A-tilde")
ascii code  200 ╚ (Box drawing character)
ascii code  201 ╔ (Box drawing character)
ascii code  202 ╩ (Box drawing character)
ascii code  203 ╦ (Box drawing character)
ascii code  204 ╠ (Box drawing character)
ascii code  205 ═ (Box drawing character)
ascii code  206 ╬ (Box drawing character)
ascii code  207 ¤ (generic currency sign )
ascii code  208 ð (lowercase "eth")
ascii code  209 Ð (Capital letter "Eth")
ascii code  210 Ê (letter "E" with circumflex accent or "E-circumflex")
ascii code  211 Ë (letter "E" with umlaut or diaeresis ; "E-umlaut")
ascii code  212 È (letter "E" with grave accent)
ascii code  213 ı (lowercase dot less i)
ascii code  214 Í (Capital letter "I" with acute accent or "I-acute")
ascii code  215 Î (letter "I" with circumflex accent or "I-circumflex")
ascii code  216 Ï (letter "I" with umlaut or diaeresis ; "I-umlaut")
ascii code  217 ┘ (Box drawing character)
ascii code  218 ┌ (Box drawing character)
ascii code  219 █ (Block)
ascii code  220 ▄
ascii code  221 ¦ (vertical broken bar )
ascii code  222 Ì (letter "I" with grave accent)
ascii code  223 ▀
ascii code  224 Ó (Capital letter "O" with acute accent or "O-acute")
ascii code  225 ß (letter "Eszett" ; "scharfes S" or "sharp S")
ascii code  226 Ô (letter "O" with circumflex accent or "O-circumflex")
ascii code  227 Ò (letter "O" with grave accent)
ascii code  228 õ (letter "o" with tilde or "o-tilde")
ascii code  229 Õ (letter "O" with tilde or "O-tilde")
ascii code  230 µ (Lowercase letter "Mu" ; micro sign or micron)
ascii code  231 þ (capital letter "Thorn")
ascii code  232 Þ (lowercase letter "thorn")
ascii code  233 Ú (Capital letter "U" with acute accent or "U-acute")
ascii code  234 Û (letter "U" with circumflex accent or "U-circumflex")
ascii code  235 Ù (letter "U" with grave accent)
ascii code  236 ý (letter "y" with acute accent)
ascii code  237 Ý (Capital letter "Y" with acute accent)
ascii code  238 ¯ (macron symbol)
ascii code  239 ´ (Acute accent)
ascii code  240 ¬ (Hyphen)
ascii code  241 ± (Plus-minus sign)
ascii code  242 ‗ (underline or underscore)
ascii code  243 ¾ (three quarters)
ascii code  244 ¶ (paragraph sign or pilcrow)
ascii code  245 § (Section sign)
ascii code  246 ÷ (The division sign ; Obelus)
ascii code  247 ¸ (cedilla)
ascii code  248 ° (degree symbol )
ascii code  249 ¨ (Diaeresis)
ascii code  250 • (Interpunct or space dot)
ascii code  251 ¹ (superscript one)
ascii code  252 ³ (cube or superscript three)
ascii code  253 ² (Square or superscript two)
ascii code  254 ■ (black square)
ascii code  255 nbsp  (non-breaking space or no-break space)

    visit : www.theasciicode.com.ar



 -->


</body>
</html>