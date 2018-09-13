<?php if (!defined('FW')) die('Forbidden');

// MegaMenu row options
$options = array(
	'bg-image' => array(
		'label'       => esc_html__( 'Background Image', 'utouch' ),
		'type'        => 'upload',
		'images_only' => true,
	),
	'menu' => array(
		'type'   => 'multi-picker',
		'label'  => false,
		'desc'   => false,
		'picker' => array(
			'style' => array(
				'type'    => 'select',
				'value'   => 'col',
				'label'   => esc_html__( 'Menu style', 'utouch' ),
				'choices' => array(
					'col'       => esc_html__( 'Columns', 'utouch' ),
					'portfolio' => esc_html__( 'Recent portfolio', 'utouch' ),
				),
			),
		),

		'choices' => array(
			'portfolio' => array(
				'taxonomy_select' => array(
					'type'       => 'multi-select',
					'label'      => esc_html__( 'Categories', 'utouch' ),
					'help'       => esc_html__( 'Click on field and type category name to find  category', 'utouch' ),
					'population' => 'taxonomy',
					'source'     => 'fw-portfolio-category',
					'limit'      => 100,
				),
				'exclude'         => array(
					'type'  => 'checkbox',
					'value' => false,
					'label' => esc_html__( 'Exclude selected', 'utouch' ),
					'desc'  => esc_html__( 'Show all categories except that selected in "Categories" option', 'utouch' ),
					'text'  => esc_html__( 'Exclude', 'utouch' ),
				),
				'order'           => array(
					'label'   => esc_html__( 'Order', 'utouch' ),
					'type'    => 'select',
					'desc'    => esc_html__( 'Designates the ascending or descending order of items', 'utouch' ),
					'value'   => 'DESC',
					'choices' => array(
						'DESC' => esc_html__( 'Descending(default)', 'utouch' ),
						'ASC'  => esc_html__( 'Ascending', 'utouch' ),
					),
				),
				'orderby'         => array(
					'label'   => esc_html__( 'Order posts by', 'utouch' ),
					'type'    => 'select',
					'desc'    => esc_html__( 'Sort retrieved posts by parameter.', 'utouch' ),
					'value'   => 'date',
					'choices' => array(
						'date'          => esc_html__( 'Order by date ( default)', 'utouch' ),
						'comment_count' => esc_html__( 'Order by number of comments', 'utouch' ),
						'author'        => esc_html__( 'Order by author.', 'utouch' ),
						'modified'      => esc_html__( 'Order by last modified date.', 'utouch' ),
					),
				),
				'item_count'      => array(
					'type'       => 'slider',
					'value'      => 4,
					'properties' => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,

					),
					'label'      => esc_html__( 'Items to show', 'utouch' ),
				),
				'more_text'        => array(
					'label' => esc_html__( 'Read More link text', 'utouch' ),
					'desc'  => esc_html__( 'Text for link that open inner page', 'utouch' ),
					'type'  => 'text',
					'value' => esc_html__( 'View Case', 'utouch' )
				),

			),
		),
	),
);