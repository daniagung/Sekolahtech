<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(
    'workshop_label' => array(
        'type'  => 'text',
        'value' => esc_html__( 'Workshop', 'utouch' ),
        'label' => esc_html__( 'Workshop tab', 'utouch' ),
    ),
    'schedule_label' => array(
        'type'  => 'text',
        'value' => esc_html__( 'Schedule', 'utouch' ),
        'label' => esc_html__( 'Schedule tab', 'utouch' ),
    ),
    'speakers_label' => array(
        'type'  => 'text',
        'value' => esc_html__( 'Speakers', 'utouch' ),
        'label' => esc_html__( 'Speakers tab', 'utouch' ),
    ),
    'location_label' => array(
        'type'  => 'text',
        'value' => esc_html__( 'Location', 'utouch' ),
        'label' => esc_html__( 'Location tab', 'utouch' ),
    ),
);
