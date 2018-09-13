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

if(!function_exists( 'fw_ext_breadcrumbs' )){
	return;
}

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
	// Buttons
		array(
			'crum_breadcrumbs' => array(
				'name'          => esc_html__( 'Breadcrumbs', 'utouch' ),
				'description'   => esc_html__( 'Breadcrumbs', 'utouch' ),
				'icon'          => 'kc-utouch-icon kc-utouch-icon-bradcrumbs',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'Content', 'utouch' ),
				'params'        => array(
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
						),

					),
					'animate' => array(
						array(
							'name'    => 'animate',
							'type'    => 'animate'
						)
					),
				)
			),
		)
	);
}