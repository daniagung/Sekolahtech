<a href="<?php echo add_query_arg( array( 'edd_action' => 'add_to_cart', 'download_id' => get_the_ID() ), edd_get_checkout_uri() ); ?>"
   class="btn btn--green btn--with-shadow">
    <span class="text"><?php esc_attr_e( 'Add to cart', 'utouch' ) ?></span>
</a>