<?php
	require "./formFunctions.php";
  	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$privatekey = '6LcRiQcTAAAAAAX5CHAjAp3AIOW4RfxRhJpt5Mcp';
	$response = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
	$data = json_decode($response);

	if (isset($data->success) AND $data->success==true) {
    // Your code here to handle a successful verification
		echo("Hello");
		$output = '';
		$output .= "<h2>A new Alumni Info Update Form has arrived!</h2><br>";
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
		$output .= "<p><strong>Concentration:</strong>";
		$output .= ($concentration != '')? " $concentration</p>" : "<i> Not Listed</i></p>";
		$output .= "<p><strong>Minor:</strong>";
		$output .= ($minor != '')? " $minor</p>" : "<i> Not Listed</i></p>";
		
		$output .= "<br /><p><strong>News</strong></p>";
		$output .= "<p><strong>News:</strong>";
		$output .= ($news != '')? " $news</p>" : "<i> Not Listed</i></p>";
		
		$to = array("fgonza02@calpoly.edu");
		$subject = "Alumni Contact Info Update Form";
		$redirect = "/update-thank-you/";
		echo("Hello1");
		
		if(strlen($fname) > 0 && strlen($email) > 0){
		sendForm($output,$subject,$to,$redirect);
		echo("Hello2");
		}
	} else {
         echo "CAPTCHA not verified";
         
         echo "<script>setTimeout(\"location.href = 'http://www.cob.calpoly.edu/alumni-info-update';\",1500);</script>";
         die();
	}
?>
