<?php
/*
Extension Name: Icon with contact info
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


if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
	// Buttons
		array(
			'crum_clients' => array(
				'name'          => esc_html__( 'Client', 'utouch' ),
				'description'   => esc_html__( 'Block with client image and link', 'utouch' ),
				'icon'          => 'kc-utouch-icon kc-utouch-icon-clients',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'Content', 'utouch' ),
				'params'        => array(
					'general' => array(
						array(
							'type' => 'text',
							'name' => 'height',
							'label' => 'Images height',
							'value' => '',
						),
						array(
							'type' => 'text',
							'name' => 'width',
							'label' => 'Images width',
							'value' => '',
						),
						array(
							'name' => 'client_image',
							'label' => 'Image',

							'type' => 'attach_image',  // USAGE ATTACH_IMAGE TYPE
						),
						array(
							'name' => 'client_hover_image',
							'label' => 'Hover image',

							'type' => 'attach_image',  // USAGE ATTACH_IMAGE TYPE
						),
						array(
							'name' => 'link',
							'label' => 'Client link',
							'type' => 'link',
							'value' => '#', // remove this if you do not need a default content
						)
					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens'                        => "any,1024,999,767,479",

									esc_html__( 'Icon', 'utouch' ) => array(

										array(
											'property' => 'font-size',
											'label'    => 'Size Icon',
											'selector' => 'li i'
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
							'name'    => 'animate',
							'type'    => 'animate'
						)
					),
				)
			),
		)
	);
}