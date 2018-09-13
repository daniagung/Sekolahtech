<?php
/**
 * @package utouch-wp
 */

/**
 * Autoload function for utouch theme classes
 *
 * @param $class_name
 *
 * @return bool true if class found and false otherwise
 */
function utouch_class_autoload( $class_name ) {

	$class_name = strtolower( $class_name );

	// check if this utouch theme class.
	if ( false === strpos( $class_name, 'utouch' ) ) {
		return false;
	}

	// define class folder.
	if ( false !== strpos( $class_name, 'template' ) ) {
		$class_folder = '/inc/classes/templates/';
	} elseif ( false !== strpos( $class_name, 'helper' ) ) {
		$class_folder = '/inc/classes/helpers/';
	} elseif ( false !== strpos( $class_name, 'event' ) ) {
		$class_folder = '/inc/classes/events/';
	} elseif ( false !== strpos( $class_name, 'portfolio' ) ) {
		$class_folder = '/inc/classes/portfolio/';
	}else {
		$class_folder = '/inc/classes/';
	}

	// full path to class.
	$class_path = get_template_directory() . $class_folder . str_replace( '_', '-', $class_name ) . '.php';
	if ( file_exists( $class_path ) ) {
		require $class_path;

		return true;
	}

	return false;
}

spl_autoload_register( 'utouch_class_autoload', true, true );