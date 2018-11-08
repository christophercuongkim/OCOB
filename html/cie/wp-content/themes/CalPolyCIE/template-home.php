<?php
/**
 * Template Name: Home Page
 *
 * @package WordPress
 * @subpackage calpoly-cie
 * @since Cal Poly CIE 1.1
 */
get_header(); ?>


<!-- HOME PAGE HERO -->
<header id="home-hero" class="clearfix">

	<?php $hero = get_field('hero','option'); 

	 if($hero == 'video'){ ?>

		<div class="video-wrapper">
			<video class="video" autoplay muted controls>
				<source src="<?php the_field('hero_video', 'options'); ?>" type="video/mp4">
	  			<track src="<?php the_field('video_caption_file', 'options'); ?>" id="track1" kind="descriptions" srclang="en" label="English" />
	  			<track src="<?php the_field('video_caption_file', 'options'); ?>" id="track2" kind="captions" srclang="en" label="English" />
			</video>
			<!--<div class="playpause"></div> -->
		</div>  

	<?php } elseif ($hero == 'image') { ?>

		<div class="inner">
			<h1><span>Revolutionizing</span><br>
			Entrepreneurship</h1>
			<!--<a href="learn/cie-fellows/" class="cta">
				About CIE
			</a>-->
		</div>
		<?php if(have_rows('header_image','option')): ?>
			<?php $header_image = get_field('header_image','option'); shuffle($header_image); ?>
			<div class="header-imagery">
			<?php foreach( $header_image as $image ): ?>
				<div><img src="<?php echo $image['image']; ?>" alt=""></div>
			<?php endforeach; ?>
			</div>	
		<?php endif; ?>

	<?php } ?>

</header>
<!-- END HOME PAGE HERO -->


<!-- ABOUT SECTION -->

<section id="about" class="clearfix">
	<div class="binding">
		<?php if( get_field('about_headline','option') ): ?>
			<p><?php the_field('about_headline','option'); ?></p>
		<?php endif; ?>
		<p><?php the_field('about_description', 'option'); ?></p>
	</div>
</section>


<!-- NEWS & EVENTS SECTION -->

<section id="news-events">

	<header class="binding">

		<h1>News &amp; Events</h1>

	</header>

	<?php if(have_rows('newsevents_item','option')): ?>



		<div id="news-slider">

			<?php while(have_rows('newsevents_item','option')): the_row(); ?>

				<a href="<?php the_sub_field('url'); ?>" class="item" style="background-image:url('<?php the_sub_field('image') ?>');">
					<div class="copy">
						<div class="category"><?php the_sub_field('category'); ?></div>
						<h2><?php the_sub_field('headline'); ?></h2>
					</div>
				</a>

			<?php endwhile; ?>	

		</div>

	<?php endif; ?>


</section>


<!-- LEARN SECTION -->
<section id="learn" class="clearfix">
    
	<div class="binding clearfix">

		<header>
			<h1>Learn</h1>
			<p><?php the_field('learn_description', 'option'); ?></p>
		</header>

		<div class="pages clearfix">

		<?php if(have_rows('learn_pages','option')): ?>

			<?php while(have_rows('learn_pages','option')): the_row(); ?>
			<div class="page">
				<div class="inner">
                    <a href="<?php the_sub_field('url'); ?>" class="more">

						<?php // get Responsive Thumbnail
						$image = get_sub_field('thumbnail');
						$size = 'cie_homepage_thumbnail';
						echo wp_get_attachment_image( $image, $size );
						?>
                        <div class="copy">
                            <h2><?php the_sub_field('title'); ?></h2>
                            <p><?php the_sub_field('description'); ?></p>
                            <p class="readmore">Read More</p>
                        </div>
                    </a>
				</div>
			</div>
			<?php endwhile; ?>		

		<?php endif; ?>

		</div>

	</div>

	<div class="quote">

		<div class="binding clearfix simple-center">

			<div class="portrait">
				<img src="<?php bloginfo('template_directory') ?>/img/quote-arrow.png" height="31" width="31" class="arrow" alt="">
				<img src="<?php the_field('learn_quote_photo', 'option'); ?>" height="126" width="127" alt="<?php the_field('learn_quote_name', 'option'); ?>">
			</div>

			<div class="info clearfix">
				<h2>Learn</h2>
				<p>
					<strong><?php the_field('learn_quote_name', 'option'); ?></strong><br>
					<?php the_field('learn_quote_description', 'option'); ?>
				</p>
			</div>

			<div class="text">
				&ldquo;<?php the_field('learn_quote_quote', 'option'); ?>&rdquo;
			</div>

		</div>

	</div>
	
</section>
<!-- END LEARN SECTION -->



<!-- PREPARE SECTION -->
<section id="prepare" class="clearfix">

	<div class="binding">
		<div class="main">
			<header>
				<h1>Prepare</h1>
				<p><?php the_field('prepare_description', 'option'); ?></p>
			</header>
			<div class="events">

			<?php if(have_rows('prepare_events','option')): ?>

				<?php while(have_rows('prepare_events','option')): the_row(); ?>
				<a href="<?php the_sub_field('url'); ?>" class="item">
						<?php // get Responsive Thumbnail
						$image = get_sub_field('image');
						$size = 'cie_homepage_thumbnail';
						echo wp_get_attachment_image( $image, $size );
						?>					
					
					<div class="copy">
						<h2><?php the_sub_field('name'); ?></h2>
						<p><?php the_sub_field('description'); ?></p>
						<p class="readmore">Read More</p>
					</div>
				</a>
				<?php endwhile; ?>		

			<?php endif; ?>

			</div>
		</div>

		<div class="quote clearfix">
			<div class="info">
				<img src="<?php bloginfo('template_directory') ?>/img/quote-arrow-02.png" height="31" width="31" class="arrow" alt="">
				<img src="<?php the_field('prepare_quote_photo', 'option'); ?>" height="126" width="127" class="portrait" alt="<?php the_field('prepare_quote_name', 'option'); ?>">
				<div class="bio clearfix">
					<h2>Prepare</h2>
					<p>
						<strong><?php the_field('prepare_quote_name', 'option'); ?></strong><br>
						<?php the_field('prepare_quote_description', 'option'); ?>
					</p>
				</div>
			</div>
			<div class="text">
				&ldquo;<?php the_field('prepare_quote_quote', 'option'); ?>&rdquo;
			</div>
		</div>


	</div>
	
</section>
<!-- END PREPARE SECTION -->



<!-- LAUNCH SECTION -->
<section id="launch" class="clearfix">
	<div class="binding">

		<header>
			<h1>Launch</h1>
			<p><?php the_field('launch_description', 'option'); ?></p>
		</header>

		<div class="pages clearfix">

		<?php if(have_rows('launch_pages','option')): ?>

			<?php while(have_rows('launch_pages','option')): the_row(); ?>
			<div class="page">
				<div class="inner">
                    <a href="<?php the_sub_field('url'); ?>">
                    	<?php // get Responsive Thumbnail
							$image = get_sub_field('thumbnail');
							$size = 'cie_homepage_thumbnail';
							echo wp_get_attachment_image( $image, $size );
						?>
                        <div class="copy">
                            <h2><?php the_sub_field('title'); ?></h2>
                            <p><?php the_sub_field('description'); ?></p>
                            <p class="readmore">Read More</p>
                        </div>
                    </a>
				</div>
			</div>
			<?php endwhile; ?>		

		<?php endif; ?>

		</div>


	</div>

	<div class="quote">

		<div class="binding clearfix simple-center">

			<div class="portrait">
				<img src="<?php bloginfo('template_directory') ?>/img/quote-arrow-03.png" height="31" width="31" class="arrow" alt="">
				<img src="<?php the_field('launch_quote_photo', 'option'); ?>" height="126" width="127" alt="<?php the_field('launch_quote_name', 'option'); ?>">
			</div>

			<div class="info clearfix">
				<h2>Launch</h2>
				<p>
					<strong><?php the_field('launch_quote_name', 'option'); ?></strong><br>
					<?php the_field('launch_quote_description', 'option'); ?>
				</p>
			</div>

			<div class="text">
				&ldquo;<?php the_field('launch_quote_quote', 'option'); ?>&rdquo;
			</div>

		</div>

	</div>

</section>
<!-- END LAUNCH SECTION -->



<!-- MENTORS SECTION -->
<section class="clearfix" id="mentors">
	<div class="bkgd"></div>
	<div class="binding">

		<div class="content">

			<header>
				<h1>Mentors</h1>
				<p><?php the_field('mentors_description', 'option'); ?></p>
			</header>

			<div class="profiles clearfix">

			<?php if(have_rows('mentors_profiles','option')): ?>

				<?php while(have_rows('mentors_profiles','option')): the_row(); ?>
				<div class="profile">
					<div class="bkgd"></div>
					<div class="inner">
                        <a href="<?php the_sub_field('url'); ?>">
                            <h2><?php the_sub_field('name'); ?></h2>
                            <p><?php the_sub_field('description'); ?></p>
                            <p class="readmore">Read More</p>
                        </a> 
					</div>
					<div class="portrait" style="background-image:url(<?php the_sub_field('portrait'); ?>);"></div>
					<!--<img class="portrait" src="<?php the_sub_field('portrait'); ?>" height="296" width="344">-->
				</div>
				<?php endwhile; ?>		

			<?php endif; ?>


			</div>

		</div>

	</div>
</section>

<!-- END MENTORS SECTION -->

<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/css3scroll.js"></script>
<?php get_footer(); ?>