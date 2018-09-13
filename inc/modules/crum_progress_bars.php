<?php
/*
Extension Name: Progress bars
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
			'crum_progress_bars' => array(
				'name'        => esc_html__( 'Progress Bar', 'utouch' ),
				'icon'        => 'kc-icon-progress',
				'category'    => esc_html__( 'Content', 'utouch' ),
				'live_editor' => $live_tmpl . 'crum_progress_bars.tpl',
				'params'      => array(
					'general' => array(
						array(
							'type'        => 'group',
							'label'       => esc_html__( 'Options', 'utouch' ),
							'name'        => 'options',
							'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding progressbar element.', 'utouch' ),
							'options'     => array( 'add_text' => esc_html__( 'Add new progress bar', 'utouch' ) ),
							'params'      => array(
								array(
									'type'        => 'text',
									'label'       => esc_html__( 'Label', 'utouch' ),
									'name'        => 'label',
									'description' => esc_html__( 'Enter text used as title of the bar.', 'utouch' ),
									'admin_label' => true,
								),
								array(
									'type'        => 'number_slider',
									'label'       => esc_html__( 'Value', 'utouch' ),
									'name'        => 'value',
									'description' => esc_html__( 'Enter targeted value of the bar (From 1 to 100).', 'utouch' ),
									'admin_label' => true,
									'options'     => array(
										'min' => 1,
										'max' => 100,
									),
									'value'       => '80'
								),
								array(
									'type'        => 'color_picker',
									'label'       => esc_html__( 'Progressbar Color', 'utouch' ),
									'name'        => 'prob_color',
									'description' => esc_html__( 'Customized progress bar color.', 'utouch' ) . esc_html__( 'More options you will find in Styling tab.', 'utouch' ),
								),
							),
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
							'type'    => 'css',
							'label'   => esc_html__( 'css', 'utouch' ),
							'name'    => 'custom_css',
							'options' => array(
								array(
									'screens'                                      => "any,1024,999,767,479",
									esc_html__( 'Element background', 'utouch' ) => array(
										array(
											'property' => 'background',
											'label'    => 'Background',
											'selector' => '.skills-item .skills-item-meter'
										),
									),
									esc_html__( 'Label', 'utouch' )              => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.skills-item .skills-item-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.skills-item .skills-item-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.skills-item .skills-item-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.skills-item .skills-item-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.skills-item .skills-item-title'
										),
									),
									esc_html__( 'Value', 'utouch' )              => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.skills-item .skills-item-count'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.skills-item .skills-item-count'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.skills-item .skills-item-count'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.skills-item .skills-item-count'
										),
									),

								)
							)
						),
					)
				)

			),
		)
	);
}