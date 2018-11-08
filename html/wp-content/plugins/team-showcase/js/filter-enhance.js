
jQuery.noConflict();
jQuery(document).ready(function(){
	
	jQuery('#ts-all').addClass('ts-current-li');
	jQuery("#ts-enhance-filter-nav > li").click(function(){
	    ts_show_enhance(this.id);
	}).children().click(function(e) {
	  return false;
	});

	jQuery("#ts-enhance-filter-nav > li > ul > li").click(function(){
	    ts_show_enhance(this.id);
	});
});


//FILTER CODE
function ts_show_enhance(category) {	

	if (category == "ts-all") {
        jQuery('#ts-enhance-filter-nav > li').removeClass('ts-current-li');
        jQuery('#ts-all').addClass('ts-current-li');
        jQuery('.tshowcase-filter-active').addClass('ts-current').removeClass('ts-not-current');
		}
	
	else {
		jQuery('#ts-enhance-filter-nav > li').removeClass('ts-current-li');
   		jQuery('#' + category).addClass('ts-current-li');  
		jQuery('.' + category).addClass('ts-current').removeClass('ts-not-current'); 
		jQuery('.tshowcase-filter-active:not(.'+ category+')').addClass('ts-not-current').removeClass('ts-current');
	}
	
}



jQuery(document).ajaxSuccess(function() {
	jQuery('#ts-all').addClass('ts-current-li');
	jQuery("#ts-enhance-filter-nav > li").click(function(){
	    ts_show_enhance(this.id);
	}).children().click(function(e) {
	  return false;
	});

	jQuery("#ts-enhance-filter-nav > li > ul > li").click(function(){
	    ts_show_enhance(this.id);
	});
});