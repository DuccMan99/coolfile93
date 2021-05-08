function $catex (le, theurl) { 'use strict';

  // var HOMEPAGE = '/c/programs/catExplorer/ixquick/index.html';
  // var HOMEPAGE = 'https://pierrepapierciseaux.net/.skynet/';
  var HOMEPAGE = 'https://myspace.windows93.net';
  if (theurl && theurl.indexOf('http') !== 0) theurl = 'http://' + theurl;
  theurl = theurl || HOMEPAGE;

  //console.log(theurl);

  if (le._states.opened['catex']) {
    le._states.opened['catex'].go(theurl);
    return;
  } else {
    le._states.opened['catex'] = {};
  }

  var filters = {
    // Moteur de recherche
     'google.' : ['https://duckduckgo.com', 'http://www.aliweb.com']
    ,'bing.' : ['https://ixquick.com', 'http://www.ifindit.com']
    ,'yahoo.' : ['https://www.potatoland.org/shredder/shredder.html']
    // Webmail
    ,'gmail.' : ['https://www.no-log.org']
    // Réseau Social
    ,'facebook' : ['https://myspace.windows93.net'] //'https://joindiaspora.com']
    ,'twitter' : ['https://myspace.windows93.net']
    ,'instagram' : ['https://myspace.windows93.net']
    //,'myspace.' : [go('/c/files/archiveorg/myspace/index.html', 'http://myspace.com')]
    ,'myspace' : ['https://myspace.windows93.net']
    // Portail vidéo
    ,'youtube.' : ['https://petittube.com']
    ,'wat.tv' : ['https://rutube.ru']
    ,'dailymotion.' : ['https://www.ubuweb.com']
    // Fournisseurs accès
    ,'orange.fr' : ['https://www.fdn.fr']
    ,'sfr.fr' : ['https://www.fdn.fr']
    // Vente en ligne
    ,'amazon.' : ['https://openlibrary.org']
    ,'leboncoin.fr' : ['https://www.videgrenierdunet.fr', 'https://www.wannonce.com']
    ,'ebay.' : ['https://www.videgrenierdunet.fr', 'https://www.wannonce.com']
    // Portail généraliste
    ,'linternaute.' : ['https://www.lepiredunet.fr']
    // Portail pornographique
    ,'youporn.' : ['https://fuckforforestmovie.com']
    ,'pornhub.' : ['https://fuckforforestmovie.com']
    ,'xnxx.' : ['https://fuckforforestmovie.com']
    ,'xhamster.' : ['https://fuckforforestmovie.com']
    // informations
    ,'lemonde.' : ['https://www.acrimed.org']
    // Portail d'écoute musicale
    ,'deezer.' : ['https://www.musiqueapproximative.net']
    ,'soundcloud.' : ['http://www.musiqueapproximative.net']
    // Jeu en ligne
    ,'partypoker.' : ['http://www.poker-heroes.com']
    // Blogging
    //,'over-blog.' : ['https://medium.com']
    //,'blogger.' : ['https://medium.com']

    ,'tf1.' : ['http://www.legorafi.fr']
    ,'lefigaro.' : ['http://www.legorafi.fr']

    ,'maps.google.' : ['http://openstreetmap.fr']

    ,'allocine.fr' : ['http://www.cinemotions.com']
    ,'lequipe.fr' : ['http://www.football365.fr']

    ,'jeuxvideo.' : ['http://www.abandonware-france.org', 'http://gamopat.com', 'http://www.jenesuis.net']
    ,'commentcamarche.net' : ['http://experts-univers.com', 'http://makezine.com/projects']
    ,'aufeminin.com' : ['http://yvettesbridalformal.com', 'http://web.archive.org/web/20110718150425']
    ,'eorezo.com' : ['http://openmeteofoundation.org', 'http://forecast.io']
    ,'meteofrance.com' : ['http://openmeteofoundation.org', 'http://forecast.io']
    ,'lo.st' : ['http://openmeteofoundation.org', 'http://forecast.io']

    ,'msn.' : ['http://www.windows93.net']
    ,'microsoft.' : ['http://www.windows93.net']
  }


  var iframe;
  function go(url, fake) {
    url = filter(url) || HOMEPAGE;

    navInput.value = fake || url;

    //if (url.indexOf('/c/') == 0) {
    if (/^\/?(c\/|d\/|z\/)/.test(url)) {
      iframe.src = url;
      favicon.src = '/c/sys/skins/'+le._settings.skin+'/file.png';
      return;
    }

    var trydest = url;
    if (/^(?:f|ht)tps?:\/\//i.test(url)) {
      //console.log('valid url');
    } else {
      trydest = 'http://' + url;
    }
    iframe.src = trydest;

    // check if possible to iframe
    /*$ajax.post('/c/app/catex.php?v=3', {url: trydest}).done(function(data) {
      console.log(1, data);
      if (data.httpcode && data.notframable) { // valid link but with 'X-Frame-Options' restriction
        console.log('noframe', data.httpcode, data.notframable);
        //iframe.src = '/c/app/noframe.php?url=' + trydest;
      } else if (data.httpcode == 0) { // not a valid webpage could be a search string
        console.log('search', data.httpcode);
        //iframe.src = 'https://duckduckgo.com/?q=' + encodeURI(url);
      }
    }).fail(function(e) {
      console.log('ajax fail');
      //$alert.error('ajax error: Cat Explorer can\'t check the url');
    });*/

    $url.checkFavicon(trydest, function(ok, fav) {
      if (ok) {
        favicon.src = fav;
      } else {
        favicon.src = '/c/sys/skins/'+le._settings.skin+'/file.png';
      }
    });

  }


  var errorUrl = ["facebook", "twitter", "yahoo", "baidu", "live.", "amazon.", "linkedin", "blogspot", "vk.com", "wordpress.com", "bing.com", "ebay", "pinterest", "msn", "tumblr", "paypal.", "apple.", "imdb", "adcash", "neobux", "reddit", "4chan", "stackoverflow", "blogger", "adobe.", "vube.com", "thepiratebay", "netflix", "soundcloud"];
  function filter(url) {
    for (var key in filters) {
      if (filters.hasOwnProperty(key)) {
        if (url.indexOf(key) > -1) {return filters[key][0]}
      }
    }
    for (var i = errorUrl.length - 1; i >= 0; i--) {
      if (url.indexOf(errorUrl[i]) > -1) {
        $alert.error({
          msg:'<b>Danger: Malware Ahead!</b><br><br>Cat Explorer has blocked access to this page :<br><i>'+url+'</i><br><br>Malware is malicious software that cause<br>things like private data stealing, loss of time,<br>free knowledge censorship, global mass manipulation and satanic kitten orgy.',
          title: 'Danger: Malware Ahead!'
        });
        return null; //'/c/app/ixquick/index.html'//'http://www.windows93.net'
      }
    };
    return url;
  }

  var nav = document.createElement('div');
  var navInput = document.createElement('input');
  var navPrev = document.createElement('button');
  var navNext = document.createElement('button');
  var navGo = document.createElement('button');
  var navMenu = document.createElement('button');
  var favicon = new Image();
  favicon.src = '/c/sys/skins/'+le._settings.skin+'/file.png';
  nav.className = 'cat_nav';
  nav.style.marginBottom = '4px';
  favicon.className = 'cat_nav__favicon';
  navInput.className = 'cat_nav__input';
  navPrev.innerHTML = '<';
  navNext.innerHTML = '>';
  navPrev.disabled = true;
  navNext.disabled = true;
  navPrev.style.display = 'none';
  navNext.style.display = 'none';
  navMenu.style.display = 'none';
  navGo.innerHTML = 'Go';
  navMenu.innerHTML = '☰';
  navMenu.style.fontSize = '9px';
  nav.appendChild(navPrev);
  nav.appendChild(navNext);
  nav.appendChild(favicon);
  nav.appendChild(navInput);
  nav.appendChild(navGo);
  nav.appendChild(navMenu);
  navGo.addEventListener('click', function() {
    go(navInput.value);
  });
  /*navMenu.addEventListener('click', function() {
    iframe.classList.add('ef_acid');
    //iframe.classList.add('ef_invert_light');
    //iframe.classList.add('ef_hue');
    //nayn()
  });*/

  /*var d = 0;
  var anim = $loop(function() {
    if (d>=360) d = 0;
    //console.log('?');
    //iframe.style.filter = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' ><filter id='hue'><feColorMatrix in='SourceGraphic' type=\'hueRotate\' values=\'"+d+"\' /></filter></svg>#hue"
    iframe.style.filter = 'url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' ><filter id=\'hue\'><feColorMatrix in=\'SourceGraphic\' type=\'hueRotate\' values=\''+d+'\' /></filter></svg>#hue")';
    d++
  },100);
  function nayn() {
    //console.log('????');
    //iframe.style.filter = 'url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' ><filter id=\'hue\'><feColorMatrix in=\'SourceGraphic\' type=\'hueRotate\' values=\''+180+'\' /></filter></svg>#hue")';
    //iframe.setAttribute('style', 'filter:url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' ><filter id=\'hue\'><feColorMatrix in=\'SourceGraphic\' type=\'hueRotate\' values=\'"+180+"\' /></filter></svg>#hue");');
    anim.play();
  }*/

  var navMenuItems = [
     //{name: 'cat vison', items: [
       {name: 'Nyan cat', action: function() { iframe.className = 'ui_window__iframe ef_acid'; }}
      ,{name: 'Grumpy cat', action: function() { iframe.className = 'ui_window__iframe ef_invert_light'; }}
      ,{name: 'Chemistry cat', action: function() { iframe.className = 'ui_window__iframe ef_blur'; }}
      //,{name: 'X-Ray cat', action: function() { iframe.className = 'ui_window__iframe ef_xray'; }}
      ,{name: 'Serious cat', action: function() { iframe.className = 'ui_window__iframe ef_emb'; }}
      ,{name: 'Real cat', action: function() { iframe.className = 'ui_window__iframe ef_realcat'; }}
     //]}
    ,{name: 'see headers'}
    ,{name: 'import bookmarks'}
    ,{name: 'export bookmarks'}
  ]
  $key(navInput, function(k) {
    if (k == 'enter') {
      go(navInput.value);
    }
  });


  // http://stackoverflow.com/a/1838684/1289275
  /////////////////////////////////////////////////////////////////////////////
  // Create a random seed value, making it almost impossible to
  // determine what is being tested for.
  /*var prevent_bust = Math.random() * 3000;

  // enclose everything in a function, so that it cannot be addressed
  function iniFunc ( init ) {
      // The function is no longer in le of the main window.
      function onbeforeunload() { prevent_bust++ }
      window.onbeforeunload = onbeforeunload;
      return setInterval( function() {
          // make sure the function was not deleted.
          if( window.onbeforeunload != onbeforeunload )
          {
              prevent_bust = init + 1;
              window.onbeforeunload = onbeforeunload;
          }
          if (prevent_bust > init ) {  // All comparison is to the random seed.
              prevent_bust -= 2
              window.top.location = '/c/app/locationtop.php'
              // Unfortunately, you have absolutely no idea which website caused
              // the incrementation, so you cannot replace it with a link!
              //
              // You might try to simply ignore it and just use the iframe as is --
              // theoretically, they are no longer able to bust this frame.
              // (this theory will be disproved below).
         }
     }, 1 );
  };*/



  var menuInstance, cleanId;
  var data = {
    //icon: this.app.icon, //'/c/sys/skins/'+le._settings.skin+'/apps/nyanexplorer.png',
    //title: 'cat explorer',
    width: 800,
    height: 600,
    url: HOMEPAGE, //'nope',
    //html: '',
    onopen: function(el) {
      iframe = el.getElementsByTagName('iframe')[0];
      le._states.opened['catex'].loaded = true;
      le._states.opened['catex'].nav = navInput;
      le._states.opened['catex'].go = go;

      menuInstance = $menu(navMenu, navMenuItems, {mode: 'popup'});

      setTimeout(function() {
        go(theurl);
      }, 500)

      //cleanId = iniFunc( prevent_bust );
    },
    onclose: function(el) {
      le._states.opened['catex'] = null;

      menuInstance.destroy();

      //clearInterval(cleanId);
    },
    beforeMenu: nav,
    menu: [
       
       {name: 'MySpace', icon: 'https://myspace.windows93.net/favicon.png', action: function(){go('https://myspace.windows93.net')}}
      ,{name: '', icon: 'https://pierrepapierciseaux.net/.skynet/favicon.png', action: function(){go('https://pierrepapierciseaux.net/.skynet/')}}
      //,{name: '', icon: '/c/sys/skins/'+le._settings.skin+'/myspace.png', action: function(){go('/c/files/archiveorg/myspace/index.html', 'http://myspace.com')}}
      ,{name: 'Crew', icon: '/c/sys/skins/'+le._settings.skin+'/places/16/folder.png', items: [
         {name: 'Jankenpopp', action: function(){go('http://jankenpopp.com')}}
        ,{name: 'Zombectro', action: function(){go('http://zombect.ro')}}
        ,{name: 'databit.me', icon: '/c/programs/catExplorer/icons/databit.gif', action: function(){go('http://databit.me/')}}
        ,{name: 'lowtoy', icon: 'http://www.lowtoy.com/wp-content/uploads/2013/10/favicon.ico', action: function(){go('http://www.lowtoy.com/')}}
        ,{name: 'freesson', icon: '/c/programs/catExplorer/icons/love.png', action: function(){go('http://freesson.com')}}
      ]}
      ,{name: 'Media', icon: '/c/sys/skins/'+le._settings.skin+'/places/16/folder.png', items: [
         {name: 'archive.org', action: function(){go('https://archive.org')}}
        ,{name: 'The Internet Arcade (archive.org)', action: function(){go('https://archive.org/details/internetarcade')}}
        ,{name: 'openlibrary.org', action: function(){go('https://openlibrary.org')}}
        ,{name: 'freemusicarchive.org', action: function(){go('http://freemusicarchive.org/')}}
        ,{name: 'pouet.net', action: function(){go('http://www.pouet.net/')}}
        ,{name: 'modarchive.org', action: function(){go('http://modarchive.org/')}}
        ,{name: 'Comics', icon: '/c/sys/skins/'+le._settings.skin+'/places/16/folder.png', items: [
           {name: 'prguitarman', action: function(){go('http://www.prguitarman.com/')}}
          ,{name: 'commitstrip', action: function(){go('http://www.commitstrip.com/en/')}}
        ]}
      ]}
      ,{name: 'Net-Art', icon: '/c/sys/skins/'+le._settings.skin+'/places/16/folder.png', items: [
         {name: 'www.teleportacia.org', action: function(){go('http://www.teleportacia.org/war/')}}
        ,{name: 'wwwwwwwww.jodi.org', action: function(){go('http://wwwwwwwww.jodi.org')}}
        ,{name: 'whitescreen', action: function(){go('http://whitescreen.jeunecreation.org')}}
        ,{name: 'aem1k.com - Minified JavaScript Craziness', action: function(){go('http://aem1k.com')}}
        ,{name: 'Every Icon', action: function(){go('http://numeral.com/appletsoftware/eicon.html')}}
        ,{name: 'Cachemonet', action: function(){go('http://cachemonet.com/')}}
        ,{name: 'Come on and slam', action: function(){go('http://comeonandsl.am/')}}
        ,{name: "tilde.club", action: function(){go('http://tilde.club/')}}
        ,{name: "teleferique.org", action: function(){go('http://www.teleferique.org/')}}
        ,{name: "0100101110101101 | no-fun", action: function(){go('http://0100101110101101.org/no-fun/')}}
      ]}
      ,{name: 'Games', icon: '/c/sys/skins/'+le._settings.skin+'/places/16/folder.png', items: [
         {name: 'Candy Box', action: function(){go('http://candybox2.net')}}
        ,{name: 'Blektre', action: function(){go('http://kanar.ci0.org/blektre')}}
        ,{name: 'Ours En Slip Simulator', action: function(){go('http://oess.saucisse.org')}}
      ]}
      ,{name: 'P()rn', icon: '/c/sys/skins/'+le._settings.skin+'/places/16/folder.png', items: [
         {name: 'penisland.net', action: function(){go('http://penisland.net/')}}
        ,{name: 'whorepresents.com', action: function(){go('http://www.whorepresents.com/')}}
        ,{name: 'therapistinabox.com', action: function(){go('http://www.therapistinabox.com/')}}
        ,{name: 'analemma.org', action: function(){go('http://analemma.org/')}}
        ,{name: 'wintersexpress.com', action: function(){go('http://www.wintersexpress.com/')}}
        ,{name: 'kidsexchange.net', action: function(){go('http://kidsexchange.net/')}}
        ,{name: 'ladrape.com', action: function(){go('http://www.ladrape.com/')}}
        ,{name: 'oldmanshaven.com', action: function(){go('http://www.oldmanshaven.com/')}}
        ,{name: 'itscrap.com', action: function(){go('http://itscrap.com/')}}
        ,{name: 'expertsexchange.com', action: function(){go('http://expertsexchange.com/')}}
        ,{name: 'whoresofinstagram.com', action: function(){go('http://www.whoresofinstagram.com/')}}
        ,{name: 'deputespourtous.com', action: function(){go('http://www.deputespourtous.com')}}
      ]}
      ,{name: 'Gif', icon: '/c/sys/skins/'+le._settings.skin+'/places/16/folder.png', items: [
         {name: "The Afterlife", action: function(){go('http://heaven.internetarchaeology.org/heaven.html#bottom')}}
        ,{name: "heathersanimations.com", action: function(){go('http://heathersanimations.com/alien1.html')}}
        ,{name: "Evan Roth - http://one-gif.com/positions", action: function(){go('http://one-gif.com/positions/')}}
        ,{name: "Reveries.fr", action: function(){go('http://www.reveries.fr/gifs/')}}
      ]}
      ,{name: 'Tools', icon: '/c/sys/skins/'+le._settings.skin+'/places/16/folder.png', items: [
         {name: "Web developer tools", action: function(){go('https://mothereff.in/')}}
        ,{name: "Js Beautifier", action: function(){go('http://jsbeautifier.org/')}}
        ,{name: "regex101", action: function(){go('http://regex101.com/')}}
        ,{name: "unicodeblocks", action: function(){go('http://www.unicodeblocks.com/')}}
        ,{name: "commandlinefu", action: function(){go('http://www.commandlinefu.com/')}}
        ,{name: "wavepot (live coding music in javascript)", action: function(){go('http://wavepot.com/')}}
        ,{name: "Reverse IP Domain Check", action: function(){go('http://www.yougetsignal.com/tools/web-sites-on-web-server/')}}
        ,{name: "Crazy Call", action: function(){go('http://www.crazycall.net/')}}
      ]}
      ,{name: 'INTERWEBZ', icon: '/c/sys/skins/'+le._settings.skin+'/places/16/folder.png', items: [
         {name: "Yorkshire Terriers de Villardières", action: function(){go('http://www.villardieres.com')}}
        ,{name: "Le Club des 50 ans et plus du Quebec", action: function(){go('http://retraite.chez.com/')}}
        ,{name: "Association des chats de France", action: function(){go('http://www.chatsdefrance.asso.fr/lesexpos.htm')}}
        ,{name: "Les Poupons Frisés", action: function(){go('http://shihtzu.free.fr/index.htm')}}
        ,{name: "Champagne en Valromey/", action: function(){go('http://champagne-valromey.fr/')}}
        ,{name: "Ling's Cars", action: function(){go('http://www.lingscars.com/')}}
        ,{name: "Site de la Municipalité de Beuzeville", action: function(){go('http://web.archive.org/web/20120330195406/http://www.beuzeville.fr/')}}
        ,{name: "Haven Works", action: function(){go('http://web.archive.org/web/20100813142028/http://havenworks.com/')}}
        ,{name: "Welcome to Yvette's", action: function(){go('http://web.archive.org/web/20110718150425/http://yvettesbridalformal.com/')}}
        ,{name: "Rainbow Primates", action: function(){go('http://www.rainbowprimates.net/')}}
        ,{name: "Constellation 7", action: function(){go('http://www.constellation7.org')}}
        ,{name: "Galaxion", action: function(){go('http://www.galaxion.com/')}}
        ,{name: "Zion Corp", action: function(){go('http://www.zion-corp.net/')}}
        ,{name: "Space Ark", action: function(){go('http://www.spaceark.net/')}}
        ,{name: "1 Million Dollar Page", action: function(){go('http://www.milliondollarhomepage.com/')}}
        ,{name: "World's Worst Website", action: function(){go('http://www.worlds-worst-website.com/')}}
        ,{name: "Arngren.net", action: function(){go('http://www.arngren.net/')}}
        ,{name: "DPGraph", action: function(){go('http://www.dpgraph.com/')}}
        ,{name: "Aliweb.com (First search engine ever)", action: function(){go('http://www.aliweb.com/')}}
        ,{name: "I Find It", action: function(){go('http://www.ifindit.com/')}}
        ,{name: "Mark Zuckerberg's Homepage", action: function(){go('https://web.archive.org/web/20021104225654/http://www.angelfire.com/ny/mez51/')}}
        ,{name: "Web King", action: function(){go('http://www.webkinglasvegas.com/')}}
        ,{name: "Back Street Boys", action: function(){go('http://codepen.io/yahtaa/full/lrnhd/')}}
        ,{name: "Internet Explorer is EVIL!", action: function(){go('http://toastytech.com/evil/')}}
        ,{name: "The San Francisco FogCam!", action: function(){go('http://www.fogcam.org/')}}
        ,{name: "Joan Stark's ASCII Art Gallery", action: function(){go('https://web.archive.org/web/20111227233818/http://geocities.com/spunk1111/')}}
        ,{name: "Geocities.ws Search Engine", action: function(){go('http://www.geocities.ws/search/local/')}}
        ,{name: "Icon Browser", action: function(){go('http://www.ibiblio.org/gio/iconbrowser/')}}
      ]}
      ,{name: 'VM', icon: '/c/sys/skins/'+le._settings.skin+'/places/16/folder.png', items: [
         {name: 'operatingsystem.fail', action: function(){go('http://operatingsystem.fail/')}}
        ,{name: 'www.michaelv.org', action: function(){go('http://www.michaelv.org/')}}
        ,{name: 'Windows really good edition', action: function(){go('http://www.cs.umd.edu/~meou/Flashes/WINRG/WINRG.html')}}
        ,{name: 'Realistic internet simulator', action: function(){go('http://www2.b3ta.com/realistic-internet-simulator/')}}
        ,{name: 'jen.lu/v1/', action: function(){go('http://jen.lu/v1/')}}
        ,{name: 'Jurassic Systems', action: function(){go('http://www.jurassicsystems.com/')}}
        ,{name: 'Hue Grant', action: function(){go('http://huegrant.com/')}}
        ,{name: 'The Restart Page', action: function(){go('www.therestartpage.com/')}}
        ,{name: 'Hacker Typer', action: function(){go('http://hackertyper.com/')}}
        ,{name: 'TAWS - Amiga Workbench', action: function(){go('http://www.taws.ch/WB.html')}}
        ,{name: 'www.chiptune.com', action: function(){go('http://www.chiptune.com/')}}
        ,{name: 'cyberniklas OS', action: function(){go('http://www.cyberniklas.de/lego/lego.html')}}
        ,{name: "charlie.bz's windows 95", action: function(){go('https://charlie.bz/')}}
      ]}
    ]
  };
  //console.log(this, data);
  le._states.opened['catex'].instance = $window.call(this, data);
  //$window(data);
}