<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package MYTHOLOGY
 */

get_header(); 

$myth_content_layout = "right-sidebar";
$myth_primary_layout_classes = "left eleven columns";
$myth_secondary_layout_classes = "right five columns";

global $curauth;
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$curauthID = (isset($_GET['author_name'])) ? get_user_by('ID', $author_name) : get_userdata(intval($author));


?>

	<div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">
		<main id="main" class="site-main" role="main">

			<!-- PAGE CONTENT -->
			<div class="page-content clearfix">

				<!-- PAGE HEADER -->
				<div id="page-header">

					<?php if(ot_get_option('show_faculty_header') != "off" ) : ?>

						<?php if(ot_get_option('show_faculty_name_h') != "off" ) : ?>

							<!-- Page Title -->
							<h1 class="entry-title"><?php echo esc_html( $curauth->display_name ); ?></h1>

						<?php endif; ?>
						
						<?php if(ot_get_option('show_faculty_title_h') != "off" OR ot_get_option('show_faculty_dept_h') != "off" ) : ?>

							<!-- Page Breadcrumbs -->
							<div class="entry-title-meta">

								<?php if(ot_get_option('show_faculty_title_h') != "off" ) : ?>

									<?php echo esc_html( $curauth->faculty_title_meta ); ?> |

								<?php endif; ?>

								<?php if(ot_get_option('show_faculty_dept_h') != "off" ) : ?>

									<?php echo esc_html( $curauth->faculty_dept_meta ); ?>

								<?php endif; ?>

								<br />

							</div>

						<?php endif; ?>

						<?php if(ot_get_option('show_faculty_avatar_h') != "off" ) : ?>

							<div class="faculty-avatar right">
								<?php
								// Retrieve The Post's Author ID
								$user_ID = $curauth->id;

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

						<?php endif; ?>

						<hr class="title"/>

					<?php endif; ?>

				</div>
				<!-- End Page Header -->

				<?php if(ot_get_option('show_faculty_meta') != "off" ) : ?>
					<div id="section-author-meta" class="theme_hook sixteen columns alpha omega meta-table">

					<?php if(ot_get_option('show_faculty_name') != "off" ) : ?>
						<div class="author-meta eight columns meta-item">
							<div class="faculty-name">
								<h5><?php _e( 'Name', 'mythology' ); ?>:
								<span class="vcard author"><span class="fn"><?php echo esc_html( $curauth->display_name ); ?></span></span></h5>
							</div>
						</div>
					<?php endif; ?>

					<?php if(ot_get_option('show_faculty_title') != "off" ) : ?>
						<div class="author-meta eight columns meta-item">
							<div class="faculty-title">
								<h5><?php _e( 'Title/Position', 'mythology' ); ?>:
								<span><?php echo esc_html( $curauth->faculty_title_meta ); ?></span></h5>
							</div>
						</div>
					<?php endif; ?>

					<?php if(ot_get_option('show_faculty_dept') != "off" ) : ?>
						<div class="author-meta eight columns meta-item">
							<div class="faculty-department">
								<h5><?php _e( 'Department', 'mythology' ); ?>:
								<span><?php echo esc_html( $curauth->faculty_dept_meta ); ?></span></h5>
							</div>
						</div>
					<?php endif; ?>

					<?php if(ot_get_option('show_faculty_specialties') != "off" ) : ?>
						<div class="author-meta eight columns meta-item">
							<div class="faculty-specialty">
								<h5><?php _e( 'Specialties', 'mythology' ); ?>:
								<span><?php echo esc_html( $curauth->faculty_specialty_meta ); ?></span></h5>
							</div>
						</div>
					<?php endif; ?>

					<?php if(ot_get_option('show_faculty_email') != "off" ) : ?>
						<div class="author-meta eight columns meta-item">
							<div class="faculty-email">
								<h5><?php _e( 'Contact Email', 'mythology' ); ?>:
								<span>
									<?php if ( ot_get_option('show_faculty_email_link') == "on" ) : ?>
										<a href="mailto:<?php echo esc_html( $curauth->user_email ); ?>">
											<?php echo esc_html( $curauth->user_email ); ?>
										</a>
									<?php else : ?>
										<?php echo esc_html( $curauth->user_email ); ?>
									<?php endif; ?>
								</span>
								</h5>
							</div>
						</div>
					<?php endif; ?>

					<?php if(ot_get_option('show_faculty_phone') != "off" ) : ?>
						<div class="author-meta eight columns meta-item">
							<div class="faculty-phone">
								<h5><?php _e( 'Contact Phone', 'mythology' ); ?>:
								<span><?php echo esc_html( $curauth->faculty_deptphone_meta ); ?></span></h5>
							</div>
						</div>
					<?php endif; ?>

					</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_faculty_bio') != "off" ) : ?>
					<div class="faculty-description">
						<h2><?php _e( 'Faculty Bio', 'mythology' ); ?></h2>
						<p><?php echo esc_html( $curauth->description ); ?></p>
					</div>
				<?php endif; ?>
				
				<?php if(ot_get_option('show_faculty_course_list') != "off" ) : ?>
					<h2><?php _e( 'Courses', 'mythology' ); ?></h2>
					<p> <?php _e( 'Click each course for class syllabus, materials, course information, updates, and upcoming tests.', 'mythology' ); ?> </p>

					<!-- THE POST QUERY -->
					<!-- This one's special because it'll look for our category filter and apply some magic -->
					<?php wp_reset_query(); 

					global $paged;

					$mypost = array( 'post_type' => 'polytechnic_courses',
										'author' => $curauth->id,
										'posts_per_page'=>-1,  // Set a posts per page limit
										'orderby'=>'title',
										'order'=>'ASC',
										'paged'=>$paged		   // Basic pagination stuff.
										 );
					?>

					<?php $loop = new WP_Query( $mypost ); ?>

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

								<!-- Cycle through all posts -->
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

						<?php mythology_content_nav( 'nav-below' ); ?>

					<?php else : ?>

						<?php get_template_part( 'theme-core/theme-elements/content', 'none' ); ?>

					<?php endif; ?>

				<?php endif; ?>

			<?php if(ot_get_option('show_faculty_contact_section') == "on" ) : ?>

                <?php if(ot_get_option('faculty_contact_shortcode')) : $contact_shortcode = ot_get_option('faculty_contact_shortcode');?>
                    <h2><?php _e( 'Send a Message to ', 'mythology' ); ?><?php echo esc_html( $curauth->display_name ); ?></h2>
                    <?php echo do_shortcode( $contact_shortcode ); ?>
                <?php endif; ?>

            <?php endif; ?>
			</div><!-- #page-content -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>