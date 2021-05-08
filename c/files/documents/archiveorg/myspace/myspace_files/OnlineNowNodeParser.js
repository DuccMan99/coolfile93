




/*
     FILE ARCHIVED ON 20:25:15 avr. 11, 2006 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 18:44:23 juil. 2, 2014.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*********************************************************************
	OnlineNowNodeParser Class
	--------------------
	This class encapsulates the functionality necessary to display 
	dynamic online now information on a page using javascript remote 
	scripting.
*********************************************************************/

	/*********************************************************************
		String extension library
	*********************************************************************/
	document.write("<SCRIPT TYPE=\"text\/javascript\" SRC=\"" + javaScriptURL + "/js/String.js\"><\/SCRIPT>");
	/*********************************************************************
		WDDXRemotingClient library
	*********************************************************************/
	document.write("<SCRIPT TYPE=\"text\/javascript\" SRC=\"" + javaScriptURL + "/js/WDDXRemotingClient.js?version=9\"><\/SCRIPT>");
	/********************************************************************/
	
	/*********************************************************************
		locateNodes method
	**********************************************************************
		This method locates our custom user information nodes, which are 
		HTML SPAN tags with custom parameters embedded in the class 
		parameter.  This method identifies and marks these span nodes.
	*********************************************************************/
	function _OnlineNowNodeParser_locateNodes()
	{
		var CurrentNode = null;
		var i = 0;
		while ((CurrentNode = document.getElementById("UserDataNode" + i)) != null)
		{
			NodeIndex = this.NodeArray.length;
			this.NodeArray[NodeIndex] = new Object();
			this.NodeArray[NodeIndex].NodeID = CurrentNode.id;
			var Attributes = CurrentNode.className.split(";");
			for (var AttributeIterator = 0; AttributeIterator < Attributes.length; AttributeIterator++)
			{
				var Name = Attributes[AttributeIterator].split("=")[0];
				var Value = Attributes[AttributeIterator].split("=")[1];
				if (Name != "" && Value != "") eval("this.NodeArray[" + NodeIndex + "]." + Name + "=\"" + Value + "\";");
			}			
			i++;
		}
	}
	/********************************************************************/
	
	/*********************************************************************
		run method
	**********************************************************************
		This method identifies our special user DOM elements, builds a 
		list of distinct user ID's, and submits them to the server.  This 
		method should be called at the bottom of every page.
	*********************************************************************/
	function _OnlineNowNodeParser_run()
	{
		this.locateNodes();	
		var UserIDList = "";
		if (this.NodeArray.length > 0)
		{
			for (var i=0; i < this.NodeArray.length; i++)
			{
				if (UserIDList.indexOf(":" + this.NodeArray[i].UserID + ":") == -1) UserIDList += ":" + this.NodeArray[i].UserID + ":,";
			}
			UserIDList = UserIDList.replace(/[:]/g, "").replace(/[,]$/gi, "");
			this.remotingClient.addRequestParameter("UserIDList", UserIDList);
			this.remotingClient.sendRequest();
		}
	}
	/********************************************************************/
	
	/*********************************************************************
		processResults method
	**********************************************************************
		This method is the delegate to the WDDXRemotingClient.  This 
		method is called by the WDDXRemotingClient when the remote call 
		to the server returns.  This method parses the WddxRecordset 
		"Results" into an optimized array format, then uses that new 
		array to replace all special user nodes in the DOM with the 
		appropriate information.
	*********************************************************************/
	function _OnlineNowNodeParser_processResults(Results)
	{
		if (Results.getRowCount() > 0)
		{
			for (var i = 0; i < Results.getRowCount(); i++)
			{
				var UserObject = new Object();
				UserObject.UserID = Results["userid"][i];
				UserObject.OnlineNow = Results["onlinenow"][i];
				var ThisUserID = "" + Results["userid"][i];
				this.UserArray[ThisUserID] = UserObject;
			}
			for (var i = 0; i < this.NodeArray.length; i++)
			{
				var ThisUserID = "" + this.NodeArray[i].UserID;
				this.replaceUserNode(i, ThisUserID);
			}
		}
	}
	/********************************************************************/
	
	/*********************************************************************
		replaceUserNode method
	**********************************************************************
		This method replaces the special DOM user nodes with the 
		appropriate user information.  The parameters of the method are 
		the indices into the NodeArray and UserIndex member arrays, 
		respectively.  The NodeArray variable stores a referance to all
		DOM nodes to replace, and the UserArray variable is a collection 
		of user objects indexed by UserID.
	*********************************************************************/
	function _OnlineNowNodeParser_replaceUserNode(NodeIndex, UserIndex)
	{
		var NodeObject = this.NodeArray[NodeIndex];
		var UserObject = this.UserArray[UserIndex];
	
		var ThisNode = document.getElementById(NodeObject.NodeID)
		if (ThisNode)
		{
			if (typeof UserObject != "object")
			{
				UserObject = new Object();
				UserObject.UserID = -1;
				UserObject.FirstName = "Unknown User";
				UserObject.ImageID = -1;
				UserObject.ImageType = "";
				UserObject.LastLogin = "";
				UserObject.OnlineNow = 0;
			}
			switch (NodeObject.DataPoint.toLowerCase())
			{
				case "onlinenow":
				{
					var OnlineImageURL = ImageStore[0].url + "/site/images/clear.gif";
					if (UserObject.OnlineNow == 1) OnlineImageURL = ImageStore[0].url + "/site/images/onlinenow.gif";
					ThisNode.innerHTML = "<IMG BORDER=\"0\" SRC=\"" + OnlineImageURL + "\" WIDTH=\"80\" HEIGHT=\"20\">";
					break;
				}
			}
		}
	}
	/********************************************************************/
	
	/*********************************************************************
		Constructor
	**********************************************************************
		Instantiates the OnlineNowNodeParser object and sets all member 
		variables and references all member methods previously defined.
	*********************************************************************/
	function OnlineNowNodeParser(bufferID)
	{
		/* Members. */
		this.UserArray = new Array();
		this.NodeArray = new Array();
		this.requestURL = onlineNowInfoURL;
		/* Methods. */
		this.run = _OnlineNowNodeParser_run;
		this.locateNodes = _OnlineNowNodeParser_locateNodes;
		this.replaceUserNode = _OnlineNowNodeParser_replaceUserNode;
		this.processResults = _OnlineNowNodeParser_processResults;
		/* Remoting Client Initialization. */
		var me = this;
		var CallbackFunction = function(Results) {me.processResults(Results);};
		this.remotingClient = new WDDXRemotingClient(this.requestURL, CallbackFunction, bufferID);
	}
	/********************************************************************/

/********************************************************************/

