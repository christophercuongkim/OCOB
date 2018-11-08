jQuery.noConflict();

jQuery(document).ready(function($) {

/*-----------------------------------------------------------------------------------*/
/* Course/Faculty Meta Alignment/Adjustment for Overflow/Removal of Options */
/*-----------------------------------------------------------------------------------*/
// $("#section-course-meta > .course-meta:even").addClass("alpha");
// $("#section-course-meta > .course-meta:odd").addClass("omega");

var cm1 = $(".meta-table > .meta-item:nth-child(1)");
var cm2 = $(".meta-table > .meta-item:nth-child(2)");
var cm3 = $(".meta-table > .meta-item:nth-child(3)");
var cm4 = $(".meta-table > .meta-item:nth-child(4)");
var cm5 = $(".meta-table > .meta-item:nth-child(5)");
var cm6 = $(".meta-table > .meta-item:nth-child(6)");
var cm7 = $(".meta-table > .meta-item:nth-child(7)");
var cm8 = $(".meta-table > .meta-item:nth-child(8)");
var cm9 = $(".meta-table > .meta-item:nth-child(9)");
var cm10 = $(".meta-table > .meta-item:nth-child(10)");
var cm11 = $(".meta-table > .meta-item:nth-child(11)");

var cm1c = $(".meta-table > .meta-item:nth-child(1) h5");
var cm2c = $(".meta-table > .meta-item:nth-child(2) h5");
var cm3c = $(".meta-table > .meta-item:nth-child(3) h5");
var cm4c = $(".meta-table > .meta-item:nth-child(4) h5");
var cm5c = $(".meta-table > .meta-item:nth-child(5) h5");
var cm6c = $(".meta-table > .meta-item:nth-child(6) h5");
var cm7c = $(".meta-table > .meta-item:nth-child(7) h5");
var cm8c = $(".meta-table > .meta-item:nth-child(8) h5");
var cm9c = $(".meta-table > .meta-item:nth-child(9) h5");
var cm10c = $(".meta-table > .meta-item:nth-child(10) h5");
var cm11c = $(".meta-table > .meta-item:nth-child(11) h5");

/* Course Meta 1 v 2 */
if (cm1.height() > cm2.height()) {
	cm2.css("height", cm1.height());
	cm2c.css("line-height", "2.3");
}
if (cm1.height() < cm2.height()) {
	cm1.css("height", cm2.height());
	cm1c.css("line-height", "2.3");
}
/* Course Meta 3 v 4 */
if (cm3.height() > cm4.height()) {
	cm4.css("height", cm3.height());
	cm4c.css("line-height", "2.3");
}
if (cm3.height() < cm4.height()) {
	cm3.css("height", cm4.height());
	cm3c.css("line-height", "2.3");
}
/* Course Meta 5 v 6 */
if (cm5.height() > cm6.height()) {
	cm6.css("height", cm5.height());
	cm6c.css("line-height", "2.3");
}
if (cm5.height() < cm6.height()) {
	cm5.css("height", cm6.height());
	cm5c.css("line-height", "2.3");
}
/* Course Meta 7 v 8 */
if (cm7.height() > cm8.height()) {
	cm8.css("height", cm7.height());
	cm8c.css("line-height", "2.3");
}
if (cm7.height() < cm8.height()) {
	cm7.css("height", cm8.height());
	cm7c.css("line-height", "2.3");
}
/* Course Meta 9 v 10 */
if (cm9.height() > cm10.height()) {
	cm10.css("height", cm9.height());
	cm10c.css("line-height", "2.3");
}
if (cm9.height() < cm10.height()) {
	cm9.css("height", cm10.height());
	cm9c.css("line-height", "2.3");
}


/*-----------------------------------------------------------------------------------*/
/* Course Catalog Table Alignment/Adjustment for Overflow/Scrollable Content ( Mobile ) */
/*-----------------------------------------------------------------------------------*/

$(document).ready(function() {
  var switched = false;
  var updateTables = function() {
    if (($(window).width() < 767) && !switched ){
      switched = true;
      $("table.responsive").each(function(i, element) {
        splitTable($(element));
      });
      return true;
    }
    else if (switched && ($(window).width() > 767)) {
      switched = false;
      $("table.responsive").each(function(i, element) {
        unsplitTable($(element));
      });
    }
  };
   
  $(window).load(updateTables);
  $(window).on("redraw",function(){switched=false;updateTables();}); // An event to listen for
  $(window).on("resize", updateTables);
   
	
	function splitTable(original)
	{
		original.wrap("<div class='table-wrapper' />");
		
		var copy = original.clone();
		copy.find("td:not(:nth-child(2)), th:not(:nth-child(2))").css("display", "none");
		copy.removeClass("responsive");
		
		original.closest(".table-wrapper").append(copy);
		copy.wrap("<div class='pinned' />");
		original.wrap("<div class='scrollable' />");

    setCellHeights(original, copy);
	}
	
	function unsplitTable(original) {
    original.closest(".table-wrapper").find(".pinned").remove();
    original.unwrap();
    original.unwrap();
	}

  function setCellHeights(original, copy) {
    var tr = original.find('tr'),
        tr_copy = copy.find('tr'),
        heights = [];

    tr.each(function (index) {
      var self = $(this),
          tx = self.find('th, td');

      tx.each(function () {
        var height = $(this).outerHeight(true);
        heights[index] = heights[index] || 0;
        if (height > heights[index]) heights[index] = height;
      });

    });

    tr_copy.each(function (index) {
      $(this).height(heights[index]);
    });
  }

});

/*-----------------------------------------------------------------------------------*/
/* HOVER IMAGES */
/*-----------------------------------------------------------------------------------*/

/* SET IMAGE DIMENTIONS FOR PAGESPEED GRADE
$(window).resize(function() { // On Window Resize, Reset the size & positioning of the div.
	$(".hover-image .module-image img").each(function(index){ // Select the element divs which has class that starts with some-class- and establish an index to loop through.
		var $this = $(this),
			w = $this.width(), // Width of the image inside .box
				h = $this.height(); // Height of the image inside .box
		$this.width(w).height(h); // Set width and height of .module-image img to match image;
	});
});
 */


if( $("html").hasClass("no-csstransitions") ) {

	$('.pb_transitions').hide();
	$('.pb_transitions .pb_css').remove();

	$(".hover-image .module-inner").each(function(index){ // Select the element divs which has class that starts with some-class- and establish an index to loop through.

		var js_start_height = $(this).find(".start_position").val();
		var js_end_height = $(this).find(".end_position").val();

		$(this).find(".module-content, .module-background").css("height", js_start_height);

		$(".hover-image .module-inner").mouseenter(function(){
			$(this).find($('.module-content, .module-background')).stop(true, false).animate({ "height": js_end_height }, 600, "swing");
			return false;
			});
		$('.hover-image .module-inner').mouseleave(function(){
			$(this).find($('.module-content, .module-background')).stop(true, false).animate({ "height": js_start_height }, 600, "swing");
			return false;
			});


	});

}

else {

	$('.pb_transitions').hide();
	$('.pb_transitions .pb_jquery').remove();

};

    /*-----------------------------------------------------------------------------------*/
    /* FIX HOVER IMAGE MODULE HEIGHT */
    /*-----------------------------------------------------------------------------------*/

    // if( $("html").hasClass("no-csstransitions") ) {
        /* $(".hover-image").each(function(index){ // Select the element divs which has class that starts with some-class- and establish an index to loop through.
            var js_module_image_height = $(this).find(".module-image").height();
            // var js_module_margin_bottom = "1.4rem !important";
            $(this).css("height",js_module_image_height).addClass('jquery-1');
        }); */
    // }
    // else {
    // };


var detached = $('body.woocommerce-account').not('.logged-in').find('#secondary').detach();
$('#section-content .container .sixteen.columns').append(detached);

var detached_sensei = $('body.sensei').not('.logged-in').find('.container > #secondary').detach();
$('#section-content .container .sixteen.columns').append(detached_sensei);



/*-----------------------------------------------------------------------------------*/
/* BACKGROUND MAGIC */
/*-----------------------------------------------------------------------------------*/
// Take the custom BG color & image values for full rows within Visual Composer and add DIVS that break outside of the grid as full-width stripes. 

var arrClasses = [];

$("#primary.sixteen div[class*='vc_custom_'].parallax-vertical").not('.vc_inner').each(function(index){ // Select the element divs which has class that starts with some-class- and establish an index to loop through.
	$(this).addClass('transparent'); // Remove just the BG-color/image from the default DIV.

	var rowHeight = $(this).closest('.vc_row-fluid').outerHeight( true );
	var heightDifference = $(this).outerHeight( ) - $(this).outerHeight( true ); // Find the difference between the layout height and the actual height (with margin, padding, border, etc.)
	var winWidth = $(window).width() * 1.2; // Set this to be a little larger than the window to ensure coverage.
	var winMarginMath = $(window).width() * 0.2; 
	var winMargin = "-" + winMarginMath + "px";
	
    var className = this.className.match(/vc_custom_\d+/); //get a match to match the pattern some-class-somenumber and extract that classname
    if (className) {
        arrClasses.push(className[0]); //if we find anything, push it to the array
        $(this).find(".wpb_wrapper:first").append('<div style="height: '+ rowHeight +'px; width: '+ winWidth +'px; left: '+ winMargin +'; top: '+ heightDifference +'px;" class="custom-bg ' + arrClasses[index] + '"></div>');
        // Add a new DIV in our desired location, apply the new height/classes that we need to based on the index.
    }

});

$(window).resize(function() { // On Window Resize, Reset the size & positioning of the div.
	$(".custom-bg").addClass(function () {

		var rowHeight = $(this).closest('.vc_row-fluid').outerHeight( true );
		var heightDifference = $(this).outerHeight(  ) - $(this).outerHeight( true ); // Find the difference between the layout height and the actual height (with margin, padding, border, etc.)
		var winWidth = $(window).width() * 1.2; // Set this to be a little larger than the window to ensure coverage.
		var winMarginMath = $(window).width() * 0.2; 
		var winMargin = "-" + winMarginMath + "px";
		
		$(this).css({ 'height': rowHeight, 'width': winWidth, 'left': winMargin, 'top': heightDifference });
		return "modified-resized";
	});         
});

$(window).load(function() { // On Window LOAD, Reset the size & positioning of the div. // Fixes chrome staggered loading.
	$(".custom-bg").addClass(function () {

		var rowHeight = $(this).closest('.vc_row-fluid').outerHeight( true );
		var heightDifference = $(this).outerHeight(  ) - $(this).outerHeight( true ); // Find the difference between the layout height and the actual height (with margin, padding, border, etc.)
		var winWidth = $(window).width() * 1.2; // Set this to be a little larger than the window to ensure coverage.
		var winMarginMath = $(window).width() * 0.2; 
		var winMargin = "-" + winMarginMath + "px";
		
		$(this).css({ 'height': rowHeight, 'width': winWidth, 'left': winMargin, 'top': heightDifference });
		return "modified-resized";
	});         
});

// PARALLAX
$window = $(window);                
$('.parallax-vertical .custom-bg').each(function(){
    var $bgobj = $(this); // assigning the object                    
    $(window).scroll(function() {					
		var yPos = $window.scrollTop() / 20;
		var calculatedPosition = ( -(yPos) + 100 ); 	// BG moves against scroll direction
		//var calculatedPosition = ( (yPos) ); 			// BG moves with scroll direction
		var coords = '50% '+ calculatedPosition + '%';
		$( '.custom-bg' ).each(function () {
		    this.style.setProperty( 'background-position', coords, 'important' );
		});		
	}); // window scroll Ends
});





/* Version 1.0 */

/*-----------------------------------------------------------------------------------*/
/* FIT VIDS */
/*-----------------------------------------------------------------------------------*/
$("#section-content").fitVids();


/*-----------------------------------------------------------------------------------*/
/*	DropDown Menu - http://users.tpg.com.au/j_birch/plugins/superfish/
/*-----------------------------------------------------------------------------------*/
$("#course-list > tbody > tr:even").addClass("even");
$("#course-list > tbody > tr:odd").addClass("odd");



/*-----------------------------------------------------------------------------------*/
/*	prettyPhoto Parameters
/*-----------------------------------------------------------------------------------*/

	$("a[data-rel^='lightbox']").prettyPhoto({
		animation_speed: 'fast', /* fast/slow/normal */
		slideshow: 5000, /* false OR interval time in ms */
		autoplay_slideshow: false, /* true/false */
		opacity: 0.80, /* Value between 0 and 1 */
		show_title: true, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		default_width: 1600,
		default_height: 900,
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'pp_default', /* pp_default / light_rounded / dark_rounded / light_square / dark_square / facebook */
		horizontal_padding: 20, /* The padding on each side of the picture */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: true, /* Automatically start videos: True/False */
		modal: false, /* If set to true, only the close button will close the window */
		deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
		overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
		changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
		callback: function(){}, /* Called when prettyPhoto is closed */
		ie6_fallback: true,
		markup: '<div class="pp_pic_holder"> \
					<div class="ppt">&nbsp;</div> \
					<div class="pp_top"> \
						<div class="pp_left"></div> \
						<div class="pp_middle"></div> \
						<div class="pp_right"></div> \
					</div> \
					<div class="pp_content_container"> \
						<div class="pp_left"> \
						<div class="pp_right"> \
							<div class="pp_content"> \
								<div class="pp_loaderIcon"></div> \
								<div class="pp_fade"> \
									<a href="#" class="pp_expand" title="Expand the image">Expand</a> \
									<div class="pp_hoverContainer"> \
										<a class="pp_next" href="#">next</a> \
										<a class="pp_previous" href="#">previous</a> \
									</div> \
									<div id="pp_full_res"></div> \
									<div class="pp_details"> \
										<div class="pp_nav"> \
											<a href="#" class="pp_arrow_previous">Previous</a> \
											<p class="currentTextHolder">0/0</p> \
											<a href="#" class="pp_arrow_next">Next</a> \
										</div> \
										<p class="pp_description"></p> \
										{pp_social} \
										<a class="pp_close" href="#">Close</a> \
									</div> \
								</div> \
							</div> \
						</div> \
						</div> \
					</div> \
					<div class="pp_bottom"> \
						<div class="pp_left"></div> \
						<div class="pp_middle"></div> \
						<div class="pp_right"></div> \
					</div> \
				</div> \
				<div class="pp_overlay"></div>',
		gallery_markup: '<div class="pp_gallery"> \
							<a href="#" class="pp_arrow_previous">Previous</a> \
							<div> \
								<ul> \
									{gallery} \
								</ul> \
							</div> \
							<a href="#" class="pp_arrow_next">Next</a> \
						</div>',
		image_markup: '<img id="fullResImage" src="{path}" />',
		flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
		quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
		iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
		inline_markup: '<div class="pp_inline">{content}</div>',
		custom_markup: '',
		social_tools: '<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>' /* html or false to disable */
	});


/*-----------------------------------------------------------------------------------*/
/*	Isotope - http://isotope.metafizzy.co/
/*-----------------------------------------------------------------------------------*/

if ($(".page-template-template-post-grid")[0]){
	// cache container
	var $container = $('#skeleton-container');
	var $isotope_mode = $("#skeleton-container").attr("data-isotope");

	if ($isotope_mode == 'masonry'){
		// initialize isotope
		$container.isotope({		
		  	itemSelector : '.module',
		  	layoutMode : 'masonry',
		  	transitionDuration: '0.4s',
		});
	} else {
		// initialize isotope
		$container.isotope({		
		  	itemSelector : '.module',
		  	layoutMode : 'fitRows',
		  	transitionDuration: '0.4s',
		});
	}			
		
	// filter items when filter link is clicked
	$('#skeleton-filter a').click(function(){
		var selector = $(this).attr('data-filter');
		$container.isotope({ filter: selector });
		return false;
		});

    // re-rack items after the entire page loads
	    $(window).load(function(){
	        setTimeout(function() {
				    $container.isotope('layout');
				}, 0);
	    });
} else {
    // Do something if class does not exist
}

/*-----------------------------------------------------------------------------------*/
/*	Tophat DropDown
/*-----------------------------------------------------------------------------------*/
//$(document).ready(function(){

   $(".th_slidingDiv").hide();
   $(".th_show_hide").show();

   $('.th_show_hide').toggle(function(){
       $(".th_slidingDiv").slideDown( 500, 'swing',
         function(){
           $("#plus").text("-")
           $(this).addClass("display_block");
         }
       );
   },function(){
       $(".th_slidingDiv").slideUp( 500, 'swing',
       function(){
           $("#plus").text("+")
           $(this).removeClass("display_block");
       }
       );
   });
//}); 

/*-----------------------------------------------------------------------------------*/
/*	Share DropDown
/*-----------------------------------------------------------------------------------*/
//$(document).ready(function(){

   $(".slidingDiv").hide();
   $(".show_hide").show();

   $('.show_hide').toggle(function(){
       $(".slidingDiv").slideDown(
       	300, 'swing'
       );
   },function(){
       $(".slidingDiv").slideUp(
       	300, 'swing'
       );
   });
//}); 



/*-----------------------------------------------------------------------------------*/
/*	Rotation Triggers
/*----------------------------------------------------------------------------------*/

$(".th_show_hide.th_flag_toggle").on("click", function () {
    $(".arrow").toggleClass("rotate");
    $(this).toggleClass("click-color");
});

$(".share").on("click", function () {
    $(this).toggleClass("share-rotate");
});


/*-----------------------------------------------------------------------------------*/
/*	Scrolling Waypoints And Dropdown Header
/*-----------------------------------------------------------------------------------*/

$(function() {

	var nav_container = $("#section-super-header");
	var nav = $("#section-sticky-header");
	var nav_background = $("#section-sticky-header-background");
	var logo = $("#site-heading");
  	var search = $("#section-tophat .right");
	
	var top_spacing = 0;
	var waypoint_offset = nav_container.height() + 100;

	var remove_top_spacing = -71;
	var waypoint_offset_up_before = nav_container.height() + 100;

//Animate navigation dropdown on way down
	nav_container.waypoint({
		handler: function(direction) {
			
			if (direction == 'down') {
			
				nav.stop().addClass("sticky-header").css("top",-nav.outerHeight()).animate({"top":top_spacing}, 0 );
				nav_background.stop().addClass("sticky-header").css("top",-nav.outerHeight()).animate({"top":top_spacing}, 0 );
				
			} else {

			}
			
		},
		offset: function() {
			return -nav.outerHeight()-waypoint_offset;
		}
	});

//Set a fallback for navigation removal on way up
	nav_container.waypoint({
		handler: function(direction) {
			
			if (direction == 'up') {

					nav.stop().removeClass("sticky-header").css("top",nav.outerHeight()+waypoint_offset).animate({"top":remove_top_spacing}, 0 );
					nav_background.stop().removeClass("sticky-header").css("top",nav.outerHeight()+waypoint_offset).animate({"top":remove_top_spacing}, 0 );
				
			} else {

			}
			
		},
		offset: function() {
			return -nav.outerHeight()-waypoint_offset_up_before;
		}
	});
	
});

/*-----------------------------------------------------------------------------------*/
/* BACKUP & DEPRICATED FUNCTIONS */
/*-----------------------------------------------------------------------------------

/* CHECK IF DEVICE IS MOBILE/HANDHELD */
/*
var mobile_string_1 = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i;
var mobile_string_2 = /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i;

var mobile_test_1 = mobile_string_1.test(navigator.userAgent||navigator.vendor||window.opera);
var mobile_test_2 = mobile_string_2.test(navigator.userAgent||navigator.vendor||window.opera);
var mobile_test_both = mobile_test_1 || mobile_test_2;
if(mobile_test_both) {
  // Do something!
  // alert("This is a mobile viewport");

  // Remove Navigation Dropdown for Handheld Devices
  // $("#section-sticky-header").remove();
  // $("#section-sticky-header-background").remove();

}
*/


/* - End Skeleton Key JS - */
});