<?php
/*
Template Name: Undergrad Exemplar Display
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
				<td valign="top" width="34%"><em><strong><u>LO1.1 - Specific Concentrations</u></strong></em>
				<br>
				<?php echo do_shortcode('[fileaway base="3" sub="/'.get_field("folder").'/LO1.1SpecificConcentrations" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?></td>
				
    <td valign="top" width="34%"><em><strong><u>LO2.1 – Ethics</u></strong></em>
    <br>
				<?php echo do_shortcode('[fileaway base="3" sub="/'.get_field("folder").'/LO2.1Ethics" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?></td>
				
    <td valign="top" width="34%"><em><strong><u>LO3.1 – Diversity</u></strong></em>
    <br>
				<?php echo do_shortcode('[fileaway base="3" sub="/'.get_field("folder").'/LO3.1Diversity" size="no" hcolor="black" color="green" icons="none" corners="sharp" exclude=".DS_Store, ._.DS_Store"]');?></td>
				</tr>

				<tr>
				<td valign="top" width="34%"><em><strong><u>LO3.2 – Global Environment</u></strong></em>
	   <br>
				<?php echo do_shortcode('[fileaway base="3" sub="/'.get_field("folder").'/LO3.2GlobalEnvironment" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?></td>
				
    <td valign="top" width="34%"><em><strong><u>LO4.1 – Written Communication</u></strong></em>
    <br>
				<?php echo do_shortcode('[fileaway base="3" sub="/'.get_field("folder").'/LO4.1WrittenCommunication" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?></td>
				
    <td valign="top" width="34%"><em><strong><u>LO4.2 – Oral Communication</u></strong></em>
    <br>
				<?php echo do_shortcode('[fileaway base="3" sub="/'.get_field("folder").'/LO4.2OralCommunication" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store, ._.DS_Store"]');?></td>
				</tr>

				<tr>
				<td valign="top" width="34%"><em><strong><u>LO4.3 – Teamwork</u></strong></em>
    <br>
				<?php echo do_shortcode('[fileaway base="3" sub="/'.get_field("folder").'/LO4.3Teamwork" size="no" hcolor="black" icons="none" color="green" exclude=".DS_Store"]');?></td> 	
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