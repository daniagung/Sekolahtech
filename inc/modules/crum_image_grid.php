<?php
/*
Extension Name: Buttons
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

$images_path = get_template_directory_uri() . '/images/admin/';
if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_image_grid' => array(
				'name'     => esc_html__( 'Image grid', 'utouch' ),
				'icon'     => 'kc-utouch-icon kc-utouch-icon-image-grid',
				'category' => esc_html__( 'Media', 'utouch' ),
				'params'   => array(
					'general' => array(

						array(
							'name'  => 'order',
							'label' => 'Order',
							'type'    => 'select',
							'options' => array(
								'DESC' => esc_html__( 'Descending', 'utouch' ),
								'ASC'  => esc_html__( 'Ascending', 'utouch' ),
							),
							'value'       => 'DESC',
							'description' => esc_html__( 'Designates the ascending or descending order of items', 'utouch' ),
						),
						array(
							'name'  => 'orderby',
							'label' => 'Order by',
							'type'    => 'select',
							'options' => array(
								'date'          => esc_html__( 'Order by date', 'utouch' ),
								'author'        => esc_html__( 'Order by author.', 'utouch' ),
								'modified'      => esc_html__( 'Order by last modified date.', 'utouch' ),
							),
							'value'       => 'date',
							'description' => esc_html__( 'Sort retrieved items by parameter', 'utouch' ),
						),
						array(
							'name'        => 'categories',
							'label'       => 'Attachment categories',
							'type'        => 'multiple',
							'options'     => utouch_get_attachment_categories(),
							'description' => 'Leave empty for all categories',
						),
						array(
							'name' => 'exclude',
							'label' => 'Exclude selected',
							'type' => 'toggle',
							'value' => 'no',
							'description' => 'Show all categories except that selected in "Categories" option',
						),
						array(
							'name'        => 'per_page',
							'label'       => 'Per page',
							'type'        => 'text',
							'value'       => '10',
							'description' => 'How much pictures show initialy.',
						),
					),
					'styling' => array(

						array(
							'type'  => 'css',
							'label' => esc_html__( 'css', 'utouch' ),
							'name'  => 'custom_css',
						),
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