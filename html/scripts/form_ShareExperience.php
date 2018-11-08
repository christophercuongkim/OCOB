<?php
session_start();

$debug = false;
$confirmEmail = false; 

extract($_POST);
if($debug){
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";

	echo "<br /><br /><br />";
}

$output = '';
$output .= "<h2>A new Share Your Learn by Doing Experience response has arrived!</h2><br>";
$output .= "<p><strong>Name:</strong> $fname $lname</p>";
$output .= "<p><strong>Email:</strong> $email</p>";
$output .= "<p><strong>Major:</strong> $major</p>";
$output .= "<p><strong>Concentration:</strong> $concentration";
$output .= "<p><strong>Graduation Year:</strong> $year</p>";
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

$subject = "Share Your Learn by Doing Experience Response";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "From: ocob-web@calpoly.edu\r\n";

//$to = 'alexander@zumbro.me';
$to = 'rkontra@calpoly.edu';

if(strlen($fname) > 0){
	$mail = mail($to, $subject, $output, $headers);
}

if(!$debug && $mail)
	header("location:/alumni");
?>