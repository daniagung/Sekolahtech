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

$live_tmpl   = get_template_directory() . '/kingcomposer/live_editor/';
$images_path = get_template_directory_uri() . '/images/admin/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_vertical_slider' => array(
				'name'         => esc_html__( 'Vertical slider', 'utouch' ),
				'title'        => esc_html__( 'Vertical slider', 'utouch' ),
				'icon'         => 'kc-crum-icon kc-crum-icon-vertical-slider',
				'category'     => esc_html__( 'Sliders', 'utouch' ),
				'nested'       => true,
				'accept_child' => 'kc_row_inner',
				'description'  => esc_html__( 'Slider with blocks scrolled vertically', 'utouch' ),
				'live_editor' => $live_tmpl . 'crum_vertical_slider.tpl',
				'params'       => array(
					array(
						'name'    => 'effect',
						'label'   => esc_html__( 'Slide effect', 'utouch' ),
						'type'    => 'select',
						'value'   => 'slide',
						'options' => array(
							'slide'     => esc_html__( 'Slide', 'utouch' ),
							'fade'      => esc_html__( 'Fade', 'utouch' ),
							'cube'      => esc_html__( 'Cube', 'utouch' ),
							'coverflow' => esc_html__( 'Coverflow', 'utouch' ),
							'flip'      => esc_html__( 'Flip', 'utouch' ),
						),
					),
					array(
						'name'        => 'loop',
						'label'       => esc_html__( 'Loop slides', 'utouch' ),
						'type'        => 'toggle',
						'description' => esc_html__( 'Enable continuous loop mode', 'utouch' ),
						'value'       => 'no',
					),
					array(
						'name'        => 'autoscroll',
						'label'       => esc_html__( 'Autoslide', 'utouch' ),
						'type'        => 'toggle',
						'description' => esc_html__( 'Automatic auto scroll slides', 'utouch' ),
						'value'       => 'no',
					),
					array(
						'name'     => 'time',
						'label'    => esc_html__( 'Delay between scroll', 'utouch' ),
						'type'     => 'number_slider',
						'options'  => array(
							'min'        => 1,
							'max'        => 30,
							'unit'       => 'sec',
							'show_input' => true
						),
						'value'    => '5',
						'relation' => array(
							'parent'    => 'autoscroll',
							'show_when' => 'yes'
						)
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