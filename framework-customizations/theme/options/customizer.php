<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Customizer options
 *
 * @var array $options Fill this array with options to generate theme style from frontend Customizer
 */


$options = array(
	'panel_design'    => array(
		'title'   => esc_html__( 'Design customize', 'utouch' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-design' ),
		),
	),
	'panel_typo'      => array(
		'title'   => esc_html__( 'Typography', 'utouch' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-typography' ),
		),
	),
	'panel_header'    => array(
		'title'   => esc_html__( 'Header options', 'utouch' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-header' ),
		),
	),
	'panel_stunning'  => array(
		'title'   => esc_html__( 'Stunning header', 'utouch' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-stunning' ),
		),
	),

	'panel_footer'    => array(
		'title'   => esc_html__( 'Footer options', 'utouch' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-footer' ),
		),
	),
	'panel_blog'      => array(
		'title'   => esc_html__( 'Blog options', 'utouch' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-blog' ),
		),
	),
	'panel_portfolio' => array(
		'title'   => esc_html__( 'Portfolio options', 'utouch' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-portfolio' ),
		),
	),
	'panel_event'      => array(
		'title'   => esc_html__( 'Event options', 'utouch' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-event' ),
		),
	),
	'panel_form'      => array(
		'title'   => esc_html__( 'Contact form options', 'utouch' ),
		'options' => array(
			fw()->theme->get_options( 'customizer-form' ),
		),
	),
	'custom_js'       => array(
		'title'   => esc_html__( 'Additional JS', 'utouch' ),
		'options' => array(
			'custom-js' => array(
				'type'  => 'textarea',
				'value' => '',
				'label' => esc_html__( 'JS code field', 'utouch' ),
				'desc'  => wp_kses( __( 'without &lt;script&gt; tags', 'utouch' ), array(
					'&lt;' => array(),
					'&gt;' => array()
				) ),
				'attr'  => array(
					'class'       => 'large-textarea',
					'placeholder' => 'jQuery( document ).ready(function() {  SOME CODE  });',
					'rows'        => 20,
				),
			),
		),
	),
);