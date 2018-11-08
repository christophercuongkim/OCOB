
jQuery.each(ts_atts, function (index, value) {
  
  jQuery('#tshowcase_id_'+value['div_id']+' .tshowcase_pager a.tshowcase_previous_page').remove();
  jQuery('#tshowcase_id_'+value['div_id']+' .tshowcase_pager a.tshowcase_next_page').remove();


  jQuery('#tshowcase_id_'+value['div_id']+' .tshowcase_pager a').removeAttr('href').on('click',function(){
	  	
	    value['page'] = jQuery(this).attr('data-page-number');
	    value['action'] = 'tshowcase_shortcode_build';

	    jQuery('#tshowcase_id_'+value['div_id']+' .tshowcase_pager a').removeClass('tshowcase_current_page');
	    jQuery('#tshowcase_id_'+value['div_id']+' .tshowcase_pager a.tshowcase_page[data-page-number="'+value['page']+'"]').addClass('tshowcase_current_page');

		var data = {
				action: 'tshowcase_shortcode_build',
				post: value
			};
	
		jQuery.post(ajax_object.ajax_url, data, function(response) {

			console.log('clicked' + value['div_id']);
			console.log(value);
					
				 jQuery( '#tshowcase_id_'+value['div_id']+' .tshowcase div:first-child' ).first().fadeTo( "slow" , 0.1, function() {
				   jQuery(this).html(response).fadeTo( "slow", 1 );
				  });
				
			});


	  });

});
