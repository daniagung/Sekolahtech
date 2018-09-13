<?php
/**
 * @package utouch-wp
 */

$atts = Utouch::get_var( 'kc_image_slder' );
extract( $atts );
$module_class   = utouch_module_class( 'crumina-module-slider', $atts );
$module_class[] = 'crumina-module-image-slider';
$module_class[] = 'slider--full-width';
$module_class[] = 'screenshots-slider-style1';
$module_class[] = 'navigation-center-both-sides';


$swiper_class = array( 'swiper-container' );
if ( 'yes' === utouch_akg('add_device',$atts,'') ) {
	$module_class[] = 'slider-with-device';
}
if ( 'yes' === $pagination ) {
	$module_class[] = 'pagination-bottom';
}

$add_btn_class = '';
if ( 'yes' === $arrows_bg ) {
	$add_btn_class = 'with-bg rounded';
}
?>
<div class="<?php echo implode( ' ', $module_class ) ?>">

	<div class="<?php echo implode( ' ', $swiper_class ) ?>"
		 data-show-items="<?php echo esc_attr( $items_number ) ?>"
		 data-speed="<?php echo esc_attr( $speed ) ?>"
		 data-autoplay="<?php echo esc_attr( $autoplay ) ?>"
		 data-centered-slider="true">
		<div class="swiper-wrapper">
			<?php foreach ( $slides as $slide_id ) {
				$image_full_width = wp_get_attachment_image_src( $slide_id, 'full' );
				$image_full       = $image_full_width[0];
				?>
				<div class="swiper-slide">
					<div class="screenshot-item">
						<a href="<?php echo esc_url( $image_full ) ?>" class="js-zoom-image">
							<img src="<?php echo esc_url( $image_full ) ?>" alt="<?php echo  esc_attr( get_post_meta( $slide_id, '_wp_attachment_image_alt', true ) ) ?>"
                                 title="<?php echo esc_attr( get_the_title($slide_id) ) ?>">
						</a>
					</div>
				</div>

			<?php } ?>

		</div>
		<!-- If we need pagination -->

	</div>
	<div class="swiper-pagination"></div>
	<?php if ( 'yes' === $arrows ) { ?>
		<div class="">
			<div class="btn-prev <?php echo esc_attr( $add_btn_class ) ?>">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-left-1">
					<use xlink:href="#utouch-icon-arrow-left-1"></use>
				</svg>
				<svg class="utouch-icon utouch-icon-arrow-left1">
					<use xlink:href="#utouch-icon-arrow-left1"></use>
				</svg>
			</div>

			<div class="btn-next <?php echo esc_attr( $add_btn_class ) ?>">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1">
					<use xlink:href="#utouch-icon-arrow-right-1"></use>
				</svg>
				<svg class="utouch-icon utouch-icon-arrow-right1">
					<use xlink:href="#utouch-icon-arrow-right1"></use>
				</svg>
			</div>
		</div>
	<?php } ?>
</div>
