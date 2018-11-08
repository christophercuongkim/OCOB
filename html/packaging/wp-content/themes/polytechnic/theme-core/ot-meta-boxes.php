<?php

/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'custom_meta_boxes' );

function custom_meta_boxes() {

$page_options = array(
'id'        => 'page_options',
'title'     => __('Theme: Page Layout Options', 'mythology'),
'desc'      => __('The following options will allow you to customize the page layout.', 'mythology'),
'pages'     => array( 'page' ),
'context'   => 'normal',
'priority'  => 'high',
'fields'    => array(  

  array(
  'label'       => __('Page Layout', 'mythology'),
  'id'          => 'content_layout',
  'type'        => 'radio-image',
  'desc'        => __('Select your page layout.', 'mythology'),
  'std'         => 'default',
  ),
  array(
  'id' => 'show_header',
  'label' => __('Show Page Header?', 'mythology'),     
  'desc' => __('Select "NO" to hide these items (Title, Likes, Views, Sharing, Breadcrumbs) and their options.', 'mythology'),
  'std'         => 'on',
  'type'        => 'on_off',
  ),
  array(
  'id' => 'show_title',
  'label' => __('Show the Title?', 'mythology'),     
  'desc' => __('Select "NO" to hide the page title.', 'mythology'),
  'std'         => 'on',
  'type'        => 'on_off',
  'condition'   => 'show_header:is(on)'
  ),
  array(
        'id' => 'align_title',
        'label' => __('Align the Title', 'mythology'),   
        'desc' => __('Select how you would like to align the title.', 'mythology'),          
        'type' => 'select',         
        'std' => 'left',
        'condition'   => 'show_title:is(on)',
        'class' => '',
          'choices'     => array( 
            array(
              'value'       => 'left',
              'label'       => __('Left', 'mythology'),
            ),
            array(
              'value'       => 'right',
              'label'       => __('Right', 'mythology'),
            ),
            array(
              'value'       => 'center',
              'label'       => __('Center', 'mythology'),
            )
          ),
      ),
   array(
  'id'          => 'show_breadcrumbs',
  'label'       => __('Breadcrumbs?', 'mythology'),
  'desc'        => __('This will display the breadcrumb trail (ie: Page > SubPage > Sub-SubPage).', 'mythology'),
  'std'         => 'off',
  'type'        => 'on_off',
  'condition'   => 'show_header:is(on)'
  ),

  array(
    'id'          => 'show_page_meta',
    'label'       => __('**Show the Page Meta?', 'mythology'),
    'desc'        => __('Select "No" to remove the entire post meta (which may include some of these other options).', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    ),
    array(
    'id'          => 'show_page_by',
    'label'       => __('Show the Author in Meta Section?', 'mythology'),
    'desc'        => __('Select "No" to remove the Author (Note: this is note the Author Box - see below).', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'condition'   => 'show_page_meta:is(on)'
    ),
    array(
    'id'          => 'show_page_date',
    'label'       => __('Show the Date?', 'mythology'),
    'desc'        => __('Select "No" to remove the date.', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'condition'   => 'show_page_meta:is(on)'
    ),
    array(
    'id'          => 'show_page_categories',
    'label'       => __('Show the Categories?', 'mythology'),
    'desc'        => __('Select "No" to remove the category links.', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'condition'   => 'show_page_meta:is(on)'
    ),
    array(
    'id'          => 'show_page_comments_count',
    'label'       => __('Show the Comments Count?', 'mythology'),
    'desc'        => __('Select "No" to remove the comments count.', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'condition'   => 'show_page_meta:is(on)'
    ),
    array(
    'id'          => 'show_page_footer',
    'label'       => __('**Show the Page Footer?', 'mythology'),
    'desc'        => __('Select "No" to remove the entire post meta (which may include some of these other options).', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    ),
    array(
    'id'          => 'show_page_author_box',
    'label'       => __('Show the Author Box?', 'mythology'),
    'desc'        => __('Select "No" to remove the Author Box from the bottom of the posts.', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'condition'   => 'show_page_footer:is(on)'
    ),
    array(
    'id'          => 'show_page_tags',
    'label'       => __('Show the Tags?', 'mythology'),
    'desc'        => __('Select "No" to remove the tag links.', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'section'     => 'post',
    'condition'   => 'show_page_footer:is(on)'
    ),
)
);

$hover_options = array(
'id'        => 'hover_options',
'title'     => __('Theme: Options for Visual Composer Hover Image', 'mythology'),
'desc'      => __('OPTIONAL! Use the provided options to override the default hover effect for this page for all "Theme: Single Image with Hover" modules.', 'mythology'),
'pages'     => array( 'page' ),
'context'   => 'normal',
'priority'  => 'high',
'fields'    => array(
  array(
    'id'          => 'hover_height',
    'label'       => __('Theme: Single Image With Hover - Custom Options', 'mythology'),
    'desc'        => __('Select "YES" to reveal the options provided. These options will change the defaults for all "Theme: Single Image With Hover" for this page and give the capability to change the image hover start/end height.', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'condition'   => ''
    ),
  array(
    'id'          => 'hover_start_height',
    'label'       => __('Hover: Start Position', 'mythology'),
    'desc'        => __('Enter a value (px or %) to change the default hover start height for all "Single Image With Hover" modules for this page. Default is 0.', 'mythology'),
    'std'         => '40px',
    'type'        => 'text',
    'section'     => 'basics',
    'rows'        => '1',
    'condition'   => 'hover_height:is(on)'
    ),
  array(
    'id'          => 'hover_end_height',
    'label'       => __('Hover: End Position', 'mythology'),
    'desc'        => __('Enter a value (px or %) to change the default hover end height for all Theme: Single Image With Hover modules for this page. Defualt is 101%.', 'mythology'),
    'std'         => '101%',
    'type'        => 'text',
    'section'     => 'basics',
    'rows'        => '1',
    'condition'   => 'hover_height:is(on)'
    ),
  array(
    'id'          => 'mobile_hover_height',
    'label'       => __('Mobile Hover Options', 'mythology'),
    'desc'        => __('Select "YES" to reveal the options provided. These options will change the defaults for all "Theme: Single Image With Hover" for this page and give the capability to change the image hover start/end height.', 'mythology'),
    'std'         => 'off',
    'type'        => 'on_off',
    'condition'   => 'hover_height:is(on)'
    ),
  array(
    'id'          => 'mobile_hover_start_height',
    'label'       => __('Mobile: Hover Start Position', 'mythology'),
    'desc'        => __('For all mobile viewports smaller than 540px. Enter a value (px or %) to change the default hover end height for all Theme: Single Image With Hover modules for this page. Defualt is 101%.', 'mythology'),
    'std'         => '0%',
    'type'        => 'text',
    'section'     => 'basics',
    'rows'        => '1',
    'condition'   => 'mobile_hover_height:is(on)'
    ),
  array(
    'id'          => 'mobile_hover_end_height',
    'label'       => __('Mobile: Hover End Position', 'mythology'),
    'desc'        => __('For all mobile viewports smaller than 540px. Enter a value (px or %) to change the default hover end height for all Theme: Single Image With Hover modules for this page. Defualt is 101%.', 'mythology'),
    'std'         => '101%',
    'type'        => 'text',
    'section'     => 'basics',
    'rows'        => '1',
    'condition'   => 'mobile_hover_height:is(on)'
    ),
)
);


/* ================= */


$post_options = array(
'id'        => 'page_options',
'title'     => __('Theme: Post Layout Options', 'mythology'),
'desc'      => __('These options are provided to customize post details', 'mythology'),
'pages'     => array( 'post' ),
'context'   => 'normal',
'priority'  => 'high',
'fields'    => array(

  array(
  'label'       => __('Post Layout', 'mythology'),
  'id'          => 'content_layout',
  'type'        => 'radio-image',
  'desc'        => __('Select your page layout.', 'mythology'),
  'std'         => 'default',
  ),
  array(
    'id'          => 'post_grid_link',
    'label'       => __('Skeleton-Grid : Link', 'mythology'),
    'desc'        => __('If this item shows up in a post grid, should it link to a full post when you click it?', 'mythology'),
    'std'         => 'on',
    'type'        => 'on-off',
  ),
  array(
    'id'          => 'custom_grid_url',
    'label'       => __('Skeleton Grid : Custom Destination URL (Optional)', 'mythology'),
    'desc'        => __('If this item shows up in a post-grid, you can enter a custom URL here to have it direct to another location than this post. If your post-grid is set to open a lightbox, this can be a video or an image URL.', 'mythology'),
    'std'         => '',
    'type'        => 'text',
    'rows'        => '1',
    'condition'   => 'post_grid_link:is(on)'
  ),
  array(
    'id'          => 'custom_post_color',
    'label'       => __('Custom Post Color', 'mythology'),
    'desc'        => __('Select a color if you\'d like to use something other than the theme default on hover.', 'mythology'),
    'std'         => '',
    'type'        => 'colorpicker',
  ),

)
);

$polytechnic_courses_options = array(
'id'        => 'page_options',
'title'     => __('Theme: Courses Layout Options', 'mythology'),
'desc'      => __('These options are provided to customize course details', 'mythology'),
'pages'     => array( 'polytechnic_courses' ),
'context'   => 'normal',
'priority'  => 'high',
'fields'    => array(

  array(
  'label'       => __('Course Layout', 'mythology'),
  'id'          => 'content_layout',
  'type'        => 'radio-image',
  'desc'        => __('Select your page layout.', 'mythology'),
  'std'         => 'default',
  ),

)
);


/* ================= */


  $skeleton_grid_template_options = array(
    'id'        => 'skeleton_grid_template_options',
    'title'     => __('Skeleton Post-Grid Options', 'mythology'),
    'desc'      => __('These options are provided to customize the post-grid template', 'mythology'),
    'pages'     => array( 'page' ),
    'context'   => 'side',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'grid_category_filter',
        'label'       => __('Post Categories to Show', 'mythology'),
        'desc'        => __('Select which categories you would like included in this page.', 'mythology'),
        'type'        => 'category-checkbox',
      ),
      array(
        'id'          => 'show_category_buttons',
        'label'       => __('Filter Buttons', 'mythology'),     
        'desc'        => __('Do you want to display the category buttons at the top for quick sorting?', 'mythology'),          
        'std'         => 'on',
        'type'        => 'on_off',
      ),
      array(
        'id' => 'columns_count',
        'label' => __('How many columns?', 'mythology'),     
        'desc' => __('Select how many columns you\'d like to have.', 'mythology'),          
        'type' => 'select',         
        'std' => 'one-third columns',
        'class' => '',
          'choices'     => array( 
            array(
              'value'       => 'auto',
              'label'       => __('Auto', 'mythology'),
            ),
            array(
              'value'       => 'two columns',
              'label'       => __('8 Columns', 'mythology'),
            ),
            array(
              'value'       => 'four columns',
              'label'       => __('4 Columns', 'mythology'),
            ),
            array(
              'value'       => 'one-third column',
              'label'       => __('3 Columns', 'mythology'),
            ),
            array( 
              'value'       => 'eight columns',
              'label'       => __('2 Columns', 'mythology'),
            )
          ),
      ),
      array(
        'id' => 'isotope_mode',
        'label' => __('Grid Mode', 'mythology'),     
        'desc' => __('This determines how the modules are arranged on the grid.', 'mythology'),          
        'type' => 'select',
        'std' => '',
        'class' => '',
          'choices'     => array( 
            array(
              'value'       => 'masonry',
              'label'       => __('Masonry', 'mythology'),
              'src'         => ''
            ),
            array(
              'value'       => 'fitRows',
              'label'       => __('fitRows', 'mythology'),
              'src'         => ''
            )
          ),
      ),
      array(
        'id'          => 'maintain_aspect_ratio',
        'label'       => __('Original Image Aspect Ratio', 'mythology'),
        'desc'        => __('Setting this to "On" will maintain the original aspect ratio (tall images will be tall, short images will be short). You can enter size limits below to prevent any extra-large images from breaking your layout. <br /><br />If you set this to "Off", the theme will crop your images to the exact width and height that you enter below.', 'mythology'),
        'rows'        => '1',
        'std'         => 'on',
        'type'        => 'on_off'
      ),
      array(
        'id'          => 'uncropped_image_width',
        'label'       => __('Maximum Thumbnail Width', 'mythology'),
        'desc'        => __('Set a limit to how wide images can possibly be. Images thinner than this will ignore this.', 'mythology'),
        'std'         => '400',
        'type'        => 'text',
        'section'     => 'image-settings',
        'rows'        => '1',
        'condition'   => 'maintain_aspect_ratio:is(on)'
      ),
      array(
        'id'          => 'uncropped_image_height',
        'label'       => __('Maximum Thumbnail Height', 'mythology'),
        'desc'        => __('Set a limit to how tall images can possibly be. Images shorter than this will ignore this.', 'mythology'),
        'std'         => '600',
        'type'        => 'text',
        'section'     => 'image-settings',
        'rows'        => '1',
        'condition'   => 'maintain_aspect_ratio:is(on)'
      ),
      array(
        'id'          => 'cropped_image_width',
        'label'       => __('Cropped Thumbnail Width', 'mythology'),
        'desc'        => __('Enter a numeric pixel value (ie: "300"). <br /><br />This will be the largest width allowed when cropping your images to create thumbnails. Images thinner than this will ignore this.', 'mythology'),
        'std'         => '300',
        'type'        => 'text',
        'section'     => 'image-settings',
        'rows'        => '1',
        'condition'   => 'maintain_aspect_ratio:is(off)'
      ),
      array(
        'id'          => 'cropped_image_height',
        'label'       => __('Cropped Thumbnail Height', 'mythology'),
        'desc'        => __('Enter a numeric pixel value (ie: "300"). <br /><br />This will be the largest height allowed when cropping your images to create thumbnails. Images shorter than this will ignore this.', 'mythology'),
        'std'         => '300',
        'type'        => 'text',
        'section'     => 'image-settings',
        'rows'        => '1',
        'condition'   => 'maintain_aspect_ratio:is(off)'
      ),   
      array(
          'id'          => 'open_thumbs_in_lightbox',
          'label'       => __('Open images in a lightbox?', 'mythology'),
          'desc'        => __('Selecting "Yes" will make the post-thumbnails on this page open the full featured-image inside a lightbox.', 'mythology'),
          'std'         => 'on',
          'type'        => 'on_off',
      ),
      array(
        'id'          => 'show_module_content',
        'label'       => __('Display Post Information?', 'mythology'),
        'desc'        => __('Toggle the display of the post content, such as the title, category, and excerpt.', 'mythology'),
        'rows'        => '1',
        'std'         => 'on',
        'type'        => 'on_off'
      ),
      array(
        'id'          => 'show_module_title',
        'label'       => __('Post Title', 'mythology'),
        'desc'        => __('Toggle the display of the post title.', 'mythology'),
        'rows'        => '1',
        'std'         => 'on',
        'type'        => 'on_off',
        'condition'   => 'show_module_content:is(on)'
      ),
      array(
        'id'          => 'show_module_excerpt',
        'label'       => __('Post Excerpt', 'mythology'),
        'desc'        => __('Toggle the display of the post excerpt.', 'mythology'),
        'rows'        => '1',
        'std'         => 'on',
        'type'        => 'on_off',
        'condition'   => 'show_module_content:is(on)'
      ),
      array(
        'id'          => 'show_module_category',
        'label'       => __('Post Category', 'mythology'),
        'desc'        => __('Toggle the display of the post category.', 'mythology'),
        'rows'        => '1',
        'std'         => 'on',
        'type'        => 'on_off',
        'condition'   => 'show_module_content:is(on)'
      ),
      array(
        'id'          => 'show_module_links',
        'label'       => __('Post Links', 'mythology'),
        'desc'        => __('Toggle the display of the post links.', 'mythology'),
        'rows'        => '1',
        'std'         => 'on',
        'type'        => 'on_off',
        'condition'   => 'show_module_content:is(on)'
      ),
      array(
        'id'          => 'portfolio_hover_height',
        'label'       => __('Portfoio Image Hover - Custom Options', 'mythology'),
        'desc'        => __('Select "YES" to reveal the options provided. These options will change the defaults for all "Theme: Single Image With Hover" for this page and give the capability to change the image hover start/end height.', 'mythology'),
        'std'         => 'off',
        'type'        => 'on_off',
        'condition'   => ''
        ),
      array(
        'id'          => 'portfolio_hover_start_height',
        'label'       => __('Portfolio Image - Hover Start', 'mythology'),
        'desc'        => __('Enter a value (px or %) to change the default hover start height (for the portfolio items). Default is 0.', 'mythology'),
        'std'         => '0px',
        'type'        => 'text',
        'section'     => 'basics',
        'rows'        => '1',
        'condition'   => 'portfolio_hover_height:is(on)'
        ),
      array(
        'id'          => 'portfolio_hover_end_height',
        'label'       => __('Portfolio Image - Hover End', 'mythology'),
        'desc'        => __('Enter a value (px or %) to change the default hover end height (for the portfolio items). Defualt is 101%.', 'mythology'),
        'std'         => '101%',
        'type'        => 'text',
        'section'     => 'basics',
        'rows'        => '1',
        'condition'   => 'portfolio_hover_height:is(on)'
        ),
      array(
        'id' => 'grid_post_count',
        'label' => __('Number of posts per page', 'mythology'),      
        'desc' => __('Leave blank to display everything (recommended!). Set a number for how many posts you want to show up per page. ', 'mythology'),         
        'type' => 'text',
      ),
  
    )
  );

/* ================= */


$blog_template_options = array(
'id'        => 'blog_template_options', // Used for the blog template
'title'     => __('Blog Template Options', 'mythology'),
'desc'      => __('These options are provided to customize blog-template', 'mythology'),
'pages'     => array( 'page' ),
'context'   => 'side',
'priority'  => 'high',
'fields'    => array(      

  array(
  'id'          => 'blog_post_type',
  'label'       => __('Display which post types?', 'mythology'),
  'desc'        => __('Select which post types you would like included in this page.', 'mythology'),
  'type'        => 'poly_cpt_checkbox',
  'post_type'   => 'post',
  ),
  array(
    'id'          => 'blog_category_filter_tribe',
    'label'       => __('Display which Event categories?', 'mythology'),
    'desc'        => __('Select which Event categories you would like included in this page.', 'mythology'),
    'type'        => 'taxonomy-checkbox',
    'taxonomy'    => 'tribe_events_cat',
    // 'condition'   => 'blog_post_type:is(tribe_events)',
    ),
  array(
  'id'          => 'blog_category_filter',
  'label'       => __('Display which categories?', 'mythology'),
  'desc'        => __('Select which categories you would like included in this page.', 'mythology'),
  'type'        => 'category-checkbox',
  ),
  array(
  'id' => 'blog_post_count',
  'label' => __('Number of posts per page', 'mythology'),     
  'desc' => __('Leave blank to display everything (recommended!). Set a number for how many posts you want to show up per page. ', 'mythology'),          
  'type' => 'text',
  ),

)
);


// new
if( class_exists( 'WooThemes_Sensei' ) ) {
  $sensei_post_type = array(
              'value'       => 'sensei_courses',
              'label'       => __('Sensei Courses', 'mythology'),
              'src'         => ''
            );
  $sensei_category_filter = array(
    'id'          => 'course_category_filter_sensei',
    'label'       => __('Display which categories?', 'mythology'),
    'desc'        => __('Select which categories you would like included in this page.', 'mythology'),
    'type'        => 'taxonomy-checkbox',
    'taxonomy'    => 'course-category',
    'condition'   => 'catalog_post_type:is(sensei_courses)',
    );
} else {
  $sensei_post_type = null;
  $sensei_category_filter = array(
    'id'          => 'course_category_filter_sensei_none',
    'label'       => __('Display which categories?', 'mythology'),
    'desc'        => __('Select which categories you would like included in this page.', 'mythology'),
    'type'        => 'taxonomy-checkbox',
    'taxonomy'    => 'course-category',
    'class'       => 'hidden',
    'condition'   => 'catalog_post_type:is(sensei_courses)',
    );
}

$course_template_options = array(
'id'        => 'course_template_options', // Used for the course template
'title'     => __('Course Template Options', 'mythology'),
'desc'      => __('These options are provided to customize course catalog template', 'mythology'),
'pages'     => array( 'page' ),
'context'   => 'side',
'priority'  => 'high',
'fields'    => array(      

  array(
      'id' => 'catalog_post_type',
      'label' => __('Post Type', 'mythology'),     
      'desc' => __('This designates the post type to query for.', 'mythology'),          
      'type' => 'select',
      'std' => '',
      'class' => '',
        'choices'     => array(
          array(
            'value'       => 'polytechnic_courses',
            'label'       => __('Polytechinc Courses', 'mythology'),
            'src'         => ''
          ),
          $sensei_post_type,
        ),
    ),

  array(
  'id'          => 'course_category_filter',
  'label'       => __('Display which categories?', 'mythology'),
  'desc'        => __('Select which categories you would like included in this page.', 'mythology'),
  'type'        => 'taxonomy-checkbox',
  'taxonomy'    => 'polytechnic_courses_category',
  'condition'   => 'catalog_post_type:is(polytechnic_courses)',
  ),
  $sensei_category_filter,
  
  array(
  'id' => 'course_post_count',
  'label' => __('Number of courses per page', 'mythology'),      
  'desc' => __('Leave blank to display everything (recommended!). Set a number for how many posts you want to show up per page. ', 'mythology'),         
  'type' => 'text',
  ),
  array(
        'id' => 'course_order_metakey',
        'label' => __('Order By', 'mythology'),     
        'desc' => __('This sets the order by parameter for the query. Note for devs, this actually sets the WP Query "meta_key" and auto sets the "orderby" for strings v. numerical values.', 'mythology'),          
        'type' => 'select',
        'std' => '',
        'class' => '',
          'choices'     => array(
            array(
              'value'       => 'course_unique_id',
              'label'       => __('Course ID', 'mythology'),
              'src'         => ''
            ),
            array(
              'value'       => 'course_number',
              'label'       => __('Course Number', 'mythology'),
              'src'         => ''
            ),
            array(
              'value'       => 'course_name',
              'label'       => __('Course Name', 'mythology'),
              'src'         => ''
            ),
            array(
              'value'       => 'course_author',
              'label'       => __('Course Author', 'mythology'),
              'src'         => ''
            ),
            array(
              'value'       => 'course_room_number',
              'label'       => __('Course Room Number', 'mythology'),
              'src'         => ''
            ),
            array(
              'value'       => 'course_days',
              'label'       => __('Course Day(s)', 'mythology'),
              'src'         => ''
            ),
            array(
              'value'       => 'course_time',
              'label'       => __('Course Time(s)', 'mythology'),
              'src'         => ''
            )

          ),
      ),
  array(
      'id' => 'course_order',
      'label' => __('Order', 'mythology'),     
      'desc' => __('This designates the ascending or descending order of the "orderby" parameter.', 'mythology'),          
      'type' => 'select',
      'std' => '',
      'class' => '',
        'choices'     => array(
          array(
            'value'       => 'ASC',
            'label'       => __('ASC', 'mythology'),
            'src'         => ''
          ),
          array(
            'value'       => 'DESC',
            'label'       => __('DESC', 'mythology'),
            'src'         => ''
          )
        ),
    ),
)
);

// FACULTY GRID OPTIONS
  // get the users
  // $roles = array( 'administrator', 'editor', 'author', 'faculty' );
  // GET USERS WITH FACULTY ROLE ASSIGNED
  $get_user_args = array(
      'blog_id'     => $GLOBALS['blog_id'],
      'role'     => 'faculty',
      'orderby'     => 'login',
      'order'       => 'ASC',
      'count_total' => false,
      'fields'      => 'all'
  );

  $get_users = get_users($get_user_args);
  $user_choices = array();
  foreach( $get_users as $user ){
      $user_choices[] = array('label' => $user->display_name, 'value' => $user->ID);
  }

  // GET ALL USERS OF ALL ROLES
  $get_user_args_full = array(
      'blog_id'     => $GLOBALS['blog_id'],
      'role'        => '',
      'orderby'     => 'login',
      'order'       => 'ASC',
      'count_total' => false,
      'fields'      => 'all'
  );

  $get_users_full = get_users($get_user_args_full);
  $user_choices_full = array();
  foreach( $get_users_full as $user_full ){
      $user_choices_full[] = array('label' => $user_full->display_name, 'value' => $user_full->ID);
  }

$faculty_template_options = array(
'id'        => 'faculty_template_options', // Used for the faculty template
'title'     => __('Faculty Template Options', 'mythology'),
'desc'      => __('These options are provided to customize faculty grid template', 'mythology'),
'pages'     => array( 'page' ),
'context'   => 'side',
'priority'  => 'high',
'fields'    => array(      
  array(
        'id' => 'filter_users_by',
        'label' => __('Filter Faculty By', 'mythology'),   
        'desc' => __('Select how you would like to build the Faculty Grid.', 'mythology'),          
        'type' => 'select',         
        'std' => 'course_categories',
        'condition'   => '',
        'class' => '',
          'choices'     => array( 
            array(
              'value'       => 'manual_user_selection',
              'label'       => __('Manual Faculty Selection', 'mythology'),
            ),
            array(
              'value'       => 'manual_user_selection_full',
              'label'       => __('Manual User Selection', 'mythology'),
            ),
            array(
              'value'       => 'course_categories',
              'label'       => __('Course Categories', 'mythology'),
            )
            
          ),
      ),
  // User Select
  array(
  'id'          => 'user-list',
  'label'       => __('Display Faculty Manually', 'option-tree'),
  'desc'        => __('Select which users (with Faculty role assigned) you would like included in this page.', 'mythology'),
  'std'         => '',
  'type'        => 'checkbox',
  'condition'   => 'filter_users_by:is(manual_user_selection)',
  'choices'     => $user_choices
  ),
  array(
  'id'          => 'user-list-full',
  'label'       => __('Display All Users Manually', 'option-tree'),
  'desc'        => __('Select which users you would like included in this page.', 'mythology'),
  'std'         => '',
  'type'        => 'checkbox',
  'condition'   => 'filter_users_by:is(manual_user_selection_full)',
  'choices'     => $user_choices_full
  ),
  array(
  'id'          => 'faculty_category_filter',
  'label'       => __('Display Faculty by Categories?', 'mythology'),
  'desc'        => __('Select which users you would like included in this page based on the categories of the courses they are associated with.', 'mythology'),
  'type'        => 'taxonomy-checkbox',
  'taxonomy'    => 'polytechnic_courses_category',
  'condition'   => 'filter_users_by:is(course_categories)'
  ),
  array(
  'id'    => 'faculty_email_link',
  'label' => __('Add Mailto Link to Email', 'mythology'),      
  'desc'  => __('Set this to ON to set all user emails to link their emails to mailto.', 'mythology'),   
  'std'   => 'off',      
  'type'  => 'on_off',
  ),

  array(
  'id'    => 'faculty_post_count',
  'label' => __('Number of Users Per Page', 'mythology'),      
  'desc'  => __('Leave blank to display everything (recommended!). Set a number for how many posts you want to show up per page. ', 'mythology'),         
  'type'  => 'text',
  ),

)
);

/* ================= */

ot_register_meta_box( $page_options );
ot_register_meta_box( $post_options );
ot_register_meta_box( $polytechnic_courses_options );
ot_register_meta_box( $blog_template_options );
ot_register_meta_box( $course_template_options );
ot_register_meta_box( $faculty_template_options );
ot_register_meta_box( $skeleton_grid_template_options );

}
?>