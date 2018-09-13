<?php

$atts['social_class'] = Utouch::get_var('crum_team_slider_social_class');
Utouch::set_var( 'crum_team_member', $atts );
echo '<div class="swiper-slide">';
get_template_part( 'parts/kc/crum-team/' . Utouch::get_var( 'crum_team_slider_layout' ) );
echo '</div>';
Utouch::delete_var( 'crum_team_member' );