<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
  <title>Zkype</title>

  <meta name="description" content="hug + hack = infinity">
  <meta name="author" content="jankenpopp, zombectro">
  <meta http-equiv="Content-Language" content="en_US" />
  <meta name="google" content="notranslate" />
  <link href="/rss" rel="alternate" type="application/rss+xml" title="windows93" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=2.4.2" />

  <link rel="stylesheet" href="/c/sys42.css?v=2.4.2">
  <link rel="stylesheet" href="/c/sys/skins/w93.css?v=2.4.2" id="w93_skin">
  <link rel="stylesheet" href="/sys/hotfix.css?v=2.4.2"></head>
	<body>

		<style>
  #app_zkype #overlay, #app_zkype #webgl {
    position: absolute;
    top: 0px;
    left: 0px;
    -o-transform : scaleX(-1);
    -webkit-transform : scaleX(-1);
    transform : scaleX(-1);
    -ms-filter : fliph;
    filter : fliph;
  }
  #app_zkype #videoel {
    -o-transform : scaleX(-1);
    -webkit-transform : scaleX(-1);
    transform : scaleX(-1);
    -ms-filter : fliph;
    filter : fliph;
    background: #666;
  }
  #app_zkype .select_user {
    padding: 3px;
    padding-left: 25px;
    background: url('/c/programs/zkype/icon.gif') no-repeat left;
    cursor: pointer;
    color: #000;
  }
  #app_zkype .select_user:hover {
    color: #666;
  }
  #app_zkype .select_user.active {
    background-color: #ccc;
  }
</style>

<div id="app_zkype" class="ui_layout">
  <article>
    <aside id="contacts" class="skin_light skin_inset w150p pa5 overflow">
    </aside>
    <section class="skin_dark pa0">
      <div class="ui_layout">
        <div class="relative ui_layout_center">
          <video id="videoel" width="500" height="375" preload="auto"></video>
          <canvas id="overlay" width="500" height="375"></canvas>
          <canvas id="webgl" width="500" height="375"></canvas>
          <canvas id="webgl2" class="hide" width="500" height="375"></canvas>
        </div>
      </div>
    </section>
  </article>
</div>
			<script src="js/utils.js"></script>
			<script src="js/clmtrackr.js"></script>
			<script src="js/model_pca_20_svm.js"></script>
			<script src="js/face_deformer.js"></script>
			<script src="js/poisson_new.js"></script>

			<script src="/c/sys42.js?v=2.4.2"></script>

			<script src="zkype.js"></script>
	</body>
</html>
