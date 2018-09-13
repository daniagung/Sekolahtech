<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


$options = array(
	'section_event_archive' => array(
		'title'   => esc_html__( 'Archive / Category options', 'utouch' ),
		'options' => array(),
	),
	'section_event_single'  => array(
		'title'   => esc_html__( 'Single Event options', 'utouch' ),
		'options' => array(
            
            'tab_labels' => array(
                'attr'          => array(
                    'class' => 'fw-advanced-button'
                ),
                'type'          => 'popup',
                'label'         => esc_html__( 'Tab labels', 'utouch' ),
                'button'        => esc_html__( 'Change tab labels', 'utouch' ),
                'size'          => 'medium',
                'popup-options' => fw()->theme->get_options( 'option-event-tabs' ),
            ),
            
            'event_show_share' => array(
				'label'        => esc_html__( 'Show share?', 'utouch' ),
				'type'         => 'switch',
				'right-choice' => array(
					'value' => 'yes',
					'label' => esc_html__( 'Yes', 'utouch' )
				),
				'left-choice'  => array(
					'value' => 'no',
					'label' => esc_html__( 'No', 'utouch' )
				),
				'value'        => 'yes',
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
	)
);


