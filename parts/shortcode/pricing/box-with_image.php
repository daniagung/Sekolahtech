<?php
/**
 * @package utouch-wp
 */
$atts  = Utouch::get_var( 'pricing_box' );

$item_class = array( 'crumina-module', ' crumina-pricing-tables-item', 'pricing-tables--item-with-thumb' );
$item_class[] = 'kc-css-'.$atts['_id'];
if ( ! empty( $atts['custom_class'] ) ) {
	$item_class[] = $atts['custom_class'];
}

?>
<div class="<?php echo esc_attr( implode( ' ', $item_class ) ) ?>" data-mh="pricing-item">
	<div class="pricing-thumb pricing-tables-icon">
		<?php if('image' === $atts['show_icon']){?>
		<img src="<?php echo esc_url($atts['image_header'])?>" alt="cup" class="icon-img">
		<?php }?>
		<?php if('icon' === $atts['show_icon']){?>
			<i class=" <?php echo esc_attr($atts['icon_header'])?>"></i>
		<?php }?>
	</div>

	<div class="main-pricing-content">
		<h5 class="h5 pricing-title"><?php echo esc_html( $atts['title'] ) ?></h5>

		<div class="pricing-description pricing-tables-position"><?php echo( $atts['desc'] ) ?> </div>
		<?php echo do_shortcode($atts['content'])?>
		<div class="sub-description"><?php echo esc_html( $atts['sub_desc'] ) ?></div>

		<?php if('yes' === $atts['show_button']) { ?>
	</div>

	<div class="rate-wrap">
		<a href="<?php echo esc_html( $atts['button_link'] ) ?>" class="more-arrow"
		   data-monthly="<?php echo esc_url( $atts['button_month_link'] ) ?>"
		   data-annually="<?php echo esc_url( $atts['button_year_link'] ) ?>">
			<span><?php echo esc_html( $atts['button_text'] ) ?></span>
			<div class="btn-next">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1"><use xlink:href="#utouch-icon-arrow-right-1"></use></svg>
				<svg class="utouch-icon utouch-icon-arrow-right1"><use xlink:href="#utouch-icon-arrow-right1"></use></svg>
			</div>
		</a>
		<?php } ?>
		<h3 class="rate"><?php echo esc_html( $atts['currency_top'] ) ?><span class="price"
		                                                                         data-annually="<?php echo esc_attr( $atts['price_year'] ) ?>"
		                                                                         data-monthly="<?php echo esc_html( $atts['price_month'] ) ?>"><?php echo esc_attr( $atts['price'] ) ?></span><?php echo esc_html( $atts['currency_bottom'] ) ?>
		</h3>
	</div>

</div>

