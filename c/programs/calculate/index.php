<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>calc</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
<meta name="author" content="TimothyArmstrong">
<link rel="stylesheet" href="css.css" type="text/css" />
<body class="skin_base">
  <div id="calculator" class="ui_layout">
    <header id="screen" class="skin_inset_deep">
      <div id="top">

      </div>
      <div id="bottom">
        0.
      </div>
    </header>

    <section id="buttons" class="mt5">
      <div class="hbox">

        <main>
          <div class="vbox">

            <section class="block" id="functions">
              <div class="ui_combo commands">
                <button class="command" data-command="degrad"><span id="deg" class="inactive">Deg</span> | <span id="rad">Rad</span></button>
              </div>
              <div class="ui_combo">
                <button class="function" data-function="sin">sin</button>
                <button class="function" data-function="cos">cos</button>
                <button class="function" data-function="tan">tan</button>
                <button class="constant" data-constant="pi">&pi;</button>
                <button class="constant" data-constant="2pi">2&pi;</button>
                <button class="function" data-function="sin_i">sin<sup>-1</sup></button>
                <button class="function" data-function="cos_i">cos<sup>-1</sup></button>
                <button class="function" data-function="tan_i">tan<sup>-1</sup></button>
              </div>
              <div class="ui_combo">
                <button class="operator" data-operator="choose">choose</button>
                <button class="operator" data-operator="permute">permute</button>
              </div>

              <div class="ui_combo">
                <button class="function" data-function="square">x<sup>2</sup></button>
                <button class="function" data-function="cube">x<sup>3</sup></button>
                <button class="operator" data-operator="^">x<sup>y</sup></button>
                <button class="function" data-function="inverse">x<sup>-1</sup></button>
                <button class="function" data-function="factorial">x!</button>
                <button class="function" data-function="sqrt">&radic;</button>
                <button class="function" data-function="cbrt"><sup>3</sup>&radic;</button>
                <button class="operator" data-operator="root"><sup>x</sup>&radic;</button>
              </div>
              <div class="ui_combo">
                <button class="function" data-function="log10">log</button>
                <button class="function" data-function="ln">ln</button>
                <button class="function" data-function="e_x">e<sup>x</sup></button>
                <button class="function" data-function="percent">%</button>
                <button class="operator" data-operator="mod">mod</button>
                <button class="function" data-function="floor">floor</button>
                <button class="function" data-function="ceil">ceil</button>
              </div>
            </section>

            <section class="block" id="basic">
              <div class="ui_combo commands">
                <button class="command" data-command="clear">Clear</button>
                <button class="command" data-command="backspace">Backspace</button>
              </div>

              <div class="ui_combo basics">
                <button class="number" data-value="7">7</button>
                <button class="number" data-value="8">8</button>
                <button class="number" data-value="9">9</button>
                <button class="paren" data-paren="(">(</button>
                <button class="paren" data-paren=")">)</button>
              </div>

              <div class="ui_combo basics">
                <button class="number" data-value="4">4</button>
                <button class="number" data-value="5">5</button>
                <button class="number" data-value="6">6</button>
                <button class="operator" data-operator="*">&#215;</button>
                <button class="operator" data-operator="/">&divide;</button>
              </div>

              <div class="ui_combo basics">
                <button class="number" data-value="1">1</button>
                <button class="number" data-value="2">2</button>
                <button class="number" data-value="3">3</button>
                <button class="operator" data-operator="+">+</button>
                <button class="operator" data-operator="-">&mdash;</button>
              </div>

              <div class="ui_combo basics">
                <button class="number" data-value="0">0</button>
                <button class="modifier" data-modifier="decimal" id="decimal">.</button>
                <button class="modifier" data-modifier="plusminus" id="plusminus">+/&ndash;</button>
                <button class="command" data-command="evaluate" id="equals">=</button>
              </div>

            </section>

          </div>

        </main>
      </div>
    </section>
  </div>
  <script src='expression.js'></script>
  <script src="calculator.js"></script>

  <script>
  var calc = new Calculator();
  // prevent page scrolling
  var parentOhShi
  function hoShi (cb) {
    parentOhShi = cb
  }
  document.body.addEventListener('touchmove', function(e) {
    e.preventDefault();
    return false;
  }, false);
  </script>
</body>
</html>