<?php
/**
 * @package utouch-wp
 */

$event    = Utouch::get_event( get_the_ID() );
$category = get_term( $event->category_id );

$args          = array(
	'post_type'           => get_post_type( get_the_ID() ),
	'posts_per_page'      => $event->related_to_show,
	'ignore_sticky_posts' => 1,
	'post_status'         => 'publish',
	'tax_query'           => array(
		array(
			'taxonomy' => 'fw-event-taxonomy-name',
			'field'    => 'term_id',
			'terms'    => array( $category->term_id ),
			'operator' => 'IN',
		),
	),
	'post__not_in'        => array( get_the_ID() ),
);
$related_cat_query = new WP_Query( $args );

$related_query = null;
if($related_cat_query->post_count < $event->related_to_show){

	$args          = array(
		'post_type'           => get_post_type( get_the_ID() ),
		'posts_per_page'      => $event->related_to_show - $related_cat_query->post_count,
		'ignore_sticky_posts' => 1,
		'post_status'         => 'publish',
		'tax_query'           => array(
			array(
				'taxonomy' => 'fw-event-taxonomy-name',
				'field'    => 'term_id',
				'terms'    => array( $category->term_id ),
				'operator' => 'NOT IN',
			),
		),
	);
	$related_query = new WP_Query( $args );

}


if ( ! $related_cat_query->have_posts() && !$related_query->have_posts()) {
	return;
}
?>
<section class="crumina-module crumina-module-slider navigation-top mb30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h3><?php echo esc_html( $event->related_title ) ?></h3>

				<div class="swiper-container top-navigation" data-show-items="3" data-md-slides="2" data-sm-slides="1" data-loop="false">
					<div class="swiper-wrapper">

						<?php
						Utouch::set_var( 'related_events_preview', true );
						while ( $related_cat_query->have_posts() ) {
							$related_cat_query->the_post();
							echo '<div class="swiper-slide">';
							get_template_part( 'parts/event/preview/item-style-1' );
							echo '</div>';
						}
						if(!is_null($related_query)){
							while ( $related_query->have_posts() ) {
								$related_query->the_post();
								echo '<div class="swiper-slide">';
								get_template_part( 'parts/event/preview/item-style-1' );
								echo '</div>';
							}
						}
						Utouch::delete_var( 'related_events_preview' );
						?>

					</div>
					<div class="btn-slider-wrap navigation-top-right">

						<div class="btn-prev">
							<svg class="utouch-icon icon-hover utouch-icon-arrow-left-1">
								<use xlink:href="#utouch-icon-arrow-left-1"></use>
							</svg>
							<svg class="utouch-icon utouch-icon-arrow-left1">
								<use xlink:href="#utouch-icon-arrow-left1"></use>
							</svg>
						</div>

						<div class="btn-next">
							<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1">
								<use xlink:href="#utouch-icon-arrow-right-1"></use>
							</svg>
							<svg class="utouch-icon utouch-icon-arrow-right1">
								<use xlink:href="#utouch-icon-arrow-right1"></use>
							</svg>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>

