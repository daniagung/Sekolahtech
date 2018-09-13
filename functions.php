<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
require_once get_template_directory() . '/inc/init.php';


require get_template_directory() . '/inc/classes/utouch-class-autoload.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


function utouch_admin_customizations( $hook ) {
	$my_theme = wp_get_theme();

	// Load admin panel customizations
	wp_enqueue_style( 'utouch-admin-custom', get_template_directory_uri() . '/css/admin.css', array(), $my_theme->get( 'Version' ) );
	// Icons
	wp_enqueue_style( 'seo-icons', get_template_directory_uri() . '/css/seo-icons.css', array(), $my_theme->get( 'Version' ) );

	wp_enqueue_script( 'utouch-admin-scripts', get_template_directory_uri() . '/js/admin-scripts.js', array( 'jquery' ), $my_theme->get( 'Version' ) );

	if ( $hook === 'profile.php' || $hook === 'user-edit.php' ) {
		wp_enqueue_script( 'reach-bio', get_theme_file_uri( '/js/bio.js' ), array( 'jquery' ), $my_theme->get( 'Version' ), true );
	}

}

add_action( 'admin_enqueue_scripts', 'utouch_admin_customizations', 10, 1 );