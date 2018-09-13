<?php
/*
Extension Name: Styled UL list
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

$live_tmpl = get_template_directory() . '/kingcomposer/live_editor/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
	// Buttons
		array(
			'crum_ul_style' => array(
				'name'        => esc_html__( 'Styled UL list', 'utouch' ),
				'title'       => esc_html__( 'Styled UL list', 'utouch' ),
				'icon'        => 'kc-crum-icon kc-crum-icon-styled-list',
				'category'    => esc_html__( 'Content', 'utouch' ),
				'live_editor' => $live_tmpl . 'crum_ul_style.tpl',
				'params'      => array(
					'general' => array(
						array(
							'type'        => 'editor',
							'name'        => 'desc',
							'label'       => esc_html__( 'Text', 'utouch' ),
							'admin_label' => false,
						),
						array(
							'name'        => 'list_icon',
							'label'       => esc_html__( 'List icon', 'utouch' ),
							'type'        => 'radio',
							'options'     => array(
								'number'       => esc_html__( 'Number', 'utouch' ),
								'check'        => esc_html__( 'Check', 'utouch' ),
								'check_circle' => esc_html__( 'Check with circle', 'utouch' ),
								'custom'       => esc_html__( 'Custom', 'utouch' ),
							),
							'value'       => 'number',
							'description' => esc_html__( 'Icon will display before each list item', 'utouch' ),
						),
						array(
							'name'        => 'icon',
							'label'       => esc_html__( 'Select Icon', 'utouch' ),
							'type'        => 'icon_picker',
							'value'       => 'fa-leaf',
							'description' => esc_html__( 'Choose an icon to display', 'utouch' ),
							'relation'    => array(
								'parent'    => 'list_icon',
								'show_when' => 'custom'
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
									'screens'                      => "any,1024,999,767,479",
									esc_html__( 'Text', 'utouch' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => 'li'
										),
										array(
											'property' => 'color',
											'label'    => 'On Hover',
											'selector' => 'li:hover, li:hover a'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => 'li'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => 'li'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => 'li'
										),
									),
									esc_html__( 'Icon', 'utouch' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Color Icon ',
											'selector' => '.utouch-icon'
										),

										array(
											'property' => 'font-size',
											'label'    => 'Size Icon',
											'selector' => '.utouch-icon'
										),
									),
									esc_html__( 'Box', 'utouch' )  => array(
										array( 'property' => 'margin', 'label' => 'Margin',  ),
										array( 'property' => 'padding', 'label' => 'Padding',  )
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