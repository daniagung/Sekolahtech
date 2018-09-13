<?php
/*
Extension Name: Video module
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

//$live_tmpl   = get_template_directory() . '/kingcomposer/live_editor/';
$admin_images_path = get_template_directory_uri() . '/images/admin/';

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'crum_video' => array(
				'name'     => esc_html__( 'Video Player', 'utouch' ),
				'icon'     => 'kc-icon-play',
				'category' => esc_html__( 'Media', 'utouch' ),
				'params'   => array(
					'general' => array(
						array(
							'name'    => 'preview_type',
							'label'   => 'Preview type',
							'type'    => 'radio_image',
							'options' => array(
								'text'   => $admin_images_path . 'video-player/option-1.png',
								'image'  => $admin_images_path . 'video-player/option-2.png',
								'device' => $admin_images_path . 'video-player/option-3.png',
								'cloud'  => $admin_images_path . 'video-player/option-4.png',
							),
							'value'   => 'text',
						),
						array(
							'name'        => 'link',
							'label'       => 'Video link',
							'type'        => 'text',
							'value'       => 'https://www.youtube.com/watch?v=wnJ6LuUFpMo',
							'description' => 'Link to youtube/vimeo video',
						),
						array(
							'name'        => 'title',
							'label'       => 'Title',
							'type'        => 'text',  // USAGE TEXT TYPE
							'value'       => '', // remove this if you do not need a default content
							'description' => 'Text with player button',
							'relation'    => array(
								'parent'    => 'preview_type',
								'show_when' => 'text',
							),
						),
						array(
							'name'     => 'bg_image',
							'label'    => 'Background image',
							'type'     => 'attach_image',
							'relation' => array(
								'parent'    => 'preview_type',
								'show_when' => array( 'image', 'device' ),
							),
						),
						array(
							'name'        => 'image_width',
							'label'       => 'Image width',
							'type'        => 'text',
							'value'       => '',
							'description' => 'Leave empty for real image width',
							'relation'    => array(
								'parent'    => 'preview_type',
								'show_when' => array( 'image' ),
							),
						),
						array(
							'name'        => 'image_height',
							'label'       => 'Image height',
							'type'        => 'text',
							'value'       => '',
							'description' => 'Leave empty for real image height',
							'relation'    => array(
								'parent'    => 'preview_type',
								'show_when' => array( 'image' ),
							),
						),
					),
					'styling' => array(
						array(
							'type' => 'css',
							'name' => 'custom_css',
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