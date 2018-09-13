<?php
/*
Extension Name: Info Box module
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
			'crum_info_box_slider' => array(
				'name'          => esc_html__( 'Info box slider', 'utouch' ),
				'title'         => 'Info box slider settings',
				'icon'          => 'kc-utouch-icon kc-utouch-icon-info-box-slider',
				'category'      => esc_html__( 'Sliders', 'utouch' ),
				'wrapper_class' => 'clearfix',
				'params'        => array(
					'general' => array(
						array(
							'name'        => 'show_arrow',
							'label'       => 'Show item arrow',
							'type'        => 'toggle',
							'value'       => 'yes',
							'description' => 'Show arrows between slider items',
						),
						array(
							'name'        => 'number_of_items',
							'label'       => esc_html__( 'Items per page', 'utouch' ),
							'type'        => 'number_slider',
							'options'     => array(
								'min'        => 1,
								'max'        => 5,
								'show_input' => true
							),
							'value'       => '4',
							'description' => 'Number of items displayed on one screen',
						),
						array(
							'name'        => 'arrows',
							'label'       => esc_html__( 'Show Arrows', 'utouch' ),
							'type'        => 'toggle',
							'value'       => 'yes',
							'description' => esc_html__( 'Previous/ Next Slider buttons', 'utouch' ),
						),
						array(
							'name'        => 'dots',
							'label'       => esc_html__( 'Show Dots', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Pagination dots', 'utouch' ),
							'value'       => 'yes',
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
							),
						),
					),
					'items'   => array(
						array(
							'type'        => 'group',
							'label'       => esc_html__( 'Slider items', 'utouch' ),
							'name'        => 'options',
							'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding slider element.', 'utouch' ),
							'options'     => array( 'add_text' => esc_html__( 'Add new slider item', 'utouch' ) ),
							'params'      => array(

								array(
									'type'        => 'text',
									'name'        => 'year',
									'label'       => esc_html__( 'Year', 'utouch' ),
									'value'       => '2017',
									'admin_label' => true
								),
								array(
									'type'        => 'text',
									'name'        => 'title',
									'label'       => esc_html__( 'Title', 'utouch' ),
									'value'       => 'Text Title',
									'admin_label' => true
								),
								array(
									'type'        => 'text',
									'name'        => 'desc',
									'label'       => esc_html__( 'Description', 'utouch' ),
									'value'       => 'Description',
									'admin_label' => true
								),
								array(
									'type'        => 'select',
									'label'       => esc_html__( 'Picture type', 'utouch' ),
									'name'        => 'media',
									'admin_label' => true,
									'options'     => array(
										'icon'  => esc_html__( 'Icon', 'utouch' ),
										'image' => esc_html__( 'Image', 'utouch' )
									),
									'value'       => 'icon'
								),
								array(
									'name'     => 'image',
									'label'    => esc_html__( 'Upload Image', 'utouch' ),
									'type'     => 'attach_image',
									'relation' => array(
										'parent'    => 'media',
										'show_when' => array( 'image' )
									)
								),
								array(
									'name'        => 'icon',
									'label'       => esc_html__( 'Select Icon', 'utouch' ),
									'type'        => 'icon_picker',
									'description' => esc_html__( 'Select icon display in box', 'utouch' ),
									'value'       => 'et-trophy',
									'relation'    => array(
										'parent'    => 'media',
										'hide_when' => array( 'image' )
									)
								),
								array(
									'name'  => 'color',
									'label' => 'Color',

									'type' => 'color_picker',  // USAGE COLOR_PICKER TYPE

									'description' => 'Color for icon background color and year text color',
								),
							),
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