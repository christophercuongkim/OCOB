<?php
/**
 * Template Name: Coworking
 *
 * @package WordPress
 * @subpackage calpoly-cei
 * @since Cal Poly CEI 1.0
 */
get_header(); ?>

<div class="binding subpage">

	<header>

		<div class="section-label">&nbsp;</div>

		<h1><?php echo get_the_title($post->ID); ?></h1>

	</header>


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


	<div class="copy cowork">

		<div class="hero-caption slider"><?php the_field('header_slider_caption'); ?></div>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

	</div>

</div>

<div id="cowork-deets">

	<div class="inner">

		<div class="col">
			<h3>All-inclusive Membership Amenities</h3>
			<ul>
			<?php

				if( have_rows('membership_amenities') ):
					echo '<div id="hothouse-slider">';
				    while ( have_rows('membership_amenities') ) : the_row(); ?>
						<li><?php the_sub_field('amenity'); ?></li>
				    <?php endwhile;
				    echo '</div>';
				endif;

			?>
			</ul>
		</div>

		<div class="col">
			<h3>Membership Rates</h3>
			<ul>
			<?php

				if( have_rows('membership_rates') ):
					echo '<div id="hothouse-slider">';
				    while ( have_rows('membership_rates') ) : the_row(); ?>
						<li><?php the_sub_field('rate'); ?></li>
				    <?php endwhile;
				    echo '</div>';
				endif;

			?>
			</ul>
		</div>

	</div>

</div>

	<div class="pullquote mobile-only">
		<div class="preview">
			“Coworking at the Hothouse has been instrumental in engaging our business&hellip;
			<div class="read-more">Read More</div>
		</div>
		<div class="full">
			<p>“Coworking at the Hothouse has been instrumental in engaging our business with students and the wider SLO community. Being surrounded by an atmosphere of innovation and out-of-the-box thinkers has enabled us to ideate concepts we would not have thought possible before. It’s been a huge asset towards our success.”</p>
			<p class="source"><strong>&mdash; John Osumi</strong><br>CEO of Bishop Peak Technologies</p>
		</div>
	</div>

<div id="cowork-tour">
	<div class="description">
		<h3>Tour</h3>
		<p><?php the_field('tour_copy'); ?></p>
		<a class="cta" href="mailto:nrelliot@calpoly.edu">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/img/cta-schedule-tour.png" width="261" height="37" alt="Schedule a tour">
		</a>
	</div>
	<img src="<?php bloginfo('stylesheet_directory'); ?>/img/cowork-tour-thumb.jpg" class="thumb">
</div>

<div id="cowork-apply">
	<div class="inner">
		<h3>Apply</h3>
		<p><?php the_field('application_copy'); ?></p>
		<a class="cta" href="../application">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/img/cta-apply.png" width="261" height="37" alt="Apply">
		</a>
	</div>
</div>

<div id="cowork-quote" style="margin-bottom: 53px;">

	<div class="binding clearfix simple-center">

		<div class="portrait">
			<img src="<?php the_field('quote_photo'); ?>" height="126" width="127" alt="">
		</div>

		<div class="info clearfix">
			<h2>Coworking</h2>
			<p>
				<?php the_field('quote_name'); ?><br>
				<?php the_field('quote_description'); ?>
			</p>
		</div>

		<div class="text">
			&ldquo;<?php the_field('quote'); ?>&rdquo;
		</div>
		</div>
	</div>
</div>

<?php get_template_part('share'); ?>



<?php get_footer(); ?>
