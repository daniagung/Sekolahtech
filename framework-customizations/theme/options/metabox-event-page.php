<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(


	'pagination_type' => array(
		'label'   => esc_html__( 'Type of pages pagination', 'utouch' ),
		'type'    => 'select',
		'desc'    => esc_html__( 'Select one of pagination types', 'utouch' ),
		'choices' => array(
			'numbers'     => esc_html__( 'Numbers links', 'utouch' ),
			'prev_next'     => esc_html__( 'Previous, next links', 'utouch' ),
			'loadmore'    => esc_html__( 'Load more ajax', 'utouch' ),

		),
	),
	'order'           => array(
		'label'   => esc_html__( 'Order', 'utouch' ),
		'type'    => 'select',
		'desc'    => esc_html__( 'Designates the ascending or descending order of items', 'utouch' ),
		'choices' => array(
			'default' => esc_html__( 'Default', 'utouch' ),
			'DESC'    => esc_html__( 'Descending', 'utouch' ),
			'ASC'     => esc_html__( 'Ascending', 'utouch' ),
		),
	),
	'orderby'         => array(
		'label'   => esc_html__( 'Order posts by', 'utouch' ),
		'type'    => 'select',
		'desc'    => esc_html__( 'Sort retrieved posts by parameter.', 'utouch' ),
		'choices' => array(
			'default'       => esc_html__( 'Default', 'utouch' ),
			'date'          => esc_html__( 'Order by date', 'utouch' ),
			'comment_count' => esc_html__( 'Order by number of comments', 'utouch' ),
			'author'        => esc_html__( 'Order by author.', 'utouch' ),
			'modified'      => esc_html__( 'Order by last modified date.', 'utouch' ),
		),
	),
	'taxonomy_select' => array(
		'type'       => 'multi-select',
		'label'      => esc_html__( 'Categories', 'utouch' ),
		'help'       => esc_html__( 'Click on field and type category name to find  category', 'utouch' ),
		'population' => 'taxonomy',
		'source'     => 'fw-event-taxonomy-name',
		'limit'      => 100,
	),
	'exclude'         => array(
		'type'  => 'checkbox',
		'value' => false,
		'label' => esc_html__( 'Exclude selected', 'utouch' ),
		'desc'  => esc_html__( 'Show all categories except that selected in "Categories" option', 'utouch' ),
		'text'  => esc_html__( 'Exclude', 'utouch' ),
	),
	'per_page'        => array(
		'label' => esc_html__( 'Items per page', 'utouch' ),
		'desc'  => esc_html__( 'How many portfolios show per page', 'utouch' ),
		'help'  => esc_html__( 'Please input number here. Leave empty for default value', 'utouch' ),
		'type'  => 'text',
	),

);