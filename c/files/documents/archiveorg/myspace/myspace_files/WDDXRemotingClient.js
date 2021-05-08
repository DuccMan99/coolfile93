




/*
     FILE ARCHIVED ON 16:30:03 avr. 25, 2006 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 18:44:24 juil. 2, 2014.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*********************************************************************
	UserNodeParser Class
	--------------------
	This class encapsulates the functionality necessary to display 
	dynamic user information on a page using javascript remote 
	scripting.
*********************************************************************/

	/*********************************************************************
	/	WDDX library
	*********************************************************************/
	document.write("<SCRIPT TYPE=\"text\/javascript\" SRC=\"" + javaScriptURL + "/js/wddx.js\"><\/SCRIPT>");
	/********************************************************************/

	/*********************************************************************
	/	Browser detection
	*********************************************************************/
	document.write("<SCRIPT TYPE=\"text\/javascript\" SRC=\"" + javaScriptURL + "/js/browser_detect.js?version=5\"><\/SCRIPT>");
	/********************************************************************/

	/*********************************************************************
		addRequestParameter method
	**********************************************************************
		This method adds parameters to the WDDXRemoting request.  This 
		method is used to pass request data to the server, such as a list 
		of UserID's to retrieve information for.
	*********************************************************************/
	function _WDDXRemotingClient_addRequestParameter(name, value)
	{
		nameValueObject = new Object;
		nameValueObject.name = name;
		nameValueObject.value = value;
		this.requestNameValueArray[this.requestNameValueArray.length] = nameValueObject;
	}
	/********************************************************************/
	
	/*********************************************************************
		sendRequest method
	**********************************************************************
		This method posts a request to the server using a dynamic HTML 
		form and a hidden IFrame element.
	*********************************************************************/
	function _WDDXRemotingClient_sendRequest()
	{
		for (var i=0; i < this.requestNameValueArray.length; i++)
		{
			this.requestURL += "&" + this.requestNameValueArray[i].name + "=" + this.requestNameValueArray[i].value;
		}
		this.requestURL = this.requestURL.replace(/&/, "?");
		
		var IFrameObj = document.getElementById(this.bufferID);
		if (!IFrameObj) return;

		if (browser.isIE)
		{
			IFrameObj.src = this.requestURL;
			return;
		}
		if (IFrameObj.contentDocument)
		{
			IFrameObj.contentDocument.location.replace(this.requestURL);
			return;
		}
		if (IFrameObj.contentWindow)
		{
			IFrameObj.contentWindow.document.location.replace(this.requestURL);
			return;
		}
		IFrameObj.src = this.requestURL;
		return;
	}
	/********************************************************************/
	
	/*********************************************************************
		receiveResponse method
	**********************************************************************
		This method is the callback triggered by the data page when the 
		data page has populated this class's results WddxRecordset.  This 
		method simply passes the results WddxRecordset to the delegate 
		function defined in this class's constructor.
	*********************************************************************/
	function _WDDXRemotingClient_receiveResponse()
	{
		this.callbackFunction(this.results);
	}
	/********************************************************************/
	
	/*********************************************************************
		Constructor
	**********************************************************************
		Instantiates the WDDXRemotingClient object and sets all member 
		variables and references all member methods previously defined.
	*********************************************************************/
	function WDDXRemotingClient(requestURL, callbackFunction, bufferID)
	{
		/* Initialization */
		if (typeof requestID == "undefined")
		{
			requestID = -1;
			remotingClientArray = new Array();
		}
		requestID++;
		remotingClientArray[requestID] = this;
		/* Members. */
		this.requestID = requestID;
		this.bufferID = bufferID;
		this.requestURL = requestURL;
		this.callbackFunction = callbackFunction;
		this.requestNameValueArray = new Array();
		this.results = new WddxRecordset();
		/* Methods. */
		this.addRequestParameter = _WDDXRemotingClient_addRequestParameter;
		this.sendRequest = _WDDXRemotingClient_sendRequest;
		this.receiveResponse = _WDDXRemotingClient_receiveResponse;
	}
	/********************************************************************/

/********************************************************************/
	
