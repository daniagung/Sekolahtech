<?php
/*
Extension Name: Animated counters
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
			'crum_counter' => array(
				'name'        => esc_html__( 'Counter Box', 'utouch' ),
				'icon'        => 'kc-crum-icon kc-crum-icon-counter-box',
				'category'    => esc_html__( 'Content', 'utouch' ),
				'live_editor' => $live_tmpl . 'crum_counter.tpl',
				'params'      => array(
					'general' => array(


						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Targeted number', 'utouch' ),
							'name'        => 'number',
							'description' => esc_html__( 'The targeted number to count up to (From zero).', 'utouch' ),
							'admin_label' => true,
							'value'       => '100'
						),
						array(
							'type'        => 'text',
							'name'        => 'units',
							'label'       => esc_html__( 'Units', 'utouch' ),
							'description' => esc_html__( 'Type unit near counter numbers ( % , + , etc. )', 'utouch' )
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Label', 'utouch' ),
							'name'        => 'label',
							'description' => esc_html__( 'The text description of the counter.', 'utouch' ),
							'admin_label' => true,
							'value'       => 'Percent number'
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
									'screens'                             => "any,1024,999,767,479",
									esc_html__( 'Text', 'utouch' )      => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.counter-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.counter-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.counter-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.counter-title'
										),
									),
									esc_html__( 'Number', 'utouch' )    => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.counter-numbers'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.counter-numbers'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.counter-numbers'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.counter-numbers'
										),
									),
									esc_html__( 'Box Style', 'utouch' ) => array(
										array( 'property' => 'text-align', 'label' => 'Text Align' ),
										array( 'property' => 'padding', 'label' => 'Padding' ),
										array( 'property' => 'margin', 'label' => 'Margin' ),
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