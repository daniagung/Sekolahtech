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
	$slider_wrapper_bg = utouch_akg( 'settings/extra/slider-bg-color', $data, '' );

	if ( ! empty( $slider_wrapper_bg ) ) {
		$attributes[] = 'style="background-color:' . $slider_wrapper_bg . '"';
	}
	if ( 0 !== $autoplay ) {
		$attributes[] = 'data-autoplay="' . esc_attr( $autoplay * 1000 ) . '"';
	}
	if ( 'off' === $slider_infinity ) {
		$attributes[] = 'data-loop="false"';
	}

	$additional_class = 'on' === $full_height ? 'js-full-window' : '';
	$additional_class .= 'off' === $slide_labels ? ' no-labels' : '';
	?>

<div class="crumina-module-slider">
	<div class="swiper-container main-slider navigation-center-both-sides <?php echo esc_attr( $additional_class ); ?>"
		 data-effect="fade" data-parallax="true" <?php echo implode( ' ', $attributes ); ?>>

		<!-- Additional required wrapper -->
		<div class="swiper-wrapper">
			<!-- Slides -->
			<?php foreach ( $data['slides'] as $slide ) {
				Utouch::set_var( 'swiper_slide', $slide );
				$bg_color     = utouch_akg( 'extra/bg-color', $slide, '#f7f9f9' );
				$bg_image     = utouch_akg( 'extra/bg-image/url', $slide, '' );
				$title        = utouch_akg( 'title', $slide, '' );
				$subtitle     = utouch_akg( 'desc', $slide, '' );
				$image_layout = utouch_akg( 'extra/image_layout', $slide, 'content' );

				$slide_class = 'dark' === utouch_akg( 'extra/text-color', $slide, 'dark' ) ? 'main-slider-bg-light c-black' : 'main-slider-bg-dark c-white';
				$buttons     = utouch_akg( 'extra/buttons', $slide, array() );
				$slide_class .= 'alignright' === $align ? ' thumb-left' : '';

				$column_class = ( 'center' === $align ) ? 'slider-content-fullwidth align-center col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12' : 'slider-content-half-width table-cell ';

				if ( 'center' === $align ) {
					$title_tag    = 'h1';
					$subtitle_tag = 'h6';
				} else {
					$title_tag    = 'h2';
					$subtitle_tag = 'h6';
				}
				if ( 'background' === $image_layout ) {
					$bg_image     = wp_get_attachment_image_url( $slide['attachment_id'], 'full' );
					$overlay_html = '<div class="overlay" style="background-color:' . esc_attr( $bg_color ) . '; opacity:0.3"></div>';
				} else {
					$overlay_html = '';
				}

				$slide_style = '';

				if ( ! empty( $bg_image ) ) {
					$slide_style .= 'background-image:url(' . esc_attr( utouch_akg( 'extra/bg-image/url', $slide, '' ) ) . ');';
				}
				if ( ! empty( $bg_color ) ) {
					$slide_style .= 'background-color: ' . esc_attr( $bg_color ) . '';
				}

				if ( 'yes' === utouch_akg( 'extra/title_decoration', $slide, 'no' ) ) {
					$title_tag .= ' with-decoration ';
				}

				$align = utouch_akg( 'extra/text-align', $slide, 'center' );
				get_template_part( 'parts/main-slider/align', $align );
				continue;

				?>
				<!-- Slides -->



			<?php } ?>

		</div>


		<?php if ( ( count( $data['slides'] ) > 1 ) && ( $slide_arrows !== 'off' ) ) { ?>
			<!--Prev next buttons-->
			<div class="btn-prev with-bg">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-left-1">
					<use xlink:href="#utouch-icon-arrow-left-1"></use>
				</svg>
				<svg class="utouch-icon utouch-icon-arrow-left1">
					<use xlink:href="#utouch-icon-arrow-left1"></use>
				</svg>
			</div>

			<div class="btn-next with-bg">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1">
					<use xlink:href="#utouch-icon-arrow-right-1"></use>
				</svg>
				<svg class="utouch-icon utouch-icon-arrow-right1">
					<use xlink:href="#utouch-icon-arrow-right1"></use>
				</svg>
			</div>
		<?php } ?>
		<!--Pagination tabs-->
	</div>
	<!-- ... End Main Slider -->
</div>
<?php endif; ?>