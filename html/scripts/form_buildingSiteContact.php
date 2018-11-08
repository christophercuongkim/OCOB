<?php
session_start();


$debug = false;//Change this is you want a debugging message printed
$confirmEmail = false; //Change if you want to send a confirmation email to whoever is filling the form out, must change information below

extract($_POST);

if($debug){
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";

	echo "<br /><br /><br />";
}

//Building Site Contact Form Email
$output = '';
$output .= "<h2>A new building site information request has arrived!</h2><br>";
$output .= "<p><strong>Name:</strong> $name</p>";
$output .= "<p><strong>Email:</strong> $email</p>";
$output .= "<p><strong>Phone Number:</strong> $phone";

$output .= "<p><strong>Cal Poly Alum?</strong> $alumni</p>";
$output .= "<p><strong>Inquiring About:</strong> $moreinfo</p>";
$output .= "<p><strong>Other Questions Or Comments:</strong> $other</p>";

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

$subject = "Building Site Information Request Submission";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "From: ocobweb@calpoly.edu\r\n";

$mail = false;

if(strlen($name) > 0){
	$mail = mail($to, $subject, $output, $headers);
}

// Change this thankyou page when it goes live
if(!$debug && $mail)
	header("location:/building/get-involved/#thanks");
?>