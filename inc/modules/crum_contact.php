<?php
/*
Extension Name: Icon with contact info
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
	// Buttons
		array(
			'crum_contact' => array(
				'name'          => esc_html__( 'Contact block', 'utouch' ),
				'description'   => esc_html__( 'Block used on contacts page for contacts.', 'utouch' ),
				'icon'          => 'kc-utouch-icon kc-utouch-icon-contact-block',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'Content', 'utouch' ),
				'params'        => array(
					'general' => array(

						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Address', 'utouch' ),
							'name'        => 'address',
							'admin_label' => true,
							'value'       => 'Country, Some City',
							'description' => esc_html__( 'Enter contat address', 'utouch' )
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Phone 1', 'utouch' ),
							'name'        => 'phone_1',
							'admin_label' => true,
							'value'       => '8 800 567.890.11',
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Phone 1 description', 'utouch' ),
							'name'        => 'phone_1_desc',
							'admin_label' => true,
							'value'       => 'Central Office',
						),

						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Phone 2', 'utouch' ),
							'name'        => 'phone_2',
							'admin_label' => true,
							'value'       => '8 800 567.890.11',
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Phone 2 description', 'utouch' ),
							'name'        => 'phone_2_desc',
							'admin_label' => true,
							'value'       => 'Central Office',
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Email', 'utouch' ),
							'name'        => 'email',
							'admin_label' => true,
							'value'       => 'support@utouch.com',
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Button Label', 'utouch' ),
							'description' => esc_html__( 'This is the text that appears on your button', 'utouch' ),
							'name'        => 'btn_label',
							'value'       => 'Text Button',
							'admin_label' => true,

						),
						array(
							'name'    => 'btn_color',
							'label'   => esc_html__( 'Color', 'utouch' ),
							'type'    => 'select', // or 'short-select'
							'attr'    => array( 'class' => 'colored-options' ),
							'options' => utouch_button_colors(),
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