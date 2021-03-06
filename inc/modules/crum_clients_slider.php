<?php
/*
Extension Name: Portfolio Grid
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
			'crum_clients_slider' => array(
				'name'          => esc_html__( 'Clients Slider', 'utouch' ),
				'title'         => esc_html__( 'Clients Slider', 'utouch' ),
				'icon'          => 'kc-crum-icon kc-crum-icon-clients-slider',
				'category'      => esc_html__( 'Sliders', 'utouch' ),
				'wrapper_class' => 'clearfix',
				'description'   => esc_html__( 'Display Clients logos in a slider.', 'utouch' ),
				'params'        => array(
					'general' => array(
						array(
							'name'        => 'number_of_items',
							'label'       => esc_html__( 'Items per page', 'utouch' ),
							'type'        => 'number_slider',
							'options'     => array(
								'min'        => 1,
								'max'        => 10,
								'show_input' => true
							),
							'value'       => '4',
							'description' => 'Number of items displayed on one screen',
						),
						array(
							'name'        => 'arrows',
							'label'       => esc_html__( 'Show Arrows', 'utouch' ),
							'type'        => 'toggle',
							'value'       => 'yes',
							'description' => esc_html__( 'Previous/ Next Slider buttons', 'utouch' ),
						),
						array(
							'name'        => 'dots',
							'label'       => esc_html__( 'Show Dots', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Pagination dots', 'utouch' ),
							'value'       => 'no',
							'relation'    => array(
								'parent'    => 'arrows',
								'hide_when' => 'yes'
							)
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
							'type'        => 'text',
							'label'       => esc_html__( 'Custom class', 'utouch' ),
							'name'        => 'custom_class',
							'description' => esc_html__( 'Enter extra custom class', 'utouch' )
						)
					),
					'items'   => array(
						array(
							'type'        => 'group',
							'label'       => esc_html__( 'Slider items', 'utouch' ),
							'name'        => 'options',
							'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding slider element.', 'utouch' ),
							'options'     => array( 'add_text' => esc_html__( 'Add new slider item', 'utouch' ) ),
							'params'      => array(
								array(
									'name'  => 'image',
									'label' => esc_html__( 'Client logo', 'utouch' ),
									'type'  => 'attach_image',
								),
								array(
									'name'  => 'link',
									'label' => esc_html__( 'Custom Link', 'utouch' ),
									'type'  => 'link',
									'value' => '',
								),
							)
						),

					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									"screens"                               => "any,1024,999,767,479",
									esc_html__( 'Main params', 'utouch' ) => array(
										array(
											'property' => 'padding',
											'label'    => 'Padding',
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
										),
										array(
											'property' => 'background',
											'label'    => 'Background',
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
										),
									),
								),
							),
						),
					),
				)
			),
		)
	);
}