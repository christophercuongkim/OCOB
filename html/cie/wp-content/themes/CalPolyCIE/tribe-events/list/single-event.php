<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $post;

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>

<div class="event">

<!-- Event Meta -->
<?php do_action( 'tribe_events_before_the_meta' ) ?>
<div class="tribe-events-event-meta vcard clearfix">
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

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<h2 class="tribe-events-list-event-title">
	<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
		<?php the_title() ?>
	</a>
</h2>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>


<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ) ?>
<div class="">
	<?php the_excerpt() ?>
	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'View Event Details', 'tribe-events-calendar' ) ?></a>
</div><!-- .tribe-events-list-event-description -->
<?php
do_action( 'tribe_events_after_the_content' ); ?>

</div>
