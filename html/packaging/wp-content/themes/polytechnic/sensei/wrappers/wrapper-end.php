<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$template = get_option('template');

switch( $template ) {

	// IF Polytechnic
	case 'polytechnic' :
	?>
			</div>
		</main>
		<?php include ( get_template_directory() . "/sidebar.php"); ?>
		<?php include ( get_template_directory() . "/footer.php"); ?>
	<?php
		break;

}

?>