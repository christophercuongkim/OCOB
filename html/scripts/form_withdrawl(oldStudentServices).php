<?php
session_start();

//This is for both course and Term Withdrawl

// CHANGE THIS IF YOU WANT IT TO PRINT OUT DEBUGGING INFORMATION ND EMAIL BO
$debug = false;
if($debug){
	var_dump($_POST);
}
extract($_POST);

//	ADVISING EMAIL
//		On Successful submission, send text to advising center

$type = ucfirst($type);

$output = '';
$output .= "<h2>A new $type Withdrawl has arrived!</h2><br>";
$output .= "<p><strong>Name:</strong> $name</p>";
$output .= "<p><strong>Username:</strong> $username</p>";
$output .= "<p><strong>Major:</strong> $major</p>";

if($type == "Course"){
	$output .= "<p><strong>Courses to Withdraw from</strong>: $courses</p>";
}

$output .= "<p><strong>Reason</strong>: $reasoning</p>";
$output .= "<p><strong>Passing</strong>: $passing</p>";

$output = stripslashes($output);

$subject = "[$type Withdrawl] - $name";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "From: cobadvis@calpoly.edu\r\n";

if($debug){
	$to = 'boelkers@calpoly.edu';
	echo($to);
} else {
	$to = 'acarte13@calpoly.edu, ngomez13@calpoly.edu, kobrie13@calpoly.edu, lclark08@calpoly.edu, ylalexan@calpoly.edu';
}
mail($to, $subject, $output, $headers);

if(!$debug){
	header("Location:http://www.cob.calpoly.edu/studentservices/withdrawl-thank-you/");
}
?>
