<?php
/**
 * @package utouch-wp
 */

$event         = Utouch::get_event( get_the_ID() );
$padding_class = '';
$builder_meta  = get_post_meta( get_the_ID(), 'kc_data', true );
if ( isset( $builder_meta['mode'] ) && 'kc' === $builder_meta['mode'] ) {
	$padding_class = 'kc-container';
}

$tab_title = '';
if(!empty($event->workshop_title)){
	$tab_title .= utouch_html_tag('h3',array(),esc_html( $event->workshop_title ));
}
if(!empty($event->workshop_desc)){
	$tab_title .= utouch_html_tag('p',array('class'=>'weight-bold'),esc_html( $event->workshop_desc ));
}


if(!empty($tab_title)){
	echo utouch_html_tag('div',array('class'=>'wordshop-title '.esc_attr($padding_class)),$tab_title);
}

the_content();

?>
