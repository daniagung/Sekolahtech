<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	'post-quote'   => array(
		'type'    => 'box',
		'title'   => esc_html__( 'Quote post options', 'utouch' ),
		'options' => array(
			'quote_author' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Quote author', 'utouch' ),
			),
			'quote_dopinfo' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Author profession', 'utouch' ),
			),
			'quote_avatar' => array(
				'type'  => 'upload',
				'images_only' => true,
				'label' => esc_html__( 'Author avatar', 'utouch' ),
			),
			'quote_text_color' => array(
				'type'  => 'color-picker',
				'label' => esc_html__( 'Text Color', 'utouch' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
			),
		),
		'context' => 'advanced',
		'priority' => 'high',
	),
	'post-image'   => array(
		'type'    => 'box',
		'options' => array(
			'enable_overlay' => array(
				'type'  => 'checkbox',
				'value' => true,
				'label' => esc_html__( 'Enable Image Overlay', 'utouch' ),
				'desc'  => esc_html__( 'Darken semi-transparent overlay over image', 'utouch' ),
				'text'  => esc_html__( 'Yes', 'utouch' ),
			)
		),
		'title'   => esc_html__( 'Image post options', 'utouch' ),
		'context' => 'side',
		'priority' => 'high',
	),
	'post-video'   => array(
		'type'     => 'box',
		'options'  => array(
			'video_oembed' => array(
				'type'    => 'oembed',
				'label'   => esc_html__( 'Link to video', 'utouch' ),
				'desc'    => esc_html__( 'Enter link for video that will be embedded', 'utouch' ),
				'help'    => esc_html__( 'More information about WordPress embeds:', 'utouch' ) . '<br> <a href="https://codex.wordpress.org/Embeds">https://codex.wordpress.org/Embeds</a>',
				'preview' => array(
					'width'      => 640, // optional, if you want to set the fixed width to iframe
					'height'     => 480, // optional, if you want to set the fixed height to iframe
					/**
					 * if is set to false it will force to fit the dimensions,
					 * because some widgets return iframe with aspect ratio and ignore applied dimensions
					 */
					'keep_ratio' => true
				)
			)
		),
		'title'    => esc_html__( 'Video post options', 'utouch' ),
		'context' => 'advanced',
		'priority' => 'high',
	),
	'post-audio'   => array(
		'type'     => 'box',
		'options'  => array(
			'audio_oembed' => array(
				'type'    => 'oembed',
				'label'   => esc_html__( 'Link to audio', 'utouch' ),
				'value'   => 'https://soundcloud.com/',
				'desc'    => esc_html__( 'Enter link for video that will be embedded', 'utouch' ),
				'help'    => esc_html__( 'More information about WordPress embeds:', 'utouch' ) . '<br> <a href="https://codex.wordpress.org/Embeds">https://codex.wordpress.org/Embeds</a>',
				'preview' => array(
					'width'      => 690, // optional, if you want to set the fixed width to iframe
					'height'     => 180, // optional, if you want to set the fixed height to iframe
					'keep_ratio' => true
				)
			)
		),
		'title'    => esc_html__( 'Audio post options', 'utouch' ),
		'context' => 'advanced',
		'priority' => 'high',
	),
	'post-gallery' => array(
		'type'     => 'box',
		'options'  => array(
			'gallery_images' => array(
				'type'        => 'multi-upload',
				'label'       => esc_html__( 'Images in slider on post list:', 'utouch' ),
				'desc'        => esc_html__( 'Images that will be displayed in slider on post list pages', 'utouch' ),
				'images_only' => true,
			)
		),
		'title'    => esc_html__( 'Gallery post options', 'utouch' ),
		'context' => 'advanced',
		'priority' => 'high',
	),
	'design-customize' => array(
		'title'    => esc_html__( 'Customize design', 'utouch' ),
		'type'     => 'box',
		'priority' => 'high',
		'options'  => array(
			'header'          => array(
				'title'   => esc_html__( 'Header', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'custom-header' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'enable' => array(
								'label' => esc_html__( 'Change settings?', 'utouch' ),
								'desc'  => esc_html__( 'Extra settings for element. Will affect only on current page.', 'utouch' ),
								'type'  => 'switch',
								'right-choice' => array(
									'value' => 'yes',
									'label' => esc_html__( 'Yes', 'utouch' )
								),
								'left-choice'  => array(
									'value' => 'no',
									'label' => esc_html__( 'No', 'utouch' )
								),
								'value'        => 'no',
							),
						),
						'choices' => array(
							'yes' => array(
								fw()->theme->get_options( 'metabox-header' ),
							),
						),
					),
				),
			),
			'stunning-header' => array(
				'title'   => esc_html__( 'Stunning Header', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					fw()->theme->get_options( 'metabox-stunning' ),
				),
			),

		),
	),
);