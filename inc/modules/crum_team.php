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
			'crum_team' => array(
				'name'          => esc_html__( 'Team member', 'utouch' ),
				'title'         => esc_html__( 'Team member', 'utouch' ),
				'icon'          => 'kc-icon-team',
				'category'      => esc_html__( 'Content', 'utouch' ),
				'wrapper_class' => 'clearfix',
				'description'   => esc_html__( 'Member photo with social links', 'utouch' ),
				'params'        => array(
					'general' => array(
						array(
							'type'        => 'radio_image',
							'label'       => esc_html__( 'Select Template', 'utouch' ),
							'name'        => 'layout',
							'admin_label' => true,
							'options'     => array(
								'style1' => $images_path . 'team-member/option-1.png',
								'style2' => $images_path . 'team-member/option-2.png',
								'style3' => $images_path . 'team-member/option-3.png',
								'style4' => $images_path . 'team-member/option-4.png',
							),
							'value'       => 'style1'
						),
						array(
							'name'        => 'image',
							'label'       => esc_html__( 'Avatar Image', 'utouch' ),
							'type'        => 'attach_image',
							'admin_label' => true,
						),
						array(
							'type'        => 'text',
							'name'        => 'title',
							'label'       => esc_html__( 'Name', 'utouch' ),
							'value'       => 'Your Name',
							'admin_label' => true
						),
						array(
							'name'  => 'subtitle',
							'label' => esc_html__( 'Position', 'utouch' ),
							'type'  => 'text',
							'value' => 'Manager'
						),
						array(
							'name'  => 'desc',
							'label' => esc_html__( 'Description', 'utouch' ),
							'type'  => 'textarea    ',
							'value' => ''
						),
						array(
							'name'     => 'email',
							'label'    => esc_html__( 'Email', 'utouch' ),
							'type'     => 'text',
							'value'    => '',
							'relation' => array(
								'parent'    => 'layout',
								'show_when' => 'style2',
							),
						),

						array(
							'name'  => 'link',
							'label' => esc_html__( 'Custom Link', 'utouch' ),
							'type'  => 'link',
							'value' => '',
						),
						array(
							'name'        => 'social_class',
							'label'       => 'Social icons type',
							'type'        => 'select',
							'options'     => array(
								'icons' => esc_html__( 'Just icons', 'utouch' ),
								'hover' => esc_html__( 'Color on Hover', 'utouch' ),
								'bg'    => esc_html__( 'Color background', 'utouch' ),
							),
							'value'       => 'icons',
							'description' => esc_html__( 'Designates the ascending or descending order of items', 'utouch' ),
						),
						array(
							'type'        => 'group',
							'label'       => esc_html__( 'Social networks', 'utouch' ),
							'name'        => 'social_networks',
							'description' => esc_html__( 'Links for your social networks profiles', 'utouch' ),
							'options'     => array( 'add_text' => esc_html__( 'Add social network', 'utouch' ) ),
							'params'      => array(
								array(
									'type'  => 'text',
									'label' => esc_html__( 'Link to profile', 'utouch' ),
									'name'  => 'link',
								),
								array(
									'name'        => 'icon',
									'label'       => esc_html__( 'Select Icon', 'utouch' ),
									'type'        => 'select',
									'options'     => utouch_social_network_icons(),
									'description' => esc_html__( 'Choose an icon to display', 'utouch' ),
								)
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
									'screens'                       => "any,1024,999,767,479",
									esc_html__( 'Image', 'utouch' ) => array(
										array(
											'property' => 'box-shadow',
											'label'    => 'Box Shadow',
											'selector' => '.module-image'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.module-image'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.module-image, .module-image img'
										),
										array(
											'property' => 'width',
											'label'    => 'Width',
											'selector' => '.module-image'
										),
										array(
											'property' => 'height',
											'label'    => 'Height',
											'selector' => '.module-image'
										),
										array(
											'property' => 'margin',
											'label'    => 'Margin',
											'selector' => '.module-image'
										),
										array(
											'property' => 'padding',
											'label'    => 'Padding',
											'selector' => '.module-image'
										)
									),
									esc_html__( 'Title', 'utouch' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.teammembers-item-name'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.teammembers-item-name'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.teammembers-item-name'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.teammembers-item-name'
										),

									),
									esc_html__( 'Text', 'utouch' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.teammembers-item-prof'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.teammembers-item-prof'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.teammembers-item-prof'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.teammembers-item-prof'
										),
									),
									esc_html__( 'Box', 'utouch' )   => array(
										array( 'property' => 'box-shadow', 'label' => 'Box Shadow' ),
										array( 'property' => 'border', 'label' => 'Border' ),
										array( 'property' => 'border-radius', 'label' => 'Border Radius' ),
										array( 'property' => 'margin', 'label' => 'Margin' ),
										array( 'property' => 'padding', 'label' => 'Padding' )
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