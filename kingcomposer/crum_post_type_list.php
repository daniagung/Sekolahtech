<?php

$title = $wrap_class = $taxonomy = $css = '';

extract($atts);

if( !isset( $atts['post_taxonomy']))
    $post_taxonomy = 'post';

$el_classess = apply_filters( 'kc-el-class', $atts );

$orderby = isset($order_by) ? $order_by : 'ID';
$order = isset($order_list) ? $order_list : 'ASC';

$post_taxonomy_data = explode( ',', $post_taxonomy );
$taxonomy_term = array();
$post_type = 'post';

if( isset($post_taxonomy_data) ){
	foreach( $post_taxonomy_data as $post_taxonomy ){
		$post_taxonomy_tmp = explode( ':', $post_taxonomy );
		$post_type = $post_taxonomy_tmp[0];

		if( isset($post_taxonomy_tmp[1]) ){
			$taxonomy_term[] = $post_taxonomy_tmp[1];
		}
	}
}

$taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
$taxonomy = key( $taxonomy_objects );

$args = array(
	'post_type' 		=> $post_type,
	'posts_per_page' 	=> $number_post,
	'orderby'        	=> $orderby,
	'order' 			=> $order,
);

if( count($taxonomy_term) )
{
	$tax_query = array(
		'relation' => 'OR'
	);

	foreach( $taxonomy_term as $term ){
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

$el_classess = array_merge($el_classess, array(
	'list-post-type',
	'list-'.$post_type,
	$taxonomy,
	$wrap_class
));

if( $css != '' )$el_classess[] = $css;

$element_attribute[] = 'class="'. esc_attr( implode(' ', $el_classess) ) .'"';

if ( $the_query->have_posts() ) {
	global $post;

	echo '<div '. implode(' ', $element_attribute) .'>';

	if( !empty($title) ){
		echo '<h3 class="list-post-title">'. esc_html($title) .'</h3>';
	}

	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		get_template_part( 'post-format/post', 'standard_list' );
	}
	echo '</div>';
} else {
	echo '<div '. implode(' ', $element_attribute) .'>';
	echo esc_html__('No posts found', 'utouch');
	echo '</div>';
}

wp_reset_postdata();