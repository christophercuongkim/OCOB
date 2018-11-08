<?php
/**
 * The Template for displaying all single posts.
 *
 * @package mythology
 */

get_header(); ?>

	<div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">
		<main id="main" class="site-main" role="main">

		<!-- Ad Space -->
		<?php if(ot_get_option('content_ad_space_layout') == 'off' OR ot_get_option('content_ad_space_layout') == 'No' ) : ?>
	        <?php get_template_part( 'theme-core/theme-elements/element', 'content-ad-space' ); ?>	
        <?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'theme-core/theme-elements/content', 'single' ); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>