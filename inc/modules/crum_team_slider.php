<?php
/*
Extension Name: Vertical slider
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
			'crum_team_slider' => array(
				'name'         => esc_html__( 'Crum team slider', 'utouch' ),
				'title'        => esc_html__( 'Crum team slider', 'utouch' ),
				'icon'         => 'kc-utouch-icon kc-utouch-icon-team-slider',
				'category'     => esc_html__( 'Sliders', 'utouch' ),
				'nested'       => true,
				'accept_child' => 'crum_team_slider_tab',
				'description'  => esc_html__( 'Slider with blocks scrolled horizontally', 'utouch' ),
				'params'       => array(
					array(
						'type'        => 'radio_image',
						'label'       => esc_html__( 'Select Template', 'utouch' ),
						'name'        => 'layout',
						'admin_label' => false,
						'options'     => array(
							'style1' => $images_path . 'team-member-slider/option-1.png',
							'style2' => $images_path . 'team-member-slider/option-2.png',
							'style3' => $images_path . 'team-member-slider/option-3.png',
							'style4' => $images_path . 'team-member-slider/option-4.png',
						),
						'value'       => 'style1'
					),
					array(
						'name'  => 'social_class',
						'label' => 'Social icons type',
						'type'    => 'select',
						'options' => array(
							'icons'  => esc_html__( 'Just icons', 'utouch' ),
							'hover' => esc_html__( 'Color on Hover', 'utouch' ),
							'bg' => esc_html__( 'Color background', 'utouch' ),
						),
						'value'       => 'icons',
						'description' => esc_html__( 'Designates the ascending or descending order of items', 'utouch' ),
					),
					array(
						'type'        => 'toggle',
						'label'       => esc_html__( 'Arrows', 'utouch' ),
						'name'        => 'arrows',
						'description' => esc_html__( 'Show the navigation arrows.', 'utouch' ),
						'value'       => 'yes',
						'relation'    => array(
							'parent'    => 'type',
							'show_when' => 'type_2',
						),
					),
					array(
						'name'        => 'el_class',
						'label'       => esc_html__( 'Extra class', 'utouch' ),
						'type'        => 'text',
						'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'utouch' ),
					),
				)
			),
		)
	);
}