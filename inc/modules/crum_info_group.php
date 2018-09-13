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

$images_path = get_template_directory_uri() . '/images/admin/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_info_group' => array(
				'name'          => esc_html__( 'Info Box Group', 'utouch' ),
				'title'         => 'Info box group settings',
				'icon'          => 'kc-utouch-icon kc-utouch-icon-info-group',
				'category'      => esc_html__( 'Content', 'utouch' ),
				'wrapper_class' => 'clearfix',
				'description'   => esc_html__( 'Display feature boxes styles.', 'utouch' ),
				'params'        => array(
					'general' => array(
						array(
							'name' => 'image',
							'label' => 'Middle image',
							'type' => 'attach_image',
						),
					),
					'items'   => array(
						array(
							'type'        => 'group',
							'label'       => esc_html__( 'Info box item', 'utouch' ),
							'name'        => 'options',
							'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding slider element.', 'utouch' ),
							'options'     => array( 'add_text' => esc_html__( 'Add new slider item', 'utouch' ) ),
							'params'      => array(
								array(
									'name'  => 'image',
									'label' => esc_html__( 'Info box icon', 'utouch' ),
									'type'  => 'attach_image',
								),
								array(
									'name' => 'title',
									'label' => 'Title',
									'type' => 'text',  // USAGE TEXT TYPE
								),
								array(
									'name' => 'desc',
									'label' => 'Description',
									'type' => 'textarea',  // USAGE TEXT TYPE
								)

							)
						),

					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens'                      => "any,1024,999,767,479",

									esc_html__( 'Item image', 'utouch' ) => array(
										array(
											'property' => 'width',
											'label'    => 'Item image width',
											'selector' => '.info-box-image img',
											'value' => '50',
										),
										array(
											'property' => 'height',
											'label'    => 'Item image height',
											'selector' => '.info-box-image img',
											'value' => '50',
										),
									),
									esc_html__( 'Box', 'utouch' )  => array(
										array( 'property' => 'margin', 'label' => 'Margin', 'selector' => 'ul' ),
										array( 'property' => 'padding', 'label' => 'Padding', 'selector' => 'ul' )
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