<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'testimonial_item' );
extract( $atts );

$module_class   = utouch_module_class( 'crumina-testimonial-item', $atts );
$module_class[] = 'testimonial-item-arrow';

$author_url = explode( '|', $author_link );
if ( ! empty( $image ) ) {
	$image_url = utouch_resize( wp_get_attachment_url( $image ), 60, 60 );
} else {
	$image_url = '';
}
?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
    <div class="author-info-wrap">
		<?php if ( $image_url ) { ?>
            <div class="testimonial-img-author">
                <img src="<?php echo esc_url( $image_url ) ?>" alt="<?php echo esc_html( $name ) ?>">
            </div>
		<?php } ?>
            <div class="author-info">
                <a href="<?php echo esc_url( $author_url[0] ) ?>"
                   target="<?php echo empty( $author_url[2] ) ? '_self' : $author_url[2] ?>"
                   class="h6 author-name"><?php echo esc_html( $name ) ?></a>
                <div class="author-company"><?php echo esc_html( $position ) ?></div>
            </div>
        </div>

        <h6 class="testimonial-text h6"><?php echo esc_html( $desc ) ?></h6>

        <ul class="rait-stars">
			<?php for ( $i = 1; $i <= $stars; $i ++ ) { ?>
                <li>
                    <svg class="utouch-icon utouch-icon-star">
                        <use xlink:href="#utouch-icon-star"></use>
                    </svg>
                </li>
			<?php } ?>
			<?php for ( $i = $stars + 1; $i <= 5; $i ++ ) { ?>
                <li>
                    <svg class="utouch-icon utouch-icon-lnr-star">
                        <use xlink:href="#utouch-icon-lnr-star"></use>
                    </svg>
                </li>
			<?php } ?>

        </ul>
    </div>
