<?php
/*
 * Template Name: Faculty Grid
*/

global $template_file;

// Set the columns class for each module.
if(get_custom_field('columns_count') != '') : 
	$columns = get_custom_field('columns_count');
else : 
	$columns = "four columns";
endif;

get_header(); ?>

<!-- ============================================== -->

	<div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?> course-catalog">		

		<!-- PAGE HEADER -->
		<?php if(get_custom_field('show_header') == 'on' OR get_custom_field('show_header') == 'Yes' ) : ?>
		<div id="page-header">

			<!-- Page Title -->
			<?php if(get_custom_field('show_title') == 'on' OR get_custom_field('show_title') == 'Yes' ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php endif; ?>
			
			<!-- Page Breadcrumbs -->
			<?php if(get_custom_field('show_breadcrumbs') == 'on' OR get_custom_field('show_breadcrumbs') == 'Yes' ) : ?>
			<div class="breadcrumbs">
				<?php print mythology_breadcrumbs(); ?><br />
			</div>
			<?php endif; ?>

			<hr class="title"/>
		</div>
		<?php endif; ?>
		<!-- End Page Header -->

		<!-- Meta -->
		<?php if(get_custom_field('show_page_meta') == "on" ) : ?>

			<div class="theme_hook meta-string sixteen columns page-meta">
				<span class="format-icon"><i class="gen-enclosed foundicon-page" title="Standard Page"></i></span>
				
				<?php // AUTHOR ?>
				<?php if(get_custom_field('show_page_by') == "on" ) : ?>
					<div class="entry-meta-item columns">
						<span class="bullet"><i aria-hidden="true" data-icon="&#xe600;"></i></span>
						<span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span>
					</div>
				<?php else : ?>
					<!-- hAtom Requirement - Author -->
					<span class="vcard author"><span class="fn"></span></span>
				<?php endif; ?>

				<?php // DATE ?>
				<?php if(get_custom_field('show_page_date') == "on" ) : ?>
					<div class="entry-meta-item columns">
						<span class="bullet"><i aria-hidden="true" data-icon="&#xe616;"></i></span>					
						<span class="date updated"><?php the_modified_date('F j, Y'); ?></span>
					</div>
				<?php else : ?>
					<!-- hAtom Requirement - Date -->
					<span class="date updated"></span>
				<?php endif; ?>

				<?php // CATEGORIES ?>
				<?php if(get_custom_field('show_page_categories') == "on" ) : ?>
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'mythology' ) );
						if ( $categories_list && mythology_categorized_blog() ) :
					?>
					<div class="entry-meta-item columns">
						<span class="bullet"><i aria-hidden="true" data-icon="&#xe60e;"></i></span>	
						<span class="cat-links">
							<?php printf( __( '%1$s', 'mythology' ), $categories_list ); ?>
						</span>
					</div>
					<?php endif; // End if categories ?>
				<?php endif; ?>

				<?php // COMMENT COUNT ?>
				<?php if(get_custom_field('show_page_comments_count') == "on" ) : ?>
					<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
						<div class="entry-meta-item columns">
							<span class="bullet"><i aria-hidden="true" data-icon="&#xe611;"></i></span>	
							<span class=""><?php comments_popup_link( __( 'Leave a comment', 'mythology' ), __( '1 Comment', 'mythology' ), __( '% Comments', 'mythology' ) ); ?></span>
						</div>
					<?php endif; ?>
				<?php endif; ?>

			</div>

		<?php endif; ?>
		<!-- /End Meta -->

		<!-- hAtom Checks -->
		<?php if ( ( get_custom_field('show_page_meta') != "on" ) ) : ?>
			<div class="microformats-container">
				<!-- hAtom Requirement - Author -->
				<span class="vcard author"><span class="fn"></span></span>
				<!-- hAtom Requirement - Date -->
				<span class="date updated"></span>
			</div>
		<?php endif; ?>
		<!-- /End hAtom Checks -->

		<!-- PAGE CONTENT -->
		<div class="page-content clearfix">
			<?php while ( have_posts() ) : the_post(); if($post->post_content != "") : ?>	
				<?php the_content(); ?>
			<?php endif; endwhile; ?>	
		</div>
	

		<!-- ============================================== -->		

	
		<!-- PAGE CONTENT -->
		<main id="main" class="site-main course-catalog" role="main">

			<div class="faculty-section sixteen columns alpha omega">
			
				<?php if(class_exists('AJAXY_SF_WIDGET')) :
					get_search_form();
				else : ?>			
					<?php get_template_part( 'includes/element', 'searchform' ); ?>
				<?php endif; ?>		
				
				<!-- THE POST QUERY -->
				<!-- This one's special because it'll look for our category filter and apply some magic -->
				<?php wp_reset_query(); ?>

				<?php

				global $paged;
				global $post_count;
				global $cat_string;
				global $format;
				global $user_email_link;

				if( get_post_custom_values('faculty_post_count') ) :  
					$post_array = get_post_custom_values('faculty_post_count');
					$post_count = join(',', $post_array);
				else : 
					$post_count = -1;
				endif;

				/* Get CUSTOM TAXONOMY (category in this case) */
				if(get_custom_field( 'faculty_category_filter' )) :
					$cats = get_custom_field( 'faculty_category_filter' );

					// SET CAT_STRING
					 foreach ( $cats as $cat ) {
						$acats[] = $cat;		
					 }
					 $cat_string = join(',', $acats);
				endif; 

				if (get_custom_field("faculty_email_link")) :
					$user_email_link = get_custom_field("faculty_email_link");
				else :
					$user_email_link = null;
				endif;



				// START MANUAL FACULTY USER SELECTION
				if(get_custom_field( 'filter_users_by' ) == 'manual_user_selection') :
					
					/* Get CUSTOM USER LIST (category in this case) */
					if(get_custom_field( 'user-list' )) :
						$users = get_custom_field( 'user-list' );

						// SET CAT_STRING
						 foreach ( $users as $user ) {
							$ausers[] = $user;		
						 }
						 $user_string = join(',', $ausers);
					endif; 

					$get_user_args = array(
					    'blog_id'     => $GLOBALS['blog_id'],
					    'role_in'        => 'administrator', 'editor', 'author', 'faculty',
					    'orderby'     => 'display_name',
					    'order'       => 'ASC',
					    'count_total' => false,
					    'include'      => $user_string
					);

					// Create the WP_User_Query object
					$wp_user_query = new WP_User_Query($get_user_args);
					$includeusers = $wp_user_query->get_results();

					// var_dump($includeusers);

					if (!empty($includeusers))
					{
					    // loop trough each author
					    foreach ($includeusers as $includeuser) { ?>

					        <div class="faculty-module widget alpha omega theme_hook">

								<div class="faculty-avatar two columns alpha">
									<?php
									// Retrieve The Post's Author ID
									$includeuser_ID = $includeuser->ID;
									// Set the image size. Accepts all registered images sizes and array(int, int)
									$size = 'faculty-thumbnail';
									// Get the image URL using the author ID and image size params
									if (get_cupp_meta( $includeuser_ID, $size )):
									$imgURL = get_cupp_meta($includeuser_ID, $size);
									else : 
									$imgURL = WP_THEME_URL . '/theme-core/theme-assets/images/default-author-image.jpg';
									endif;
									?>
									<!-- Print the image on the page -->
									<img class="theme_image" src="<?php echo esc_url ( $imgURL );?>"/>
								</div>

								<div class="faculty-name four columns">

									<div class="faculty-name">
										<h3><a href="<?php echo esc_url( get_author_posts_url( $includeuser_ID ) ); ?>"><?php echo esc_html( $includeuser->display_name); ?></a></h3>
									</div>
									<div class="faculty-title entry-title-meta">
										<span><?php echo esc_html( $includeuser->faculty_title_meta ); ?></span>
									</div>

								</div>

								<div class="faculty-contact six columns">

									<div class="faculty-email">
										<h5><?php _e( 'Contact Email', 'mythology' ); ?>:</h5>
										<span>
											<?php if ( $user_email_link == "on" ) : ?>
												<a href="mailto:<?php echo esc_html( $includeuser->user_email ); ?>">
													<?php echo esc_html( $includeuser->user_email ); ?>
												</a>
											<?php else : ?>
												<?php echo esc_html( $includeuser->user_email ); ?>
											<?php endif; ?>
										</span>
									</div>
								</div>

								<div class="faculty-contact four columns omega">
									<div class="faculty-phone">
										<h5><?php _e( 'Contact Phone', 'mythology' ); ?>:</h5>
										<span><?php echo esc_html( $includeuser->faculty_deptphone_meta ); ?></span>
									</div>

								</div>
								
							</div>

						<?php }
					}
				
				endif;
				//END MANUAL FACULTY USER SELECTION


				// START FULL MANUAL USER SELECTION
				if(get_custom_field( 'filter_users_by' ) == 'manual_user_selection_full') :
					
					/* Get CUSTOM USER LIST (category in this case) */
					if(get_custom_field( 'user-list-full' )) :
						$users = get_custom_field( 'user-list-full' );

						// SET CAT_STRING
						 foreach ( $users as $user ) {
							$ausers[] = $user;		
						 }
						 $user_string = join(',', $ausers);
					endif; 

					$get_user_args = array(
					    'blog_id'     => $GLOBALS['blog_id'],
					    'role_in'        => '',
					    'orderby'     => 'display_name',
					    'order'       => 'ASC',
					    'count_total' => false,
					    'include'      => $user_string
					);

					// Create the WP_User_Query object
					$wp_user_query = new WP_User_Query($get_user_args);
					$includeusers = $wp_user_query->get_results();

					// var_dump($includeusers);

					if (!empty($includeusers))
					{
					    // loop trough each author
					    foreach ($includeusers as $includeuser) { ?>

					        <div class="faculty-module widget alpha omega theme_hook">

								<div class="faculty-avatar two columns alpha">
									<?php
									// Retrieve The Post's Author ID
									$includeuser_ID = $includeuser->ID;
									// Set the image size. Accepts all registered images sizes and array(int, int)
									$size = 'faculty-thumbnail';
									// Get the image URL using the author ID and image size params
									if (get_cupp_meta( $includeuser_ID, $size )):
									$imgURL = get_cupp_meta($includeuser_ID, $size);
									else : 
									$imgURL = WP_THEME_URL . '/theme-core/theme-assets/images/default-author-image.jpg';
									endif;
									?>
									<!-- Print the image on the page -->
									<img class="theme_image" src="<?php echo esc_url ( $imgURL );?>"/>
								</div>

								<div class="faculty-name four columns">

									<div class="faculty-name">
										<h3><a href="<?php echo esc_url( get_author_posts_url( $includeuser_ID ) ); ?>"><?php echo esc_html( $includeuser->display_name); ?></a></h3>
									</div>
									<div class="faculty-title entry-title-meta">
										<span><?php echo esc_html( $includeuser->faculty_title_meta ); ?></span>
									</div>

								</div>

								<div class="faculty-contact six columns">

									<div class="faculty-email">
										<h5><?php _e( 'Contact Email', 'mythology' ); ?>:</h5>
										<?php if ( $user_email_link == "on" ) : ?>
											<a href="mailto:<?php echo esc_html( $includeuser->user_email ); ?>">
												<?php echo esc_html( $includeuser->user_email ); ?>
											</a>
										<?php else : ?>
											<?php echo esc_html( $includeuser->user_email ); ?>
										<?php endif; ?>
									</div>
								</div>

								<div class="faculty-contact four columns omega">
									<div class="faculty-phone">
										<h5><?php _e( 'Contact Phone', 'mythology' ); ?>:</h5>
										<span><?php echo esc_html( $includeuser->faculty_deptphone_meta ); ?></span>
									</div>

								</div>
								
							</div>

						<?php }
					}
				
				endif;
				//END FULL MANUAL USER SELECTION


				//START USER SELECTION BY CATEGORY
				if(get_custom_field( 'filter_users_by' ) == 'course_categories' || get_custom_field( 'filter_users_by' ) == '') :

					$blogusers = get_users();
					if ($blogusers) {
					  foreach ($blogusers as $bloguser) {

					    $args = array(
					    'post_type'	=> 'polytechnic_courses',
						'tax_query' => array(
							array(
								'taxonomy' => 'polytechnic_courses_category', // THIS IS THE FORMAL TAXOMONY SLUG
								'field' => 'term_id',
								'terms' => $cats, // Should return an array of category (taxonomy) IDs - ie: array( 43, 66, 108 ) - NOT just the numbers!
							),
						),
						'orderby'			=> 'title',
						'order'				=> 'ASC',
						// 'cat'=>$cat_string,			   // Query for the cat ID's (because you can't use multiple names or slugs... crazy WP!)
						'posts_per_page'=>$post_count, // Set a posts per page limit
						'paged'=>$paged,			   // Basic pagination stuff.
						'author' => $bloguser->ID,
						'showposts' => 1,
						'ignore_sticky_posts' => true
					    );

					    $my_query = new WP_Query($args);
					    
					    if( $my_query->have_posts() ) {

					      while ($my_query->have_posts()) : $my_query->the_post();

					      	$user = get_userdata($bloguser->ID); 

					      	?>


					      	<div class="faculty-module widget alpha omega theme_hook">

								<div class="faculty-avatar two columns alpha">
									<?php
									// Retrieve The Post's Author ID
									$user_ID = get_the_author_meta('ID');
									// Set the image size. Accepts all registered images sizes and array(int, int)
									$size = 'faculty-thumbnail';
									// Get the image URL using the author ID and image size params
									if (get_cupp_meta( $user_ID, $size )):
									$imgURL = get_cupp_meta($user_ID, $size);
									else : 
									$imgURL = WP_THEME_URL . '/theme-core/theme-assets/images/default-author-image.jpg';
									endif;
									?>
									<!-- Print the image on the page -->
									<img class="theme_image" src="<?php echo esc_url ( $imgURL );?>"/>
								</div>

								<div class="faculty-name four columns">

									<div class="faculty-name">
										<h3><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author_meta('display_name'); ?></a></h3>
									</div>
									<div class="faculty-title entry-title-meta">
										<span><?php echo esc_html( the_author_meta('faculty_title_meta') ); ?></span>
									</div>

								</div>

								<div class="faculty-contact six columns">

									<div class="faculty-email">
										<h5><?php _e( 'Contact Email', 'mythology' ); ?>:</h5>
										<?php if ( $user_email_link == "on" ) : ?>
											<a href="mailto:<?php echo esc_html( the_author_meta('email') ); ?>">
												<?php echo esc_html( the_author_meta('email') ); ?>
											</a>
										<?php else : ?>
											<?php echo esc_html( the_author_meta('email') ); ?>
										<?php endif; ?>
									</div>
								</div>

								<div class="faculty-contact four columns omega">
									<div class="faculty-phone">
										<h5><?php _e( 'Contact Phone', 'mythology' ); ?>:</h5>
										<span><?php echo esc_html( the_author_meta('faculty_deptphone_meta') ); ?></span>
									</div>

								</div>
								
							</div>

				    	<?php endwhile;
					    }
					  }
					} 

				endif;
				//END USER SELECTION BY CATEGORY
				?>

			</div>

		</main>
		
	</div>

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>