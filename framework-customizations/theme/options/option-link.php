<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'link'       => array(
		'type'          => 'popup',
		'label'         => esc_html__( 'Set link', 'utouch' ),
		'popup-title'   => esc_html__( 'Insert/edit link', 'utouch' ),
		'button'        => esc_html__( 'Select URL', 'utouch' ),
		'size'          => 'small', // small, medium, large
		'popup-options' => array(
			'selected' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'selected' => array(
						'label'   => esc_html__( 'Link source', 'utouch' ),
						'type'    => 'select', // or 'short-select'
						'url' => 'url',
						'choices' => array(
							'url'  => esc_html__( 'Type url', 'utouch' ),
							'page' => esc_html__( 'Select page', 'utouch' ),
						),
						'desc'    => esc_html__( 'Select link source', 'utouch' ),
					),
				),
				'choices' => array(
					'url'  => array(
						'link' => array(
							'type'  => 'text',
							'label' => esc_html__( 'Type Link', 'utouch' ),
							'desc'  => esc_html__( 'Where should this element link to?', 'utouch' )
						),
					),
					'page' => array(
						'link' => array(
							'type'       => 'multi-select',
							'label'      => esc_html__( 'Select some blog page', 'utouch' ),
							'desc'       => esc_html__( 'Select a page which this element will be linked to', 'utouch' ),
							'help'       => esc_html__( 'Click on field and type page name to find page', 'utouch' ),
							'population' => 'posts',
							'value'      => '',
							'source'     => 'page',
							'limit'      => 1,
						),
					),
				),
			),
			'target'   => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Open Link in New Window', 'utouch' ),
				'desc'         => esc_html__( 'Select here if you want to open the linked page in a new window', 'utouch' ),
				'right-choice' => array(
					'value' => '_blank',
					'label' => esc_html__( 'Yes', 'utouch' ),
				),
				'left-choice'  => array(
					'value' => '_self',
					'label' => esc_html__( 'No', 'utouch' ),
				),
			),
		),
	),
);
