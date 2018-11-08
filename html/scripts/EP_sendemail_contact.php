<?php
 $from = strip_tags($_POST['email']) ;
  $name = strip_tags($_POST['name']) ;
  $phone = strip_tags($_POST['phone']) ;
  $time = strip_tags($_POST['time']) ;
  $comments = strip_tags($_POST['comments']) ;
  
  
  $to = "ocob-epp@calpoly.edu";
  $subject = "Attention: Incoming Contact Us";
  $message = "\n\r name: ". $name."\n\r email: ".$from."\n\r phone: ".$phone." \n\r best time to contact:".$time." \n\r comments:".$comments;
 
//echo $to;
//echo $subject;
//echo $message;

mail( $to, $subject, $message, "From: contactus-ocob-online@calpoly.edu" );


header( "Location: /executive-partners/thank-you/" );
?>

