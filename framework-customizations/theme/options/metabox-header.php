<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$admin_images_path = get_template_directory_uri() . '/images/admin';

$options = array(
	'sections-top-bar' => array(
		'type'  => 'multi-picker',
		'label' => false,
		'desc'  => false,
		'value' => array(
			'status' => 'hide',
			'show' => array(
				'theme-style' => 'top-bar-dark',
			),
		),
		'picker' => array(
			'status' => array(
				'type'  => 'switch',
				'label' => esc_html__('Top bar', 'utouch'),
				'left-choice' => array(
					'value' => 'show',
					'label' => esc_html__('Show', 'utouch'),
				),
				'right-choice' => array(
					'value' => 'hide',
					'label' => esc_html__('Hide', 'utouch'),
				),
			),
		),
		'choices' => array(
			'show' => array(
				'theme-style' => array(
					'type'  => 'select',
					'label' => esc_html__('Color scheme', 'utouch'),
					'choices' => array(
						'' => esc_html__('White', 'utouch'),
						'top-bar-dark' => esc_html__('Dark', 'utouch'),
					),
				),
				'icons-style' => array(
					'type'  => 'radio',
					'label' => esc_html__('Icons style', 'utouch'),
					'value' => 'plain',
					'choices' => array(
						'colored' => esc_html__('Colored', 'utouch'),
						'plain' => esc_html__('Text color', 'utouch'),
					),
				),
			),
		),
		'show_borders' => true,
	),

	'decorative-line' => array(
		'type'  => 'switch',
		'label' => esc_html__('Top decorative line', 'utouch'),
		'value' => 'show',
		'left-choice' => array(
			'value' => 'hide',
			'label' => esc_html__('Hide', 'utouch'),
		),
		'right-choice' => array(
			'value' => 'show',
			'label' => esc_html__('Show', 'utouch'),
		),
	),

	'header_bg_color'   => array(
		'type'  => 'color-picker',
		'label' => esc_html__( 'Background Color', 'utouch' ),
		'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
		'value' => '#fff',

	),
	'header-text-color' => array(
		'type'  => 'color-picker',
		'label' => esc_html__( 'Text Color', 'utouch' ),
		'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
		'value' => '#6a85a6',

	),
	'dropdown-style' => array(
		'type'  => 'multi-picker',


		'picker' => array(
			'type' =>  array(
				'type'  => 'image-picker',
				'label' => esc_html__('Menu decoration style', 'utouch'),
				'choices' => array(
					'default' => array(
						'small' => array(
							'src' => $admin_images_path.'/default.png',
							'height' => 90
						),
					),
					'1' => array(
						'small' => array(
							'src' => $admin_images_path.'/menu/option-1.png',
							'height' => 90
						),
					),
					'2' =>
						array(
							'small' => array(
								'src' => $admin_images_path.'/menu/option-3.png',
								'height' => 90
							),
						),
					'3'   => array(
						'small' => array(
							'src' => $admin_images_path.'/menu/option-2.png',
							'height' => 90
						),
					),
				),
				'blank'   => false
			),
		),

		'choices' => array(
			'2' => array(
				'bg-color'   => array(
					'type'     => 'color-picker',
					'palettes' => array( '#f6f8f7', '#4cc2c0', '#f15b26', '#fcb03b', '#3cb878', '#8dc63f', '#6739b6' ),
					'label'    => esc_html__( 'Background color', 'utouch' ),
					'help'     => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
					'value' => '#ecf5fe',
				),
			),
		),

		'show_borders' => false,
	),
);