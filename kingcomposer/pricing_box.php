<?php
$show_icon  = $icon_header = $image_header = $title = $subtitle = $price = $currency = $show_on_top = $duration = $desc = $show_icon = $icon = $show_button = $button_text = $button_link = $custom_class = $data_icon_header = $data_title = $data_price = $data_currency = $data_duration = $data_desc = $data_button = '';
$hover_zoom = $highlight = $data_head_color = '';
$layout     = 'classic';
$wrap_class = array();
$wrap_class = apply_filters( 'kc-el-class', $atts );

$primary_color = '#f15b26';

if ( 'yes' === $atts['show_on_top'] ) {
	$atts['currency_bottom'] = $atts['currency'];
	$atts['currency_top']    = '';
} else {
	$atts['currency_top']    = $atts['currency'];
	$atts['currency_bottom'] = '';
}
$link = explode('|',$atts['button_month_link']);
$atts['button_month_link'] = $link[0];
$link = explode('|',$atts['button_year_link']);
$atts['button_year_link'] = $link[0];

$price = explode('.',$atts['price_month']);
$atts['price_month'] = $price[0];
if(!empty($price[1])){
	$atts['sub_price_month'] = '.' . $price[1];
}else{
	$atts['sub_price_month'] = '';
}
$price = explode('.',$atts['price_year']);
$atts['price_year'] = $price[0];
if(!empty($price[1])){
	$atts['sub_price_year'] = '.' . $price[1];
}else{
	$atts['sub_price_year'] = '';
}
if ( 'month' === Utouch::get_var( 'default_price' ) ) {
	$atts['price'] = $atts['price_month'];
	$atts['sub_price'] = $atts['sub_price_month'];
	$atts['button_link'] = $atts['button_month_link'];
} else {
	$atts['price'] = $atts['price_year'];
	$atts['sub_price'] = $atts['sub_price_year'];
	$atts['button_link'] = $atts['button_year_link'];
}
if ( !empty( $atts['desc_list'] ) ) {

	$pros = explode( "\n", $atts['desc_list'] );
	if( count( $pros ) ) {

		$data_desc .= '<ul class="pricing-tables-position">';

		foreach( $pros as $pro ) {
			$data_desc .= '<li class="position-item">'. do_shortcode($pro) .' </li>';
		}

		$data_desc .= '</ul>';

	}
}
$atts['desc_list'] = $data_desc;
if(empty($atts['sub_desc'])){
	$atts['sub_desc'] = '';
}
Utouch::set_var( 'pricing_box', $atts );
get_template_part( 'parts/shortcode/pricing/box-' . $atts['layout'] );
return;


//add classes to pricing variant
$wrap_class[] = 'crumina-module';
$wrap_class[] = 'pricing-tables-item';
$wrap_class[] = 'pricing-tables-item-' . $layout;

//hover zoom ? is it for 1 pricing variant
if ( $hover_zoom === 'yes' ) {
	$wrap_class[] = 'hover-zoom';
}

if ( $highlight === 'yes' ) {
	$wrap_class[] = 'highlight';
} elseif ( $hover_zoom === 'yes' ) {
	$wrap_class[] = 'hover-zoom';
}

if ( ! empty( $custom_class ) ) {
	$wrap_class[] = $custom_class;
}

if ( $show_on_top == 'yes' ) {
	$wrap_class[] = 'kc-price-before-currency';
}

if ( $show_icon != 'no' ) {
	if ( $show_icon == 'icon' ) {
		if ( empty( $icon_header ) || $icon_header == '__empty__' ) {
			$icon_header = 'fa-rocket';
		}
		$icon_header = '<i class="' . esc_attr( $icon_header ) . '"></i>';
	} elseif ( $show_icon == 'image' ) {
		$icon_header = '<img src="' . esc_url( $image_header ) . '" alt="' . esc_html( $title ) . '" />';
	}

	$data_icon_header .= '<div class="pricing-tables-icon">' . $icon_header . '</div>';
} else {
	$wrap_class[] = 'no-icon';
}


if ( ! empty( $title ) ) {
	$data_title .= '<div class="pricing-title">' . esc_html( $title ) . '</div>';
}


if ( ! empty( $desc ) ) {

	$pros = explode( "\n", $desc );
	if ( count( $pros ) ) {

		$data_desc .= '<ul class="pricing-tables-position">';

		foreach ( $pros as $pro ) {
			$data_desc .= '<li class="position-item">' . do_shortcode( $pro ) . ' </li>';
		}

		$data_desc .= '</ul>';

	}
}

if ( ! empty( $price ) ) {
	$price = html_entity_decode( $price );
	$data_price .= '<span class="content-price">' . $price . '</span>';
}

if ( ! empty( $currency ) ) {
	$data_currency .= '<span class="content-currency">' . $currency . '</span>';
}

if ( ! empty( $duration ) ) {
	$data_duration .= '<span class="content-duration">' . $duration . '</span>';
}

if ( $show_button == 'yes' ) {

	if ( ! empty( $button_link ) ) {
		$link_arr = explode( '|', $button_link );
		if ( ! empty( $link_arr[0] ) ) {
			$link_url = $link_arr[0];
		} else {
			$link_url = '#';
		}
	} else {
		$link_url = '#';
	}

	$button_class = $layout === 'colored' ? 'btn-border' : 'ing Sub Descriptionbtn--dark';

	$data_button .= '<a class="btn btn-medium ' . esc_attr( $button_class ) . '" href="' . $link_url . '">';
	$data_button .= '<span class="text">' . esc_html( $button_text ) . '</span>';
	$data_button .= '</a>';

}

if ( $layout === 'head' ) {
	$data_head_color = '<div class="bg-layer full-block"><div class="pricing-head" style="background-color:' . $primary_color . '"></div></div>';
} else {
	$data_head_color = '<div class="bg-layer full-block" style="background-color:' . $primary_color . '"></div>';
}

?>

