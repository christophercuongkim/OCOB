<?php
/**
 * Template Name: About CIE
 *
 * @package WordPress
 * @subpackage calpoly-cei
 * @since Cal Poly CEI 1.0
 */
get_header(); ?>

<div id="main-wrapper" class="binding subpage">

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

</div>

<?php if ( have_rows( 'content' ) ): ?>
	<?php while ( have_rows( 'content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'stats' ) : ?>
			<div id="stats" class="binding subpage">
				<div class="inner">
					<h2>Impact Stats</h2>
					<p class="intro"><?php the_sub_field( 'stats_intro' ); ?></p>	
					<div id="stat-wrapper">
					  <?php if ( have_rows( 'stats' ) ) : ?>
					      <?php $showitems = 2; $i = 0;$maincount = 0; ?>
					      <div class="col">
					      <?php while ( have_rows( 'stats' ) ) : the_row(); ?>
					            <div class="stat stat-<?php echo $maincount; ?>">
					            	<div class="icon">
						                <?php if ( get_sub_field( 'stat_icon' ) ) { ?>
						                    <img src="<?php the_sub_field( 'stat_icon' ); ?>" />
						                <?php } ?>
					                </div>
					                <div class="text">
						                <h5><?php the_sub_field( 'stat_headline' ); ?></h5>
						                <p><?php the_sub_field( 'stat_copy' ); ?></p>
					                </div>
					            </div>
					      <?php $i++;$maincount++; ?>
					      <?php if ($i == $showitems && $maincount < 5) {
					                $showitems = $showitems == 2 ? 1 : 2;
					                ?></div><!-- end .col //--><div class="col"><?php
					                $i = 0;
					            }
					      endwhile; ?>
					      </div><!-- End .col //-->
					  <?php else : ?>
					      <?php // no rows found ?>
					  <?php endif; ?>
					</div>
				</div>
			</div>
		<?php elseif ( get_row_layout() == 'mission' ) : ?>
			<div id="mission">
				<div class="binding subpage">
					<div class="inner">
						<h2>Mission</h2>
						<p class="intro"><?php the_sub_field( 'mission' ); ?></p>
					</div>
				</div>
			</div>
		<?php elseif ( get_row_layout() == 'timeline' ) : ?>
			<div id="timeline" <?php if ( get_sub_field( 'timeline_background' ) ) { ?>
				style="background-image:url('<?php the_sub_field( 'timeline_background' ); ?>')"
				<?php } ?>>
				<div class="binding subpage">
					<div class="inner">
						<h2>CIE Short Story</h2>
						<p class="intro"><?php the_sub_field( 'timeline_intro' ); ?></p>
					</div>
					<?php echo do_shortcode(get_sub_field( 'timeline_code' )); ?>
				</div>
			</div>
		<?php elseif ( get_row_layout() == 'staff' ) : ?>
			<div id="staff" class="binding subpage">
				<div class="inner">
					<h2>CIE Staff Bios</h2>
					<p class="intro"><?php the_sub_field( 'staff_intro' ); ?></p>
					<?php $bios = get_sub_field( 'bios' ); ?>
					<?php if ( $bios ): ?>
						<div id="staff-wrapper">
							<?php foreach ( $bios as $bio ): ?>
								<div class="single-staff">
								<?php $staff_photo = get_field( 'staff_photo', $bio ); ?>
								<?php if ( $staff_photo ) { ?>
									<div class="staff-image">
										<?php echo wp_get_attachment_image( $staff_photo, array('125', '125', TRUE) ); ?>
									</div>
								<?php } ?>
								<div class="single-staff-wrap">
									<h3><a href="<?php echo get_permalink( $bio ); ?>"><?php echo get_the_title( $bio ); ?></a></h3>
									<h4><?php the_field( 'staff_title', $bio ); ?></h4>
									<em class="email"><a href="mailto:<?php the_field( 'staff_email', $bio ); ?>"><?php the_field( 'staff_email', $bio ); ?></a></em>
									<p><?php the_field( 'staff_bio_excerpt', $bio ); ?></p>
									<a class="more" href="<?php echo get_permalink( $bio ); ?>">View More</a>
								</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>


<?php get_footer(); ?>