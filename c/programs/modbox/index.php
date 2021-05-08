<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>ModBox</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
	<meta name="description" content="BeepBox is an online tool for sketching and sharing chiptune melodies. " />
	<meta name="keywords" content="chiptune, music, melody, composition, tool, square wave, NES, NSF, BeepBox, beepbox" />
	<meta name="viewport" content="width=700">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="mobile-web-app-capable" content="yes" />
	<meta name="format-detection" content="telephone=no">
<style type="text/css">
		div {
			margin: 0;
			padding: 0;
		}
		body {
			/*font-family: sans-serif;*/
			/*font-size: 16px;*/
			color: #000;	
			margin: 0px;
			padding: 7px;	
		}

		h1 {
			font-size: 30px;
			text-align: center;
		}

		h2 {
			font-size: 15px;
			text-align: center;
		}

		.centerDiv {
			margin: 0px auto;
		}
		h3 {
			font-size: 15px;
			text-align: left;
		}

		a {
			color: #8866ff;
		}
	</style>
	<script>
		const localStorage = (config => {
		  const { localStorage } = window

		  class AppStorage {
		    constructor(namespace) {
		      const properties = {
		        _namespace: namespace
		      }

		      Object.assign(this, properties)

		      const handler = {
		        get: (target, key) =>
		          target[key] || target.getItem(key) || undefined,

		        set: (target, key, value) =>
		          target.setItem(key, value),

		        deleteProperty: (target, key) =>
		          target.removeItem(key),

		        enumerate: target =>
		          target._keys(),

		        ownKeys: target =>
		          target._keys(),

		        has: (target, key) => 
		          !!target[key] || !!target.getItem(key)
		      }

		      return new Proxy(this, handler)
		    }

		    get _location() {
		      return `.config/${this._namespace}/`
		    }

		    get _keys() {
		      const namespace = location =>
		        location.startsWith(this._location) &&
		        this._location.length != location

		      const locations = Object.keys(localStorage),
		            keys = locations.filter(namespace)

		      return keys
		    }

		    _resolvePath(key) {
		      return this._location + key
		    }
		  
		    getItem(key) {
		      const location = this._resolvePath(key)

		      return localStorage.getItem(location)
		    }

		    setItem(key, value) {
		      const location = this._resolvePath(key)

		      return localStorage.setItem(location, value)
		    }

		    removeItem(key) {
		      const location = this._resolvePath(key)

		      return localStorage.removeItem(location, value)
		    }

		    clear() {
		      const keys = this._keys()

		      for(key of keys)
		        this.removeItem(key)
		    }
		  }

		  return new AppStorage(config.namespace)

		})({
		  namespace: "modbox"
		})

		//dakedres was here ;3
	</script>
</head>

<body bgcolor="silver">
	<div class="centerDiv" style="">
		<div id="beepboxEditorContainer" style=""></div>		
	</div>

	<!--
Instead of loading js beepbox editor interface directly, test for browser support.
<script type="text/javascript" src="beepbox_editor.js"></script>
-->
	<script type="text/javascript">
		//<![CDATA[

		var hasAudioContext = (window.AudioContext || window.webkitAudioContext || window.mozAudioContext || window.oAudioContext || window.msAudioContext);

		if (hasAudioContext) {
			// Go ahead and load js beepbox editor interface:
			var fileref = document.createElement("script")
			fileref.setAttribute("type", "text/javascript")
			fileref.setAttribute("src", "js/modbox.js")
			document.getElementsByTagName("head")[0].appendChild(fileref)

		} else {
			document.getElementById("beepboxEditorContainer").innerHTML = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=11,0,0,0" width="700" height="705" id="BeepBox" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="BeepBoxOnline.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" /><embed src="BeepBoxOnline.swf" quality="high" bgcolor="#000000" width="700" height="705" name="BeepBox" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>';

			var hashInterval = null;
			var myhash = "**blank**"

			function getFlashMovieObject(movieName) {
				if (window.document[movieName]) {
					return window.document[movieName];
				}
				if (navigator.appName.indexOf("Microsoft Internet") == -1) {
					if (document.embeds && document.embeds[movieName])
						return document.embeds[movieName];
				} else // if (navigator.appName.indexOf("Microsoft Internet")!=-1
				{
					return document.getElementById(movieName);
				}
			}

			function pageDidLoad() {
				hashInterval = setInterval('checkHash()', 100);
			}

			function checkHash() {
				if (myhash != location.hash) {
					var flashMovie = getFlashMovieObject("BeepBox");
					if (flashMovie && flashMovie.hashUpdatedExternally) {
						myhash = location.hash;
						flashMovie.hashUpdatedExternally(myhash);
					}
				}
			}

			function documentUpdated(message) {
				if (location.hash != message) {
					location.hash = message;
					myhash = message;
				}
			}

			hashInterval = setInterval('checkHash()', 100);
		}

//]]>

	</script>
	</body>
</html>
