<?php
/*
Extension Name: Buttons
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

$images_path = get_template_directory_uri() . '/images/admin/';
if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_image_gallery' => array(
				'name'     => esc_html__( 'Image gallery', 'utouch' ),
				'icon'     => 'kc-icon-image',
				'category' => esc_html__( 'Media', 'utouch' ),
				'params'   => array(
					'general' => array(
						array(
							'type'        => 'radio_image',
							'label'       => esc_html__( 'Select Template', 'utouch' ),
							'name'        => 'layout',
							'admin_label' => true,
							'options'     => array(
								'mansory' => $images_path . 'gallery/option-1.png',
								'rows' => $images_path . 'gallery/option-2.png',
							),
							'value'       => 'mansory'
						),
						array(
							'name' => 'cols_count',
							'label' => 'Columns count',

							'type' => 'number_slider',  // USAGE RADIO TYPE
							'options' => array(    // REQUIRED
								'min' => 1,
								'max' => 7,
							),

							'value' => '5', // remove this if you do not need a default content
						),
						array(
							'name' => 'images',
							'label' => 'Images',
							'type' => 'attach_images',  // USAGE ATTACH_IMAGE TYPE

						),
					),
					'styling' => array(

						array(
							'type'  => 'css',
							'label' => esc_html__( 'css', 'utouch' ),
							'name'  => 'custom_css',
						),
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