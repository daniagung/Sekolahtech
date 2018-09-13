<?php
/**
 * @package utouch-wp
 */

$image_attributes = $image_hover_attributes = array();

$height = utouch_akg( 'height', $atts, '' );
$width  = utouch_akg( 'width', $atts, '' );

$img_id = utouch_akg( 'client_image', $atts, '' );

$img     = wp_get_attachment_image_src( $img_id, 'full' );
$img_url = utouch_resize( $img[0], $width, $height, true );

$img_hover_id = utouch_akg( 'client_hover_image', $atts, '' );

$img_hover     = wp_get_attachment_image_src( $img_hover_id, 'full' );
$img_hover_url = utouch_resize( $img_hover[0], $width, $height, true );

$image_attributes[] = 'alt="' . esc_attr( get_post_meta( $img_id, '_wp_attachment_image_alt', true ) ) . '"';
$image_attributes[] = 'title="' . esc_attr( get_the_title( $img_id ) ) . '"';

$image_hover_attributes[] = 'alt="' . esc_attr( get_post_meta( $img_hover_id, '_wp_attachment_image_alt', true ) ) . '"';
$image_hover_attributes[] = 'title="' . esc_attr( get_the_title( $img_hover_id ) ) . '"';

$button_link = kc_parse_link( utouch_akg( 'link', $atts, '' ) );

$button_href   = isset( $button_link['url'] ) ? $button_link['url'] : '#';
$button_title  = ! empty( $button_link['title'] ) ? $button_link['title'] : '';
$button_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';

$module_class = utouch_module_class( 'crumina-clients-module', $atts );

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
    <a class="clients-item" href="<?php echo esc_url( $button_href ) ?>"
       target="<?php echo esc_attr( $button_target ) ?>" title="<?php echo esc_attr( $button_title ) ?>">
	<span class="clients-images">
		<img src="<?php echo esc_url( $img_url ) ?>" <?php echo implode( ' ', $image_attributes ); ?> >
		<img src="<?php echo esc_url( $img_hover_url ) ?>"
             class="hover" <?php echo implode( ' ', $image_hover_attributes ); ?>>
	</span>
    </a>
</div>
