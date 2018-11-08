<?php
/*
 * Template Name: Course Catalog
*/

global $template_file;				
global $paged;
global $cat_string;
global $format;
global $is_handheld;

if( get_post_custom_values('course_post_count') ) :  
	$post_array = get_post_custom_values('course_post_count');
	$post_count = join(',', $post_array);
else : 
	$post_count = -1;
endif;

if(get_custom_field( 'catalog_post_type' ) == 'sensei_courses' ) :

	$post_type = 'course';
	$taxonomy = 'course-category';
	if(get_custom_field( 'course_category_filter_sensei' )) :
		$cats = get_custom_field( 'course_category_filter_sensei' );
	endif;

else :

	$post_type = 'polytechnic_courses';
	$taxonomy = 'polytechnic_courses_category';
	/* Get CUSTOM TAXONOMY (category in this case) */
	if(get_custom_field( 'course_category_filter' )) :
		$cats = get_custom_field( 'course_category_filter' );
	endif;

endif;

/* START ORDER_BY AND META_KEY OPTIONS */
	/* CHECK IF ORDER BY OPTION IS SET */
	if(get_custom_field( 'course_order_metakey' )) :

		/* ASSIGN META_KEY TO VARIABLE FOR EASY USAGE */
		$coure_order_metakey = get_custom_field( 'course_order_metakey' );


		/* CONDITIONALS FOR META_KEY */
			/* IF META_KEY IS NUMERIC VALUE */
			if ($coure_order_metakey == 'course_unique_id' ) {
				$meta_key = get_custom_field( 'course_order_metakey' );
				$order_by = 'meta_value_num';
			}

			/* IF META_KEY IS AUTHOR - THIS IS NOT PULLED FROM CUSTOM META */
			else if (get_custom_field( 'course_order_metakey' ) == 'course_author' ) {
				$meta_key = '';
				$order_by = 'author';
			} 

			/* DEFAULT - IF META_KEY IS SET TO ANYTHING ELSE */
			else {
				$meta_key = get_custom_field( 'course_order_metakey' );
				$order_by = 'meta_value';
			}

	/* IF META_KEY IS NOT SET - FALLBACK TITLE IS USED */
	else : 
		$meta_key = '';
		$order_by = 'title';
	endif;

/* START ORDER OPTIONS */
	/* CHECK IF ORDER OPTION IS SET */
	if(get_custom_field( 'course_order' )) :

		/* ASSIGN DEFAULT OPTION VALUE TO VARIABLE */
		$order = get_custom_field( 'course_order' );
		
		/* CONDITIONALS FOR ORDER */
			/* IF ORDER VALUE IS SET TO AUTHOR OR TIME - REVERSE OPTIONS FOR PROPER ORDERING - FIXES THESE CUSTOM OPTION VALUES IN THE QUERY */
			if (get_custom_field( 'course_order_metakey' ) == 'course_author'
				|| get_custom_field( 'course_order_metakey' ) == 'course_time' ) :
					if (get_custom_field( 'course_order' ) == 'ASC' ) {
						$order = 'DESC';
					} else {
						$order = 'ASC';
					}
			endif;
	/* IF ORDER IS NOT SET - FALLBACK ASC IS USED */
	else :
		$order = 'ASC';
	endif;


// Get Polytechnic Courses
	$mypost = array(
	'post_type'			 => $post_type,
	'tax_query'			 => array(
		array(
			'taxonomy' 	 => $taxonomy, // THIS IS THE FORMAL TAXOMONY SLUG
			'field'		 => 'id',
			'terms'		 => $cats // Should return an array of category (taxonomy) IDs - ie: array( 43, 66, 108 ) - NOT just the numbers!
		)
	),
	'meta_key'			=> $meta_key,
	'orderby'			=> $order_by, /* meta_value*/
	'order'				=> $order,
	//'cat'=>$cat_string,			   // Query for the cat ID's (because you can't use multiple names or slugs... crazy WP!)
	'posts_per_page'	=> $post_count, // Set a posts per page limit
	'paged'				=> $paged			   // Basic pagination stuff.
 );

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

		<!-- PAGE CONTENT -->
		<div class="page-content clearfix">
			<?php while ( have_posts() ) : the_post(); if($post->post_content != "") : ?>	
				<?php the_content(); ?>
			<?php endif; endwhile; ?>	
		</div>
	

		<!-- ============================================== -->		

	
		<!-- PAGE CONTENT -->
		<main id="main" class="site-main course-catalog" role="main">		

			<div class="course-search">   
			    <h3><?php _e( 'Search Courses', 'mythology' ); ?></h3>
			    <form role="search" action="<?php echo esc_url( site_url('/') ); ?>" method="get" id="searchform">
				    <input class="course-search-field fourteen columns alpha" type="text" name="s" placeholder="<?php echo esc_attr_x( 'Search Courses', 'placeholder', 'mythology' ); ?>"/>
				    <input type="hidden" name="post_type" value="polytechnic_courses" /> <!-- // hidden 'products' value -->
				    <input class="course-search-button two columns omega" type="submit" alt="Search" value="<?php echo esc_attr_x( 'Search', 'submit button', 'mythology' ); ?>" />
			  	</form>
			 </div>					
			
			<!-- THE POST QUERY -->
			<!-- This one's special because it'll look for our category filter and apply some magic -->
			<?php wp_reset_query(); ?>

			<?php 
			global $mypost;

			$loop = new WP_Query( $mypost ); ?>

				<!-- Cycle through all posts -->
			    <?php if ( $loop->have_posts() ) : ?>

			    	<?php if (is_handheld() == "true") : ?>
			    		<div class="is-handheld">
			    			<p><em>
			    				<?php _e( 'Touch to Scroll Content Below', 'mythology' ); ?>
			    			</em></p>
			    			<div class="arrow">
		        				<i aria-hidden="true" data-icon="&#xe62b;"></i>    				
		        			</div>
			    		</div>
			    	<?php endif; ?>

					<!-- Start the table -->
					<table id="course-list" class="responsive">

						<tbody>

							<!-- Start the table header row -->
								<tr class="course-list-header">
									<th class="course-id">

										<?php $course_output_id = ot_get_option('course_output_id');
										if(!empty($course_output_id)) :
											echo esc_html($course_output_id);
										else: 
											_e( 'Course ID', 'mythology' );
										endif;
										?>

										<?php // _e( 'Course ID', 'mythology' ); ?>
									</th>
									<th class="course-number">

										<?php $course_output_number = ot_get_option('course_output_number');
										if(!empty($course_output_number)) :
											echo esc_html($course_output_number);
										else: 
											_e( 'Course Number', 'mythology' );
										endif;
										?>

										<?php // _e( 'Course Number', 'mythology' ); ?>
									</th>
									<th class="course-name">

										<?php $course_output_name = ot_get_option('course_output_name');
										if(!empty($course_output_name)) :
											echo esc_html($course_output_name);
										else: 
											_e( 'Course Name', 'mythology' );
										endif;
										?>

										<?php // _e( 'Course Name', 'mythology' ); ?>
									</th>
									<th class="course-instructor">

										<?php $course_output_instructor = ot_get_option('course_output_instructor');
										if(!empty($course_output_instructor)) :
											echo esc_html($course_output_instructor);
										else: 
											_e( 'Instructor', 'mythology' );
										endif;
										?>

										<?php // _e( 'Instructor', 'mythology' ); ?>
									</th>
									<th class="course-room-number">

										<?php $course_output_room = ot_get_option('course_output_room');
										if(!empty($course_output_room)) :
											echo esc_html($course_output_room);
										else: 
											_e( 'Room Number', 'mythology' );
										endif;
										?>

										<?php // _e( 'Room Number', 'mythology' ); ?>
									</th>
									<th class="course-days">

										<?php $course_output_days = ot_get_option('course_output_days');
										if(!empty($course_output_days)) :
											echo esc_html($course_output_days);
										else: 
											_e( 'Days', 'mythology' );
										endif;
										?>

										<?php // _e( 'Days', 'mythology' ); ?>
									</th>
									<th class="course-time">

										<?php $course_output_time = ot_get_option('course_output_time');
										if(!empty($course_output_time)) :
											echo esc_html($course_output_time);
										else: 
											_e( 'Time', 'mythology' );
										endif;
										?>

										<?php // _e( 'Time', 'mythology' ); ?>
									</th>
									<th class="course-credits">

										<?php $course_output_credits = ot_get_option('course_output_credits');
										if(!empty($course_output_credits)) :
											echo esc_html($course_output_credits);
										else: 
											_e( 'Credits', 'mythology' );
										endif;
										?>

										<?php // _e( 'Credits', 'mythology' ); ?>
									</th>
									<th class="course-prerequisites">

										<?php $course_output_prerequisites = ot_get_option('course_output_prerequisites');
										if(!empty($course_output_prerequisites)) :
											echo esc_html($course_output_prerequisites);
										else: 
											_e( 'Prerequisites', 'mythology' );
										endif;
										?>

										<?php // _e( 'Prerequisites', 'mythology' ); ?>
									</th>
								</tr>
								<!-- /End the table header row -->

				<?php while ( $loop->have_posts() ) : $loop->the_post();?>

							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'theme-core/theme-elements/content', 'course-list' );
								//get_template_part( 'theme-core/theme-elements/content', 'authorgrid' );
							?>

				<?php endwhile; ?>

						</tbody>
					</table>
					<!-- /End the table -->

                <!-- Re-assign main WP Query to $temp (for holding), and assign our new custom query ($loop) to WP Query - For Pagination Purposes -->
                <?php global $wp_query; $temp = $wp_query; $wp_query= null; $wp_query = $loop; ?>

                <!-- Pagaination -->
                <?php mythology_course_nav( 'nav-below' ); ?>

                <!-- Reset the main WP Query ($temp) to WP Query -->
                <?php $wp_query = null; $wp_query = $temp;?>

                <?php else : ?>

                    <?php get_template_part( 'theme-core/theme-elements/content', 'none' ); ?>

                <?php endif; ?>
							
		</main>

		
	</div>

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>