<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Defrag</title>

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
<style type="text/css" media="screen">
  html {
    overflow: hidden;
  }
  body {
    margin: 0px;
    padding: 0px;
    position: absolute;
    display: block;
    top: 1px;
    left: 1px;
    overflow: hidden;
  }
  div#stuff {
    padding-left: 20px;
  }
  div#boutons {
    position: absolute;
    left: 530px;
    top: 433px;
  }
  canvas {
    vertical-align: top;
  }
  .ui_progress {
    margin-top: 10px;
  }
</style>
  <div class="skin_inset">

  <canvas id="canvas" width="640" height="400"></canvas>
  </div>

  <div id="stuff">
    <p id="infos">Welcome to Defrag !</p>
    <div class="skin_inset ui_progress"  style="width:490px">
      <div class="ui_progress__hint"></div>
      <div class="ui_progress__bar"></div>
    </div>
    <p id="pourcentage">Click 'Start' & use 'Arrows' to mess with the amount of fragmentation in your file system.</p>

    <div id="boutons">
      <button type="button" id="start">
        Start
      </button>
      <button type="button" id="pause">
        Pause
      </button>
    </div>

  </div>

  <script src="/c/sys42.js?v=2.4.2"></script>

  <script src="/c/libs/jquery.min.js" type="text/javascript"></script>
  <script>

	  /*
	    DEFRAG - a jquery snake, by @jankenpopp
	    © 2014 WTFPL – Do What the Fuck You Want to Public License.
	  */

    var imageSnake = new Image();
    imageSnake.src = 'snake.gif';
    var imageEmpty = new Image();
    imageEmpty.src = 'empty.gif';
    var imageFull = new Image();
    imageFull.src = 'full.gif';

    $(document).ready(function() {

      var playPause = 0;
      var nokiaTune = new Howl({
        urls: ['3310.ogg'],
        loop: true,
        volume: 0.3
      });

      $('#start, #pause').click(function() {
        if (this.id == 'start') {
          playPause = 1;
          $("p#infos").text("Defragmenting file system...");
          nokiaTune.play();
        }
        else if (this.id == 'pause') {
          playPause = 0;
          $("p#infos").text("Defragmention paused... click 'Start' to continue the process.");
          nokiaTune.pause();
        }
      });

      var bar = $(".ui_progress__bar")[0];

      var canvas = $("#canvas")[0];
      var ctx = canvas.getContext("2d");
      var w = $("#canvas").width();
      var h = $("#canvas").height();

      var cw = 8;
      var ch = 10;
      var d;
      var food;
      var score;

      var pourcent = 0;
      var lastSteps = [];
      for (var i = 40 - 1; i >= 0; i--) {
        lastSteps[i] = [];
      };

      var snake_array;

      function init() {

        for (var x = 80 - 1; x >= 0; x--) {
          for (var y = 40 - 1; y >= 0; y--) {
            lastSteps[y][x] = 1;
            ctx.drawImage(imageFull, x * cw, y * ch);
          };
        };
        lastSteps[0][0] = 0;
        pourcent = 1;
        bar.width = bar.width;

        d = "right";
        create_snake();
        create_food();
        score = 0;

        if (typeof game_loop != "undefined") clearInterval(game_loop);
        game_loop = setInterval(paint, 60);
      }
      init();

      function create_snake() {
        var length = 5;
        snake_array = [];
        for (var i = length - 1; i >= 0; i--) {
          snake_array.push({
            x: i,
            y: 0
          });
        }
      }

      function create_food() {
        food = {
          x: Math.round(Math.random() * (w - cw) / cw),
          y: Math.round(Math.random() * (h - ch) / ch),
        };
      }

      function paint() {

        if (playPause == 1) {

          if (pourcent == 3200) {

            parent.$alert({
              msg: "Congratulations ! <br>Your score is " + score + ".<br><br>Password is FUTUR1993",
              title: 'King of the day',
              img: 'c/sys/ico/trophy.gif'
            });

            playPause = 0;
          };

          for (var x = 80 - 1; x >= 0; x--) {
            for (var y = 40 - 1; y >= 0; y--) {

              if (lastSteps[y][x] == 0) {
                ctx.drawImage(imageEmpty, x * cw, y * ch);
              }
              else {
                ctx.drawImage(imageFull, x * cw, y * ch);
              }

            };
          };

          var nx = snake_array[0].x;
          var ny = snake_array[0].y;

          if (d == "right") nx++;
          else if (d == "left") nx--;
          else if (d == "up") ny--;
          else if (d == "down") ny++;

          if (nx == -1 || nx == w / cw || ny == -1 || ny == h / ch || check_collision(nx, ny, snake_array)) {
            init();
            return;
          }

          if (nx == food.x && ny == food.y) {
            var tail = {
              x: nx,
              y: ny
            };
            score++;
            create_food();
          }
          else {
            var tail = snake_array.pop();
            tail.x = nx;
            tail.y = ny;
          }

          snake_array.unshift(tail);

          for (var i = 0; i < snake_array.length; i++) {
            var c = snake_array[i];
            paint_cell(c.x, c.y);
          }

          paint_cell(food.x, food.y);
        };
      }

      function paint_cell(x, y) {

        ctx.drawImage(imageSnake, x * cw, y * ch);

        if (lastSteps[y][x] == 1) {

          pourcent++;
          lastSteps[y][x] = 0;

          var value = Math.round((pourcent / 3200) * 100);
          var perc = value + "%";
          $("p#pourcentage").text(perc);
          bar.style.width = perc;
        };

      }

      function check_collision(x, y, array) {
        for (var i = 0; i < array.length; i++) {
          if (array[i].x == x && array[i].y == y)
            return true;
        }
        return false;
      }

      $(document).keydown(function(e) {
        var key = e.which;
        if (key == "37" && d != "right") d = "left";
        else if (key == "38" && d != "down") d = "up";
        else if (key == "39" && d != "left") d = "right";
        else if (key == "40" && d != "up") d = "down";
      })

    })
  </script>


</body>

</html>
