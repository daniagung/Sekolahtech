<?php
/**
 * @package utouch-wp
 */

/**
 * @var array $atts
 */
Utouch::set_var('crum_utouch_video',$atts);
get_template_part('parts/kc/video/'. utouch_akg('preview_type',$atts,'text'));
Utouch::delete_var('crum_utouch_video');