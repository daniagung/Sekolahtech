<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'stunning-header' => array(
		'title'   => esc_html__( 'Color scheme', 'utouch' ),
		'type'    => 'box',
		'options' => fw()->theme->get_options( 'metabox-event-category' ),
	),
);