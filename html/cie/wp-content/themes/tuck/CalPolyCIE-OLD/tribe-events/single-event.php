<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

global $post;

?>
<?php //tribe_get_template_part( 'modules/bar' ); ?>
<div id="tribe-events-content" class="tribe-events-single vevent hentry">
	<div class="copy">
	<!-- Notices -->
	<?php tribe_events_the_notices() ?>

	<a href="<?php bloginfo('url'); ?>/events" class="all-events">&laquo; All Events</a>

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('event'); ?>>
			<!-- Event Meta -->
			<?php do_action( 'tribe_events_before_the_meta' ) ?>
			<div class="tribe-events-event-meta vcard">
				<div class="author <?php echo esc_attr( $has_venue_address ); ?>">

					<!-- Schedule & Recurrence Details -->
					<div class="updated published time-details">
						<strong><?php echo tribe_events_event_schedule_details(); ?></strong>
						&nbsp;&nbsp;|&nbsp;&nbsp;
						<?php echo tribe_get_start_date($post,true, 'g:i a'); ?> - <?php echo tribe_get_end_date($post,true, 'g:i a'); ?>
						<?php if(tribe_get_venue()) echo '&nbsp;&nbsp;@&nbsp;&nbsp;' . tribe_get_venue(); ?>
						<?php if(calendar_event_categories($post)) echo '&nbsp;&nbsp;|&nbsp;&nbsp;' . calendar_event_categories($post); ?> 
					</div>

				</div>
			</div><!-- .tribe-events-event-meta -->
			<?php do_action( 'tribe_events_after_the_meta' ) ?>

			<?php the_title( '<h2 class="tribe-events-list-event-title">', '</h2>' ); ?>

			<?php the_post_thumbnail('full', array( 'class' => 'hero-image' )); ?>

			<?php echo cie_the_post_thumbnail_caption($post->ID); ?>



			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content entry-content description clearfix">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php // do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<?php get_template_part('share','index'); ?>

		</div> <!-- #post-x -->
	<?php endwhile; ?>

	<!-- Event footer -->

	<!-- #tribe-events-footer -->
	</div>
	<?php comments_template(); ?> 

		<!-- Navigation -->
		<div class="binding">
			<?php previous_post_link('<div class="blog-prev-next"><div class="inner">Previous Blog Post %link </div></div>'); ?>
			<?php next_post_link('<div class="blog-prev-next"><div class="inner">Next Blog Post %link </div></div>'); ?>
		</div>
		<!-- .tribe-events-sub-nav -->

</div><!-- #tribe-events-content -->
