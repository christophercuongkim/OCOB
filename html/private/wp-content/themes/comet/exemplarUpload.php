<?php
/*
Template Name: Exemplar Upload
*/
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

	<!-- post -->
	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
		<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="post-text" style="padding-bottom: 200px">
		<p>To use, select the directories from the dropdown, forming the file path. Click "Add File" button to select the file/files you want to add to that directory. Finally, click "File Up" to upload the file/files.</p>

			<h5>Undergrad Upload:</h5>
			<?php echo do_shortcode('[fileup base="3" sub="/'.get_field("folder_name").'" overwrite="true" filetypes=".pdf"]');?>
			<br>
			<h5>Grad Upload:</h5>
			<?php echo do_shortcode('[fileup base="4" sub="/'.get_field("grad_folder_name").'" overwrite="true" filetypes=".pdf"]');?>

		</div>
		
	</div>
	<!--/post -->

	<div class="sep"></div>

	<?php endwhile; ?>

	<?php else : ?>

	<div class="post">
		<h1 class="post-title"><?php _e('Page not found','comet'); ?></h1>
		<div class="post-text">
			<p><?php _e('The page you were looking for could not be found.','comet'); ?></p>
		</div>
	</div>

<?php endif; ?>
<script>
String.prototype.startsWith = function(prefixes) {
	var tempStr = this.toLowerCase();
    for(var i = 0 ; i < prefixes.length; i++){
	    var prefix = prefixes[i];
	    if(tempStr.indexOf(prefix) === 0){
		    return true;
	    }
    }
    return false;
}
var syllabi = document.getElementsByClassName("ssfa-filename");
for(var i = 0; i < syllabi.length; i++){
	var syllabus = syllabi[i];
	var syllabusArray = syllabus.innerHTML.split(" ");
	if(syllabusArray[0].startsWith(["spring","summer","winter","fall","sp","su","wi","fa"])){
		syllabusArray.shift();
	}
	var syllabusText = syllabusArray.join(" ");
	syllabus.innerHTML = syllabusText;

}
</script>
<?php get_footer(); ?>
<style>
div[id^="ssfa-list-wrap"].ssfa-minimal-list div.ssfa-listitem {
	-moz-transition: none;
	-o-transition: none;
	-webkit-transition: none;
	transition: none;
}
div[id^="ssfa-list-wrap"].ssfa-minimal-list span.ssfa-topline{
	-moz-transition: none;
	-o-transition: none;
	-webkit-transition: none;
	transition: none;
}
</style>