<style>
/* Mentor styles, temporarily here for testing. Should go into main CSS */
.mentor_name{
	cursor:pointer;	
}
.mentor_profile{
	display:none;
	/*border:1px solid black;*/
	padding:10px;	
}
.mn_selected{
	font-size:15px;
	color:green;
	text-decoration:underline;
	font-weight:bold;	
}
.mentorAvail, .viewProfile{
	cursor: pointer;
	-webkit-box-shadow: 0 1px 0 rgba(0,0,0,.05);
	box-shadow: 0 1px 0 rgba(0,0,0,.05);
	background-color: #53a93f;
	border: 1px solid #53a93f;
	color: #fff;
	text-shadow: none;
	padding: 8px 15px;
	margin-left:auto;
	margin-right:auto;
	margin-bottom:5px;
}
.mentorAvail:hover, .viewProfile:hover {
	border-color: #4c8534;
	color: #fff;
}
.mentorAvail:active, .viewProfile:active {
	background-color: #4c8534;
}

.mentorFull{
	cursor: pointer;
	-webkit-box-shadow: 0 1px 0 rgba(0,0,0,.05);
	box-shadow: 0 1px 0 rgba(0,0,0,.05);
	background-color: #E60000;
	border: 1px solid #E60000;
	color: #fff;
	text-shadow: none;
	padding: 8px 15px;
	margin-left:auto;
	margin-right:auto;
}
.mentorFull:hover {
	border-color: #4c8534;
	color: #fff;
}
.mentorFull:active {
	background-color: #E60000;
}
</style>


<?php get_header(); ?>
<!-- page.php -->
<script type="text/javascript">
jQuery( document ).ready(function() {
	//jQuery('.mentor_profile').hide();
	jQuery('.mentor_name').click(function(){
		showMentor(jQuery(this).attr('id'));
	});
	
	function showMentor(id){
		jQuery('.mentor_name').each(function(){ jQuery(this).removeClass('mn_selected');});
		jQuery('#'+id).addClass('mn_selected');
		
	jQuery('.mentor_profile').hide();
		jQuery('#'+id+'p').show();				
	}
});
</script>
<?php
/**
  *  Template Name: EP Template
  *  Notes: Currently the site will populate all the post (Mentors) names, but the formatting is not right
*/

 get_sidebar(); ?>

<div id="content">
  <div id="contentLine"></div>
  <?php if(have_posts()) : ?>
  <?php while(have_posts()) : the_post(); 
      
    echo get_the_post_thumbnail();
	echo "<h1>".get_the_title()."</h1>";
    echo inner_doc_nav(get_the_content(), get_post_custom());
    ?>
  <div class="post"> 
    <div class="entry">
      <?php the_content(); ?>
      <?php $custom_fields =  get_post_custom(); ?>
      <div id="mentors">
      
<?php
$args = array('posts_per_page' => -1);
$mentors = get_posts($args);
$mentorsArr = array();
$numPerCol = 14;
foreach ( $mentors as $mentor ) {  // The list of all Mentors below
array_push($mentorsArr, $mentor->post_title);
} 
wp_reset_postdata();
function lastNameSort($a, $b) {
    $aLast = end(explode(' ', $a));
    $bLast = end(explode(' ', $b));

    return strcasecmp($aLast, $bLast);
}
usort($mentorsArr, 'lastNameSort');
$numMentors = count($mentorsArr);

$numPerCol = round($numMentors / 3);
if($numPerCol < 10) { // Have one list if there isn't enough data
	$numPerCol = 10;
}


function getProfile($mentorName) {
	$post = get_page_by_title( $mentorName, "OBJECT", "post" );
	$id = $post->ID;
	$categories = get_the_category( $id ); //for the new icons
	$mentorAvailable = get_post_custom_values("mentor_available", $id);
	$mentorAvailable = $mentorAvailable[0];
	echo '<div class="mentor_profile" id="m' . $id . 'p"><a href="'.get_permalink($id).'"><center>
		';
	$imageURL = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' );
	if($imageURL) {
	  echo "<img src='$imageURL[0]' style='width:110px; height:110px; padding-top:0px;' />";
	} else {
		echo "<img src='http://www.cob.calpoly.edu/executive-partners/files/2013/10/no_image.gif' style='width:110px; height:110px' />";
	}
	echo "<div style='height:155px;overflow:hidden;'>";
	echo '<h2 style="margin:0px; margin-bottom:5px;">' . $mentorName . '</h2>';
	echo "</a>";
	$excerpt = get_post_custom_values("excerpt", $id);
	foreach($categories as $category) {
		$chars = array("/", " ", "&");
		$theCategory = $category->cat_name;	
		$photoName = $theCategory;
		$photoName = str_replace("amp;", "", $photoName);
		$photoName = str_replace($chars, "_", $photoName);
		if($photoName != "Media___Communications")
		echo "<img src='http://www.cob.calpoly.edu/wp-content/uploads/EPIcons/".$photoName.".png' title='$theCategory' height='25px' width='25px'/> ";
	}
	echo "<p style='margin-top:0px;'>".$excerpt[0]."</p></div>";
	echo "<a class='button' href='".get_permalink($id)."'><button class='viewProfile' id='viewProfile'>View Profile</button></a>";
	if($mentorAvailable == "false") {
		$buttonText = (get_option("EP_mentorNotAvailable") != "") ? get_option("EP_mentorNotAvailable") : "Not Available";
		echo "<button class='mentorFull' id='addMentor'>".$buttonText."</button>";
	} else {
		$buttonText = (get_option("EP_addMentorButton") != "") ? get_option("EP_addMentorButton") : "Add Mentor";
		echo '<form action="mentor-request-form/" method="post">';
		echo '<input type="hidden" id="mentor" name="mentor" value="'.$mentorName.'" size="20" />';
	  	echo "<button class='mentorAvail' id='addMentor'>".$buttonText."</button>";
		echo "</form>";
	}
	echo "</center>";
	echo "</div>";
}
?>
<h2 style="font-size:16px;">Find a Mentor</h2>
 <div style="float:left;width:25%;line-height:150%;display:block;">
  <?php
  $num = 0;
  $numMentor = 0;
  while($num < $numPerCol && $numMentor <= $numMentors) {
	  $post = get_page_by_title( $mentorsArr[$numMentor], "OBJECT", "post" );
	  $id = $post->ID;
	  echo "<a class='mentor_name' id='m".$id."'>".$mentorsArr[$numMentor] . "</a><br />";
	  $num++;;
	  $numMentor++;
  }
  ?>
  </div>
  <div style="float:left;width:25%;line-height:150%;display:block;">
  <?php 
  $num = 0;
  while($num < $numPerCol && $numMentor <= $numMentors) {
	  $post = get_page_by_title( $mentorsArr[$numMentor], "OBJECT", "post" );
	  $id = $post->ID;
	  echo "<a class='mentor_name' id='m".$id."'>".$mentorsArr[$numMentor]. "</a><br />";
	  $num++;;
	  $numMentor++;
  }
  ?>
  </div>
  <div style="float:left;width:25%;line-height:150%;display:block;">
   <?php
   $num = 0;
   while($num < $numPerCol && $numMentor <= $numMentors) {
	  $post = get_page_by_title( $mentorsArr[$numMentor], "OBJECT", "post" );
	  $id = $post->ID;
	  echo "<a class='mentor_name' id='m".$id."'>".$mentorsArr[$numMentor] . "</a><br />";
	  $num++;;
	  $numMentor++;
  }
   ?>
   </div>
   <div class='profile_div' style="float:right;width:25%;display:block;">
   <div class="mentor_profile" style="display:block;">
   <center>
   <h2>Select a mentor to the left to see more information.</h2>
   <a href="guide/" style="text-decoration: none;
font-style: italic;
color: #6a6a6a;
font-family: "Times New Roman", Times, serif;
font-size: 16px;
}">More info...</a>
   </center>
   </div>
<?php 
foreach($mentorsArr as $mentor) {
	getProfile($mentor);
}
?>
<!--<h1 class="mentor_profile" id="m0p">Mentor 1</h1>
<h1 class="mentor_profile" id="m1p">Mentor 2</h1>
<h1 class="mentor_profile" id="m2p">Mentor 3</h1>
<h1 class="mentor_profile" id="m3p">Mentor 4</h1>
<h1 class="mentor_profile" id="m4p">Mentor 5</h1>-->
   </div>
  </div>
    </div>
  </div>
  <?php endwhile; ?>
  <?php else: 
    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), get_post_custom());
  ?>
  
  <div class="post"> <a name="topH1"></a>
    <h1>404 Error - Page Not Found</h1>
    <div class="entry">
      <p>Sorry, the page you were looking for was not found.</p>
    </div>
  </div>
  <?php endif; ?>
</div>
<!--main????Full-->

</div>
<!-- content -->

<div class="clear"></div>
<?php get_footer(); ?>
