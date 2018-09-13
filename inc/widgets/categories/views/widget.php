<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array $args
 * @var string $title
 * @var string $count
 * @var string $cat_sel
 */

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

echo( $before_widget );

if ( $title ) {
	echo( $before_title . esc_html( $title ) . $after_title );
}
$categories = get_categories( array(
	'orderby'  => 'name',
	'order'    => 'ASC',
	'taxonomy' => $cat_sel
) );

if ( ! empty( $categories ) ) { ?>
	<ul class="category-list">
		<?php
		foreach ( $categories as $category ) {
			$category_link = sprintf( '<a href="%1$s" alt="%2$s"  class="category-title">%3$s %4$s</a>',
				esc_url( get_category_link( $category->term_id ) ),
				esc_attr( sprintf( __( 'View all posts in %s', 'utouch' ), $category->name ) ),
				esc_html( $category->name ),
				$count ? '<span class="cat-count">' . esc_attr( $category->count ) . '</span>' : ''
			); ?>
			<li class="category-post-item">

				<?php echo( $category_link ) ?>

			</li>
		<?php } ?>
	</ul>
<?php }
echo( $after_widget );
