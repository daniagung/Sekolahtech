<?php if (!defined('FW')) die('Forbidden');
/**
 * @var WP_Post $item
 * @var string $title
 * @var array $attributes
 * @var object $args
 * @var int $depth
 */
$values = fw_ext_mega_menu_get_db_item_option($item->ID);
{
	$icon_html = '';

	if (
		fw()->extensions->get('megamenu')->show_icon()
		&&
		($icon = fw_ext_mega_menu_get_meta($item, 'icon'))
	) {
		$icon_html = '<i class="megamenu-icon '. $icon .'"></i> ';
	}
}

if('row' === utouch_akg('type',$values,'') && 'portfolio' === utouch_akg('row/menu/style',$values,'')){
	$values = utouch_akg('row/menu/portfolio',$values,array());
	$bg_image_url = utouch_akg( 'bg-image/url', $values, '' );
	if (!empty($bg_image_url)){
		$megamenu_style = 'background-image:url('.$bg_image_url.');';
	}else{
		$megamenu_style = '';
	}
	echo utouch_html_tag('a', $attributes, $args->link_before . $icon_html . $title . $args->link_after);

	$args = array(
		'post_type'           => 'fw-portfolio',
		'ignore_sticky_posts' => true,
		'paged'               => 1,
		'order'               => utouch_akg('order',$values,'DESC'),
		'orderby'             => utouch_akg('orderby',$values,'date'),
		'posts_per_page'      => utouch_akg('item_count',$values,4),
	);

	if ( $taxonomy_select = utouch_akg('taxonomy_select',$values, array()) ) {
		if ( false === utouch_akg('exclude',$values, false) ) {
			$operator = 'IN';
		} else {
			$operator = 'NOT IN';
		}
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'fw-portfolio-category',
				'field'    => 'id',
				'terms'    => $taxonomy_select,
				'operator' => $operator,
			),
		);
	}

	$query = new WP_Query( $args );
	if ( ! empty( $query ) ) {
		set_query_var( 'menu_loop_columns', utouch_akg( 'item_count', $values, 4 ) );
		$read_more = utouch_akg( 'more_text', $values, esc_html__( 'View Case', 'utouch' ) );
		if ( "View Case" == $read_more || empty( $read_more ) ) {
			$read_more    = fw_get_db_customizer_option( 'portfolio_more_text', esc_html__( 'View Case', 'utouch' ) );
		}
		set_query_var( 'read-more-text', $read_more );

		echo '<div class="megamenu with-products" style="' . $megamenu_style . '">';
		echo '<div class="megamenu-row">';

		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'parts/portfolio_item', 'megamenu' );
		}
		wp_reset_postdata();
		echo '</div>';
		echo '</div>';
	}
	return;
}
echo ($args->before);
/*If empty link in item - we will print title item instead link*/
if ( empty( $attributes['href'] ) || $attributes['href'] === 'http://' || $attributes['href'] === 'http://#' || $attributes['href'] === 'https://' || $attributes['href'] === 'https://#' ) {


	echo '<div class="megamenu-item-info">';
	if ($depth > 0 && true !== fw_ext_mega_menu_get_meta($item, 'title-off')) {
		echo utouch_html_tag( 'h5', array( 'class' => 'megamenu-item-info-title' ), $title );
	}
	if ( ! empty( $item->description ) ) {
		echo utouch_html_tag( 'div', array( 'class' => 'megamenu-item-info-text' ),  do_shortcode( $item->description ) );
	}
	echo '</div>';
} else {

	$classes = utouch_akg('classes',$item,array());
	if($depth > 0 && in_array('mega-menu-col',$classes) ){
		echo '<div class="megamenu-item-info">';
		if(!empty($title)  && true !== fw_ext_mega_menu_get_meta($item, 'title-off')){
			echo utouch_html_tag( 'h5', array( 'class' => 'megamenu-item-info-title' ), $title );
		}
		if ( ! empty( $item->description ) ) {
			echo utouch_html_tag( 'div', array( 'class' => 'megamenu-item-info-text' ),  do_shortcode( $item->description ) );
		}
		echo '</div>';

	}elseif ($depth > 0 && false !== fw_ext_mega_menu_get_meta($item, 'title-off')) {
		echo utouch_html_tag('a', $attributes, $args->link_before . $icon_html. $title . $args->link_after);
		if ( ! empty( $item->description ) ) {

			echo utouch_html_tag( 'div', array( 'class' => 'megamenu-item-info-text' ), do_shortcode( $item->description ) );
		}
	} else {
		echo utouch_html_tag('a', $attributes, $args->link_before . $icon_html . $title . $args->link_after);
	}
}
echo ($args->after);