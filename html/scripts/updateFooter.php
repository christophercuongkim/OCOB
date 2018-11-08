<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

extract($_POST);
    if($secretKey == "LTh*Dtn0!8G43UN45NwUVN-")
    {
      file_put_contents("/var/www/www.cob.calpoly.edu/html/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area2.php", $area1) or die("Unable to open file!");
      file_put_contents("/var/www/www.cob.calpoly.edu/html/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area3.php", $area2) or die("Unable to open file!");
      file_put_contents("/var/www/www.cob.calpoly.edu/html/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area4.php", $area3) or die("Unable to open file!");
      file_put_contents("/var/www/www.cob.calpoly.edu/html/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area5.php", $area4) or die("Unable to open file!");
      header('Location: ' . $_SERVER['HTTP_REFERER']);

    }
    echo("Invalid Request");
?>