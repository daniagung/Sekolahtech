<?php
/**
 * @package utouch-wp
 */

$atts = Utouch::get_var( 'kc_image_slder' );
extract( $atts );
$module_class = utouch_module_class( 'crumina-module-slider', $atts );

if ( 'yes' === $pagination ) {
	$module_class[] = 'pagination-bottom';
}

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">

	<div class="swiper-container slider-tripple-right-image"
		 data-show-items="1"
		 data-effect="coverflow"
		 data-speed="<?php echo esc_attr( $speed ) ?>"
		 data-autoplay="<?php echo esc_attr( $autoplay ) ?>"
		 data-centered-slider="false"
		 data-stretch="170" data-depth="195">
		<div class="swiper-wrapper">
			<?php foreach ( $slides as $slide_id ) {
				$image_full_width = wp_get_attachment_image_src( $slide_id, 'full' );
				$image_full       = $image_full_width[0];
				?>
				<div class="swiper-slide">
					<img src="<?php echo esc_url( $image_full ) ?>"
                         alt="<?php echo  esc_attr( get_post_meta( $slide_id, '_wp_attachment_image_alt', true ) ) ?>"
                         title="<?php echo esc_attr( get_the_title($slide_id) ) ?>">
				</div>
			<?php } ?>
		</div>
		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>
	</div>

</div>