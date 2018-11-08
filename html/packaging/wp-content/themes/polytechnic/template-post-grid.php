<?php

/*

 * Template Name: Post Grid

 *

 * @package mythology

 */



get_header();



	// Get PAGE level custom_fields from the Skeleton Post Grid meta-box. //

	// FILTER BUTTONS

	if(get_custom_field('show_category_buttons') == 'off') : 

		$filter_buttons = "hide";

		endif;


	// MODULE CONTENT

	if(get_custom_field('show_module_content') == 'off') : 

		$module_content = "hide";

		endif;

		// MODULE TITLE

		if(get_custom_field('show_module_title') == 'off') : 

			$module_title = "hide";

			endif;

		// MODULE EXCERPT

		if(get_custom_field('show_module_excerpt') == 'off') : 

			$module_excerpt = "hide";

			endif;

		// MODULE CATEGORY(S)

		if(get_custom_field('show_module_category') == 'off') : 

			$module_category = "hide";

			endif;

		// MODULE LINKS

		if(get_custom_field('show_module_links') == 'off') : 

			$module_links = "hide";

			endif;



	// Set whether this is masonry or fitRows

	if(get_custom_field('isotope_mode') == 'masonry') : 

		$isotope_mode = "masonry";

		else : 

		$isotope_mode = "fitRows";

		endif;



	// Open thumbs in a lightbox or a full post?

	if(get_custom_field('open_thumbs_in_lightbox') == 'on' ) :

		$lightbox = "lightbox";

		endif;



	// These globals are set up in functions.php. We are simply declaring that we intend to use them. //

	global $imgwidth;

	global $imgheight;

	global $imagecrop;



	// Image Sizing & Cropping //

	$imgwidth = 400;

	$imgheight = 600;



	if (get_custom_field('maintain_aspect_ratio') == 'off' ) : 

		$imagecrop = "crop"; // Turn cropping on and establish the crop size.

			if (get_custom_field('cropped_image_width')) : 

				$imgwidth = get_custom_field('cropped_image_width', $theme_options, false, true, 0 );

				endif;

			if (get_custom_field('cropped_image_height')) : 

				$imgheight = get_custom_field('cropped_image_height', $theme_options, false, true, 0 );

				endif;

		else : // Turn cropping Off and set the size limits.

			if (get_custom_field('uncropped_image_width')) : 

				$imgwidth = get_custom_field('uncropped_image_width', $theme_options, false, true, 0 );

				endif;

			if (get_custom_field('uncropped_image_height')) : 

				$imgheight = get_custom_field('uncropped_image_height', $theme_options, false, true, 0 );

				endif;

		endif;	

		

	// Set the columns class for each module.

	if(get_custom_field('columns_count') != '') : 

		$columns = get_custom_field('columns_count');

		else : 

		$columns = "four columns";

		endif; 



?>



<div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">

	<main id="main" class="site-main" role="main">



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

			<?php endif; ?>	

		</div>



		<div id="skeleton-wrap">

			<div id="skeleton-filter" class="left text-left clearfix <?php echo esc_attr( $filter_buttons ); ?>">

				<a class="button all-button" href="#" data-filter="*">All</a>

				<!-- Grab just the category slugs and list them using our markup -->

				<?php

				if(get_post_custom_values('grid_category_filter')) :

					$cats = get_custom_field( 'grid_category_filter' );

					foreach ( $cats as $cat ) {	

						$cat = urldecode($cat);	

						$cat = get_cat_slug($cat);

						$cat_name = get_term_by( 'slug', $cat, 'category');

						$catsluglink = '<a class="button" href="#" data-filter=".'.$cat.'">' . $cat_name->name . '</a> ';

						$acats[] = $catsluglink;

					}							    

					$cat_string = join(' ', $acats);

					$cat_string = urldecode($cat_string);

					printf ($cat_string);	

				else :

					$cats = get_all_category_ids();

					foreach ( $cats as $cat ) {	

						$cat = urldecode($cat);	

						$cat = get_cat_slug($cat);

						$cat_name = get_term_by( 'slug', $cat, 'category');

						$catsluglink = '<a class="button" href="#" data-filter=".'.$cat.'">' . $cat_name->name . '</a> ';

						$acats[] = $catsluglink;

					}

					$cat_string = join(' ', $acats);

					$cat_string = urldecode($cat_string);

					printf ($cat_string);	

				endif;

				?>

			</div>



			<div id="skeleton-container" data-isotope="<?php echo esc_attr( $isotope_mode ); ?>">

							

				

				<?php if (has_post_thumbnail( $post->ID )) : 

					$thumb = get_post_thumbnail_id();

					$image = vt_resize( $thumb, '', '1600', '9999', false );

					?>

					<style type="text/css">

					body{

						background: url('<?php echo esc_url( $image[url] ); ?>') no-repeat center center fixed; 

						  -webkit-background-size: cover;

						  -moz-background-size: cover;

						  -o-background-size: cover;

						  background-size: cover;

						}

					</style>

				<?php endif; ?>

				<?php endwhile; // end of the loop. ?>



				<?php wp_reset_query();



				global $paged;

				global $template_file;

				$cat_string = '';

				$format = '';



				if( get_post_custom_values('grid_post_count') ) :  

					$post_array = get_post_custom_values('grid_post_count');

					$post_count = join(',', $post_array);

					else : 

					$post_count = -1;

					endif;



				/* Get Category Filter */

				if(get_custom_field('grid_category_filter' )) :

					$cats = get_custom_field( 'grid_category_filter' );

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



				<?php while (have_posts()) : the_post(); ?>									



					<!-- ONLY DISPLAY MODULES W/ FEATURED IMAGES -->	

					<?php if (has_post_thumbnail( $post->ID )) : 

						$thumb = get_post_thumbnail_id(); 

						$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

						global $imgwidth;

						global $imgheight;

						global $imagecrop;

						if (($imagecrop) == 'crop' ) : 

							$image = vt_resize( $thumb, '', $imgwidth, $imgheight, true );

							else : 

							$image = vt_resize( $thumb, '', $imgwidth, $imgheight, false );

							endif;

						

						// DETERMINE THE LINKING

						$post_grid_link = "reveal";								// DEFAULT

						$post_grid_url = get_custom_field('custom_grid_url'); 	// DEFAULT



						if(get_custom_field('post_grid_link') == "off" ) :

								$post_grid_link = "hide";

								$post_grid_url = " ";

							else : 

								$post_grid_url = get_permalink();

								$post_grid_link = "reveal";

								if(get_custom_field('custom_grid_url')) : 

									$post_grid_url = get_custom_field('custom_grid_url');

								endif;

						endif;



						if ($lightbox == 'lightbox') :

							$post_grid_url = $image_full[0];

								if(get_custom_field('custom_grid_url')) : 				

									$post_grid_url = get_custom_field('custom_grid_url');

								endif;

						endif;



						if (get_custom_field('custom_post_color')) : 

							$custom_post_color = get_custom_field('custom_post_color');

						else :

							$custom_post_color = ot_get_option('theme_primary_color');

						endif;
								

						?>



						<!--Start Individual Module Markup-->

						<div id="post-<?php the_ID(); ?>" class="module hover-text <?php echo esc_attr( $columns ); echo esc_attr( ' ' ); ?>

							<?php $post_slug = str_replace(" ", "-",$post->post_name);

								$postcats = get_the_category();

								if ($postcats) {

								  foreach($postcats as $cat) {

									echo esc_attr( urldecode($cat->slug) . ' ' );

									}

								}

							?>" >



							<div class="module-inner">



								<div class="module-image">			

									<img class="" src="<?php echo esc_url( $image['url'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" alt="<?php the_title(); ?>" />

							 	</div>



							 	<div class="module-content <?php echo esc_attr( $module_content ); ?>">	

								 	<div class="">							 		

									 	<div class="module-content-inner">

									 		

								 		 	<h2 class="module-title <?php echo esc_attr( $module_title ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

										 	<div class="module-excerpt <?php echo esc_attr( $module_excerpt ); ?>"> <?php the_excerpt() ?>

										 	</div>


										 	<!-- translators: used between list items, there is a space after the comma -->
										 	<h4 class="module-category <?php echo esc_attr( $module_category ); ?>"><?php echo get_the_category_list( __( ', ', 'mythology' ) ); ?></h4>										 	

										</div>										

								 	</div>

							 	</div>

							 	<div class="module-background" style="background-color: <?php echo esc_attr( $custom_post_color );?>;"></div>



							 	<div class="module-links <?php echo esc_attr( $module_links ); ?>">

								 	<div class="lightboxLink">

										<a href="<?php echo esc_url( $lightbox_link ); ?><?php echo esc_url( $post_grid_url );?>" class="popLink boxLink <?php echo esc_attr( $post_grid_link ); ?> <?php echo esc_attr( ' ' ) . esc_attr( $lightbox ); ?>" data-rel="lightbox[<?php the_title(); ?>]" title="<?php the_title(); ?>">

											<i aria-hidden="true" data-icon="&#xe629;"></i>

										</a>

									</div>						    

									<div class="thumbLink">

										<a class="popLink" href="<?php the_permalink(); ?>" title="Full Post">

											<i aria-hidden="true" data-icon="&#xe627;"></i>

										</a>

									</div>

								</div>



							 </div>

						 	<!--/End Module Inner -->



						</div>

						<!--/End Module Markup -->



					<?php endif; ?>																							

				<?php endwhile; ?>		

			</div>



		</div>



	</main><!-- #main -->

</div><!-- #primary -->



<?php include ( get_template_directory() . "/sidebar.php"); ?>

<?php include ( get_template_directory() . "/footer.php"); ?>