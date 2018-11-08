<?php 
session_start();

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

$output = "<h2>A new Travel Grant Application has arrived!</h2><br>";
$output .= "<strong>Date:</strong> $date &nbsp; &nbsp; &nbsp; ";
$output .= "<strong>Name:</strong> $name &nbsp; &nbsp; &nbsp; ";
$output .= "<strong>EMPLID:</strong> $emplid<br><br>";
$output .= "<strong>Currently enrolled Orfalea undergraduate?:</strong> $enrolled &nbsp; &nbsp; &nbsp; &nbsp;";
$output .= "<strong>Cumulative GPA:</strong> $cgpa<br><br>";
$output .= "<strong>Destination Country:</strong> $dcountry";
$output .= "&nbsp; &nbsp; &nbsp; <strong>English-Speaking?:</strong> $english_speaking<br><br>";
$output .= "<strong>Program / School / Company:</strong> $pname<br><br>";
$output .= "<strong>Program Duration:</strong> $weeks weeks<br><br>";
$output .= "<strong>Cal Poly Email:</strong> $email<br><br>";
$output .= "<strong>Cell Phone:</strong> $cphone<br><br>";
$output .= "<strong>Home Phone:</strong> $hphone<br><br>";
$output .= "<br /><strong>Class Level:</strong><br>";
$output .= "$clevel<br>";
if($clevel_comment)
	$output .= "&nbsp; &nbsp; <strong>Comment:</strong> $clevel_comment<br>";
$output .= "<br /><strong>Duration of formal study abroad trip:</strong><br>";
$output .= "$duration<br>";
if($duration_comment)
	$output .= "&nbsp; &nbsp; <strong>Comment:</strong> $duration_comment<br>";
$output .= "<br /><strong>Destination:</strong><br>";
$output .= "$dest<br>";
if($dest_comment)
	$output .= "&nbsp; &nbsp; <strong>Comment:</strong> $dest_comment<br>";
$output .= "<br /><strong>Language Immersion:</strong><br>";
$output .= "$immersion<br>";
if($immersion_comment)
	$output .= "&nbsp; &nbsp; <strong>Comment:</strong> $immersion_comment<br>";
$output .= "<br /><strong>Progress to Degree:</strong><br>";
$output .= "$progress<br>";
$output .= "Applicable Units: $prog_units<br>";
$output .= "I have obtained all approved course substitutions: $prog_subs<br>";
if($progress_comment)
	$output .= "&nbsp; &nbsp; <strong>Comment:</strong> $progress_comment<br>";
	
$output .= "<br><strong>Statement of Purpose:</strong><br>";
$output .= "$purpose<br>";
	
$output .= "<br><strong>College Service:</strong><br>";
$output .= "$services<br>";

$output = stripslashes($output);

//echo $output;

// $to = 'cobadvis@calpoly.edu';
$subject = "[Travel Grant App] - $name, $email";
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers  .= "From: cobadvis@calpoly.edu\r\n"; 
$to = 'jtobin@calpoly.edu';
mail($to, $subject, $output, $headers);
$to = 'cobadvis@calpoly.edu';
mail($to, $subject, $output, $headers);
$to = 'aswanson@calpoly.edu';
mail($to, $subject, $output, $headers);
$to = 'kbrusch@calpoly.edu';
mail($to, $subject, $output, $headers);
$to = 'kmckinla@calpoly.edu';
mail($to, $subject, $output, $headers);u

//	RESPONSE EMAIL
//		On Successful submission, send confirmation to applicant

$conf_out .= "<p>Dear ".$name.",</p>";
$conf_out .= "<p>Your Orfalea Competitive Travel Grant application has been received. You will receive notification of approval/denial of your request within one month of your submission date. Contact the Orfalea College of Business Advising Center at (805) 756-2601 if you have any further questions about the application and/or the approval process. We appreciate your interest in studying internationally and best of luck in your travels!</p>";
$subject = "Travel Grant Application Received";
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers  .= "From: cobadvis@calpoly.edu\r\n"; 
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