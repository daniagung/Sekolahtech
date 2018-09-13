<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */

$portfolio = Utouch::get_portfolio( get_the_ID() );

$img_width  = 200;
$img_height = 221;
$crop       = true;

$columns = 'col' . get_query_var( 'menu_loop_columns', 4 );
$view_more_text = get_query_var('read-more-text', esc_html__( 'View Case', 'utouch' ));
?>
<div class="<?php echo esc_attr( $columns ) ?>" data-mh="product-item">
	<div class="product-item">
		<div class="product-item-thumb">
			<div class="square-colored" style="<?php echo esc_attr( $portfolio->style_bg_color ) ?>"></div>
			<?php
			$thumbnail_id = get_post_thumbnail_id();
			if ( ! empty( $thumbnail_id ) ) {
				$thumbnail       = get_post( $thumbnail_id );
				//$image           = utouch_resize( $thumbnail->ID, $img_width, $img_height, $crop );
				$image           = mr_image_resize( $thumbnail->guid, $img_width, $img_height, $crop, 't', false );
				$thumbnail_title = $thumbnail->post_title;
			} else {
				$image           = fw()->extensions->get( 'portfolio' )->locate_URI( '/static/img/no-photo.jpg' );
				$thumbnail_title = $image;
			} ?>
			<a href="<?php the_permalink() ?>">
				<img src="<?php echo esc_url( $image ) ?>" width="<?php echo esc_attr( $img_width ) ?>"
					 height="<?php echo esc_attr( $img_height ) ?>" alt="<?php echo esc_attr( $thumbnail_title ) ?>"/>
			</a>
		</div>
		<div class="product-item-content">
			<h6 class="title"><?php the_title() ?></h6>
		</div>
		<a href="<?php the_permalink() ?>" class="more-arrow">
            <span><?php echo esc_html( $view_more_text ); ?></span>
			<div class="btn-next">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1">
					<use xlink:href="#utouch-icon-arrow-right-1"></use>
				</svg>
				<svg class="utouch-icon utouch-icon-arrow-right1">
					<use xlink:href="#utouch-icon-arrow-right1"></use>
				</svg>
			</div>
		</a>
	</div>
</div>