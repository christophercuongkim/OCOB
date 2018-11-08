<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>3 PHP Copy Test</title>
<style>
.file_report{
	width:600px;
	margin:25px;
	padding:10px;
	border:1px solid #69F;
	background:#CFF;
}
</style>
</head>
<?php
function boneyardBackup($src)
{
	umask('0111');
	return copy($src, 'BONEYARD/'.$src);
}
function boneyardPost($src)
{
	chmod($src, 0777) or die("Could not alter permissions on $src");
	return unlink($src);
}
function destination($src)
{
	return 'BONEYARD/'.$src;
}
// relative to root directory
$moveMe = array ("wp-content/uploads/assessment/syllabi/w12/mktg/BUS346_Borin.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS346_Danes.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS346_Simon.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS346_Wolf.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS400_Metcalf.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS418_Neill.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS419_Hess.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS446_Simon.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS451_Danes.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS452_Mullikin.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS454_Metcalf.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS455_Metcalf.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS464_Hess.pdf",
"wp-content/uploads/assessment/syllabi/w12/mktg/BUS464_Simon.pdf");
	foreach($moveMe as $file)
		fileBackup($file);
				
?>

<body>
<?php

?>
<p>&nbsp;</p>
</body>
</html>
<?php
function fileBackup($file)
{
	$continue = true;
	$dest = destination($file);
	echo '<div class="file_report">';
	echo 'substr('.$dest.', 0, '.strrpos($dest, '/').')';
	$folder = substr($dest, 0, strrpos($dest, '/'));
	echo '<p>Moving <b>'.$file.'</b> to '.$dest.'....................';
		
		if(file_exists($file))
		{
			echo '<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color:green;">File Exists <em>('.$file.')</em></span></p>';	
		}
		else
		{
			echo '<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color:red;">File DOES NOT Exist <em>('.$file.')</em></span></p>';	
			$continue = false;
		}
		
		if(file_exists($folder))
		{
			echo '<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color:green;">Folder Exists <em>('.$folder.')</em></span></p>';	
		}
		else
		{
			echo '<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color:red;">Folder DOES NOT Exist<em>('.$folder.')</em></span></p>';	
			echo '<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color:orange;">Creating Folder <em>('.$folder.')</em>...</span></p>';	
			if(mkdir($folder, 0777, true))
			{
				echo '<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color:green;">Folder Created! <em>('.$folder.')</em></span></p>';	
			}
			else
			{
				echo '<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color:red;">Folder COULD NOT be created! <em>('.$folder.')</em></span></p>';	
				$continue = false;
			}
		}
		
		if(is_writable($folder))
			echo '<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color:green;">Directory is writable <em>('.$folder.')</em></span></p>';	
		else
		{
			echo '<p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color:red;">Directory is not writable <em>('.$folder.')</em></span></p>';
			$continue = false;
		}
	if($continue)
	{
		if(boneyardBackup($file))
		{
			echo '<span style="color:green;"><b>SUCCESS! File Copied <em>('.$file.' to '.destination($file).')</em></b></span></p>';
		}
		else
		{
			echo '<span style="color:red;"><b>FAILED! File could not be copied. <em>('.$file.' to '.destination($file).')</em></b></span></p>';	
			print_r(error_get_last());
		}
		if(boneyardPost($file))
		{
			echo '<span style="color:green;"><b>SUCCESS! Duplicate Removed <em>('.$file.')</em></b></span></p>';
		}
		else
		{
			echo '<span style="color:red;"><b>FAILED! Duplicate file <em>"'.$file.'"</em> could not be removed.</b></span></p>';	
			print_r(error_get_last());
		}
	}
	else
	{
		echo '<p>File not processed because of the failed tests.</p>';	
	}
	echo '</div>';
}
//var_dump(preg_split("%/.*$%", 'BONEYARD/'.$file));
?>