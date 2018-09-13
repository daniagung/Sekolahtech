<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'section_archive'   => array(
		'title'   => esc_html__( 'Archive / Category options', 'utouch' ),
		'options' => array(
			'blog-featured-show' => array(
				'label'        => esc_html__( 'Show featured media?', 'utouch' ),
				'desc'         => esc_html__( 'Featured image or other media on top of post', 'utouch' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'value'        => 'yes',
			),
			'blog-author-show' => array(
				'label'        => esc_html__( 'Show author?', 'utouch' ),
				'desc'         => esc_html__( 'Author name and avatar block', 'utouch' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'value'        => 'yes',
			),
			'blog-meta-show' => array(
				'label'        => esc_html__( 'Show post meta?', 'utouch' ),
				'desc'         => esc_html__( 'Post time, categories, tags, comments info', 'utouch' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'value'        => 'yes',
			),
			'blog-share-show' => array(
				'label'        => esc_html__( 'Show share post buttons?', 'utouch' ),
				'desc'         => esc_html__( 'Show icons that share post on social networks', 'utouch' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'value'        => 'yes',
			),
		),
	),
	'section_post'   => array(
		'title'   => esc_html__( 'Single Post options', 'utouch' ),
		'options' => array(
			'single-featured-show' => array(
				'label'        => esc_html__( 'Show featured media?', 'utouch' ),
				'desc'         => esc_html__( 'Featured image or other media on top of post', 'utouch' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'value'        => 'yes',
			),
			'single-author-show' => array(
				'label'        => esc_html__( 'Show author?', 'utouch' ),
				'desc'         => esc_html__( 'Author name and avatar block', 'utouch' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'value'        => 'yes',
			),
			'single-meta-show' => array(
				'label'        => esc_html__( 'Show post meta?', 'utouch' ),
				'desc'         => esc_html__( 'Post time, categories, tags, comments info', 'utouch' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'value'        => 'yes',
			),
			'single-share-show' => array(
				'label'        => esc_html__( 'Show share post buttons?', 'utouch' ),
				'desc'         => esc_html__( 'Show icons that share post on social networks', 'utouch' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'value'        => 'yes',
			),
			'single-author-box-show' => array(
				'label'        => esc_html__( 'Show author box?', 'utouch' ),
				'desc'         => esc_html__( 'Fill in biographical info in author profile first', 'utouch' ),
				'type'         => 'switch',
				'left-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'value'        => 'yes',
			),
		),
	)
);


