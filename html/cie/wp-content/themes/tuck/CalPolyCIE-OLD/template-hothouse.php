<?php
/**
 * Template Name: SLO HotHouse
 *
 * @package WordPress
 * @subpackage calpoly-cie
 * @since Cal Poly CEI 1.0
 */
get_header(); ?>

<div class="binding subpage">

	<header>

		<div class="section-label">&nbsp;</div>

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

	<?php $hero = get_field('hero'); 

	 if($hero == 'video'){ ?>

		<div class="video-wrapper">
			<video class="video" autoplay muted controls controlsList="nodownload">
				<source src="<?php the_field('hero_video'); ?>" type="video/mp4">
	  			<track src="<?php the_field('video_caption_file'); ?>" id="track1" kind="descriptions" srclang="en" label="English" />
	  			<track src="<?php the_field('video_caption_file'); ?>" id="track2" kind="captions" srclang="en" label="English" />
			</video>
			<!--<div class="playpause"></div> -->
		</div>  

	<?php } elseif ($hero == 'image') {

		if( have_rows('image_slider') ):
			echo '<div id="header-slider">';
		    while ( have_rows('image_slider') ) : the_row(); ?>
				<img src="<?php the_sub_field('image'); ?>">
		    <?php endwhile;
		    echo '</div>';
		endif;

	} ?>

	<?php cie_the_post_thumbnail_caption(); ?>

	<div class="copy hothouse-copy">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

	</div>

	<div id="hothouse-services">

		<h2>Located in Downtown San Luis Obispo, the SLO HotHouse is home to:</h2>

		<div class="service">
			<div class="border"></div>
			<a href="http://cie.calpoly.edu">
				CIE
			</a>
		</div>
		
		<div class="service">
			<div class="border"></div>
			<a href="http://sbdc.calpoly.edu">
				SBDC 
			</a>
		</div>
		<div class="service">
			<div class="border"></div>
			<a href="http://cie.calpoly.edu/coworking/">
				Coworking
			</a>
		</div>
		<div class="service">
			<div class="border"></div>
			<a href="http://cie.calpoly.edu/coworking/#cowork-incubator">
				Business<br>Incubator
			</a>
		</div>
	</div>

	<?php get_template_part('share'); ?>

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
				<?php } //end ForEach ?>
    	    </div>
		</div>
	</div>
<?php } ?>



<?php get_footer(); ?>
