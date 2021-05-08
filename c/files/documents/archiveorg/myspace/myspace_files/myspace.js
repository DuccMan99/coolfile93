




/*
     FILE ARCHIVED ON 20:25:53 avr. 11, 2006 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 18:44:21 juil. 2, 2014.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
function deleteUser(friendid, name, url){
    if ( confirm('Are you sure you want to delete ' + name + ' from your list of friends?') ) {
        location.href = url;
    }
}

var checkflag = "false";
function checkUncheckAll(field){
    if (checkflag == "false") {
        for (i = 0; i < field.length; i++) {
            field[i].checked = true;
        }
        field.checked = true;
        checkflag = "true";
    }else {
        for (i = 0; i < field.length; i++) {
            field[i].checked = false;
        }
        field.checked = false;
        checkflag = "false";
    }
}


/* signup check for state */
function checkCountry(form){
    if(form.f_country.value != 'US'){
        form.f_region.disabled = true;
        form.f_region_other.disabled = false;
        form.f_region_other.value = '';
        form.f_region_other.focus();
    }else{
        form.f_region.disabled = false;
        form.f_postal_code.disabled = false;
        form.f_region_other.disabled = true;
        form.f_region_other.value = '(NA)';
    }
}


//////////////////////////////////////////////////////////////////////
// registerEvent function
//////////////////////////////////////////////////////////////////////
// Allows you to attach an event to an HTML object (without 
// overwriting any existing events).
// Parameters:
//		object: 
// 		The name of the HTML element you wish to append an event
//		to, such as "window" or "document.form.myElement".
//		event:
//		The event handler you would like to modify, such as 
//		"onload" or "onclick".  Event handlers are all lowercase.
//		cmd:
//		The javascript statement(s) you would like to put into the 
//		event handler, such as "alert("test");", or 
//		"var s = 1; s++;".  AS ALWAYS, ALL JAVASCRIPT COMMANDS MUST
//		END WITH A SEMICOLON.
//		append:
//		This is a boolean value which determines whether the cmd you
//		are attaching should go at the end of the handler or the 
//		beginning.  true = at the end.  false = at the beginning.
//////////////////////////////////////////////////////////////////////
function registerEvent(object, event, cmd, append)
{
	if(arguments.length < 3) return alert("Invalid arguments. Please use the format \nregisterEvent(object, event, command, [append]).");
	if (typeof append != "boolean") append = true;

	var event = object + "." + event.toLowerCase();
	var objEvent = eval(event);

	var strEvent = (objEvent) ? objEvent.toString() : "";
	strEvent = strEvent.substring(strEvent.indexOf("{")+1, strEvent.lastIndexOf("}"));
	strEvent = (append) ? (strEvent + cmd) : (cmd + strEvent);
	strEvent += "\n";
	eval(event + " = new Function(strEvent)");
	return true;
}
//////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////
// countCharacters function
//////////////////////////////////////////////////////////////////////
// Sets up the counting of textarea fields in a modular fashion.
// This function is called in place where you would like a read-only 
// counter input field to appear.  The function creates the input 
// field and sets up the handlers that will automatically keep the 
// count of the field accurate.  The handlers are:
//		1) The textarea's onkeyup handler.
//		2) The textarea's onkeydown handler.
//		3) A 1 second interval (to handle pasting of text which does 
//		   not trigger either of the previous two events).
// All handlers are routed through window.onload to make sure the 
// textarea element has been rendered before attaching events to it.
// Parameters:
//		formName:
//		The name of the form the textarea is in.
//		elementName:
//		The name of the textarea field.
//////////////////////////////////////////////////////////////////////
function countCharacters(formName, elementName)
{
	var formElementString = "document." + formName + "." + elementName;
	var ID = formElementString + ".CharacterCount";

	if (!document.getElementById(ID)) document.write("<INPUT ID='" + ID + "' TYPE='TEXT' SIZE='4' onfocus='blur();'>");
	
	var functionString = "updateCountCharacters('" + formElementString + "');";
	
	registerEvent("window", "onload", "registerEvent(\"" + formElementString + "\", \"onkeydown\", \"" + functionString + "\", false);", false);
	registerEvent("window", "onload", "registerEvent(\"" + formElementString + "\", \"onkeyup\", \"" + functionString + "\", false);", false);
	registerEvent("window", "onload", functionString, false);
	setInterval(functionString, 1000);
}
//////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////
// updateCountCharacters function
//////////////////////////////////////////////////////////////////////
// Keeps the textarea count updated.  This is an event handler that 
// should not be called directly.  See the countCharacters function.
// This function makes sure all line breaks are counted as two 
// characters, since they are submitted through the HTTP post as two 
// characters.
//////////////////////////////////////////////////////////////////////
function updateCountCharacters(formElementString)
{
	var formElement = eval(formElementString);
	var ID = formElementString + ".CharacterCount";
	var formElementValue = formElement.value.replace(/\n/g, '\r\n').replace(/\r\r/g, '\r');
	document.getElementById(ID).value = parseInt(formElementValue.length, 10);
}
//////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////
// generalizeDomain function
//////////////////////////////////////////////////////////////////////
// Keeps the javascript document.domain in its most generalized form.
// "www.myspace.com" becomes "myspaoe.com"
//////////////////////////////////////////////////////////////////////
	function generalizeDomain()
	{
		var domainArray = document.domain.split(".");
		var domainArrayLength = domainArray.length;
		if (domainArrayLength >= 2) document.domain = domainArray[domainArrayLength - 2] + "." + domainArray[domainArrayLength - 1];
	}
	if ( (QueryString('fuseaction') != 'blog.create') && (QueryString('fuseaction') != 'blog.edit') && (QueryString('fuseaction') != 'blog.commentreply') && (QueryString('fuseaction') != 'blog.comment') )
		generalizeDomain();
//////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////
// definition of openWin
//////////////////////////////////////////////////////////////////////
function openWin( windowURL, windowName, windowFeatures ) { 
	return window.open( windowURL, windowName, windowFeatures ) ;
}

//////////////////////////////////////////////////////////////////////
// client-side query string parsing functions
//////////////////////////////////////////////////////////////////////
function QueryString_Parse() {
	QueryString.keys = new Array();
	QueryString.values = new Array();
	var query = window.location.search.substring(1);
	var pairs = query.split("&");
	for (var i = 0; i < pairs.length; i++) {
		var pos = pairs[i].indexOf('=');
		if (pos >= 0) {
			var argname = pairs[i].substring(0,pos);
			var value = pairs[i].substring(pos+1);
			QueryString.keys[QueryString.keys.length] = argname;
			QueryString.values[QueryString.values.length] = value;
		}
	}
}

function QueryString(key) {
	QueryString_Parse();
	var value = null;
	for (var i = 0; i < QueryString.keys.length; i++) {
		if (QueryString.keys[i] == key) {
			value = QueryString.values[i].toLowerCase();
			break;
		}
	}
	return value;
}
//////////////////////////////////////////////////////////////////////
//Testisnyashellowhatthefuckisthissolongfor</a>

//////////////////////////////////////////////////////////////////////
// FIREFOX word-wrapping function. Pass any DOM object and maxlength.
//////////////////////////////////////////////////////////////////////
function wrapFF(which, atlen) {
	if (navigator.userAgent.toLowerCase().indexOf("firefox") != -1) {
		var start = which.innerHTML;
		var finish = start.substr(0,1);
		var mini = "";
		var inTag = 0;
		var current = 0;
		var next = "";
		while (start.length) {
			mini = start.substr(1,1);
			finish = finish + mini;
			start = start.substring(1, start.length);
			switch (mini) {
				case " ":
					current = 0;
				break;
				case "<":
					inTag = 1;
					current = 0;
				break;
				case ">":
					inTag = 0;
					current = 0;
				break;
				default:
					if (!inTag) {
						current = current + 1;
						next = start.substring(0,Math.min(3,start.length));
						if (current == atlen && (next.indexOf("<") == -1) && (next.indexOf(">") == -1) && (next.indexOf(" ") == -1) ) {
							finish = finish + " ";
							current = 0;
						}
					}
				}
		}
		which.innerHTML = finish;
	}
}
//////////////////////////////////////////////////////////////////////
