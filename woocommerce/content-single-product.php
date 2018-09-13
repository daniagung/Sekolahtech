<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row product-details">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">

	        <?php
	        /**
	         * Hook: woocommerce_before_single_product_summary.
	         *
	         * @hooked woocommerce_show_product_sale_flash - 10
	         * @hooked woocommerce_show_product_images - 20
	         */
	        do_action( 'woocommerce_before_single_product_summary' );
	        ?>
        </div>


        <div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-12 col-xs-offset-0 product-details-info">
            <?php

            ob_start();

            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action( 'woocommerce_single_product_summary' );

            $output = ob_get_clean();
            // change buttons
            $output = str_replace( 'single_add_to_cart_button button', 'btn btn-medium btn--primary btn--with-shadow', $output );
            $output = str_replace( '</button>', '<i class="seoicon-commerce"></i></button>', $output );
            echo( $output );
            ?>
        </div><!-- .summary -->
    </div>
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>1
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>