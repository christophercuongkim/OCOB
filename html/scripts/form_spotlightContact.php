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

//Spotlight Site Contact Form Email
$output = '';
$output .= "<h2>A new Spotlight Awards site request has arrived!</h2><br>";
$output .= "<p><strong>Name:</strong> $name</p>";
$output .= "<p><strong>Address:</strong> $address</p>";
$output .= "<p><strong>City:</strong> $city</p>";
$output .= "<p><strong>State:</strong> $state</p>";
$output .= "<p><strong>ZIP:</strong> $zip</p>";
$output .= "<p><strong>Email:</strong> $email</p>";
$output .= "<p><strong>Graduation Year:</strong> $year";
$output .= "<p><strong>Major:</strong> $major</p>";

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

$subject = "Spotlight Site Request Submission";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "From: ocobweb@calpoly.edu\r\n";

$to = "cobdeansoffice@calpoly.edu";

if(strlen($name) > 0){
	$mail = mail($to, $subject, $output, $headers);
}

// Change this thankyou page when it goes live
if(!$debug && $mail)
	header("location:/spotlight/#thanks");
?>