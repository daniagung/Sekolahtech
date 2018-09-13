<?php

/**
 * @package utouch-wp
 */
extract( $atts );
$module_class = utouch_module_class( 'crumina-module-subscribe-form', $atts );

if ( defined('ES_PLUGIN_NAME') || !empty($shortcode) ) {
    Utouch::set_var( 'crum_subscribe_form', $atts );
    get_template_part( 'parts/kc/subscribe-form/' . utouch_akg( 'layout', $atts, '' ) );

    Utouch::delete_var( 'crum_subscribe_form' );
} else {
    if ( current_user_can( 'administrator' ) ) {
        $es_link = utouch_html_tag( 'a', array(
            'href'  => get_admin_url( null, 'themes.php?page=tgmpa-install-plugins' ),
            'style' => 'color:#0083ff;'
        ), esc_html__( ' Email subscribers plugin ', 'utouch' ) );
    } else {
        $es_link = esc_html__( ' Email subscribers plugin ', 'utouch' );
    }
    echo utouch_html_tag( 'div', array( 'class' => 'h4' ), esc_html__( 'Install & activate', 'utouch' )
    .
    $es_link
    . esc_html__( 'to use this shortcode.', 'utouch' ) );
}