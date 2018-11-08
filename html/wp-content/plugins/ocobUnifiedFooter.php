<?php
    /*
    Plugin Name: OCOB Unified Footer
    Plugin URI: https://cob.calpoly.edu/
    Version: 0.99
    Author: Alexander
    */
    
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

	add_action( 'admin_menu', 'ocobUnifiedFooterMenu' );

	function ocobUnifiedFooterMenu() {
		add_options_page( 'OCOB Unified Footer', 'OCOB Unified Footer', 'manage_options', 'ocobunifiedfooter', 'ocobUnifiedFooterOption' );
	}

	function ocobUnifiedFooterOption() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		$area2 = file_get_contents(get_home_path() . "/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area2.php", true);
		$area3 = file_get_contents(get_home_path() . "/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area3.php", true);
		$area4 = file_get_contents(get_home_path() . "/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area4.php", true);
		$area5 = file_get_contents(get_home_path() . "/wp-content/themes/CalPolyOCOB2012/FooterFiles/Area5.php", true);
	?>
		<form action="/scripts/updateFooter.php" method="post">
			<br><h1>OCOB Unified Footer Setting</h1><br>
			<h2>Footer Area 2</h2>
			<textarea id ="area1" name="area1" rows="12" cols="120"><?php echo $area2; ?></textarea>
			<h2 style="padding-top: 25px">Footer Area 3</h2>
			<textarea id = "area2" name ="area2" rows="12" cols="120"><?php echo $area3; ?></textarea>
			<h2 style="padding-top: 25px">Footer Area 4</h2>
			<textarea id="area3" name="area3" rows="12" cols="120"><?php echo $area4; ?></textarea>
			<h2 style="padding-top: 25px">Footer Area 5</h2>
			<textarea id="area4" name="area4" rows="12" cols="120"><?php echo $area5; ?></textarea>
			<input type="hidden" id="secretKey" name="secretKey" value="LTh*Dtn0!8G43UN45NwUVN-">
			<br><br><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"><br>
		</form>
<?php	}?>