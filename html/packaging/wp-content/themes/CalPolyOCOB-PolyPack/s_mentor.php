<?php// File: s_mentor.php ?>
<?php
session_start();
$mentors = $_SESSION['mentors'];
$BASEURL = "http://www.cob.calpoly.edu/ep/";
//If adding a new mentor
if($_GET['a'])
{
echo 'stage2a';
	switch($_GET['a']){
		case 'remove':
			$i=$_GET['m'];
			if($mentors[$i])
				unset($mentors[$i]);
				
			break;	
			
		case 'add':
			if($_POST['mentor']){
				if(count($mentors) < 3){
					if(!in_array($_POST['mentor'], $mentors)){
						$mentors[] = $_POST['mentor'];
					}else{
						$_SESSION['message'] = "You have already chosen <em>".$_POST['mentor']."</em>.";
					}
				}else{
					$_SESSION['message'] .= "You can only select 3 mentors. Cannot add <em>".$_POST['mentor']."</em>.";
				}
			}
			break;
	}
	$_SESSION['mentors'] = $mentors;
	header("location:".$BASEURL."mentorform.php");
}
// For submitting form with valid conditions

elseif($_POST['submit_form'] == 'Submit' && 
	((count($mentors) > 0 && count($mentors) < 4) || $_POST['type'] == 'committee'))
{	
	echo 'stage2b';
	var_dump($_POST);
	
	if($_POST['type'] == 'mentor')
	{
		$min_domain = '@calpoly.edu';
		/* if(substr(strtolower(trim($_POST['Email'])), -1 * strlen($min_domain)) != $min_domain){ */
		if(strcmp(substr(strtolower(trim($_POST['Email'])), -1 * strlen($min_domain)), $min_domain) != 0) {
			$_SESSION['error_messages'] = "You must provide a valid @calpoly.edu email address.";
			header("location:".$BASEURL."mentorform.php");
			exit();
		}
		// $ad_email - admin email address
		// $ad_mess - admin email message
		// $con_email - confirmation email
		// $con_mess - confirmation message
		list($ad_email, $ad_mess, $ad_subj) = formatMentorAdminMessages($_POST, $mentors);
		//list($con_email, $con_mess) = formatMentorConfirmationMessages($_POST, $mentors);
	}elseif($_POST['type'] == 'committee')
	{
		$min_domain = '@calpoly.edu';
		if(substr(strtolower(trim($_POST['Email'])), -1 * strlen($min_domain)) != $min_domain){
			$_SESSION['error_messages'] = "You must provide a valid @calpoly.edu email address.";
			header("location:".$BASEURL."mentorcomform.php");
			exit();
		}
		// $ad_email - admin email address
		// $ad_mess - admin email message
		// $con_email - confirmation email
		// $con_mess - confirmation message
		list($ad_email, $ad_mess, $ad_subj) = formatCommitteeAdminMessages($_POST);
		//list($con_email, $con_mess) = formatCommitteeConfirmationMessages($_POST);
	}
	//Mail messages
	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$headers  .= "From: cobadvis@calpoly.edu\r\n"; 
	mail($ad_email, $ad_subj, $ad_mess, $headers);
	unset($_SESSION['mentors']);
	header("location:".$BASEURL."thankyou.html");
	
}
else
{
	if($_POST['type'] == 'mentor')
	{
		$_SESSION['error_messages'] = "You must provide a valid @calpoly.edu email address.";
		header("location:".$BASEURL."mentorform.php");
	}
	elseif($_POST['type'] == 'committee')
	{
		header("location:".$BASEURL."mentorcomform.php");
		exit();
	}
}


//Admin messages
function formatMentorAdminMessages($post, $mentors)
{
	$email = 'ocob-epp@calpoly.edu';//$post['email'];
	$name = $post['Name'];
	$subject = '[Mentor Request - EPP] '.$name.', '.$post['Email'];
	$message = '<p>New mentor request from '.$name.'!</p>';
	$message .= '<ul>';
	foreach($post as $key => $value)
	{
		if($value == '')
			$value = '<em>no response</em>';
			
		$message .= '<li><b>'.$key.'</b> - ';
		if(is_array($value) && (count($value) > 1))
		{
			foreach($value as $mulval)
				$message .= $mulval.', ';
			$message .= '</li>';
		}
		elseif(is_array($value) && (count($value) == 1))
		{
			$message .= $value[0].'</li>';
		}
		else
		{	
			$message .= $value.'</li>';
		}
	}
	$message .= '<li><em><strong>Mentors</strong></em></li><ul>';
	foreach($mentors as $m)
		$message .= '<li>'.$m.'</li>';
	$message .= '</ul></ul>';
	$message .= '<br /><br /><p>Sent automatically from Executive Partners web form <em>s_mentor.php</em></p>';
	return array($email, $message, $subject);

}
function formatCommitteeAdminMessages($post)
{
	$email = 'eppmentees@gmail.com';
	$email = 'ocob-epp@calpoly.edu';
	$name = $post['Name'];
	$subject = '[Committee Request - EPP] '.$name.', '.$post['Email'];	
	$message = '<p>New committee request from '.$name.'!</p>';
	$message .= '<ul>';
	foreach($post as $key => $value)
	{
		$message .= '<li><b>'.$key.'</b> - ';
		if(is_array($value) && (count($value) > 1))
		{
			foreach($value as $mulval)
				$message .= $mulval.', ';
			$message .= '</li>';
		}
		elseif(is_array($value) && (count($value) == 1))
		{
			$message .= $value[0].'</li>';
		}
		else
		{	
			$message .= $value.'</li>';
		}
	}
	$message .= '</ul>';
	$message .= '<br /><br /><p>Sent automatically from Executive Partners web form <em>s_mentor.php</em></p>';
	return array($email, $message, $subject);
}
/*
function formatMentorConfirmationMessages($post, $mentors)
{
	$email = 'jakechs@gmail.com';
	$name = $post['Name'];
	$message = $name.',<br />';
	$message .= '<p>Your request for the following mentors has been recieved. Have fun!</p>';
	$message .= '<ul>';
	foreach($mentors as $m)
		$message .= '<li>'.$m.'</li>';
	$message .= '</ul>';
	return array($email, $message);
}*/
/*
function formatCommitteeConfirmationMessages($post)
{
	$email = $post['Email'];
	$name = $post['Name'];
	$message = $name.',<br />';
	$message .= '<p>Your request for committee assistance has been recieved. Have fun!</p>';
	return array($email, $message);
}*/

/*
array(11) {
  ["type"]=>
  string(8) "commitee"
  ["ferpa"]=>
  string(5) "agree"
  ["name"]=>
  string(4) "Name"
  ["year"]=>
  string(8) "Freshman"
  ["major"]=>
  string(5) "major"
  ["interests"]=>
  string(10) "Networking"
  ["interests_other"]=>
  string(5) "other"
  ["phone"]=>
  string(5) "phone"
  ["email"]=>
  string(5) "email"
  ["time"]=>
  string(7) "contact"
  ["submit_form"]=>
  string(6) "Submit"
}
array(1) {
  ["mentors"]=>
  array(1) {
    [0]=>
    string(53) "Mr. Timothy Banducci 
President California-West, Inc"
  }
}



array(11) {
  ["type"]=>
  string(6) "mentor"
  ["mentor"]=>
  string(53) "Mr. Timothy Banducci 
President California-West, Inc"
  ["name"]=>
  string(4) "Name"
  ["year"]=>
  string(8) "Freshman"
  ["major"]=>
  string(5) "Major"
  ["interests"]=>
  string(10) "Networking"
  ["interests_other"]=>
  string(5) "other"
  ["phone"]=>
  string(6) "phone "
  ["email"]=>
  string(5) "email"
  ["time"]=>
  string(7) "contact"
  ["submit_form"]=>
  string(6) "Submit"
}
array(1) {
  ["mentors"]=>
  array(1) {
    [0]=>
    string(53) "Mr. Timothy Banducci 
President California-West, Inc"
  }
}*/

?>