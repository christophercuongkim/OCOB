<?php //get_header();
include("header.php"); ?>  
<!-- single-directory.php -->
<?php 
switch_to_blog($cpto->root_blog_id);
 get_sidebar(); 
 restore_current_blog();
?>
      <div id="content">  
      <div id="contentLine"></div>
    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); 
    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), generateFacultySide($post->ID), true);
    ?>
    
    <div class="post">
    <?php 
	if(get_field('swap_names')) {
		$fullName = explode(", ", get_the_title($post->ID));
		$profName = $fullName[1] . " " . $fullName[0];
	} else {
		$profName = get_the_title($post->ID);
	}
	?>
    <a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php echo $profName; ?></a></h1>
       <?php
		$meta_date = get_post_meta($post->ID, 'event_date', true);
		$event_date = NULL;
       	if($meta_date){
	   		$event_date = date("F j, Y",strtotime($meta_date));
			if($meta_date != "false") { // For the events that do not have a date, meta_date == false, Event Date will not show
				echo '<h4>Event Date - '.$event_date.'</h4>';
			}
		}
		?>
      <div class="entry">
      <?php the_content(); ?>
      </div><!-- entry -->
      </div> <!-- post -->

    
    </div><!--main????Full-->
<?php endwhile; ?>

<?php else: 
include('404.php')
?>

<?php endif; ?>

    </div> <!-- content -->
        
        <div class="clear"></div>

<?php get_footer(); ?>

<?php

function generateFacultySide($id){
	if(get_field('swap_names')) {
		$fullName = explode(", ", get_the_title($id));
		$profName = $fullName[1] . " " . $fullName[0];
	} else {
		$profName = get_the_title($id);
	}
	$title = get_field('title') ? get_field('title') . " " : "";
	$str = '';
	if(get_field('picture', $id)) {
		$str .= '<img src="'.get_field('picture', $id).'" alt="'.get_the_title($id).'">';
	}
	$str .= '<h2>'.$title.$profName.'</h2>';
	
	$str .= '<p>'.get_field('position', $id).'</p>';
	$str .= '<p>';
	if(get_field('office')) {
		$str .= '<span class="grey">Office</span> '.get_field('office', $id).'<br>';
	}
	if(get_field('phone')) {
		$str .= '<span class="grey">Phone</span> '.get_field('phone', $id).'<br>';
	}
	if(get_field('fax')) {
		$str .= '<span class="grey">Fax</span> '.get_field('fax').'<br>';
	}
	if(get_field('email')) {
		$str .= '<a href="mailto:'.get_field('email', $id).'">'.get_field('email', $id).'</a>';
	}
	$str .= '</p>';
	if(get_field('office_hours')) {
		$str .= '<p><span class="grey">Office Hours</span><br />';
		$str .= get_field('office_hours');
		$str .= '</p>';
	}
	if(get_field('staff_profile_pdf', $id)) {
		$str .= '<p><span class="grey">Staff Profile </span><a href="'.get_field('staff_profile_pdf', $id).'">PDF</a></p>';
	}
	if(get_field('cv_pdf', $id)) {
		$str .= '<p><span class="grey">CV </span><a href="'.get_field('cv_pdf', $id).'">PDF</a></p>';
	}
	if(get_field("other_positions")) {
		$str .= "<p>".get_field("other_positions")."</p>";
	}
	if(get_field("raw_html")) {
		$str .= "<p>".get_field("raw_html")."</p>";
	}
	return $str;
}

?>
