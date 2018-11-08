<?php
/**
 * The Template for displaying all single posts.
 *
 * @package mythology
 */

get_header(); ?>

	<div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">
		<main id="main" class="site-main" role="main">

		<!-- Cycle through without loop declared -->
		<?php while ( have_posts() ) : the_post();?>

			<?php get_template_part( 'theme-core/theme-elements/content', 'course' ); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php wp_reset_query(); ?>
<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>