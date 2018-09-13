<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$portfolio = Utouch::get_portfolio( get_the_ID() );


$view_more_text = get_query_var('read-more-text', esc_html__( 'View Case', 'utouch' ));

$container_width = 1170;
$gap_paddings    = 90;
$grid_size = 4;
$img_width      = intval( $container_width / ( 12 / $grid_size ) ) - $gap_paddings;
$img_height     = intval( $img_width * 0.75 );
$item_class_add = 'mb30';
$title_tag      = 'h6';
$module_class = array( 'crumina-module', 'case-item-grid', 'align-center', $item_class_add );
$permalink = get_the_permalink(get_the_ID());
?>

<div class="<?php echo implode( ' ', $module_class ) ?>"  style="<?php echo esc_attr( $portfolio->style_bg_color ) ?>;"  data-mh="case-item-grid">
    <div class="case-item_thumb mouseover lightbox shadow animation-disabled">
        <a href="<?php echo esc_url( $permalink ) ?>">
			<?php
			$thumbnail_id = get_post_thumbnail_id();
			if ( ! empty( $thumbnail_id ) ) {
				$thumbnail       = get_post( $thumbnail_id );
				$url             = wp_get_attachment_image_src( $thumbnail_id, 'full' );
				$image           = fw_resize( $url[0], $img_width, $img_height, true );
				$thumbnail_title = $thumbnail->post_title;
			} else {
				$image           = fw()->extensions->get( 'portfolio' )->locate_URI( '/static/img/no-photo.jpg' );
				$thumbnail_title = $image;
			} ?>
            <img src="<?php echo esc_url( $image ) ?>" width="<?php echo esc_attr( $img_width ) ?>"
                 height="<?php echo esc_attr( $img_height ) ?>" alt="<?php echo esc_attr( $thumbnail_title ) ?>"/>
        </a>
    </div>
    <a href="<?php the_permalink() ?>"
       class="more-arrow"  style="<?php echo esc_attr( $portfolio->style_text_color . $portfolio->style_fill_text_color ) ?>">
        <span><?php the_title(); ?></span>
        <div class="btn-next">
            <svg class="utouch-icon icon-hover utouch-icon-arrow-right-1">
                <use xlink:href="#utouch-icon-arrow-right-1" style="<?php echo esc_attr( $portfolio->style_text_color . $portfolio->style_fill_text_color ) ?>"></use>
            </svg>
            <svg class="utouch-icon utouch-icon-arrow-right1">
                <use xlink:href="#utouch-icon-arrow-right1" style="<?php echo esc_attr( $portfolio->style_text_color . $portfolio->style_fill_text_color ) ?>"></use>
            </svg>
        </div>
    </a>

</div>