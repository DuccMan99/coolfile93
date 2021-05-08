<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Refused to display in iframe</title>
  <link rel="stylesheet" href="/c/system42.css">
  <link rel="stylesheet" href="/c/skins/w93.css" id="w93_skin">

  <style>
    body, html {background: #003366; /*background:#003366 url(nyancat.gif) repeat; */ color:#fff; height: 100%; padding: 0; margin: 0;}

    a, a:visited {
      color: #FF9AFE;
    }

    div {
      display: -webkit-flexbox;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-flex-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
      text-align: center;
      height: 100%;
    }
    h1 {
      font-size: 32px;
    }
    section {
      width: 70%;
      margin: auto;
      position: relative;
      text-align: center;
    }
  </style>
</head>
<body>
<div>
  <section>
    <h1>I SORRY</h1>
    <img src="snyan.gif" />
    <br>Refused to display <a target="_blank" href=""></a> in a frame
    <br>because it set 'X-Frame-Options' to 'sameorigin'.
    <br><br><button onclick="window.open('', '_blank')">still mad? open it in tab</button>
  </section>
</div>
</body>
</html>
