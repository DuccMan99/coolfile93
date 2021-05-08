




/*
     FILE ARCHIVED ON 21:07:19 avr. 11, 2006 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 18:44:22 juil. 2, 2014.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
function stripTicks(str)
{
	var s = str;
	while(s.indexOf("'") != -1)
	s = s.replace("'","");
	return s;
}

function random()
{
	randomseed = (randomseed * randoma + randomc) % randomm;
	return randomseed / randomm;
}

var randomm = 714025;
var randoma = 4096;
var randomc = 150889;
var acnt	= 1;


randomseed = Date.parse(new Date()); 
randomNumber = random() + "";
if (typeof OASHost == "undefined") OASHost = "www";


function get_url() { //el=str, case_sensitive=bool
	var rs="i";
	var urls = new String(document.URL);
	urls = stripTicks(urls);

	var el = "friendID";
	var re = new RegExp( "\\?[\\w\\W]*"+ el +"=([^\\&\\?#]*)", rs);
	var arr = re.exec(urls);
if (!arr) {
	elg = "groupID";
	var red = new RegExp( "\\?[\\w\\W]*"+ elg +"=([^\\&\\?#]*)", rs);
	arr = red.exec(urls);
	}
	if(arr && arr.length>1){	
	return arr[1];
	}else{ 
	var expr = /\/([\w]*)$/i;
	var arr = expr.exec(urls);
		if(arr && arr.length>1)
			return arr[1].toLowerCase();
		else 
			return '';
	}
}

function oas_ad()
{
	
	var argv = oas_ad.arguments;

	var friendID = 0;
	var AdTopicID = 0;
	page = argv[0];
	pos =argv[1];
	

	if(argv.length ==3){
		AdTopicID = argv[2];
	}
	
	subd = 'deSB';

	re_ex = /,/;
	
	temp_flag = 0;
	if(re_ex.test(page)){
		site_arr = page.split(",");
		page = site_arr[1];
	}
	
	switch (pos)
	{
		case 'Frame1':
			friendID = get_url();
			var pxsize = 'width=728 height=90';
			pos = 'leaderboard';
			subd = 'deLB';
			break;
		case 'Top':
			var pxsize = 'width=468 height=60';
			pos = 'banner';
			subd = 'deBR';
			break;
		case 'x08':
			var pxsize = 'width=430 height=600';
			pos = 'halfpage';
			subd = 'deHP';
			break;
		case 'x14':
			var pxsize = 'width=300 height=300';
			pos = 'mrec';
			subd = 'deMR';
			break;
		case 'x15':
			var pxsize = 'width=160 height=600';
			pos = 'skyscraper';
			subd = 'deSK';
			break;
		case 'x54': //feature profile
			var pxsize = 'width=225 height=170';
			pos = 'profile';
			subd = 'deFP';
			break;
		case 'x54-1': //feature profile small
			var pxsize = 'width=200 height=170';
			pos = 'profile';
			subd = 'uhpfp';
			break;
		case 'x55': //feature group
			var pxsize = 'width=640 height=280';
			pos = 'group';
			subd = 'deFG';
			break;
		case 'x56':
			var pxsize = 'width=460 height=140';
			break;
		case 'x69': // This was added for the anchor man inbox add.
			var pxsize = 'width=628 height=288';
			break;
		case 'x77':
			var pxsize = 'width=1 height=1';
			pos = '1x1';
			subd = 'deSB';
			break;
		case 'x78': // login page
			var pxsize = 'width=750 height=600';
			pos = 'interstitial';
			subd = 'deSB';
			break;
		case 'x85':
			var pxsize = 'width=300 height=300';
			break;
		case 'x86':
			var pxsize = 'width=465 height=360';
			break;
		case 'x87':
			var pxsize = 'width=463 height=400';
			break;
		case 'x88':
			var pxsize = 'width=440 height=140';
			pos = 'featuredband';
			subd = 'deFB';
			break;
		case 'fspecial':
			var pxsize = 'width=440 height=140';
			pos = 'fspecial';
			subd = 'deSB';
			break;
		case 'featblg':
			var pxsize = 'width=500 height=100';
			pos = 'featblg';
			subd = 'deSB';
			break;
		case 'uhpfp': //uhp feature profile
			var pxsize = 'width=200 height=170';
			pos = 'uhpfp';
			subd = 'deFP';
			break;
		case 'west':
			var pxsize = 'width=440 height=160';
			pos = 'west';
			subd = 'deWB';
			break;
		case 'east':
			var pxsize = 'width=300 height=100';
			pos = 'east';
			subd = 'deEB';
			break;
		case 'featvid':
			var pxsize = 'width=300 height=170';
			pos = 'featvid';
			subd = 'deFV';
			break;
		case 'movpro':
			var pxsize = 'width=300 height=250';
			pos = 'movpro';
			subd = 'deMP';
			break;
		case 'fmovl':
			var pxsize = 'width=229 height=216';
			pos = 'fmovl';
			subd = 'deFML';
			break;
		case 'fmovr':
			var pxsize = 'width=229 height=216';
			pos = 'fmovr';
			subd = 'deFMR';
			break;
		case 'vrec':
			var pxsize = 'width=240 height=400';
			pos = 'vrec';
			subd = 'deVR';
			break;
		default:
			var pxsize = 'width=468 height=60';
			pos = 'test';
			break;
	}


	var rand = randomNumber.substring(2,11);
	
		if(friendID){
			friendID = "&friendid="+friendID;
		}
		
		if(AdTopicID){
			AdTopicID = "&category="+AdTopicID;
		}
		
		document.write("<IFRAME " + pxsize + " style=\"position:relative;z-index:10000\" MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=0 SCROLLING=no src='http://"+subd+".myspace.com/html.ng/site=myspace&position="+pos+"&page="+page+"&rand="+rand+friendID+AdTopicID+"&acnt="+acnt+"'></iframe>");
		acnt = acnt + 1;

}
