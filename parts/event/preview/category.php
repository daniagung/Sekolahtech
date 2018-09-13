<?php
/**
 * @package utouch-wp
 */
$event = Utouch::get_event( get_the_ID() );
if ( is_null( $event->category_id ) ) {
	return;
}
$category = get_term( $event->category_id );

?>
<a href="<?php echo get_term_link( $category ) ?>" style="z-index:100;" class="category-link c-white"><?php echo esc_html( $category->name ) ?></a>
