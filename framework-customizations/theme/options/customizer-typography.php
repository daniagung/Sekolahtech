<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'section_typography_body' => array(
		'title'   => esc_html__( 'Body font', 'utouch' ),
		'options' => array(
			'typography_body' => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#757575'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'Body font', 'utouch' ),
			),
		)
	),
	'section_typography_h1' => array(
		'title'   => esc_html__( 'H1 headings', 'utouch' ),
		'options' => array(
			'typography_h1'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'H1 headings', 'utouch' ),
			),
		)
	),
	'section_typography_h2' => array(
		'title'   => esc_html__( 'H2 headings', 'utouch' ),
		'options' => array(
			'typography_h2'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'H2 headings', 'utouch' ),
			),
		)
	),
	'section_typography_h3' => array(
		'title'   => esc_html__( 'H3 headings', 'utouch' ),
		'options' => array(
			'typography_h3'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'H3 headings', 'utouch' ),
			),
		)
	),
	'section_typography_h4' => array(
		'title'   => esc_html__( 'H4 headings', 'utouch' ),
		'options' => array(
			'typography_h4'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'H4 headings', 'utouch' ),
			),
		)
	),
	'section_typography_h5' => array(
		'title'   => esc_html__( 'H5 headings', 'utouch' ),
		'options' => array(
			'typography_h5'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true
				),
				'label'      => esc_html__( 'H5 headings', 'utouch' ),
			),
		)
	),
	'section_typography_h6' => array(
		'title'   => esc_html__( 'H6 headings', 'utouch' ),
		'options' => array(
			'typography_h6'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => '#2f2c2c'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'line-height'    => false,
					'letter-spacing' => true,
					'color'          => true
				),
				'label'      => esc_html__( 'H6 headings', 'utouch' ),
			),
		)
	),
	'section_typography_nav' => array(
		'title'   => esc_html__( 'Menu typography', 'utouch' ),
		'options' => array(
			'typography_nav'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => 'Default',
					'subset'         => '',
					'variation'      => '',
					'size'           => '',
					'letter-spacing' => '',
					'color'          => ''
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'line-height'    => false,
					'letter-spacing' => true,
					'color'          => true
				),
				'label'      => esc_html__( 'Menu typography', 'utouch' ),
			),
		)
	),
	'section_typography_logo' => array(
		'title'   => esc_html__( 'Logotype typography', 'utouch' ),
		'options' => array(
			'typography_logo'   => array(
				'type'       => 'typography-v2',
				'value'      => array(
					'family'         => '',
					'subset'         => '',
					'variation'      => '',
					'size'           => '30',
					'letter-spacing' => '',
					'line-height'  => '0.7',
					'color'          => '#516e90'
				),
				'components' => array(
					'family'         => true,
					'size'           => true,
					'line-height'    => true,
					'letter-spacing' => true,
					'color'          => true
				),
				'label'      => esc_html__( 'Menu typography', 'utouch' ),
			),
		)
	),
);