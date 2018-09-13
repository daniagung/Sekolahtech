<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$manifest = array();

$manifest['id'] = 'utouch';

$manifest['supported_extensions'] = array(
	'slider'         => array(),
	'events'         => array(),
	'breadcrumbs'    => array(),
	'megamenu'       => array(),
	'portfolio'      => array(),
	'sidebars'       => array(),
	'backups'        => array(),
	'analytics'      => array(),
	'forms'          => array(),
	'update-checker' => array(),

);
$manifest['requirements']         = array(
	'wordpress'  => array(
		'min_version' => '4.8',
	),
	'extensions' => array(
		'megamenu'       => array(),
		'sidebars'       => array(),
		'forms'          => array(),
		'update-checker' => array(),
	)

);
