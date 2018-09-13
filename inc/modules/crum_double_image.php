<?php
/*
Extension Name: Triple Image module
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
		array(
			'crum_double_image' => array(
				'name'     => esc_html__( 'Double images', 'utouch' ),
				'title'    => esc_html__( 'Double images presentation', 'utouch' ),
				'icon'     => 'kc-crum-icon kc-crum-icon-vertical-slider',
				'category' => esc_html__( 'Media', 'utouch' ),
				'params'   => array(
					'general' => array(
						array(
							'name'  => 'left_image',
							'label' => esc_html__( 'Right Image', 'utouch' ),
							'type'  => 'attach_image'
						),
						array(
							'name'  => 'right_image',
							'label' => esc_html__( 'Left Image', 'utouch' ),
							'type'  => 'attach_image'
						),
						array(
							'name'        => 'wrap_class',
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
									'screens'                                 => "any,1024,999,767,479",
									esc_html__( 'Element style', 'utouch' ) => array(
										array(
											'property' => 'box-shadow',
											'label'    => 'Box Shadow',
											'selector' => '.shadow-image'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => 'img'
										),
										array( 'property' => 'margin', 'label' => 'Margin' ),
										array( 'property' => 'padding', 'label' => 'Padding' )
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