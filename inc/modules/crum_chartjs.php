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

$live_tmpl   = get_template_directory() . '/kingcomposer/live_editor/';
$images_path = get_template_directory_uri() . '/images/admin/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
	// Buttons
		array(
			'crum_chartjs' => array(
				'name'        => esc_html__( 'Chart JS module', 'utouch' ),
				'icon'        => 'kc-icon-pie',
				'category'    => esc_html__( 'Content', 'utouch' ),
				'live_editor' => $live_tmpl . 'crum_chartjs.tpl',
				'assets'      =>
					array(
						'scripts' =>
							array(
								'chart-js' => '', // Leave empty to call built-in assets
							),
					),
				'params'      => array(
					'general' => array(
						array(
							'name'        => 'chart_type',
							'label'       => esc_html__( 'Chart type', 'utouch' ),
							'type'        => 'radio_image',
							'description' => '',
							'options'     => array(
								'doughnut'  => $images_path . 'doughnut-chart.png',
								'pie'       => $images_path . 'pie-chart.png',
								'line'      => $images_path . 'line-chart.png',
								'radar'     => $images_path . 'radar-chart.png',
								'bar'       => $images_path . 'bar-chart.png',
								'polarArea' => $images_path . 'polar-area-chart.png',
							)
						),
						array(
							'name'        => 'hide_labels',
							'label'       => esc_html__( 'Hide Labels ?', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Hide chart legend labels', 'utouch' )
						),
						array(
							'type'    => 'group',
							'label'   => esc_html__( 'Chart options', 'utouch' ),
							'name'    => 'options',
							'options' => array( 'add_text' => esc_html__( 'Add new data', 'utouch' ) ),
							'params'  => array(
								array(
									'type'        => 'text',
									'label'       => esc_html__( 'Label', 'utouch' ),
									'name'        => 'label',
									'description' => esc_html__( 'Enter text used as title of the bar.', 'utouch' ),
									'admin_label' => true,
								),
								array(
									'type'        => 'crum-number',
									'label'       => esc_html__( 'Value', 'utouch' ),
									'name'        => 'value',
									'description' => esc_html__( 'Enter targeted value', 'utouch' ),
									'admin_label' => true,
									'options'     => array(
										'min' => 1,
										'max' => 100,
									),
									'value'       => '80'
								),
								array(
									'type'        => 'color_picker',
									'label'       => esc_html__( 'Color', 'utouch' ),
									'name'        => 'prob_color',
									'description' => esc_html__( 'Customized color.', 'utouch' ),
								),
							),
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Wrapper class name', 'utouch' ),
							'name'        => 'wrap_class',
							'description' => esc_html__( 'Custom class for wrapper of the shortcode widget.', 'utouch' ),
						)
					),
					'styling' => array(
						esc_html__( 'Text', 'utouch' ) => array(
							array(
								'property' => 'color',
								'label'    => 'Color',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
							array(
								'property' => 'font-family',
								'label'    => 'Font Family',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
							array(
								'property' => 'font-size',
								'label'    => 'Font Size',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
							array(
								'property' => 'font-weight',
								'label'    => 'Font Weight',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
							array(
								'property' => 'line-height',
								'label'    => 'Line Height',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
							array(
								'property' => 'text-transform',
								'label'    => 'Text Transform',
								'selector' => '.points-item-count, .points-item-count .c-gray'
							),
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