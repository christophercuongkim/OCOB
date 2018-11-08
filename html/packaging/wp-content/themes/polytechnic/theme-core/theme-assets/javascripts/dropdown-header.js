$(function() {

	var nav_container = $("#section-navigation");
	var nav = $("#section-navigation .container");
	var logo = $("#site-heading");
  	var search = $(".sf_container");
	
	var top_spacing = 0;
	var waypoint_offset = 61;

	var remove_top_spacing = -61;
	//var waypoint_offset_up = 66;


	nav_container.waypoint({
		handler: function(direction) {
			
			if (direction == 'down') {
			
				nav_container.css({ 'height':'61px' });		
				nav.stop().addClass("sticky").css("top",-nav.outerHeight()).animate({"top":top_spacing});

				logo.stop().addClass("sticky").css("top",-nav.outerHeight()).animate({"top":top_spacing});
				search.stop().addClass("sticky").css("top",-nav.outerHeight()).animate({"top":top_spacing});
				
			} else {

				nav.animate(1000, function(){
				    nav_container.css({ 'height':'auto' });

					nav.stop().removeClass("sticky").css("top",nav.outerHeight()+waypoint_offset).animate({"top":""});

					logo.stop().removeClass("sticky").css("top",nav.outerHeight()+waypoint_offset).animate({"top":remove_top_spacing});
					search.stop().removeClass("sticky").css("top",nav.outerHeight()+waypoint_offset).animate({"top":remove_top_spacing});
				})

				//nav.stop().removeClass("sticky").css("top",nav.outerHeight()+waypoint_offset).animate({"top":remove_top_spacing});
				//logo.stop().removeClass("sticky").css("top",nav.outerHeight()+waypoint_offset).animate({"top":remove_top_spacing});
				//search.stop().removeClass("sticky").css("top",nav.outerHeight()+waypoint_offset).animate({"top":remove_top_spacing});
			}
			
		},
		offset: function() {
			return -nav.outerHeight()-waypoint_offset;
		}
	});
});