<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$portfolio = Utouch::get_portfolio( get_the_ID() );

$img_width  = 220;
$img_height = 320;

$content_class = array( 'case-item-content', 'c-white', 'fill-white', 'custom-color' );

$thumbnail_id = get_post_thumbnail_id();

$module_class = array( 'crumina-module', 'crumina-case-item' );

if ( empty( $thumbnail_id ) ) {
	$module_class[] = 'case-item--no-image';
}

$view_more_text = get_query_var('read-more-text', esc_html__( 'View Case', 'utouch' ));

?>
<div class="<?php echo implode( ' ', $module_class ) ?>" data-mh="case-item">

	<?php
    if ( ! empty( $thumbnail_id ) ) {
		echo '<div class="case-item__thumb">';
		$thumbnail       = get_post( $thumbnail_id );
		$image           = utouch_resize( $thumbnail->ID, $img_width, $img_height, true );
		$thumbnail_title = $thumbnail->post_title;

		?>
		<a href="<?php the_permalink() ?>">
			<img src="<?php echo esc_url( $image ) ?>" width="<?php echo esc_attr( $img_width ) ?>"
				 height="<?php echo esc_attr( $img_height ) ?>" alt="<?php echo esc_attr( $thumbnail_title ) ?>"/>
		</a>
		<?php
		echo '</div>';
	} else {

	} ?>


	<div class="square-colored" style="<?php echo esc_attr( $portfolio->style_bg_color ) ?>;"></div>
	<div class="<?php echo implode( ' ', $content_class ) ?>"
		 style="<?php echo esc_attr( $portfolio->style_text_color . $portfolio->style_fill_text_color ) ?>">
		<h5 class="title"><?php the_title(); ?></h5>
		<a href="<?php the_permalink() ?>"
		   class="more-arrow">
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
