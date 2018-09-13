<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
if (!function_exists('utouch_modify_es_widget_scripts')){
	function utouch_modify_es_widget_scripts(){

		wp_dequeue_style('es-widget-css');

	}
}
add_action('wp_enqueue_scripts','utouch_modify_es_widget_scripts');