<?php
/*
Extension Name: Post + Portfolio items Slider
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

$live_tmpl   = get_template_directory() . '/kingcomposer/live_editor/';
$images_path = get_template_directory_uri() . '/images/admin/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_portfolio_slider' => array(
				'name'          => esc_html__( 'Portfolio Carousel', 'utouch' ),
				'description'   => esc_html__( 'Slider with portfolio items', 'utouch' ),
				'icon'          => 'kc-crum-icon kc-crum-icon-post-slider',
				'wrapper_class' => 'clearfix',
				'category'      => esc_html__( 'Content', 'utouch' ),
				'params'        => array(
					'general' => array(
						array(
							'type'        => 'post_taxonomy',
							'label'       => esc_html__( 'Category Select', 'utouch' ),
							'name'        => 'post_taxonomy',
							'admin_label' => true,
							'value'       => 'fw-portfolio'
						),
						array(
							'name'        => 'dots',
							'label'       => esc_html__( 'Show Dots', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Pagination dots', 'utouch' ),
							'value'       => 'yes'
						),
						array(
							'name'        => 'autoscroll',
							'label'       => esc_html__( 'Autoslide', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Automatic auto scroll slides', 'utouch' ),
							'value'       => 'no',
						),
						array(
							'name'     => 'time',
							'label'    => esc_html__( 'Delay between scroll', 'utouch' ),
							'type'     => 'number_slider',
							'options'  => array(
								'min'        => 1,
								'max'        => 30,
								'unit'       => 'sec',
								'show_input' => true
							),
							'value'    => '5',
							'relation' => array(
								'parent'    => 'autoscroll',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'read_more_text',
							'label' => esc_html__( 'Read More link text', 'utouch' ),
							'desc'  => esc_html__( 'Text for link that open inner page', 'utouch' ),
							'type'  => 'text',
							'value' => esc_html__( 'View Case', 'utouch' ),
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Custom class', 'utouch' ),
							'name'        => 'custom_class',
							'description' => esc_html__( 'Enter extra custom class', 'utouch' )
						)
					),
					'query'   => array(
						array(
							'type'        => 'dropdown',
							'label'       => esc_html__( 'Order by', 'utouch' ),
							'name'        => 'order_by',
							'admin_label' => true,
							'options'     => array(
								'ID'            => esc_html__( 'Post ID', 'utouch' ),
								'author'        => esc_html__( 'Author', 'utouch' ),
								'title'         => esc_html__( 'Title', 'utouch' ),
								'name'          => esc_html__( 'Post name (post slug)', 'utouch' ),
								'type'          => esc_html__( 'Post type (available since Version 4.0)', 'utouch' ),
								'date'          => esc_html__( 'Date', 'utouch' ),
								'modified'      => esc_html__( 'Last modified date', 'utouch' ),
								'rand'          => esc_html__( 'Random order', 'utouch' ),
								'comment_count' => esc_html__( 'Number of comments', 'utouch' )
							)
						),
						array(
							'type'        => 'dropdown',
							'label'       => esc_html__( 'Order', 'utouch' ),
							'name'        => 'order_list',
							'admin_label' => true,
							'options'     => array(
								'ASC'  => esc_html__( 'ASC', 'utouch' ),
								'DESC' => esc_html__( 'DESC', 'utouch' ),
							)
						),
						array(
							'type'        => 'number_slider',
							'label'       => esc_html__( 'Number of items displayed', 'utouch' ),
							'name'        => 'number_post',
							'description' => esc_html__( 'The number of items you want to show.', 'utouch' ),
							'value'       => '9',
							'admin_label' => true,
							'options'     => array(
								'min' => 1,
								'max' => 20
							)
						),
					),
				)
			),
		)
	);
}