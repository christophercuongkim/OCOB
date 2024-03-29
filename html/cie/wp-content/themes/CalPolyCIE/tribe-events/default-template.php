<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
?>
<div class="binding subpage">

	<header>

		<h1><a href="<?php bloginfo('url'); ?>/events">Events</a></h1>
		<?php if(is_tax()): ?>
			<h2>Category: <span><?php single_cat_title(); ?></span></h2>
		<?php endif; ?>

	</header>
	<?php tribe_events_before_html(); ?>
	<?php tribe_get_view(); ?>
	<?php tribe_events_after_html(); ?>

</div> <!-- #tribe-events-pg-template -->
<?php
get_footer();
