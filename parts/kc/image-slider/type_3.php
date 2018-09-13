<?php
/**
 * @package utouch-wp
 */

$atts = Utouch::get_var( 'kc_image_slder' );
extract( $atts );
$module_class = utouch_module_class( 'crumina-module-slider', $atts );

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">

	<div class="swiper-container screenshots-item-bottom"
		 data-show-items="<?php echo esc_attr( $items_number ) ?>"
		 data-speed="<?php echo esc_attr( $speed ) ?>"
		 data-autoplay="<?php echo esc_attr( $autoplay ) ?>"
		 data-loop="true"
		 data-nospace="true"
		 data-autoheight="false"
	>
		<div class="swiper-wrapper">
			<?php foreach ( $slides as $slide_id ) {
				$image_full_width = wp_get_attachment_image_src( $slide_id, 'full' );
				$image_full       = $image_full_width[0];
				?>

				<div class="swiper-slide">
					<div class="screenshots-item style-2">
                        <a href="<?php echo esc_url( $image_full ) ?>" class=" js-zoom-image">
						<img src="<?php echo esc_url( $image_full ) ?>" alt="<?php echo  esc_attr( get_post_meta( $slide_id, '_wp_attachment_image_alt', true ) ) ?>"
                             title="<?php echo esc_attr( get_the_title($slide_id) ) ?>">
						<div class="overlay-standard overlay--blue-dark"></div>

                            <span class="expand">
							<svg class="utouch-icon utouch-icon-expand">
								<use xlink:href="#utouch-icon-expand"></use>
							</svg>
                                </span>
						</a>
					</div>
				</div>
			<?php } ?>

		</div>
	</div>

</div>