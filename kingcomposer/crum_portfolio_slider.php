<?php
/** @var array $atts */
$output      = $number_post = $show_date = $show_author = $number_of_items = $wrap_class = $taxonomy = $thumbnail = $show_button = $css = $post_taxonomy = '';
$dots        = $dots_position = $autoscroll = $time = '';
$slider_attr = $slider_class = array();
extract( $atts );
$number_of_items = 2;
$wrp_el_classes  = apply_filters( 'kc-el-class', $atts );

$orderby = isset( $order_by ) ? $order_by : 'ID';
$order   = isset( $order_list ) ? $order_list : 'ASC';

$post_taxonomy_data = explode( ',', $post_taxonomy );
$taxonomy_term      = array();
$post_type          = 'fw-portfolio';


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
	'orderby'        => $orderby,
	'order'          => $order,
);


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


$the_query         = new WP_Query( $args );
$element_attribute = array();

$el_classess = array(
	'crumina-module',
	'pagination-bottom',
	'news-slider-module',
	$custom_class
);
$wrap_class  = array_merge( $el_classess, $wrp_el_classes );

$slider_attr[] = 'data-show-items="2"';
$slider_attr[] = 'data-scroll-items="' . esc_attr( $number_of_items ) . '"';

$slider_attr[] = 'data-loop="false"';
if ( 'yes' === $autoscroll ) {
	$slider_attr[] = 'data-autoplay="' . esc_attr( intval( $time ) * 1000 ) . '"';
	$slider_attr[] = 'data-loop="true"';
}

if ( 'top' === $dots_position ) {
	$dots_class     = 'swiper-pagination top-right';
	$slider_class[] = 'top-pagination';
} else {
	$slider_class[] = 'pagination-bottom';
	$dots_class     = 'swiper-pagination gray';
}
/* portfolio format settings*/
$container_width = 1170;
$gap_paddings    = 90;
$grid_size       = intval( 12 / $number_of_items );
$img_width       = intval( $container_width / ( 12 / $grid_size ) ) - $gap_paddings;
$img_height      = intval( $img_width * 0.75 );
$default_src     = kc_asset_url( 'images/get_start.jpg' );

$read_more_text = isset( $read_more_text ) ? $read_more_text : esc_html__( 'View Case', 'utouch' );

set_query_var( 'read-more-text', $read_more_text );
?>
<div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">
	<?php if ( ! $the_query->have_posts() ) {
		echo '<h2>' . esc_html__( ' No posts found', 'utouch' ) . '</h2>';
	} else { ?>
        <div class="swiper-container <?php echo implode( ' ', $slider_class ); ?>" <?php echo implode( ' ', $slider_attr ); ?>>
            <div class="swiper-wrapper">
				<?php if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post(); ?>
                        <div class="swiper-slide">
							<?php
							get_template_part( 'parts/portfolio/loop', 'item' );

							?>
                        </div>
						<?php
					}
				}

				wp_reset_postdata(); ?>
            </div>
			<?php if ( 'yes' === $dots ) { ?>
                <!-- Slider pagination -->
                <div class="swiper-pagination"></div>
			<?php } ?>
        </div>
	<?php } ?>
</div>

<?php kc_js_callback( 'CRUMINA.initSwiper' ); ?>