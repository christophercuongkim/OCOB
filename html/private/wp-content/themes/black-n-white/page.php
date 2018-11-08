<?php get_header(); ?>

<div id="container">

<div class="navigation">
	<?php posts_nav_link('', '<span class="floatright">Next &raquo;</span>', '<span class="floatleft">&laquo; Previous</span>'); ?>
</div>

	<div id="postcon">
		<?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
				
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					
					<div class="entry">
					
						<div class="postmetadata">
							<?php _e('Published at&#58;'); ?> <?php the_time(' h:m a - l F d Y') ?>
						</div>
						
						<?php the_content(); ?>
						<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
						<?php edit_post_link('Edit', '<p>', '</p>'); ?>
						
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
		<?php posts_nav_link('', '<span class="floatright">Next &raquo;</span>', '<span class="floatleft">&laquo; Previous</span>'); ?>
	</div>
	
</div>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>