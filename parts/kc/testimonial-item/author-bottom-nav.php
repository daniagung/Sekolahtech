<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'testimonial_item' );
extract( $atts );

$module_class = utouch_module_class( 'crumina-testimonial-item', $atts );
$module_class[] = 'testimonial-item-quote-top';


$author_url = explode( '|', $author_link );
?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
	<div class="quote" data-swiper-parallax="-100">
		<svg class="utouch-icon utouch-icon-quotes">
			<use xlink:href="#utouch-icon-quotes"></use>
		</svg>
	</div>

	<h6 class="testimonial-text h6"
		 data-swiper-parallax="-300"><?php echo esc_html( $desc ) ?></h6>

	<div class="author-info" data-swiper-parallax="-100">
		<a href="<?php echo esc_url( $author_url[0] ) ?>"
		   target="<?php echo empty( $author_url[2] ) ? '_self' : $author_url[2] ?>"
		   class="h6 author-name"><?php echo esc_html( $name ) ?></a>
		<div class="author-company"><?php echo esc_html( $position ) ?></div>
	</div>

</div>
