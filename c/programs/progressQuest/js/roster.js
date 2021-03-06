
function load() {

  if (!window.localStorage) {
    roster.html("<b>Hrumph:</b> This browser does not support local storage. You can still play fast and loose: your character will live only as long as the game stays running in your browser.");
    return;
  }

  storage.loadRoster(loadGames);
}

function loadGames(games) {
  var roster = $("#roster");
  roster.empty();

  var newone = window.location.href.split('#')[1];

  var count = 0;

  $.each(games, function (key, c) {
    var name = c.Traits.Name;

    var br = brag(c);
    roster.append(br);

    br.find(".go").on('click', function (arg) {
      window.location = "main.php#" + escape(name);
    });

    br.find(".delete").on('click', function (arg) {
      var msg = "Terminate " + Pick(["faithful","noble","loyal","brave"])+" " + name + "?"
      window.top.$confirm(msg, function (ok) {
        if (ok) {
          delete games[name];
          storage.storeRoster(games);
          load();
        }
      })
    });

    br.find("a.sheet").click(function () {
      alert(template($("#sheet").html(), games[name]));
      // TODO: put in a window or whatev
    });

    if (name === newone)
      br.addClass("lit");

    /*
      var p = $("<p style='font:6pt verdana'/>");
      p.appendTo(roster);
      p.text(JSON.stringify(c));
      */

    ++count;
  });
  if (!count)
    roster.html("<i>Games you start can be loaded from this page, but no saved games were found.<br>Roll up a new character to get started.</i>");
}


function brag(sheet) {
  var brag = $(template($("#badge").html(), sheet));
  if (sheet.motto)
    brag.find(".bs").text('"' + sheet.motto + '"');
  return brag;
}

function clearRoster() {
  storage.storeRoster({}, load);
}

$(document).ready(function () {

  load();

  $("#roll").click(function () {
    window.location = "newguy.php";
  });

  $("#test").click(function () {
    window.location = "newguy.php?sold";
  });

  $("#clear").click(clearRoster);
});
