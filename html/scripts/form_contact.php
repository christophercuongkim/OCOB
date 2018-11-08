<?php
session_start();

// CHANGE THIS IF YOU WANT IT TO PRINT OUT DEBUGGING INFORMATION ND EMAIL BO
$debug = false;
if($debug){
	var_dump($_POST);
	echo "<br/>";
}
extract($_POST);

//	ADVISING EMAIL
//		On Successful submission, send text to advising center

$type = ucfirst($type);

$output = '';
$output .= "<p><strong>Name:</strong> $name</p>";
$output .= "<p><strong>Email:</strong> $email</p>";

$programOfInterest = str_replace("_", " ", $programOfInterest);
$output .= "<p><strong>Program Of Interest:</strong> $programOfInterest</p>";

$output .= "<p><strong>Questions & Inqueries:</strong> $questions</p>";

$output = stripslashes($output);

$subject = "Someone is Contacting Graduate Business";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "From: mba@calpoly.edu\r\n";

if($debug){
	echo $to . "<br/>";
	$to = 'boelkers@calpoly.edu';
	echo($to . "<br/>");
}
else
{
	if(strlen($name) > 0){
	mail($to, $subject, $output, $headers);
	}
}

if(true)
{
	header("Location:$forward");
}

?>
