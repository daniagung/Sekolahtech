<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$grid_link = '<a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grid</a>';
$options   = array(
	'section_footer_design' => array(
		'title'   => esc_html__( 'Design', 'utouch' ),
		'options' => array(
			'footer_text_color'  => array(
				'type'  => 'color-picker',
				'label' => esc_html__( 'Text Color', 'utouch' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
				'value' => '#9db5d4',
			),
			'footer_title_color' => array(
				'type'  => 'color-picker',
				'value' => '#fffff',
				'label' => esc_html__( 'Widget Titles and Links  Color', 'utouch' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
			),
			'footer_bg_image'    => array(
				'type'    => 'background-image',
				'value'   => 'bg-0',
				'label'   => esc_html__( 'Background image', 'utouch' ),
				'desc'    => esc_html__( 'Select one of images or upload your own pattern', 'utouch' ),
				'choices' => utouch_backgrounds()
			),
			'footer_bg_cover'    => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Expand background', 'utouch' ),
				'desc'  => esc_html__( 'Don\'t repeat image and expand it to full section background', 'utouch' ),
			),
			'footer_fixed'       => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Fixed footer effect', 'utouch' ),
				'desc'  => esc_html__( 'Add sliding effect for your footer.', 'utouch' ),
			),
			'footer_bg_color'    => array(
				'type'  => 'color-picker',
				'value' => '#3e4d50',
				'label' => esc_html__( 'Background Color', 'utouch' ),
				'desc'  => esc_html__( 'If you choose no image to display - that color will be set as background', 'utouch' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
			),
		),
	),
	'section_widgets'       => array(
		'title'   => esc_html__( 'Widgets section', 'utouch' ),
		'options' => array(
			'site-description' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'value' => array(
						'label'        => esc_html__( 'Show text block', 'utouch' ),
						'type'         => 'switch',
						'left-choice'  => array(
							'value' => 'yes',
							'label' => esc_html__( 'Show', 'utouch' )
						),
						'right-choice' => array(
							'value' => 'no',
							'label' => esc_html__( 'Hide', 'utouch' )
						),
						'value'        => 'no',
						'desc'         => esc_html__( 'Text block with description in footer', 'utouch' ),
					)
				),
				'choices' => array(
					'yes' => array(
						'width-columns' => array(
							'type'       => 'slider',
							'value'      => 7,
							'properties' => array(
								'min'       => 2,
								'max'       => 12,
								'step'      => 1,
								'grid_snap' => true
							),
							'label'      => esc_html__( 'Text block width', 'utouch' ),
							'desc'       => esc_html__( 'Select width in 12 column grid', 'utouch' ),
							'help'       => esc_html__( 'More about grid and columns you can read here', 'utouch' ) . ' - ' . $grid_link,
						),
						'description'   => array(
							'type'          => 'popup',
							'label'         => esc_html__( 'Text block Content', 'utouch' ),
							'desc'          => esc_html__( 'Click on button below to edit block content', 'utouch' ),
							'popup-title'   => null,
							'button'        => esc_html__( 'Edit Text Block Content', 'utouch' ),
							'size'          => 'medium', // small, medium, large
							'popup-options' => array(
								'title' => array(
									'title' => esc_html__( 'Title', 'utouch' ),
									'type'  => 'text',
								),
								'desc'  => array(
									'type'          => 'wp-editor',
									'label'         => esc_html__( 'Text in column', 'utouch' ),
									'desc'          => esc_html__( 'Text in left footer column', 'utouch' ),
									'tinymce'       => true,
									'media_buttons' => true,
									'wpautop'       => true,
									'size'          => 'small',
									'editor_type'   => 'tinymce',
									'editor_height' => 200,
								),
							),
						),
						'class'         => array(
							'title' => esc_html__( 'Additional class', 'utouch' ),
							'type'  => 'text',
							'desc'  => esc_html__( 'Custom CSS class will be added to this block', 'utouch' ),
						),

					),

				),
			),
		),
	),
	'section_copyright'     => array(
		'title'   => esc_html__( 'Copyright field', 'utouch' ),
		'options' => array(
			'footer_copyright'     => array(
				'type'  => 'textarea',
				'label' => esc_html__( 'Copyright text', 'utouch' ),
				'value' => 'Site is built on <a href="https://wordpress.org" class="sub-footer__link">WordPress</a> by Crumina <a href="https://crumina.net">Theme Development</a>',
			),

			'copyright_bg_color'   => array(
				'type'  => 'color-picker',
				'label' => esc_html__( 'Background Color', 'utouch' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
			),
			'copyright_text_color' => array(
				'type'  => 'color-picker',
				'label' => esc_html__( 'Text Color', 'utouch' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
				'value' => '#6987ab',
			),
		),
	),
	'section_scroll_top'    => array(
		'title'   => esc_html__( 'Scroll Top Button', 'utouch' ),
		'options' => array(
			'scroll_top_icon' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'value' => array(
						'label'        => esc_html__( 'Show Scroll to top button?', 'utouch' ),
						'type'         => 'switch',
						'right-choice'  => array(
							'value' => 'yes',
							'label' => esc_html__( 'Show', 'utouch' )
						),
						'left-choice' => array(
							'value' => 'no',
							'label' => esc_html__( 'Hide', 'utouch' )
						),
						'value'        => 'yes',
						'desc'         => esc_html__( 'Display or hide button that scroll page to top on click.', 'utouch' ),
					)
				),
				'choices' => array(
					'yes' => array(
						'fixed' => array(
							'type'  => 'switch',
							'label' => esc_html__( 'Become fixed', 'utouch' ),
							'desc'  => esc_html__( 'Make button fixed. By default will be shown in footer only', 'utouch' ),
						),
					)
				),
			),
		),
	),
);


