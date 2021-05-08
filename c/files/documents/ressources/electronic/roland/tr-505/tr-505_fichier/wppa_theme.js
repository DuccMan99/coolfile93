// Theme variables and functions
// This is wppa_theme.js version 2.2.0
//

// Style variables

var wppa_bgcolor_even = '';
var wppa_bgcolor_alt = '';
var wppa_bgcolor_nav = '';
var wppa_bgcolor_img = '';
var wppa_bcolor_even = '';
var wppa_bcolor_alt = '';
var wppa_bcolor_nav = '';
var wppa_bwidth = '';
var wppa_bradius = '';
var wppa_fontfamily_title = '';
var wppa_fontsize_title = '';
var wppa_fontfamily_fulldesc = '';
var wppa_fontsize_fulldesc = '';
var wppa_fontfamily_fulltitle = '';
var wppa_fontsize_fulltitle = '';
var wppa_fontfamily_nav = '';
var wppa_fontsize_nav = '';
var wppa_fontfamily_box = '';
var wppa_fontsize_box = '';
var wppa_black = '';

// Adapt style
jQuery(document).ready(function(){
var temp;
	// Background colors
	if (wppa_bgcolor_even != '') jQuery(".wppa-even").css('background-color', wppa_bgcolor_even);
	if (wppa_bgcolor_alt != '') jQuery(".wppa-alt").css('background-color', wppa_bgcolor_alt);
	if (wppa_bgcolor_nav != '') jQuery(".wppa-nav").css('background-color', wppa_bgcolor_nav);
	if (wppa_bgcolor_img != '') jQuery(".wppa-img").css('background-color', wppa_bgcolor_img);
	// Border yes/no
	if (wppa_bwidth != '') {
		temp = parseInt(wppa_bwidth);
		if (temp > 0) {
			jQuery(".wppa-box").css({'border-style': 'solid', 'border-width': temp+'px'});
			jQuery(".wppa-mini-box").css({'border-style': 'solid', 'border-width': parseInt((temp + 2) / 3)+'px'});
		}
	}
	// Border color
	if (wppa_bcolor_even != '') jQuery(".wppa-even").css('border-color', wppa_bcolor_even);
	if (wppa_bcolor_alt != '') jQuery(".wppa-alt").css('border-color', wppa_bcolor_alt);
	if (wppa_bcolor_nav != '') jQuery(".wppa-nav").css('border-color', wppa_bcolor_nav);
	// Border radius
	if (wppa_bradius != '') {
		temp = wppa_bradius+'px';
		jQuery(".wppa-box").css('-moz-border-radius', temp);
		jQuery(".wppa-box").css('-khtml-border-radius', temp);
		jQuery(".wppa-box").css('-webkit-border-radius', temp);
		jQuery(".wppa-box").css('border-radius', temp);
		temp = parseInt((parseInt(wppa_bradius) + 2) / 3)+'px';
		jQuery(".wppa-mini-box").css('-moz-border-radius', temp);
		jQuery(".wppa-mini-box").css('-khtml-border-radius', temp);
		jQuery(".wppa-mini-box").css('-webkit-border-radius', temp);
		jQuery(".wppa-mini-box").css('border-radius', temp);
	}
	// Fonts
	if (wppa_fontfamily_title != '') jQuery(".wppa-title").css('font-family', wppa_fontfamily_title);
	if (wppa_fontsize_title != '') {
		temp = parseInt(wppa_fontsize_title);
		jQuery(".wppa-title").css('font-size', temp+'px');
	}
	if (wppa_fontfamily_fulldesc != '') jQuery(".wppa-fulldesc").css('font-family', wppa_fontfamily_fulldesc);
	if (wppa_fontsize_fulldesc != '') {
		temp = parseInt(wppa_fontsize_fulldesc);
		jQuery(".wppa-fulldesc").css('font-size', temp+'px');
	}
	if (wppa_fontfamily_fulltitle != '') jQuery(".wppa-fulltitle").css('font-family', wppa_fontfamily_fulltitle);
	if (wppa_fontsize_fulltitle != '') {
		temp = parseInt(wppa_fontsize_fulltitle);
		jQuery(".wppa-fulltitle").css('font-size', temp+'px');
	}
	if (wppa_fontfamily_nav != '') jQuery(".wppa-nav-text").css('font-family', wppa_fontfamily_nav);
	if (wppa_fontsize_nav != '') {
		temp = parseInt(wppa_fontsize_nav);
		jQuery(".wppa-nav-text").css('font-size', temp+'px');
	}
	if (wppa_fontfamily_box != '') jQuery(".wppa-box-text").css('font-family', wppa_fontfamily_box);
	if (wppa_fontsize_box != '') {
		temp = parseInt(wppa_fontsize_box);
		jQuery(".wppa-box-text").css('font-size', temp+'px');
	}
	if (wppa_black != '') jQuery(".wppa-black").css('color', wppa_black);
});

// Popup of thumbnail images 
function wppa_popup(mocc, elm, id) {
	var topDivBig, topDivSmall, leftDivBig, leftDivSmall;
	var heightImgBig, heightImgSmall, widthImgBig, widthImgSmall, widthImgBigSpace;
	var puImg;
	
	// Ignore Duplicate call
	if (id == wppa_saved_id[mocc]) return; 
	wppa_saved_id[mocc] = id;
	
	// due to callback bug, see below, we need an extra timer 
	// stop if running 
	clearTimeout(wppa_timer[mocc]);
	
	// Give this' occurrances popup its content 
	jQuery('#wppa-popup-'+mocc).html('<div><div class="wppa-popup" style="background-color:'+wppa_bgcolor_img+'; text-align:center;"><a id="wppa-a" href="'+document.getElementById('a-'+id+'-'+mocc).href+'"><img id="wppa-img-'+mocc+'" src="'+elm.src+'" title="" /></a><div id="wppa-name-'+mocc+'" style="display:none; padding:2px;" class="wppa_pu_info">'+elm.alt+'</div><div id="wppa-desc-'+mocc+'" style="clear:both; display:none;" class="wppa_pu_info">'+elm.title+'</div></div></div>');
	// Find handle to the popup image 
	puImg = document.getElementById('wppa-img-'+mocc);
	// Set width of text fields to width of a landscape image	
	jQuery(".wppa_pu_info").css('width', ((puImg.clientWidth > puImg.clientHeight ? puImg.clientWidth : puImg.clientHeight) - 8)+'px');
	
	// Compute starting coords
	leftDivSmall = parseInt(elm.offsetLeft) - 7 - 5 - 1; // thumbnail_area:padding, wppa-img:padding, wppa-border; jQuery().css("padding") does not work for padding in css file, only when litaral in the tag
	topDivSmall = parseInt(elm.offsetTop) - 7 - 5 - 1;		
	// Compute starting sizes
	widthImgSmall = parseInt(elm.clientWidth);
	heightImgSmall = parseInt(elm.clientHeight);
	// Compute ending sizes
	widthImgBig = puImg.clientWidth; 
	heightImgBig = parseInt(puImg.clientHeight);
	widthImgBigSpace = puImg.clientWidth > puImg.clientHeight ? puImg.clientWidth : puImg.clientHeight;
	// Compute ending coords
	leftDivBig = leftDivSmall - parseInt((widthImgBigSpace - widthImgSmall) / 2);
	topDivBig = topDivSmall - parseInt((heightImgBig - heightImgSmall) / 2);
	
	// Setup starting properties
	jQuery('#wppa-popup-'+mocc).css({"marginLeft":leftDivSmall+"px","marginTop":topDivSmall+"px"});
	jQuery('#wppa-img-'+mocc).css({"width":widthImgSmall+"px","height":heightImgSmall+"px"});
	// Do the animation
	jQuery('#wppa-popup-'+mocc).stop().animate({"marginLeft":leftDivBig+"px","marginTop":topDivBig+"px"}, 400);
	jQuery('#wppa-img-'+mocc).stop().animate({"width":widthImgBig+"px","height":heightImgBig+"px"}, 400);
	// adding ", 'linear', wppa_popready(occ) " fails, therefor our own timer to the "show info" module
	wppa_timer[mocc] = setTimeout('wppa_popready('+mocc+')', 400);
}
function wppa_popready(mocc) {
	jQuery("#wppa-name-"+mocc).show();
	jQuery("#wppa-desc-"+mocc).show();
}
function wppa_popdown(mocc) {	//	return; //debug
	jQuery('#wppa-popup-'+mocc).html("");
	//wppa_saved_id = 0;
}
