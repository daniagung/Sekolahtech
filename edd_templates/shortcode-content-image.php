<?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) : ?>
    <div class="product-item-thumb">
		<?php
		$thumbnail_id = get_post_thumbnail_id();
		$img_width    = 330;
		$img_height   = '';
		$crop         = false;

		$thumbnail_id = get_post_thumbnail_id();
		if ( ! empty( $thumbnail_id ) ) {
			$thumbnail       = get_post( $thumbnail_id );
			$image           = utouch_resize( $thumbnail->guid, $img_width, $img_height, $crop );
			$thumbnail_title = $thumbnail->post_title;
		} else {
			$image           = get_template_directory_uri() . '/img/no-image.svg';
			$thumbnail_title = $image;
		} ?>
        <a href="<?php the_permalink() ?>">
            <img src="<?php echo esc_url( $image ) ?>" width="<?php echo esc_attr( $img_width ) ?>"
                 height="<?php echo esc_attr( $img_height ) ?>" alt="<?php echo esc_attr( $thumbnail_title ) ?>"/>
        </a>
    </div>
<?php endif; ?>
