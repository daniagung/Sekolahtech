<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'design-customize' => array(
		'title'    => esc_html__( 'Customize design', 'utouch' ),
		'type'     => 'box',
		'priority' => 'high',
		'options'  => array(
			'header'          => array(
				'title'   => esc_html__( 'Header', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'select_menu' => array(
						'desc'    => sprintf(__( 'Select one of website menus. Or <a href="%s">Create new menu</a>.', 'utouch' ), admin_url( 'nav-menus.php' ) ),
						'type'    => 'select',
						'label'   => esc_html__( 'Select menu to display', 'utouch' ),
						'choices' => utouch_get_menus(),
					),
					'custom-header' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'enable' => array(
								'label' => esc_html__( 'Change settings?', 'utouch' ),
								'desc'  => esc_html__( 'Extra settings for element. Will affect only on current page.', 'utouch' ),
								'type'  => 'switch',
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
						'show_borders' => true,
					),
				),
			),
			'stunning-header' => array(
				'title'   => esc_html__( 'Stunning Header', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					fw()->theme->get_options( 'metabox-stunning' ),
				),
			),
		),
	),
);