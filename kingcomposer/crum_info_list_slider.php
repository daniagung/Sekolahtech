<?php

extract( $atts );
$module_class   = utouch_module_class( 'crumina-module-info-list', $atts );
$module_class[] = 'crumina-module-slider';
$module_class[] = 'custom-color';
$module_class[] = 'c-black';
?>

<div class="<?php echo implode( ' ', $module_class ) ?>">
	<div class="row">
		<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
			<div class="swiper-container" data-effect="fade">
				<div class="swiper-wrapper">

					<?php foreach ( $options as $option ) { ?>
						<div class="swiper-slide">
                            <?php echo wp_get_attachment_image( $option->image, 'full', false, $atts = array( 'data-swiper-parallax' => '-200' ) ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-1 col-md-7 col-sm-12 col-xs-12">
			<div class="slider-slides slider-slides--round-text">
				<?php
				for ( $i = 1, $j = count( $options ); $i <= $j; $i ++ ) {
					$option = $options[ $i ];
					?>
					<div class="slides-item">
						<div class="number"><?php echo( $i ) ?></div>
						<div class="crumina-module crumina-heading ">
							<h5 class="heading-title"><?php echo esc_html( $option->title ) ?></h5>
							<div class="heading-text"><?php echo esc_html( $option->desc ) ?></div>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>
<?php kc_js_callback( 'CRUMINA.initSwiper' ); ?>