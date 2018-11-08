<?php

$debug = false;

/*
Get form fields
*/

$application['name'] = array('Name',filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING));
$application['email'] = array('Email',filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING));
$application['phone'] = array('Phone',filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING));
$application['options'] = array('Which of the following options are you interested in?',$_POST['options']);
$application['comments'] = array('Comments',filter_var(trim($_POST['comments']), FILTER_SANITIZE_STRING));
$application['website'] = array('Your Website and/or LinkedIn Profile',filter_var(trim($_POST['website']), FILTER_SANITIZE_STRING));
$application['college'] = array('Are you a student at Cal Poly State University or Cuesta College?',$_POST['college']);
$application['individual'] = array('Are you working individually or as part of a team?',$_POST['individual']);
$application['business_description'] = array('Briefly describe your business.',filter_var(trim($_POST['business_description']), FILTER_SANITIZE_STRING));

$application['business_stage'] = array('What stage is your business in?',$_POST['business_stage']);

$application['business_ip'] = array('Does your business own any IP or is in the process of creating IP?',filter_var(trim($_POST['business_ip']), FILTER_SANITIZE_STRING));
$application['anticipated_growth'] = array('What is your anticipated growth overall? In terms of sales volume? In terms of employment? Over what period of time?',filter_var(trim($_POST['anticipated_growth']), FILTER_SANITIZE_STRING));
$application['skills_talents'] = array('What are your primary skills and talents?',filter_var(trim($_POST['skills_talents']), FILTER_SANITIZE_STRING));
$application['business_starts'] = array('How many business starts have you been directly involved in as a founder or primary employee?',filter_var(trim($_POST['business_starts']), FILTER_SANITIZE_STRING));
$application['work_habits'] = array('Describe your work habits. How many hours per week, what hours of the day, and how many days per week? Music, quiet, talking/phone?',filter_var(trim($_POST['work_habits']), FILTER_SANITIZE_STRING));
$application['conference_use'] = array('Do you plan on utilizing the conference rooms? If so, for what hours of the day, and how many days per week?',filter_var(trim($_POST['conference_use']), FILTER_SANITIZE_STRING));
$application['how_long'] = array('How long do you plan on using the coworking space?',filter_var(trim($_POST['how_long']), FILTER_SANITIZE_STRING));
$application['what_appeals'] = array('What appeals to you about coworking at the SLO HotHouse?',filter_var(trim($_POST['what_appeals']), FILTER_SANITIZE_STRING));
$capplication['contribute'] = array('How would you contribute to the coworking environment?',filter_var(trim($_POST['contribute']), FILTER_SANITIZE_STRING));
$application['who_you_know'] = array('Who do you know that is already involved in the entrepreneurial community here? Do you have any references?',filter_var(trim($_POST['who_you_know']), FILTER_SANITIZE_STRING));
$application['concerns'] = array('Do you have any concerns about a shared use work environment?',filter_var(trim($_POST['concerns']), FILTER_SANITIZE_STRING));
$application['requirements'] = array('Do you have any special requirements?',filter_var(trim($_POST['requirements']), FILTER_SANITIZE_STRING));
$application['what_else'] = array('What else should we know about you?',filter_var(trim($_POST['what_else']), FILTER_SANITIZE_STRING));

$email_content = '';
foreach ($application as $question) {
    $q = $question[0];
    $a = $question[1];
    if(is_array($a)){
        $a_list = '<ul>';
        foreach ($a as $selection) {
            $a_list .= '<li>' . $selection . '</li>';
        }
        $a_list .= '</ul>';
        $a = $a_list;
    }
    $email_content .= '<p><strong>' . $q . '</strong><br>' . $a . '</p>';
}


/*
Send thanks email
*/

require 'phpmailer/PHPMailerAutoload.php';


/* Thank You Email */
$thanks = new PHPMailer;
$thanks->addAddress($_POST['email'], $_POST['name']);
$thanks->isSendmail();
$thanks->isHTML(true);
$thanks->From = 'no-reply@cie.calpoly.edu';
$thanks->FromName = 'No Reply';
$thanks->Subject = 'Thank you';
$thanks->Body = '<p>Thank you for your interest in Coworking at CIE. We\'ll review your application and reach out to you soon.</p>';

if($thanks->send()) {
    // Yay!
}




/* Notificiation Email, Save to CSV */

$mail = new PHPMailer;

if($debug){
    $mail->addAddress('cole@iedesign.com', 'Cole Gray'); 
} else {
    $mail->addAddress('mashurst@calpoly.edu', 'Cal Poly'); 
    $mail->addAddress('clconti@calpoly.edu', 'Cal Poly');
}

$mail->isSendmail();
$mail->isHTML(true);

$mail->From = 'no-reply@cie.calpoly.edu';
$mail->FromName = 'Coworking Application Form';

$mail->Subject = 'Coworking Application';
$mail->Body    = $email_content;

if(!$mail->send()){
    header( "Location: http://cie.calpoly.edu/application/submission?submit=false");
} else {
    header( "Location: http://cie.calpoly.edu/application/submission");

}