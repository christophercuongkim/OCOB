<?php
	
$basedir = "http://www.cob.calpoly.edu";
if(isset($_GET['dev']) && $_GET['dev'] == 'themedev'){
	$basedir = "http://www.cob.calpoly.edu/themedev";
}
// Variables
	$fdbfile = "flatdb/course_logs.csv";
	$redir = $basedir."/bus304-cp/";

// Check for valid Email:
	$regex = "/^[A-Z0-9._%+-]+@(calpoly\.edu)$/"; // Regular expression to ONLY allow *@calpoly.edu addresses
	//$regex = "/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/"; // Regular expression to allow any address
	
	
	if(!validEmail($_GET['email']))
	{
		$redir = $basedir."/bus304/?login_err=Please enter a valid email address";		
		header("location:$redir");
		exit();
	}


$fp = fopen($fdbfile, 'a') or die("Cannot process email address at this time.");
date_default_timezone_set("America/Los_Angeles");
$data = date("g:i a d M Y").',';
$data .= $_GET['name'].',';
$data .= $_GET['email'].',';
$data .= $_GET['ipaddr'].",\n";
fwrite($fp, $data);
fclose($fp);
header("location:$redir");

/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || 
 ↪checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}

?>
