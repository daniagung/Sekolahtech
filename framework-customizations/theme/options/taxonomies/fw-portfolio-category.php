<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'stunning-header' => array(
		'title'   => esc_html__( 'Stunning Header', 'utouch' ),
		'type'    => 'box',
		'options' => array(
			fw()->theme->get_options( 'metabox-stunning' ),
		),
	),
);