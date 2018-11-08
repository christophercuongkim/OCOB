<aside id="faculty-box" class="widget sixteen columns alpha omega theme_hook">

	<div class="faculty-section sixteen columns alpha omega">

		<div class="ten columns alpha">

			<?php if(ot_get_option('show_faculty_sidebar_name') != "off" ) : ?>
				<div class="faculty-name">
					<h2><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><span class="vcard author"><span class="fn"><?php the_author_meta('display_name'); ?></span></span></a></h2>
				</div>
			<?php endif; ?>

			<?php if(ot_get_option('show_faculty_sidebar_title') != "off" ) : ?>
				<div class="faculty-title">
					<span><?php echo esc_html( the_author_meta('faculty_title_meta') ); ?></span>
				</div>
			<?php endif; ?>

			<?php if(ot_get_option('show_faculty_sidebar_dept') != "off" ) : ?>
				<div class="faculty-department">
					<span><?php echo esc_html( the_author_meta('faculty_dept_meta') ); ?></span>
				</div>
			<?php endif; ?>

		</div>

		<?php if(ot_get_option('show_faculty_sidebar_avatar') != "off" ) : ?>
			<div class="faculty-avatar six columns omega right">
				<?php
				
				/* * USAGE:
					 * <?php $imgURL = get_cupp_meta( $user_id, $size ); ?>
					 * or
					 * <img src="<?php echo esc_url( get_cupp_meta( $user_id, $size ) ); ?>">
					 * 
					 * Beginner WordPress template editing skill required. Place the above tag in your template and provide the two parameters.
					 * @param $user_id    Default: $post->post_author. Will accept any valid user ID passed into this parameter.
					 * @param $size       Default: 'thumbnail'. Accepts all default WordPress sizes and any custom sizes made by the add_image_size() function.
					 * @return {url}      Use this inside the src attribute of an image tag or where you need to call the image url. */

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
		<?php endif; ?>

	</div>

	<hr>

	<?php if(ot_get_option('show_faculty_sidebar_about_me') != "off" ) : ?>
		<div class="faculty-section sixteen columns alpha omega">
			<div class="faculty-description">
				<h5><?php _e( 'About Me', 'mythology' ); ?></h5>
				<span><?php echo esc_html( the_author_meta('description') ); ?></span>
			</div>
		</div>
		<hr />
	<?php endif; ?>

	<?php if(ot_get_option('show_faculty_sidebar_nav') != "off" OR ot_get_option('show_faculty_sidebar_phone') != "off" OR ot_get_option('show_faculty_sidebar_email') != "off" ) : ?>
		<div class="faculty-section sixteen columns alpha omega">

			<?php if(ot_get_option('show_faculty_sidebar_email') != "off" ) : ?>
				<div class="faculty-email">
					<h5><?php _e( 'Contact Email', 'mythology' ); ?>:</h5>
					<span>
						<?php if ( ot_get_option('show_faculty_sidebar_email_link') == "on" ) : ?>
							<a href="mailto:<?php echo esc_html( the_author_meta('email') ); ?>">
								<?php echo esc_html( the_author_meta('email') ); ?>
							</a>
						<?php else : ?>
							<?php echo esc_html( the_author_meta('email') ); ?>
						<?php endif; ?>
					</span>
				</div>
			<?php endif; ?>

			<?php if(ot_get_option('show_faculty_sidebar_phone') != "off" ) : ?>
				<div class="faculty-phone">
					<h5><?php _e( 'Contact Phone', 'mythology' ); ?>:</h5>
					<span><?php echo esc_html( the_author_meta('faculty_deptphone_meta') ); ?></span>
				</div>
			<?php endif; ?>

			<?php if(ot_get_option('show_faculty_sidebar_nav') != "off" ) : ?>
				<div class="faculty-classes">
					<h5><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php _e( 'Back to', 'mythology' ); ?> <?php the_author_meta('display_name'); ?><?php _e( "'s", 'mythology' ); ?> <?php _e( 'Courses', 'mythology' ); ?></a></h5>
				</div>
			<?php endif; ?>

		</div>
	<?php endif; ?>
		
</aside>

<hr>