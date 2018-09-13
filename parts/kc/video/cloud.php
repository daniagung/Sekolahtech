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

$module_class = utouch_module_class( 'crumina-our-video', $atts );
$module_class[] = 'video-with-cloud';

$theme_uri = get_template_directory_uri();
?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
	<div class="video-thumb">
		<img src="<?php echo ($theme_uri) ?>/img/thumb-hand.png" alt="video">
		<a href="<?php echo esc_url( $link ) ?>" class="video-control js-popup-iframe">
			<img src="<?php echo ($theme_uri) ?>/img/play.png" alt="play">
		</a>
	</div>
	<img class="cloud" src="<?php echo ($theme_uri) ?>/img/clouds23.png" alt="cloud">
	<img class="hand" src="<?php echo ($theme_uri) ?>/img/hand.png" alt="hand">
</div>


