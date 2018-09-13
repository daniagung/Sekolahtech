<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/*
EDD additional hooks and actions and theme customizations.
*/


// define the edd_download_class callback
function utouch_filter_edd_download_class( $edd_download, $get_the_id, $atts, $i ) {

	$page_layout = get_query_var( 'page_layout', 'full' );

	if ('full' !== $page_layout){
		$col_item = '6';
	} else {
		$col_item = '4';
	}
	$columns = 'col-lg-' . $col_item;

	$edd_download = $edd_download . '  mb30 ' . $columns;
	return $edd_download;
};

// define the edd_download_inner_class callback
function utouch_filter_edd_download_inner_class( $edd_download_inner, $get_the_id, $atts, $i ) {
	$edd_download_inner = 'product-item downloads-grid-item ' . $edd_download_inner;
	return $edd_download_inner;
};

function utouch_filter_edd_downloads_list_wrapper_class( $wrapper_class, $atts ) {

	$wrapper_class = 'row '. $wrapper_class;
	return $wrapper_class;
};

// add the filter
add_filter( 'edd_downloads_list_wrapper_class', 'utouch_filter_edd_downloads_list_wrapper_class', 10, 2 );
add_filter( 'edd_download_class', 'utouch_filter_edd_download_class', 10, 4 );
add_filter( 'edd_download_inner_class', 'utouch_filter_edd_download_inner_class', 10, 4 );


function utouch_edd_download_match_height_wrapper_open(){
	echo '<div class="match-height" data-mh="downloads-grid-item">';
}
function utouch_edd_download_match_height_wrapper_close(){
	echo '</div>';
}
function utouch_edd_download_categories_list(){
	the_terms( get_the_ID(), 'download_category', '<div class="case-item__cat">', ', ', '</div>' );
}

add_action('edd_download_before', 'utouch_edd_download_match_height_wrapper_open');
add_action('edd_download_after', 'utouch_edd_download_match_height_wrapper_close');
add_action('edd_download_after_thumbnail','utouch_edd_download_categories_list');
