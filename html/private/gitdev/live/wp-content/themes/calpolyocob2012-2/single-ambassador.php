<?php get_header(); 
/**
  *  Template Name: Student Ambassador Question Template
  */
?>

<!-- page.php -->
<?php get_sidebar(); ?>

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
	  if($_POST) {
		  $name = $_POST["Name"];
$studentEmail = $_POST["Email"];
$major = $_POST["Major"];
$topic = $_POST["Topic"];
$message = $_POST["Message"];
$ambassador = $_POST["Ambassador"];

$subject = "New Question for Student Ambassador";
$email = get_field("email_form_to");

$headers = 'From: ocob.calpoly@gmail.com' . "\r\n" .
    'Reply-To: ' . $studentEmail . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$ouput = "Question for Student Ambassador\n\n";
$output .= "From: " . $name . "\n";
$output .= "Email: " . $studentEmail . "\n";
$output .= "Topic: " . $topic . "\n";
$output .= "Specific Ambassador: ";
$output .= $ambassador != "" ? $ambassador : "None";
$output .= "\n\n";
$output .= "Message: \n";
$output .= $message;

mail($email, $subject, $output, $headers);
//Show success message below 

echo get_field("success_message");?>
<?php
	  } else {
	  
	  the_content(); 
	  }?>
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
