<?php
/*
Extension Name: Info Box module
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
			'crum_info_box' => array(
				'name'          => esc_html__( 'Feature Box', 'utouch' ),
				'title'         => 'Feature Box Settings',
				'icon'          => 'kc-utouch-icon kc-utouch-icon-feature-box',
				'category'      => esc_html__( 'Content', 'utouch' ),
				'wrapper_class' => 'clearfix',
				'description'   => esc_html__( 'Display feature boxes styles.', 'utouch' ),
				'params'        => array(
					'general' => array(
						array(
							'type'        => 'radio_image',
							'label'       => esc_html__( 'Select Template', 'utouch' ),
							'name'        => 'layout',
							'admin_label' => true,
							'options'     => array(
								'classic'          => $images_path . 'info-box-4.png',
								'standard-hover'   => $images_path . 'info-box-2.png',
								'standard-nofloat' => $images_path . 'info-box-1.png',
							),
							'value'       => 'classic'
						),
						array(
							'type'        => 'text',
							'name'        => 'box_number',
							'label'       => esc_html__( 'Top label', 'utouch' ),
							'value'       => '',
							'admin_label' => true,
							'relation'    => array(
								'parent'    => 'layout',
								'show_when' => 'number',
							),
						),
						array(
							'type'        => 'text',
							'name'        => 'title',
							'label'       => esc_html__( 'Title', 'utouch' ),
							'value'       => 'Text Title',
							'admin_label' => true
						),
						array(
							'type'  => 'textarea',
							'name'  => 'desc',
							'label' => esc_html__( 'Description', 'utouch' ),
						),
						array(
							'type'        => 'select',
							'label'       => esc_html__( 'Picture type', 'utouch' ),
							'name'        => 'media',
							'admin_label' => true,
							'options'     => array(
								'icon'  => esc_html__( 'Icon', 'utouch' ),
								'image' => esc_html__( 'Image', 'utouch' )
							),
							'value'       => 'icon',
							'relation'    => array(
								'parent'    => 'layout',
								'hide_when' => 'number',
							),
						),
						array(
							'name'     => 'image',
							'label'    => esc_html__( 'Upload Image', 'utouch' ),
							'type'     => 'attach_image',
							'relation' => array(
								'parent'    => 'media',
								'show_when' => array( 'image', 'number' )
							),

						),
						array(
							'name'        => 'icon',
							'label'       => esc_html__( 'Select Icon', 'utouch' ),
							'type'        => 'icon_picker',
							'description' => esc_html__( 'Select icon display in box', 'utouch' ),
							'value'       => 'et-trophy',
							'relation'    => array(
								'parent'    => 'media',
								'hide_when' => array( 'image', 'number' )
							)
						),
						array(
							'name'  => 'show_link',
							'label' => esc_html__( 'Display Link', 'utouch' ),
							'type'  => 'toggle',
							'value' => 'no',

						),
						array(
							'name'     => 'link',
							'label'    => esc_html__( 'Link Button', 'utouch' ),
							'type'     => 'link',
							'value'    => '#',
							'relation' => array(
								'parent'    => 'show_link',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'link_button',
							'label'    => esc_html__( 'Display Link as button', 'utouch' ),
							'type'     => 'toggle',
							'value'    => 'no',
							'relation' => array(
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
								'parent'    => 'link_button',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'btn_size',
							'type'     => 'radio',
							'value'    => 'small',
							'label'    => esc_html__( 'Button size', 'utouch' ),
							'options'  => array(
								'small'  => esc_html__( 'Small', 'utouch' ),
								'medium' => esc_html__( 'Medium', 'utouch' ),
								'large'  => esc_html__( 'Large', 'utouch' ),
							),
							'inline'   => true,
							'relation' => array(
								'parent'    => 'link_button',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'outlined',
							'label'       => esc_html__( 'Outlined button', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Button with border and transparent background', 'utouch' ),
							'relation'    => array(
								'parent'    => 'link_button',
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
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens'                           => "any,1024,999,767,479",
									esc_html__( 'Title', 'utouch' )     => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.info-box-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.info-box-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.info-box-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.info-box-title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.info-box-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.info-box-title'
										),
									),
									esc_html__( 'Text', 'utouch' )      => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.info-box-text'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.info-box-text'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.info-box-text'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.info-box-text'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.info-box-text'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.info-box-text'
										),
									),
									esc_html__( 'Image', 'utouch' )     => array(
										array(
											'property' => 'width',
											'label'    => 'Width',
											'selector' => '.info-box-image img, .icon-small.info-box-image'
										),
										array(
											'property' => 'height',
											'label'    => 'Height',
											'selector' => '.info-box-image img, .icon-small.info-box-image'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Icon Size',
											'selector' => '.info-box-image i'
										),
										array(
											'property' => 'color',
											'label'    => 'Icon Color',
											'selector' => '.info-box-image i'
										),
										array(
											'property' => 'background',
											'label'    => 'Background',
											'selector' => '.info-box-image'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.info-box-image'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.info-box-image, .info-box-image img'
										),
									),
									esc_html__( 'Content', 'utouch' )   => array(
										array(
											'property' => 'background',
											'label'    => 'Background',
											'selector' => '.info-box-content'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.info-box-content'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.info-box-content'
										),
									),
									esc_html__( 'Box style', 'utouch' ) => array(
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