jQuery(document).ready(function($){

	ts_build_pager($);

});

function getHashUrlVars(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('#') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function ts_build_pager() {

		var i = 0;
	var sliderarray = new Array();

	while (i <= tspagerparam.count) {

		var teamDiv = jQuery('.tshowcase-pager-wrap');
		teamDiv.fadeIn('slow');

		var start = getHashUrlVars()["t"];
		startslide = 0;
		if(start != '' && start != null){
			startslide = parseInt(start);
		}


	    sliderarray[i] = jQuery('.tshowcase-bxslider-'+i).bxSlider({
	      pagerCustom: '#tshowcase-bx-pager-'+i,
		  controls:false,
		  mode:'fade',
		  //touchEnabled: false,
		  //speed:1,
		  //adaptiveHeight:true,
		  startSlide: startslide
	    });

	    i++;

	    //to hide element on first load
	    //$('.tshowcase-bxslider-0 > li:first-child').hide();

    }


    //Custom click code to make page scroll to preview
    //still not supported

    /*
    jQuery.each(sliderarray, function(index,value) {

			jQuery('#tshowcase-bx-pager-'+index+' a').click(function() {
					jQuery('html, body').animate({
				        scrollTop: jQuery(".tshowcase-bxslider-"+index).offset().top
				    }, 1000);
				});

		});
	*/

     //Custom Hover code. Needs improvement. Still not officially supported
     //speed paramater above should also be uncommented
     

		/*
		
		jQuery.each(sliderarray, function(index,value) {

			jQuery('#tshowcase-bx-pager-'+index+' a').mouseenter(function() {
				var idslide = $(this).attr('data-slide-index');
				value.goToSlide(idslide);
				});

		});
*/


//Custom code to make sticky image
/*

function sticky_relocate() {
				    var window_top = jQuery(window).scrollTop();
				    var div_top = jQuery('.tshowcase-pager-wrap').offset().top;
				    if (window_top > div_top) {
				        jQuery('.ts-pager-box-right ').addClass('ts_stick');
				    } else {
				        jQuery('.ts-pager-box-right ').removeClass('ts_stick');
				    }
				}

				jQuery(function () {
				    jQuery(window).scroll(sticky_relocate);
				    sticky_relocate();
				});

*/
//also needs this to be added to css with custom position:

/*

.ts_stick {
			position: fixed;
		    top: 150px;
		   max-width: 230px;
		}

*/


}


jQuery(document).ajaxSuccess(function($) {

	//ts_build_pager(); 
		
});