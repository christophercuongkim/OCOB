<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package mythology
 */

get_header(); ?>

	<div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">

		<main id="main" class="site-main" role="main">		

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'theme-core/theme-elements/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>