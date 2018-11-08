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

get_header(); ?>

	<div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">
		<main id="main" class="site-main" role="main">

		<!-- Ad Space -->
		<?php if(ot_get_option('content_ad_space_layout') == 'off' OR ot_get_option('content_ad_space_layout') == 'No' ) : ?>
	        <?php get_template_part( 'theme-core/theme-elements/element', 'content-ad-space' ); ?>	
        <?php endif; ?>

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'theme-core/theme-elements/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php mythology_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'theme-core/theme-elements/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>