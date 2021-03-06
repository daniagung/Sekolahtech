<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( function_exists( 'kc_add_map' ) ) {
	$sliders = get_posts(
			array(
				'post_type'   => 'fw-slider',
				'numberposts' => - 1
		)
	);
	if ( ! empty( $sliders ) ) {
		foreach ( $sliders as $slider){
			$choices[ $slider->ID ] = empty( $slider->post_title ) ? esc_html__( '(no title)', 'utouch' ) : $slider->post_title;
		}
		$options = array(
			array(
				'name'        => 'slider_id',
				'type'        => 'select',
				'label'       => esc_html__( 'Select Slider', 'utouch' ),
				'description' =>
					str_replace(
						array(
							'{br}',
							'{edit_slider_link}'
						),
						array(
							'<br/>',
							utouch_html_tag( 'a', array(
								'href'   => admin_url( 'edit.php?post_type=fw-slider' ),
								'target' => '_blank',
							), esc_html__( 'change this Slider', 'utouch' ) )
						),
						esc_html__( 'You can edit sliders in admin interface only. {br} Please go to the Sliders page for {edit_slider_link}.', 'utouch' )
					),
				'options'     => $choices
			),
		);
	} else {
		$options = array(
			array(
				'name'        => 'no-forms',
				'type'        => 'html-full',
				'label'       => false,
				'description' => false,
				'admin_view'  => 'html',
				'value'       =>
					'<h3>' . esc_html__( 'No Sliders Available', 'utouch' ) . '</h3>' .
					'<p>' .
					'<em>' .
					str_replace(
						array(
							'{br}',
							'{add_slider_link}'
						),
						array(
							'<br/>',
							utouch_html_tag( 'a', array(
								'href'   => admin_url( 'post-new.php?post_type=fw-slider'),
								'target' => '_blank',
							), esc_html__( 'create a new Slider', 'utouch' ) )
						),
						__( 'No Sliders created yet. Please go to the {br}Sliders page and {add_slider_link}.', 'utouch' )
					) .
					'</em>' .
					'</p>'
				)

		);
	}
	kc_add_map(
		array(
			'fw_slider' => array(
				'name'        => esc_html__( 'Slider', 'utouch' ),
				'description' => esc_html__( 'Display theme slider', 'utouch' ),
				'icon'        => 'kc-crum-icon kc-crum-icon-slider',
				'category'    => esc_html__( 'Content', 'utouch' ),
				'params'      => $options
			),  // End of elemnt kc_icon

		)
	); // End add map

} // End if