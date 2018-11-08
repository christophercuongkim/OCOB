<?php 
session_start();

// CHANGE THIS IF YOU DON'T WANT IT TO PRINT OUT DEBUGGING INFORMATION
$debug = false;

extract($_POST);
if($debug){
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";
	
	echo "<br /><br /><br />";
}

//	ADVISING EMAIL
//		On Successful submission, send text to advising center

$output = '';
$output .= "<h2>A new Mentor Connection Application has arrived!</h2><br>";
$output .= "<p><strong>Name:</strong> $name</p>";
$output .= "<p><strong>Major:</strong> $major</p>";
$output .= "<p><strong>Concentration:</strong>"; // Optional
$output .= ($concentration != '')? $concentration.'</p>' : '<i> Not listed</i></p>';
$output .= "<p><strong>Year in School:</strong> $year</p>";
$output .= "<p><strong>Mentor Gender Preference:</strong> $mentor_gender</p>";
$output .= "<p><strong>Activities Outside School:</strong> $activities</p>";

$output .= "<p><strong>Campus Activities:</strong> $campus_activities</p>";
$output .= "<p><strong>How mentor would benefit them:</strong> $mentor_benefit</p>";
$output .= "<p><strong>Topics to discuss:</strong> $topics</p>";

$output .= "<p><strong>Free Time Preference:</strong>"; // Optional
$output .= ($ap_scale != 'na')? $ap_scale.'</p>' : '<i> Not Applicable</i></p>';
$output .= "<p><strong>Email:</strong> $email</p>";
$output .= "<p><strong>Cell Phone:</strong> $cphone</p>";

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

$subject = "[Mentor Connection App v1.0] - $name, $email";
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers  .= "From: cobadvis@calpoly.edu\r\n"; 
$to = 'fgonza02@calpoly.edu';
if(strlen($name) > 0 && strlen($email) > 0){
mail($to, $subject, $output, $headers);
}

$to = 'kbrusch@calpoly.edu';
if(strlen($name) > 0 && strlen($email) > 0){
mail($to, $subject, $output, $headers);
}
//	RESPONSE EMAIL
//		On Successful submission, send confirmation to applicant

$conf_out .= "<p>Dear ".$name.",</p>";

$conf_out .= "<p>Thank you for your interest in the Mentor Connection Program, we have received your request to get connected to a Peer Mentor and are working to match you with the right person. You will receive an email just before Fall Quarter begins with more details about who your Peer Mentor is and next steps for getting involved.</p>

<p>If you have any immediate questions or want additional information about the program please contact the program coordinator, Kelly Brusch at kbrusch@calpoly.edu. Congratulations on taking a proactive step towards improving your academics!
<br><br>
Thank you,
</p>
<br>
<br>
Kelly Brusch<br>
Academic Advisor<br>
Orfalea College of Business</p>";
$subject = "Mentor Connection Application Received";
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers  .= "From: cobadvis@calpoly.edu\r\n"; 

$to = $email;
mail($to, $subject, $conf_out, $headers);

// Change this thankyou page when it goes live
if(!$debug)
	header("location:http://www.cob.calpoly.edu/studentservices/policies-forms/travel-grant-thank-you/");
?>