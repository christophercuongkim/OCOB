<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */

global $myth_primary_layout_classes;

if ( ! defined( 'ABSPATH' ) ) exit;

$template = get_option('template');

switch( $template ) {

	// IF Polytechnic
	case 'polytechnic' : ?>
		<div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">
			<main id="main" class="site-main" role="main"> <?php;
		break;

}

?>