<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$ext_instance = fw()->extensions->get( 'portfolio' );


wp_enqueue_script(
	'utouch-portfolio-likes',
	$ext_instance->locate_js_URI( 'likes' ),
	array( 'jquery' ),
	$ext_instance->manifest->get_version(),
	true
);

wp_enqueue_script( 'utouch-share-buttons',
	get_template_directory_uri() . '/js/sharer.min.js',
	array(),
	'0.5',
	true
);