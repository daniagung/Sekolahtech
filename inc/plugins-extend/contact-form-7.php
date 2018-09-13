<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/* Add Contact form 7 module for King Composer */
if ( function_exists( 'kc_add_map' ) ) {
	$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
	if ( function_exists( 'utouch_button_colors' ) ) {
		$button_colors = utouch_button_colors();
	} else {
		$button_colors = array();
	}

	$contact_forms = array();
	if ( ! empty( $cf7 ) ) {

		foreach ( $cf7 as $cform ) {
			$contact_forms[ $cform->ID ] = $cform->post_title;
		}
		$options = array(
			'general' => array(
				array(
					'name'    => 'contact_form_id',
					'type'    => 'select',
					'label'   => esc_html__( 'Select Created Form', 'utouch' ),
					'options' => $contact_forms
				),
				array(
					'name'        => 'wrap_class',
					'label'       => esc_html__( 'Extra class', 'utouch' ),
					'type'        => 'text',
					'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'utouch' ),
				),
			),
			'styling' => array(
				array(
					'name'    => 'color_form',
					'type'    => 'select',
					'label'   => esc_html__( 'Color scheme', 'utouch' ),
					'options' => array(
						'white' => esc_html__( 'White', 'utouch' ),
						'dark'  => esc_html__( 'Dark', 'utouch' ),
					)
				),
				array(
					'name'    => 'color_btn',
					'label'   => esc_html__( 'Submit Color', 'utouch' ),
					'type'    => 'select', // or 'short-select'
					'options' => $button_colors,
				),
				array(
					'type'    => 'css',
					'label'   => esc_html__( 'css', 'utouch' ),
					'name'    => 'custom_css',
					'options' => array(
						array(
							'screens'                             => 'any',
							esc_html__( 'Box Style', 'utouch' ) => array(
								array( 'property' => 'text-align', 'label' => 'Align' ),
								array( 'property' => 'padding', 'label' => 'Padding' ),
								array( 'property' => 'margin', 'label' => 'Margin' ),
							),
							esc_html__( 'Input', 'utouch' )     => array(
								array(
									'property' => 'font-size',
									'label'    => 'Font Size',
									'selector' => 'input, textarea'
								),
								array(
									'property' => 'color',
									'label'    => 'Text color',
									'selector' => 'input, textarea'
								),
								array(
									'property' => 'background-color',
									'label'    => 'Background Color',
									'selector' => 'input, textarea'
								),
								array( 'property' => 'border', 'label' => 'Border', 'selector' => 'input, textarea' ),
								array(
									'property' => 'border-radius',
									'label'    => 'Border Radius',
									'selector' => 'input, textarea'
								),
							),
							esc_html__( 'Button', 'utouch' )    => array(
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
									'property' => 'font-size',
									'label'    => 'Text Size',
									'selector' => '.btn'
								),
								array( 'property' => 'border', 'label' => 'Border', 'selector' => '.btn' ),
								array(
									'property' => 'border-radius',
									'label'    => 'Border Radius',
									'selector' => '.btn'
								),
							),
						)
					)
				),
			),
		);
	} else {
		$options = array(
			array(
				'name'       => 'no-forms',
				'type'       => 'html-full',
				'label'      => false,
				'desc'       => false,
				'admin_view' => 'html',
				'value'      =>
					'<h3>' . esc_html__( 'No Forms Available', 'utouch' ) . '</h3>' .
					'<p>' .
					'<em>' .
					str_replace(
						array(
							'{br}',
							'{add_slider_link}'
						),
						array(
							'<br/>',
							utouch_html_tag( 'a', array(
								'href'   => admin_url( '?page=wpcf7-new' ),
								'target' => '_blank',
							), esc_html__( 'create a new Form', 'utouch' ) )
						),
						__( 'No Forms created yet. Please go to the {br}Contact Forms page and {add_slider_link}.', 'utouch' )
					) .
					'</em>' .
					'</p>'
			)

		);
	}
	kc_add_map(
		array(
			'crum_cf7' => array(
				'name'        => 'Contact Form 7',
				'description' => esc_html__( 'Display contact form', 'utouch' ),
				'icon'        => 'kc-crum-icon kc-crum-icon-contact-form',
				'category'    => esc_html__( 'Content', 'utouch' ),
				'params'      => $options
			),  // End of elemnt kc_icon

		)
	); // End add map

} // End if