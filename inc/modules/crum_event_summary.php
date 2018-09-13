<?php
/*
Extension Name: Icon with contact info
Extension Preview: -
Description:
Version: 1.0
Author: Crumina
Author URI: https://wpcode.pro/
*/

if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}
if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
	// Buttons
		array(
			'crum_event_summary' => array(
				'name'          => esc_html__( 'Event summary', 'utouch' ),
				'description'   => esc_html__( 'Event summary', 'utouch' ),
				'icon'          => 'kc-utouch-icon kc-utouch-icon-event',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'Event', 'utouch' ),
				'params'        => array(
					'general' => array(
						array(
							'name'  => 'event_id',
							'label' => 'Event',

							'type'    => 'select',  // USAGE SELECT TYPE
							'options' =>  wp_list_pluck( get_posts(
								array(
									'post_per_page' => 0,
									'post_type'     => 'fw-event'
								)
							), 'post_title', 'ID' ),
						),
					),
					'styling' => array(
						array(
							'name' => 'css_custom',
							'type' => 'css',
						)
					),
					'animate' => array(
						array(
							'name' => 'animate',
							'type' => 'animate'
						)
					),
				)
			),
		)
	);
}