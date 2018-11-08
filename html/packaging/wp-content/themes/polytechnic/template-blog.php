<?php
/*
 * Template Name: Blog
*/

get_header(); 

?>

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

		<!-- Meta -->
		<?php if(get_custom_field('show_page_meta') == "on" ) : ?>

			<div class="theme_hook meta-string sixteen columns page-meta">
				<span class="format-icon"><i class="gen-enclosed foundicon-page" title="Standard Page"></i></span>
				
				<?php // AUTHOR ?>
				<?php if(get_custom_field('show_page_by') == "on" ) : ?>
					<div class="entry-meta-item columns">
						<span class="bullet"><i aria-hidden="true" data-icon="&#xe600;"></i></span>
						<span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span>
					</div>
				<?php else : ?>
					<!-- hAtom Requirement - Author -->
					<span class="vcard author"><span class="fn"></span></span>
				<?php endif; ?>

				<?php // DATE ?>
				<?php if(get_custom_field('show_page_date') == "on" ) : ?>
					<div class="entry-meta-item columns">
						<span class="bullet"><i aria-hidden="true" data-icon="&#xe616;"></i></span>					
						<span class="date updated"><?php the_modified_date('F j, Y'); ?></span>
					</div>
				<?php else : ?>
					<!-- hAtom Requirement - Date -->
					<span class="date updated"></span>
				<?php endif; ?>

				<?php // CATEGORIES ?>
				<?php if(get_custom_field('show_page_categories') == "on" ) : ?>
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'mythology' ) );
						if ( $categories_list && mythology_categorized_blog() ) :
					?>
					<div class="entry-meta-item columns">
						<span class="bullet"><i aria-hidden="true" data-icon="&#xe60e;"></i></span>	
						<span class="cat-links">
							<?php printf( __( '%1$s', 'mythology' ), $categories_list ); ?>
						</span>
					</div>
					<?php endif; // End if categories ?>
				<?php endif; ?>

				<?php // COMMENT COUNT ?>
				<?php if(get_custom_field('show_page_comments_count') == "on" ) : ?>
					<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
						<div class="entry-meta-item columns">
							<span class="bullet"><i aria-hidden="true" data-icon="&#xe611;"></i></span>	
							<span class=""><?php comments_popup_link( __( 'Leave a comment', 'mythology' ), __( '1 Comment', 'mythology' ), __( '% Comments', 'mythology' ) ); ?></span>
						</div>
					<?php endif; ?>
				<?php endif; ?>

			</div>

		<?php endif; ?>
		<!-- /End Meta -->

		<!-- hAtom Checks -->
		<?php if ( ( get_custom_field('show_page_meta') != "on" ) ) : ?>
			<div class="microformats-container">
				<!-- hAtom Requirement - Author -->
				<span class="vcard author"><span class="fn"></span></span>
				<!-- hAtom Requirement - Date -->
				<span class="date updated"></span>
			</div>
		<?php endif; ?>
		<!-- /End hAtom Checks -->

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
			global $post_type;

			if (is_front_page()) :
				$paged = get_query_var('page') ? get_query_var('page') : 1;
			endif;
			// 1.0.4 fix for pagination - $paged = get_query_var('page') ? get_query_var('page') : 1;
			if ( get_query_var('paged') ) {
			 $paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
			 $paged = get_query_var('page');
			} else {
			 $paged = 1;
			}

			if( get_post_custom_values('blog_post_count') ) :  
				$post_array = get_post_custom_values('blog_post_count');
				$post_count = join(',', $post_array);
			else : 
				$post_count = -1;
			endif;

			// GET CUSTOM POST TYPES
			if (!empty(get_custom_field('blog_post_type'))) :
				$post_type = get_custom_field('blog_post_type');
			else :
				$post_type = 'post';
			endif;

			/* Get Category Filter */
			if(get_custom_field('blog_category_filter' )) :
				$cats = get_custom_field( 'blog_category_filter' );
				foreach ( $cats as $cat ) {
					$acats[] = $cat; 				
				}
				$cat_string = join(',', $acats);					
			endif;
			/* Set Post Tax_Query */
			if (!empty($cat_string)) :
				$cat_string_array = array(
					'taxonomy' 	 => 'category', // THIS IS THE FORMAL TAXOMONY SLUG
					'field'		 => 'id',
					'terms'		 => $cat_string // Should return an array of category (taxonomy) IDs - ie: array( 43, 66, 108 ) - NOT just the numbers!
				);
			else :
				$cat_string_array = null;
			endif;

			/* Get Tribe Category Filter */
			if(get_custom_field('blog_category_filter_tribe' )) :
				$cats_tribe = get_custom_field( 'blog_category_filter_tribe' );
				foreach ( $cats_tribe as $cat_tribe ) {
					$acats_tribe[] = $cat_tribe; 				
				}
				$cat_string_tribe = join(',', $acats_tribe);					
			endif;	
			/* Set Tribe Tax_Query */
			if (!empty($cat_string_tribe)) :
				$cat_string_tribe_array = array(
					'taxonomy' 	 => 'tribe_events_cat', // THIS IS THE FORMAL TAXOMONY SLUG
					'field'		 => 'id',
					'terms'		 => $cat_string_tribe // Should return an array of category (taxonomy) IDs - ie: array( 43, 66, 108 ) - NOT just the numbers!
				);
			else :
				$cat_string_tribe_array = null;
			endif;

			

			$blog_args = array(
				'post_type'=>$post_type,
				'tax_query'			 => array(
					'relation' => 'OR',
					$cat_string_tribe_array,
					$cat_string_array,
				),
				// 'cat'=>$cat_string_tribe,			   // Query for the cat ID's (because you can't use multiple names or slugs... crazy WP!)
				'posts_per_page'=>$post_count, // Set a posts per page limit
				'paged'=>$paged,			   // Basic pagination stuff.
			 );

			global $blog_args;
			$wp_query = new WP_Query( $blog_args ); 

			?>

        	<?php if ( $wp_query->have_posts() ) : ?>

	        	<?php 
	        	global $myth_content_layout;

	        	if( $myth_content_layout == "no-sidebar" ) : ?>
		        	<?php /* Start the Loop */ ?>
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
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
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
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

				<?php wp_reset_postdata(); ?>

			<?php else : ?>

				<?php get_template_part( 'theme-core/theme-elements/content', 'none' ); ?>

			<?php endif; ?>
							
		</main>
		
	</div>

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>