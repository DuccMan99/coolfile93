<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>AMIGA</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
		<!-- Emulator files. When making them into one file, keep the order -->
		<script type="text/javascript" src="sae/prototypes.js"></script>
		<script type="text/javascript" src="sae/utils.js"></script>
		<script type="text/javascript" src="sae/dms.js"></script>
		<script type="text/javascript" src="sae/config.js"></script>
		<script type="text/javascript" src="sae/roms.js"></script>
		<script type="text/javascript" src="sae/memory.js"></script>
		<script type="text/javascript" src="sae/autoconf.js"></script>
		<script type="text/javascript" src="sae/expansion.js"></script>
		<script type="text/javascript" src="sae/events.js"></script>
		<script type="text/javascript" src="sae/gayle.js"></script>
		<script type="text/javascript" src="sae/ide.js"></script>
		<script type="text/javascript" src="sae/filesys.js"></script>
		<script type="text/javascript" src="sae/hardfile.js"></script>
		<script type="text/javascript" src="sae/dongle.js"></script>
		<script type="text/javascript" src="sae/input.js"></script>
		<script type="text/javascript" src="sae/serpar.js"></script>
		<script type="text/javascript" src="sae/custom.js"></script>
		<script type="text/javascript" src="sae/blitter.js"></script>
		<script type="text/javascript" src="sae/copper.js"></script>
		<script type="text/javascript" src="sae/playfield.js"></script>
		<script type="text/javascript" src="sae/video.js"></script>
		<script type="text/javascript" src="sae/audio.js"></script>
		<script type="text/javascript" src="sae/cia.js"></script>
		<script type="text/javascript" src="sae/disk.js"></script>
		<script type="text/javascript" src="sae/rtc.js"></script>
		<script type="text/javascript" src="sae/m68k.js"></script>
		<script type="text/javascript" src="sae/cpu.js"></script>
		<script type="text/javascript" src="sae/amiga.js"></script>

		<!-- API-calls and support functions -->
		<script type="text/javascript" src="play.js"></script>
	</head>

	  <!--<body class="app_emulator" onload="init()">-->
	  <body class="app_emulator">
		<noscript>
			<div style="height:20px"></div>
			<div class="noscript">JavaScript is disabled or not supported!</div>
			<div style="height:20px"></div>
		</noscript>
		<div style="text-align:center">

			<table style="margin:auto;display: none;">
				<!-- Status-leds for our hooks later -->
				<tr>
					<td class="arm">Status</td>
					<td class="alm">
						<table style="border:1px solid #333">
							<tr>
								<td class="acm" style="width:32px"><span id="status_led_power">PWR</span></td>
								<td class="acm" style="width:16px"><span id="status_led_hd">HD</span></td>
								<td class="arm" style="width:16px"><span id="status_led_df0">0</span></td>
								<td class="arm" style="width:16px"><span id="status_led_df1">0</span></td>
								<td class="arm" style="width:16px"><span id="status_led_df2">0</span></td>
								<td class="arm" style="width:16px"><span id="status_led_df3">0</span></td>
								<td class="arm" style="width:32px"><span id="status_led_fps">0</span></td>
								<td class="arm" style="width:32px"><span id="status_led_cpu">0</span></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- Some config-items -->
				<tr>
					<td class="arm">Config</td>
					<td class="alm">
						<table style="border:1px solid #333">
							<tr>
								<td class="arm">Amiga Model</td>
								<td>
									<select id="cfg_model">
										<option value="A500">A500</option>
										<option value="A500P">A500 Plus</option>
										<option value="A600" selected>A600</option>
										<option value="A1000">A1000</option>
										<option value="A1200">A1200</option>
										<option value="A2000">A2000</option>
										<option value="A3000">A3000</option>
										<option value="A4000">A4000</option>
										<option value="A4000T">A4000 Tower</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="arm">Resolution</td>
								<td>
									<select id="cfg_res">
										<option value="1" selected>Lores</option>
										<option value="2">Hires</option>
										<option value="3">SuperHires</option>
									</select>
									<select id="cfg_ntsc">
										<option value="0">PAL</option>
										<option value="1" selected>NTSC</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="arm">Kickstart ROM</td>
								<td>
									<input id="cfg_rom_file" type="file" style="position:absolute;left:-10000px;top:-10000px;" onchange="romSelect()" />
									<span id="cfg_rom_name" class="red">&lt;unset&gt; (required)</span>
									<button class="button" onclick="document.getElementById('cfg_rom_file').click()">Select</button>
									<button class="button" id="cfg_rom_remove" onclick="romRemove()">Remove</button>
								</td>
							</tr>
							<tr>
								<td class="arm">Floppy (DF0)</td>
								<td>
									<input id="cfg_df0_file" type="file" style="position:absolute;left:-10000px;top:-10000px;" onchange="floppyInsert(0)" />
									<span id="cfg_df0_name" class="gray">&lt;empty&gt;</span>
									<button class="button" onclick="document.getElementById('cfg_df0_file').click()">Insert</button>
									<button class="button" id="cfg_df0_eject" onclick="floppyEject(0)">Eject</button>
								</td>
							</tr>
							<tr>
								<td class="arm">Floppy (DF1)</td>
								<td>
									<input id="cfg_df1_file" type="file" style="position:absolute;left:-10000px;top:-10000px;" onchange="floppyInsert(1)" />
									<span id="cfg_df1_name" class="gray">&lt;empty&gt;</span>
									<button class="button" onclick="document.getElementById('cfg_df1_file').click()">Insert</button>
									<button class="button" id="cfg_df1_eject" onclick="floppyEject(1)">Eject</button>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- Control-buttons -->
				<tr>
					<td class="arm">Controls</td>
					<td class="alm">
						<table>
							<tr>
								<td><button onclick="start()">Start</button></td>
								<td><button onclick="stop()">Stop</button></td>
								<td><button onclick="reset()">Reset</button></td>
								<td><button onclick="pause(1)" id="controls_pr">Pause</button></td>
								<td><button onclick="mute(1)" id="controls_mp">Mute</button></td>
								<td><button onclick="screen(1)" id="controls_sw">Screen</button></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- Output -->
				<tr>
					<td class="arm">Output</td>
					<td class="alm">
						<!-- Method 1: SAE will create a canvas and add it into the div-element below

						See example2.htm -->

						<!--<div id="myVideo" style="margin:auto"></div>-->


						<!-- Method 2: The canvas is already defined. SAE will output to the element below.
						The size of the canvas is set by SAE according your settings -->
						
					</td>
				</tr>
			</table>

			
		</div>

		<canvas id="myVideo" style="margin:auto;background-color:#000"></canvas>
			<script src="/c/sys42.js?v=2.4.2"></script>
	</body>
	<script>


		init();

    function loadKickstart(path) {
      window.parent.$file.open(path, 'Blob', function(val) {
        $state.loaded();
        var file = new File([val], path);
        loadFile(val, function (event) {
        	console.log(file)
			//cfg.memory.rom.path = e.path; currently unused in SAE
			console.log(file.name)
			cfg.memory.rom.name = file.name; /* filename */
			cfg.memory.rom.data = event.target.result; /* typeof 'String' or 'Uint8Array' */
			cfg.memory.rom.size = file.size; /* size in bytes */
			cfg.memory.rom.crc32 = crc32(event.target.result); /* pre-calculate crc32 for a faster start */
			setRomName();
			start();
			
			// dirty
			document.querySelector('#myVideo').style.width="auto";
			document.querySelector('#myVideo').style.height="100%";
		});
      });
    }
	loadKickstart("/c/files/roms/amiga/roms/A500-A600-A2000.rom");


function loadFloppy(n,path) {
      window.parent.$file.open(path, 'Blob', function(val) {
        $state.loaded();
        var e = new File([val], path);
		loadFile(e, function(event) {
			var file = cfg.floppy.drive[n].file;
			//file.path = e.path; currently unused in SAE
			file.name = e.name; /* filename */
			file.data = event.target.result; /* typeof 'String' or 'Uint8Array' */
			file.size = e.size; /* size in bytes */
			file.crc32 = crc32(event.target.result); /* pre-calculate crc32 for a faster start */
			setFloppyName(n);
			if (running)
				sae.insert(n);
		});
      });
}

$state.loading();

    if ($url.query.rom) {
      loadFloppy(0,$url.query.rom)
    } else {
      parent.$explorer('c/files/roms/amiga/', {browse: true, explorer: true, onclose: function(ok, file) {
        if (ok) {
        	console.log(file)
        	loadFloppy(0,''+file)
        }
      }})
    }

		
	</script>
</html>
