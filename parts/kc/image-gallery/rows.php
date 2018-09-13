<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'crum_image_gallery' );
extract( $atts );

$module_class = utouch_module_class( 'screenshots-gallery', $atts );
?>

<div class="<?php echo implode( ' ', $module_class ) ?>">
    <div class="gallery-popup gallery gallery-columns-<?php echo esc_attr( $cols_count ) ?>">
		<?php foreach ( $images as $image_id ) {
			$image_url   = wp_get_attachment_image_url( $image_id, 'full' );
			$image_thumb = wp_get_attachment_image_url( $image_id, 'medium' );
			?>
            <div class="gallery-item" data-mh="gallery-popup-row">
                <div class="screenshots-item">
                    <a href="<?php echo esc_url( $image_url ) ?>">
                        <img src="<?php echo esc_url( $image_thumb ) ?>"
                             alt="<?php echo  esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ) ?>"
                             title="<?php echo esc_attr( get_the_title($image_id) ) ?>">
                        <div class="overlay-standard overlay--blue-dark"></div>
                        <span class="expand"><svg class="utouch-icon utouch-icon-expand"><use xlink:href="#utouch-icon-expand"></use></svg></span>
                    </a>
                </div>
            </div>
		<?php } ?>
    </div>
</div>