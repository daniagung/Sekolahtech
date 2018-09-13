<?php
/**
 * @package utouch-wp
 */


extract( $atts );
if('full' === $img_size){
	$preview_size = array(false,false);
}else{
	$preview_size = explode( 'x', $img_size );
}

$autoplay     = $auto_play ? $delay * 1000 : false;

$module_class = utouch_module_class( 'crumina-module-slider', $atts );

$module_class[] = 'slider-3-items';
if ( 'yes' === $pagination ) {
	$module_class[] = 'pagination-bottom';
}
?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
	<div class="swiper-container "
		 data-show-items="2"
		 data-effect="coverflow"
		 data-speed="<?php echo esc_attr( $speed ) ?>"
		 data-centered-slider="true" data-nospace="true" data-stretch="<?php echo esc_attr( $stretch ) ?>"
		 data-depth="<?php echo esc_attr( $depth ) ?>"
		 data-autoplay="<?php echo ($autoplay) ?>">
		<div class="swiper-wrapper">
			<?php foreach ( $options as $slide ) {
				$image_url = wp_get_attachment_image_url( $slide->image, 'full' );
				$image_url = utouch_resize( $image_url, $preview_size[0], $preview_size[1] );
				?>
				<div class="swiper-slide">
					<div class="crumina-module crumina-our-video">
						<div class="video-thumb with-border-r">
							<img src="<?php echo esc_url( $image_url ) ?>" alt="video">
							<a href="<?php echo esc_url( $slide->video_link ) ?>"
							   class="video-control js-popup-iframe">
								<img src="<?php echo get_template_directory_uri() ?>/img/play.png" alt="play">
							</a>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>

	</div>
</div>

<?php kc_js_callback( 'CRUMINA.initSwiper' ); ?>