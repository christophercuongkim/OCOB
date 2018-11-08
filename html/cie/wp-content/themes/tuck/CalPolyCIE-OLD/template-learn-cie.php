<?php
/**
 * Template Name: Learn Subpage (CIE Fellows)
 *
 * @package WordPress
 * @subpackage calpoly-cei
 * @since Cal Poly CEI 1.0
 */
get_header(); ?>


<div class="binding subpage">

	<header>

		<div class="section-label">Learn</div>

		<h1><?php echo get_the_title($post->ID); ?></h1>

	</header>

	<!--<?php wp_nav_menu( array(
		'menu' => 'Learn Menu',
		'container' => 'nav',
		'container_class' => 'subpage-menu',
	 )); ?>-->

	<nav class="subpage-menu">
		<ul id="menu-learn-menu" class="menu">
		<?php

			$home_class = '';
			if($post->ID === 66){
				$home_class = ' class="current_page_item"';
			}

		?>
		<li<?php echo $home_class; ?>><a href="<?php echo get_permalink(66); ?>">Home</a></li>
		<?php
			$root_id = get_root_parent_id($post->ID);
			echo $root_id;
			wp_list_pages(array(
				'child_of' => 66,
				'title_li' => null
			));
		?>
		</ul>
	</nav>

	<?php the_post_thumbnail('full', array( 'class' => 'hero-image' )); ?>

	<?php cie_the_post_thumbnail_caption(); ?>

	<div class="copy">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

	</div>

		<?php get_template_part('share'); ?>


</div>

<div class="fellows-extra-content lower-menu">
	<div class="binding clearfix">
        <div class="pages clearfix">
<?php
    $kids = get_pages(array('child_of' => 66, 'sort_column' => 'menu_order'));
    foreach ($kids as $childPage) { ?>
			<div class="page">
				<div class="inner">
                    <a href="<?php echo get_page_link($childPage->ID); ?>">
                        <div class="copy">
                            <h3><?php echo $childPage->post_title; ?></h3>
                            <p><?php  echo wp_trim_words(strip_shortcodes($childPage->post_content, 20 ) ); ?></p>
                            <p>READ MORE</p>
                        </div>
                    </a>
                </div>
            </div>
<?php } //end ForEach?>
        </div>
	</div>
</div>

<div class="subpage-footer clearfix">
	<div class="binding clearfix">

		<h2>Learn</h2>

		<p><?php the_field('learn_description', 'option'); ?></p>

		<div class="pages clearfix">
		<?php if(have_rows('learn_pages','option')): ?>

			<?php while(have_rows('learn_pages','option')): the_row(); ?>
			<div class="page">
				<div class="inner">
                    <a href="<?php the_sub_field('url'); ?>">
                        <?php // get Responsive Thumbnail
						$image = get_sub_field('thumbnail');
						$size = 'cie_homepage_thumbnail';
						echo wp_get_attachment_image( $image, $size );
						?>
                        <div class="copy">
                            <h3><?php the_sub_field('title'); ?></h3>
                            <p><?php the_sub_field('description'); ?></p>
							<p>READ MORE</p>
                       </div>
                    </a>
                </div>
			</div>
			<?php endwhile; ?>		

		<?php endif; ?>
		</div>

	</div>
</div>

<?php get_footer(); ?>