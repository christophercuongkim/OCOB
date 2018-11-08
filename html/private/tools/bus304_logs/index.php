<?php 
function print_results(){
	// Default information
	$start = '2011-05-01';
	$end = date("Y-m-d");
	
	// Process post data
	if($_POST['submit']){
		date_default_timezone_set('America/Los_Angeles');
		$start = strtotime($_POST['start']);	
		$end = strtotime($_POST['end']) + 86399;	 // add 23:59:59 to time so it's the end of day
		$old_email = explode("\n", $_POST['emails']);
		$invert = (isset($_POST['invert']))? true : false;
		$display = $_POST['display'];
		
		printf('<p>Start: %s (%s, %s)</p>', date("M j, Y, H:i:s", $start), $start, $_POST['start']);
		printf('<p>End: %s (%s, %s)</p>', date("M j, Y, H:i:s", $end), $end, $_POST['end']);
		
		$emails = array();
		foreach($old_email as $line){
			if(strpos($line, '@') !== false){
				$emails[] = strtolower(trim($line));
			}
		}
		
		printf('<p>Email Filter: (%s addresses)</p>', count($emails));
		switch($display){
			case 'unique':
				unique_table($start, $end, $invert, $emails);
				break;
			case 'logs':
				log_table($start, $end, $invert, $emails);
				break;
		}
	}
}
function print_csv($result, $i=20){
	echo '
	<a name="csv"></a><h1>CSV Data Export</h1>
	<p><a href="#top">Jump back to top</a></p>
	You can copy and paste the code below or <a href="export/export.csv">download the csv file (export.csv)</a>
	<p><textarea rows="'.ceil($i*1.02).'" cols="100">';
	echo $result;
	file_put_contents('export/export.csv', $result);
	echo '</textarea></p>';
}

function unique_table($start, $end, $invert, $emails){	
	$fname = "http://www.cob.calpoly.edu/scripts/flatdb/course_logs.csv";
	$logs = file_get_contents($fname);
	$rows = explode("\n", $logs);
	date_default_timezone_set("America/Los_Angeles");
	
	$result = $rows[0];
	unset($rows[0]);
	$i = 0;
	$entries = array();
	foreach($rows as $row){
	  $col = explode(",", $row);
	  $col[0] = strtotime($col[0]);
	  $col[3] = strtolower($col[3]);
	  $print = true;
	  if($start != 0 && $col[0] < $start){
		$print &= false;  
	  }
	  if($end != 0 && $col[0] > $end){
		$print &= false;  
	  }
	  
	  if($invert && (count($emails) > 0)){
		  if(in_array(trim($col[3]), $emails)){
			$print &= false;  
		  }
	  }else{
		  if((count($emails) > 0) && !in_array(trim($col[3]), $emails)){
			$print &= false;  
		  }
	  }
	  
	  if($print){
	    $entries[$col['3']][] = $col;
	  }
	}
	$result = 'Name,Given Name,Additional Name,Family Name,Notes,E-mail 1 - Value,E-mail 2 - Value'."\n";
	ksort($entries);
	echo '<h2>'.count($entries).' Unique Users Found</h2>';
	echo '<ol>';
	foreach($entries as $email => $user){
		echo '<li><strong>'.$email.'</strong> - '.count($user);
		echo ' - <input type="button" onclick="toggle_comment(\''.$email.'\');" value="Show / Hide Table" /><br /><div style="display:none;" id="'.$email.'"><table>'."\n";
		$i = 0;
		foreach ($user as $col) {
			$i++;
			printf("<tr><td>%d.</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", 
			$i,date("M d, Y - h:ia",$col[0]), $col[1], $col[2], $col[3], $col[4]);
		}
		echo '</table></div>';
		$col = $user[0];
		$name = explode(' ', trim($col[1]));
		$fname = $name[0];
		$lname = '';
		if(count($name) > 1){
			$lname = $name[count($name) - 1];
		}
		$mname = '';
		if(count($name) > 2){
			unset($name[0]);
			unset($name[count($name)]);
			$mname = implode(' ', $name);
		}
		$result .= sprintf('%s,%s,%s,%s,%s,%s,%s,'."\n",
						$col[1], $fname, $mname, $lname,(($col[2] == 'Unknown')?'':$col[2]),$col[3],'');
		
	}
	echo '</ol>';
	
	print_csv($result, count($entries));	
}

function log_table($start, $end, $invert, $emails){	
	echo '
<table border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td><strong>#</strong></td>
    <td><strong>TIMESTAMP</strong></td>
    <td><strong>NAME</strong></td>
    <td><strong>TYPE</strong></td>
    <td><strong>EMAIL ADDRESS</strong></td>
    <td><strong>IP</strong></td>
  </tr>
	';

	$fname = "http://www.cob.calpoly.edu/scripts/flatdb/course_logs.csv";
	$logs = file_get_contents($fname);
	$rows = explode("\n", $logs);
	date_default_timezone_set("America/Los_Angeles");
	
	$result = $rows[0];
	unset($rows[0]);
	$i = 0;
	$entries = array();
	foreach($rows as $row){
	  $col = explode(",", $row);
	  $col[0] = strtotime($col[0]);
	  $col[3] = strtolower($col[3]);
	  $entries[$col['3']] = $col;
	  $print = true;
	  if($start != 0 && $col[0] < $start){
		$print &= false;  
	  }
	  if($end != 0 && $col[0] > $end){
		$print &= false;  
	  }
	  
	  if($invert && (count($emails) > 0)){
		  if(in_array(trim($col[3]), $emails)){
			$print &= false;  
		  }
	  }else{
		  if((count($emails) > 0) && !in_array(trim($col[3]), $emails)){
			$print &= false;  
		  }
	  }
	  
	  if($print){
		$i++;
		printf("<tr><td>%d.</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", 
		$i,date("M d, Y - h:ia",$col[0]), $col[1], $col[2], $col[3], $col[4]);
		$result .= $row;
	  }
	}
	echo '</table>';
	print_csv($result, count($rows));	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bus304 Log Examiner</title>
<script type="text/javascript">
    function toggle_comment(id) {
       var e = document.getElementById(id);
    if(e.style.display == 'block')
        e.style.display = 'none';
    else
      e.style.display = 'block';
    }
<!--
/*
    function toggle_id(id) {
       $('#'+id).each(if(e.style.display == 'block'){e.style.display = 'none'}else{e.style.display = 'block'});
    }
*/
//-->
/*
<a href="#" onclick="toggle_visibility('foo');">Click here to toggle visibility of element #foo</a>
<div id="foo">This is foo</div>*/
</script>
</head>
<?php function checked($val, $dis) {
	if($val == $dis)
		echo 'checked';
	}
?>
<body>
<a name="top"></a>
<h1>BUS304 Log Filter Tool</h1>
<form action="index.php" method="post">
    <fieldset>
        <legend>Filter Log Results</legend>
        <p> <strong>Start Date:</strong>
            <input type="date" name="start" value="<?php echo ((isset($_POST['start']) && strlen($_POST['start']) > 4)? $_POST['start'] : '2011-05-01'); ?>" />
            <strong>End Date:</strong>
            <input type="date" name="end" value="<?php echo ( (isset($_POST['end']) && strlen($_POST['end']) > 4)? $_POST['end'] : date("Y-m-d") ); ?>" />
        </p>
        <p><strong>Display Format</strong><br />
        	<?php $display = (isset($_POST['display']))? $_POST['display'] : 'unique' ; ?>
			<label><input name="display" type="radio" value="logs" <?php checked('logs',$display); ?> /> Logs</label><br />
		   	<label><input name="display" type="radio" value="unique" <?php checked('unique',$display); ?> /> Unique Names</label><br /></p>
        <p><strong>Email Address Filter (one per line):</strong></p>
        <textarea rows="4" cols="30" name="emails"><?php if(isset($_POST['emails'])){ echo trim($_POST['emails']); }?></textarea>
        <p><strong>Invert Email List? (Only show results NOT in the list)</strong>
            <input <?php checked(true, isset($_POST['invert']));?> name="invert" type="checkbox" value="true" />
        </p>
        <input type="submit" value="Submit" name="submit" />
    </fieldset>
</form>
<a href="#csv">Jump down to CSV sheet.</a> <?php print_results(); ?>
</body>
</html>
