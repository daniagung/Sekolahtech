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
			'crum_button' => array(
				'name'        => esc_html__( 'Button', 'utouch' ),
				'icon'        => 'kc-icon-button',
				'category'    => esc_html__( 'Content', 'utouch' ),
				'live_editor' => $live_tmpl . 'crum_button.tpl',
				'params'      => array(
					'general' => array(
						array(
							'name'  => 'type',
							'label' => 'Button type',

							'type'    => 'select',  // USAGE SELECT TYPE
							'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
								'regular'     => 'Regular',
								'app-store'   => 'App store',
								'google-play' => 'Google play',
							),

							'value' => 'regular', // remove this if you do not need a default content
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Label', 'utouch' ),
							'description' => esc_html__( 'This is the text that appears on your button', 'utouch' ),
							'name'        => 'label',
							'value'       => 'Text Button',
							'admin_label' => true,
							'relation'    => array(
								'parent'    => 'type',
								'show_when' => 'regular'
							),
						),
						array(
							'type'        => 'link',
							'label'       => esc_html__( 'Link', 'utouch' ),
							'name'        => 'link',
							'value'       => '#',
							'description' => esc_html__( 'Add your relative URL. Each URL contains link, anchor text and target attributes.', 'utouch' ),
						),
						array(
							'type'     => 'toggle',
							'name'     => 'show_icon',
							'label'    => esc_html__( 'Show Icon?', 'utouch' ),
							'relation' => array(
								'parent'    => 'type',
								'show_when' => 'regular'
							),
						),
						array(
							'type'        => 'icon_picker',
							'name'        => 'icon',
							'label'       => esc_html__( 'Icon', 'utouch' ),
							'value'       => 'fa-leaf',
							'description' => esc_html__( 'Select icon for button', 'utouch' ),
							'relation'    => array(
								'parent'    => 'show_icon',
								'show_when' => 'yes'
							)
						),
						array(
							'type'  => 'dropdown',
							'name'  => 'icon_position',
							'label' => esc_html__( 'Icon position', 'utouch' ),

							'value'    => 'left',
							'options'  => array(
								'left'  => esc_html__( 'Left', 'utouch' ),
								'right' => esc_html__( 'Right', 'utouch' ),
							),
							'relation' => array(
								'parent'    => 'show_icon',
								'show_when' => 'yes'
							)
						),
						array(
							'type'        => 'radio',
							'name'        => 'align',
							'label'       => esc_html__( 'Horizontal align', 'utouch' ),
							'description' => esc_html__( 'The horizontal alignment of elements', 'utouch' ),
							'options'     => array(
								'none'         => esc_html__( 'Inline', 'utouch' ),
								'align-left'   => esc_html__( 'Left', 'utouch' ),
								'align-center' => esc_html__( 'Centered', 'utouch' ),
								'align-right'  => esc_html__( 'Right', 'utouch' ),
							),
							'value'       => 'none'
						),
						array(
							'name'        => 'ex_class',
							'label'       => esc_html__( 'Button extra class', 'utouch' ),
							'type'        => 'text',
							'description' => esc_html__( 'Add class name for a tag.', 'utouch' )
						),
						array(
							'name'        => 'element_id',
							'label'       => esc_html__( 'Button ID attribute', 'utouch' ),
							'type'        => 'text',
							'description' => esc_html__( 'Only latin charters must be used', 'utouch' )
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'On Click', 'utouch' ),
							'name'        => 'onclick',
							'description' => esc_html__( 'Content of on click attribute for element.', 'utouch' ),
							'value'       => '',
						),
						array(
							'name'        => 'el_class',
							'label'       => esc_html__( 'Extra class', 'utouch' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'utouch' ),
						)
					),
					'styling' => array(
						array(
							'name'     => 'color',
							'label'    => esc_html__( 'Color', 'utouch' ),
							'type'     => 'select', // or 'short-select'
							'attr'     => array( 'class' => 'colored-options' ),
							'options'  => utouch_button_colors(),
							'relation' => array(
								'parent'    => 'type',
								'show_when' => false
							),
						),
						array(
							'name'    => 'size',
							'type'    => 'radio',
							'value'   => 'medium',
							'label'   => esc_html__( 'Button size', 'utouch' ),
							'options' => array(
								'small'  => esc_html__( 'Small', 'utouch' ),
								'medium' => esc_html__( 'Medium', 'utouch' ),
								'large'  => esc_html__( 'Large', 'utouch' ),
							),
							'inline'  => true,
						),
						array(
							'name'        => 'outlined',
							'label'       => esc_html__( 'Outlined button', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Button with border and transparent background', 'utouch' ),
						),
						array(
							'name'        => 'shadow',
							'label'       => esc_html__( 'Drop shadow', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Buttons shadow effect on hover', 'utouch' ),
						),
						array(
							'type'    => 'css',
							'label'   => esc_html__( 'css', 'utouch' ),
							'name'    => 'custom_css',
							'options' => array(
								array(
									'screens'                       => "any,1024,999,767,479",
									'Style'                         => array(
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
									esc_html__( 'Icon', 'utouch' )  => array(
										array(
											'property' => 'font-size',
											'label'    => 'Icon Size',
											'selector' => '.btn i'
										),
										array(
											'property' => 'padding',
											'label'    => 'Icon Spacing',
											'selector' => '.btn i'
										)
									),
									esc_html__( 'Hover', 'utouch' ) => array(
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