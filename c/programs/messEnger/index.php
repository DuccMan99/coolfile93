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
<style>.user{color:#666;}
#output {word-break: break-word; word-wrap: break-word;}
#output iframe{width: 100%; height: 200px;}
</style>
<body class="skin_base noscroll">
<form name="e_form" onsubmit="elizaStep();return false">
  <div class="ui_layout">
    <header>
      <img src="./img/status_online.png" alt=""> MikroWavePopeCornAzz Nigazz!!
      <div class="right skin_inset inline-block"><img style="vertical-align: top;" width="77" height="77" src="./img/avatar_francis_big.png" alt=""></div>
    </header>
    <section id="output" class="mt2 pa5 skin_inset_deep skin_light">
      <!-- <textarea readonly="readonly" name="e_display" class="skin_light fillspace" style="background:#fff" cols="40" rows="3"></textarea> -->
    </section>
    <footer class="mt2">
      <div class="flex">
      <textarea name="e_input" class="w100 flex__fluid" cols="80" rows="3"></textarea><img onclick="elizaStep()" style="cursor:pointer;width:77px" class="skin_outset" src="./img/avatar_duck.png" alt="">
      </div>
    </footer>
  </div>
</form>
<script src="./bot.js"></script>
<script src="./data.js"></script>

<script src="/c/sys42.js?v=2.4.2"></script>

<script>
  var eliza = new ElizaBot();
  function elizaReset() {
    eliza.reset();
  }

  $el(document.body).on('click', 'a', function(e) {
    e.preventDefault();
    parent.$exe.call(null, 'catex ' + this.href);
  })

  var f = document.forms.e_form;
  var output = document.getElementById('output');

  f.onkeydown = function(e) {
    e = e || window.event;
    if (typeof e.which !== 'number') e.which = e.keyCode; // http://stackoverflow.com/a/4285801
    if (e.which === 13) {e.preventDefault(); elizaStep(); return false}
  }
  function elizaStep() {
    var userinput = f.e_input.value;
    // if (eliza.quit) {
    //   f.e_input.value = '';
    //   if (confirm("This session is over.\nStart over?")) elizaReset();
    //   f.e_input.focus();
    //   return;
    // }
    //else
    if (userinput != '') {
      var usr = document.createElement('div');
      var rpl = document.createElement('div');
      usr.innerHTML = '<strong>you:</strong>   ' + $io.str.autolink(userinput);
      var rrepl = eliza.transform(userinput);
      rpl.innerHTML ='<strong>francis:</strong> ' + (rrepl.indexOf('<iframe')>-1 ? rrepl : $io.str.autolink(rrepl));

      output.appendChild(usr);
      output.scrollTop = output.scrollHeight;

      setTimeout(function() {
        output.appendChild(rpl);
        output.scrollTop = output.scrollHeight;
      }, rpl.length * 3);
    }
    f.e_input.value = '';
    f.e_input.focus();
  }

  setTimeout(elizaReset, 100);
</script>
</body>
</html>