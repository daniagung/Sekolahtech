<?php
/** @var array $atts */
$atts['autoplay'] = 'yes' === $atts['autoscroll'] ? $atts['time'] * 1000 : false;

Utouch::set_var('testimonial_slider',$atts);
get_template_part('parts/kc/testimonial-slider/'.utouch_akg('layout',$atts,'author-top'));
return;