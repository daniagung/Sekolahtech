<?php
/**
 * @package utouch-wp
 */

extract( $atts );
$autoplay = ('yes' === $atts['autoscroll']) ? $atts['time'] * 1000 : false;

$module_class = utouch_module_class( 'crumina-module-slider pagination-bottom', $atts );

if ( 'yes' === $dots ) {
	$module_class[] = 'pagination-bottom';
}

$img_width  = 100;
$img_height = 100;
$number_of_items = (int) $number_of_items;
?>
<div class="<?php echo esc_attr( implode( ' ', $module_class ) ) ?>">

    <div class="swiper-container " data-autoplay="<?php echo esc_attr($autoplay); ?>" data-show-items="<?php echo $number_of_items ? $number_of_items : 4; ?>">
		<div class="swiper-wrapper">
			<?php foreach ( $options as $option ) {
				$data_img = '';
				if ( 'image' === $option->media && $option->image > 0 ) {
					$img_link = wp_get_attachment_image( $option->image, 'full', false, $atts = array( 'width' => $img_width, 'height' => $img_height  ) );
					$data_img .= $img_link;

				} else {
					if ( empty( $option->icon ) || $option->icon == '__empty__' ) {
						$icon = 'et-trophy';
					}

					$data_img .= '<i class="utouch-icon ' . $option->icon . '"></i>';
				}


				?>
				<div class="swiper-slide">
					<div class="crumina-module crumina-info-box info-box--time-line">

						<div class="info-box-image" style="background-color: <?php echo esc_attr( $option->color ) ?>;">
							<?php echo( $data_img ) ?>
							<?php if ( 'yes' === $show_arrow ) { ?>
								<svg class="utouch-icon utouch-icon-dot-arrow time-line-arrow">
									<use xlink:href="#utouch-icon-dot-arrow"></use>
								</svg>

							<?php } ?>
						</div>

						<div class="info-box-content">
							<h6 class="timeline-year"
								style="color: <?php echo esc_attr( $option->color ) ?>"><?php echo esc_html( $option->year ) ?></h6>
							<h6 class="h6 info-box-title"><?php echo esc_html( $option->title ) ?></h6>
							<div class="info-box-text"><?php echo esc_html( $option->desc ) ?></div>
						</div>

					</div>
				</div>
			<?php } ?>

		</div>

		<!--Prev next buttons-->
		<?php if ( 'yes' === $arrows ) { ?>
			<div class="btn-slider-wrap navigation-center-bottom">


				<div class="btn-prev">
					<svg class="utouch-icon icon-hover utouch-icon-arrow-left-1">
						<use xlink:href="#utouch-icon-arrow-left-1"></use>
					</svg>
					<svg class="utouch-icon utouch-icon-arrow-left1">
						<use xlink:href="#utouch-icon-arrow-left1"></use>
					</svg>
				</div>

				<div class="btn-next">
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
</div>
<?php kc_js_callback( 'CRUMINA.initSwiper' ); ?>