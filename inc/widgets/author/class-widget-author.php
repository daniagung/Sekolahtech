<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
if ( defined( 'FW' ) ) {
	class Utouch_Widget_Author extends WP_Widget {

		/**
		 * Construct.
		 *
		 * @internal
		 */
		public function __construct() {
			$widget_ops = array(
				'description'                 => esc_html__( 'Author information', 'utouch' ),
				'classname'                   => 'w-author',
				'customize_selective_refresh' => true
			);
			parent::__construct( false, esc_html__( 'Theme widget: Author', 'utouch' ), $widget_ops );
		}

		/**
		 * Options.
		 *
		 * @param array $args
		 * @param array $instance
		 */

		function widget( $args, $instance ) {
			if ( defined( 'FW' ) ) {

				// Widget frontend. Can be modified via child theme.
				$view_path = fw_locate_theme_path( '/inc/widgets/author/views/widget.php' );
				echo fw_render_view( $view_path, compact( 'args', 'instance' ) );

			}
		}

		function update( $new_instance, $old_instance ) {

			$instance          = $new_instance;


			return $instance;

		}


		function form( $instance ) {
			$author          = empty( $instance['author'] ) ? '' : $instance['author'];
			$desc        = empty( $instance['desc'] ) ? '' : $instance['desc'];


			$button_text  = empty( $instance['button_text'] ) ? '' : $instance['button_text'];
			$button_color  = empty( $instance['button_color'] ) ? '' : $instance['button_color'];
			$contact_email  = empty( $instance['contact_email'] ) ? '' : $instance['contact_email'];

			$image = empty($instance['image']) ? '' : $instance['image'];

			$socials = isset( $instance['socials'] )
				? array_values( $instance['socials'] )
				: array( array( 'id' => 1, 'network' => '', 'name' => '', 'link' => '' ) );


			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>"><?php esc_html_e( 'Author:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'author' ) ); ?>" type="text"
					   value="<?php echo esc_attr( $author ); ?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Description:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" type="textarea"
					   value="<?php echo esc_attr( $desc ); ?>"/>
			</p>

			<?php
			$output = '<p>';
			$output .= '<label for="' . esc_attr( $this->get_field_id( 'image' ) ) . '">' . esc_html__( 'Image', 'utouch' ) . '</label>';
			$output .= '<input class="widefat widget_image_add" id="' . esc_attr( $this->get_field_id( 'image' ) ) . '" name="' . esc_attr( $this->get_field_name( 'image' ) ) . '" type="text" value="' . esc_attr( $image ) . '">';
			$output .= '<a href="#" class="add-item-image button">' . esc_html__( 'Add image', 'utouch' ) . '</a>';
			$output .= '<a href="#" class="remove-item-image button">' . esc_html__( 'Remove image', 'utouch' ) . '</a>';
			$output .= '</p>';
			echo ($output);
			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><?php esc_html_e( 'Contact button text:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text"
					   value="<?php echo esc_attr( $button_text ); ?>"/>
			</p>
			<?php
			//Button color
			$widget_output = '<p>';
			$widget_output .= '<label for="' . esc_attr( $this->get_field_id( 'button_color' ) ) . '">' . esc_html__( 'Contact button color', 'utouch' ) . '</label>';

			$widget_output .= '<select class="widefat colored-options" id="' . esc_attr( $this->get_field_id( 'button_color' ) ) . '" name="' . esc_attr( $this->get_field_name( 'button_color' ) ) . '">';
			$colors = utouch_button_colors();
			foreach ( $colors as $key => $value ) {
				$widget_output .= '<option value="' . $key . '" ' . selected( $key, $button_color, false ) . '>' . $value . '</option>';
			};
			$widget_output .= '</select>';
			$widget_output .= '</p>';

			echo( $widget_output );

			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'contact_email' ) ); ?>"><?php esc_html_e( 'Contact email:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_email' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'contact_email' ) ); ?>" type="text"
					   value="<?php echo esc_attr( $contact_email ); ?>"/>
			</p>


			<!-- segment #2 -->

			<?php ob_start(); ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'socials' ) ); ?>-<%- id %>-network"><?php esc_html_e( 'Social networks', 'utouch' ); ?>
					:</label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'socials' ) ); ?>-<%- id %>-network"
						class="widefat"
						name="<?php echo esc_attr( $this->get_field_name( 'socials' ) ); ?>[<%- id %>][network]">
					<% if (network !== null) { %>
					<option selected value="<%- network %>"><%- network %></option>
					<% } %>
					<?php
					$social_networks = utouch_user_social_networks();
					foreach ( $social_networks as $social_network => $data ) {
						echo '<option value="' . $social_network . '">' . $data['label'] . '</option>';
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'socials' ) ); ?>-<%- id %>-link"><?php esc_html_e( 'Link', 'utouch' ) ?>
					:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'socials' ) ); ?>-<%- id %>-link"
					   name="<?php echo esc_attr( $this->get_field_name( 'socials' ) ); ?>[<%- id %>][link]" type="text"
					   value="<%- link %>"/>
			</p>
			<p>
				<input name="<?php echo esc_attr( $this->get_field_name( 'socials' ) ); ?>[<%- id %>][id]" type="hidden"
					   value="<%- id %>"/>
				<a href="#"
				   class="js-remove-social widget-control-remove"><?php esc_html_e( 'Remove', 'utouch' ) ?></a>
			</p>
			<?php $js_content = ob_get_clean();
			echo utouch_html_tag( 'script', array(
				'type' => 'text/template',
				'id'   => 'js-social-' . esc_attr( $this->id )
			), $js_content ); ?>


			<!-- segment #3 -->
			<div id="js-socials-<?php echo esc_attr( $this->id ); ?>">
				<div id="js-socials-list"></div>
				<p>
					<a href="#" class="button" id="js-socials-add"><?php esc_html_e( 'Add New', 'utouch' ) ?></a>
				</p>
			</div>

			<!-- segment #4 -->
			<?php ob_start(); ?>
			var socialsJSON = <?php echo json_encode( $socials ) ?>;
			myWidgets.repopulateSocials( '<?php echo esc_attr( $this->id ); ?>', socialsJSON );
			<?php $js_content = ob_get_clean();
			echo utouch_html_tag( 'script', array( 'type' => 'text/javascript' ), $js_content ); ?>

			<?php
		}
	}
}