




/*
     FILE ARCHIVED ON 21:12:14 avr. 11, 2006 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 18:44:22 juil. 2, 2014.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
*	It is of critical importance that this file is referenced inside the <body> tag of every page 
*	on your site.  For example: 
*
*	<body>
*	<script src="/userplane/functions.js" type="text/javascript" language="javascript"></script>
*	
*	!!! WE HIGHLY RECOMMEND YOU LEAVE up_bDoPresence TO true AND TO IMPLEMENT THE CODE IN ALL cfm 
*	PAGES IN THIS FOLDER !!!
*
*	Set up_bDoPresence to false if you have your own presence detection and will check for pending IC
*	windows and call up_launchIC on your own.  If so, you will need to call up_launchIC for every 
*	pending IC window every time the user changes pages.  Also, you will need to implement the logic 
*	in the icWindowOpened.cfm page to let you know when requests have been denied and also when windows 
*	have successfully popped up
*/
var up_bDoPresence = false; 
/* 
*	If you have up_bDoPresence set to true, this is how often (in seconds) we will connect to your 
*	server via icLauncher.cfm or win_ie_pd.cfm
*/
var up_iCheckSeconds = 10; 

// PLEASE DO NOT CHANGE ANY CODE BELOW THIS LINE

var serverPath = "";

function up_launchChat(userID,roomID)
{
window.open( "/web/20060411211214/http://chat.myspace.com/index.cfm?fuseaction=messenger.chatroom&roomID="+roomID, "ICWindow_ChatRoom"+userID+roomID, "status=1,toolbar=0,directories=0,menubar=0,location=0,scrollbars=0,resizable=1,width=800,height=600" );
}

function up_launchChatWithRoom(userID,roomID, subroomID)
{
window.open( "/web/20060411211214/http://chat.myspace.com/index.cfm?fuseaction=messenger.chatroom&roomID="+roomID+"&subroomID="+subroomID, "ICWindow_ChatRoom"+userID+roomID, "status=1,toolbar=0,directories=0,menubar=0,location=0,scrollbars=0,resizable=1,width=800,height=600" );
}

function up_launchIC( userID, destinationUserID, destinationName, sender, profile, gender, age, loc, image )
{		
	up_localUserID = userID;
	var popupWindowTest = null;
	userProfile = profile;
	userGender = gender;
	userAge = age;
	userLocation = loc;
	userImage = image;
	if (sender != 1) {
		popupWindowTest = window.open( "/web/20060411211214/http://chat.myspace.com/index.cfm?fuseaction=messenger&strDestinationUserID=" + destinationUserID + "&sendType=" + sender, "ICWindow_" + up_replaceAlpha(userID) + "_" + up_replaceAlpha(destinationUserID), "status=1,toolbar=0,directories=0,menubar=0,location=0,scrollbars=0,resizable=0,width=360,height=362" );
		popupWindowTest.status = "Myspace.com" 
	}
	
	if( popupWindowTest == null )
	{
		up_showICNotify( userID, destinationUserID, destinationName );
	}
	else
	{
		up_clearICNotify( destinationUserID, false ); 
	}
}

function up_showICNotify( userID, destinationUserID, destinationName )
{
	up_localUserID = userID;
	
	var bAdd = true;
	for( var i = 0 ; i < up_launchArray.length ; i++ )
	{
		if( up_launchArray[i].destID == destinationUserID )
		{
			if( destinationName != undefined )
			{
				up_launchArray[i].destName = "<strong>" + destinationName + "</strong>";
			}
			bAdd = false;
		}
	}
	
	destinationName = destinationName == undefined ? "A website member" : "<strong>" + destinationName + "</strong>";
	
	if( bAdd )
	{
		var userObj = new Object();
		userObj.destID = destinationUserID;
		userObj.destName = destinationName;
		up_launchArray.push( userObj );
	}
	
	up_showNotification();
}

function up_clearICNotify( clearDestID, bForceClear )
{
	var tempArray = up_launchArray;
	up_launchArray = new Array();
	
	var bRemoved = false;
	
	while( tempArray.length > 0 )
	{
		var userObj = tempArray.pop();
		
		if( userObj.destID != clearDestID )
		{
			up_launchArray.push( userObj );
		}
		else
		{
			bRemoved = true;
		}
	}
	
	if( bRemoved || !bForceClear )
	{	
		frames['up_icLauncher'].location.href = "/web/20060411211214/http://chat.myspace.com/index.cfm?fuseaction=messenger.icOpened&destinationUserID=" + clearDestID + "&doPresence=" + ( up_bDoPresence && !up_is_win_ie ? "true" : "false" ) + "&forceClear=" + ( bForceClear ? "true" : "false" ) + "&iRefreshInterval=" + up_iCheckSeconds + "&refresh=" + Math.floor( Math.random() * 100000000000 );
	}
	
	up_showNotification();
}

function up_showNotification()
{
	var elem = document.getElementById( "up_icNotifications" );
	
	if( up_launchArray.length > 0 )
	{
		if( up_displayedNotificationID != up_launchArray[0].destID )
		{
			elem.innerHTML = '<div class="up_mbox"><div class="up_mbox1"><div class="up_mbox2"></div></div><div class="up_mboxgut" style="text-align:center">' + ( up_is_win_ie ? '' : '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td align="center">' ) + '<table border="0" cellpadding="1" cellspacing="5"><tr><td nowrap align="center"><strong style="font-size:larger;">Incoming IM Message</strong></td><td width="1" bgcolor="#000000" rowspan="3"></td><td><b>Gender:</b> '+userGender+' <b>Age:</b> '+userAge+'</td><td width="1" bgcolor="#000000" rowspan="3"><td rowspan="3"><img src="'+userImage+'" border="0" height="75"></tr><tr><td align="center">' + up_launchArray[0].destName + ' wants to IM you.<br>Would you like to accept?</td><td><b>Location:</b> '+userLocation+'</td></tr><tr><td nowrap align="center"><a style="font-size:larger;" href="" onClick="javascript: up_launchIC( \'' + up_localUserID + '\', \'' + up_launchArray[0].destID + '\', \'\', \'3\' ); return false;">Yes</a>&nbsp;|&nbsp;<a style="font-size:larger;" href="" onClick="javascript: up_clearICNotify( \'' + up_launchArray[0].destID + '\', true ); return false;">No</a></td><td nowrap align="center"><a style="font-size:larger;" href="'+userProfile+'" target="_blank">View Profile</a></td></tr></table>' + ( up_is_win_ie ? '' : '</td></tr></table>' ) + '</div><div class="up_mbox3"><div class="up_mbox4"></div></div></div>';
			up_displayedNotificationID = up_launchArray[0].destID;
			up_animate( 130 );
		}
	}
	else
	{
		up_displayedNotificationID = "";
		up_animate( -200 );
	}
}

function up_animate( iWhereTo )
{
	if( up_iDivCurrentY != iWhereTo )
	{
		up_iDivCurrentY += iWhereTo < up_iDivCurrentY ? -10 : 10;
		
		var elem = document.getElementById( "up_icNotifications" );
		elem.style.top = up_iDivCurrentY;
		elem.style.left = 200;		
		setTimeout( "up_animate(" + iWhereTo + ")", 33 );
	}
}

function up_replaceAlpha( strIn )
{
	var strOut = "";
	for( var i = 0 ; i < strIn.length ; i++ )
	{
		var cChar = strIn.charAt(i);
		if( ( cChar >= 'A' && cChar <= 'Z' )
			|| ( cChar >= 'a' && cChar <= 'z' )
			|| ( cChar >= '0' && cChar <= '9' ) )
		{
			strOut += cChar;
		}
		else
		{
			strOut += "_";
		}
	}
	
	return strOut;
}

function up_checkIC()
{
	if( up_is_win_ie )
	{
		up_icCheckImage = new Image();
		up_icCheckImage.onLoad = up_onImageLoad();
		up_icCheckImage.src = serverPath+"win_ie_pd.cfm?refresh=" + Math.floor( Math.random() * 100000000000 );
	}
	else
	{
		frames['up_icLauncher'].location.href = serverPath+"icLauncher.cfm?iRefreshInterval=" + up_iCheckSeconds + "&refresh=" + Math.floor( Math.random() * 100000000000 );
	}
}

function up_onImageLoad()
{
	clearTimeout( up_timeoutID );
	
	if (!up_icCheckImage.complete)
	{
		up_timeoutID = setTimeout("up_onImageLoad()", 250);
	}
	else
	{
		if( up_icCheckImage.height == 2 )
		{
			frames['up_icLauncher'].location.href = serverPath+"icLauncher.cfm?iRefreshInterval=0&refresh=" + Math.floor( Math.random() * 100000000000 );
		}
		else
		{
			//alert( "Nothing to launch" );
		}
		
		up_timeoutID = setTimeout("up_checkIC()", 1000 * up_iCheckSeconds);
	}
}


document.write( '<style type="text/css">' );
document.write( '.up_mbox { background: #ffffff url(/web/20060411211214/http://x.myspace.com/images/userplane/fbox.gif) repeat-y top right; border: 0; margin: 2px 0 6px 0; padding: 0; }' );
document.write( '.up_mbox1 { background: url(/web/20060411211214/http://x.myspace.com/images/userplane/fbox1.gif) no-repeat top right; height: 8px; font: normal 0px/0px Sans-serif; margin: 0; padding: 0; }' );
document.write( '.up_mbox2 { display: block; background: url(/web/20060411211214/http://x.myspace.com/images/userplane/fbox2.gif) no-repeat top left; height: 8px; width: 8px; font: normal 0px/0px Sans-serif; margin: 0; padding: 0; }' );
document.write( '.up_mbox3 { background: url(/web/20060411211214/http://x.myspace.com/images/userplane/fbox3.gif) no-repeat bottom right; height: 8px; font: normal 0px/0px Sans-serif; margin: 0; padding: 0; }' );
document.write( '.up_mbox4 { display: block; background: url(/web/20060411211214/http://x.myspace.com/images/userplane/fbox4.gif) no-repeat bottom left; height: 8px; width: 8px; font: normal 0px/0px Sans-serif; margin: 0; padding: 0; }' );
document.write( '.up_mboxgut { background: url(/web/20060411211214/http://x.myspace.com/images/userplane/fboxgut.gif) repeat-y top left; font: 11px/18px Verdana, Geneva, Arial, Helvetica, Helve, Sans-serif; margin: 0; padding: 0 10px 0 10px; word-wrap: break-word; }' );
document.write( '</style>' );
document.write( '<iframe name="up_icLauncher" id="up_icLauncher" style="width:0px; height:0px; border: 1px" src=""></iframe>' );
document.write( '<div id="up_icNotifications" style="position:absolute; width:550px; z-index:9999; left: 30px; top: -200px;"></div>' );
var up_iDivCurrentY = -200;
var up_launchArray = new Array();
var up_localUserID = "";
var up_displayedNotificationID = "";

var up_icCheckImage = null;
var up_timeoutID = null;

// determine if is Windows IE (up_is_win_ie)
var up_agt 			= navigator.userAgent.toLowerCase();
var up_appVer 		= navigator.appVersion.toLowerCase();
var up_is_mac 		= up_agt.indexOf('mac') != -1;
var up_is_safari 	= up_agt.indexOf('safari') != -1 && up_is_mac;
var up_is_khtml  	= up_is_safari || up_agt.indexOf('konqueror') != -1;
var up_is_ie  	 	= up_appVer.indexOf('msie') != -1 && up_agt.indexOf("opera") == -1 && !up_is_khtml;
var up_is_win   	= up_is_mac ? false : (up_agt.indexOf("win") != -1 || up_agt.indexOf("16bit") != -1);
var up_is_win_ie 	= up_is_win && up_is_ie; 

if( up_bDoPresence )
{
	up_checkIC();
}
