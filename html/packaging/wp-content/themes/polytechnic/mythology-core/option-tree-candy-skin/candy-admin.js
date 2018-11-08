(function($){
$(document).ready(function() {

    // BLOG OPTIONS
        // BLOG CHECKBOX CLICK/CHECK

            // POST
            if ($('#blog_post_type-post').prop('checked')) {
                $('#setting_blog_category_filter').show();
            } else {
                $('#setting_blog_category_filter').hide();
            }
            $('#blog_post_type-post').click(function(){
                if ($('#blog_post_type-post').prop('checked')) {
                    $('#setting_blog_category_filter').show();
                } else {
                    $('#setting_blog_category_filter').hide();
                }
              });

            // TRIBE EVENT
            if ($('#blog_post_type-tribe_events').prop('checked')) {
                $('#setting_blog_category_filter_tribe').show();
            } else {
                $('#setting_blog_category_filter_tribe').hide();
            }
            $('#blog_post_type-tribe_events').click(function(){
                if ($('#blog_post_type-tribe_events').prop('checked')) {
                    $('#setting_blog_category_filter_tribe').show();
                } else {
                    $('#setting_blog_category_filter_tribe').hide();
                }
              });

    // HIDE ALL UNSUPPORTED POST TYPES
    $('[id^="blog_post_type-"]').parents('p').hide();
    $('[id^="blog_post_type-"]').hide();
    $('[for^="blog_post_type-"]').hide();

    // HIDE SUPPORTED POST TYPES (POST)
    $('[id^="blog_post_type-post"]').parents('p').show();
    $('[id^="blog_post_type-post"]').show();
    $('[for^="blog_post_type-post"]').show();

    // HIDE SUPPORTED POST TYPES (TRIBE EVENTS)
    $('[id^="blog_post_type-tribe_events"]').parents('p').show();
    $('[id^="blog_post_type-tribe_events"]').show();
    $('[for^="blog_post_type-tribe_events"]').show();

	// ===========================    
    // Meta-Boxes Switcher 
    // Set the page-template [select] field to toggle which meta-box shows up
    // ===========================	
	$('div#blog_template_options').hide();
    $('#page_template').change(function() {
        $('#blog_template_options').toggle($(this).val() == 'template-blog.php');
    }).change();

    // ===========================    
    // Meta-Boxes Switcher 
    // Set the page-template [select] field to toggle which meta-box shows up
    // ===========================  
    $('div#course_template_options').hide();
    $('#page_template').change(function() {
        $('#course_template_options').toggle($(this).val() == 'template-course-catalog.php');
    }).change();

    // ===========================    
    // Meta-Boxes Switcher 
    // Set the page-template [select] field to toggle which meta-box shows up
    // ===========================  
    $('div#faculty_template_options').hide();
    $('#page_template').change(function() {
        $('#faculty_template_options').toggle($(this).val() == 'template-faculty-grid.php');
    }).change();

    // ===========================    
    // Meta-Boxes Switcher 
    // Set the page-template [select] field to toggle which meta-box shows up
    // ===========================  
    $('div#member_template_options').hide();
    $('#page_template').change(function() {
        $('#member_template_options').toggle($(this).val() == 'template-member-grid.php');
    }).change();

    // ===========================    
    // Meta-Boxes Switcher 
    // Set the page-template [select] field to toggle which meta-box shows up
    // ===========================  
    $('div#skeleton_grid_template_options').hide();
    $('#page_template').change(function() {
        $('#skeleton_grid_template_options').toggle($(this).val() == 'template-post-grid.php');
    }).change();

    		  
    // ===========================    
    // OptionTree Accordion Script
    // ===========================    

    // Hide all descriptions for OptionTree (setting)
    $('.format-setting .description').hide();
    
    // Show the main heading descriptions ONLY
    $('.appearance_page_ot-theme-options .type-textblock.titled .description').show();
    $('.list-sub-setting .description').show();
    $('.toplevel_page_ot-settings .description').show();
    $('.optiontree_page_ot-documentation .description').show();

    $('#setting_customscripts .description').show();
    $('#setting_customcss .description').show();
    
    // Now set the accordion script - when you click the option-module's heading, the description opens.
    $('.appearance_page_ot-theme-options .format-setting-label').each(function(){
	  var $content = $(this).closest('.format-settings').find('.format-setting .description');
	  $(this).click(function(e){
	    e.preventDefault();
	    $content.not(':animated').slideToggle(200);
	  });
	});

    $('.post-php .format-setting-label').each(function(){
      var $content = $(this).closest('.format-settings').find('.format-setting .description');
      $(this).click(function(e){
        e.preventDefault();
        $content.not(':animated').slideToggle(200);
      });
    });

    $('.post-new-php .format-setting-label').each(function(){
      var $content = $(this).closest('.format-settings').find('.format-setting .description');
      $(this).click(function(e){
        e.preventDefault();
        $content.not(':animated').slideToggle(200);
      });
    });
  
});

})(jQuery);