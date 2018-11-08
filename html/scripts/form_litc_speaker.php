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
//	On Successful submission, send text to LITC center
$output = '';
$output .= "<h2>A new Speaker Request Form has arrived!</h2><br>";
$output .= "<p><strong>Organization Name:</strong> $organizationName</p>";
$output .= "<p><strong>Contact Number:</strong> $contactNumber</p>";
$output .= "<p><strong>Event Name:</strong> $eventName";
$output .= "<p><strong>Event Date:</strong> $eventDate</p>";
$output .= "<p><strong>Event Time/Duration:</strong> ";
$output .= ($eventTime != '')? $eventTime.'</p>' : '<i> Not listed</i></p>';
$output .= "<p><strong>Address:</strong> $address</p>";
$output .= "<p><strong>City:</strong> $city</p>";
$output .= "<p><strong>State:</strong> $state</p>";
$output .= "<p><strong>Zip:</strong> $zip</p>"; 
$output .= "<p><strong>Phone:</strong> $phone</p>";
$output .= "<p><strong>Fax:</strong> $fax</p>";
$output .= "<p><strong>Email:</strong> $email</p>";
$output .= "<p><strong>Requested Topic:</strong> ";
$output .= ($topic != '')? $topic.'</p>' : '<i> Not listed</i></p>';


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

$subject = "Client Intake Application";
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers  .= "From: cobadvis@calpoly.edu\r\n"; 
$to = 'litc@calpoly.edu';

if(strlen($eventName) > 0 && strlen($email) > 0){
$mail = mail($to, $subject, $output, $headers);
}

// RESPONSE EMAIL - enable at top of form
// On Successful submission, send confirmation to applicant
// Change $conf_out to what you would like to sent in the confirmation email
$conf_out .= "";

$subject = "Speaker Request Form Received";
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers  .= "From: cobadvis@calpoly.edu\r\n"; 

$to = $email;
if($confirmEmail) {
mail($to, $subject, $conf_out, $headers);
}

// Change this thank you page when it goes live
if(!$debug && $mail)
	header("location:/litc/thank-you");
?>