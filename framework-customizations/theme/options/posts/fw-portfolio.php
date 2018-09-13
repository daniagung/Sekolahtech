<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$grid_link = '<a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grid</a>';
$options   = array(
	'description'     => array(
		'title'    => esc_html__( 'Project summary', 'utouch' ),
		'type'     => 'box',
		'priority' => 'high',
		'context'  => 'side',
		'options'  => array(
			'project-title'    => array(
				'label' => esc_html__( 'Title', 'utouch' ),
				'desc'  => esc_html__( 'Alternative title for project', 'utouch' ),
				'type'  => 'textarea'
			),
		),
	),

	'design-customize' => array(
		'title'    => esc_html__( 'Customize design', 'utouch' ),
		'type'     => 'box',
		'priority' => 'high',
		'options'  => array(
			'portfolio-styling' => array(
				'title'   => esc_html__( 'Styling', 'utouch' ),
				'type'    => 'tab',
				'options' => array(

					'text-color'       => array(
						'type'     => 'color-picker',
						'value'    => '#fff',
						'palettes' => array( '#ba4e4e', '#0ce9ed', '#941940' ),
						'label'    => esc_html__( 'Text color', 'utouch' ),
						'desc'     => esc_html__( 'Text color on project preview', 'utouch' ),
					),
					'background-color' => array(
						'type'     => 'color-picker',
						'value'    => '#273f5b',
						'palettes' => array( '#ba4e4e', '#0ce9ed', '#941940' ),
						'label'    => esc_html__( 'Background color', 'utouch' ),
						'desc'     => esc_html__( 'Background color on project preview', 'utouch' ),
					),
				),
			),
			'header'            => array(
				'title'   => esc_html__( 'Header', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'custom-header' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'enable' => array(
								'label'        => esc_html__( 'Change settings?', 'utouch' ),
								'desc'         => esc_html__( 'Extra settings for element. Will affect only on current page.', 'utouch' ),
								'type'         => 'switch',
								'right-choice' => array(
									'value' => 'yes',
									'label' => esc_html__( 'Yes', 'utouch' )
								),
								'left-choice'  => array(
									'value' => 'no',
									'label' => esc_html__( 'No', 'utouch' )
								),
								'value'        => 'no',
							),
						),
						'choices' => array(
							'yes' => array(
								fw()->theme->get_options( 'metabox-header' ),
							),
						),
					),
				),
			),
			'stunning-header'   => array(
				'title'   => esc_html__( 'Stunning Header', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					fw()->theme->get_options( 'metabox-stunning' ),
				),
			),
		),
	),
);