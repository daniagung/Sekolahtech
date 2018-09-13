<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$admin_images_path = get_template_directory_uri() . '/images/admin';

$options = array(
	'section_stunning_general' => array(
		'title'   => esc_html__( 'General', 'utouch' ),
		'options' => array(
			'stunning-show' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'value' => array(
						'label'        => esc_html__( 'Show stunning header?', 'utouch' ),
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
						'desc'         => esc_html__( 'Panel after header will be show/hide from frontend', 'utouch' ),
					)
				),
				'choices' => array(
					'yes'  => array(
						'height'    => array(
							'type'  => 'text',
							'value' => '',
							'label' => esc_html__( 'Custom stunning header height', 'utouch' ),
							'desc'  => esc_html__('only numbers allowed', 'utouch'),
						),
						'style' => array(
							'type'    => 'image-picker',
							'value'   => 'style_0',
							'label'   => esc_html__( 'Select section style', 'utouch' ),
							'desc'    => esc_html__( 'Select one of pre-defined section style / layout', 'utouch' ),
							'choices' => array(
								'style_0' => array(
									'small' => array(
										'src'    => $admin_images_path . '/stunning/option-1.png',
										'height' => 90
									),
								),
								'style_1' => array(
									'small' => array(
										'src'    => $admin_images_path . '/stunning/option-2.png',
										'height' => 90
									),
								),
								'style_2' => array(
									'small' => array(
										'src'    => $admin_images_path . '/stunning/option-3.png',
										'height' => 90
									),
								),
								'style_3' => array(
									'small' => array(
										'src'    => $admin_images_path . '/stunning/option-4.png',
										'height' => 90
									),
								),
								'style_4' => array(
									'small' => array(
										'src'    => $admin_images_path . '/stunning/option-5.png',
										'height' => 90
									),
								),
								'style_5' => array(
									'small' => array(
										'src'    => $admin_images_path . '/stunning/option-6.png',
										'height' => 90
									),
								),
							),
							'blank'   => false
						)
					),
				),
			),
		),
	),
	'section_stunning_design' => array(
		'title'   => esc_html__( 'Design', 'utouch' ),
		'options' => array(
			'stunning_text_color' => array(
				'type'  => 'color-picker',
				'label' => esc_html__( 'Text Color', 'utouch' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
				'value' => '#fff'
			),
			'stunning_link_color' => array(
				'type'  => 'color-picker',
				'label' => esc_html__( 'Category Color', 'utouch' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
				'value' => '#fff'
			),

			'stunning_background_color' => array(
				'label' => esc_html__( 'Background Color', 'utouch' ),
				'desc'  => esc_html__( 'Please select the background color', 'utouch' ),
				'type'  => 'color-picker',
				'value' => '#273f5b',
			),
			'stunning_overlay_color' => array(
				'label' => esc_html__( 'Overlay Color', 'utouch' ),
				'desc'  => esc_html__( 'Please select color of overlay', 'utouch' ),
				'type'  => 'rgba-color-picker',
				'value' => '',
			),
			'stunning_bg_options' => array(
				'type'         => 'multi-picker',
				'label'        => false,
				'desc'         => false,
				'picker'       => array(
					'selected' => array(
						'label'   => false,
						'desc'    => esc_html__( 'Type of background', 'utouch' ),
						'type'    => 'image-picker',
						'value'   => 'image_bg',
						'choices' => array(
							'image_bg' => get_template_directory_uri() . '/images/admin/image_bg.png',
							'video_bg' => get_template_directory_uri() . '/images/admin/video_bg.png',
						),
					),
				),
				'choices'      => array(
					'image_bg' => array(

						'background_image' => array(
							'label' => esc_html__( 'Background Image', 'utouch' ),
							'desc'  => esc_html__( 'Please select the background image', 'utouch' ),
							'type'  => 'upload',
						),

						'bg_effect'  => array(
							'type'    => 'radio',
							'label'   => esc_html__( 'Image Effect', 'utouch' ),
							'desc'    => esc_html__( 'Select effect for background image', 'utouch' ),
							'choices' => array(
								''      => esc_html__( 'None', 'utouch' ),
								'tilt'  => esc_html__( 'Tilt Effect', 'utouch' ),
								'fixed' => esc_html__( 'Fixed Image', 'utouch' ),
							),
							'inline'  => true,
						),
						'image_size' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Background Size', 'utouch' ),
							'choices' => array(
								''        => esc_html__( 'Default', 'utouch' ),
								'cover'   => esc_html__( 'Cover', 'utouch' ),
								'contain' => esc_html__( 'Contain', 'utouch' ),
							),
						),
					),
					'video_bg' => array(
						'placeholder'   => array(
							'label' => esc_html__( 'Placeholder Image', 'utouch' ),
							'desc'  => esc_html__( 'Please select placeholder image', 'utouch' ),
							'type'  => 'upload',
						),

						'selected'      => array(
							'type'    => 'multi-picker',
							'label'   => false,
							'desc'    => false,
							'picker'  => array(
								'source' => array(
									'label'        => esc_html__( 'Video Source', 'utouch' ),
									'type'         => 'switch',
									'right-choice' => array(
										'value' => 'oembed',
										'label' => esc_html__( 'Youtube', 'utouch' ),
									),
									'left-choice'  => array(
										'value' => 'self',
										'label' => esc_html__( 'Self hosted', 'utouch' ),
									),
									'value'        => 'oembed',
								),
							),
							'choices' => array(
								'oembed' => array(
									'source' => array(
										'label' => esc_html__( 'Video Link', 'utouch' ),
										'desc'  => esc_html__( 'Insert Video URL to embed this video', 'utouch' ),
										'type'  => 'oembed',
									),
								),
								'self'   => array(
									'mp4'  => array(
										'type'  => 'upload',
										'label' => esc_html__( 'Link to mp4 video', 'utouch' ),
										'desc'  => esc_html__( 'Source of uploaded video', 'utouch' ),
										'images_only' => false,
									),
									'webm' => array(
										'type'  => 'upload',
										'label' => esc_html__( 'Link to webm video', 'utouch' ),
										'desc'  => esc_html__( 'Source of uploaded video', 'utouch' ),
										'images_only' => false,
									),
									'ogg'  => array(
										'type'  => 'upload',
										'label' => esc_html__( 'Link to ogg video', 'utouch' ),
										'desc'  => esc_html__( 'Source of uploaded video', 'utouch' ),
										'images_only' => false,
									),
								),
							),
						),

					),
				),
			),
		),
	),
	'section_stunning_elements' => array(
		'title'   => esc_html__( 'Elements', 'utouch' ),
		'options' => array(
			'stunning_title' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'show' => array(
						'type'  => 'switch',
						'label' => esc_html__( 'Page Title', 'utouch' ),
						'desc'  => esc_html__( 'Text with page title in stunning header section', 'utouch' ),
						'left-choice' => array(
							'value' => 'no',
							'label' => esc_html__( 'Hide', 'utouch' )
						),
						'right-choice'  => array(
							'value' => 'yes',
							'label' => esc_html__( 'Show', 'utouch' )

						),
						'value'        => 'yes',
					),
				),
				'choices' => array(

				),
			),
			'stunning_category'   => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Category', 'utouch' ),
				'desc'  => esc_html__( 'Display category / taxonomy with link in stunning header section', 'utouch' ),
				'left-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'right-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'value'        => 'no',
			),
			'stunning_breadcrumbs'   => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Breadcrumbs', 'utouch' ),
				'desc'  => esc_html__( 'Breadcrumbs in stunning header section', 'utouch' ),
				'left-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'right-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'value'        => 'yes',
			),
			'stunning_author'   => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Author info', 'utouch' ),
				'desc'  => esc_html__( 'Info about post author ( only for posts / pages )', 'utouch' ),
				'left-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'right-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'value'        => 'no',
			),
			'stunning_additional'   => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Additional info', 'utouch' ),
				'desc'  => esc_html__( 'Info about event / course / etc ( only when available )', 'utouch' ),
				'left-choice' => array(
					'value' => 'no',
					'label' => esc_html__( 'Hide', 'utouch' )
				),
				'right-choice'  => array(
					'value' => 'yes',
					'label' => esc_html__( 'Show', 'utouch' )
				),
				'value'        => 'no',
			),
		),
	),
);


