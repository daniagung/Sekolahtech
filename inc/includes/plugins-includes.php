<?php
/*
  * FIle for include classes and functions for extending
  * Plugins functionality when tat plugins are installed
  */

if ( is_admin() ) {
	$not_show_on_pages = array( 'crum_auto_setup' );
	$page              = array_key_exists( 'page', $_REQUEST ) ? $_REQUEST['page'] : '';

	if ( ! in_array( $page, $not_show_on_pages ) ) {
		$file_path = locate_template( 'TGM-Plugin-Activation/class-tgm-plugin-activation.php' );
		load_template( $file_path );
	}
}

function _action_utouch_register_required_plugins() {
	if ( class_exists( 'TGM_Plugin_Activation' ) ) {
		tgmpa( array(
			array(
				'name'         => esc_html__( 'Unyson', 'utouch' ),
				'slug'         => 'unyson',
				'source'       => 'http://up.crumina.net/plugins/unyson.zip', // The plugin source
				'version'      => '2.11.1',
				'is_automatic' => true,
				'required'     => true,
			),
			array(
				'name'         => esc_attr__( 'King Composer', 'utouch' ),
				'slug'         => 'kingcomposer',
				'required'     => true,
			),
			array(
				'name'         => esc_attr__( 'Frontend Editor', 'utouch' ),
				'slug'         => 'kc_pro',
				'source'       => 'http://kingcomposer.com/downloads/kc_pro.zip', // The plugin source
				'required'     => true,
			),
			array(
				'name'         => esc_html__( 'Email Subscribers', 'utouch' ),
				'slug'         => 'email-subscribers',
				'required'     => false,
			),
			array(
				'name'         => esc_attr__( 'Media category management', 'utouch' ),
				'slug'         => 'wp-media-category-management',
				'required'     => false,
			),
		) );
	}
}


add_action( 'tgmpa_register', '_action_utouch_register_required_plugins' );


if ( class_exists( 'WooCommerce' ) ) {
	$file_path = locate_template( 'inc/plugins-extend/woocommerce.php' );
	load_template( $file_path );
}
if ( class_exists( 'Easy_Digital_Downloads' ) ) {
	$file_path = locate_template( 'inc/plugins-extend/easydigitaldownloads.php' );
	load_template( $file_path );
}
if ( class_exists( 'GW_GoPricing' ) && is_admin() ) {
	$file_path = locate_template( 'inc/plugins-extend/go-pricing.php' );
	load_template( $file_path );
}
if ( class_exists( 'KingComposer' ) ) {
	$file_path = locate_template( 'inc/plugins-extend/kingcomposer.php' );
	load_template( $file_path );
}
if ( class_exists( 'WPCF7' ) ) {
	$file_path = locate_template( 'inc/plugins-extend/contact-form-7.php' );
	load_template( $file_path );
}

if (  class_exists('es_cls_widget')  ) {
	$file_path = locate_template( 'inc/plugins-extend/email-subscribers.php' );
	load_template( $file_path );
}


//theme activate
load_template( get_template_directory().'/inc/includes/auto-setup/class-fw-auto-install.php', true );
