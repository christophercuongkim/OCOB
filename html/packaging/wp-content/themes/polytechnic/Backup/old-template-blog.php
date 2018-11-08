<?php
/*
 * Template Name: Blog
*/

get_header(); ?>

<!-- ============================================== -->

	<div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?> template-blog">		

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
		<main id="main" class="site-main" role="main">										
			
			<!-- THE POST QUERY -->
			<!-- This one's special because it'll look for our category filter and apply some magic -->

			<?php 

			wp_reset_query();

			global $paged;
			global $template_file;
			global $cat_string;
			global $format;

			if( get_post_custom_values('blog_post_count') ) :  
				$post_array = get_post_custom_values('blog_post_count');
				$post_count = join(',', $post_array);
			else : 
				$post_count = -1;
			endif;

			/* Get Category Filter */
			if(get_custom_field('blog_category_filter' )) :
				$cats = get_custom_field( 'blog_category_filter' );
				foreach ( $cats as $cat ) {
					$acats[] = $cat; 				
				}
				$cat_string = join(',', $acats);					
			endif;

			$args=array(
				'cat'=>$cat_string,			   // Query for the cat ID's (because you can't use multiple names or slugs... crazy WP!)
				'posts_per_page'=>$post_count, // Set a posts per page limit
				'paged'=>$paged,			   // Basic pagination stuff.
			   );

			query_posts($args); ?>

        	<?php if ( have_posts() ) : ?>

	        	<?php 
	        	global $myth_content_layout;

	        	if( $myth_content_layout == "no-sidebar" ) : ?>
		        	<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'theme-core/theme-elements/content', 'fullimage', get_post_format() );
						?>

					<?php endwhile; ?>
					<?php mythology_content_nav( 'nav-below' ); ?>

				<?php else : ?>

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
					
				<?php endif; ?>

			<?php else : ?>

				<?php get_template_part( 'theme-core/theme-elements/content', 'none' ); ?>

			<?php endif; ?>
							
		</main>
		
	</div>

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>