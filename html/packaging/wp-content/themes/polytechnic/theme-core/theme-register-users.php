<?php 

/* ---------------------------------------------------------*/
/* REGISTER USERS */ 
/* ---------------------------------------------------------*/
function mythology_register_users() {

	$result = add_role(
	    'faculty',
	    __( 'Faculty', 'mythology' ),
	    array(
	    	//Standard Author Capabilities
	        'delete_posts'         => true,  // true allows this capability
	        'delete_published_posts'   => true, // Use false to explicitly deny
	        'edit_posts' => true,
	        'edit_published_posts' => true,
	        'publish_posts' => true,
	        'read' => true,
            'upload_files' => true,

	        //Custom Faculty Capabilities
	        'edit_pages' => true,
	        'edit_published_pages' => true,
            'edit_private_posts' => true, // This enables the ability to upload to the media library via profile.php
	        
	    )
	);

}
add_action('init', 'mythology_register_users'); /* Run the above function at the init() hook */

/* ---------------------------------------------------------*/
/* ADD BODY CLASS FOR ALL USERS */ 
/* ---------------------------------------------------------*/
function role_admin_body_class( $classes ) {
    global $wpdb, $current_user;

    get_currentuserinfo();

    if (is_super_admin()) {
          $classes .= 'superadmin';
    } else {
          foreach( $current_user->roles as $role ) {
                $classes .= ' role-' . $role;
          }
    }

    return trim( $classes );
}

add_filter( 'admin_body_class', 'role_admin_body_class', 10 );


/* ---------------------------------------------------------*/
/* REMOVE UN-NEEDED MENU ITEMS FOR ROLE-FACULTY USERS */ 
/* ---------------------------------------------------------*/
add_action('admin_head', 'my_custom_faculty_admin');

function my_custom_faculty_admin() {
  print '<style>
  	/* Remove WP-Admin-Bar Options for Faculty Role */
  	.role-faculty li#wp-admin-bar-my-sites,
  	.role-faculty li#wp-admin-bar-comments,
  	.role-faculty li#wp-admin-bar-new-content,
  	.role-faculty li#wp-admin-bar-tribe-events,

  	/* Remove WP-Menu Options for Faculty Role */
  	.role-faculty li#menu-dashboard,
    .role-faculty li#toplevel_page_jetpack,
	.role-faculty li#menu-posts,
	.role-faculty li#menu-posts-tribe_events,
	.role-faculty li#menu-media,
	.role-faculty li#menu-pages,
	.role-faculty li#toplevel_page_wpcf7,
	.role-faculty li#menu-comments,
	.role-faculty li#menu-tools {display: none !important;}
  </style>';
}


/* ---------------------------------------------------------*/
/* Add custom field values */ 
/* ---------------------------------------------------------*/
add_action( 'show_user_profile', 'additional_faculty_fields' );
add_action( 'edit_user_profile', 'additional_faculty_fields' );

function additional_faculty_fields( $user ) { ?>

	<div id="faculty_container">
	    <h3><?php _e( 'Faculty Information', 'mythology' ); ?></h3>
	 
	    <table class="form-table">
	 
	        <tr>
	            <th><label for="faculty_dept_meta"><?php _e( 'College or Department', 'mythology' ); ?></label></th>
	            <td>
	            	<input type="text" name="faculty_dept_meta" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'faculty_dept_meta', $user->ID ) ); ?>" id="faculty_dept" />
	            	<br />
	            	<span class="description">Enter the college(s) or department(s) that you work in. Examples: Business; Business & Communications; College of Business.</span>
	            </td>
	        </tr>

	        <tr>
	            <th><label for="faculty_title_meta"><?php _e( 'Title', 'mythology' ); ?></label></th>
	            <td>
	            	<input type="text" name="faculty_title_meta" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'faculty_title_meta', $user->ID ) ); ?>" id="faculty_title" />
	            	<br />
	            	<span class="description">Enter your title. Examples: Department Chair; Professor & Academic Advisor.</span>
	            </td>
	        </tr>

	        <tr>
	            <th><label for="faculty_specialty_meta"><?php _e( 'Specialty', 'mythology' ); ?></label></th>
	            <td>
	            	<input type="text" name="faculty_specialty_meta" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'faculty_specialty_meta', $user->ID ) ); ?>" id="faculty_specialty" />
	            	<br />
	            	<span class="description">Enter your specialty. Examples: Marketing; Professional Selling, Marketing & International Business.</span>
	            </td>
	        </tr>

	        <tr>
	            <th><label for="faculty_deptphone_meta"><?php _e( 'Department Phone', 'mythology' ); ?></label></th>
	            <td>
	            	<input type="text" name="faculty_deptphone_meta" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'faculty_deptphone_meta', $user->ID ) ); ?>" id="faculty_deptphone" />
	            	<br />
	            	<span class="description">Enter your department phone (this will be displayed). Example: (987) 654-3210; (987) 654-3210 Ext. 5150</span>
	            </td>
	        </tr>
	 
	    </table>
	</div>
<?php }


/* ---------------------------------------------------------*/
/* // Add custom field values */
/* ---------------------------------------------------------*/
add_action( 'personal_options_update', 'save_additional_faculty_fields' );
add_action( 'edit_user_profile_update', 'save_additional_faculty_fields' );

function save_additional_faculty_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste these lines for additional fields. */
	update_user_meta( $user_id, 'faculty_dept_meta', $_POST['faculty_dept_meta'] );
	update_user_meta( $user_id, 'faculty_title_meta', $_POST['faculty_title_meta'] );
	update_user_meta( $user_id, 'faculty_specialty_meta', $_POST['faculty_specialty_meta'] );
	update_user_meta( $user_id, 'faculty_deptphone_meta', $_POST['faculty_deptphone_meta'] );
}



/* ---------------------------------------------------------*/
/* // ADD ALL USERS TO POST AUTHOR DROPDOWN */
/* ---------------------------------------------------------*/

// Filter & Add Post Author to Author Dropdown For Posts
add_filter('wp_dropdown_users', 'theme_post_author_override');
function theme_post_author_override($output)
{
	global $post, $user_ID;
  // return if this isn't the theme author override dropdown
  if (!preg_match('/post_author_override/', $output)) return $output;

  // return if we've already replaced the list (end recursion)
  if (preg_match ('/post_author_override_replaced/', $output)) return $output;

  // replacement call to wp_dropdown_users
	$output = wp_dropdown_users(array(
	  'echo' => 0,
		'name' => 'post_author_override_replaced',
		'selected' => empty($post->ID) ? $user_ID : $post->post_author,
		'include_selected' => true
	));

	// put the original name back
	$output = preg_replace('/post_author_override_replaced/', 'post_author_override', $output);

  return $output;
}


?>