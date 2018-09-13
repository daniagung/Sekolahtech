<?php
/**
 * Include static files: javascript and css
 *
 * @package utouch.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}


if ( is_admin() ) {
	return;
}
global $post;
global  $wp_customize;

$my_theme = wp_get_theme();
$theme_version = $my_theme->get( 'Version' );
if (is_child_theme()){
	$my_theme = $my_theme->parent();
	$theme_version = $my_theme->get( 'Version' );
}


/**
 * Enqueue scripts and styles for the front end.
 */


// Theme core styles
wp_enqueue_style(
	'utouch-theme-style',
	get_template_directory_uri() . '/css/theme-styles.css',
	array(),$theme_version
	
);

wp_enqueue_style(
	'utouch-theme-blocks',
	get_template_directory_uri() . '/css/blocks.css',
	array( 'utouch-theme-style' ),
	$theme_version
);

wp_enqueue_style(
	'utouch-theme-plugins',
	get_template_directory_uri() . '/css/theme-plugins.css',
	array(),
	$theme_version
);
wp_enqueue_style(
	'utouch-theme-widgets',
	get_template_directory_uri() . '/css/widgets.css',
	array( 'utouch-theme-style' ),
	$theme_version
);

wp_enqueue_style(
	'utouch-color-scheme',
	get_template_directory_uri() . '/css/color-selectors.css',
	array(),
	$theme_version
);
wp_enqueue_style(
	'utouch-style',
	get_template_directory_uri() . '/style.css',
	array(),
	$theme_version
);

wp_enqueue_style(
	'swiper',
	get_template_directory_uri() . '/css/swiper.min.css',
	array(),
	'3.3.1'
);
wp_enqueue_style(
	'formstone-background',
	get_template_directory_uri() . '/css/formstone-background.css',
	array(),
	$theme_version
);
wp_enqueue_style(
	'tippy-css',
	get_template_directory_uri() . '/css/tippy.css',
	array(),
	'0.11.2'
);
wp_enqueue_style(
	'count',
	get_template_directory_uri() . '/css/count.css',
	array(),
	false
);




// Add font, used in the main stylesheet.
wp_enqueue_style(
	'utouch-theme-font',
	utouch_font_url(),
	array(),
	'1.0'
);

// Icons
wp_enqueue_style(
	'seo-icons',
	get_template_directory_uri() . '/css/seo-icons.css',
	array(),
	$theme_version
);
// Register only scripts.
wp_register_script(
	'isotope',
	get_template_directory_uri() . '/js/isotope.pkgd.min.js',
	array(),
	'3.0.4',
	true
);
wp_register_script(
	'isotope-packery',
	get_template_directory_uri() . '/js/packery-mode.pkgd.min.js',
	array( 'isotope' ),
	'2.0',
	true
);

wp_register_script( 'youtube-iframe-api', 'https://www.youtube.com/iframe_api', null, '1', true );

wp_register_script(
	'utouch-share-buttons',
	get_template_directory_uri() . '/js/sharer.min.js',
	array(),
	'0.3.2',
	true
);

wp_register_script(
	'chart-js',
	get_template_directory_uri() . '/js/chart.min.js',
	array(),
	'2.6',
	true
);
wp_register_script( 'utouch-timeline',
	get_template_directory_uri() . '/js/time-line.js',
	array( 'jquery', 'utouch-main-script' ),
	'1',
	true );

wp_enqueue_script( 'utouch-form-actions',
	get_template_directory_uri() . '/js/form-actions.js',
	array( 'jquery'),
	$theme_version,
	true );


wp_localize_script( 'utouch-form-actions', 'fwAjaxUrl', admin_url( 'admin-ajax.php' ) );
wp_enqueue_script(
	'swiper-slider',
	get_template_directory_uri() . '/js/swiper.jquery.min.js',
	array(),
	'1.1.0',
	true
);
wp_enqueue_script(
	'utouch-megamenu',
	get_template_directory_uri() . '/js/crum-mega-menu.js',
	array(),
	$theme_version,
	true
);

wp_enqueue_script(
	'utouch-plugins',
	get_template_directory_uri() . '/js/theme-plugins.js',
	array(),
	$theme_version,
	true
);
wp_enqueue_script(
	'fitvids',
	get_template_directory_uri() . '/js/fitvids.js',
	array( 'jquery' ),
	'1.1',
	true
);
wp_enqueue_script(
	'utouch-main-script',
	get_template_directory_uri() . '/js/main.js',
	array( 'jquery' ),
	$theme_version,
	true
);
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
if ( is_page_template( 'portfolio-template.php' ) ) {
	wp_enqueue_script( 'isotope' );
	wp_enqueue_script( 'isotope-packery' );
}
wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'isotope-packery' );
wp_enqueue_script(
	'tippy-js',
	get_template_directory_uri() . '/js/tippy.min.js',
	array(),
	'0.11.2',
	true
);
wp_register_script(
	'utouch-loadmore',
	get_template_directory_uri() . '/js/ajax-pagination.js',
	array( 'jquery' ),
	'',
	true
);
wp_register_script(
	'utouch_custom_loadmore',
	get_template_directory_uri() . '/js/ajax-loadmore.js',
	array( 'jquery' ),
	'',
	true
);
wp_enqueue_script(
	'jquery-frontend-helpers',
	get_template_directory_uri() . '/js/jquery.frontend.helpers.min.js',
	array(),
	'1.1.3',
	true
);
wp_enqueue_script(
	'velocity',
	get_template_directory_uri() . '/js/velocity.min.js',
	array(),
	'1.2.3',
	true
);
wp_enqueue_script(
	'plyr',
	get_template_directory_uri() . '/js/plyr.min.js',
	array(),
	'1.0.0',
	true
);
wp_enqueue_script(
	'tiltfx',
	get_template_directory_uri() . '/js/tiltfx.js',
	array(),
	false,
	true
);
wp_enqueue_script(
	'countdown',
	get_template_directory_uri() . '/js/jquery.countdown.min.js',
	array(),
	'2.1.0',
	true
);

if (isset($wp_customize) && $wp_customize->is_preview()  ) {


	wp_enqueue_script(
		'utouch_customizer',
		get_template_directory_uri() . '/js/customizer.js',
		array(),
		false,
		true
	);

}

$custom_js = ( function_exists( 'fw_get_db_customizer_option' ) ) ? fw_get_db_customizer_option( 'custom-js', '' ) : '';
if ( ! empty( $custom_js ) ) {
	$custom_js = 'jQuery( document ).ready(function($) {  ' . $custom_js . '  });';
	wp_add_inline_script( 'utouch-main-script', $custom_js );
}