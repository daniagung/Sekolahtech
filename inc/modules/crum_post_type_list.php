<?php
/*
Extension Name: List of latest events
Extension Preview: -
Description:
Version: 1.0
Author: Crumina
Author URI: https://crumina.net/
*/

if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}
if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_post_type_list' => array(
				'name' => __(' List Blog Posts', 'utouch'),
				'icon' => 'kc-icon-post',
				'category' => 'Blog Posts',
				'priority'  => 340,
				'params'		=> array(
					'general' => array(
						array(
							'type'			=> 'number_slider',
							'label'			=> __( 'Number of posts displayed', 'utouch' ),
							'name'			=> 'number_post',
							'description'	=> __( 'The number of posts you want to show.', 'utouch' ),
							'value'			=> '5',
							'admin_label'	=> true,
							'options' => array(
								'min' => 1,
								'max' => 12
							)
						),
						array(
							'type'			=> 'post_taxonomy',
							'label'			=> __( 'Content Type', 'utouch' ),
							'name'			=> 'post_taxonomy',
							'admin_label'	=> true
						),
						array(
							'type'			=> 'dropdown',
							'label'			=> __( 'Order by', 'utouch' ),
							'name'			=> 'order_by',
							'admin_label'	=> true,
							'options' 		=> array(
								'ID'		=> __(' Post ID', 'utouch'),
								'author'	=> __(' Author', 'utouch'),
								'title'		=> __(' Title', 'utouch'),
								'name'		=> __(' Post name (post slug)', 'utouch'),
								'type'		=> __(' Post type (available since Version 4.0)', 'utouch'),
								'date'		=> __(' Date', 'utouch'),
								'modified'	=> __(' Last modified date', 'utouch'),
								'rand'		=> __(' Random order', 'utouch'),
								'comment_count'	=> __(' Number of comments', 'utouch')
							)
						),
						array(
							'type'			=> 'dropdown',
							'label'			=> __( 'Order post', 'utouch' ),
							'name'			=> 'order_list',
							'admin_label'	=> true,
							'options' 		=> array(
								'ASC'		=> __(' ASC', 'utouch'),
								'DESC'		=> __(' DESC', 'utouch'),
							)
						),
						array(
							'type'			=> 'text',
							'label'			=> __( 'Wrapper class name', 'utouch' ),
							'name'			=> 'wrap_class',
							'description'	=> __( 'Custom class for wrapper of the shortcode widget.', 'utouch' ),
						)
					),
					'styling' => array(
						array(
							'name'    => 'css_custom',
							'type'    => 'css',
						)
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