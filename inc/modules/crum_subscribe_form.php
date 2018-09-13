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

$images_path = get_template_directory_uri() . '/images/admin/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_subscribe_form' => array(
				'name'     => esc_html__( 'Subscribe form', 'utouch' ),
				'icon'     => 'kc-utouch-icon kc-utouch-icon-subscribe',
				'category' => esc_html__( 'Content', 'utouch' ),
				'params'   => array(
					'general' => array(
                        array(
                            'name'  => 'use_shortcode',
                            'label' => esc_html__( 'Use shortcode', 'utouch' ),
                            'type'  => 'toggle',
                            'value' => 'no'
                        ),
                    array(
							'name'        => 'shortcode',
							'label'       => 'Custom shortcode',
							'type'        => 'textarea',  // USAGE TEXT TYPE
							'description' => 'Subscribe form shortcode or leave empty for default subscribe form',
                            'relation'    => array(
								'parent'    => 'use_shortcode',
								'show_when' => 'yes',
							),
						),
						array(
							'type'        => 'radio_image',
							'label'       => esc_html__( 'Select Template', 'utouch' ),
							'name'        => 'layout',
							'admin_label' => true,
							'options'     => array(
								'type_1' => $images_path . 'subscribe/option-1.png',
								'type_2' => $images_path . 'subscribe/option-2.png',
							),
							'value'       => 'type_1',
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Title', 'utouch' ),
							'name'        => 'title',
							'admin_label' => true,
							'value'       => '',
							'relation'    => array(
								'parent'    => 'layout',
								'show_when' => 'type_2',
							),
						),
						array(
							'type'        => 'textarea',
							'label'       => esc_html__( 'Description', 'utouch' ),
							'name'        => 'desc',
							'admin_label' => true,
							'value'       => '',
							'relation'    => array(
								'parent'    => 'layout',
								'show_when' => 'type_2',
							),
						),
						array(
							'name'     => 'image',
							'label'    => esc_html__( 'Main Image', 'utouch' ),
							'type'     => 'attach_image',
							'relation' => array(
								'parent'    => 'layout',
								'show_when' => 'type_2',
							),
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Name field placeholder', 'utouch' ),
							'name'        => 'name_placeholder',
							'admin_label' => true,
							'value'       => 'Your Name',
							'relation'    => array(
								'parent'    => 'use_shortcode',
								'hide_when' => 'yes',
							),
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Email field placeholder', 'utouch' ),
							'name'        => 'email_placeholder',
							'admin_label' => true,
							'value'       => 'Email Address',
                            'relation'    => array(
								'parent'    => 'use_shortcode',
								'hide_when' => 'yes',
							),
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Button label', 'utouch' ),
							'name'        => 'btn_label',
							'admin_label' => true,
							'value'       => 'Subscribe',
                            'relation'    => array(
								'parent'    => 'use_shortcode',
								'hide_when' => 'yes',
							),
						),
					),
					'styling' => array(

						array(
							'type'    => 'css',
							'label'   => esc_html__( 'css', 'utouch' ),
							'name'    => 'custom_css',
							'options' => array(
								array(
									'screens'                        => "any,1024,999,767,479",
									esc_html__( 'Button', 'utouch' ) => array(
										array(
											'property' => 'background-color',
											'label'    => 'Color button ',
											'selector' => '.subscr-btn'
										),
									),
									esc_html__( 'Box', 'utouch' )    => array(
										array( 'property' => 'margin', 'label' => 'Margin', 'selector' => 'ul' ),
										array( 'property' => 'padding', 'label' => 'Padding', 'selector' => 'ul' )
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