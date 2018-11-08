<?php

/**
 * Deprecated functions.
 */

/**
 * Extra CSS class helper.
 *
 * @deprecated 5.0.5    Replaced with more clear name su_get_css_class().
 *
 * @param array   $atts Shortcode attributes.
 * @return string       String with CSS class name(s).
 */
function su_ecssc( $atts ) {
	return su_get_css_class( $atts );
}

/**
 * Shortcut for Su_Tools::decode_shortcode()
 *
 * @deprecated 5.0.5    Replaced with more clear name su_do_attribute().
 */
function su_scattr( $value ) {
	return Su_Tools::do_attr( $value );
}

/**
 * Shortcode names prefix in compatibility mode
 *
 * @deprecated 5.0.5    Replaced with more clear name su_get_shortcode_prefix().
 */
function su_compatibility_mode_prefix() {
	return su_get_shortcode_prefix();
}

/**
 * Shortcut for su_compatibility_mode_prefix()
 *
 * @deprecated 5.0.5    Replaced with more clear name su_get_shortcode_prefix().
 */
function su_cmpt() {
	return su_get_shortcode_prefix();
}

/**
 * Custom do_shortcode function for nested shortcodes
 *
 * @deprecated 5.0.5    Replaced with more clear name su_do_nested_shortcodes().
 *
 * @param string  $content Shortcode content
 * @param string  $pre     First shortcode letter
 *
 * @return string Formatted content
 */
function su_do_shortcode( $content, $pre ) {

	if ( strpos( $content, '[_' ) !== false ) {
		$content = preg_replace( '@(\[_*)_(' . $pre . '|/)@', "$1$2", $content );
	}

	return do_shortcode( $content );

}

/**
 * Shortcut for Su_Tools::get_icon()
 *
 * @deprecated 5.0.5    Replaced with more clear name su_html_icon().
 */
function su_get_icon( $args ) {
	return Su_Tools::get_icon( $args );
}
