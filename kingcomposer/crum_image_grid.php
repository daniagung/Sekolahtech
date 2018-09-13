<?php
/**
 * @package utouch-wp
 */


$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;

extract( $atts );
//if not chosen any category select all
if ( empty( $categories ) ) {
	$categories = array_keys( utouch_get_attachment_categories() );
} else {
	//if exclude chosen we select all attachment category and remove selected
	if ( 'yes' === $exclude ) {

		$categories = array_diff( array_keys( utouch_get_attachment_categories() ), explode( ',', $categories ) );
	} else {
		//if not exclude just take chosen category
		$categories = explode( ',', $categories );
	}

}
$args            = array(
	'posts_per_page'         => $per_page,
	'paged'                  => $paged,
	'fields'                 => 'ids',
	'post_status'            => 'inherit',
	'post_type'              => 'attachment',
	'post_mime_type'         => 'image',
	'tax_query'              => array(
		'relation' => 'AND',
		array(
			'taxonomy'         => 'category_media',
			'field'            => 'term_id',
			'terms'            => $categories,
			'include_children' => false,
			'operator'         => 'IN',
		)
	),
	'orderby'                => $orderby,
	'order'                  => $order,
	'update_post_term_cache' => false,
	'update_post_meta_cache' => false,
);
$the_query       = new WP_Query( $args );
$attachments_ids = $the_query->get_posts();
/**
 * @var WP_Post $t
 *
 */

$attachments = array();
foreach ( $attachments_ids as $attach_id ) {
	$attach_terms = array();
	$terms        = get_the_terms( $attach_id, 'category_media' );
	foreach ( $terms as $term ) {
		$attach_terms[] = $term->slug;
	}

	$attachments[] = array(
		'ID'        => $attach_id,
		'url_full'  => wp_get_attachment_image_url( $attach_id, 'full' ),
		'url_thumb' => wp_get_attachment_image_url( $attach_id, 'thumbnail' ),
		'terms'     => $attach_terms,
	);
}


$terms     = get_terms( 'category_media', array(
	'include' => $categories,
) );
$cat_slugs = array();
if ( empty( $terms ) ) {
	$terms = array();
}
foreach ( $terms as $term ) {
	$cat_slugs[ $term->slug ] = $term->name;
}
$atts['cat_slugs']   = $cat_slugs;
$atts['attachments'] = $attachments;
$atts['the_query']   = $the_query;
Utouch::set_var( 'crum_image_grid', $atts );
get_template_part( 'parts/kc/image-grid/isotope' );
Utouch::delete_var( 'crum_image_grid' );