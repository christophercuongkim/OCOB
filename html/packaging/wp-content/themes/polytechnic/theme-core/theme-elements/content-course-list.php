<tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<td class="course-id">
		<?php echo esc_html( get_post_meta( get_the_ID(), 'course_unique_id', true ) ); ?>
	</td>
	<td class="course-number">
		<?php if(ot_get_option('link_course_number') == "on") : ?>
			<a href="<?php the_permalink() ?>">
				<?php echo esc_html( get_post_meta( get_the_ID(), 'course_number', true ) ); ?>
			</a>
		<?php else : ?>
			<?php echo esc_html( get_post_meta( get_the_ID(), 'course_number', true ) ); ?>
		<?php endif; ?>
	</td>
	<td class="course-name">
		<?php if(ot_get_option('link_course_name') == "on") : ?>
			<a href="<?php the_permalink() ?>">
				<?php echo esc_html( get_post_meta( get_the_ID(), 'course_name', true ) ); ?>
			</a>
		<?php else : ?>
			<?php echo esc_html( get_post_meta( get_the_ID(), 'course_name', true ) ); ?>
		<?php endif; ?>
	</td>
	<td class="course-instructor">
		<?php if(ot_get_option('link_course_instructor') == "on") : ?>
			<span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span>
		<?php else : ?>
			<span class="vcard author"><span class="fn"><?php the_author(); ?></span></span>
		<?php endif; ?>
	</td>
	<td class="course-room-number">
		<?php echo esc_html( get_post_meta( get_the_ID(), 'course_room_number', true ) ); ?>
	</td>
	<td class="course-days">
		<?php echo esc_html( get_post_meta( get_the_ID(), 'course_days', true ) ); ?>
	</td>
	<td class="course-time">
		<?php echo esc_html( get_post_meta( get_the_ID(), 'course_time', true ) ); ?>
	</td>
	<td class="course-credits">
		<?php echo esc_html( get_post_meta( get_the_ID(), 'course_credits', true ) ); ?>
	</td>
	<td class="course-prerequisites">
		<?php echo esc_html( get_post_meta( get_the_ID(), 'course_prerequisites', true ) ); ?>
	</td>

	<div class="display_none microformats-container">
		<!-- hAtom Requirement - Author -->
		<span class="vcard author"><span class="fn"></span></span>
		<!-- hAtom Requirement - Date -->
		<span class="date updated"></span>
	</div>

</tr><!-- #post-## -->