




/*
     FILE ARCHIVED ON 11:14:06 mai 30, 2006 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 18:44:24 juil. 2, 2014.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*********************************************************************
	reverse method
**********************************************************************
	This function returns a string that is a reverse of the current 
	string.
*********************************************************************/
function reverse(inputString)
{
	var outputString = "";
	for (var i = inputString.length - 1; i >= 0; i--) outputString += inputString.charAt(i);
	return outputString;
}
/*********************************************************************/

/*********************************************************************
	left method
**********************************************************************
	This function returns the left-most n characters from a string.
*********************************************************************/
function left(inputString, n)
{
	if (inputString.length > n) return inputString.substring(0, n);
	else return inputString;
}
/*********************************************************************/
		
/*********************************************************************
	right method
**********************************************************************
	This function returns the right-most n characters from a string.
*********************************************************************/
function right(inputString, n)
{
	if (inputString.length > n) return inputString.substring(inputString.length - n);
	else return inputString;
}
/*********************************************************************/

/*********************************************************************
	padLeft method
**********************************************************************
	This function left-pads a string with padCharacter, such that the 
	length of the returned string is stringLength.
*********************************************************************/
function padLeft (inputString, stringLength, padCharacter)
{
	var outputString = inputString;
	var c = padCharacter.substring(0, 1); 
	while (outputString.length < stringLength) outputString = c + outputString;
	return outputString;
};
/*********************************************************************/

/*********************************************************************
	padRight method
**********************************************************************
	This function right-pads a string with padCharacter, such that the 
	length of the returned string is stringLength.
*********************************************************************/
function padRight(inputString, stringLength, padCharacter)
{
	var outputString = inputString;
	var c = padCharacter.substring(0, 1); 
	while (outputString.length < stringLength) outputString = outputString + c;
	return new String(outputString);
};
/*********************************************************************/

