<?php
/*
Extension Name: Embedded + Google maps
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

$all_styles    = _utouch_google_map_custom_styles();
$style_options = array();
foreach ( $all_styles as $key => $value ) {
	$style_options[ $key ] = $value[0];
}

if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
	// Buttons
		array(
			'crum_maps' => array(
				'name'        => esc_html__( 'Maps module', 'utouch' ),
				'description' => esc_html__( 'Show google maps with embed', 'utouch' ),
				'icon'        => 'kc-icon-map',
				'category'    => esc_html__( 'Media', 'utouch' ),
				'admin_view'  => 'gmaps',
				'params'      => array(
					'general' => array(
						array(
							'name'        => 'random_id',
							'label'       => '',
							'type'        => 'random',
							'description' => '',
						),
						array(
							'name'        => 'google_js',
							'label'       => esc_html__( 'Show JS Google Map', 'utouch' ),
							'type'        => 'toggle',
							'description' => esc_html__( 'Extended options section for show javascript google map.', 'utouch' ),
						),
						array(
							'type'        => 'textarea',
							'label'       => esc_html__( 'Map Embed Code', 'utouch' ),
							'name'        => 'map_location',
							'description' => wp_kses( __( 'Go to <a href="https://www.google.com/maps/" target=_blank>Google Maps</a> and search your Location. Click on menu near search text => Share or embed map => Embed map. Next copy iframe to this field', 'utouch' ), array(
								'a' => array(
									'href'   => true,
									'target' => true,
								),
							) ),
							'relation'    => array(
								'parent'    => 'google_js',
								'hide_when' => 'yes'
							)
						),
						array(
							'type'        => 'text',
							'name'        => 'api_key',
							'label'       => esc_html__( 'API KEY for google maps service', 'utouch' ),
							'description' => '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key">' . esc_html__( 'Instruction to create API key', 'utouch' ) . '</a>',
							'relation'    => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'type'     => 'textarea',
							'label'    => esc_html__( 'Type Address', 'utouch' ),
							'name'     => 'address',
							'relation' => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'map_zoom',
							'label'    => esc_html__( 'Map zoom', 'utouch' ),
							'type'     => 'number_slider',
							'options'  => array(
								'min'        => 1,
								'max'        => 21,
								'show_input' => true
							),
							'value'    => 14,
							'relation' => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'type'     => 'select',
							'name'     => 'map_style',
							'label'    => esc_html__( 'Select map style', 'utouch' ),
							'options'  => $style_options,
							'relation' => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'type'     => 'select',
							'name'     => 'map_type',
							'label'    => esc_html__( 'Map Type', 'utouch' ),
							'options'  => array(
								'roadmap'   => esc_html__( 'Roadmap', 'utouch' ),
								'terrain'   => esc_html__( 'Terrain', 'utouch' ),
								'satellite' => esc_html__( 'Satellite', 'utouch' ),
								'hybrid'    => esc_html__( 'Hybrid', 'utouch' )
							),
							'relation' => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'disable_scrolling',
							'type'        => 'toggle',
							'label'       => esc_html__( 'Disable zoom on scroll', 'utouch' ),
							'description' => esc_html__( 'Prevent the map from zooming when scrolling until clicking on the map', 'utouch' ),
							'relation'    => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'name'        => 'custom_marker',
							'type'        => 'toggle',
							'label'       => esc_html__( 'Custom map marker', 'utouch' ),
							'description' => esc_html__( 'Replace default map marker with custom image', 'utouch' ),
							'relation'    => array(
								'parent'    => 'google_js',
								'show_when' => 'yes'
							)
						),
						array(
							'name'     => 'marker',
							'label'    => esc_html__( 'Marker Image', 'utouch' ),
							'desc'     => esc_html__( 'Add marker image', 'utouch' ),
							'type'     => 'attach_image',
							'relation' => array(
								'parent'    => 'custom_marker',
								'show_when' => 'yes'
							)
						),
						array(
							'type'  => 'text',
							'name'  => 'map_height',
							'label' => esc_html__( 'Map Height (px)', 'utouch' ),
							'value' => 350
						),
						array(
							'name'        => 'custom_class',
							'label'       => esc_html__( 'Extra class', 'utouch' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'utouch' ),
						)
					)
				)
			),
		)
	);
}