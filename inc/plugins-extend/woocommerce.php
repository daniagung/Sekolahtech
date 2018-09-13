<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/*
Woocommerce additional hooks and actions and theme customizations.
*/

add_action('init','utouch_woocommerce_modifications');
function utouch_woocommerce_modifications(){
	// Remove breadcrumbs
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	//replace pagination
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
	add_action('woocommerce_after_shop_loop','utouch_paging_nav',  10);
	// Product title custom
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'utouch_woocommerce_template_loop_product_title', 10 );
	//Remove Rating from loop
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	//Remove Tabs (it's displayed before this action )
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	// change avatar image size on comments section
	remove_action('woocommerce_review_before','woocommerce_review_display_gravatar',10);
	add_action('woocommerce_review_before','utouch_review_display_gravatar',10);
	// add title on cart page with total cart items.
	add_action( 'woocommerce_before_cart', 'utouch_before_cart_title', 10 );

}

function utouch_review_display_gravatar( $comment ) {
	$avatar_img = get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '70' ), '' );
	echo str_replace('avatar ','comment-avatar', $avatar_img);
}

function utouch_before_cart_title(){
	echo '<h2 class="h1 cart-title">' . sprintf( esc_html__( 'In Your Shopping Cart:', 'utouch' ) . ' <span class="c-primary"> %d ' . esc_html__( 'items', 'utouch' ) . '</span>', WC()->cart->get_cart_contents_count() ) . '</h2>';
}

function utouch_remove_heder_title(){
	return false;
}

add_filter('woocommerce_show_page_title','utouch_remove_heder_title');

/*// Change number or products per row to 3
add_filter('loop_shop_columns', 'utouch_loop_columns');
if (!function_exists('utouch_loop_columns')) {
	function utouch_loop_columns() {
		return 3; // 3 products per row
	}
}
// Display 12 products per page.
add_filter('loop_shop_per_page', 'utouch_loop_shop_per_page', 20);
if (!function_exists('utouch_loop_shop_per_page')) {
	function utouch_loop_shop_per_page($cols) {
		return 12; // 3 products per row
	}
}*/

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'utouch_shop_dequeue_styles' );
function utouch_shop_dequeue_styles( $enqueue_styles ) {
	//unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

function utouch_woocommerce_template_loop_product_title() {
	global $product;
	echo '<div class="product-item-info">';
	echo ($product->get_categories( ', ', '<div class="product-category">', '</div>' ));
	echo '<h4 class="h5 product-title"><a href="'.get_permalink().'">' . esc_html( get_the_title() ) . '</a></h4>';
	echo '</div>';
}


/**
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */
add_filter( 'woocommerce_output_related_products_args', 'utouch_related_products_args' );
function utouch_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // 3 related products in a row
	return $args;
}


/**
 * Define image sizes
 */
function utouch_woocommerce_image_dimensions() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}
	$catalog = array(
		'width' 	=> '283',	// px
		'height'	=> '283',	// px
		'crop'		=> 0 		// false
	);
	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 0 		// false
	);
	$thumbnail = array(
		'width' 	=> '119',	// px
		'height'	=> '119',	// px
		'crop'		=> 0 		// false
	);
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	update_option('woocommerce_enable_lightbox', false);
}
add_action( 'after_switch_theme', 'utouch_woocommerce_image_dimensions', 1 );


/*Ajaxify cart*/
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
ob_start();
	get_template_part('parts/shop','cart');
$fragments['.cart-contents'] = ob_get_clean();
return $fragments;
}

//Replace woocommerce button on order page
add_filter('woocommerce_order_button_html','utouch_order_button_html');
function utouch_order_button_html(){
	return '<button class="btn btn-medium btn--green btn--with-shadow" name="woocommerce_checkout_place_order" id="place_order">
								<span class="text">' . esc_attr__( 'Place order', 'utouch' ) . '</span>
							</button>';
}