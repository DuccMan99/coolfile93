

var
  canvas = document.getElementById('canvas'),
  ctx = canvas.getContext('2d')
;

(function() {
  // resize the canvas to fill browser window dynamically
  window.addEventListener('resize', resizeCanvas, false);

  function resizeCanvas() {
    width = window.innerWidth;
    height = window.innerHeight;
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    yPositions = [];
    for (var i = 0, l = 300; i < l; i++) {
      yPositions.push(-Math.round(Math.random() * l))
    }
  }
  resizeCanvas();
})();


function getRandom(a) {
  return a[Math.floor(Math.random()*a.length)]
}
function chance (p) { return (Math.random() * 100 >= (p || 50)) ? false : true }

var charcod = ['0','1','2','3','4','5','6','7','8','9','Ɛ','ᔭ','Ɫ'];
var width = window.innerWidth;
var height = window.innerHeight;
var yPositions = [];

for (var i = 0, l = 300; i < l; i++) {
  yPositions.push(-Math.round(Math.random() * l))
}

ctx.font = '10pt monospace';
ctx.shadowOffsetX = 0;
ctx.shadowOffsetY = 0;
ctx.shadowBlur = 15;
function draw() {
  ctx.fillStyle='rgba(0,0,0,.06)';
  ctx.shadowColor = 'rgba(0,0,0,1)';
  ctx.fillRect(0,0,width,height);

  yPositions.map(function(y, index){
    text = chance(30) ? getRandom(charcod) : String.fromCharCode(1e2+Math.random()*50 + 12352);
    x = (index * 12)+10;
    ctx.fillStyle='#c3ff00';
    ctx.shadowColor = 'rgba(70,255,0,0.8)';
    ctx.fillText(text, x, y);
    ctx.fillStyle='rgba(234,255,165,'+Math.random()*0.8+')';
    ctx.fillText(text, x, y);
    if(y > 100 + Math.random()*1e4) {
      yPositions[index]=0;
    }
    else {
      yPositions[index] = y + 12;
    }
  });
};

RunMatrix();
function RunMatrix(){
  if(typeof Game_Interval != "undefined") clearInterval(Game_Interval);
  Game_Interval = setInterval(draw, 60);
}
function StopMatrix() {
  clearInterval(Game_Interval);
}