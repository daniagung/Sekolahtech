<?php
/**
 * @package utouch-wp
 */

$title = $wrap_class = $taxonomy = $css = '';

extract( $atts );

if ( ! isset( $atts['post_taxonomy'] ) ) {
	$post_taxonomy = 'fw-event';
}

$el_classess = utouch_module_class( 'crumina-module-event-list', $atts );

$orderby = isset( $order_by ) ? $order_by : 'ID';
$order   = isset( $order_list ) ? $order_list : 'ASC';

$post_taxonomy_data = explode( ',', $post_taxonomy );
$taxonomy_term      = array();
$post_type          = 'fw-event';

if ( isset( $post_taxonomy_data ) ) {
	foreach ( $post_taxonomy_data as $post_taxonomy ) {
		$post_taxonomy_tmp = explode( ':', $post_taxonomy );
		$post_type         = $post_taxonomy_tmp[0];

		if ( isset( $post_taxonomy_tmp[1] ) ) {
			$taxonomy_term[] = $post_taxonomy_tmp[1];
		}
	}
}

$taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
$taxonomy         = key( $taxonomy_objects );

$args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $number_post,
    'order'          => $order,
);

if ( $orderby === 'date_event' ) {
    $args[ 'meta_key' ] = 'crum_event_date_from';
    $args[ 'orderby' ]  = 'meta_value_num';
} else {
    $args[ 'orderby' ] = $orderby;
}

if ( count( $taxonomy_term ) ) {
	$tax_query = array(
		'relation' => 'OR'
	);

	foreach ( $taxonomy_term as $term ) {
		$tax_query[] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $term,
		);
	}

	$args['tax_query'] = $tax_query;
}

$the_query = new WP_Query( $args );

$element_attribute = array();

$el_classess = array_merge( $el_classess, array(
	'list-post-type',
	'list-' . $post_type,
	$taxonomy,
	$wrap_class
) );

if ( $css != '' ) {
	$el_classess[] = $css;
}

$element_attribute[] = 'class="' . esc_attr( implode( ' ', $el_classess ) ) . '"';
$box_id = uniqid('event-loop');

if ( $the_query->have_posts() ) { ?>
    <div class="row">
        <div class="curriculum-event-wrap case-item-wrap portfolio-loop"
             data-layout="packery" id="<?php echo esc_html( $box_id ); ?>">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post();
				get_template_part( 'parts/event/preview/item-style-' . Utouch::get_event( get_the_ID() )->preview_style );
			endwhile;
			?>
        </div>
    </div>

	<?php if ( 'yes' === $pagination ) {
		utouch_ajax_custom_loop_load( $the_query, $box_id );
	}
} else {
	echo '<div ' . implode( ' ', $element_attribute ) . '>';
	echo esc_html__( 'No events found', 'utouch' );
	echo '</div>';
}

wp_reset_postdata();