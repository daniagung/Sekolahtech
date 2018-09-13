<?php
if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Settings and options for online preview Customizer changes.
 *
 * @package Utouch
 */

global  $wp_customize;

if (isset($wp_customize) && $wp_customize->is_preview() ) {

	function _customizer_remove_sections( $wp_customize ) {

		$wp_customize->remove_section( 'background_image' );

	}
	add_action( 'customize_register' , '_customizer_remove_sections' );
}

if (defined('FW')):

	function _utouch_register_partial_refresh_stunning($wp_customize, $setting_name, $fallback_refresh = false){
		$wp_customize->get_setting($setting_name)->transport = 'postMessage';
		$wp_customize->selective_refresh->add_partial( $setting_name, array(
			'selector' => '#stunning-section',
			'container_inclusive' => true,
			'render_callback' => 'utouch_stunning_header_partial_template',
			'fallback_refresh' => $fallback_refresh,
		) );
	}

	function _utouch_register_partial_refresh_header($wp_customize, $setting_name, $fallback_refresh = false){
		$wp_customize->get_setting($setting_name)->transport = 'postMessage';
		$wp_customize->selective_refresh->add_partial( $setting_name, array(
			'selector' => '#site-header',
			'container_inclusive' => true,
			'render_callback' => 'utouch_header_partial_template',
			'fallback_refresh' => $fallback_refresh,
		) );
	}

	function _utouch_register_partial_refresh_footer($wp_customize, $setting_name, $fallback_refresh = false){
		$wp_customize->get_setting($setting_name)->transport = 'postMessage';
		$wp_customize->selective_refresh->add_partial( $setting_name, array(
			'selector' => '#site-footer',
			'container_inclusive' => true,
			'render_callback' => 'utouch_footer_partial_template',
			'fallback_refresh' => $fallback_refresh,
		) );
	}

	/**
	 * @param WP_Customize_Manager $wp_customize
	 * @internal
	 */
	function _action_customizer_live_fw_options( $wp_customize ) {
		// Header
		//header design
		$wp_customize->get_setting( 'fw_options[logo-title]' )->transport    = 'postMessage';
		$wp_customize->get_setting( 'fw_options[logo-subtitle]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[header_bg_color]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[header-text-color]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[dropdown-style]' )->transport = 'postMessage';

		//stunning header

		$wp_customize->get_setting('fw_options[stunning_text_color]')->transport = 'postMessage';
		$wp_customize->get_setting('fw_options[stunning_link_color]')->transport = 'postMessage';

		$wp_customize->get_setting('fw_options[stunning_background_color]')->transport = 'postMessage';
//		$wp_customize->get_setting('fw_options[stunning_overlay_color]')->transport = 'postMessage';

		//footer
		$wp_customize->get_setting('fw_options[footer_text_color]')->transport = 'postMessage';
		$wp_customize->get_setting('fw_options[footer_title_color]')->transport = 'postMessage';

		$wp_customize->get_setting( 'fw_options[footer_bg_image]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[footer_bg_cover]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[footer_bg_color]' )->transport = 'postMessage';

		$wp_customize->get_setting( 'fw_options[footer_copyright]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[copyright_bg_color]' )->transport = 'postMessage';
		$wp_customize->get_setting( 'fw_options[copyright_text_color]' )->transport = 'postMessage';



		//selective refresh
		if(isset($wp_customize->selective_refresh)){
			//stunning
			_utouch_register_partial_refresh_stunning($wp_customize,'fw_options[stunning-show]',true);
			_utouch_register_partial_refresh_stunning($wp_customize,'fw_options[stunning_bg_options]',false);
			_utouch_register_partial_refresh_stunning($wp_customize,'fw_options[stunning_overlay_color]',false);

			_utouch_register_partial_refresh_stunning($wp_customize,'fw_options[stunning_title]',false);
			_utouch_register_partial_refresh_stunning($wp_customize,'fw_options[stunning_category]',false);
			_utouch_register_partial_refresh_stunning($wp_customize,'fw_options[stunning_breadcrumbs]',false);
			_utouch_register_partial_refresh_stunning($wp_customize,'fw_options[stunning_author]',false);
			_utouch_register_partial_refresh_stunning($wp_customize,'fw_options[stunning_additional]',false);

			//header
			_utouch_register_partial_refresh_header($wp_customize,'fw_options[sections-top-bar]',false);
			_utouch_register_partial_refresh_header($wp_customize,'fw_options[decorative-line]',false);
			_utouch_register_partial_refresh_header($wp_customize,'fw_options[sticky_header]',false);
			_utouch_register_partial_refresh_header($wp_customize,'fw_options[logo-image]',false);
			_utouch_register_partial_refresh_header($wp_customize,'fw_options[logo-retina]',false);
			_utouch_register_partial_refresh_header($wp_customize,'fw_options[search-icon]',false);


			//footer
			_utouch_register_partial_refresh_footer($wp_customize,'fw_options[site-description]',false);
			_utouch_register_partial_refresh_footer($wp_customize,'fw_options[scroll_top_icon]',false);

		}

		add_action( 'customize_preview_init', '_action_customizer_live_fw_options_preview' );

	}

	add_action( 'customize_register', '_action_customizer_live_fw_options' );

	/**
	 * @internal
	 */
	function _action_customizer_live_fw_options_preview() {
		$translation_array = array( 'templateUrl' => get_template_directory_uri() );
		wp_enqueue_script(
			'utouch-customizer',
			get_template_directory_uri() .'/js/customizer.js',
			array( 'jquery','customize-preview' ),
			fw()->theme->manifest->get_version(),
			true
		);
		wp_localize_script( 'utouch-customizer', 'theme_vars', $translation_array );
	}
endif;
