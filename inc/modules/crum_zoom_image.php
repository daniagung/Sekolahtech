<?php
/*
Extension Name: Image module
Extension Preview: -
Description:
Version: 1.0
Author: Crumina
Author URI: https://wpcode.pro/
*/

if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}

$live_tmpl   = get_template_directory() . '/kingcomposer/live_editor/';
$images_path = get_template_directory_uri() . '/images/admin/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_zoom_image' => array(
				'name'             => esc_html__( 'Zoom image', 'utouch' ),
				'title'            => esc_html__( 'Zoom image', 'utouch' ),
				'icon'             => 'kc-utouch-icon kc-utouch-icon-zoom',
				'category'         => esc_html__( 'Media', 'utouch' ),
				'preview_editable' => true,
				'params'           => array(
					'general' => array(

						array(
							'name'        => 'bg_image',
							'label'       => esc_html__( 'Background Image', 'utouch' ),
							'type'        => 'attach_image',
							'admin_label' => true,
						),
						array(
							'name'        => 'zoom_image',
							'label'       => esc_html__( 'Zoom Image', 'utouch' ),
							'type'        => 'attach_image',
							'admin_label' => true,
						),

					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
						)
					),
					'animate' => array(
						array(
							'name' => 'animate',
							'type' => 'animate'
						)
					),
				)
			),
		)
	);
}