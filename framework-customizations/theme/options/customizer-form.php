<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$forms = get_posts(
	array(
		'post_type'   => 'crum-form',
		'numberposts' => - 1
	)
);

$choices = array( '' => '------------' );

if ( ! empty( $forms ) ) {
	foreach ( $forms as $form ) {
		$choices[ $form->ID ] = empty( $form->post_title ) ? esc_html__( '(no title)', 'utouch' ) : $form->post_title;
	}
} else {
	$choices = array(
		'' => esc_html__( 'No Forms Found', 'utouch' )
	);
}
if ( function_exists( 'utouch_button_colors' ) ) {
	$button_colors = utouch_button_colors();
} else {
	$button_colors = array( '' => '------------' );
}

$options = array(
	'contact_form' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'type' => array(
				'label'   => esc_html__( 'Select Form type', 'utouch' ),
				'type'    => 'select',
				'choices' => array(
					'default'     => esc_html__( 'Default', 'utouch' ),
					'custom'      => esc_html__( 'Custom from builder', 'utouch' ),
					'shortcode'      => esc_html__( '3-rd party plugin shortcode', 'utouch' ),
				),
				'value'   => 'default',
			),
		),
		'choices' => array(
			'shortcode' => array(
				'shortcode' => array(
					'label'      => esc_html__( 'Use Shortcode from your plugin', 'utouch' ),
					'type'       => 'text',
					'value' => '',
				),
			),
			'custom' => array(
				'form_id' => array(
					'label'       => esc_html__( 'Select Form', 'utouch' ),
					'type'        => 'select',
					'choices'     => $choices
				),
				'color_btn' => array(
					'label'   => esc_html__( 'Submit Color', 'utouch' ),
					'type'    => 'select',
					'choices' => $button_colors,
				),
			),
			'default' => array(
				'email' => array(
					'label'      => esc_html__( 'Contact email', 'utouch' ),
					'type'       => 'text',
					'value' => get_option('admin_email'),
				),
				'title' => array(
					'label'      => esc_html__( 'Title', 'utouch' ),
					'type'       => 'text',
					'value' => esc_html__( 'Send a Message', 'utouch' )
				),
				'description' => array(
					'label'      => esc_html__( 'Description', 'utouch' ),
					'type'       => 'textarea',
					'value' => '',
				),
				'text_btn' => array(
					'label'      => esc_html__( 'Submit Text', 'utouch' ),
					'type'       => 'text',
					'value' => esc_html__('Send a Message','utouch')
				),
				'color_btn' => array(
					'label'   => esc_html__( 'Submit Color', 'utouch' ),
					'type'    => 'select',
					'choices' => $button_colors,
				),
				'thanks' => array(
					'label'      => esc_html__( 'Success Message', 'utouch' ),
					'type'       => 'text',
					'value' => esc_html__('Message sent!','utouch')
				),
			),
		),
	),
);


