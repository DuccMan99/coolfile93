




/*
     FILE ARCHIVED ON 21:07:21 avr. 11, 2006 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 18:44:22 juil. 2, 2014.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
function highlightInterests(IDString)
{
	if (document.getElementById)
	{
		inputString = document.getElementById(IDString).innerHTML;
		
		
		/*
			Delimiters in hex:
			,	\x2C
			(	\x28
			)	\x29
			-	\x2D
			:	\x3A
			;	\x3B
			*	\x2A
			/	\x2F
			\	\x5C
			.	\x2E
			!	\x21
			?	\x3F
			{	\x7B
			}	\x7D
			[	\x5B
			]	\x5D
			+	\x2B
			Control chars in hex:
			<	\x3C
			>	\x3E
		*/
		var HTML = /([\x3C\x3E])/gi;
		var Items = /([^\s\x2C\x28\x29\x2D\x3A\x3B\x2A\x2F\x5C\x2E\x21\x3F\x7B\x7D\x5B\x5D\x2B]+([\s]+[^\s\x2C\x28\x29\x2D\x3A\x3B\x2A\x2F\x5C\x2E\x21\x3F\x7B\x7D\x5B\x5D\x2B]+)*)/g;
		var outputString = inputString;
		if (!HTML.test(outputString) && outputString.indexOf('<z>') == -1)
		{
			outputString = outputString.replace(Items, "<A HREF=\"#\" CLASS=\"searchlinksmall\" onclick=\"executeSearch(this.innerHTML);return false;\">$1</A>");
			document.getElementById(IDString).innerHTML = outputString;
		}
	}
}

function executeSearch(linkRef)
{
	location.href = "/web/20060411210721/http://searchResults.myspace.com/index.cfm?fuseaction=advancedFind.results&websearch=1&spotId=4&SearchType=MySpace&SearchRequest=" + escape(linkRef);
}
