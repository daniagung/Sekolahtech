<?php
/*
Extension Name: Pricing table
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
			'pricing_table' => array(
				'name'         => esc_html__( 'Pricing table', 'utouch' ),
				'title'        => esc_html__( 'Pricing table Wrapper', 'utouch' ),
				'icon'         => 'kc-icon-pricing',
				'category'     => esc_html__( 'Content', 'utouch' ),
				'nested'       => true,
				'accept_child' => 'pricing_box',
				'description'  => esc_html__( 'Visually merge elements into one section', 'utouch' ),
				'params'       => array(
					array(
						'name' => 'pricing_variants',
						'label' => 'Allow show annually / monthly prices',
						'type' => 'toggle',
						'description' => 'Show pricing variants for plan'
					),
					array(
						'name' => 'default_price',
						'label' => 'Default price',
						'type' => 'radio',  // USAGE RADIO TYPE
						'options' => array(    // REQUIRED
							'month' => 'Monthly',
							'year' => 'Annually',
						),
						'value' => 'month', // remove this if you do not need a default content
						'description' => 'Choose what prices show as default',
					),
					array(
						'name' => 'pricing_title',
						'label' => 'Pricing title',
						'type' => 'text',  // USAGE TEXT TYPE
						'description' => 'Pricing table title. Leave empty for not title.',
					),
					array(
						'name' => 'pricing_subtitle',
						'label' => 'Pricing subtitle',
						'type' => 'text',  // USAGE TEXT TYPE
						'description' => 'Pricing table subtitle. Leave empty for not subtitle.',
					),
					array(
						'name' => 'pricing_desc',
						'label' => 'Pricing description',
						'type' => 'textarea',  // USAGE TEXT TYPE
						'description' => 'Pricing table description. Leave empty for not description.',
					),
					array(
						'name'    => 'columns',
						'label'   => esc_html__( 'Number of columns', 'utouch' ),
						'type'    => 'number_slider',
						'options' => array(
							'min'        => 1,
							'max'        => 6,
							'show_input' => true
						),
						'value'   => 3,
					),
					array(
						'name' => 'column_padding',
						'label' => 'Columns padding',
						'type' => 'toggle',
						'value' => 'yes',
					),
					array(
						'name'        => 'wrap_class',
						'label'       => esc_html__( 'Extra class', 'utouch' ),
						'type'        => 'text',
						'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'utouch' ),
					)
				)
			),
			'pricing_box'   => array(
				'name'          => esc_html__( 'Pricing Box', 'utouch' ),
				'title'         => esc_html__( 'Pricing Settings', 'utouch' ),
				'icon'          => 'kc-icon-pricing',
				'category'      => esc_html__( 'Content', 'utouch' ),
				'wrapper_class' => 'clearfix',
				'is_container' => true,
				'params'        => array(
					'general' => array(
						array(
							'name'        => 'layout',
							'label'       => esc_html__( 'Select layout', 'utouch' ),
							'type'        => 'radio_image',
							'options'     => array(
								'classic_white' => $images_path . 'pricing-box/option-1.png',
								'classic_black' => $images_path . 'pricing-box/option-2.png',
								'with_image'    => $images_path . 'pricing-box/option-3.png',
								'tile' => $images_path . 'pricing-box/option-4.png',
								'colored' => $images_path . 'pricing-box/option-5.png',
							),
							'value'       => 'classic_white',
							'description' => esc_html__( 'Select format of module', 'utouch' ),
						),
						array(
							'name'    => 'show_icon',
							'label'   => esc_html__( 'Show Icon In Header', 'utouch' ),
							'type'    => 'select',
							'options' => array(
								'no'    => esc_html__( 'No Icon', 'utouch' ),
								'image' => esc_html__( 'Image', 'utouch' ),
								'icon'  => esc_html__( 'Icon', 'utouch' ),
							),
						),
						array(
							'name'     => 'image_header',
							'label'    => esc_html__( 'Image', 'utouch' ),
							'type'     => 'attach_media',
							'relation' => array(
								'parent'    => 'show_icon',
								'show_when' => 'image'
							)
						),
						array(
							'name'        => 'icon_header',
							'label'       => esc_html__( 'Select Icon', 'utouch' ),
							'value'       => 'sl-cloud-upload',
							'description' => esc_html__( 'Choose an icon to display', 'utouch' ),
							'type'        => 'icon_picker',
							'relation'    => array(
								'parent'    => 'show_icon',
								'show_when' => 'icon'
							)
						),
						array(
							'type'        => 'text',
							'name'        => 'title',
							'label'       => esc_html__( 'Label', 'utouch' ),
							'value'       => 'Text Title',
							'admin_label' => true
						),
						array(
							'type'        => 'textarea',
							'name'        => 'desc',
							'label'       => esc_html__( 'Attributes', 'utouch' ),
							'description' => wp_kses( __( 'Insert tag &lt;strong&gt; when you want highlight text.<br> Example: &lt;strong&gt;<strong>24/7</strong>&lt;/strong&gt; Support', 'utouch' ), array(
								'br',
								'strong'
							) ),
						),
						array(
							'name' => 'content',
							'label' => 'Pricing Description ',
							'type' => 'textarea_html',  // USAGE TEXT TYPE
							'value' => 'Sample Content',
							'admin_label' => true,
						),
						array(
							'name' => 'sub_desc',
							'label' => 'Pricing sub description',
							'type' => 'text',  // USAGE TEXT TYPE
							'description' => 'Pricing box sub description',
						),
						array(
							'name'  => 'currency',
							'label' => esc_html__( 'Currency', 'utouch' ),
							'type'  => 'text',
							'value' => '$'
						),
						array(
							'name'        => 'show_on_top',
							'label'       => esc_html__( 'Price Format', 'utouch' ),
							'description' => wp_kses( __( 'Price format default <strong>$99</strong>.<br> When turn on price format <strong>99$</strong>', 'utouch' ), array(
								'br',
								'strong'
							) ),
							'type'        => 'toggle',
							'value'       => 'no'
						),
						array(
							'name'  => 'price_month',
							'label' => esc_html__( 'Price per month', 'utouch' ),
							'type'  => 'text',
							'value' => '99'
						),
						array(
							'name'  => 'price_year',
							'label' => esc_html__( 'Price per year', 'utouch' ),
							'type'  => 'text',
							'value' => '299'
						),
						array(
							'name'  => 'show_button',
							'label' => esc_html__( 'Display Button', 'utouch' ),
							'type'  => 'toggle',
							'value' => 'yes'
						),
						array(
							'name'     => 'button_text',
							'label'    => esc_html__( 'Text Button', 'utouch' ),
							'type'     => 'text',
							'value'    => 'Purchase',
							'relation' => array(
								'parent'    => 'show_button',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'button_month_link',
							'label'    => esc_html__( 'Month plan link', 'utouch' ),
							'type'     => 'link',
							'value'    => '#',
							'relation' => array(
								'parent'    => 'show_button',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'button_year_link',
							'label'    => esc_html__( 'Year plan Link', 'utouch' ),
							'type'     => 'link',
							'value'    => '#',
							'relation' => array(
								'parent'    => 'show_button',
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
							'name'        => 'primary_color',
							'label'       => esc_html__( 'Background Color', 'utouch' ),
							'type'        => 'color_picker',
							'description' => esc_html__( 'Primary elements color', 'utouch' ),

						),
						array(
							'name'  => 'highlight',
							'label' => esc_html__( 'Always zoomed', 'utouch' ),
							'type'  => 'toggle',
							'value' => 'no'
						),
						array(
							'name'     => 'hover_zoom',
							'label'    => esc_html__( 'Zoom on hover', 'utouch' ),
							'type'     => 'toggle',
							'value'    => 'no',
							'relation' => array(
								'parent'    => 'highlight',
								'hide_when' => 'yes'
							)
						),
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
							'options' => array(
								array(
									'screens'                          => "any,1024,999,767,479",
									esc_html__( 'Icon', 'utouch' )   => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.pricing-tables-icon i'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Icon Size',
											'selector' => '.pricing-tables-icon i'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.pricing-tables-icon'
										),
									),
									esc_html__( 'Title', 'utouch' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.pricing-title'
										),
										array(
											'property' => 'color',
											'label'    => 'Color Hover',
											'selector' => '+:hover .pricing-title'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.pricing-title'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.pricing-title'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.pricing-title'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.pricing-title'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.pricing-title'
										),
									),
									esc_html__( 'Text', 'utouch' )   => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.pricing-tables-position'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.pricing-tables-position'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.pricing-tables-position'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.pricing-tables-position'
										),
									),
									esc_html__( 'Price', 'utouch' )  => array(
										array(
											'property' => 'color',
											'label'    => 'Color',
											'selector' => '.rate'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.rate'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Font Size',
											'selector' => '.rate'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.rate'
										),
									),
									esc_html__( 'Button', 'utouch' ) => array(
										array(
											'property' => 'color',
											'label'    => 'Text Color',
											'selector' => '.btn'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Background Color',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-size',
											'label'    => 'Text Size',
											'selector' => '.btn'
										),
										array(
											'property' => 'line-height',
											'label'    => 'Line Height',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-weight',
											'label'    => 'Font Weight',
											'selector' => '.btn'
										),
										array(
											'property' => 'font-family',
											'label'    => 'Font Family',
											'selector' => '.btn'
										),
										array(
											'property' => 'text-transform',
											'label'    => 'Text Transform',
											'selector' => '.btn'
										),
										array(
											'property' => 'letter-spacing',
											'label'    => 'Letter Spacing',
											'selector' => '.btn'
										),
										array(
											'property' => 'border',
											'label'    => 'Border',
											'selector' => '.btn'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'Border Radius',
											'selector' => '.btn'
										),
										array(
											'property' => 'color',
											'label'    => 'Hover Text Color',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'background-color',
											'label'    => 'Hover Background Color',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'border',
											'label'    => 'Hover Border',
											'selector' => '.btn:hover'
										),
										array(
											'property' => 'border-radius',
											'label'    => 'HoverBorder Radius Hover',
											'selector' => '.btn:hover'
										)
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