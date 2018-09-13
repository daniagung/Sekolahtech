<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}


class Utouch_Widget_Text_Button extends WP_Widget {

	/**
	 * Construct.
	 *
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array( 'description' => 'Text block with button below', 'classname' => 'w-about' );
		parent::__construct( 'text-with-button', esc_html__( 'Theme widget: Text with button', 'utouch' ), $widget_ops );
	}

	/**
	 * Options.
	 *
	 * @param array $args
	 * @param array $instance
	 */

	function widget( $args, $instance ) {
		if ( defined( 'FW' ) ) {


			$title       = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			$widget_text = isset( $instance['description'] ) ? $instance['description'] : '';
			$button_text = isset( $instance['button_text'] ) ? $instance['button_text'] : '';
			$button_link = isset( $instance['button_link'] ) ? $instance['button_link'] : '';
			$button_color = isset( $instance['button_color'] ) ? $instance['button_color'] : 'primary';

			// Widget frontend. Can be modified via child theme.
			$view_path = fw_locate_theme_path( '/inc/widgets/text-button/views/widget.php' );
			echo fw_render_view( $view_path, compact( 'args', 'title', 'widget_text', 'button_text', 'button_link', 'button_color' ) );
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']       = esc_html( $new_instance['title'] );
		$instance['description'] = $new_instance['description'];
		$instance['button_text'] = esc_html( $new_instance['button_text'] );
		$instance['button_link'] = esc_url( $new_instance['button_link'] );
		$instance['button_color'] = esc_html( $new_instance['button_color'] );

		return $instance;

	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array(
			'title'       => '',
			'description' => '',
			'button_text' => '',
			'button_link' => '',
		) );

		$button_color  = empty( $instance['button_color'] ) ? '' : $instance['button_color'];


		$title       = $instance['title'];
		$description = esc_textarea( $instance['description'] );
		$button_text = $instance['button_text'];
		$button_link = $instance['button_link'];

		$widget_output = '';

		//Widget title
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">' . esc_html__( 'Title', 'utouch' ) . '</label>';
		$widget_output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" type="text" value="' . esc_attr( $title ) . '">';
		$widget_output .= '</p>';


		//Description
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . $this->get_field_id( 'description' ) . '">' . esc_html__( 'Description', 'utouch' ) . '</label>';
		$widget_output .= '<textarea id="' . $this->get_field_id( 'description' ) . '" name="' . $this->get_field_name( 'description' ) . '" class="widefat" rows="5">';
		$widget_output .= $description;
		$widget_output .= '</textarea>';
		$widget_output .= '</p>';

		//Button text
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'button_text' ) ) . '">' . esc_html__( 'Button text', 'utouch' ) . '</label>';
		$widget_output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'button_text' ) ) . '" name="' . esc_attr( $this->get_field_name( 'button_text' ) ) . '" type="text" value="' . esc_attr( $button_text ) . '">';
		$widget_output .= '</p>';


		//Button color
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'button_color' ) ) . '">' . esc_html__( 'Contact button color', 'utouch' ) . '</label>';

		$widget_output .= '<select class="widefat colored-options" id="' . esc_attr( $this->get_field_id( 'button_color' ) ) . '" name="' . esc_attr( $this->get_field_name( 'button_color' ) ) . '">';
		$colors = utouch_button_colors();
		foreach ( $colors as $key => $value ) {
			$widget_output .= '<option value="' . $key . '" ' . selected( $key, $button_color, false ) . '>' . $value . '</option>';
		};
		$widget_output .= '</select>';
		$widget_output .= '</p>';


		//Button link
		$widget_output .= '<p>';
		$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'button_link' ) ) . '">' . esc_html__( 'Button link', 'utouch' ) . '</label>';
		$widget_output .= '<input class="widefat" id="' . esc_attr( $this->get_field_id( 'button_link' ) ) . '" name="' . esc_attr( $this->get_field_name( 'button_link' ) ) . '" type="text" value="' . esc_url( $button_link ) . '">';
		$widget_output .= '</p>';


		echo( $widget_output );

	}

}
