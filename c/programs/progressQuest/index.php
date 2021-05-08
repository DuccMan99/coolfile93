<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Progress Quest - Roster</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
<link rel="stylesheet" href="./style.css?v=2.4.2">

<body class="skin_base noscroll">
<hr>

<div class="hbox ma5 mt10">
<!--   <header class="pt0">
    <img src="./pq.png" alt="Progress Quest">
    <strong> Character Roster</strong>
  </header> -->

  <main id="roster" class="skin_inset overflow"></main>

  <footer class="pa10 txtcenter">
    <button id="roll">New Character</button>
    <br>
    <br>
    <div class="sig">&copy;2001-2017
      <a class="dim" href="mailto:grumdrig@progressquest.com">grumdrig@progressquest.com</a>
      <br>
      <a class="dim" target="_blank" href="http://progressquest.com/">http://progressquest.com</a>
    </div>
  </footer>
</div>

<script id="badge" type="text/html">
  <div class="ui_group">
    <div class="brag skin_outset flex1 go">
      <img class="left" src="./progressquest.gif" alt="">
      <b>$Traits.Name</b> the $Traits.Race ($bestplot)
      <div class="rc">Level $Traits.Level $Traits.Class</div>
      <div class="bs">$bestequip / $bestspell / $beststat</div>
    </div>
    <div class="brag skin_outset flex0 delete">
      <div class="delete_btn">&#x2620;</div>
    </div>
  </div>
</script>


<script type="text/charsheet" id="sheet">
$Traits.Name the $Traits.Race [$hostname]
"$motto"

Level $Traits.Level $Traits.Class (exp. $ExpBar.position/$ExpBar.max)

Plot stage: $bestplot ($PlotBar.hint)
Quest: $bestquest ($QuestBar.hint)

Stats:
   STR $Stats.STR
   CON $Stats.CON
   DEX $Stats.DEX
   INT $Stats.INT
   WIS $Stats.WIS   HP Max $Stats.HP_Max
   CHA $Stats.CHA   MP Max $Stats.MP_Max

Equipment:
$Equips.___
Spell Book:
$Spells.___
Inventory ($EncumBar.hint):
$Inventory.___
-- $date
-- Progress Quest 6.3.web - http://progressquest.com/
</script>

<script src="/c/libs/jquery.min.js"></script>
<script src="./js/config.js?v=2.4.2"></script>
<script src="./js/roster.js?v=2.4.2"></script>

</body>
</html>
