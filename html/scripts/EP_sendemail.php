<?php
$type = $_POST["type"];

if($type == "mentorRequest") {

	$email = "ocob-epp@calpoly.edu";//$post["email"];
	$name = $_POST["Name"];
	$subject = "[Mentor Request - EPP] ".$name.", ".$_POST["Email"];
	$message = "\nNew mentor request from ".$name."!\n\n";
	foreach($_POST as $key => $value)
	{
		if($key == "type") {
			continue;
		}
		if($value == "")
			$value = "no response";
			
		$message .= "\n".$key." - ";
		if(is_array($value) && (count($value) > 1))
		{
			foreach($value as $mulval)
				$message .= $mulval.", ";
			$message .= "\n";
		}
		elseif(is_array($value) && (count($value) == 1))
		{
			$message .= $value[0]."\n";
		}
		else
		{	
			$message .= $value."\n";
		}
	}
	$message .= "\n\n";
	$message .= "Sent automatically from Executive Partners web form \n\n";
	
	mail($email, $subject, $message, "From: ocob-epp@calpoly.edu");
	header("Location: /executive-partners/form-submitted/");

} else {
	
 $from = strip_tags($_POST["email"]) ;
  $name = strip_tags($_POST["name"]) ;
  $phone = strip_tags($_POST["phone"]) ;
  $time = strip_tags($_POST["time"]) ;
  $comments = strip_tags($_POST["comments"]) ;
  
  
  $to = "ocob-epp@calpoly.edu";
  $subject = "Attention: Incoming Contact Us";
  $message = "\n\r name: ". $name."\n\r email: ".$from."\n\r phone: ".$phone." \n\r best time to contact:".$time." \n\r comments:".$comments;
 
//echo $to;
//echo $subject;
//echo $message;

//mail( $to, $subject, $message, "From: contactus-ocob-online@calpoly.edu" );


header( "Location: /executive-partners/thank-you/" );
}
?>

