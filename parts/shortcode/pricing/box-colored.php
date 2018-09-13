<?php
/**
 * @package utouch-wp
 */
$atts  = Utouch::get_var( 'pricing_box' );
$color = ! empty( $atts['primary_color'] ) ? $atts['primary_color'] : '#01a23c';
$item_class = array( 'crumina-module', ' crumina-pricing-tables-item', 'pricing-tables-item-colored' );
$item_class[] = 'kc-css-'.$atts['_id'];
if ( ! empty( $atts['custom_class'] ) ) {
	$item_class[] = $atts['custom_class'];
}
?>

<div class="<?php echo esc_attr( implode( ' ', $item_class ) ) ?>" style="background-color: <?php echo esc_attr( $color ) ?>" data-mh="pricing-item">
	<h2 class="h1 rate"><?php echo esc_html( $atts['currency_top'] ) ?><span class="price"
																			 data-annually="<?php echo esc_attr( $atts['price_year'] ) ?>"
																			 data-monthly="<?php echo esc_html( $atts['price_month'] ) ?>"
		><?php echo esc_attr( $atts['price'] ) ?></span><span class="sub-price rate"
															  data-annually="<?php echo esc_attr( $atts['sub_price_year'] ) ?>"
															  data-monthly="<?php echo esc_attr( $atts['sub_price_month'] ) ?>"><?php echo esc_attr( $atts['sub_price'] ) ?></span
		><?php echo esc_html( $atts['currency_bottom'] ) ?></h2>
    <h6 class="period period-monthly" <?php echo 'month' === Utouch::get_var( 'default_price' ) ? '' : 'style="display:none"' ?>><?php esc_html_e( 'per Month', 'utouch' ); ?></h6>
	<h6 class="period period-annually" <?php echo 'year' === Utouch::get_var( 'default_price' ) ? '' : 'style="display:none"' ?>><?php esc_html_e( 'per Year', 'utouch' ); ?></h6>
	<div class="main-pricing-content">
		<h5 class="pricing-title"><?php echo esc_html( $atts['title'] ) ?></h5>

		<div class="pricing-line" style="background-color: <?php echo esc_attr( $color ) ?>"></div>
		<div class="pricing-description pricing-tables-position"><?php echo( $atts['desc'] ) ?> </div>
		<?php echo do_shortcode( $atts['content'] ) ?>
		<div class="sub-description"><?php echo esc_html( $atts['sub_desc'] ) ?></div>

		<?php if ( 'yes' === $atts['show_button'] ) { ?>
			<a href="<?php echo esc_html( $atts['button_link'] ) ?>" class="btn btn--black btn--with-shadow"
			   data-monthly="<?php echo esc_url( $atts['button_month_link'] ) ?>"
			   data-annually="<?php echo esc_url( $atts['button_year_link'] ) ?>"><?php echo esc_html( $atts['button_text'] ) ?></a>
		<?php } ?>

	</div>

</div>
