<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'testimonial_slider' );
extract( $atts );

$module_class       = utouch_module_class( 'crumina-module-slider', $atts );
$arrows_pos_classes = array(
	'center'      => 'navigation-center-both-sides',
	'bottom_left' => 'navigation-bottom',
	'top_right'   => 'navigation-top',
	'bottom'      => 'navigation-bottom',
);
$module_class[]     = array_key_exists( $arrows_pos, $arrows_pos_classes ) ? $arrows_pos_classes[ $arrows_pos ] : '';
$module_class[]     = $custom_class;
$btn_wrap_class     = '';

if ( 'bottom_left' === $arrows_pos ) {
	$btn_wrap_class = 'btn-slider-wrap navigation-left-bottom';
} elseif ( 'top_right' === $arrows_pos ) {
	$btn_wrap_class = 'btn-slider-wrap navigation-top-right';
} elseif ( 'bottom' === $arrows_pos ) {
	$btn_wrap_class = 'btn-slider-wrap navigation-center-bottom';
}

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">

    <div class="swiper-container" data-effect="fade" data-autoplay="<?php echo esc_attr( $autoplay ) ?>"
         data-show-items="1">
        <div class="swiper-wrapper">

			<?php
			foreach ( $options as $option ) {
				$author_url = explode( '|', $option->author_link );
				?>
                <div class="swiper-slide">
                    <div class="crumina-module crumina-testimonial-item testimonial-item-quote-top">
                        <div class="quote" data-swiper-parallax="-100">
                            <svg class="utouch-icon utouch-icon-quotes">
                                <use xlink:href="#utouch-icon-quotes"></use>
                            </svg>
                        </div>

                        <h6 class="testimonial-text h6"
                            data-swiper-parallax="-300"><?php echo esc_html( $option->desc ) ?></h6>

                        <div class="author-info" data-swiper-parallax="-100">
                            <a href="<?php echo esc_url( $author_url[0] ) ?>"
                               target="<?php echo empty( $author_url[2] ) ? '_self' : $author_url[2] ?>"
                               class="h6 author-name"><?php echo esc_html( $option->name ) ?></a>
                            <div class="author-company"><?php echo esc_html( $option->position ) ?></div>
                        </div>
						<?php if ( ! empty( $option->stars ) ) { ?>
                            <ul class="rait-stars">
								<?php for ( $i = 1; $i <= $option->stars; $i ++ ) { ?>
                                    <li>
                                        <svg class="utouch-icon utouch-icon-star">
                                            <use xlink:href="#utouch-icon-star"></use>
                                        </svg>
                                    </li>
								<?php } ?>
								<?php for ( $i = $option->stars + 1; $i <= 5; $i ++ ) { ?>
                                    <li>
                                        <svg class="utouch-icon utouch-icon-lnr-star">
                                            <use xlink:href="#utouch-icon-lnr-star"></use>
                                        </svg>
                                    </li>
								<?php } ?>

                            </ul>
						<?php } ?>

                    </div>
                </div>

			<?php } ?>
        </div>


        <div class="slider-slides with-thumbs">
	        <?php foreach ( $options as $option ) {
		        if ( ! empty( $option->image ) ) {
			        $image_url = utouch_resize( wp_get_attachment_url( $option->image ), 61, 60, true );
			        ?>
                    <a href="#" class="slides-item">
                        <div class="testimonial-img-author">
                            <img src="<?php echo esc_url( $image_url ) ?>" alt="<?php echo esc_html( $option->name ) ?>">
                        </div>
                    </a>
		        <?php } else {
		            echo utouch_html_tag('a', array('class'=>'slides-item', 'style'=>'background-color:gray'),true);
                }
	        } ?>
        </div>


		<?php if ( 'yes' === $arrows && 'center' !== $arrows_pos ) { ?>
            <div class="<?php echo( $btn_wrap_class ) ?>">
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

	<?php if ( 'yes' === $arrows && 'center' === $arrows_pos ) { ?>
        <div class="<?php echo( $btn_wrap_class ) ?>">
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