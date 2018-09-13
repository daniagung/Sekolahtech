<?php
/*
Extension Name: Call To Action
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
			'crum_call_to_action' => array(
				'name'          => esc_html__( 'Call To Action', 'utouch' ),
				'title'         => esc_html__( 'Title, subtitle and button link', 'utouch' ),
				'icon'          => 'kc-crum-icon kc-crum-icon-call-to-action-v2',
				'category'      => esc_html__( 'Content', 'utouch' ),
				'wrapper_class' => 'clearfix',
				'description'   => esc_html__( 'Display call to action styles.', 'utouch' ),
				'params'        => array(
					'general' => array(
						array(
							'type'        => 'radio_image',
							'label'       => esc_html__( 'Select Template', 'utouch' ),
							'name'        => 'layout',
							'admin_label' => false,
							'options'     => array(
								'standard' => $images_path . 'call-to-action-2.png',
								'center'   => $images_path . 'call-to-action-1.png',
							),
							'value'       => 'standard'
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Title', 'utouch' ),
							'name'        => 'title',
							'admin_label' => true,
							'value'       => 'Tell Us About Your Project',
							'description' => esc_html__( 'Enter title for form.', 'utouch' )
						),
						array(
							'type'  => 'textarea',
							'name'  => 'desc',
							'label' => esc_html__( 'Description', 'utouch' ),
						),
						array(
							'type'        => 'toggle',
							'label'       => esc_html__( 'Show Button', 'utouch' ),
							'name'        => 'show_link',
							'description' => esc_html__( 'Display button in form.', 'utouch' ),
							'value'       => 'yes'
						),
						array(
							'type'        => 'link',
							'label'       => esc_html__( 'Button URL (Link)', 'utouch' ),
							'name'        => 'link',
							'description' => esc_html__( 'Add link to button.', 'utouch' ),
							'relation'    => array(
								'parent'    => 'show_link',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'btn_color',
							'label'    => esc_html__( 'Color', 'utouch' ),
							'type'     => 'select', // or 'short-select'
							'options'  => utouch_button_colors(),
							'relation' => array(
								'parent'    => 'link',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'btn_size',
							'type'     => 'radio',
							'value'    => 'medium',
							'label'    => esc_html__( 'Button size', 'utouch' ),
							'options'  => array(
								'small'  => esc_html__( 'Small', 'utouch' ),
								'medium' => esc_html__( 'Medium', 'utouch' ),
								'large'  => esc_html__( 'Large', 'utouch' ),
							),
							'inline'   => true,
							'relation' => array(
								'parent'    => 'link',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'outlined',
							'label'       => esc_html__( 'Outlined button', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Button with border and transparent background', 'utouch' ),
							'relation'    => array(
								'parent'    => 'link',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'custom_class',
							'label'       => esc_html__( 'Extra class', 'utouch' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'utouch' ),
						)
					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens'                             => "any,1024,999,767,479",
									esc_html__( 'Title', 'utouch' )     => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.heading-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.heading-title'
										),
									),
									esc_html__( 'Sub Title', 'utouch' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.heading-text'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.heading-text'
										),
									),
									'Button'                         => array(
										array(
											'property' => 'color',
											'label'    => 'Text Color',
											'selector' => '.btn'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Background Color',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Text Size',
											'selector' => '.btn'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.btn'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.btn'
										),
										array(
											'property' => 'letter-spacing',
											'label'    => 'Letter Spacing',
											'selector' => '.btn'
										),
										array( 'property' => 'border', 'label' => 'Border', 'selector' => '.btn' ),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.btn'
										),
									),
									esc_html__( 'Button Hover', 'utouch' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Text Color',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Background Color',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius Hover',
											'selector' => '.btn:hover'
										)
									)


								)
							)
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