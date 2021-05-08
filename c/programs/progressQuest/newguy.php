<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Progress Quest - Roll One Up</title>

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

<div class="hbox window " id="newguy">

  <header class="ui_toolbar pt10">
    Name
    <input id="Name" spellcheck="false">
    <button id="RandomName">?</button>
    <br>
    <br>
  </header>

  <main>
    <div class="vbox">
      <main>
        <fieldset class="groupbox" id="races">
          <legend>Race</legend>
        </fieldset>
      </main>

      <main>
        <fieldset class="groupbox" id="classes">
          <legend>Class</legend>
        </fieldset>
      </main>

      <main>
        <fieldset class="groupbox" id="stats">
          <legend>Stats</legend>

          <table>
            <tr> <th> STR <td class="td_num" id="STR">13</tr>
            <tr> <th> CON <td class="td_num" id="CON">23</tr>
            <tr> <th> DEX <td class="td_num" id="DEX">34</tr>
            <tr> <th> INT <td class="td_num" id="INT">12</tr>
            <tr> <th> WIS <td class="td_num" id="WIS">4</tr>
            <tr> <th> CHA <td class="td_num" id="CHA">12</tr>
            <tr> <th colspan=2> &nbsp; </tr>
            <tr> <th> Total <td class="td_num skin_inset" id="Total">48</tr>
          </table>

          <br>
          <br>
          <br>
          <br>
          <br>
          <br>

          <div class="txtcenter">
            <button id="Reroll">Roll</button>
            <button id="Unroll" disabled>Unroll</button>
          </div>

        </fieldset>
      </main>

    </div>

  </main>
  <footer id="footer" style="text-align:right;padding-top:15px">
    <button id="Sold">Sold!</button>
  </footer>
</div>

<script src="/c/libs/jquery.min.js"></script>
<script src="./js/config.js?v=2.4.2"></script>
<script src="./js/newguy.js?v=2.4.2"></script>

</body>
</html>
