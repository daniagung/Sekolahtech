<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/**
 * Set up the content width value based on the theme's design.
 *
 * @see _action_utouch_content_width()
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750;
}


function utouch_adjust_content_width() {
	global $content_width;

	if ( is_home() || is_archive() ) {
		$content_width = 568;
	} elseif ( is_page() ) {
		$content_width = 1170;
	}
}
add_action( 'template_redirect', 'utouch_adjust_content_width' );