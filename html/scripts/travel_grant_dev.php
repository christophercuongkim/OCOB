<?php 
session_start();

foreach($_POST as $key => $val)
{
	$_POST[$key] = htmlspecialchars($val);	
}
extract($_POST);/*
$check_cnt = 0;

$check[] = (preg_match("/^[a-zA-Z0-9 ]{3,}$/", $name) == 1 )? 0 : 'name' ;
$check[] = (isValidEmail($email) == true )? 0 : 'email' ;
$check[] = (preg_match("/^[a-zA-Z0-9 ]{2,}$/", $major) == 1 )? 0 : 'major' ;
$check[] = ($year != NULL)? 0 : -1 ;
if($conc_yn == 'Yes'){
	$check[] = (preg_match("/^[a-zA-Z0-9 ]{2,}$/", $concentration) == 1 )? 0 : 'concentration' ;
}else if($conc_yn == 'No'){
	//$check[] = (preg_match("/^[a-zA-Z0-9 ]{2,}$/", $c_interest) == 1 )? 0 : 'c_interest' ;	
}else{
	$check[] = 'conc_yn';	
}
$check[] = ($first_appt != NULL)? 0 : 'first_appt' ;
$check[] = ($purpose != NULL)? 0 : 'purpose' ;
$check[] = ($unit_in[0] == 'agree')? 0 : 'unit_in' ;
$check[] = ($info_in[0] == 'agree')? 0 : 'info_in' ;
$check[] = ($privacy_in[0] == 'agree')? 0 : 'privacy_in' ;

$_SESSION['check'] = $check;


foreach($check as $test)
{
	if(is_string($test))
		header("location:http://www.cob.calpoly.edu/advising/policies-forms/advising-intake/");
}
*/



$output = "<h2>A new Travel Grant Application has arrived!</h2><br />";
$output .= "<fieldset><legend>Student Info</legend>";
$output .= "<strong>Date:</strong> $date &nbsp; &nbsp; &nbsp; ";
$output .= "<strong>Name:</strong> $name &nbsp; &nbsp; &nbsp; ";
$output .= "<strong>EMPLID:</strong> $emplid<br /><br />";
$output .= "<strong>Currently enrolled Orfalea undergraduate?:</strong> $enrolled &nbsp; &nbsp; &nbsp; &nbsp;";
$output .= "<strong>Cumulative GPA:</strong> $cgpa<br /><br />";
$output .= "<strong>Cal Poly Email:</strong> $email<br /><br />";
$output .= "<strong>Cell Phone:</strong> $cphone<br /><br />";
$output .= "<strong>Home Phone:</strong> $hphone<br /><br />";
$output .= "</fieldset>";

$output .= "<fieldset><legend>Destination Info</legend>";
$output .= "<strong>Destination City & Country: </strong> $dcountry<br />";
$output .= "<strong>English-Speaking?:</strong> $english_speaking<br /><br />";
$output .= "<strong>Program / School / Company:</strong> $pname<br /><br />";
$output .= "<strong>Duration abroad:</strong> $weeks weeks<br /><br />";
$output .= "<strong>Quarters abroad (".count($quarters)."):</strong> ";
foreach($quarters as $q)
	$output .= "$q, ";
$output .= "</fieldset>";


$output .= "<fieldset><legend>Class Level</legend>";
$output .= "<strong>Class Level:</strong><br />";
$output .= "$clevel<br />";
if($clevel_comment)
	$output .= "<strong>Comment:</strong> $clevel_comment<br />";
$output .= "</fieldset>";


$output .= "<fieldset><legend>Language Immersion</legend>";
$output .= "<strong>Language Immersion:</strong><br /><ul>";
foreach($immersion as $im)
	$output .= "<li>$im</li>";
$output .= "</ul>";
if($immersion_comment)
	$output .= "<strong>Comment:</strong> $immersion_comment<br />";
$output .= "</fieldset>";


$output .= "<fieldset><legend>Progress to Degree</legend>";
$output .= "<strong>Progress to Degree:</strong><br />";
$output .= "$progress<br />";
$output .= "<strong>Applicable Units:</strong> $prog_units<br />";
$output .= "<strong>I have obtained all approved course substitutions:</strong> $prog_subs<br />";
if($progress_comment)
	$output .= "<strong>Comment:</strong> $progress_comment<br />";
$output .= "</fieldset>";

$output .= "<fieldset><legend>Statement of Purpose and College Service</legend>";
$output .= "<strong>Statement of Purpose:</strong><br />";
$output .= "$purpose<br />";
$output .= "<br /><strong>College Service:</strong><br />";
$output .= "$services<br />";
$output .= "</fieldset>";

$output = stripslashes($output);


// $to = 'cobadvis@calpoly.edu';
$subject = "[Travel Grant App] - $name, $email";
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers  .= "From: cobadvis@calpoly.edu\r\n"; 
$cc = 'kbrusch@calpoly.edu, fgonza02@calpoly.edu';
$headers .= 'Cc: ' . $cc . "\r\n";

/*
$to = 'cobadvis@calpoly.edu';
mail($to, $subject, $output, $headers);*/
$to = 'acarte13@calpoly.edu';
mail($to, $subject, $output, $headers);
/* These addresses are covered by the CC above.
$to = 'kbrusch@calpoly.edu';
mail($to, $subject, $output, $headers);
$to = 'fgonza02@calpoly.edu';
mail($to, $subject, $output, $headers);
$to = 'jtobin@calpoly.edu';
mail($to, $subject, $output, $headers);*/

//	RESPONSE EMAIL
//		On Successful submission, send confirmation to applicant

$conf_out .= "<p>Dear ".$name.",</p>";
$conf_out .= "<p>Your Orfalea Competitive Travel Grant application has been received. You will receive notification of approval/denial of your request within 6-8 weeks of your submission date. Contact the Orfalea College of Business Advising Center at (805) 756-2601 if you have any further questions about the application and/or the approval process. We appreciate your interest in studying internationally and best of luck in your travels!</p>";
$conf_out .= "Sincerely,<br />";
$conf_out .= "<img src=\"http://www.cob.calpoly.edu/wp-content/uploads/media/images/advising/kris_signature.gif\" width=\"188\" height=\"70\"><br />";
$conf_out .= "Kris McKinlay<br />";
$conf_out .= "Assistant Dean<br />";
$conf_out .= "Orfalea College of Business<br />";
$subject = "Travel Grant Application Received";
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: cobadvis@calpoly.edu\r\n"; 

$to = $email;
mail($to, $subject, $conf_out, $headers);

/*
$to = 'aswanson@calpoly.edu';
mail($to, $subject, $output, $headers);
$to = 'kbrusch@calpoly.edu';
mail($to, $subject, $output, $headers);
$to = 'kmckinla@calpoly.edu';
mail($to, $subject, $output, $headers);
$to = 'cobadvis@calpoly.edu';
mail($to, $subject, $output, $headers);*/

header("location:http://www.cob.calpoly.edu/advising/policies-forms/travel-grant-thank-you/");

/*
function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}*/
?>