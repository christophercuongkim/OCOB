<?php
/**
 * The Template for displaying all single courses.
 *
 * @package mythology
 */

get_header(); ?>

  <div id="primary" class="<?php echo esc_attr( $primary_layout_classes ); ?>">
    <main id="main" class="site-main" role="main">

    <?php $mypost = array( 'post_type' => 'polytechnic_courses', );
        $loop = new WP_Query( $mypost ); ?>
        <!-- Cycle through all posts -->
        <?php while ( $loop->have_posts() ) : $loop->the_post();?>

      <?php// get_template_part( 'theme-core/theme-elements/content', 'course' ); ?>


      <!-- ===== START THE COURSE MARKUP ========================================= -->


		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header clearfix">

				<?php if(ot_get_option('show_course_title') != "off" ) : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<hr class="title"/>
				<?php endif; ?>

			</header>

			<?php if(ot_get_option('show_course_meta') != "off" ) : ?>
				<!-- Begin Course Meta -->
				<div class="entry-meta clearfix">

					<div class="entry-media-description">
						<?php if (has_post_thumbnail( $post->ID )) : ?>
							<?php
								$thumb = get_post_thumbnail_id(); 
								$image = vt_resize( $thumb, '', 240, 150, true );
							?>
							<div class="entry-media columns alpha">
								<?php if ( !is_single() ) : ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
									<div class="entry-media-inner">
										<img class="theme_image" src="<?php echo esc_url( $image['url'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>" />
									</div>
								<?php if ( !is_single() ) : ?></a><?php endif; ?>
							</div>
						<?php endif; ?>
						
						<div class="entry-description omega">
							<?php echo esc_html( get_post_meta( get_the_ID(), 'course_description', true ) ); ?>
						</div>
					</div>

					<div id="section-course-meta" class="theme_hook sixteen columns alpha omega meta-table">			

						<?php if(ot_get_option('show_course_name') != "off" ) : ?>
						<div class="course-meta eight columns meta-item">
							<div class="course-name">
								<h5><?php _e( 'Name', 'mythology' ); ?>:
									<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_name', true ) ); ?></span>
								</h5>
							</div>
						</div>
						<?php endif; ?>

						<?php if(ot_get_option('show_course_number') != "off" ) : ?>
						<div class="course-meta eight columns meta-item">
							<div class="course-number">
								<h5><?php _e( 'Course Number', 'mythology' ); ?>:
									<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_number', true ) ); ?></span>
								</h5>
							</div>
						</div>
						<?php endif; ?>

						<?php if(ot_get_option('show_course_time') != "off" ) : ?>
						<div class="course-meta eight columns meta-item">
							<div class="course-time">
								<h5><?php _e( 'Course Time', 'mythology' ); ?>:
									<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_time', true ) ); ?></span>
								</h5>
							</div>
						</div>
						<?php endif; ?>

						<?php if(ot_get_option('show_course_prerequisites') != "off" ) : ?>
						<div class="course-meta eight columns meta-item">
							<div class="course-prerequisites">
								<h5><?php _e( 'Prerequisite(s)', 'mythology' ); ?>:
									<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_prerequisites', true ) ); ?></span>
								</h5>
							</div>
						</div>
						<?php endif; ?>

						<?php if(ot_get_option('show_course_credits') != "off" ) : ?>
						<div class="course-meta eight columns meta-item">
							<div class="course-credits">
								<h5><?php _e( 'Credit(s)', 'mythology' ); ?>:
									<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_credits', true ) ); ?></span>
								</h5>
							</div>
						</div>
						<?php endif; ?>

						<?php if(ot_get_option('show_course_id') != "off" ) : ?>
						<div class="course-meta eight columns meta-item">
							<div class="course-id">
								<h5><?php _e( 'Course ID', 'mythology' ); ?>:
									<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_unique_id', true ) ); ?></span>
								</h5>
							</div>
						</div>
						<?php endif; ?>

						<?php if(ot_get_option('show_course_room') != "off" ) : ?>
						<div class="course-meta eight columns meta-item">
							<div class="course-room-number">
								<h5><?php _e( 'Room Number', 'mythology' ); ?>:
									<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_room_number', true ) ); ?></span>
								</h5>
							</div>
						</div>
						<?php endif; ?>

						<?php if(ot_get_option('show_course_days') != "off" ) : ?>
						<div class="course-meta eight columns meta-item">
							<div class="course-days">
								<h5><?php _e( 'Course Days', 'mythology' ); ?>:
									<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_days', true ) ); ?></span>
								</h5>
							</div>
						</div>
						<?php endif; ?>

						<?php if(ot_get_option('show_course_components') != "off" ) : ?>
						<div class="course-meta eight columns meta-item">
							<div class="course-components">
								<h5><?php _e( 'Component(s)', 'mythology' ); ?>:
									<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_components', true ) ); ?></span>
								</h5>
							</div>
						</div>
						<?php endif; ?>

						<?php if(ot_get_option('show_course_location') != "off" ) : ?>
						<div class="course-meta eight columns meta-item">
							<div class="course-location">
								<h5><?php _e( 'Location', 'mythology' ); ?>:
									<?php $link_address = ( get_post_meta( get_the_ID(), 'course_location', true ) );?>
									<span><a href="<?php echo esc_url( $link_address );?>" target="_blank"><?php _e( 'Map', 'mythology' ); ?></a></span>
								</h5>
							</div>
						</div>
						<?php endif; ?>

						<?php $cnv = get_post_meta( get_the_ID(), 'course_notes', true );
						// check if the custom field has a value
						if( ! empty( $cnv ) ) : ?>
							<?php if(ot_get_option('show_course_notes') != "off" ) : ?>
							<div class="course-meta sixteen columns">
								<div class="course-notes">
									<h5><?php _e( 'Notes', 'mythology' ); ?>:
										<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_notes', true ) ); ?></span>
									</h5>
								</div>
							</div>
							<?php endif; ?>
						<?php endif; ?>

					</div>

				</div>
				<!-- /End Post Meta -->
			<?php endif; ?>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'mythology' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<div class="after-content">

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

				<?php if(ot_get_option('show_course_edit') == "on" ) : ?>
					<?php edit_post_link( __( 'Edit', 'mythology' ), '<span class="edit-link button">', '</span>' ); ?>
				<?php endif; ?>

			</div>


		</article><!-- #post-## -->

    <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php wp_reset_query(); ?>

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>