
jQuery.noConflict();

jQuery( document ).ready(function() {

	jQuery('#ts-all').addClass('ts-current-li');
	jQuery("#ts-filter-nav > li").click(function(){
	    ts_show(this.id);
	}).children().click(function(e) {
	  return false;
	});

	jQuery("#ts-filter-nav > li > ul > li").click(function(){
	    ts_show(this.id);
	});

	//Load specific category via url hash

	var start_filter = ts_get_hash()["show"];
	if(start_filter!='') {
		jQuery('#'+start_filter).click();
		
	}

});

//In case you want all entries to hide when the page loads
//jQuery('.ts-05_project-5').hide();	
//To load a particular category
//jQuery('#ts-01-sales-team').click();
//jQuery('#ts-id-3').click();



//FILTER CODE
function ts_show(category) {	 

	//console.log(category);
	
	if (category == "ts-all") {
        jQuery('#ts-filter-nav li').removeClass('ts-current-li');
        jQuery('#ts-all').addClass('ts-current-li');
        jQuery('.tshowcase-filter-active').show(1600,'easeInOutExpo');
		}
	
	else {
		jQuery('#ts-filter-nav li').removeClass('ts-current-li');
   		jQuery('#' + category).addClass('ts-current-li');
   		if(jQuery('#' + category).parent().parent().is('li')) {
   			jQuery('#' + category).parent().parent().addClass('ts-current-li');
   		} 
		jQuery('.' + category).show(1600,'easeInOutExpo');
		jQuery('.tshowcase-filter-active:not(.'+ category+')').hide(1000,'easeInOutExpo');

		//to display first entry on pager layouts
		jQuery('.tshowcase-pager-wrap .' + category + ' a').click();
			
	}

	//hack to solve menu left open on touch devices
	/*

		jQuery('ul li ul li.ts-current-li')
		.parent()
		.hide()
		.parent()
		.on('click', function(){ 
			jQuery(this).addClass('ts-current-li')
			.children().show(); 
		});

	*/
}


jQuery(document).ajaxSuccess(function() {
  
	jQuery('#ts-all').addClass('ts-current-li');
	jQuery("#ts-filter-nav > li").click(function(){
	    ts_show(this.id);
	}).children().click(function(e) {
	  return false;
	});

	jQuery("#ts-filter-nav > li > ul > li").click(function(){
	    ts_show(this.id);
	});
});





function ts_get_hash(){
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

