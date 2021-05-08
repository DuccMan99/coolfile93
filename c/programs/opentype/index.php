<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>glyph inspector</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>

<body>

<style>
  #glyph, #glyph-bg {
      position: absolute;
      top: 0;
      left: 0;
  }
  #glyph-data    { padding-left: 5px; }
  #glyph-data dl { margin: 0; }
  #glyph-data dt { float: left; }
  #glyph-data dd { margin-left: 12em; width: 100px; }

  #glyph-data pre { font-family: _tomo, monospace; font-size: 8px; color:#666; }

  canvas.item {
    float: left;
    /*border: solid 1px #a0a0a0;*/
    /*background-color: #fff;*/
    margin-right: -1px;
    margin-bottom: -1px;
    cursor: pointer;
  }
  canvas.item:hover {
    background-color: #e0e0e0;
  }

  .safe_preview {
    font: 60px/1 Arial, sans-serif;
    color: #999;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.6), 0 -1px 0 rgba(85, 85, 85, 0.6);
    position: absolute;
    top: 2px;
    right: 15px;
    padding: 5px;
    /*width: 40px;*/
    text-align: center;
  }
</style>

<div class="ui_layout skin_base skin_scrollbar">
  <article>
    <aside style="width:302px;margin-right:5px">
      <div class="ui_layout">
        <header class="mb1">
          <div id="glyph-display" class="skin_outset _skin_light mr1 pa5" style=" height:302px">
            <canvas id="glyph-bg" width="300" height="300"></canvas>
            <canvas id="glyph" width="300" height="300"></canvas>
          </div>
        </header>
        <header>
          <span class="info bold pl5 pt1" id="font-name">Roboto-Black</span>
        </header>
        <section class="pa5 pr0 mr1 mb1 mt1 skin_inset _skin_light">
          <div id="glyph-data"></div>
        </section>
      </div>
    </aside>
    <section class="pa5">
      <div class="ui_layout">
        <section class="pa5 mr1 mb5 skin_inset skin_outset">
          <div id="glyph-list-end"></div>
        </section>
        <footer class="mt1">
          <span id="pagination" class="ui_combo"></span>
        </footer>
      </div>
    </section>
  </article>
</div>


<script src="./opentype.js-master/dist/opentype.js"></script>
<script>
var cellCount = 100,
  cellWidth = 44,
  cellHeight = 40,
  cellMarginTop = 1,
  cellMarginBottom = 8,
  cellMarginLeftRight = 1,
  glyphMargin = 20;

var displayArrow = false;
var displayBezier = false;


var pageSelected, font, fontScale, fontSize, fontBaseline, glyphScale, glyphSize, glyphBaseline;

function showErrorMessage(message) {
  var el = document.getElementById('message');
  if (!message || message.trim().length === 0) {
    el.style.display = 'none';
  } else {
    el.style.display = 'block';
  }
  el.innerHTML = message;
}

function pathCommandToString(cmd) {
  var str = '<strong>' + cmd.type + '</strong> ' +
    ((cmd.x !== undefined) ? 'x='+cmd.x+' y='+cmd.y+' ' : '') +
    ((cmd.x1 !== undefined) ? 'x1='+cmd.x1+' y1='+cmd.y1+' ' : '') +
    ((cmd.x2 !== undefined) ? 'x2='+cmd.x2+' y2='+cmd.y2 : '');
  return str;
}

function contourToString(contour) {
  return '<pre class="contour">' + contour.map(function(point) {
    return '<span class="' + (point.onCurve ? 'on' : 'off') + 'curve">x=' + point.x + ' y=' + point.y + '</span>';
  }).join('\n') + '</pre>';
}

function formatUnicode(unicode) {
  unicode = unicode.toString(16);
  if (unicode.length > 4) {
    return ("000000" + unicode.toUpperCase()).substr(-6)
  } else {
    return ("0000" + unicode.toUpperCase()).substr(-4)
  }
}

function displayGlyphData(glyphIndex) {
  var container = document.getElementById('glyph-data');
  if (glyphIndex < 0) {
    container.innerHTML = '';
    return;
  }
  var glyph = font.glyphs[glyphIndex],
    html;
  html = '<dt>name</dt><dd>'+glyph.name+'</dd>';

  if (glyph.unicodes.length > 0) {
    //console.log();
    html += '<dt>unicode</dt><dd>'+ glyph.unicodes.map(formatUnicode).join(', ') +'</dd>';
    html += '<div class="safe_preview">&#x'+ glyph.unicodes.map(formatUnicode)[0] +';</div>';
  }
  html += '<dl><dt>index</dt><dd>'+glyph.index+'</dd>';

  if (glyph.xMin !== 0 || glyph.xMax !== 0 || glyph.yMin !== 0 || glyph.yMax !== 0) {
    html += '<dt>xMin</dt><dd>'+glyph.xMin+'</dd>' +
      '<dt>xMax</dt><dd>'+glyph.xMax+'</dd>' +
      '<dt>yMin</dt><dd>'+glyph.yMin+'</dd>' +
      '<dt>yMax</dt><dd>'+glyph.yMax+'</dd>';
  }
  html += '<dt>advanceWidth</dt><dd>'+glyph.advanceWidth+'</dd>';
  if(glyph.leftSideBearing !== undefined) {
    html += '<dt>leftSideBearing</dt><dd>'+glyph.leftSideBearing+'</dd>';
  }
  html += '</dl>';
  if (glyph.numberOfContours > 0) {
    var contours = glyph.getContours();
    html += 'contours:<br>' + contours.map(contourToString).join('\n');
  } else if (glyph.isComposite) {
    html += '<br>This composite glyph is a combination of :<ul><li>' +
      glyph.components.map(function(component) {
        return 'glyph '+component.glyphIndex+' at dx='+component.dx+', dy='+component.dy;
      }).join('</li><li>') + '</li></ul>';
  } else if (glyph.path) {
    html += 'path:<br><pre>  ' + glyph.path.commands.map(pathCommandToString).join('\n  ') + '\n</pre>';
  }
  container.innerHTML = html;
}

var arrowLength = 10,
  arrowAperture = 4;

function drawArrow(ctx, x1, y1, x2, y2) {
  var dx = x2 - x1,
    dy = y2 - y1,
    segmentLength = Math.sqrt(dx*dx + dy*dy),
    unitx = dx / segmentLength,
    unity = dy / segmentLength,
    basex = x2 - arrowLength * unitx,
    basey = y2 - arrowLength * unity,
    normalx = arrowAperture * unity,
    normaly = -arrowAperture * unitx;
  ctx.beginPath();
  ctx.moveTo(~~x2, ~~y2);
  ctx.lineTo(~~(basex + normalx), ~~(basey + normaly));
  ctx.lineTo(~~(basex - normalx), ~~(basey - normaly));
  ctx.lineTo(~~x2, ~~y2);
  ctx.closePath();
  ctx.fill();
}


/**
 * This function is Path.prototype.draw with an arrow
 * at the end of each contour.
 */
function drawPathWithArrows(ctx, path) {
  var i, cmd, x1, y1, x2, y2;
  var arrows = [];

  ctx.beginPath();
  for (i = 0; i < path.commands.length; i += 1) {
    cmd = path.commands[i];
    if (cmd.type === 'M') {
      if(x1 !== undefined) {
        arrows.push([ctx, x1, y1, x2, y2]);
      }
      ctx.moveTo(~~cmd.x, ~~cmd.y);
    } else if (cmd.type === 'L') {
      ctx.lineTo(~~cmd.x, ~~cmd.y);
      x1 = x2;
      y1 = y2;
    } else if (cmd.type === 'C') {
      ctx.bezierCurveTo(cmd.x1, cmd.y1, cmd.x2, cmd.y2, ~~cmd.x, ~~cmd.y);
      x1 = cmd.x2;
      y1 = cmd.y2;
    } else if (cmd.type === 'Q') {
      ctx.quadraticCurveTo(cmd.x1, cmd.y1, ~~cmd.x, ~~cmd.y);
      x1 = cmd.x1;
      y1 = cmd.y1;
    } else if (cmd.type === 'Z') {
      arrows.push([ctx, x1, y1, x2, y2]);
      ctx.closePath();
    }
    x2 = cmd.x;
    y2 = cmd.y;
  }
  if (path.fill) {
    ctx.fillStyle = path.fill;
    ctx.fill();
  }
  if (path.stroke) {
    ctx.strokeStyle = path.stroke;
    ctx.lineWidth = path.strokeWidth;
    ctx.stroke();
  }
  if (!displayArrow) {
    ctx.fillStyle = '#000000';
    arrows.forEach(function(arrow) {
      drawArrow.apply(null, arrow);
    });
  }
}

function displayGlyph(glyphIndex) {
  var canvas = document.getElementById('glyph'),
    ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  if(glyphIndex < 0) return;
  var glyph = font.glyphs[glyphIndex],
    glyphWidth = glyph.advanceWidth * glyphScale,
    xmin = (canvas.width - glyphWidth)/2,
    xmax = (canvas.width + glyphWidth)/2,
    x0 = xmin,
    markSize = 20;

  ctx.webkitImageSmoothingEnabled =
  ctx.oImageSmoothingEnabled =
  ctx.mozImageSmoothingEnabled =
  ctx.imageSmoothingEnabled = false;

  ctx.fillStyle = '#606060';
  ctx.font = '8px px_sans_nouveaux';

  ctx.fillRect(~~xmin-markSize+1, ~~glyphBaseline, markSize, 1);
  ctx.fillRect(~~xmin, ~~glyphBaseline, 1, markSize);
  ctx.fillRect(~~xmax, ~~glyphBaseline, markSize, 1);
  ctx.fillRect(~~xmax, ~~glyphBaseline, 1, markSize);
  ctx.textAlign = 'center';
  //ctx.fillText('0', ~~xmin, glyphBaseline+markSize+10);
  //ctx.fillText(glyph.advanceWidth, ~~xmax, glyphBaseline+markSize+10);

  ctx.fillStyle = '#000000';
  var path = glyph.getPath(~~x0, ~~glyphBaseline, glyphSize);
  path.fill = '#808080';
  path.stroke = '#000000';
  path.strokeWidth = 1;
  ctx.translate(0.5,0.5);
  drawPathWithArrows(ctx, path);
  if (displayBezier) drawPoints.call(glyph, ctx, ~~x0, ~~glyphBaseline, glyphSize);
  ctx.translate(-0.5,-0.5);

}

drawPoints = function (ctx, x, y, fontSize) {
  function drawCircles(l, x, y, scale) {
    var j, PI_SQ = Math.PI * 2;
    ctx.translate(-0.5,-0.5);
    ctx.beginPath();
    for (j = 0; j < l.length; j += 1) {
      ctx.moveTo(~~(x + (l[j].x * scale)), ~~(y + (l[j].y * scale)));
      ctx.arc(x + (l[j].x * scale), y + (l[j].y * scale), 3, 0, PI_SQ, false);
    }
    ctx.closePath();
    ctx.fill();
    ctx.translate(0.5,0.5);
  }
  var scale, i, blueCircles, redCircles, path, cmd;
  x = x !== undefined ? x : 0;
  y = y !== undefined ? y : 0;
  fontSize = fontSize !== undefined ? fontSize : 24;
  scale = 1 / this.font.unitsPerEm * fontSize;

  blueCircles = [];
  redCircles = [];
  path = this.path;
  for (i = 0; i < path.commands.length; i += 1) {
    cmd = path.commands[i];
    if (cmd.x !== undefined) {
      blueCircles.push({x: cmd.x, y: -cmd.y});
    }
    if (cmd.x1 !== undefined) {
      redCircles.push({x: cmd.x1, y: -cmd.y1});
    }
    if (cmd.x2 !== undefined) {
      redCircles.push({x: cmd.x2, y: -cmd.y2});
    }
  }

  ctx.fillStyle = 'rgba(0,255,255,0.5)';
  drawCircles(blueCircles, x, y, scale);
  ctx.fillStyle = 'rgba(255,0,255,0.5)';
  drawCircles(redCircles, x, y, scale);
};

function renderGlyphItem(canvas, glyphIndex) {
  var cellMarkSize = 4;
  var ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, cellWidth, cellHeight);
  if (glyphIndex >= font.numGlyphs) return;

  ctx.webkitImageSmoothingEnabled =
  ctx.oImageSmoothingEnabled =
  ctx.mozImageSmoothingEnabled =
  ctx.imageSmoothingEnabled = false;

  ctx.fillStyle = '#999';
  ctx.font = '8px _tomo';
  ctx.fillText(glyphIndex, 1, cellHeight-1);
  var glyph = font.glyphs[glyphIndex],
    glyphWidth = glyph.advanceWidth * fontScale,
    xmin = (cellWidth - glyphWidth)/2,
    xmax = (cellWidth + glyphWidth)/2,
    x0 = xmin;

  ctx.fillStyle = '#999';
  ctx.fillRect(~~xmin-cellMarkSize+1, ~~fontBaseline, cellMarkSize, 1);
  ctx.fillRect(~~xmin, ~~fontBaseline, 1, cellMarkSize);
  ctx.fillRect(~~xmax, ~~fontBaseline, cellMarkSize, 1);
  ctx.fillRect(~~xmax, ~~fontBaseline, 1, cellMarkSize);

  ctx.fillStyle = '#000000';
  glyph.draw(ctx, ~~x0, ~~fontBaseline, 16/*fontSize*/);
}

function displayGlyphPage(pageNum) {
  pageSelected = pageNum;
  document.getElementById('p'+pageNum).className = 'pressed';
  var firstGlyph = pageNum * cellCount;
  for(var i = 0; i < cellCount; i++) {
    renderGlyphItem(document.getElementById('g'+i), firstGlyph+i);
  }
}

function pageSelect(event) {
  document.getElementsByClassName('pressed')[0].className = '';
  displayGlyphPage(+event.target.id.substr(1));
}

function initGlyphDisplay() {
  var glyphBgCanvas = document.getElementById('glyph-bg'),
    w = glyphBgCanvas.width,
    h = glyphBgCanvas.height,
    glyphW = w - glyphMargin*2,
    glyphH = h - glyphMargin*2,
    head = font.tables.head,
    maxHeight = head.yMax - head.yMin,
    ctx = glyphBgCanvas.getContext('2d');

  glyphScale = Math.min(glyphW/(head.xMax - head.xMin), glyphH/maxHeight);
  glyphSize = glyphScale * font.unitsPerEm;
  glyphBaseline = glyphMargin + glyphH * head.yMax / maxHeight;

  function hline(text, yunits) {
    ypx = glyphBaseline - yunits * glyphScale;
    ctx.fillText(text, 2, ypx+3);
    ctx.fillRect(80, ~~ypx, w, 1);
  }

  ctx.clearRect(0, 0, w, h);
  ctx.fillStyle = '#999'
  hline('', 0);
  hline('yMax', font.tables.head.yMax);
  hline('yMin', font.tables.head.yMin);
  //hline('Ascender', font.tables.hhea.ascender);
  //hline('Descender', font.tables.hhea.descender);
  //hline('Typo Ascender', font.tables.os2.sTypoAscender);
  //hline('Typo Descender', font.tables.os2.sTypoDescender);
}

function onFontLoaded(font) {
  window.font = font;

  document.getElementById('font-name').innerHTML = font.familyName + ' (' + font.styleName + ')' ;

  var w = cellWidth - cellMarginLeftRight * 2,
    h = cellHeight - cellMarginTop - cellMarginBottom,
    head = font.tables.head,
    maxHeight = head.yMax - head.yMin;
  fontScale = Math.min(w/(head.xMax - head.xMin), h/maxHeight);
  fontSize = fontScale * font.unitsPerEm;
  fontBaseline = cellMarginTop + h * head.yMax / maxHeight;

  var pagination = document.getElementById("pagination");
  pagination.innerHTML = '';
  var fragment = document.createDocumentFragment();
  var numPages = Math.ceil(font.numGlyphs / cellCount);
  for(var i = 0; i < numPages; i++) {
    var link = document.createElement('button');
    var lastIndex = Math.min(font.numGlyphs-1, (i+1)*cellCount-1);
    link.textContent = i*cellCount + '-' + lastIndex;
    link.id = 'p' + i;
    link.addEventListener('click', pageSelect, false);
    fragment.appendChild(link);
    // A white space allows to break very long lines into multiple lines.
    // This is needed for fonts with thousands of glyphs.
    fragment.appendChild(document.createTextNode(' '));
  }
  pagination.appendChild(fragment);

  initGlyphDisplay();
  displayGlyphPage(0);
  displayGlyph(-1);
  displayGlyphData(-1);
}

function onReadFile(e) {
  document.getElementById('font-name').innerHTML = '';
  var file = e.target.files[0];
  var reader = new FileReader();
  reader.onload = function (e) {
    try {
      font = opentype.parse(e.target.result);
      showErrorMessage('');
      onFontLoaded(font);
    } catch (err) {
      showErrorMessage(err.toString());
      throw(err);
    }
  }
  reader.onerror = function (err) {
    showErrorMessage(err.toString());
  }

  reader.readAsArrayBuffer(file);
}

function cellSelect(event) {
  if (!font) return;
  var firstGlyphIndex = pageSelected*cellCount,
    cellIndex = +event.target.id.substr(1),
    glyphIndex = firstGlyphIndex + cellIndex;
  if (glyphIndex < font.numGlyphs) {
    displayGlyph(glyphIndex);
    displayGlyphData(glyphIndex);
  }
}

function prepareGlyphList() {
  var marker = document.getElementById('glyph-list-end'),
    parent = marker.parentElement;
  for(var i = 0; i < cellCount; i++) {
    var canvas = document.createElement('canvas');
    canvas.width = cellWidth;
    canvas.height = cellHeight;
    canvas.className = 'item';
    canvas.id = 'g'+i;
    canvas.addEventListener('click', cellSelect, false);
    parent.insertBefore(canvas, marker);
  }
}
prepareGlyphList();

//var fontPath = 'fonts/Roboto-Black.ttf';
//var fontPath = '/c/sys/fonts/tomo/Tomo.ttf';
//var fontPath = '/c/sys/fonts/t%21s-af10/ttf/MicroKnightPlus_v1.0.ttf';
//var fontPath = '/c/sys/fonts/t%21s-af10/ttf/mO%27sOul_v1.0.ttf';
//var fontPath = '/c/sys/fonts/px_sans_nouveaux/px_sans_nouveux.ttf';
//var fontPath = '/c/sys/fonts/C64_TrueType_v1.2-STYLE/C64_Pro_Mono-STYLE.ttf';

var fontPath = "";
if (window.parent && window.parent.$file) {

  window.parent.$file.open(fontPath, 'ArrayBuffer', function(buffer) {
    var font = opentype.parse(buffer);
    onFontLoaded(font);
  });

} else {
  fontPath = (fontPath.indexOf('/') == 0) ? fontPath : '/' + fontPath;
  opentype.load(fontPath, function (err, font) {
    var amount, glyph, ctx, x, y, fontSize;

    if (err) {
      parent.$alert(err.toString());
      return;
    }
    onFontLoaded(font);
  });
}
</script>
</body>
</html>
