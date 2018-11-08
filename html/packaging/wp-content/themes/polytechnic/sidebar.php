<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package mythology
 */

	// Retrieve The Post's Author ID
	global $user_id;
	// Set the image size. Accepts all registered images sizes and array(int, int)
	global $size; 
	// Get the image URL using the author ID and image size params
	global $imgURL;
	//
	global $curauth;

	global $myth_content_layout;
	global $myth_secondary_layout_classes;
	global $tertiary_layout_classes;

?>

<?php if( $myth_content_layout != "no-sidebar") : ?>
	<div id="secondary" class="widget-area <?php echo esc_attr( $myth_secondary_layout_classes ); ?>  <?php if ( class_exists( 'tribe-events-pg-template' ) ) { if ( tribe_is_event() && is_singular() ) : ?>right<?php endif; }?>" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>

		<?php if ( /*is_author() OR*/is_singular( 'polytechnic_courses' ) ) : ?>

			<?php if(ot_get_option('show_faculty_sidebars') != "off" ) : ?>

				<?php if ( function_exists( 'coauthors_posts_links' ) ) :
					$i = new CoAuthorsIterator(); ?>
					<?php while( $i->iterate() ) : ?>
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'theme-core/theme-elements/element', 'author-sidebar' );
						//get_template_part( 'theme-core/theme-elements/content', 'authorgrid' );
					?>
					<?php endwhile; ?>
				<?php else :
					get_template_part( 'theme-core/theme-elements/element', 'author-sidebar' );
				endif; ?>

			<?php endif; // end author widget area ?>

		<?php endif; // end author widget area ?>

		<?php if ( ! dynamic_sidebar( 'default-widget-area' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
				<hr/>
			</aside>

			<aside id="archives" class="widget">
				<h3 class="widget-title"><?php _e( 'Archives', 'mythology' ); ?></h3>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					<hr/>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h3 class="widget-title"><?php _e( 'Meta', 'mythology' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
					<hr/>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
<?php endif; ?>

<?php if( $myth_content_layout == "dual-right-sidebar" ) : ?>

	<div id="tertiary" class="widget-area <?php echo esc_attr( $tertiary_layout_classes ); ?>" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'default-widget-area-2' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
	</div><!-- #tertiary -->

<?php endif; ?>