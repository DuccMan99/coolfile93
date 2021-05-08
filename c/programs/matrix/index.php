<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Fishburne</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
<link rel="stylesheet" href="/c/sys/fonts/Fishburne/styles.css">
<style>
html,
body {
  overflow: hidden;
  background-color: #000;
  cursor: pointer;
}
div {
  position: absolute;
  top: 0px;
  left: -5px;
}
#fishburne {
  background-image: url('img/fishburne.png');
  background-repeat: no-repeat;
  background-size: contain;
  background-position: center center;
}
h1,
h2 {
  color: #fff;
  font-family: Impact, Fishburne, Haettenschweiler, 'Franklin Gothic Bold', Charcoal, 'Helvetica Inserat', 'Bitstream Vera Sans Bold', 'Arial Black', 'sans serif';
  -webkit-text-stroke: 1px black;
  text-stroke: 1px black;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
  text-align: center;
}
h1 {
  position: absolute;
  margin: auto;
  left: 1%;
  right: 1%;
  top: 4%;
  font-size: 15vh;
}
h2 {
  position: absolute;
  margin: auto;
  left: 1%;
  right: 1%;
  bottom: 8%;
  font-size: 7vh;
}


</style>

<body>

	<div class="fillspace">
	<canvas id="canvas">Sorry Browser don't support canvas</canvas><br><br>
	</div>
  <div class="fillspace" id="meme"></div>

<script src="matrix.js"></script>
<script>

  var meme = document.getElementById('meme');
  var html = '<div id="fishburne" class="fillspace animated flip"></div><h1 id="what" class="animated bounceInRight">WHAT IF I TOLD YOU</h1><h2 id="quote" class="animated bounceInLeft">';
  var myQuote = -1;
  var quoteList = [
     "YOU CAN EAT WITHOUT POSTING IT ON INSTAGRAM"
    ,"YOU'VE LOST EVERY GAME OF TETRIS YOU PLAYED"
    ,"YOU DON'T NEED TO TYPE WWW"
    ,"THE REASON YOU THINK ALL MEMES ARE OVER USED IS BECAUSE YOU SPEND TOO MUCH TIME ON YOUR COMPUTER"
    ,"THAT SOYLENT GREEN IS MADE UP OF PEOPLE"
    ,"MY GLASSES AREN'T HELD UP BY MY EARS"
    ,"I'M BRAIN FUCKED SPINING ALL THE TIME"
    ,"I DON'T GET A SINGLE FUCK OF THE LETTERS BEHIND ME"
    ,"I DO COLLECT LASERDISCS"
    ,"CHUCK NORRIS IS A GINGER"
    ,"CATS HAVE THEIR OWN INTERNET<BR>FULL OF PICTURES OF US"
    ,"I TAKE MY SELFIES WITH AN INVISIBLE CAMERA"
    ,"WINNERS DON'T USE DRUGS"
    ,"I DON'T HAVE FACEBOOK"
    ,"THAT I NEVER SAY 'WHAT IF I TOLD YOU' IN ANY OF THE MATRIX MOVIES"
    ,"THAT I'VE RUN OUT OF THINGS TO TELL YOU"
    ,"YOU CAN DO YOUR THINGS WITHOUT POSTING IT ON FACEBOOK"
    ,"THE BLUE PILL WILL GIVE YOU AN ERECTION LASTING UP TO FOUR HOURS?"
    ,"THAT THIS MEME SHOULD END IN A QUESTION MARK AND EVERYONE FORGOT?"
    ,"THAT YOU CAN PLAY YOUR FACEBOOK GAMES WITHOUT INVITING ME"
    ,"THAT STUPID PEOPLE EXIST BECAUSE NOTHING IN THE FOOD CHAIN EATS THEM ANYMORE"
    ,"YOU DON'T GET A PRIZE FOR BEING THE 1000TH VISITOR"
    ,"NOTHING"
    ,"POTATOE"
    ,"WHAT IF I TOLD YOU"
    ,"THAT YOU'RE READING THIS IN MY VOICE"
    ,"YOU DON'T HAVE TO EAT A WHOLE BAG OF CHIPS IN ONE SITTING"
    ,"WINDOWS 93 IS A COMMERCIAL FOR A MOVIE THAT DOESN'T EXIST"
  ];

  function random(arr) {
    return arr[Math.floor(Math.random() * arr.length)];
  }

  function whatIf(){
    myOldQuote = myQuote;
    while (myQuote == myOldQuote){
      myQuote = random(quoteList);
    }
    meme.innerHTML = html + myQuote + '</h2>';
  };

  setTimeout(function() {
    whatIf();
  }, 1200);

  document.body.onclick = whatIf;
  document.body.oncontextmenu = function(e) {
    e.preventDefault();
    meme.innerHTML = '';
  };

</script>



</body></html>
