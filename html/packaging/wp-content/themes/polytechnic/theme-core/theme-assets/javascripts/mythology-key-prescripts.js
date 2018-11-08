jQuery(document).ready(function($) {

/*-----------------------------------------------------------------------------------*/
/* REVOLUTION SLIDER */
/*-----------------------------------------------------------------------------------*/

// $(window).load(function() { // On Window LOAD, Reset the size & positioning of the div. // Fixes chrome staggered loading.

	if ($("#primary .entry-content > .vc_row:first-child .wpb_revslider_element").length > 0) {
		
		/* Set Primary Variables */
		var firstChild = $("#primary .entry-content > .vc_row:first-child");
		var headerHeight = $("#section-super-header").height();
		// var contentOffset = 50; // .sixteen.columns padding + .entry-content margin // added to all revolution sliders that are in the first vc_row.
		// var revSlider = $("#primary .entry-content .vc_row:first-child .wpb_revslider_element");

		/* Check if exsists */
		if (firstChild.hasClass( "cover-header" )) {

			/* Set Conditional Variables */
			var offsetTotal = headerHeight /* + contentOffset */;
			var revOffset = "-" + offsetTotal + "px";

			// revSlider.css("margin-top", revOffset);
			firstChild.css("margin-top", revOffset);

			// remove header bgs
			// $("#section-header .stripe_color").css("display", "none");
			$("#section-header .stripe_image").css("display", "none");
		}

	}
// });
  
/* This script is here to load any attributes, classes, or any other DOM level content that our other scripts will be requiring. */

/*-----------------------------------------------------------------------------------*/
/*	Skeleton Post-Grid Module Scripts
/*-----------------------------------------------------------------------------------*/

/* Fix module videos by removing the H/W attributes and allowing CSS to size them */
$('.module iframe').removeAttr('width');
$('.module iframe').removeAttr('height');

/*-----------------------------------------------------------------------------------*/
/* prettyPhoto or rLightbox - http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
/* Change this to rlightbox or prettyPhoto
/*-----------------------------------------------------------------------------------*/
$("a[data-rel^='lightbox']").prettyPhoto();
$("a[rel^='lightbox']").prettyPhoto();

/*-----------------------------------------------------------------------------------*/
/*	ENABLE NICESCROLL
/*-----------------------------------------------------------------------------------*/
// $("html").niceScroll({cursorcolor:"#afafaf", cursorwidth:"10px", cursorminheight: "50", background: "#eeeeee", zindex: "99999"});

$( "#click-menu" ).click(function() {
	$("html #responsive-menu").niceScroll({cursorcolor:"#afafaf", cursorwidth:"10px", cursorminheight: "50", background: "#eeeeee", opacity: "0", zindex: "99999"});
});

/*-----------------------------------------------------------------------------------*/
/* ADD THEME STYLES */
/*-----------------------------------------------------------------------------------*/
	/* EVENTS CALENDER - SEARCH */
	$("#tribe-events-bar #tribe-bar-form").addClass("theme_hook");

	/* STYLES SENSEI */
	$(".sensei .video iframe").addClass("theme_hook");
	$(".sensei .course-container .sensei-course-meta").addClass("theme_hook");
	$(".sensei.single-course .lesson-meta").addClass("theme_hook right");
	$(".course .woo-image").addClass("theme_image");

	/* WORDPRESS */
	$("#page .wp-caption").addClass("theme_image");

});