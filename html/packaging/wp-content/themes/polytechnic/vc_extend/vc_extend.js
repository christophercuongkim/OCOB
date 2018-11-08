(function($){
$(document).ready(function() {
/*
    $(".module-content").removeClass (function (index, css) {
    return (css.match (/(^|\s)pb_start_\S+/g) || []).join(' ');
});*/


/* VISUAL COMPOSER HELPER FUNCTIONS */

	/* The following are functions focused on ROW COLORS/IMAGES to HELP when the text within a row is the same color as default bg (ie. white on white)
	When VC does finally add this functionality to their core, we'll pull this to support this functionality from their core. To be clear, this is only
	added to HELP and is NOT SUPPORTED as a default/native funciton with theme */
	
	/* GET BG-COLOR FROM ROW CONTROLS - ADD BG-COLOR TO THE ROW */
	window.setTimeout(function() {

	    $('#wpb_visual_composer div.wpb_vc_row.wpb_sortable:has(span.vc_row_color)').each(function(i,elem) {

	        var $bgcol = $(elem).find('span.vc_row_color').css('backgroundColor');
	        var $targetbgcol = $('.wpb_element_wrapper > .vc_container_for_children > div.wpb_vc_column');
	        var $targetbgcol2 = $('.wpb_element_wrapper > .vc_container_for_children .wpb_vc_column .wpb_element_wrapper .vc_container_for_children .wpb_vc_column_text > .wpb_element_wrapper.clearfix');
	        var $targetbgcol3 = $('.wpb_element_wrapper > .vc_container_for_children > div.wpb_vc_column > div');
	        var addbgcol = {'background-color' : $bgcol};
	        var transparentbg = {'background-color' : 'transparent'};

	        $(elem).find($targetbgcol).animate(addbgcol, 500);
	        $(elem).find($targetbgcol2).animate(transparentbg, 500);
	        $(elem).find($targetbgcol3).animate(transparentbg, 500);
	        
	    });

	}, 1000); /* - Ran before image to set default if image if set - */

	/* GET BG-IMAGE FROM ROW CONTROLS - ADD BG-IMAGE TO THE ROW */
	window.setTimeout(function() {

	    $('#wpb_visual_composer div.wpb_vc_row.wpb_sortable:has(span.vc_row_image)').each(function(i,elem) {

	        var bgimg = $(elem).find('span.vc_row_image').css('backgroundImage');
	        var $targetbgimg = $('.wpb_element_wrapper > .vc_container_for_children > div.wpb_vc_column');
	        var $targetbgimg2 = $('.wpb_element_wrapper > .vc_container_for_children .wpb_vc_column .wpb_element_wrapper .vc_container_for_children .wpb_vc_column_text > .wpb_element_wrapper.clearfix');
	        var $targetbgimg3 = $('.wpb_element_wrapper > .vc_container_for_children > div.wpb_vc_column > div');
	        var addbgimg = {'background-image' : bgimg};
	        var addbgimgsize = {'background-size' : '100% auto'};
	        var transparentbg = {'background-color' : 'transparent'};

	        $(elem).find($targetbgimg).css(addbgimg);
	        $(elem).find($targetbgimg).css(addbgimgsize);
	        $(elem).find($targetbgimg2).css(transparentbg);
	        $(elem).find($targetbgimg3).css(transparentbg);
	        
	    });

	}, 3000); /* - Ran after color to superceade color if set - */


/* - End vc_extend.js - */
});

})(jQuery);