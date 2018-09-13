<?php if (!defined('FW')) die('Forbidden');

$options = array(

	'slider-bg-color'   => array(
		'type'     => 'color-picker',
		'value'    => '#ecf5fe',
		// palette colors array
		'palettes' => array( '#f6f8f7', '#4cc2c0', '#f15b26', '#fcb03b', '#3cb878', '#8dc63f', '#6739b6' ),
		'label'    => esc_html__( 'Slider background color', 'utouch' ),
		'desc'    => esc_html__( 'Leave empty for no background color', 'utouch' ),
	),
	/*'full_height' => array(
		'label'        => esc_html__( 'Full height slider', 'utouch' ),
		'type'         => 'switch',
		'right-choice' => array(
			'value' => 'on',
			'label' => esc_html__( 'On', 'utouch' ),
		),
		'left-choice'  => array(
			'value' => 'off',
			'label' => esc_html__( 'Off', 'utouch' ),
		),
		'value'        => 'off',
		'desc'         => esc_html__( 'Expand height to full browser window height', 'utouch' ),
	),*/
	'slider_infinity' => array(
		'label'        => esc_html__( 'Infinite loop', 'utouch' ),
		'type'         => 'switch',
		'right-choice' => array(
			'value' => 'on',
			'label' => esc_html__( 'On', 'utouch' ),
		),
		'left-choice'  => array(
			'value' => 'off',
			'label' => esc_html__( 'Off', 'utouch' ),
		),
		'value'        => 'off',
		'desc'         => esc_html__( 'Enable loop slides by circle', 'utouch' ),
	),
	'autoplay' => array(
		'type'  => 'slider',
		'value' => 4,
		'properties' => array(
			'min' => 0,
			'max' => 20,
			'step' => 1,
		),
		'label' => esc_html__('Auto Scroll delay', 'utouch'),
		'desc'  => esc_html__('Time between change slides in seconds', 'utouch'),
		'help'  => esc_html__('If you will set "0" autopay will be disabled', 'utouch'),
	),


);
