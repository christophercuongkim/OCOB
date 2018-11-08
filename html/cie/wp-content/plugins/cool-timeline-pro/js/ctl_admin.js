(function($){
	$(document).ready(function(){
		$(".od_preloader").hide();
	jQuery('input[name="clt_story_order"]').keyup(function() {
			var $this = $(this);
			var preloader=$this.attr("data-id");
			$(preloader).show();

			var post_id = $this.attr('data-post-id');
			var order_num = $this.val();
           	var param = {
	   			action: 'ctl_change_story_order',
	   			post_id: post_id,
				order: order_num
	   		};

	   		$.ajax({
	   			type: "post",
	   			url:ajax_object.ajax_url,
	   			dataType: 'json',
	   			data: (param),
	   			success: function(data){
	   				if(data.success){
	   					$(preloader).hide();
	   				return true;
	   				}
	   			}	
	   		});
		});
	});
}(jQuery));