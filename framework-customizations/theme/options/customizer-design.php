<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'website_preloader' => array(
		'type'  => 'switch',
		'value' => false,
		'label' => esc_html__( 'Enable website pre-loader', 'utouch' ),
	),
	'primary_color'     => array(
		'type'     => 'color-picker',
		'palettes' => array( '#f6f8f7', '#4cc2c0', '#f15b26', '#fcb03b', '#3cb878', '#8dc63f', '#6739b6' ),
		'label'    => esc_html__( 'Main accent color', 'utouch' ),
		'help'     => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
		'value'    => '#0083ff',
	),
	'secondary_color'   => array(
		'type'     => 'color-picker',
		'palettes' => array( '#f6f8f7', '#4cc2c0', '#f15b26', '#fcb03b', '#3cb878', '#8dc63f', '#6739b6' ),
		'label'    => esc_html__( 'Secondary accent color', 'utouch' ),
		'help'     => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
		'value'    => '#9db5d4',
	),

);




