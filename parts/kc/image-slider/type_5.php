<?php
/**
 * @package utouch-wp
 */

$atts = Utouch::get_var( 'kc_image_slder' );
$atts['add_device'] = 'yes';
Utouch::set_var('kc_image_slder',$atts);
get_template_part('parts/kc/image-slider/type_2');