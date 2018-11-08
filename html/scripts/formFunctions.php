<?php
	session_start();
	extract($_POST);
	require './phpmailer/PHPMailerAutoload.php';
	
	//
	//
	//
	//
	//
	//
	function sendForm($output, $subject, $to, $redirect, $debug = false){
		//prints out all given information
		if($debug){
			echo "<pre>";
			var_dump($_POST);
			echo "</pre>";
		
			echo "<br /><br /><br />";
			echo "<br /><br /><br />";
			echo $output;
			echo "<br /><br /><br />";
			echo "<pre>";
			var_dump($output);
			echo "</pre>";
			echo "<br /><br /><br />";
		}
		//stops malicious things from happening
		$output = stripslashes($output);
		date_default_timezone_set('Etc/UTC');
		
		$mail = new PHPMailer;
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  					// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'cob.calpoly@gmail.com';                 // SMTP username
		$mail->Password = 'cob77777';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587; 
		
		$mail->setFrom('noreply@calpoly.edu');
		if(is_array($to)){
			foreach($to as $person){
				$mail->addAddress($person);
			}
		}else{
			$mail->addAddress($to);	
		} 
		$mail->addReplyTo('cob.calpoly@gmail.com');
		
		$mail->isHTML(true); 
		
		$mail->Subject = $subject;
		$mail->Body    = $output; //'This is the HTML message body <b>in bold!</b>';
		$mail->AltBody = $output; //'This is the body in plain text for non-HTML mail clients';
		
		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent!';
		    header("location:".$redirect);
		    exit;
		}

		
	}
?>