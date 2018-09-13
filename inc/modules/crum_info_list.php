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
			'crum_info_list' => array(
				'name'          => esc_html__( 'Info list ( deprecated )', 'utouch' ),
				'description'   => esc_html__( 'Please use another module', 'utouch' ),
				'icon'          => 'kc-utouch-icon kc-utouch-icon-info-list',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'x Etc', 'utouch' ),
				'params'        => array(
					'left box' => array(
						array(
							'name' => 'left_title',
							'label' => 'Title',
							'type' => 'text',  // USAGE TEXT TYPE
						),
						array(
							'name' => 'left_desc',
							'label' => 'Description',
							'type' => 'textarea',  // USAGE TEXT TYPE
						),
						array(
							'name' => 'left_link',
							'label' => 'Link',
							'type' => 'link',
							'value' => '#', // remove this if you do not need a default content
						),
						array(
							'name' => 'left_color',
							'label' => 'Background color',

							'type' => 'color_picker',  // USAGE COLOR_PICKER TYPE
							'value' => '#0083ff'
						),
					),
					'center box' => array(
						array(
							'name' => 'center_title',
							'label' => 'Title',
							'type' => 'text',  // USAGE TEXT TYPE
						),
						array(
							'name' => 'center_desc',
							'label' => 'Description',
							'type' => 'textarea',  // USAGE TEXT TYPE
						),
						array(
							'name' => 'center_link',
							'label' => 'Link',
							'type' => 'link',
							'value' => '#', // remove this if you do not need a default content
						),
						array(
							'name' => 'center_color',
							'label' => 'Background color',

							'type' => 'color_picker',  // USAGE COLOR_PICKER TYPE
							'value' => '#EF6517'
						),
					),
					'right box' => array(
						array(
							'name' => 'right_title',
							'label' => 'Title',
							'type' => 'text',  // USAGE TEXT TYPE
						),
						array(
							'name' => 'right_desc',
							'label' => 'Description',
							'type' => 'textarea',  // USAGE TEXT TYPE
						),
						array(
							'name' => 'right_link',
							'label' => 'Link',
							'type' => 'link',
							'value' => '#', // remove this if you do not need a default content
						),
						array(
							'name' => 'right_color',
							'label' => 'Background color',

							'type' => 'color_picker',  // USAGE COLOR_PICKER TYPE
							'value' => '#ff3133'
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