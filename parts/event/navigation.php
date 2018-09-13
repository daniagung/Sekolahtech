<?php
/**
 * Template part for displaying section with previous / next posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package utouch
 */

$prev_post = get_previous_post();
$next_post = get_next_post();

if ( empty( $prev_post ) ) {
	$loop = new WP_Query( array(
		'post_type'      => get_post_type( get_the_ID() ),
		'posts_per_page' => 1,
		'post__not_in'   => array( get_the_ID() ),
	) );
	if ( $loop->post_count ) {
		$prev_post = $loop->posts[0];
	}
}
if ( empty( $next_post ) ) {
	$loop = new WP_Query( array(
		'post_type'      => get_post_type( get_the_ID() ),
		'order'          => 'ASC',
		'posts_per_page' => 1,
		'post__not_in'   => array( get_the_ID() ),
	) );
	if ( $loop->post_count ) {
		$next_post = $loop->posts[0];
	}
}

$event = Utouch::get_event( get_the_ID() );

if ( ! empty( $prev_post ) && ! empty( $next_post ) ) {
	?>
	<div class="pagination-arrow">

		<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="btn-prev-wrap">
			<div class="btn-prev">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-left-1">
					<use xlink:href="#utouch-icon-arrow-left-1"></use>
				</svg>
				<svg class="utouch-icon utouch-icon-arrow-left1">
					<use xlink:href="#utouch-icon-arrow-left1"></use>
				</svg>
			</div>
			<div class="btn-content">
				<div class="btn-content-title"><?php esc_html_e( 'Previous Post', 'utouch' ); ?></div>
				<p class="btn-content-subtitle"><?php echo esc_html( $prev_post->post_title ); ?></p>
			</div>
		</a>

		<a class="list-post" href="<?php echo get_page_link( $event->prev_next_home ) ?>">
			<svg class="utouch-icon utouch-icon-menu-1">
				<use xlink:href="#utouch-icon-menu-1"></use>
			</svg>
		</a>

		<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="btn-next-wrap">
			<div class="btn-content">
				<div class="btn-content-title"><?php esc_html_e( 'Next Post', 'utouch' ); ?></div>
				<p class="btn-content-subtitle"><?php echo esc_html( $next_post->post_title ); ?></p>
			</div>
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
<?php }