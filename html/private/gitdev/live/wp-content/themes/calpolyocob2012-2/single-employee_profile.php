<?php get_header(); ?>  
<!-- single-directory.php -->
<?php get_sidebar(); ?>
      <div id="content">
      <div id="contentLine"></div>
    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); 
    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), generateFacultySide($post->ID), true);
    ?>
    
    <div class="post">
    <a name="topH1"></a><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
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
	$title = get_field('title') ? get_field('title') . " " : "";
	$str = '';
	if(get_field('picture', $id)) {
		$str .= '<img src="'.get_field('picture', $id).'" alt="'.get_the_title($id).'">';
	}
	$str .= '<h2>'.$title.get_the_title($id).'</h2>';
	
	$str .= '<p>'.get_field('position', $id).'</p>';
	$str .= '<p><span class="grey">Office</span> '.get_field('office', $id).'<br>';
	$str .= '<span class="grey">Phone</span> '.get_field('phone', $id).'<br>';
	if(get_field('fax')) {
		$str .= '<span class="grey">Fax</span> '.get_field('fax').'<br>';
	}
	$str .= '<a href="mailto:'.get_field('email', $id).'">'.get_field('email', $id).'</a></p>';
	if(get_field('staff_profile_pdf', $id)) {
		$str .= '<p><span class="grey">Staff Profile </span><a href="'.get_field('staff_profile_pdf', $id).'">PDF</a>';
	}
	if(get_field('cv_pdf', $id)) {
		$str .= '<span class="grey">CV </span><a href="'.get_field('cv_pdf', $id).'">PDF</a></p>';
	}
	if(get_field("other_positions")) {
		$str .= "<p>".get_field("other_positions")."</p>";
	}
	return $str;
}

?>
