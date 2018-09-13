<?php
/*
Extension Name: Team members module
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
			'crum_info_list_slider' => array(
				'name'          => esc_html__( 'Info List Slider', 'utouch' ),
				'title'         => esc_html__( 'Info List Slider', 'utouch' ),
				'icon'          => 'kc-utouch-icon kc-utouch-icon-info-list-slider',
				'category'      => esc_html__( 'Sliders', 'utouch' ),
				'wrapper_class' => 'clearfix',
				'params'        => array(
					'items'   => array(
						array(
							'type'        => 'group',
							'label'       => esc_html__( 'Slider items', 'utouch' ),
							'name'        => 'options',
							'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding slider element.', 'utouch' ),
							'options'     => array( 'add_text' => esc_html__( 'Add new slider item', 'utouch' ) ),
							'params'      => array(
								array(
									'type'        => 'text',
									'name'        => 'title',
									'label'       => esc_html__( 'Title', 'utouch' ),
									'value'       => '',
									'admin_label' => true
								),
								array(
									'type'  => 'textarea',
									'name'  => 'desc',
									'label' => esc_html__( 'Description', 'utouch' ),
								),

								array(
									'name'  => 'image',
									'label' => esc_html__( 'Image', 'utouch' ),
									'type'  => 'attach_image',
								),
							),
						),

					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens'                            => "any,1024,999,767,479",
									esc_html__( 'Navigation', 'utouch' ) => array(
										array(
											'property' => 'border-color',
											'label'    => esc_html__( 'Slide number border color', 'utouch' ),
											'selector' => '.slider-slides--round-text .number',
											'value'    => '#0069cc',
										),
										array(
											'property' => 'border-color',
											'label'    => esc_html__( 'Active slide number border color', 'utouch' ),
											'selector' => '.slider-slides--round-text .slides-item.slide-active .number',
											'value'    => '#7a2867',
										),
										array(
											'property' => 'background-color',
											'label'    => esc_html__( 'Color of lines between slides numbers', 'utouch' ),
											'selector' => '.slider-slides--round-text .slides-item:after',
											'value'    => '#0069cc',
										),
									),
									esc_html__( 'Typography', 'utouch' ) =>
										array(
											array(
												'property' => 'font-size',
												'label'    => esc_html__( 'Font Size', 'utouch' ),
											),
											array(
												'property' => 'font-family',
												'label'    => esc_html__( 'Font Family', 'utouch' ),
											),
										),

									esc_html__( 'Container', 'utouch' ) =>
										array(
											array(
												'property' => 'padding',
												'label'    => esc_html__( 'Padding', 'utouch' ),
											),
											array(
												'property' => 'margin',
												'label'    => esc_html__( 'Margin', 'utouch' ),
											),
										),
								)
							)
						)
					),
				)
			),
		)
	);
}