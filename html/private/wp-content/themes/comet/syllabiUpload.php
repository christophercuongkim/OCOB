<?php
/*
Template Name: Syllabi Upload
*/
?>
<?php get_header(); ?>

	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
		<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="post-text" style="padding-bottom: 200px">
			<p>To use, select the directories from the dropdown, forming the file path. Click "Add File" button to select the file/files you want to add to that directory. Finally, click "File Up" to upload the file/files.</p>
			<p><a href="<?php echo the_field('link_to_current_syllabi_page');?>">Go to current syllabi page &#8594;</a></p>
			<?php echo do_shortcode('[fileup base="1" sub="/'.get_field("folder_name").'" overwrite="true" filetypes=".pdf"]');?>
		</div>		
	</div>

<?php get_footer(); ?>