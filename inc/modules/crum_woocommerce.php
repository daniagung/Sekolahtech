<?php

/*
  Extension Name: WooCommerce
  Extension Preview: -
  Description:
  Version: 1.0
  Author: Crumina
  Author URI: https://wpcode.pro/
 */

if ( !defined( 'ABSPATH' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    exit;
}

if ( !function_exists( 'kc_add_map' ) ) {
    return;
}

/**
 * Get lists of categories.
 *
 * @param $parent_id
 * @param array $array
 * @param $level
 * @param array $dropdown - passed by  reference
 * @param array $dropdown_ids - passed by  reference
 */
function utouch_get_category_childs_full( $parent_id, $array, $level,
                                          &$dropdown, &$dropdown_ids ) {
    $keys = array_keys( $array );
    $i    = 0;
    while ( $i < count( $array ) ) {
        $key  = $keys[ $i ];
        $item = $array[ $key ];
        $i ++;
        if ( $item->category_parent == $parent_id ) {
            $name                           = str_repeat( '- ', $level ) . $item->name;
            $dropdown[ $item->slug ]        = $name . '(' . $item->term_id . ')';
            $dropdown_ids[ $item->term_id ] = $name . '(' . $item->term_id . ')';
            unset( $array[ $key ] );
            $array                          = utouch_get_category_childs_full( $item->term_id, $array, $level + 1, $dropdown, $dropdown_ids );
            $keys                           = array_keys( $array );
            $i                              = 0;
        }
    }

    return $array;
}

$order_by_values = array(
    'date'          => __( 'Date', 'utouch' ),
    'ID'            => __( 'ID', 'utouch' ),
    'author'        => __( 'Author', 'utouch' ),
    'title'         => __( 'Title', 'utouch' ),
    'modified'      => __( 'Modified', 'utouch' ),
    'rand'          => __( 'Random', 'utouch' ),
    'comment_count' => __( 'Comment count', 'utouch' ),
    'menu_order'    => __( 'Menu order', 'utouch' ),
);

$order_way_values = array(
    'DESC' => __( 'Descending', 'utouch' ),
    'ASC'  => __( 'Ascending', 'utouch' ),
);

$categories = get_categories( array(
    'type'         => 'post',
    'child_of'     => 0,
    'parent'       => '',
    'orderby'      => 'name',
    'order'        => 'ASC',
    'hide_empty'   => false,
    'hierarchical' => 1,
    'exclude'      => '',
    'include'      => '',
    'number'       => '',
    'taxonomy'     => 'product_cat',
    'pad_counts'   => false,
) );

$product_categories_dropdown     = array();
$product_categories_dropdown_ids = array();
utouch_get_category_childs_full( 0, $categories, 0, $product_categories_dropdown, $product_categories_dropdown_ids );

global $post, $typenow, $current_screen;
$post_type = '';

if ( $post && $post->post_type ) {
    //we have a post so we can just get the post type from that
    $post_type = $post->post_type;
} elseif ( $typenow ) {
    //check the global $typenow - set in admin.php
    $post_type = $typenow;
} elseif ( $current_screen && $current_screen->post_type ) {
    //check the global $current_screen object - set in sceen.php
    $post_type = $current_screen->post_type;
} elseif ( isset( $_REQUEST[ 'post_type' ] ) ) {
    //lastly check the post_type querystring
    $post_type = sanitize_key( $_REQUEST[ 'post_type' ] );
    //we do not know the post type!
}

kc_add_map( array(
    'woocommerce_cart'           => array(
        'name'        => __( 'Cart', 'utouch' ),
        'description' => __( 'Displays the cart contents', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array()
    ),
    'woocommerce_checkout'       => array(
        'name'        => __( 'Checkout', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'description' => __( 'Displays the checkout', 'utouch' ),
        'params'      => array()
    ),
    'woocommerce_order_tracking' => array(
        'name'        => __( 'Order Tracking Form', 'utouch' ),
        'description' => __( 'Lets a user see the status of an order', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array()
    ),
    'woocommerce_my_account'     => array(
        'name'        => __( 'My Account', 'utouch' ),
        'description' => __( 'Shows the "my account" section', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'label'       => __( 'Order count', 'utouch' ),
                'value'       => 15,
                'name'        => 'order_count',
                'description' => __( 'You can specify the number or order to show, it\'s set by default to 15 (use -1 to display all orders.)', 'utouch' ),
            ),
        )
    ),
    'recent_products'            => array(
        'name'        => __( 'Recent products', 'utouch' ),
        'description' => __( 'Lists recent products', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'label'       => __( 'Per page', 'utouch' ),
                'value'       => 12,
                'name'        => 'per_page',
                'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'utouch' ),
            ),
            array(
                'type'        => 'textfield',
                'label'       => __( 'Columns', 'utouch' ),
                'value'       => 4,
                'name'        => 'columns',
                'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'utouch' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Order by', 'utouch' ),
                'name'        => 'orderby',
                'options'     => $order_by_values,
                'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Sort order', 'utouch' ),
                'name'        => 'order',
                'options'     => $order_way_values,
                'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
        )
    ),
    'featured_products'          => array(
        'name'        => __( 'Featured products', 'utouch' ),
        'description' => __( 'Display products set as "featured"', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'label'       => __( 'Per page', 'utouch' ),
                'value'       => 12,
                'name'        => 'per_page',
                'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'utouch' ),
            ),
            array(
                'type'        => 'textfield',
                'label'       => __( 'Columns', 'utouch' ),
                'value'       => 4,
                'name'        => 'columns',
                'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'utouch' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Order by', 'utouch' ),
                'name'        => 'orderby',
                'options'     => $order_by_values,
                'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Sort order', 'utouch' ),
                'name'        => 'order',
                'options'     => $order_way_values,
                'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
        )
    ),
    'product'                    => array(
        'name'        => __( 'Product', 'utouch' ),
        'description' => __( 'Show a single product', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'autocomplete',
                'label'       => __( 'Product', 'utouch' ),
                'name'        => 'id',
                'description' => __( 'Input product title to see suggestions', 'utouch' ),
                'options'     => array(
                    'multiple'  => false,
                    'post_type' => 'product',
                ),
            ),
        )
    ),
    'products'                   => array(
        'name'        => __( 'Products', 'utouch' ),
        'description' => __( 'Show a multiple products', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'label'       => __( 'Columns', 'utouch' ),
                'value'       => 4,
                'name'        => 'columns',
                'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'utouch' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Order by', 'utouch' ),
                'name'        => 'orderby',
                'options'     => $order_by_values,
                'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Sort order', 'utouch' ),
                'name'        => 'order',
                'options'     => $order_way_values,
                'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'autocomplete',
                'label'       => __( 'Products', 'utouch' ),
                'name'        => 'ids',
                'description' => __( 'Input product title to see suggestions', 'utouch' ),
                'options'     => array(
                    'multiple'  => true,
                    'post_type' => 'product',
                ),
            ),
        )
    ),
    'add_to_cart'                => array(
        'name'        => __( 'Add to cart', 'utouch' ),
        'description' => __( 'Show multiple products by ID or SKU', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'autocomplete',
                'label'       => __( 'Product', 'utouch' ),
                'name'        => 'id',
                'description' => __( 'Input product title to see suggestions', 'utouch' ),
                'options'     => array(
                    'multiple'  => false,
                    'post_type' => 'product',
                ),
            ),
            array(
                'type'  => 'textfield',
                'name'  => 'style',
                'label' => __( 'Wrapper inline style', 'utouch' ),
            ),
        )
    ),
    'add_to_cart_url'            => array(
        'name'        => __( 'Add to cart URL', 'utouch' ),
        'description' => __( 'Show URL on the add to cart button', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'autocomplete',
                'label'       => __( 'Product', 'utouch' ),
                'name'        => 'id',
                'description' => __( 'Input product title to see suggestions', 'utouch' ),
                'options'     => array(
                    'multiple'  => false,
                    'post_type' => 'product',
                ),
            ),
        )
    ),
    'product_page'               => array(
        'name'        => __( 'Product page', 'utouch' ),
        'description' => __( 'Show single product by ID or SKU', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'autocomplete',
                'label'       => __( 'Product', 'utouch' ),
                'name'        => 'id',
                'description' => __( 'Input product title to see suggestions', 'utouch' ),
                'options'     => array(
                    'multiple'  => false,
                    'post_type' => 'product',
                ),
            ),
        )
    ),
    'product_category'           => array(
        'name'        => __( 'Product category', 'utouch' ),
        'description' => __( 'Show multiple products in a category', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'label'       => __( 'Per page', 'utouch' ),
                'value'       => 12,
                'name'        => 'per_page',
                'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'utouch' ),
            ),
            array(
                'type'        => 'textfield',
                'label'       => __( 'Columns', 'utouch' ),
                'value'       => 4,
                'name'        => 'columns',
                'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'utouch' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Order by', 'utouch' ),
                'name'        => 'orderby',
                'options'     => $order_by_values,
                'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Sort order', 'utouch' ),
                'name'        => 'order',
                'options'     => $order_way_values,
                'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Category', 'utouch' ),
                'name'        => 'category',
                'options'     => $product_categories_dropdown,
                'description' => __( 'Product category list', 'utouch' ),
            ),
        )
    ),
    'product_categories'         => array(
        'name'        => __( 'Product categories', 'utouch' ),
        'description' => __( 'Display product categories loop', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'select',
                'label'       => __( 'Order by', 'utouch' ),
                'name'        => 'orderby',
                'options'     => $order_by_values,
                'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Sort order', 'utouch' ),
                'name'        => 'order',
                'options'     => $order_way_values,
                'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'textfield',
                'label'       => __( 'Columns', 'utouch' ),
                'value'       => 4,
                'name'        => 'columns',
                'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'utouch' ),
            ),
            array(
                'type'        => 'multiple',
                'label'       => __( 'Categories', 'utouch' ),
                'name'        => 'ids',
                'options'     => $product_categories_dropdown_ids,
                'description' => __( 'List of product categories', 'utouch' ),
            ),
        )
    ),
    'sale_products'              => array(
        'name'        => __( 'Sale products', 'utouch' ),
        'description' => __( 'List all products on sale', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'label'       => __( 'Per page', 'utouch' ),
                'value'       => 12,
                'name'        => 'per_page',
                'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'utouch' ),
            ),
            array(
                'type'        => 'textfield',
                'label'       => __( 'Columns', 'utouch' ),
                'value'       => 4,
                'name'        => 'columns',
                'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'utouch' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Order by', 'utouch' ),
                'name'        => 'orderby',
                'options'     => $order_by_values,
                'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Sort order', 'utouch' ),
                'name'        => 'order',
                'options'     => $order_way_values,
                'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
        )
    ),
    'best_selling_products'      => array(
        'name'        => __( 'Best Selling Products', 'utouch' ),
        'description' => __( 'List best selling products on sale', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'label'       => __( 'Per page', 'utouch' ),
                'value'       => 12,
                'name'        => 'per_page',
                'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'utouch' ),
            ),
            array(
                'type'        => 'textfield',
                'label'       => __( 'Columns', 'utouch' ),
                'value'       => 4,
                'name'        => 'columns',
                'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'utouch' ),
            )
        )
    ),
    'top_rated_products'         => array(
        'name'        => __( 'Top Rated Products', 'utouch' ),
        'description' => __( 'List all products on sale', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'label'       => __( 'Per page', 'utouch' ),
                'value'       => 12,
                'name'        => 'per_page',
                'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'utouch' ),
            ),
            array(
                'type'        => 'textfield',
                'label'       => __( 'Columns', 'utouch' ),
                'value'       => 4,
                'name'        => 'columns',
                'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'utouch' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Order by', 'utouch' ),
                'name'        => 'orderby',
                'options'     => $order_by_values,
                'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Sort order', 'utouch' ),
                'name'        => 'order',
                'options'     => $order_way_values,
                'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
        )
    ),
    'related_products'           => array(
        'name'        => __( 'Related Products', 'utouch' ),
        'description' => __( 'List related products', 'utouch' ),
        'icon'        => 'seoicon-woo-logo',
        'category'    => __( 'WooCommerce', 'utouch' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'label'       => __( 'Per page', 'utouch' ),
                'value'       => 12,
                'name'        => 'per_page',
                'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'utouch' ),
            ),
            array(
                'type'        => 'textfield',
                'label'       => __( 'Columns', 'utouch' ),
                'value'       => 4,
                'name'        => 'columns',
                'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'utouch' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Order by', 'utouch' ),
                'name'        => 'orderby',
                'options'     => $order_by_values,
                'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type'        => 'select',
                'label'       => __( 'Sort order', 'utouch' ),
                'name'        => 'order',
                'options'     => $order_way_values,
                'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'utouch' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
        )
    ),
) );
