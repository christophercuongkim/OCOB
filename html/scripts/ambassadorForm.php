<?php
$type = $_POST["type"];

if($type == "ambassadorRequest") {

	//$email = "sendtobo@gmail.com";
	$email = "";
	$ambassadorEmail = $_POST["AmbassadorEmail"];
	$ambassadorCategories = $_POST["AmbassadorCategories"];
	//all the catgories
	$generalAmb = "23";
	$mba = "24";
	$msBusAnalytics = "25";
	$msTax = "26";
	$msFinAcc = "27";
	$msEcon = "28";
	$engineeringManagementProg = "29";
	//send to the right people
	if(strpos($ambassadorCategories, $generalAmb) != -1){
		
	}
	if(strpos($ambassadorCategories, $mba) != -1){
		
	}
	if(strpos($ambassadorCategories, $msBusAnalytics) != -1){
		
	}
	if(strpos($ambassadorCategories, $msTax) != -1){
		
	}
	if(strpos($ambassadorCategories, $msFinAcc) != -1){
		
	}
	if(strpos($ambassadorCategories, $msEcon) != -1){
		$email .= $ambassadorEmail.",";
		$email .= "econgrad@calpoly.edu,";
	}else if(strpos($ambassadorCategories, $engineeringManagementProg) != -1){
		
	}
	if(strlen($email) < 1){
		$email = "cobgmp@calpoly.edu,";
	}
	$email = rtrim($email, ",");
	
	$name = $_POST["Name"];
	$subject = "[Ambassador Request] ".$name.", ".$_POST["Email"];
	$message = "\nNew ambassador request from ".$name."!\n\n";
	foreach($_POST as $key => $value)
	{
		if($key == "type" || $key == "AmbassadorEmail" || $key == "Submit" || $key =="AmbassadorCategories") {
			continue;
		}
		if($value == "")
			$value = "no response";
			
		$message .= "\n".$key." - ";
		if(is_array($value) && (count($value) > 1))
		{
			foreach($value as $mulval)
				$message .= $mulval.", ";
			$message .= "\n";
		}
		elseif(is_array($value) && (count($value) == 1))
		{
			$message .= $value[0]."\n";
		}
		else
		{	
			$message .= $value."\n";
		}
	}
	$message .= "\n\n";
	$message .= "Sent automatically from Ambassador web form \n\n";
	if(strlen($name) > 0){
	mail($email, $subject, $message, "From: grad-ambassadors@calpoly.edu");
	}
	header("Location:/gradbusiness/graduate-ambassadors-2/thank-you/"); //put in correct thank you page here

}
?>

