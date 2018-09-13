<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
} ?>
<?php if ( isset( $data['slides'] ) ):
	global $allowedtags;
	$attributes      = array();
	$autoplay        = utouch_akg( 'settings/extra/autoplay', $data, 0 );
	$full_height     = utouch_akg( 'settings/extra/full_height', $data, 'off' );
	$slide_labels    = utouch_akg( 'settings/extra/slide_labels', $data, 'on' );
	$slide_arrows    = utouch_akg( 'settings/extra/slide_arrows', $data, 'on' );
	$slider_infinity = utouch_akg( 'settings/extra/slider_infinity', $data, 'on' );


	if ( 0 !== $autoplay ) {
		$attributes[] = 'data-autoplay="' . esc_attr( $autoplay * 1000 ) . '"';
	}
	if ( 'off' === $slider_infinity ) {
		$attributes[] = 'data-loop="false"';
	}
	$additional_class = 'on' === $full_height ? 'js-full-window' : '';
	$additional_class .= 'off' === $slide_labels ? ' no-labels' : '';

	$pagination = '';
	$pag_styles = '';
	$i          = 0;
	?>
	<div class="crumina-module-slider">
		<div class=" crumina-module-slider crumina-module crumina-module-slider slider-tabs-vertical-line">
			<div class="swiper-container <?php echo esc_attr( $additional_class ); ?>"
				 data-show-items="1" <?php echo implode( ' ', $attributes ); ?>>

				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">
					<!-- Slides -->
					<?php foreach ( $data['slides'] as $slide ) {

						$i ++;

						$bg_color = utouch_akg( 'extra/bg-color', $slide, '#f7f9f9' );
						$bg_image = utouch_akg( 'extra/bg-image/url', $slide, '' );
						$title    = utouch_akg( 'title', $slide, '' );
						$desc     = utouch_akg( 'desc', $slide, '' );
						$subtitle = utouch_akg( 'extra/sub-title', $slide, '' );

						$slide_class = 'dark' === utouch_akg( 'extra/text-color', $slide, 'dark' ) ? 'main-slider-bg-light c-black' : 'main-slider-bg-dark c-white';
						$buttons     = utouch_akg( 'extra/buttons', $slide, array() );


						$title_tag = 'h2';
						$desc_tag  = 'h6';


						$slide_style = '';

						if ( ! empty( $bg_image ) ) {
							$slide_style .= 'background-image:url(' . esc_attr( utouch_akg( 'extra/bg-image/url', $slide, '' ) ) . ');';
						}
						if ( ! empty( $bg_color ) ) {
							$slide_style .= 'background-color: ' . esc_attr( $bg_color ) . ';';
						}

						if ( 'yes' === utouch_akg( 'extra/title_decoration', $slide, 'no' ) ) {
							$title_tag .= ' with-decoration ';
						}

                        $pag_classes = ($i === 1) ? 'slides-item slide-active' : 'slides-item';
						$pag_styles .= '#second_slide_' . $i . '_pagination span:before{background-color:' . $bg_color . ';} #second_slide_' . $i . '_pagination.slide-active span{ background-color:' . $bg_color . '; }';
						$pagination .= '<a href="#" id="second_slide_' . $i . '_pagination" class="'.$pag_classes.'">
						<span class="round" style=" background-color:' . $bg_color . ';color: ' . $bg_color . ';"></span>' . ( $i < 10 ? ( '0' . $i ) : $i ) .
						               '</a > ';
						?>
						<!-- Slides -->

						<div class="swiper-slide  <?php echo esc_attr( $slide_class ) ?> custom-color"
							 style="<?php echo( $slide_style ) ?>">
							<div class="container">
								<div class="row">
									<div class="col-lg-4 col-lg-offset-1 col-md-5 col-md-offset-0 col-sm-12 col-xs-12">

										<?php if ( isset( $slide['attachment_id'] ) && ! empty( $slide['attachment_id'] ) ) { ?>
											<div class="slider-tabs-vertical-thumb">
												<?php echo wp_get_attachment_image( $slide['attachment_id'], 'full' ); ?>
											</div>
										<?php } ?>
									</div>

									<div class="col-lg-6 col-lg-offset-1 col-md-7 col-md-offset-0 col-sm-12 col-xs-12">
										<div class="crumina-module crumina-heading ">
											<?php if ( ! empty( $subtitle ) ) { ?>
												<h6 class="heading-sup-title"><?php echo esc_html( $subtitle ) ?></h6>
											<?php } ?>
											<?php if ( ! empty( $title ) ) { ?>
												<h2 class="heading-title"><?php echo esc_html( $title ) ?></h2>
											<?php } ?>
											<?php if ( ! empty( $desc ) ) { ?>
												<div class="heading-text"><?php echo esc_html( $desc ) ?></div>
											<?php } ?>
										</div>

										<?php if ( count( $buttons ) > 0 ) { ?>

											<?php foreach ( $buttons as $button ) {
												Utouch_Helper_Html::new_button( $button );
											} ?>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>

					<?php } ?>

				</div>
				<?php
				wp_add_inline_style( 'utouch-style', $pag_styles );
				?>
				<div class="slider-slides slider-slides--vertical-line">
					<?php echo( $pagination ) ?>
				</div>

				<!--Pagination tabs-->
			</div>
			<!-- ... End Main Slider -->

		</div>
	</div>
<?php endif; ?>