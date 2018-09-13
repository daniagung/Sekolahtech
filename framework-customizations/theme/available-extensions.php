<?php defined( 'FW' ) or die();

$extensions = array(

    'update-checker' => array(
        'display'     => true,
        'parent'      => null,
        'name'        => __( 'Update checker', 'utouch' ),
        'description' => __( 'Update checker.', 'utouch' ),
        'thumbnail'   => get_template_directory_uri() . '/images/update-checker-extension-thumb.png',
        'download'    => array(
            'source' => 'custom',
            'opts'   => array(
	            'remote' => 'https://up.crumina.net/extensions/versions/',
            ),
        ),
    ),

);