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
			'crum_event_list' => array(
				'name'        => esc_html__( ' List Events', 'utouch' ),
				'icon'        => 'kc-crum-icon-events',
				'category'      => esc_html__( 'Event', 'utouch' ),
				'params'      => array(
					'general' => array(
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Title', 'utouch' ),
							'name'        => 'title',
							'description' => esc_html__( 'The title of the Post Type List. Leave blank if no title is needed.', 'utouch' ),
							'value'       => esc_html__( 'Recent post title', 'utouch' ),
							'admin_label' => true
						),
						array(
							'type'        => 'number_slider',
							'label'       => esc_html__( 'Number of posts displayed', 'utouch' ),
							'name'        => 'number_post',
							'description' => esc_html__( 'The number of posts you want to show.', 'utouch' ),
							'value'       => '5',
							'admin_label' => true,
							'options'     => array(
								'min' => 1,
								'max' => 12
							)
						),
						array(
							'type'        => 'post_taxonomy',
							'label'       => esc_html__( 'Category Select', 'utouch' ),
							'name'        => 'post_taxonomy',
							'admin_label' => true,
							'value'       => 'fw-event'
						),
						array(
							'type'        => 'dropdown',
							'label'       => esc_html__( 'Order by', 'utouch' ),
							'name'        => 'order_by',
							'admin_label' => true,
							'options'     => array(
								'ID'            => ' ' . esc_html__( 'Post ID', 'utouch' ),
                                'author'        => ' ' . esc_html__( 'Author', 'utouch' ),
                                'title'         => ' ' . esc_html__( 'Title', 'utouch' ),
                                'name'          => ' ' . esc_html__( 'Post name (post slug)', 'utouch' ),
                                'date'          => ' ' . esc_html__( 'Date', 'utouch' ),
                                'date_event'    => ' ' . esc_html__( 'Date Event', 'utouch' ),
                                'modified'      => ' ' . esc_html__( 'Last modified date', 'utouch' ),
                                'rand'          => ' ' . esc_html__( 'Random order', 'utouch' ),
                                'comment_count' => ' ' . esc_html__( 'Number of comments', 'utouch' )
                        )
						),
						array(
							'type'        => 'dropdown',
							'label'       => esc_html__( 'Order post', 'utouch' ),
							'name'        => 'order_list',
							'admin_label' => true,
							'options'     => array(
								'ASC'  => ' '.esc_html__( 'ASC', 'utouch' ),
								'DESC' => ' '.esc_html__( 'DESC', 'utouch' ),
							)
						),

						array(
							'type'        => 'toggle',
							'label'       => esc_html__( 'Load more button', 'utouch' ),
							'name'        => 'pagination',
							'description' => esc_html__( 'AJAX load more posts', 'utouch' )
						),
						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Wrapper class name', 'utouch' ),
							'name'        => 'wrap_class',
							'description' => esc_html__( 'Custom class for wrapper of the shortcode widget.', 'utouch' ),
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
							'name' => 'animate',
							'type' => 'animate'
						)
					),
				)
			)
		)
	);
}