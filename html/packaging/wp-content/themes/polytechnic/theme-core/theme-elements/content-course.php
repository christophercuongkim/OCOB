<?php
/**
 *
 * Used for single.php
 *
 * @package mythology
/**
MARKUP TEMPLATE:

article.hentry
	header.entry-header
		h1.entry-title
		div.entry-date
	div.entry-summary (excerpt)
	or div.entry-content (full content)
	footer.entry-footer
		span.cat-links
		span.tag-links
		span.comments-link
		span.edit-link
**/

?>

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
						$pc_img_width = ot_get_option('course_image_width');
						if ( $pc_img_width ) :
							$pc_img_width = ot_get_option('course_image_width');
						else :
						$pc_img_width = 240;
						endif;

						$pc_img_height = ot_get_option('course_image_height');
						if ( $pc_img_height ) :
							$pc_img_height = ot_get_option('course_image_height');
						else :
						$pc_img_height = 150;
						endif;

						$thumb = get_post_thumbnail_id(); 
						$image = vt_resize( $thumb, '', $pc_img_width , $pc_img_height , true );
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
						<h5>
							<?php $course_output_name = ot_get_option('course_output_name');
							if(!empty($course_output_name)) :
								echo esc_html($course_output_name);
							else: 
								_e( 'Name', 'mythology' );
							endif;
							?>:
							<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_name', true ) ); ?></span>
						</h5>
					</div>
				</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_course_number') != "off" ) : ?>
				<div class="course-meta eight columns meta-item">
					<div class="course-number">
						<h5>
							<?php $course_output_number = ot_get_option('course_output_number');
							if(!empty($course_output_number)) :
								echo esc_html($course_output_number);
							else: 
								_e( 'Course Number', 'mythology' );
							endif;
							?>:
							<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_number', true ) ); ?></span>
						</h5>
					</div>
				</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_course_time') != "off" ) : ?>
				<div class="course-meta eight columns meta-item">
					<div class="course-time">
						<h5>
							<?php $course_output_time = ot_get_option('course_output_time');
							if(!empty($course_output_time)) :
								echo esc_html($course_output_time);
							else: 
								_e( 'Course Time', 'mythology' );
							endif;
							?>:
							<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_time', true ) ); ?></span>
						</h5>
					</div>
				</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_course_prerequisites') != "off" ) : ?>
				<div class="course-meta eight columns meta-item">
					<div class="course-prerequisites">
						<h5>
							<?php $course_output_prerequisites = ot_get_option('course_output_prerequisites');
							if(!empty($course_output_prerequisites)) :
								echo esc_html($course_output_prerequisites);
							else: 
								_e( 'Prerequisite(s)', 'mythology' );
							endif;
							?>:
							<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_prerequisites', true ) ); ?></span>
						</h5>
					</div>
				</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_course_credits') != "off" ) : ?>
				<div class="course-meta eight columns meta-item">
					<div class="course-credits">
						<h5>
							<?php $course_output_credits = ot_get_option('course_output_credits');
							if(!empty($course_output_credits)) :
								echo esc_html($course_output_credits);
							else: 
								_e( 'Credit(s)', 'mythology' );
							endif;
							?>:
							<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_credits', true ) ); ?></span>
						</h5>
					</div>
				</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_course_id') != "off" ) : ?>
				<div class="course-meta eight columns meta-item">
					<div class="course-id">
						<h5>
							<?php $course_output_id = ot_get_option('course_output_id');
							if(!empty($course_output_id)) :
								echo esc_html($course_output_id);
							else: 
								_e( 'Course ID', 'mythology' );
							endif;
							?>:
							<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_unique_id', true ) ); ?></span>
						</h5>
					</div>
				</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_course_room') != "off" ) : ?>
				<div class="course-meta eight columns meta-item">
					<div class="course-room-number">
						<h5>
							<?php $course_output_room = ot_get_option('course_output_room');
							if(!empty($course_output_room)) :
								echo esc_html($course_output_room);
							else: 
								_e( 'Room Number', 'mythology' );
							endif;
							?>:
							<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_room_number', true ) ); ?></span>
						</h5>
					</div>
				</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_course_days') != "off" ) : ?>
				<div class="course-meta eight columns meta-item">
					<div class="course-days">
						<h5>
							<?php $course_output_days = ot_get_option('course_output_days');
							if(!empty($course_output_days)) :
								echo esc_html($course_output_days);
							else: 
								_e( 'Course Days', 'mythology' );
							endif;
							?>:
							<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_days', true ) ); ?></span>
						</h5>
					</div>
				</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_course_components') != "off" ) : ?>
				<div class="course-meta eight columns meta-item">
					<div class="course-components">
						<h5>
							<?php $course_output_components = ot_get_option('course_output_components');
							if(!empty($course_output_components)) :
								echo esc_html($course_output_components);
							else: 
								_e( 'Component(s)', 'mythology' );
							endif;
							?>:
							<span><?php echo esc_html( get_post_meta( get_the_ID(), 'course_components', true ) ); ?></span>
						</h5>
					</div>
				</div>
				<?php endif; ?>

				<?php if(ot_get_option('show_course_location') != "off" ) : ?>
				<div class="course-meta eight columns meta-item">
					<div class="course-location">
						<h5>
							<?php $course_output_location = ot_get_option('course_output_location');
							if(!empty($course_output_location)) :
								echo esc_html($course_output_location);
							else: 
								_e( 'Location', 'mythology' );
							endif;
							?>:
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
							<h5>
								<?php $course_output_notes = ot_get_option('course_output-notes');
								if(!empty($course_output_notes)) :
									echo esc_html($course_output_notes);
								else: 
									_e( 'Notes', 'mythology' );
								endif;
								?>:
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

	<div class="display_none microformats-container">
		<!-- hAtom Requirement - Author -->
		<span class="vcard author"><span class="fn"></span></span>
		<!-- hAtom Requirement - Date -->
		<span class="date updated"></span>
	</div>


</article><!-- #post-## -->