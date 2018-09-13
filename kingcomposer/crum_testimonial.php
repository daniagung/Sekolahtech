<?php
/** @var array $atts */

Utouch::set_var('testimonial_item',$atts);
get_template_part('parts/kc/testimonial-item/'.utouch_akg('layout',$atts,'author-top'));
return;