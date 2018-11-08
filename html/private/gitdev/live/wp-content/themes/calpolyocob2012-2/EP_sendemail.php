<?php get_header(); ?>
<!-- page.php -->
<?php
/**
  *  Template Name: EP Template Form Sent
  *  Notes: Currently the site will populate all the post (Mentors) names, but the formatting is not right
*/
 get_sidebar(); ?>

<div id="content">
  <div id="contentLine"></div>
  <?php if(have_posts()) : ?>
  <?php while(have_posts()) : the_post(); 
      
    echo get_the_post_thumbnail();
    echo inner_doc_nav(get_the_content(), get_post_custom());
    ?>
  <div class="post"> <a name="topH1"></a>
    <h1><a href="<?php the_permalink(); ?>">
      <?php the_title(); ?>
      </a></h1>
    <div class="entry">
      <?php 
	  the_content(); 
	  /* $from = strip_tags($_POST['email']) ;
	  $name = strip_tags($_POST['name']) ;
	  $phone = strip_tags($_POST['phone']) ;
	  $mentor = strip_tags($_POST['mentor']) ;
	  $year = strip_tags($_POST['year']) ;
	  $concentration = strip_tags($_POST['concentration']) ;
	  $time = strip_tags($_POST['time']) ;
		 
		$regex = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@]calpoly[.]edu$/"; // Regular expression to ONLY allow *@calpoly.edu addresses
		
		if(!preg_match($regex, $from, $matches))
		{
			echo $from.' is NOT a valid calpoly email address. A vailid @calpoly.edu email address is required for this service.<br />';
			echo 'Please go back and enter a valid *@calpoly.edu email address';
			exit;
		}
	// Email Recipients.
	
	//Changed from Sasha Palazzo to ocob-epp 11/08/2011
	//$to = "sapalazz@calpoly.edu";
	//$to = "ocob-epp@calpoly.edu";
	$to = "matt.austin94@gmail.com";
	$subject = "Attention: Incoming Mentor Contact";
	$message = "For Mentor: ".$mentor."\n\r name: ". $name."\n\r year: ". $year."\n\r concentration: ".$concentration."\n\r email: ".$from."\n\r phone: ".$phone." \n\r best time to contact:".$time;
	 
	
	if(mail( $to, $subject, $message, "From: contactmentor-ocob-online@calpoly.edu" )) {
		echo "Message sent";
	} */
	  ?>
      <?php $custom_fields = get_post_custom(); ?>
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
