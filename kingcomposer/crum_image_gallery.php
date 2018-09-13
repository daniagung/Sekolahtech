<?php
/**
 * @package utouch-wp
 */

extract( $atts );
/**
 * @var int $cols_count
 */

$module_class = utouch_module_class( 'crumina-screenshots', $atts );

$atts['images'] = explode( ',', $images );

Utouch::set_var( 'crum_image_gallery', $atts );
get_template_part( 'parts/kc/image-gallery/' . utouch_akg( 'layout', $atts, 'default' ) );
Utouch::delete_var( 'crum_image_gallery' );
