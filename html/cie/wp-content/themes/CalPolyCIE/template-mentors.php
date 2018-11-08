<?php
/**
 * Template Name: Mentors Subpage
 *
 * @package WordPress
 * @subpackage calpoly-cie
 * @since Cal Poly CIE 1.0
 */
get_header();  

// Check if post has children
	$postChildrenCount = get_pages('child_of='.$post->ID);
	if( count( $postChildrenCount ) != 0 ) {
		// has children 
			$children = wp_list_pages('sort_column=menu_order&depth=1&title_li=&child_of='.$post->ID.'&echo=0');
			$getChildren = $post->ID;
			$home = '<li class="current_page_item"><a href="'.get_the_permalink($getChildren).'">Home</a></li>';
	} else { 
		// has no children
		// check if it has two or more parents
		$parent = get_post($post->post_parent);
		if ($parent->post_parent) {
			// you're in a grandchild
			$children = wp_list_pages('sort_column=menu_order&depth=1&title_li=&child_of='.$post->post_parent.'&echo=0');
			$getChildren = $post->post_parent;
			$home = '<li><a href="'.get_the_permalink($getChildren).'">Home</a></li>';
			$grandchild = ' / '.get_the_title($getChildren);
		}
	}
?>

<div class="binding subpage">

	<header>

		<div class="section-label">Mentors<?php if ($grandchild) echo $grandchild; ?></div>

		<h1><?php echo get_the_title($post->ID); ?></h1>


	</header>

	<?php
	// Subpage Menu: If $children exists, display submenu 
	if ($children) { ?>

		<nav class="subpage-menu">
			<ul>
				<?php echo $home; ?>
				<?php echo $children; ?>
			</ul>
		</nav>  

	<?php } ?>

	<?php the_post_thumbnail('full', array( 'class' => 'hero-image' )); ?>

	<?php cie_the_post_thumbnail_caption(); ?>

	<div class="copy">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

	</div>

	<?php get_template_part('social'); ?>

</div>

<?php // If $children exists, display pre-footer 
	if ($children) { ?>
	<div class="fellows-extra-content lower-menu">
		<div class="binding clearfix">
	        <div class="pages clearfix">
				<?php
				$kids = get_pages(array('child_of' => $getChildren, 'sort_column' => 'menu_order'));
		    	foreach ($kids as $childPage) { ?>
				<div class="page">
					<div class="inner">
		        		<a href="<?php echo get_page_link($childPage->ID); ?>">
		                  	<div class="copy">
		                   		<h3><?php echo $childPage->post_title; ?></h3>
		                   		<p><?php echo wp_trim_words(strip_shortcodes($childPage->post_content, 20 ) ); ?></p>
		                   		<p>READ MORE</p>
		                  	</div>
						</a>
		         	</div>
		        </div>
				<?php } //end ForEach?>
    	    </div>
		</div>
	</div>
<?php } ?>

<div class="subpage-footer clearfix">
	<div class="binding clearfix">

		<h2>Mentors</h2>

		<p><?php the_field('mentors_description', 'option'); ?></p>

		<div class="profiles clearfix">
			<?php if(have_rows('mentors_profiles','option')): ?>

				<?php while(have_rows('mentors_profiles','option')): the_row(); ?>
				<div class="profile">
					<div class="bkgd"></div>
					<div class="inner">
						<a href="<?php the_sub_field('url'); ?>">
                            <h2><?php the_sub_field('name'); ?></h2>
                            <p><?php the_sub_field('description'); ?></p>
                            <p>READ MORE</p> 
                        </a>
					</div>
					<div class="portrait" style="background-image:url(<?php the_sub_field('portrait'); ?>);"></div>
				</div>
				<?php endwhile; ?>		

			<?php endif; ?>
		</div>

	</div>
</div>

<?php get_footer(); ?>