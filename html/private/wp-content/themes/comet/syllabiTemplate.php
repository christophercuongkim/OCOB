<?php
/*
Template Name: Syllabi Display
*/
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

	<!-- post -->
	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
		<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="post-text">

		</div>
		<div class="post-meta">
			<div class="row">
				<em><strong>Course Syllabi <?php echo get_field("term");?></strong> 
				Available when received -</em> Please contact <u><a href="mailto:ocob-online@calpoly.edu" target="_top">ocob-online@calpoly.edu</a></u> to submit your syllabus for posting.
				<table style="height: 651px; width: 100%;" border="0">
				<tbody>
				
				<tr>
				<td valign="top" width="34%"><em><strong><u>Accounting</u></strong></em>
				<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/acct" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?>
				</td>
				
   				<td valign="top" width="34%"><em><strong><u>Graduate Courses</u></strong></em>
   				<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/grad" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?>
				</td>
				
    			<td valign="top" width="34%"><em><strong><u>ITP</u></strong></em>
    			<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/itp" size="no" hcolor="black" color="green" icons="none" corners="sharp" exclude=".DS_Store, ._.DS_Store"]');?>
				</td>
				</tr>

				<tr>
				<td valign="top" width="34%"><em><strong><u>Marketing</u></strong></em>
	   			<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/marketing" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?>
				</td>
				
    			<td valign="top" width="34%"><em><strong><u>MHRIS</u></strong></em>
    			<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/mhris" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?>
				</td>
				
    			<td valign="top" width="34%"><em><strong><u>Economics</u></strong></em>
    			<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/econ" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?>
				</td>
				</tr>

				<tr>
				<td valign="top" width="34%"><em><strong><u>Finance</u></strong></em>
    			<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/fin" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store"]');?></td>
			
   				<td valign="top" width="34%"><em><strong><u>Misc.</u></strong></em>
				<br>
				<?php echo do_shortcode('[fileaway sub="/'.get_field("folder").'/misc" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store"]');?>
				</td>
				</tr>

				</tbody>
				</table>
			</div>
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