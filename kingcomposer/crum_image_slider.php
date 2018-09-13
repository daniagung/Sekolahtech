<?php
/**
 * @package utouch-wp
 */
/**
 * @var array $atts
 */

$atts['autoplay'] = $atts['auto_play'] ? $atts['delay'] * 1000 : false;
$atts['slides'] = explode( ',', $atts['images']);

Utouch::set_var('kc_image_slder',$atts);
get_template_part('parts/kc/image-slider/'.$atts['type']);
return;
?>
