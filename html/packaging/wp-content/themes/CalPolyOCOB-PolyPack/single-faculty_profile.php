<?php// File: single-faculty_profile.php ?>
<?php //get_header();
include("header.php"); ?> 
<style>
.faculty-pic{
	width: 150px;
}
</style> 
<!-- single-facult_profile.php -->
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
      <!-- checks if the content is empty, prints default message if so. Otherwise, prints the content (NEED TO FIX) -->
      <?php if($post->post_content == "")
      {
	      echo "<h3>Bio Coming Soon</h3>";
      }
      else
      {
	      the_content();
	  }?>
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
	
function getOfficeHours($id, $givenCatID, $printedCats = array()){
	$str = "";
	$realCats = array();
	$parentCats = array();
		
	if ($givenCatID == TRUE) {
		$cats = get_category($id);
		//var_dump($cats);
		array_push($realCats, $cats->slug);
		array_push($parentCats, $cats->category_parent);
	} else {
		$cats = get_the_category($id);
		foreach ($cats as $cat) {
			array_push($realCats, $cat->slug);
			array_push($parentCats, $cat->category_parent);
		}
		//var_dump($parentCats);
	}
	$options = get_option("office_hour_settings_options");
	foreach ($realCats as $cat) {
		//var_dump($cat);
		//$str.=$options[$cat] . 'ab';
		//var_dump($options[$cat]);
		//echo get_category_parents($cat);
		if (strlen($options[$cat]) > 0) {
			if (strstr(implode($printedCats), $cat) == FALSE) {
				$str .= '<a href=' . $options[$cat] . '>' . get_category_by_slug($cat)->name . '</a><br /><br />';
				array_push($printedCats , $cat);
			}

			//var_dump($printedCats);
		}else {
			//check parent cat
			//var_dump($parentCats);
			foreach ($parentCats as $pCat) {
				if ($pCat > 0){
					//echo $pCat . " ";
					list($new, $printedCats) = getOfficeHours($pCat, TRUE, $printedCats);
					$str .= $new;
					//var_dump($printedCats);
				}
			}
		}
	}	
	
	return array ($str, $printedCats);
	
	
}


function generateFacultySide($id){
	if(get_field('swap_names')) {
		$fullName = explode(", ", get_the_title($id));
		$profName = $fullName[1] . " " . $fullName[0];
	} else {
		$profName = get_the_title($id);
	}
	$title = get_field('title') ? get_field('title') . " " : "";
	$str = '';
	if(get_field('picture_upload', $id))
	{
		$str .= '<img class="faculty-pic" src="'.get_field('picture_upload', $id).'" alt="'.get_the_title($id).'">';
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
	/*if(get_field('office_hours')) {
		$str .= '<p><span class="grey">Office Hours</span><br />';
		$str .= get_field('office_hours');
		$str .= '</p>';
	}*/
	$str .= '<p><span class="grey">Office Hours</span><br /><u>';
	list($new, $printedCats) = getOfficeHours($id, FALSE);
	$str .= $new;
	$str .= '</u></p>';
	
	//Depreciated - Field For Staff Profile PDFs
	/*if(get_field('staff_profile_pdf', $id)) {
		$str .= '<p><span class="grey">Staff Profile </span><a href="'.get_field('staff_profile_pdf', $id).'">PDF</a></p>';
	}*/
	if(get_field('cv', $id)) {
		$str .= '<p><span class="grey">CV </span><a href="'.get_field('cv', $id).'">PDF</a></p>';
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
