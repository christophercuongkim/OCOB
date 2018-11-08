<?php// File: EEP_Bios.php ?>
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
  *  Template Name: EEP Bios
  *  Notes: Currently the site will populate all the post (Mentors) names, but the formatting is not right
*/

 get_sidebar('eepNew'); ?>

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
$args = array('posts_per_page' => -1,
				'post_type' => 'mentor_profile');
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

$numPerCol = ceil($numMentors / 4);
if($numPerCol < 6) { // Have one list if there isn't enough data
	$numPerCol = 6;
}


function getProfile($mentorName) {
	$post = get_page_by_title( $mentorName, "OBJECT", "mentor_profile" );
	$id = $post->ID;
	$categories = get_the_category( $id ); //for the new icons
	$mentorAvailable = get_post_custom_values("mentor_available", $id);
	$mentorAvailable = $mentorAvailable[0];
	$content = $post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content); ?>

	<div class="mentor_profile" id="m<?php echo($id);?>p">
	
	<div style="clear: both;display: block">
		<br />
		<a href="<?php echo(get_permalink($id));?>"><h1><?php echo(get_the_title($id)); ?></h1></a>
		<br />
		<div>
	 <?php 
	  if( true ) { //strlen(get_the_post_thumbnail ($id, 'thumbnail') ) > 0) { ?>
      <div id="photo" style="float:left; display:inline; margin:0px 10px 0px 0px;">
      <center>
      <?php echo get_the_post_thumbnail($id, 'thumbnail'); 
	  //echo "<br />";
	  ?> <br />
      <?php 
	  ?>
	  <?php if($mentorAvailable == "false") { 
	  $buttonText = (get_option("EP_mentorNotAvailable") != "") ? get_option("EP_mentorNotAvailable") : "Not Available";
	  ?>
      <button class="mentorFull" id='mentorFull'><?php echo $buttonText; ?></button>
	  <?php } else { 
	  $buttonText = (get_option("EP_addMentorButton") != "") ? get_option("EP_addMentorButton") : "Add Mentor";
	  ?>
      
<form action="http://goo.gl/forms/NGA3qklE3n" target="_blank" method="GET">
	<button class='mentorAvail' id='addMentor'>Request Mentor</button>
    </form>      
<?php } ?>
      </center>
      </div>
      <?php } ?>
      <?php echo ($content);
	  echo "<br />";
	  echo "<center>";
	  foreach($categories as $category) {
		$chars = array("/", " ", "&");
		$theCategory = $category->cat_name;	
		$photoName = $theCategory;
		$photoName = str_replace("&", "", $photoName);
		$photoName = str_replace(" amp;", "", $photoName);
		$photoName = str_replace($chars, "_", $photoName);
		$catURL = get_category_link( get_cat_ID( $theCategory ));
		echo "<a href='".$catURL."' ><img style='margin-right:20px' src='http://www.cob.calpoly.edu/wp-content/uploads/EPIcons/".$photoName."Text.png' title='$theCategory' /></a>";
	}
	echo "</center>";
	?>
      <?php if(strlen(get_the_post_thumbnail ($id, 'thumbnail') ) == 0) { ?>
      <?php if($mentorAvailable == "false") { 
	  $buttonText = (get_option("EP_mentorNotAvailable") != "") ? get_option("EP_mentorNotAvailable") : "Not Available";
	  ?>
      <button class="mentorFull" id='mentorFull'><?php echo $buttonText; ?></button>
	  <?php } else { 
	  $buttonText = (get_option("EP_addMentorButton") != "") ? get_option("EP_addMentorButton") : "Add Mentor";
	  ?>
      <form action="../mentor-request-form/" method="post">
      <input type="hidden" id="mentor" name="mentor" value="<?php the_title(); ?>" size="20" />
      <button class="mentorAvail" id='mentorAvail'><?php echo $buttonText; ?></button>
      </form>
      <?php } ?>
      <?php } 
      echo "</div></div></div>";
}
?>
<h2 style="font-size:16px;">Find a Mentor</h2>
 <div style="float:left;width:25%;line-height:150%;display:block;">
  <?php
  $num = 0;
  $numMentor = 0;
  while($num < $numPerCol && $numMentor <= $numMentors) {
	  $post = get_page_by_title( $mentorsArr[$numMentor], "OBJECT", "mentor_profile" );
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
	  $post = get_page_by_title( $mentorsArr[$numMentor], "OBJECT", "mentor_profile" );
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
	  $post = get_page_by_title( $mentorsArr[$numMentor], "OBJECT", "mentor_profile" );
	  $id = $post->ID;
	  echo "<a class='mentor_name' id='m".$id."'>".$mentorsArr[$numMentor] . "</a><br />";
	  $num++;;
	  $numMentor++;
  }
   ?>
   </div>
   <div style="float: left;width:24%;line-height:150%;display:block;">
   <?php
   $num = 0;
   while($num < $numPerCol && $numMentor <= $numMentors) {
	  $post = get_page_by_title( $mentorsArr[$numMentor], "OBJECT", "mentor_profile" );
	  $id = $post->ID;
	  echo "<a class='mentor_name' id='m".$id."'>".$mentorsArr[$numMentor] . "</a><br />";
	  $num++;;
	  $numMentor++;
  }
   ?>
   </div>
   <div >
   <div class="mentor_profile" style="clear: both;display:block;">
	   <br />
   <center>
   <form action="http://goo.gl/forms/NGA3qklE3n" target="_blank" method="GET">
	<button class='mentorAvail' id='addMentor'>Request Mentor</button>
    </form>

   
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
