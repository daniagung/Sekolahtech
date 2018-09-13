<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'sub-title' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Subtitle', 'utouch'),
		'desc'  => esc_html__('Leave empty for no subtitle', 'utouch'),
	),
	'title_decoration' => array(
		'type'         => 'switch',
		'value'        => 'no',
		'label'        => esc_html__( 'Title decoration', 'utouch' ),
		'desc'         => esc_html__( 'Title decoration on left and right sides', 'utouch' ),
		'left-choice'  => array(
			'value' => 'yes',
			'label' => esc_html__( 'Yes', 'utouch' ),
		),
		'right-choice' => array(
			'value' => 'no',
			'label' => esc_html__( 'No', 'utouch' ),
		),
	),
	'buttons'          => array(
		'label'         => esc_html__( 'Buttons', 'utouch' ),
		'type'          => 'addable-popup',
		'template'      => '{{= utouch_button_title(button)}}',
		'desc'          => esc_html__( 'Add button', 'utouch' ),
		'popup-options' => array(
			fw()->theme->get_options( 'option-link' ),
			'button' => array(
				'type'         => 'multi-picker',
				'label'        => false,
				'desc'         => false,
				'picker'       => array(
					'style' => array(
						'label'   => esc_html__( 'Button', 'utouch' ),
						'type'    => 'select',
						'choices' => array(
							'regular'     => esc_html__( 'Regular', 'utouch' ),
							'app-store'   => esc_html__( 'App store', 'utouch' ),
							'google-play' => esc_html__( 'Google play', 'utouch' ),
						),
						'desc'    => esc_html__( 'Choose button style', 'utouch' ),
					)
				),
				'choices'      => array(
					'regular' => array(
						'label'    => array(
							'label' => esc_html__( 'Button Label', 'utouch' ),
							'desc'  => esc_html__( 'This is the text that appears on your button', 'utouch' ),
							'type'  => 'text',
							'value' => ''
						),
						'color'    => array(
							'label'   => esc_html__( 'Color', 'utouch' ),
							'type'    => 'select', // or 'short-select'
							'attr'    => array( 'class' => 'colored-options' ),
							'choices' => utouch_button_colors(),
						),
						'size'     => array(
							'type'    => 'radio',
							'value'   => 'medium',
							'label'   => esc_html__( 'Button size', 'utouch' ),
							'choices' => array(
								'small'  => esc_html__( 'Small', 'utouch' ),
								'medium' => esc_html__( 'Medium', 'utouch' ),
								'large'  => esc_html__( 'Large', 'utouch' ),
							),
							'inline'  => true,
						),
						'outlined' => array(
							'label'        => esc_html__( 'Outlined button', 'utouch' ),
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
							'desc'         => esc_html__( 'Button with border and transparent background', 'utouch' ),
						),
						'shadow'   => array(
							'label'        => esc_html__( 'Drop shadow', 'utouch' ),
							'type'         => 'switch',
							'right-choice' => array(
								'value' => 'on',
								'label' => esc_html__( 'On', 'utouch' ),
							),
							'left-choice'  => array(
								'value' => 'off',
								'label' => esc_html__( 'Off', 'utouch' ),
							),
							'value'        => 'on',
							'desc'         => esc_html__( 'Buttons shadow effect on hover', 'utouch' ),
						),
					)
				),
				'show_borders' => false,
			),
			'class'  => array(
				'type'  => 'text',
				'label' => esc_html__( 'Additional class', 'utouch' ),
				'desc'  => esc_html__( 'Class that can be used for additional styling or JS actions', 'utouch' )
			),
		),
	),
	'bg-color'         => array(
		'type'     => 'color-picker',
		'value'    => '',
		// palette colors array
		'palettes' => array( '#f6f8f7', '#4cc2c0', '#f15b26', '#fcb03b', '#3cb878', '#8dc63f', '#6739b6' ),
		'label'    => esc_html__( 'Slide background color', 'utouch' ),
		'desc'     => esc_html__( 'Leave empty for no background color', 'utouch' ),
	),
	'bg-image'         => array(
		'type'        => 'upload',
		'label'       => esc_html__( 'Background image', 'utouch' ),
		'desc'        => esc_html__( 'Choose slider background image', 'utouch' ),
		'images_only' => true,
	),
	'text-color'       => array(
		'label'        => esc_html__( 'Text Color scheme', 'utouch' ),
		'type'         => 'switch',
		'right-choice' => array(
			'value' => 'dark',
			'label' => esc_html__( 'Dark', 'utouch' ),
			'color' => '#2f2c2c'
		),
		'left-choice'  => array(
			'value' => 'light',
			'label' => esc_html__( 'Light', 'utouch' ),
		),
		'value'        => 'dark',
		'desc'         => esc_html__( 'Main text color light / dark', 'utouch' ),
	),
);
