<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>NES</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
		
		<script type="text/javascript" src="jsnes.js"></script>
		<script type="text/javascript" src="nes-embed.js"></script>
		<style>
			body{
				margin: 0;
				padding: 0;
			}
		</style>
	</head>
	  <body class="app_emulator">
		
		<canvas id="nes-canvas" width="256" height="240" style=""/>
		<!--<p>DPad: Arrow keys<br/>Start: Return, Select: Tab<br/>A Button: A, B Button: S</p>-->

		<script src="/c/sys42.js?v=2.4.2"></script>

		<script>

	        function openRom(path) {
		      window.parent.$file.open(path, 'Blob', function(val) {
		        $state.loaded();
		        startGame(val);
		      });
		    }

		    function startGame (blob) {
		      var binaryHandle = new FileReader();
		      binaryHandle.onload = function () {
		        if (this.readyState === 2) {
		          try {
		            nes_load_data("nes-canvas", this.result);
		          } catch (e) {
		            parent.$alert('Invalid rom: ' + e.message);
		          }
		        }
		      };
		      binaryHandle.readAsBinaryString(blob);
		    };

		    $state.loading();

			window.onload = function(){
				if ($url.query.rom) {
			      openRom($url.query.rom)
			    } else {
			      parent.$explorer('c/files/roms/nes/', {browse: true, explorer: true, onclose: function(ok, file) {
			        if (ok) openRom(file);
			      }})
			    }
			}

		</script>

	</body>
</html>
