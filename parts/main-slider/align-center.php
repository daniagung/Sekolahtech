<?php
/**
 * @package utouch-wp
 */
global $allowedtags;

$slide        = Utouch::get_var( 'swiper_slide' );
$bg_color     = utouch_akg( 'extra/bg-color', $slide, '#f7f9f9' );
$bg_image     = utouch_akg( 'extra/bg-image/url', $slide, '' );
$title        = utouch_akg( 'title', $slide, '' );
$subtitle     = utouch_akg( 'desc', $slide, '' );
$image_layout = utouch_akg( 'extra/image_layout', $slide, 'content' );

$slide_class = 'dark' === utouch_akg( 'extra/text-color', $slide, 'dark' ) ? 'main-slider-bg-light' : 'main-slider-bg-dark';
$buttons     = utouch_akg( 'extra/buttons', $slide, array() );

$title_tag    = 'h1';
$subtitle_tag = 'h6';

if ( 'background' === $image_layout ) {
	$bg_image     = wp_get_attachment_image_url( $slide['attachment_id'], 'full' );
	$overlay_html = '<div class="overlay" style="background-color:' . esc_attr( $bg_color ) . '; opacity:0.3"></div>';
} else {
	$overlay_html = '';
}

$slide_style = '';


if ( ! empty( $bg_color ) ) {
	$slide_style .= 'background-color: ' . esc_attr( $bg_color ) . ';';
}
if ( ! empty( $bg_image ) ) {
	$slide_style .= 'background-image:url(' . esc_attr( utouch_akg( 'extra/bg-image/url', $slide, '' ) ) . ');';
}

if ( 'yes' === utouch_akg( 'extra/title_decoration', $slide, 'no' ) ) {
	$title_tag .= ' with-decoration ';
}

?>
<div class="swiper-slide <?php echo esc_attr( $slide_class ) ?>" style="<?php echo esc_attr( $slide_style ) ?>">
	<?php echo( $overlay_html ) ?>
	<div class="container">
		<div class="row table-cell">

			<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12">

				<div class="slider-content align-center ">
					<?php if ( ! empty( $title ) ) { ?>
						<h2 class="slider-content-title <?php echo esc_attr( $title_tag ) ?>"
							data-swiper-parallax="-100"><?php echo wp_kses( $title, $allowedtags ) ?><?php
							if ( 'yes' === utouch_akg( 'extra/title_decoration', $slide, 'no' ) ) {
								?>

								<svg class="first-decoration utouch-icon utouch-icon-arrow-left">
									<use xlink:href="#utouch-icon-arrow-left"></use>
								</svg>

								<svg class="second-decoration utouch-icon utouch-icon-arrow-left">
									<use xlink:href="#utouch-icon-arrow-left"></use>
								</svg>
								<?php
							}
							?></h2>
					<?php }
					if ( ! empty( $subtitle ) ) { ?>
						<div class="slider-content-text <?php echo esc_attr( $subtitle_tag ) ?>"
							 data-swiper-parallax="-200"><?php echo do_shortcode( $subtitle ) ?></div>
					<?php } ?>

					<?php if ( count( $buttons ) > 0 ) { ?>
						<div class="main-slider-btn-wrap" data-swiper-parallax="-300">
							<?php foreach ( $buttons as $button ) {
								Utouch_Helper_Html::new_button( $button );


							} ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php if ( isset( $slide['attachment_id'] ) && ! empty( $slide['attachment_id'] ) ) { ?>
					<div class="slider-thumb" data-swiper-parallax="-400" data-swiper-parallax-duration="600">

						<?php echo wp_get_attachment_image( $slide['attachment_id'], 'full' ); ?>
					</div>
				<?php } ?>

			</div>

		</div>
	</div>
</div>
