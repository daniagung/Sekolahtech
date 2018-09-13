<?php
/**
 * @package utouch-wp
 */
extract( $atts );
$bg_image_url = wp_get_attachment_image_url( $bg_image, 'full' );
$bg_image_url = utouch_resize( $bg_image_url, 360, 730 );

$zoom_image_url = wp_get_attachment_image_url( $zoom_image, 'full' );
$zoom_image_url = utouch_resize( $zoom_image_url, 350, 350 );
?>
<div class="crumina-module crumina-zoom-image">
	<img src="<?php echo esc_url( $bg_image_url ) ?>" alt="smartphone">
	<div class="zoom-round-img">
		<img src="<?php echo esc_url( $zoom_image_url ) ?>" alt="zoom">
	</div>
</div>
