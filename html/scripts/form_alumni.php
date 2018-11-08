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

if($fname != ''){

//	ADVISING EMAIL
//		On Successful submission, send text to LITC center

$output = '';
$output .= "<h2>A new Alumni Form has arrived!</h2><br>";
$output .= "<p><strong>Name:</strong> $fname $lname</p>";
$output .= "<p><strong>Email:</strong> $email</p>";
$output .= "<p><strong>Phone:</strong>";
$output .= ($phone != '')? " $phone</p>" : "<i> Not Listed</i></p>";

$output .= "<br /><p><strong>Address</strong></p>";
$output .= "<p><strong>Street:</strong>";
$output .= ($street != '')? " $street</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>City:</strong>";
$output .= ($city != '')? " $city</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>State:</strong>";
$output .= ($state != '')? " $state</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Zip Code:</strong>";
$output .= ($zip != '')? " $zip</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Country:</strong>";
$output .= ($country != '')? " $country</p>" : "<i> Not Listed</i></p>";

$output .= "<br /><p><strong>Employment</strong></p>";
$output .= "<p><strong>Job Title:</strong>";
$output .= ($job != '')? " $job</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Employer:</strong>";
$output .= ($employ != '')? " $employ</p>" : "<i> Not Listed</i></p>";

$output .= "<br /><p><strong>Time at Cal Poly</strong></p>";
$output .= "<p><strong>Graduating/Graduated:</strong>";
$output .= ($year != '')? " $year</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Program:</strong>";
$output .= ($program != '')? " $program</p>" : "<i> Not Listed</i></p>";
$output .= "<p><strong>Minor:</strong>";
$output .= ($minor != '')? " $minor</p>" : "<i> Not Listed</i></p>";

$output .= "<br /><p><strong>News</strong></p>";
$output .= "<p><strong>News:</strong>";
$output .= ($news != '')? " $news</p>" : "<i> Not Listed</i></p>";


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

//PHPMailer example
//require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmailer/class.phpmailer.php'; 

date_default_timezone_set('Etc/UTC');

require './phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  					// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'cob.calpoly@gmail.com';                 // SMTP username
$mail->Password = 'cob77777';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('noreply@calpoly.edu');
$mail->addAddress('mover333@gmail.com', 'Robyn');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('cob.calpoly@gmail.com');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Alumni Contact Info Form';
$mail->Body    = $output; //'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = $output; //'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent!';
    header("location:http://www.cob.calpoly.edu/thank-you/");
    //header("location:http://www.cob.calpoly.edu/litc/litc-thank-you/");
    exit;
}
}else{
	echo("no");
}
?>
