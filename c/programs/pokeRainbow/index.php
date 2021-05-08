<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokéRainbow</title>
    <link rel="stylesheet" href="/c/sys42.css">
    <link rel="stylesheet" href="/c/sys/skins/w93.css">
    <style>
      html{
        /*background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAIAAADZF8uwAAAAGUlEQVQYV2M4gwH+YwCGIasIUwhT25BVBADtzYNYrHvv4gAAAABJRU5ErkJggg==);
        */
        background: silver;
         pointer-events:none;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      iframe{
          height: 50%;
          width: 50%;
          position: absolute;
          border: none;
          pointer-events: none;
          display: none;
           pointer-events:none;
          -webkit-touch-callout: none;
          -webkit-user-select: none;
          -khtml-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;  
      }
      #i0{
          left: 0;
          top: 0;
      }       
      #i1{
          right: 0;
          top: 0;           
      }      
      #i2{
          left: 0;
          bottom: 0;             
      }       
      #i3{
          right: 0;
          bottom: 0; 
      }
      #settings {
          position: absolute;
          top: 0;
          color: white;
          right: 0;
          display: none;

      }
      #speed{
        width: 15px;
      }
      span.button{
        display: none;
        color: white;
        background-color: gray;
        padding: 5px;
        margin: 0px;
      }
      span.button.pressed{
        background-color: black;
        color:red;
      }
      span.arrow{
        display: none;
        color: white;
        background-color: gray;
        padding: 5px;
        margin: 0px;
      }
      span.arrow.pressed{
        background-color: black;
        color:red;
      }
      div.buttons, div.axes{
        display: inline;
      }
      .gamepadName{
        color:deeppink;
        padding-bottom: 10px;
      }
      .divpad{
        margin-bottom: 8px;
      }
      #divpads{
        display: none;
        position: absolute;
        top: 0px;
        left: 0px;
        margin:0px;
        padding-left: 10px;
        padding-top: 4px;
      }
      #info{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }
    </style>

</head>
<body>
<script>


    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }
    var parentWindow="";
    if (getUrlVars()["id"]!=undefined) {
      parentWindow=getUrlVars()["id"];
    };

    function GameBoyKeyUp(key){
        for (var i = 0; i < 4; i++) {
           document.getElementById('i'+i).contentWindow.GameBoyKeyUp(key)
        };
    }
    function GameBoyKeyDown(key){
        for (var i = 0; i < 4; i++) {
           document.getElementById('i'+i).contentWindow.GameBoyKeyDown(key)
        };
    }

    var gameKeys = {
        ArrowUp:'up',
        ArrowDown:'down',
        ArrowLeft:'left',
        ArrowRight:'right',
        x:'a',
        c:'b',
        Enter:'start',
        Shift:'select',
    }

    var gameKeysPressed = {
        ArrowUp:false,
        ArrowDown:false,
        ArrowLeft:false,
        ArrowRight:false,
        x:false,
        c:false,
        Enter:false,
        Shift:false,
    }

    document.addEventListener('keyup', (event) => {
        if(gameKeysPressed[event.key]==undefined){return}
        if (gameKeysPressed[event.key]==false) {
          GameBoyKeyUp(gameKeys[event.key])
          gameKeysPressed[event.key]=true
        };
    }, false);

    document.addEventListener('keydown', (event) => {
      if(gameKeysPressed[event.key]==undefined){return}
      if (gameKeysPressed[event.key]==true) {
          GameBoyKeyDown(gameKeys[event.key])
          gameKeysPressed[event.key]=false
        }
    }, false);

    function gamePadAction(gamepad, button, toggle){
      x=['b','a','select','start']
      for (var i = 0; i < 4; i++) {
          if (parseInt(button)==i) {
            button=x[i]
          };
      };
      if (toggle=='1') {
        GameBoyKeyDown(button);
      }else{
        GameBoyKeyUp(button);
      }
    }
  
    function setSpeed(x){
      if (x!=undefined) {
        for (var i = 0; i < 4; i++) {
          //gameboy.setSpeed(Math.max(parseFloat(speed), 0.001));
          document.getElementById('i'+i).contentWindow.gameboy.setSpeed(Math.max(parseFloat(x), 0.001));
          if($('#toggle')[0].checked){document.getElementById('i'+i).contentWindow.gameboy.audioHandle.changeVolume(1)}
          
        }
      }else{
        var speed = pdatapt("Set the emulator speed here:", "1.0");
        if (speed != null && speed.length > 0) {
          for (var i = 0; i < 4; i++) {
            //gameboy.setSpeed(Math.max(parseFloat(speed), 0.001));
            document.getElementById('i'+i).contentWindow.gameboy.setSpeed(Math.max(parseFloat(speed), 0.001));
            if($('#toggle')[0].checked){document.getElementById('i'+i).contentWindow.gameboy.audioHandle.changeVolume(1)}
          }
        }
      }
    }

    function setSound(x){
        for (var i = 0; i < 4; i++) {
            document.getElementById('i'+i).contentWindow.gameboy.audioHandle.changeVolume(x);
        };
    }

    function toggleSound() {
      var checkBox = document.getElementById("toggle");
      if (checkBox.checked == true){
        setSound(1)
      } else {
        setSound(0)
      }
    } 

    var hidesettings;
    function hideSettingsDiv() {
        //$('#settings').fadeOut()
    }
    function hideTimer() {
      /*
      $('#settings').fadeIn()
      clearTimeout(hidesettings);
      hidesettings = setTimeout(hideSettingsDiv, 3000);
      */
    }

    iframeLoad = 0

    function getQueryVariable(variable)
    {
           var query = window.location.search.substring(1);
           var vars = query.split("&");
           for (var i=0;i<vars.length;i++) {
                   var pair = vars[i].split("=");
                   if(pair[0] == variable){return pair[1];}
           }
           return(false);
    }

    function iframeLoaded(){
      iframeLoad = iframeLoad + 1;
      if (iframeLoad==$('iframe').length){
        $('#info').hide()
        document.getElementById('i0').contentWindow.document.getElementById('mainCanvas').style.right='0'
        document.getElementById('i1').contentWindow.document.getElementById('mainCanvas').style.left='0'
        document.getElementById('i2').contentWindow.document.getElementById('mainCanvas').style.right='0'
        document.getElementById('i3').contentWindow.document.getElementById('mainCanvas').style.left='0'     
        $('iframe').show() 
        $('html').css('background-color','#444');
        // music
        if (getQueryVariable('preset')==4) {
          setSound(1);
        };

         $( "html" ).mousemove(function( event ) {
           hideTimer();
        });
      }
    }
    document.addEventListener("DOMContentLoaded", function(event) {
      if (parentWindow!="") {
        parent.$window.active(parentWindow);
        parent.$window.current.cfg.menu[0].items[4].items[0].name="❌ Not detected"          
      };
    });
    
</script>

<iframe src="child.html?data=" id="i0" class="gb"></iframe>
<iframe src="child.html?data=" id="i1" class="gb"></iframe>
<iframe src="child.html?data=" id="i2" class="gb"></iframe>
<iframe src="child.html?data=" id="i3" class="gb"></iframe>

<script type="text/javascript" src="/c/libs/jquery.min.js"></script>
<script type="text/javascript" src="js/gamepads.js"></script>
   <div id="info">Please wait...</div>
   <div id="settings" style="text-align:right;">
   <b>Settings</b>
    <div>sound<input type="checkbox" id="toggle" onclick="toggleSound()"></div>
    <div>speed <input type="text" id="speed" name="speed" value="1.0" onChange="setSpeed(parseFloat($('#speed').val()));$('html').focus();"></div>
    <div id='joypad'>joypad ❌</div>    
   </div>
</body>
</html>