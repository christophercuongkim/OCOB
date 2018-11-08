<?php get_header(); ?>

<div id="container">

<div class="navigation">
	<span class="floatleft"><?php previous_post_link('&laquo; %link') ?></span> <span class="floatright"><?php next_post_link(' %link &raquo;') ?></span>
</div>

	<div id="postcon">
		<?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
				
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					
					<div class="entry">
						
						<?php the_content(); ?>
						<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
						
						<div class="metabox">
							<?php _e('This entry was written by '); ?> <?php  the_author(); ?> <?php _e(', posted on '); ?> <?php the_time(' l F d Y') ?><?php _e('at '); ?>  <?php the_time(' h:m a') ?> <?php _e(', filed under '); ?> <?php the_category(', ') ?> 
							<?php if (get_the_tags()) : ?> <?php _e(' and tagged '); ?><?php the_tags(' ', ', ', ''); ?><?php endif; ?> 
							<?php _e('. Bookmark the '); ?><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" > <?php _e('permalink'); ?> </a> <?php _e('. Post a comment below or leave a trackback&#58; '); ?> <a href="<?php trackback_url(); ?>" title="<?php the_title(); ?>" > <?php _e('Trackback URL.'); ?> </a>
						</div>
												
						
						<?php comments_template(); ?>
						
						<div class="cle"></div>
					</div>
					
				</div>
				
			<?php endwhile; ?>
		<?php else : ?>
		
			<div class="post">
				<h2><?php _e('Not Found'); ?></h2>
			</div>
			
		<?php endif; ?>
	</div>
	
	<div class="navigation">
		<span class="floatleft"><?php previous_post_link('&laquo; %link') ?></span> <span class="floatright"><?php next_post_link(' %link &raquo;') ?></span>
	</div>
	
</div>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>