<?php
/**
 * @package utouch-wp
 */
$image_id = Utouch::get_var('image_gallery_image_id');
$image_url = wp_get_attachment_image_url( $image_id, 'full' );
?>
<div>
    <a href="<?php echo esc_url( $image_url ) ?>" class=" js-zoom-image">
	<img src="<?php echo esc_url( $image_url ) ?>"
         alt="<?php echo  esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ) ?>"
         title="<?php echo esc_attr( get_the_title($image_id) ) ?>">
	<div class="overlay-standard overlay--blue-dark"></div>

        <span class="expand">
		<svg class="utouch-icon utouch-icon-expand">
			<use xlink:href="#utouch-icon-expand"></use>
		</svg>
            </span>
	</a>
</div>
