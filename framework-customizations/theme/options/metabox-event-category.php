<?php
/**
 * @package utouch-wp
 */

$options = array(

	'accent-color'  => array(
		'type'     => 'color-picker',
		'value'    => '#fff',
		'palettes' => array(
			'#0083ff',
			'#273f5b',
			'#738CAA',
			'#738CAA',
			'#01a23c',
			'#EF6517',
			'#F89101',
			'#ff3133',
			'#FECF39',
			'#9FC31A',
			'#00ffff'
		),
		'label'    => esc_html__( 'Accent color', 'utouch' ),
		'desc'     => esc_html__( 'Bottom border color', 'utouch' ),
	),


	'overlay-color' => array(
		'type'     => 'rgba-color-picker',
		'value'    => 'rgba(15,15,15,0.5)',
		'palettes' => array(
			'rgba(0, 131, 255, 0.5)',
			'rgba(39, 63, 91, 0.5)',
			'rgba(1, 162, 60, 0.5)',
			'rgba(97, 177, 49, 0.5)',
			'rgba(18, 25, 33, 0.5)',
			'rgba(239, 101, 23, 0.5)',
			'rgba(248, 145, 1, 0.5)',
			'rgba(255, 49, 51, 0.5)',
			'rgba(115, 140, 170, 0.5)',
			'rgba(236, 244, 252, 0.5)',
			'rgba(254, 207, 57, 0.5)',
			'rgba(159, 195, 26, 0.5)'
		),
		'label'    => esc_html__( 'Overlay color', 'utouch' ),
		'desc'     => esc_html__( 'Choose overlay color for featured image', 'utouch' ),
	),
);