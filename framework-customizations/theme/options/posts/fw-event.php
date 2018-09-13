<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$min_date         = '1970/01/01';
$max_date         = '2038/01/19';
$users_list       = wp_list_pluck( get_users( array(
	'fields'  => array( 'user_email', 'display_name' ),
	'orderby' => 'display_name'
) ), 'display_name', 'user_email' );
$grid_link        = '<a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap Grid</a>';
$admin_images_path = get_template_directory_uri() . '/images/admin';
$options          = array(


	'event-options' => array(
		'title'    => false,
		'type'     => 'box',
		'priority' => 'high',
		'options'  => array(
			'general'         => array(
				'title'   => esc_html__( 'General', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'event_general' => array(
						'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => array(
							'enable' => array(
								'label'        => esc_html__( 'Change settings?', 'utouch' ),
								'desc'         => esc_html__( 'Extra settings for element. Will affect only on current page.', 'utouch' ),
								'type'         => 'switch',
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
								'event_show_share' => array(
									'label'   => esc_html__( 'Show share?', 'utouch' ),
									'type'    => 'select',
									'choices' => array(
										'default' => esc_html__( 'Default', 'utouch' ),
										'yes'     => esc_html__( 'Show', 'utouch' ),
										'no'      => esc_html__( 'Hide', 'utouch' ),
									),
									'value'   => 'default',
								),

								'event_navigation' => array(
									'type'    => 'multi-picker',
									'label'   => false,
									'desc'    => false,
									'picker'  => array(
										'type' => array(
											'label'   => esc_html__( 'Navigation', 'utouch' ),
											'type'    => 'select',
											'choices' => array(
												'default' => esc_html__( 'Default', 'utouch' ),
												'none'     => esc_html__( 'None', 'utouch' ),
												'prev_next'      => esc_html__( 'Prev, Next events', 'utouch' ),
												'related'      => esc_html__( 'Related events', 'utouch' ),
											),
											'value'   => 'default',
										),
									),
									'choices' => array(
										'prev_next' => array(
											'page_select' => array(
												'type'    => 'select',
												'label'   => esc_html__( 'Primary event page', 'utouch' ),
												'desc'    => esc_html__( 'Select a page which center icon will be linked to', 'utouch' ),
												'choices' => wp_list_pluck( get_pages(), 'post_title', 'ID' ),
											),
										),
										'related' => array(
											'title' => array(
												'type'       => 'text',
												'label'      => esc_html__( 'Related events section title', 'utouch' ),
												'value' => esc_html__( 'You May Also Like', 'utouch' ),
											),
											'post_count' => array(
												'type'  => 'slider',
												'value' => 5,
												'properties' => array(

													'min' => 1,
													'max' => 10,
													'step' => 1, // Set slider step. Always > 0. Could be fractional.

												),
												'label' => esc_html__('Events to show', 'utouch'),
											),
										),
									),
								),

							),
						),
					),

				),
			),
			//general tab end
			'content'         => array(
				'title'   => esc_html__( 'Content', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'event_content_title' => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__( 'Tab title', 'utouch' ),
					),
					'event_content_desc'  => array(
						'type'  => 'textarea',
						'value' => '',
						'label' => esc_html__( 'Tab description', 'utouch' ),
					),

				),
			),
			//content tab end
			'schedule'        => array(
				'title'   => esc_html__( 'Schedule', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'show_schedule_tab'    => array(
						'label'        => esc_html__( 'Show schedule tab?', 'utouch' ),
						'type'         => 'switch',
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
					'event_schedule_title' => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__( 'Tab title', 'utouch' ),
					),
					'event_schedule_desc'  => array(
						'type'  => 'textarea',
						'value' => '',
						'label' => esc_html__( 'Tab description', 'utouch' ),
					),

					'event_all_day' => array(
						'label'        => __( 'All Day Event?', 'utouch' ),
						'desc'         => __( 'Is your event an all day event?', 'utouch' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yes',
							'label' => __( 'Yes', 'utouch' )
						),
						'left-choice'  => array(
							'value' => 'no',
							'label' => __( 'No', 'utouch' )
						),
						'value'        => 'no',
					),

					'schedule_group' => array(
						'label'         => __( 'Date & Time', 'utouch' ),
						'popup-title'   => __( 'Add/Edit Date & Time', 'utouch' ),
						'type'          => 'addable-popup',
						'desc'          => false,
						'attr'          => array( 'class' => 'fw-event-datetime' ),
						'template'      => '{{  if (schedule_date_range.from !== "" || schedule_date_range.to !== "") {  print(schedule_date_range.from + " - " + schedule_date_range.to)} else { print("' . __( 'Note: Please set start & end event datetime', 'utouch' ) . '")} }}',
						'popup-options' => array(

							'schedule_date_range' => array(
								'type'             => 'datetime-range',
								'label'            => __( 'Start & End of Event', 'utouch' ),
								'desc'             => __( 'Set start and end events datetime', 'utouch' ),
								'datetime-pickers' => array(
									'from' => array(
										'maxDate'       => $max_date,
										'minDate'       => $min_date,
										'timepicker'    => true,
										'datepicker'    => true,
										'defaultTime'   => '08:00',
										'step'          => '30',

									),
									'to'   => array(
										'maxDate'       => $max_date,
										'minDate'       => $min_date,
										'timepicker'    => true,
										'datepicker'    => true,
										'defaultTime'   => '18:00',
										'step'          => '30',

									)
								),
							),

							'schedule_title' => array(
								'type'  => 'text',
								'value' => '',
								'label' => esc_html__( 'Title', 'utouch' ),
							),
							'schedule_desc'  => array(
								'type'  => 'textarea',
								'value' => '',
								'label' => esc_html__( 'Description', 'utouch' ),
							),
						),
					),


				),
			),
			//schedule tab end
			'speakers'        => array(
				'title'   => esc_html__( 'Speakers', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'show_speakers_tab'    => array(
						'label'        => esc_html__( 'Show speakers tab?', 'utouch' ),
						'type'         => 'switch',
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
					'event_speakers_title' => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__( 'Tab title', 'utouch' ),
					),
					'event_speakers_desc'  => array(
						'type'  => 'textarea',
						'value' => '',
						'label' => esc_html__( 'Tab description', 'utouch' ),
					),


					'event_speaker_user' => array(
						'type'    => 'multi-select',
						'label'   => __( 'Speakers', 'utouch' ),
						'choices' => $users_list,
						'desc'    => __( 'Choose event speakers ', 'utouch' ),
						'value'   => array()
					),

				),
			),
			//speakers tab end
			'location'        => array(
				'title'   => esc_html__( 'Location', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'show_location_tab'    => array(
						'label'        => esc_html__( 'Show location tab?', 'utouch' ),
						'type'         => 'switch',
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
					'event_location_title' => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__( 'Tab title', 'utouch' ),
					),
					'event_location_desc'  => array(
						'type'  => 'textarea',
						'value' => '',
						'label' => esc_html__( 'Tab description', 'utouch' ),
					),


					'_gmaps_api_key' => array(
						'type'  => 'gmap-key',
						'label' => esc_html__( 'Maps API Key','utouch' ),
						'desc'  => sprintf(
							__( 'Create an application in %sGoogle Console%s and add the Key here.', 'utouch' ),
							'<a target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=places_backend,maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true">',
							'</a>'
						),
					),

					'event_location' => array(
						'label' => __( 'Event Location', 'utouch' ),
						'type'  => 'map',
						'desc'  => __( 'Where does the event take place?', 'utouch' ),
					),

					'event_location_contacts' => array(
						'type' => 'addable-popup',

						'label'           => esc_html__( 'Contacts', 'utouch' ),
						'template'        => '{{- contact }}',
						'popup-title'     => esc_html__( 'Add event contacts', 'utouch' ),
						'size'            => 'small', // small, medium, large
						'limit'           => 0, // limit the number of popup`s that can be added
						'add-button-text' => esc_html__( 'Add', 'utouch' ),
						'sortable'        => true,
						'popup-options'   => array(
							'contact_type' => array(
								'type'    => 'select',
								'value'   => 'text',
								'label'   => esc_html__( 'Type', 'utouch' ),
								'choices' => array(
									'text'   => esc_html__( 'Text', 'utouch' ),
									'tel'    => esc_html__( 'Telephone', 'utouch' ),
									'mailto' => esc_html__( 'Email', 'utouch' ),
								),
							),
							'contact'      => array(
								'label' => esc_html__( 'Contact', 'utouch' ),
								'type'  => 'text',
								'value' => '',
							),

						),
					),


				),
			),
			//location tab end
			'get_in_touch'    => array(
				'title'   => esc_html__( 'Get in touch', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'show_get_in_touch_tab'    => array(
						'label'        => esc_html__( 'Show get in touch?', 'utouch' ),
						'desc'         => esc_html__( 'Get in touch block will be located in "Location" tab', 'utouch' ),
						'type'         => 'switch',
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
					'event_get_in_touch_title' => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__( 'Title', 'utouch' ),
					),
					'event_get_in_touch_desc'  => array(
						'type'  => 'textarea',
						'value' => '',
						'label' => esc_html__( 'Description', 'utouch' ),
					),
					'get_in_touch_email'       => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__( 'Email', 'utouch' ),
					),
					'get_in_touch_button'      => array(
						'label'         => esc_html__( 'Button style', 'utouch' ),
						'button'        => esc_html__( 'Add button', 'utouch' ),
						'size'          => 'small',
						'type'          => 'popup',
						'template'      => '{{-button_label }}',
						'popup-options' => array(
							'button_label' => array(
								'label' => esc_html__( 'Button Label', 'utouch' ),
								'desc'  => esc_html__( 'This is the text that appears on your button', 'utouch' ),
								'type'  => 'text',
								'value' => esc_html__( 'Event link', 'utouch' ),
							),
							'button_color' => array(
								'type'    => 'select',
								'value'   => 'primary',
								'label'   => esc_html__( 'Button color', 'utouch' ),
								'desc'    => esc_html__( 'Choose button color', 'utouch' ),
								'choices' => utouch_button_colors(),
							),
						),
					),

				),
			),
			//get in touch tab end
			'aside_block'     => array(
				'title'   => esc_html__( 'Aside block', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'show_aside_block'        => array(
						'label'        => esc_html__( 'Show aside block?', 'utouch' ),
						'type'         => 'switch',
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
					'event_countdown_title'   => array(
						'type'  => 'text',
						'value' => '',
						'label' => esc_html__( 'Countdown title', 'utouch' ),
					),
					'event_main_speaker_user' => array(
						'type'    => 'multi-select',
						'label'   => __( 'Main speaker', 'utouch' ),
						'choices' => $users_list,
						'desc'    => __( 'Choose event main speakers ', 'utouch' ),
						'limit'   => 1,

					),
					'event_countdown_button'  => array(
						'label'         => esc_html__( 'Event link', 'utouch' ),
						'button'        => esc_html__( 'Button settings', 'utouch' ),
						'size'          => 'small',
						'type'          => 'popup',
						'template'      => '{{- button.style }}',
						'popup-options' => array(
							'button'       => array(
								'label' => esc_html__( 'Button Label', 'utouch' ),
								'desc'  => esc_html__( 'This is the text that appears on your button', 'utouch' ),
								'type'  => 'text',
								'value' => esc_html__( 'Event link', 'utouch' ),
							),
							'button-color' => array(
								'type'    => 'select',
								'value'   => 'primary',
								'label'   => esc_html__( 'Button color', 'utouch' ),
								'desc'    => esc_html__( 'Choose button color', 'utouch' ),
								'choices' => utouch_button_colors(),
							),
							fw()->theme->get_options( 'option-link' ),
						),
					),

				),
			),
			//aside block end
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
								'label'        => esc_html__( 'Change settings?', 'utouch' ),
								'desc'         => esc_html__( 'Extra settings for element. Will affect only on current page.', 'utouch' ),
								'type'         => 'switch',
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


			'preview-style' => array(
				'title'   => esc_html__( 'Preview style', 'utouch' ),
				'type'    => 'tab',
				'options' => array(
					'preview_style' => array(
						'type'    => 'image-picker',
						'value'   => '1',
						'label'   => esc_html__( 'Preview style', 'utouch' ),
						'desc'    => esc_html__( 'Choose preview style on event loop page', 'utouch' ),
						'choices' => array(
							'1'   => array(
								'small' => array(
									'src' => $admin_images_path.'/event/half.png',
									'height' => 90
								),
							),
							'2' => array(
								'small' => array(
									'src' => $admin_images_path.'/event/full-count.png',
									'height' => 90
								),
							),
							'3' => array(
								'small' => array(
									'src' => $admin_images_path.'/event/full.png',
									'height' => 90
								),
							),
						),
						'blank'   => false
					),

					'preview_style_size' => array(
						'type'    => 'radio',
						'value'   => 'small',
						'label'   => esc_html__( 'Preview size', 'utouch' ),
						'desc'    => esc_html__( 'Choose preview size', 'utouch' ),
						'choices' => array(
							'small' => esc_html__( 'Small', 'utouch' ),
							'big' => esc_html__( 'Big', 'utouch' ),
						),

						'no-validate' => false,
					),
					'event_category' => array(
						'type'    => 'group',
						'options' => array(
							'custom-category'   => array(
								'attr'          => array(
									'data-advanced-for' => 'stunning-content',
									'class'             => 'fw-advanced-button'
								),
								'type'          => 'popup',
								'label'         => esc_html__( 'Custom Content', 'utouch' ),
								'desc'          => esc_html__( 'Change the content of this section', 'utouch' ),
								'button'        => esc_html__( 'Change settings', 'utouch' ),
								'size'          => 'medium',
								'popup-options' => fw()->theme->get_options( 'metabox-event-category' ),
							),
							'category-settings' => array(
								'attr'         => array( 'class' => 'stunning-content' ),
								'type'         => 'switch',
								'value'        => 'yes',
								'label'        => esc_html__( 'Change category settings?', 'utouch' ),
								'desc'         => esc_html__( 'Panel after header will be show/hide from frontend', 'utouch' ),
								'left-choice'  => array(
									'value' => 'yes',
									'label' => esc_html__( 'No', 'utouch' )
								),
								'right-choice' => array(
									'value' => 'no',
									'label' => esc_html__( 'Yes', 'utouch' )
								)
							),
						),
					),

				),
			),
            
            'tab-labels' => array(
                'title'   => esc_html__( 'Tab labels', 'utouch' ),
                'type'    => 'tab',
                'options' => array(
                    'custom-tab-labels' => array(
                        'type'    => 'multi-picker',
                        'label'   => false,
                        'desc'    => false,
                        'picker'  => array(
                            'enable' => array(
                                'label'        => esc_html__( 'Change settings?', 'utouch' ),
                                'desc'         => esc_html__( 'Extra settings for element. Will affect only on current page.', 'utouch' ),
                                'type'         => 'switch',
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
                                fw()->theme->get_options( 'option-event-tabs' ),
                            ),
                        ),
                    ),
                )
            ),
            
        ),
	),
);