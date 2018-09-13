<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$admin_images_path = get_template_directory_uri() . '/images/admin';

$options = array(
	'portfolio_layout_design' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'value' => array(
				'label'   => esc_html__( 'Portfolio items layout', 'utouch' ),
				'desc'    => esc_html__( 'Select how to display portfolio items', 'utouch' ),
				'type'    => 'image-picker',
				'value' => 'apps',
					'choices' => array(
					'apps' => array(
						'small' => array(
							'src'    => $admin_images_path . '/portfolio/apps.png',
							'height' => 90
						),
					),
					'grid' => array(
						'small' => array(
							'src'    => $admin_images_path . '/portfolio/grid.png',
							'height' => 90
						),
					),
				),
				'blank'   => false
			)
		),
		'choices' => array(),
	),
	'portfolio_more_text'     => array(
		'label' => esc_html__( 'Read More link text', 'utouch' ),
		'desc'  => esc_html__( 'Text for link that open inner page', 'utouch' ),
		'type'  => 'text',
		'value' => esc_html__( 'View Case', 'utouch' )
	),
);


