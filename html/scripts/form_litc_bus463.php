<?php
session_start();

// CHANGE THIS IF YOU DON'T WANT IT TO PRINT OUT DEBUGGING INFORMATION
$debug = false;
$confirmEmail = false; //Change if you want to send a confirmation email to whoever is filling the form out, must change information below

extract($_POST);
if($debug){
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";

	echo "<br /><br /><br />";
}

//	ADVISING EMAIL
//		On Successful submission, send text to LITC center

$output = '';
$output .= "<h2>A new BUS 463 Application has arrived!</h2><br>";
$output .= "<p><strong>Name:</strong> $fname $lname</p>";
$output .= "<p><strong>Grade Level:</strong> $grade</p>";
$output .= "<p><strong>Major:</strong> $major";

$output .= "<p><strong>Question 1 Response:</strong> $q1</p>";
$output .= "<p><strong>Question 2 Response:</strong> $q2</p>";
$output .= "<p><strong>Question 3 Response:</strong> $q3</p>";
$output .= "<p><strong>Question 4 Response:</strong> $q4</p>";
$output .= "<p><strong>Question 5 Response:</strong> $q5</p>";
$output .= "<p><strong>Question 6 Response:</strong> $q6</p>";
$output .= "<p><strong>Question 7 Response:</strong> $q7</p>";
$output .= "<p><strong>Question 8 Response:</strong> $q8</p>";
$output .= "<p><strong>Question 9 Response:</strong> $q9</p>";

$output .= "<p><strong>First Preference for LITC:</strong> $first</p>";
$output .= "<p><strong>Second Preference for LITC:</strong> $second</p>";
$output .= "<p><strong>Third Preference for LITC:</strong> $third</p>";

$output = stripslashes($output);

if($debug){
	echo "<br /><br /><br />";
	echo $output;
	echo "<br /><br /><br />";
	echo "<pre>";
	var_dump($output);
	echo "</pre>";
	echo "<br /><br /><br />";
}

$subject = "BUS 463 Application Submission";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "From: cobadvis@calpoly.edu\r\n";
$to = 'esperow@calpoly.edu ';

if(strlen($fname) > 0){
	$mail = mail($to, $subject, $output, $headers);
}

//	RESPONSE EMAIL
//		On Successful submission, send confirmation to applicant

//Change $conf_out to what you would like to sent in the confirmation email
/*$conf_out .= "";

$subject = "BUS 463 Application Submitted";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "From: litc@calpoly.edu\r\n";

$to = $email;
if($confirmEmail) {
mail($to, $subject, $conf_out, $headers);
}*/

// Change this thankyou page when it goes live
if(!$debug && $mail)
	header("location:/litc/thank-you");
?>
