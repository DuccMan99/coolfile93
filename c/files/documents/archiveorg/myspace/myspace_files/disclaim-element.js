function getFrameArea(frame) {
  if(frame.innerWidth) return frame.innerWidth * frame.innerHeight;
  if(frame.document.documentElement && frame.document.documentElement.clientHeight) return frame.document.documentElement.clientWidth * frame.document.documentElement.clientHeight;
  if(frame.document.body) return frame.document.body.clientWidth * frame.document.body.clientHeight;
  return 0;
}

function isLargestFrame() {
	return true;
}

function disclaimElement(element) {
	if(isLargestFrame()) {
		element.style.display="block";
		document.body.insertBefore(element,document.body.firstChild);
	}
}

function disclaimToggle(largest, nonLargest) {
	if(isLargestFrame()) {
		largest.style.display="block";
		nonLargest.style.display="none";
	} else {
		largest.style.display="none";
		nonLargest.style.display="block";
	}
}

