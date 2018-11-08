<?php
session_start();

// CHANGE THIS IF YOU DON'T WANT IT TO PRINT OUT DEBUGGING INFORMATION
$debug = false;
$confirmEmail = false; //Change if you want to send a confirmation email to whoever is filling the form out, must change information below

extract($_POST);
if($debug){
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";

	echo "<br /><br /><br />";
}

//	ADVISING EMAIL
//		On Successful submission, send text to LITC center

$output = '';
$output .= "<h2>A new Client Intake Application has arrived!</h2><br>";
$output .= "<p><strong>Name:</strong> $fname $lname</p>";
$output .= "<p><strong>Date of Birth:</strong> $dob</p>";
$output .= "<p><strong>Address:</strong> $address";
$output .= "<p><strong>Preferred Telephone:</strong> $ptelephone</p>";
$output .= "<p><strong>Alternative Telephone:</strong> $atelephone</p>";
$output .= "<p><strong>Email:</strong> $email</p>";
$output .= "<p><strong>Best Hours to Contact:</strong> $hours</p>";
$output .= "<p><strong>Gender:</strong> $gender</p>";

$output .= "<p><strong>Disabled / Handicapped:</strong> $disabled</p>";
$output .= "<p><strong>First Language:</strong> $language</p>";
$output .= "<p><strong>Tax Years in Question:</strong> $taxYears</p>";
$output .= "<p><strong>Amount Due in Question:</strong> $amount</p>";
$output .= "<p><strong>Brief Description of Tax Issue:</strong> $taxIssues</p>";
$output .= "<p><strong>How many people in your household (related by blood, marriage, or adoption):</strong> $numHousehold</p>";
$output .= "<p><strong>Does anyone in your household, other than you, receive income? If so, how much:</strong> $householdIncome</p>";

$output .= "<br /><p><strong>Types of Income</strong></p>";
$output .= "<p><strong>Wages:</strong>";
$output .= ($wages != '')? " $wages</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Unemployment:</strong> ";
$output .= ($unemployment != '')? "$unemployment</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Social Security/Disability:</strong> ";
$output .= ($socialSecurity != '')? " $socialSecurity</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Self-Employment:</strong> ";
$output .= ($selfEmployment != '')? " $selfEmployment</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Rental Income:</strong> ";
$output .= ($rentalIncome != '')? " $rentalIncome</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Gambling Winnings:</strong> ";
$output .= ($gamblingWinnings != '')? " $gamblingWinnings</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Dividends:</strong> ";
$output .= ($dividends != '')? " $dividends</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Disability:</strong> ";
$output .= ($disability != '')? " $disability</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Child Support:</strong> ";
$output .= ($childSupport != '')? " $childSupport</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Alimony Received:</strong> ";
$output .= ($alimonyReceived != '')? " $alimonyReceived</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Do you own a small business:</strong> ";
$output .= ($smallBusiness != '')? " $smallBusiness</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Do you own Real Estate? If so, what type and where:</strong> ";
$output .= ($realEstate != '')? " $realEstate</p>" : "<i> Not Listed</i></p>";

$output .= "<br /><p><strong>Recieved Forms</strong></p>";
$output .= "<p><strong>Audit Notice:</strong> ";
$output .= ($auditNotice != '')? "$auditNotice " : "<i> Not Listed</i></p>";
$output .= ($auditNoticeDate != '' && $auditNotice)? "<strong>Date:</strong> ".$auditNoticeDate.'</p>' : '</p>';
$output .= "<p><strong>30 Day Lettter:</strong> ";
$output .= ($thirtyDay != '')? "$thirtyDay " : "<i> Not Listed</i></p>";
$output .= ($thirtyDayDate != '' && $thirtyDay)? "<strong>Date:</strong> ".$thirtyDayDate.'</p>' : '</p>';
$output .= "<p><strong>90 Day Lettter:</strong> ";
$output .= ($ninetyDay != '')? "$ninetyDay " : "<i> Not Listed</i></p>";
$output .= ($ninetyDayDate != '' && $ninetyDay)? "<strong>Date:</strong> ".$ninetyDayDate.'</p>' : '</p>';
$output .= "<p><strong>Notice of a Lien:</strong> ";
$output .= ($lienNotice != '')? "$lienNotice " : "<i> Not Listed</i></p>";
$output .= ($lienNoticeDate != '' && $lienNotice)? "<strong>Date:</strong> ".$lienNoticeDate.'</p>' : '</p>';
$output .= "<p><strong>Notice of a Intent to Levy:</strong> ";
$output .= ($intentLevy != '')? "$intentLevy " : "<i> Not Listed</i></p>";
$output .= ($intentLevyDate != '' && $intentLevy)? "<strong>Date:</strong> ".$intentLevyDate.'</p>' : '</p>';
$output .= "<p><strong>Other:</strong> ";
$output .= ($otherForm != '')? "$otherForm " : "<i> Not Listed</i></p>";
$output .= ($otherFormDate != '' && $otherForm)? "<strong>Date:</strong> ".$otherFormDate.'</p>' : '</p>';




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

$subject = "Client Intake Application";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "From: cobadvis@calpoly.edu\r\n";
$to = 'litc@calpoly.edu';
//$to = 'mover333@gmail.com';
if(strlen($fname) > 0){
	$mail = mail($to, $subject, $output, $headers);
}

//	RESPONSE EMAIL
//		On Successful submission, send confirmation to applicant

//Change $conf_out to what you would like to sent in the confirmation email
$conf_out .= "";

$subject = "Client Intake Application Received";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers  .= "From: litc@calpoly.edu\r\n";

$to = $email;
if($confirmEmail) {
mail($to, $subject, $conf_out, $headers);
}

// Change this thankyou page when it goes live
if(!$debug && $mail)
	header("location:/litc/thank-you/");
?>