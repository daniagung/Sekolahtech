<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
return array(
	/**
	 * Array for demos
	 */
	'demos'              => array(
	),
	'plugins'            => array(
		array(
			'name'         => esc_attr__( 'King Composer', 'utouch' ),
			'slug'         => 'kingcomposer',
		),
		array(
			'name'         => esc_attr__( 'Frontend Editor', 'utouch' ),
			'slug'         => 'kc_pro',
			'source'       => 'http://kingcomposer.com/downloads/kc_pro.zip', // The plugin source
		),
		array(
			'name'         => esc_attr__( 'Email Subscribers', 'utouch' ),
			'slug'         => 'email-subscribers',
		),
		array(
			'name'         => esc_attr__( 'Media category management', 'utouch' ),
			'slug'         => 'wp-media-category-management',
		),
	),
	'theme_id'           => 'utouch',
	'child_theme_source' => 'http://up.crumina.net/demo-data/utouch/utouch-child.zip',
	'has_demo_content'   => true
);
