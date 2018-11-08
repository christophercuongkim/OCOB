<?php
session_start();
/*
?>
<pre>
<?php
var_dump($_POST);
?>
</pre>
<?php*/
extract($_POST);
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
/*
$_SESSION['check'] = $check;


foreach($check as $test)
{
	if(is_string($test))
		header("location:http://www.cob.calpoly.edu/studentservices/policies-forms/advising-intake/");
}
*/
$output = "<h2>A new intake form has arrived!</h2><br>";
$output .= "<strong>Appointment Date:</strong> $date_B<br>";
$output .= "<strong>Name:</strong> $name &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
$output .= "<strong>Email:</strong> $email<br>";
$output .= "<strong>Major:</strong> $major &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
$output .= "<strong>Year:</strong> $year<br>";
$output .= "<br><strong>Declared Concentration?:</strong> $conc_yn<br>";
if($conc_yn == 'Yes'){
	$output .= "If yes, which one?: &nbsp; &nbsp; $concentration<br>";
}else{
	$output .= "If no, what are you interested in?: &nbsp; &nbsp; $c_interest<br>";
}
$output .= "<br><strong>This is my first appointment at Student Services:</strong> $first_appt<br>";
$output .= "<br><strong>1) What would you like to talk about in your appointment? (Check all that apply)</strong><br>";
foreach($appt_topic as $atop){
	$output .= " - $atop<br>";	
}
if($appt_topic_other)
	$output .= " - OTHER: $appt_topic_other<br>";
	
$output .= "<br><strong>2) Do you need to complete any forms? (Check all that apply)</strong><br>";
foreach($appt_forms as $aform){
	$output .= " - $aform<br>";	
}
	
if($appt_forms_other)
	$output .= " - OTHER: $appt_forms_other<br>";
	
$output .= "<br><strong>3) Are you interested in free tutoring for any of the following OCOB classes? (Check all that apply)</strong><br>";
foreach($tutoring as $atut){
	$output .= " - $atut<br>";	
}
$output .= "<br><strong>4)What is the main purpose of making this appointment?</strong><br>";
$output .= "$purpose<br>";
$output .= "<br><p><strong>Unit Count:</strong> Student Services does not do official unit counts. For an official unit count, you must see Evaluations in the Office of Academic Records (Bldg 1). We strive to assist students in tracking their total units, but the official unit count must be obtained from Evaluations.</p>
<p><strong>Request for Additional Information:</strong> If you feel the need for additional information at the end of your appointment, please ask your Peer Advisor for a Request for Additional Information to be reviewed by our Academic Advisors.</p>
<p><strong>We Respect Your Privacy!</strong> Please know that Student Services maintains strict confidentiality. We will not disclose any academic or personal information except as permitted by the student or under situations where a student's safety would be in jeopardy. All OCOB Advisors are bound to confidentiality at all times.</p>";
$output .= "<span style=\"font-size:9px;\"><br>---------------------------<br>This intake form was automatically sent based on a response to the Student Services Intake Form webpage. This form can be modified by a web administrator by editing the advising_intake.php template and the advising_intake.php script.</span>";

//echo $output;

$to = 'cobadvis@calpoly.edu';
//$to = 'jakechs@gmail.com';
$subject = "[Student Services Intake] - $name, $email, $date_B";
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers  .= "From: cobadvis@calpoly.edu\r\n"; 
mail($to, $subject, $output, $headers);

header("location:http://www.cob.calpoly.edu/studentservices/withdrawl-thank-you/");


function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}
?>