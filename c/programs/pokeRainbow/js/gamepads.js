/*
gamepad utility by jankenpopp
*/

/*
function gamePadAction(gamepad, button, toggle){
  console.log('player'+gamepad+': '+button+' '+toggle)
}
*/

function gamepadChecker(index){

  gamepad = navigator.getGamepads()[index];
   
  for (var i = 0; i < gamepad.buttons.length; i++) {
    if(gamepad.buttons[i].value!=gamepadsHistory[index].buttons[i]){     
        el=$('#gamepad'+index+' span.button:nth-child('+(i+1)+')')
        el.css("display","initial")
        if (gamepad.buttons[i].value==1) {el.addClass('pressed')};
        if (gamepad.buttons[i].value==1) {el.addClass('active')};
        if (gamepad.buttons[i].value==0) {el.removeClass('pressed')};
        gamePadAction(index,el[0].innerText,gamepad.buttons[i].value)  
    }
    gamepadsHistory[index].buttons[i]=gamepad.buttons[i].value;
  }

  $('#gamepad'+gamepad.index+' span.button.active').each(function( index ) {
     $( this ).text(index);
  });

  for (var i = 0; i < gamepad.axes.length; i++) {
    if(Math.round(gamepad.axes[i])!=gamepadsHistory[index].axes[i]){
        if(Math.round(gamepad.axes[i])==-1){
          el=$('#gamepad'+index+' span.arrow:nth-child('+(i*2+1)+')')
          el.addClass('pressed')
          el.addClass('active')
          el.css("display","initial")
          gamePadAction(index,el[0].innerText,1)  
        }
        if( (Math.round(gamepad.axes[i])!=1) && (Math.round(gamepad.axes[i])!=-1) ){
          $('#gamepad'+index+' span.arrow:nth-child('+(i*2+1)+')').removeClass('pressed')
          gamePadAction(index,$('#gamepad'+index+' span.arrow:nth-child('+(i*2+1)+')')[0].innerText,0)  
          $('#gamepad'+index+' span.arrow:nth-child('+(i*2+2)+')').removeClass('pressed')
          gamePadAction(index,$('#gamepad'+index+' span.arrow:nth-child('+(i*2+2)+')')[0].innerText,0)  
        }
        if(Math.round(gamepad.axes[i])==1){
           el=$('#gamepad'+index+' span.arrow:nth-child('+(i*2+2)+')')
           el.addClass('pressed')
           el.addClass('active')
           el.css("display","initial")
           gamePadAction(index,el[0].innerText,1)  
        }
    }
    gamepadsHistory[index].axes[i]=Math.round(gamepad.axes[i])
  }
  arrChars=['left','right','up','down'];
  $('#gamepad'+gamepad.index+' span.arrow.active').each(function( index ) {
     $( this ).text(arrChars[index%4]);
  });
}

function gamepadLoop() {
  for (var i = 0; i < Object.keys(gamepads).length; i++) {
    if (navigator.getGamepads()[i]!=null) {gamepadChecker(i)}
    
  };
}

var gamepadLoopInterval;
gamepadLoopInterval = setInterval(gamepadLoop, 4);
var gamepads = {};
var gamepadsHistory = {};

function addGamepad(gamepad){

  $('#joypad').html('joypad ✅')

  if (parentWindow!="") {
    parent.$window.active(parentWindow);
    parent.$window.current.cfg.menu[0].items[3].items[0].name="✅ Detected"      
  };

  var d = document.createElement("div");
  d.setAttribute("id", "gamepad" + gamepad.index);
  d.className = "divpad";
  var t = document.createElement("div");
  t.className = "gamepadName";
  t.appendChild(document.createTextNode("" + gamepad.id));
  d.appendChild(t);
  var a = document.createElement("div");
  a.className = "axes";
  for (i=0; i<gamepad.axes.length; i++) {
    e = document.createElement("span");
    e.className = "arrow";
    e.innerHTML = '-';
    a.appendChild(e); 
    e = document.createElement("span");
    e.className = "arrow";
    e.innerHTML = '-';
    a.appendChild(e);    
  }
  d.appendChild(a);
  var b = document.createElement("div");
  b.className = "buttons";
  for (var i=0; i<gamepad.buttons.length; i++) {
    var e = document.createElement("span");
    e.className = "button";
    e.innerHTML = i;
    b.appendChild(e);
  }
  d.appendChild(b);
  document.getElementById("divpads").appendChild(d);
}

function gamepadHandler(event, connecting) {


  if (document.getElementById("divpads")==null) {
    d = document.createElement("div");
    d.setAttribute("id", "divpads");
    document.body.appendChild(d);
  };

  var gamepad = event.gamepad;
  // gamepad === navigator.getGamepads()[gamepad.index]
  if (connecting) {
    gamepads[gamepad.index] = gamepad;
    //console.log('connect '+gamepad.index+': '+gamepad.id)
    addGamepad(gamepad)
    gamepadsHistory[gamepad.index] = {}
    gamepadsHistory[gamepad.index].buttons=[]
    for (var i = 0; i < gamepad.buttons.length; i++) {
      gamepadsHistory[gamepad.index].buttons[i]=gamepad.buttons[i].value;
    }
    gamepadsHistory[gamepad.index].axes=[]
    for (var i = 0; i < gamepad.axes.length; i++) {
      gamepadsHistory[gamepad.index].axes[i]=Math.round(gamepad.axes[i])
    }
  } else {
 

    $( '#gamepad'+gamepad.index ).remove();


    setTimeout(function(){ 
      if (navigator.getGamepads().length==0) {
        $('#joypad').html('joypad ❌')
          if (parentWindow!="") {
            parent.$window.active(parentWindow);
            parent.$window.current.cfg.menu[0].items[3].items[0].name="❌ Not detected"      
          };
      }; 
    }, 1000);
    

    //gamepadsHistory[gamepad.index]={};
    //delete gamepads[gamepad.index];
    //console.log('disconnect '+gamepad.index+': '+gamepad.id)
  }
}

window.addEventListener("gamepadconnected", function(e) { gamepadHandler(e, true); }, false);
window.addEventListener("gamepaddisconnected", function(e) { gamepadHandler(e, false); }, false);