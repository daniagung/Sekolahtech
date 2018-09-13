<?php
/**
 * @package utouch-wp
 */
/**
 * @var string $preview_type
 * @var string $link
 * @var string $title
 * @var int $bg_image
 * @var int $image_width
 * @var int $image_height
 */

$atts = Utouch::get_var( 'crum_utouch_video' );
extract( $atts );

$module_class = utouch_module_class( 'crumina-smartphone-video', $atts );

$image_url = wp_get_attachment_image_url( $bg_image, 'full' );
$image_url = utouch_resize( $image_url, 695, 395,true );

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
	<div class="video-thumb">
		<img src="<?php echo esc_url( $image_url ) ?>" alt="video">
		<a href="<?php echo esc_url( $link ) ?>" class="video-control js-popup-iframe">
			<img src="<?php echo get_template_directory_uri() ?>/img/play.png" alt="play">
		</a>
	</div>
</div>

