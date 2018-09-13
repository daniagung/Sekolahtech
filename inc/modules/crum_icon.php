<?php
/*
Extension Name: Icon with text
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
			'crum_icon' => array(
				'name'        => 'Icon',
				'description' => esc_html__( 'Display single icon', 'utouch' ),
				'icon'        => 'kc-icon-icon',
				'category'    => esc_html__( 'Content', 'utouch' ),
				'live_editor' => $live_tmpl . 'crum_icon.tpl',
				'params'      => array(
					'general' => array(
						array(
							'name'        => 'icon',
							'label'       => esc_html__( 'Select Icon', 'utouch' ),
							'value'       => 'et-layers',
							'description' => esc_html__( 'Choose an icon to display', 'utouch' ),
							'type'        => 'icon_picker',
							'admin_label' => true,
						),
						array(
							'name'        => 'title',
							'label'       => esc_html__( 'Title', 'utouch' ),
							'type'        => 'text',
							'admin_label' => true,
							'description' => esc_html__( 'Enter title (Note: It is located after icon).', 'utouch' )
						),
						array(
							'name'        => 'use_link',
							'label'       => 'Add Link ?',
							'type'        => 'toggle',
							'description' => esc_html__( 'Add a link for icon.', 'utouch' )
						),
						array(
							'type'        => 'link',
							'label'       => esc_html__( 'Link', 'utouch' ),
							'name'        => 'link',
							'description' => esc_html__( 'Add your relative URL. Each URL contains link, anchor text and target attributes.', 'utouch' ),
							'relation'    => array(
								'parent'    => 'use_link',
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
									"screens"                         => "any,1024,999,767,479",
									esc_html__( 'Icon', 'utouch' )  => array(
										array( 'property' => 'color', 'label' => 'Color', 'selector' => '.utouch-icon i' ),
										array(
											'property' => 'color',
											'label'    => 'Hover Color',
											'selector' => '+:hover .utouch-icon i'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Icon Size',
											'selector' => '.utouch-icon i'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.utouch-icon i'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Alignment',
											'selector' => '.utouch-icon'
										),
										array( 'property' => 'width', 'label' => 'Width', 'selector' => '.utouch-icon' ),
										array( 'property' => 'height', 'label' => 'Height', 'selector' => '.utouch-icon' ),
										array(
											'property' => 'padding',
											'label'    => 'Icon Padding',
											'selector' => '.utouch-icon'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Background',
											'selector' => '.utouch-icon'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border radius',
											'selector' => '.utouch-icon'
										)
									),
									esc_html__( 'Title', 'utouch' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.module-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.module-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.module-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.module-title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.module-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.module-title'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Alignment',
											'selector' => '.module-title'
										),
									),
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