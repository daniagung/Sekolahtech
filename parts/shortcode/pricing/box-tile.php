<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'pricing_box' );

$color = ! empty( $atts['primary_color'] ) ? $atts['primary_color'] : '#01a23c';
$item_class = array( 'crumina-module', ' crumina-pricing-tables-item', 'pricing-tables-item-standard' );
if ( ! empty( $atts['custom_class'] ) ) {
	$item_class[] = $atts['custom_class'];
}
$item_class[] = 'kc-css-'.$atts['_id'];
?>
<div class="<?php echo esc_attr( implode( ' ', $item_class ) ) ?>">
	<div class="main-pricing-content">
	<div class="pricing-thumb pricing-tables-icon">
		<?php if('image' === $atts['show_icon']){?>
		<img src="<?php echo esc_url($atts['image_header'])?>" alt="icon" class="icon-img">
		<?php }?>
		<?php if('icon' === $atts['show_icon']){?>
			<i class=" <?php echo esc_attr($atts['icon_header'])?>"></i>
		<?php }?>
	</div>
		<h2 class="h1 rate"><?php echo esc_html( $atts['currency_top'] ) ?><span class="price"
																				 data-annually="<?php echo esc_attr( $atts['price_year'] ) ?>"
																				 data-monthly="<?php echo esc_html( $atts['price_month'] ) ?>"
			><?php echo esc_attr( $atts['price'] ) ?></span><span class="sub-price rate"
																  data-annually="<?php echo esc_attr( $atts['sub_price_year'] ) ?>"
																  data-monthly="<?php echo esc_attr( $atts['sub_price_month'] ) ?>"><?php echo esc_attr( $atts['sub_price'] ) ?></span
			><?php echo esc_html( $atts['currency_bottom'] ) ?></h2>
		<h5 class="pricing-title"><?php echo esc_html( $atts['title'] ) ?></h5>

		<div class="pricing-line " style="background-color: <?php echo esc_attr( $color ) ?>"></div>
		<div class="pricing-description pricing-tables-position"><?php echo( $atts['desc'] ) ?> </div>
		<?php echo do_shortcode( $atts['content'] ) ?>
		<div class="sub-description"><?php echo esc_html( $atts['sub_desc'] ) ?></div>
	</div>

	<div class="bg-pricing-content" style="background-color: <?php echo esc_attr( $color ) ?>">
		<?php if ( 'yes' === $atts['show_button'] ) { ?>

			<a href="<?php echo esc_html( $atts['button_link'] ) ?>" class="h6 title price-link"
			   data-monthly="<?php echo esc_url( $atts['button_month_link'] ) ?>"
			   data-annually="<?php echo esc_url( $atts['button_year_link'] ) ?>"><?php echo esc_html( $atts['button_text'] ) ?></a>
		<?php } ?>
	</div>

</div>
