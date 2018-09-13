<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$admin_images_path = get_template_directory_uri() . '/images/admin';

$options = array(
	'section_top_bar'       => array(
		'title'   => esc_html__( 'Top bar', 'utouch' ),
		'options' => array(
			'sections-top-bar' => array(
				'type'         => 'multi-picker',
				'label'        => false,
				'desc'         => false,
				'value'        => array(
					'status' => 'hide',
					'show'   => array(
						'theme-style' => 'top-bar-dark',
					),
				),
				'picker'       => array(
					'status' => array(
						'type'         => 'switch',
						'label'        => esc_html__( 'Top bar', 'utouch' ),
						'left-choice'  => array(
							'value' => 'show',
							'label' => esc_html__( 'Show', 'utouch' ),
						),
						'right-choice' => array(
							'value' => 'hide',
							'label' => esc_html__( 'Hide', 'utouch' ),
						),
					),
				),
				'choices'      => array(
					'show' => array(
						'theme-style'     => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Color scheme', 'utouch' ),
							'choices' => array(
								''             => esc_html__( 'White', 'utouch' ),
								'top-bar-dark' => esc_html__( 'Dark', 'utouch' ),
							),
						),
						'show-languages'  => array(
							'type'    => 'multi-picker',
							'label'   => false,
							'desc'    => false,
							'value'   => array(
								'status' => 'hide',

							),
							'picker'  => array(
								'status' => array(
									'type'         => 'switch',
									'label'        => esc_html__( 'Languages selector', 'utouch' ),
									'desc'         => esc_html__( 'Works only with translate plugin  ', 'utouch' ),
									'left-choice'  => array(
										'value' => 'show',
										'label' => esc_html__( 'Show', 'utouch' ),
									),
									'right-choice' => array(
										'value' => 'hide',
										'label' => esc_html__( 'Hide', 'utouch' ),
									),
								),
							),
							'choices' => array(
								'show' => array(
									'language-select' => array(
										'type'    => 'multi-picker',
										'label'   => false,
										'desc'    => false,
										'value'   => array(
											'status' => 'theme-select',
										),
										'picker'  => array(
											// '<custom-key>' => option
											'status' => array(
												'type'    => 'radio',
												'label'   => esc_html__( 'Use language switcher', 'utouch' ),
												'choices' => array( // Note: Avoid bool or int keys http://bit.ly/1cQgVzk
													'theme-select'  => esc_html__( 'WPML or Polylang switcher', 'utouch' ),
													'plugin-select' => esc_html__( 'Other plugin shortcode', 'utouch' ),
												),
											),
										),
										'choices' => array(
											'plugin-select' => array(
												'shortcode' => array(
													'type'  => 'text',
													'label' => esc_html__( 'Provide plugin selector shortcode', 'utouch' ),
												),
											),

										),

									),
								),

							),

						),
						'info-boxes'      => array(
							'type'        => 'addable-box',
							'label'       => esc_html__( 'Text fields', 'utouch' ),
							'desc'        => esc_html__( 'Add you phone, email etc.', 'utouch' ),
							'value'       => array(
								array(
									'info' => 'info@utouch.com',
								),
							),
							'box-options' => array(

								'info' => array(
									'label' => esc_html__( 'Text', 'utouch' ),
									'type'  => 'text'
								),
							),
							'template'    => '{{- info  }}', // box title

							'limit'           => 0, // limit the number of boxes that can be added
							'add-button-text' => esc_html__( 'Add field', 'utouch' ),
							'sortable'        => true,
						),
						'social-networks' => array(
							'type'            => 'addable-box',
							'label'           => esc_html__( 'Social networks', 'utouch' ),
							'value'           => array(
								array(
									'link' => 'https://www.facebook.com/',
									'icon' => 'facebook.svg',
								),
								array(
									'link' => 'https://www.youtube.com/',
									'icon' => 'youtube.svg',
								),
								array(
									'link' => 'https://twitter.com',
									'icon' => 'twitter.svg',
								),
								array(
									'link' => 'https://vk.com/',
									'icon' => 'vk.svg',
								),

							),
							'box-options'     => array(
								'link' => array(
									'label' => esc_html__( 'Link to social network page', 'utouch' ),
									'type'  => 'text',
								),
								'icon' => array(
									'label'   => esc_html__( 'Icon', 'utouch' ),
									'type'    => 'select',
									'value'   => 'phone',
									'choices' => utouch_social_network_icons()
								),
							),
							'template'        => 'Icon - {{- icon }}', // box title
							'limit'           => 0,
							'add-button-text' => esc_html__( 'Add icon', 'utouch' ),
							'desc'            => esc_html__( 'Icons of social networks with links to profile', 'utouch' ),
							'sortable'        => true,
						),
						'icons-style'     => array(
							'type'    => 'radio',
							'label'   => esc_html__( 'Icons style', 'utouch' ),
							'value'   => 'plain',
							'choices' => array(
								'colored' => esc_html__( 'Colored', 'utouch' ),
								'plain'   => esc_html__( 'Text color', 'utouch' ),
							),
						),
					),
				),
				'show_borders' => true,
			)
		),
	),
	'section_header_design' => array(
		'title'   => esc_html__( 'Design', 'utouch' ),
		'options' => array(
			'decorative-line'    => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Top decorative line', 'utouch' ),
				'value'        => 'show',
				'left-choice'  => array(
					'value' => 'hide',
					'label' => esc_html__( 'Hide', 'utouch' ),
				),
				'right-choice' => array(
					'value' => 'show',
					'label' => esc_html__( 'Show', 'utouch' ),
				),

			),
			'header_bg_color'    => array(
				'type'  => 'color-picker',
				'label' => esc_html__( 'Background Color', 'utouch' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
				'value' => '#fff',
			),
			'header-text-color'  => array(
				'type'  => 'color-picker',
				'label' => esc_html__( 'Text Color', 'utouch' ),
				'help'  => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
				'value' => '#6a85a6',
			),
			'dropdown-style'     => array(
				'type' => 'multi-picker',


				'picker' => array(
					'type' => array(
						'type'    => 'image-picker',
						'label'   => esc_html__( 'Menu decoration style', 'utouch' ),
						'choices' => array(
							'default' => array(
								'small' => array(
									'src'    => $admin_images_path . '/default.png',
									'height' => 90
								),
							),
							'1'       => array(
								'small' => array(
									'src'    => $admin_images_path . '/menu/option-1.png',
									'height' => 90
								),
							),
							'2'       =>
								array(
									'small' => array(
										'src'    => $admin_images_path . '/menu/option-3.png',
										'height' => 90
									),
								),
							'3'       => array(
								'small' => array(
									'src'    => $admin_images_path . '/menu/option-2.png',
									'height' => 90
								),
							),
						),
						'blank'   => false
					),
				),

				'choices' => array(
					'2' => array(
						'bg-color' => array(
							'type'     => 'color-picker',
							'palettes' => array(
								'#f6f8f7',
								'#4cc2c0',
								'#f15b26',
								'#fcb03b',
								'#3cb878',
								'#8dc63f',
								'#6739b6'
							),
							'label'    => esc_html__( 'Background color', 'utouch' ),
							'help'     => esc_html__( 'Click on field to choose color or clear field for default value', 'utouch' ),
							'value'    => '#ecf5fe',
						),
					),
				),

				'show_borders' => false,
			),
			'dropdown-animation' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Inner Menu Animation', 'utouch' ),
				'help'    => esc_html__( 'Animation of menu drop-down items', 'utouch' ),
				'value'   => 'drop-up',
				'choices' => array(
					'drop-up'   => 'Drop Up',
					'fade'      => 'Fade',
					'drop-left' => 'Drop Left',
					'zoom-in'   => 'Zoom In',
					'zoom-out'  => 'Zoom out',
					'swing'     => 'Swing',
					'flip'      => 'Flip',
					'roll-in'   => 'Roll In',
					'stretch'   => 'Stretch',
				),
			)
		),
	),
	'section_sticky'        => array(
		'title'   => esc_html__( 'Sticky Header', 'utouch' ),
		'options' => array(
			'sticky_header' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'value' => array(
						'label'        => esc_html__( 'Show sticky header?', 'utouch' ),
						'desc'         => esc_html__( 'Show header sticky to top on page scroll', 'utouch' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Enable', 'utouch' )
						),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'Disable', 'utouch' )
						),
						'value'        => 'yes',
					)
				),
				'choices' => array(
					'yes' => array(
						'style' => array(
							'type'    => 'select',
							'value'   => 'swing',
							'label'   => esc_html__( 'Animations', 'utouch' ),
							'desc'    => esc_html__( 'Header animation when it become sticky', 'utouch' ),
							'choices' => array(
								'swing'  => 'Swing',
								'slide'  => 'Slide',
								'flip'   => 'Flip',
								'bounce' => 'Bounce',
								'none'   => 'No Animation'
							),
							'blank'   => false
						),
						'on_mobile' => array(
							'type'         => 'switch',
							'value'        => false,
							'label'        => esc_html__( 'Sticky header on mobile?', 'utouch' ),
						)
					)
				),
			),
		),
	),
	'section_logo'          => array(
		'title'   => esc_html__( 'Logotype', 'utouch' ),
		'options' => array(
			'logo-image'    => array(
				'label'       => esc_html__( 'Logotype Image', 'utouch' ),
				'type'        => 'upload',
				'images_only' => true,
			),
			'logo-retina'   => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Logo in Retina?', 'utouch' ),
				'desc'  => esc_html__( 'This image wil be displayed twice smaller than uploaded image size.', 'utouch' ),
			),
			'logo-title'    => array(
				'type'  => 'text',
				'label' => esc_html__( 'Logotype text', 'utouch' ),
				'desc'  => esc_html__( 'Write your logo title', 'utouch' ),
				'value' => get_bloginfo( 'name' )
			),
			'logo-subtitle' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Logotype description', 'utouch' ),
				'desc'  => esc_html__( 'Write your logo description', 'utouch' ),
				'value' => get_bloginfo( 'description' )
			),
		),
	),
	'section_search'        => array(
		'title'   => esc_html__( 'Search', 'utouch' ),
		'options' => array(
			'search-icon' => array(
				'type'    => 'multi-picker',
				'label'   => false,
				'desc'    => false,
				'picker'  => array(
					'value' => array(
						'label'        => esc_html__( 'Show search icon?', 'utouch' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__( 'Show', 'utouch' )
						),
						'left-choice'  => array(
							'value' => 'no',
							'label' => esc_html__( 'Hide', 'utouch' )
						),
						'value'        => 'yes',
						'desc'         => esc_html__( 'Will enable search icon in page header', 'utouch' ),
					)
				),
				'choices' => array(
					'yes' => array(
						'style'        => array(
							'type'    => 'image-picker',
							'value'   => 'fullscreen',
							'label'   => esc_html__( 'Select search style', 'utouch' ),
							'desc'    => esc_html__( 'Different styles for search that show on icon click', 'utouch' ),
							'choices' => array(
								'dropdown'   => array(
									'small' => array(
										'src'    => $admin_images_path . '/search/option-1.png',
										'height' => 90
									),
								),
								'fullscreen' => array(
									'small' => array(
										'src'    => $admin_images_path . '/search/option-2.png',
										'height' => 90
									),
								),
							),
							'blank'   => false
						),
						'color-scheme' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Color scheme', 'utouch' ),
							'choices' => array(
								'search--white' => esc_html__( 'White', 'utouch' ),
								'search--dark'  => esc_html__( 'Dark', 'utouch' ),
							),
						),
					)
				),
			),
		),
	),
);