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
		array(
			'crum_accordion'     => array(
				'name'         => esc_html__( 'Accordion', 'utouch' ),
				'description'  => esc_html__( 'Collapsible content panels', 'utouch' ),
				'category'     => esc_html__( 'Content', 'utouch' ),
				'icon'         => 'kc-icon-accordion',
				'title'        => esc_html__( 'Accordion Settings', 'utouch' ),
				'is_container' => true,
				'live_editor'  => $live_tmpl . 'crum_accordion.tpl',
				'views'        => array(
					'type'     => 'views_sections',
					'sections' => 'crum_accordion_tab',
					'display'  => 'vertical'
				),
				'content'      => '[crum_accordion_tab title="' . esc_html__( 'Accordion Tab', 'utouch' ) . '"][/crum_accordion_tab]',
				'params'       => array(
					'general' => array(
						array(
							'type'     => 'toggle',
							'name'     => 'accordion',
							'value'       => false,
							'label'    => esc_html__( 'Accordion mode', 'utouch' ),
							'description'    => esc_html__( 'Collapse other when item opened', 'utouch' ),
						),
						array(
							'name'        => 'class',
							'label'       => esc_html__( 'Extra Class', 'utouch' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'utouch' )
						)
					),
					'style'   => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens' => "any,1024,999,767,479",
									'Header'  => array(
										array(
											'property' => 'font-family',
											'label'    => 'Text Font Family',
											'selector' => '.accordion-panel .accordion-heading'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Text Size',
											'selector' => '.accordion-panel .accordion-heading'
										),
										array(
											'property' => 'text-align',
											'label'    => 'Text Alignment',
											'selector' => '.panel-heading'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.accordion-panel .accordion-heading'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.accordion-panel .accordion-heading'
										),
										array(
											'property' => 'color',
											'label'    => 'Text Color',
											'selector' => '.accordion-panel .accordion-heading, .accordion .accordion-heading i'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Background Color',
											'selector' => '.accordion .accordion-panel'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.accordion .accordion-panel'
										),
									),
									'Body'    => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.panel-info'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.panel-info'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.panel-info'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.panel-info'
										),
										array(
											'property' => 'letter-spacing',
											'label'    => 'Letter Spacing',
											'selector' => '.panel-info'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.panel-info'
										),
									),


								)
							)
						)
					),
				),
			),
			'crum_accordion_tab' => array(
				'name'         => esc_html__( 'Accordion Tab', 'utouch' ),
				'category'     => '',
				'title'        => esc_html__( 'Accordion Tab Settings', 'utouch' ),
				'system_only'  => true,
				'is_container' => true,
				'live_editor'  => $live_tmpl . 'crum_accordion_tab.tpl',
				'accept_child' => 'kc_column_text',
				'params'       => array(
					'general' => array(
						array(
							'name'  => 'title',
							'label' => esc_html__( 'Title', 'utouch' ),
							'value' => esc_html__( 'New Accordion Tab', 'utouch' ),
							'type'  => 'text'
						),
						array(
							'name'        => 'open',
							'label'       => esc_html__( 'Show as open?', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Allow accordion tab opened', 'utouch' )
						),
						array(
							'name'  => 'class',
							'label' => 'Extra class name',
							'type'  => 'text',
						)
					),
				)
			),
		)
	);
}