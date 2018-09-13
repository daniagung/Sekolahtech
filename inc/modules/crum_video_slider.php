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

//$images_path = get_template_directory_uri() . '/images/admin/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_video_slider' => array(

				'name' => esc_html__(' Video Slider', 'utouch'),
				'description' => esc_html__(' ', 'utouch'),
				'icon' => 'kc-utouch-icon kc-utouch-icon-video-slider',
				'category' => esc_html__('Sliders','utouch'),
				'priority'  => 350,
//				'live_editor' => $live_tmpl.'kc_carousel_images.php',
				'params' => array(

					'general' => array(
						array(
							'type'        	=> 'text',
							'label'     	=> esc_html__( 'Preview image size', 'utouch' ),
							'name' 		 	=> 'img_size',
							'description' 	=> esc_html__( 'Set the image size eq to: 240x200, 100x100, etc.', 'utouch' ),
							'value'       	=> 'full',
						),
						array(
							'type' 			=> 'number_slider',
							'label' 		=> esc_html__( 'Speed', 'utouch' ),
							'name' 			=> 'speed',
							'description' 	=> esc_html__( 'Set the speed at which auto playing sliders will transition (in second).', 'utouch' ),
							'value'			=> 500,
							'admin_label'	=> true,
							'options' => array(
								'min' => 100,
								'max' => 1500,
								'show_input' => true
							)
						),
						array(
							'name' => 'stretch',
							'label' => 'Stretch (px)',
							'type' => 'text',  // USAGE TEXT TYPE
							'value' => '40', // remove this if you do not need a default content
							'description' => 'Stretch size in px',
						),
						array(
							'name' => 'depth',
							'label' => 'Depth (px)',
							'type' => 'text',  // USAGE TEXT TYPE
							'value' => '210', // remove this if you do not need a default content
							'description' => 'Depth size in px',
						),
						array(
							'type'			=> 'toggle',
							'label'			=> esc_html__( 'Pagination', 'utouch' ),
							'name'			=> 'pagination',
							'description'	=> esc_html__( 'Show the pagination.', 'utouch' ),
							'value'			=> 'yes'
						),
						array(
							'type'			=> 'toggle',
							'label'			=> esc_html__( 'Auto height', 'utouch' ),
							'name'			=> 'auto_height',
							'description'	=> esc_html__( 'Add height to div "owl-wrapper-outer" so you can use diffrent heights on slides. Use it only for one item per page setting.', 'utouch' ),
						),
						array(
							'type'			=> 'toggle',
							'label'			=> esc_html__( 'Auto Play', 'utouch' ),
							'name'			=> 'auto_play',
							'description'	=> esc_html__( 'The carousel automatically plays when site loaded.', 'utouch' ),
							'value'			=> 'yes'
						),
						array(
							'type'			=> 'number_slider',
							'label'			=> esc_html__( 'Time delay', 'utouch' ),
							'name'			=> 'delay',
							'description'	=> esc_html__( 'The delay time before moving on to a new slide', 'utouch' ),
							'value'			=> '8',
							'options' => array(
								'min' => 1,
								'max' => 15,
								'show_input' => true
							),
							'relation'  	=> array(
								'parent'	=> 'auto_play',
								'show_when' => 'yes'
							)
						),

						array(
							'type' => 'text',
							'label' => esc_html__( 'Wrapper class name', 'utouch' ),
							'name' => 'wrap_class',
							'description' => esc_html__( 'Custom class for wrapper of the shortcode widget.', 'utouch' )
						),
					),
					'items' => array(
						array(
							'type'        => 'group',
							'label'       => esc_html__( 'Slider items', 'utouch' ),
							'name'        => 'options',
							'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding slider element.', 'utouch' ),
							'options'     => array( 'add_text' => esc_html__( 'Add new slider item', 'utouch' ) ),
							'params'      => array(
								array(
									'type'        => 'text',
									'name'        => 'video_link',
									'label'       => esc_html__( 'Video link', 'utouch' ),
									'value'       => '',
									'admin_label' => true
								),

								array(
									'name'     => 'image',
									'label'    => esc_html__( 'Preview image', 'utouch' ),
									'type'     => 'attach_image',
								),

							),
						),

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