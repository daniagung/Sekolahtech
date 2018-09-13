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
if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
	// Buttons
		array(
			'crum_colored_info' => array(
				'name'          => esc_html__( 'Info list', 'utouch' ),
				'description'   => esc_html__( 'Info list', 'utouch' ),
				'icon'          => 'kc-utouch-icon kc-utouch-icon-info-list',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'Content', 'utouch' ),
				'params'        => array(
					'general' => array(
						array(
							'type'        => 'group',
							'label'       => __( 'Info boxes', 'utouch' ),
							'name'        => 'boxes',
							'description' => '',
							'options'     => array( 'add_text' => __( 'Add new box', 'utouch' ) ),
							'params'      => array(
								array(
									'name'  => 'title',
									'label' => __( 'Title', 'utouch' ),
									'type'  => 'text',
								),
								array(
									'name'  => 'desc',
									'label' => __( 'Description', 'utouch' ),
									'type'  => 'textarea',
								),
								array(
									'name'  => 'link',
									'label' => __( 'Link', 'utouch' ),
									'type'  => 'link',
									'value' => '#',
								),
								array(
									'name'  => 'color',
									'label' => __( 'Background color', 'utouch' ),
									'type'  => 'color_picker',
									'value' => '#0083ff'
								),
							)
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Custom class', 'utouch' ),
							'name'        => 'custom_class',
							'description' => esc_html__( 'Enter extra custom class', 'utouch' )
						)
					),
					'styling' => array(
						array(
							'name' => 'css_custom',
							'type' => 'css',
						)
					),
					'animate' => array(
						array(
							'name' => 'animate',
							'type' => 'animate'
						)
					),
				),
			),
		)
	);
}