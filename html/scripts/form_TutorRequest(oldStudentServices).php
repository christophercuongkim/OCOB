<?php
session_start();

$debug = false;

extract($_POST);
if($debug){
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";

	echo "<br /><br /><br />";
}

$output = '';
$output .= "<h2>A new tutoring request form response has arrived!</h2><br>";
$output .= "<p><strong>Name:</strong> $name</p>";
$output .= "<p><strong>Mobile Phone Number:</strong> $phone</p>";
$output .= "<p><strong>Cal Poly Email:</strong> $email</p>";
$output .= "<p><strong>Type of Appointment:</strong> $apptType</p>";
if($apptType == "Group"){
	$output .= "<p><strong>Group Members:</strong> $mem1 $mem2 $mem3 $mem4</p>";
}
$output .= "<p><strong>Subject:</strong> $subject</p>";
$output .= "<p><strong>Message:</strong> $message</p>";

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

$subject = "Tutoring Request Form Submission For $subject";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "From: ocob-web@calpoly.edu\r\n";

//$to = 'alexander@zumbro.me';
$to = 'ocobtutoring@calpoly.edu';

if(strlen($name) > 0){
	$mail = mail($to, $subject, $output, $headers);
}

if(!$debug && $mail)
	header("location: http://www.cob.calpoly.edu/studentservices/tutor-request-form/#thanks");
?>