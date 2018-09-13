<?php

$output = $css_data = $css = '';

$cont_class         = array( 'kc-row-container' );
$element_attributes = array();

extract( $atts );

$css_classes = apply_filters( 'kc-el-class', $atts );

$css_classes[] = 'kc_row';

if ( $css != '' ) {
	$css_classes[] = $css;
}

if ( ! empty( $atts['row_class'] ) ) {
	$css_classes[] = $atts['row_class'];
}

if ( ! empty( $atts['full_height'] ) ) {
	if ( $atts['content_placement'] == 'middle' ) {
		$element_attributes[] = 'data-kc-fullheight="middle-content"';
	} else {
		$element_attributes[] = 'data-kc-fullheight="true"';
	}

}

if ( empty( $atts['column_align'] ) ) {
	$atts['column_align'] = 'center';
}

if ( ! empty( $atts['equal_height'] ) ) {
	$element_attributes[] = 'data-kc-equalheight="true"';
	$element_attributes[] = 'data-kc-equalheight-align="' . $atts['column_align'] . '"';
}


if ( isset( $atts['use_container'] ) && $atts['use_container'] == 'yes' ) {
	$cont_class[] = ' kc-container';
}

if ( ! empty( $atts['container_class'] ) ) {
	$cont_class[] = ' ' . $atts['container_class'];
}

if ( ! empty( $atts['row_text_color'] ) ) {
	$css_classes[] = 'custom-color';
	$css_data .= 'color: ' . esc_attr( $atts['row_text_color'] ) . ';';
}


if ( ! empty( $atts['css'] ) ) {
	$css_classes[] = $atts['css'];
}

/**
 *Check video background
 */
if( $atts['video_bg'] === 'yes' )
{
	wp_enqueue_script('youtube-iframe-api');
	$video_bg_url = $atts['video_bg_url'];

	if( empty($video_bg_url)) $video_bg_url = 'https://www.youtube.com/watch?v=dOWFVKb2JqM';

	$has_video_bg = kc_youtube_id_from_url( $video_bg_url );

	if( !empty( $has_video_bg ) )
	{
		$css_classes[] = 'kc-video-bg';
		$element_attributes[] = 'data-kc-video-bg="' . esc_attr( $video_bg_url ) . '"';
		$css_data .= 'position: relative;';

		if( isset( $atts['video_options'] ) && !empty( $video_options ) ){
			$element_attributes[] = 'data-kc-video-options="loop=1&' . esc_attr( trim( $video_options )) . '"';
		}
		if( isset( $atts['video_mute'] ) && !empty( $atts['video_mute'] ) )
			$element_attributes[] = 'data-kc-video-mute="' . esc_attr( $atts['video_mute'] ) . '"';
	}
}

$row_animation         = isset( $atts['row_animation'] ) ? $atts['row_animation'] : '';
$data_animation_images = '';
if ( ! empty( $row_animation ) ) {
	$css_classes[]         = 'crumina-' . $row_animation;
	$data_animation_images = utouch_animated_images_collection( $row_animation );
}


if ( ! empty( $atts['row_id'] ) ) {
	$element_attributes[] = 'id="' . esc_attr( $atts['row_id'] ) . '"';
}


if ( empty( $has_video_bg ) ) {
	if ( ! empty( $atts['parallax'] ) ) {

		$element_attributes[] = 'data-kc-parallax="true"';

		if ( $atts['parallax'] == 'yes-new' ) {
			$bg_image_id = $atts['parallax_image'];
			$bg_image    = wp_get_attachment_image_src( $bg_image_id, 'full' );
			$css_data .= "background-image:url('" . $bg_image[0] . "');";
		}

	}
}

$column_wrap_class = array( 'kc-wrap-columns' );
if ( 'yes' === $row_content_bottom ) {
	$column_wrap_class[] = 'row-content-bottom';
}

if ( ! empty( $row_style ) && 'classic' !== $row_style ) {
	$css_classes[] = 'section-bg-' . $row_style;

	if ( ! empty( $hide_decor_part ) ) {
		$css_classes[] = "not-$hide_decor_part-element";
	}
}

if ( 'curved' === $row_style && ! empty( $curve_style ) ) {
	$css_classes[] = 'bg-rounded-' . $curve_style;
}

$css_class            = implode( ' ', $css_classes );
$element_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if ( ! empty( $css_data ) ) {
	$element_attributes[] = 'style="' . esc_attr( trim( $css_data ) ) . '"';
}

$output .= '<section ' . implode( ' ', $element_attributes ) . '>';

$output .= '<div class="' . esc_attr( implode( ' ', $cont_class ) ) . '">';

$output .= '<div class="' . implode( ' ', $column_wrap_class ) . '">' . do_shortcode( str_replace( 'kc_row#', 'kc_row', $content ) ) . '</div>';
$output .= '</div>';
if ( ! empty( $data_animation_images ) ) {
	$output .= '<div class="images">';
	foreach ( $data_animation_images as $key => $value ) {
		$output .= '<img src="' . esc_attr( $value ) . '" alt="animation" class="' . esc_attr( $key ) . '">';
	}
	$output .= '</div>';
}

$output .= '</section>';

echo( $output );
