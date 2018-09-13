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

$module_class = utouch_module_class( 'play-with-title', $atts );

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
	<a href="<?php echo esc_url( $link ) ?>" class="video-control js-popup-iframe">
		<img src="<?php echo get_template_directory_uri() ?>/img/play.png" alt="play">
	</a>
	<h6 class="play-title"><?php echo esc_html( $title ) ?></h6>
</div>
