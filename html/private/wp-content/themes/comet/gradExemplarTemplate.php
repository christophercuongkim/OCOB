<?php
/*
Template Name: Grad Exemplar Display
*/
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

	<!-- post -->
	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
		<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="post-text">
		<?php
/*
		the_content(__('Read the full post','comet').' &raquo;');
		wp_link_pages('before=<div class="post-pages">'.__('Pages','comet').':&after=</div>&next_or_number=number&pagelink=<span>%</span>');
*/
		?>
		</div>
		<div class="post-meta">
			<div class="row">
				
				<table style="height: 651px; width: 100%;" border="0">
				<tbody>
				<tr>
				<td valign="top" width="34%"><em><strong><u>1.1 – Demonstrate competency in tax research and identify potential solutions to tax issues.</u></strong></em>
				<br>
				<?php echo do_shortcode('[fileaway base="4" sub="/'.get_field("folder").'/1.1" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?></td>
				
    <td valign="top" width="34%"><em><strong><u>1.2 – Analyze and solve tax compliance issues through the application of analytic/critical thinking skills.</u></strong></em>
    <br>
				<?php echo do_shortcode('[fileaway base="4" sub="/'.get_field("folder").'/1.2" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?></td>
				
    <td valign="top" width="34%"><em><strong><u>1.3 – Apply substantive knowledge in a variety of experiential tax projects.</u></strong></em>
    <br>
				<?php echo do_shortcode('[fileaway base="4" sub="/'.get_field("folder").'/1.3" size="no" hcolor="black" color="green" icons="none" corners="sharp" exclude=".DS_Store, ._.DS_Store"]');?></td>
				</tr>

				<tr>
				<td valign="top" width="34%"><em><strong><u>2.1 – Recognize and apply ethical and professional responsibility requirements to tax practice.</u></strong></em>
	   <br>
				<?php echo do_shortcode('[fileaway base="4" sub="/'.get_field("folder").'/2.1" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?></td>
				
    <td valign="top" width="34%"><em><strong><u>3.1 – Professionally communicate in writing.</u></strong></em>
    <br>
				<?php echo do_shortcode('[fileaway base="4" sub="/'.get_field("folder").'/3.1" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?></td>
				
    <td valign="top" width="34%"><em><strong><u>3.2 – Professionally communicate information through oral presentations.</u></strong></em>
    <br>
				<?php echo do_shortcode('[fileaway base="4" sub="/'.get_field("folder").'/3.2" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?></td>
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