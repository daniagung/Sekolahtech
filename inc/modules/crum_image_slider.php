<?php
/*
Extension Name: Vertical slider
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
			'crum_image_slider' => array(

				'name'        => esc_html__( ' Image Slider', 'utouch' ),
				'description' => esc_html__( ' ', 'utouch' ),
				'icon'        => 'kc-icon-icarousel',
				'category'    => esc_html__('Sliders','utouch'),
				'priority'    => 350,
				'params'      => array(

					'general' => array(
						array(
							'name'  => 'type',
							'label' => 'Slider type',

							'type'    => 'radio_image',  // USAGE RADIO TYPE
							'options' => array(    // REQUIRED
								'type_1' => $images_path . 'image-slider/option-1.png',
								'type_2' => $images_path . 'image-slider/option-2.png',
								'type_5' => $images_path . 'image-slider/option-5.png',
								'type_3' => $images_path . 'image-slider/option-3.png',
								'type_4' => $images_path . 'image-slider/option-4.png',
							),

							'value' => 'type_1', // remove this if you do not need a default content
						),

						array(
							'type'        => 'attach_images',
							'label'       => esc_html__( 'Images', 'utouch' ),
							'name'        => 'images',
							'description' => esc_html__( 'Select images from media library.', 'utouch' ),
							'admin_label' => true
						),

						array(
							'type'        => 'dropdown',
							'label'       => esc_html__( 'Onclick event', 'utouch' ),
							'name'        => 'onclick',
							'options'     => array(
								'none'     => esc_html__( 'None', 'utouch' ),
								'lightbox' => esc_html__( 'Open on lightbox', 'utouch' ),
							),
							'description' => esc_html__( 'Select the click event when users click on an image.', 'utouch' )
						),
						array(
							'type'        => 'number_slider',
							'label'       => esc_html__( 'Speed', 'utouch' ),
							'name'        => 'speed',
							'description' => esc_html__( 'Set the speed at which auto playing sliders will transition (in second).', 'utouch' ),
							'value'       => 500,
							'admin_label' => true,
							'options'     => array(
								'min'        => 100,
								'max'        => 1500,
								'show_input' => true
							)
						),
						array(
							'type'        => 'number_slider',
							'label'       => __( 'Items per slide', 'utouch' ),
							'name'        => 'items_number',
							'description' => __( 'The number of items displayed per slide (not apply for auto-height).', 'utouch' ),
							'value'       => '3',
							'options'     => array(
								'min' => 1,
								'max' => 10
							)
						),
						array(
							'type'        => 'number_slider',
							'label'       => __( 'Items On Tablet?', 'utouch' ),
							'name'        => 'tablet',
							'value'       => 2,
							'options'     => array(
								'min'        => 1,
								'max'        => 10,
								'show_input' => true
							),
							'description' => __( 'Display number of items per each slide (Tablet Screen)','utouch' )

						),
						array(
							'type'        => 'number_slider',
							'label'       => __( 'Items On Smartphone?', 'utouch' ),
							'name'        => 'mobile',
							'value'       => 1,
							'options'     => array(
								'min'        => 1,
								'max'        => 10,
								'show_input' => true
							),
							'description' => __( 'Display number of items per each slide (Mobile Screen)' ,'utouch')

						),

						array(
							'type'        => 'toggle',
							'label'       => esc_html__( 'Pagination', 'utouch' ),
							'name'        => 'pagination',
							'description' => esc_html__( 'Show the pagination.', 'utouch' ),
							'value'       => 'yes'
						),
						array(
							'type'        => 'toggle',
							'label'       => esc_html__( 'Arrows', 'utouch' ),
							'name'        => 'arrows',
							'description' => esc_html__( 'Show the navigation arrows.', 'utouch' ),
							'value'       => 'yes',
							'relation'    => array(
								'parent'    => 'type',
								'show_when' => 'type_2',
							),
						),
						array(
							'type'     => 'toggle',
							'label'    => esc_html__( 'Arrows with blue background', 'utouch' ),
							'name'     => 'arrows_bg',
							'value'    => 'no',
							'relation' => array(
								'parent'    => 'type',
								'show_when' => 'type_2',
							),
						),
						array(
							'type'        => 'toggle',
							'label'       => esc_html__( 'Auto height', 'utouch' ),
							'name'        => 'auto_height',
							'description' => esc_html__( 'Add height to div "owl-wrapper-outer" so you can use diffrent heights on slides. Use it only for one item per page setting.', 'utouch' ),
						),
						array(
							'type'        => 'toggle',
							'label'       => esc_html__( 'Auto Play', 'utouch' ),
							'name'        => 'auto_play',
							'description' => esc_html__( 'The carousel automatically plays when site loaded.', 'utouch' ),
							'value'       => 'yes'
						),
						array(
							'type'        => 'number_slider',
							'label'       => esc_html__( 'Time delay', 'utouch' ),
							'name'        => 'delay',
							'description' => esc_html__( 'The delay time before moving on to a new slide', 'utouch' ),
							'value'       => '8',
							'options'     => array(
								'min'        => 1,
								'max'        => 15,
								'show_input' => true
							),
							'relation'    => array(
								'parent'    => 'auto_play',
								'show_when' => 'yes'
							)
						),


						array(
							'type'        => 'text',
							'label'       => esc_html__( 'Wrapper class name', 'utouch' ),
							'name'        => 'wrap_class',
							'description' => esc_html__( 'Custom class for wrapper of the shortcode widget.', 'utouch' )
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