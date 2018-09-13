<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * CPT supports
 */
if (! function_exists('_crumina_action_fw_post_types_supports')){
	function _crumina_action_fw_post_types_supports() {
		add_post_type_support( 'fw-portfolio', array( 'comments') );
	}
}

add_action( 'init', '_crumina_action_fw_post_types_supports' );