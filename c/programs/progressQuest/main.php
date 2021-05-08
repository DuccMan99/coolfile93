<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Progress Quest</title>

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

<div class="hbox window" id="main">

  <main>

    <div class="vbox">

      <div class="hbox" id="Izquierda">

        <header class="label head bold" >Character Sheet</header>

        <main class="overflow skin_inset_deep skin_light">
          <table id="Trats">
            <thead>
              <tr>
                <th class="skin_outset">Trait</th>
                <th class="skin_outset">Value</th>
              </tr>
            </thead>
            <tbody id="Traits">
              <tr>
                <td>Name</td>
                <td></td>
              </tr>
              <tr>
                <td>Race</td>
                <td></td>
              </tr>
              <tr>
                <td>Class</td>
                <td></td>
              </tr>
              <tr>
                <td>Level</td>
                <td>1</td>
              </tr>
            </tbody>

            <thead class="mid">
              <tr>
                <th class="skin_outset">Stat</th>
                <th class="skin_outset">Value</th>
              </tr>
            </thead>
            <tbody id="Stats">
              <tr><td>STR</td><td></td></tr>
              <tr><td>CON</td><td></td></tr>
              <tr><td>DEX</td><td></td></tr>
              <tr><td>INT</td><td></td></tr>
              <tr><td>WIS</td><td></td></tr>
              <tr><td>CHA</td><td></td></tr>
              <tr><td>HP Max</td><td></td></tr>
              <tr><td>MP Max</td><td></td></tr>
            </tbody>
          </table>
        </main>

        <footer>
          <div class="label">Experience</div>

          <div class="skin_inset ui_progress" id="ExpBar">
            <div class="ui_progress__hint"></div>
            <div class="ui_progress__bar"></div>
          </div>
        </footer>

        <header class="label head bold" >Spell Book</header>
        <main id="Spells" class="scroll skin_inset_deep skin_light">
          <table>
            <thead>
              <tr>
                <th class="skin_outset key">Spell</th>
                <th class="skin_outset value">Level</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </main>
      </div>

      <div class="hbox" id="Centro">
        <header class="label head bold">Equipment</header>

        <main class="skin_inset_deep skin_light">
          <table id="Equips">
            <tbody>
              <tr><td>Weapon</td><td></td></tr>
              <tr><td>Shield</td><td></td></tr>
              <tr><td>Helm</td><td></td></tr>
              <tr><td>Hauberk</td><td></td></tr>
              <tr><td>Brassairts</td><td></td></tr>
              <tr><td>Vambraces</td><td></td></tr>
              <tr><td>Gauntlets</td><td></td></tr>
              <tr><td>Gambeson</td><td></td></tr>
              <tr><td>Cuisses</td><td></td></tr>
              <tr><td>Greaves</td><td></td></tr>
              <tr><td>Sollerets</td><td></td></tr>
            </tbody>
          </table>
        </main>

        <header class="label head bold" >Inventory</header>
        <main id="Inventory" class="scroll listbox skin_inset_deep skin_light">
          <table>
            <thead>
              <tr>
                <th class="skin_outset key">Item</th>
                <th class="skin_outset value">Qty</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </main>

        <div class="label">Encumbrance</div>
        <div class="skin_inset ui_progress" id="EncumBar">
          <div class="ui_progress__hint"></div>
          <div class="ui_progress__bar"></div>
        </div>
      </div>


      <div class="hbox" id="Derecha">

        <header class="label head bold">Plot Development</header>
        <main id="Plots" class="scroll listbox skin_inset_deep skin_light">
          <table>
            <tbody>
            </tbody>
          </table>
        </main>

        <div class="skin_inset ui_progress" id="PlotBar">
          <div class="ui_progress__hint"></div>
          <div class="ui_progress__bar"></div>
        </div>

        <header class="label head bold">Quests</header>
        <main id="Quests" class="scroll listbox skin_inset_deep skin_light">
          <table>
            <tbody>
            </tbody>
          </table>
        </main>

        <div class="skin_inset ui_progress" id="QuestBar">
          <div class="ui_progress__hint"></div>
          <div class="ui_progress__bar"></div>
        </div>
      </div>

    </div>

  </main>

  <footer id="footer">
    <div id="Kill" class="label"></div>

    <div class="skin_inset ui_progress" id="TaskBar">
      <div class="ui_progress__hint"></div>
      <div class="ui_progress__bar"></div>
    </div>
  </footer>

</div>

<div id="paused"><br>PAUSED</div>

<script src="/c/libs/jquery.min.js"></script>
<script src="./js/config.js?v=2.4.2"></script>
<script src="./js/main.js?v=2.4.2"></script>


</body>
</html>
