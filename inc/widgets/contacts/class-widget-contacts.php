<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
if ( defined( 'FW' ) ) {
	class Utouch_Widget_Contacts extends WP_Widget {

		/**
		 * Construct.
		 *
		 * @internal
		 */
		public function __construct() {
			$widget_ops = array(
				'description'                 => esc_html__( 'Contact information', 'utouch' ),
				'classname'                   => 'w-contacts',
				'customize_selective_refresh' => true
			);
			parent::__construct( false, esc_html__( 'Theme widget: Contacts', 'utouch' ), $widget_ops );
		}

		/**
		 * Options.
		 *
		 * @param array $args
		 * @param array $instance
		 */

		function widget( $args, $instance ) {
			if ( defined( 'FW' ) ) {

				$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

				// Widget frontend. Can be modified via child theme.
				$view_path = fw_locate_theme_path( '/inc/widgets/contacts/views/widget.php' );
				echo fw_render_view( $view_path, compact( 'args', 'title', 'instance' ) );

			}
		}

		function update( $new_instance, $old_instance ) {

			$instance          = $new_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );


			return $instance;

		}

		function form( $instance ) {
			$title          = empty( $instance['title'] ) ? esc_html__( 'Follow Us', 'utouch' ) : $instance['title'];
			$address        = empty( $instance['address'] ) ? '' : $instance['address'];
			$address_oembed = empty( $instance['address_oembed'] ) ? '' : $instance['address_oembed'];
			$phone          = empty( $instance['phone'] ) ? '' : $instance['phone'];
			$email          = empty( $instance['email'] ) ? '' : $instance['email'];

			$button_text   = empty( $instance['button_text'] ) ? '' : $instance['button_text'];
			$button_color  = empty( $instance['button_color'] ) ? '' : $instance['button_color'];
			$contact_email = empty( $instance['contact_email'] ) ? '' : $instance['contact_email'];


			$social_title   = empty( $instance['social_title'] ) ? '' : $instance['social_title'];
			$soc_icon_style = empty( $instance['soc_icon_style'] ) ? 'icons' : $instance['soc_icon_style'];

			$socials = isset( $instance['socials'] )
				? array_values( $instance['socials'] )
				: array( );
			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
					   value="<?php echo esc_attr( $title ); ?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text"
					   value="<?php echo esc_attr( $address ); ?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'address_oembed' ) ); ?>"><?php esc_html_e( 'Address oembed:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address_oembed' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'address_oembed' ) ); ?>" type="text"
					   value="<?php echo esc_attr( $address_oembed ); ?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text"
					   value="<?php echo esc_attr( $phone ); ?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Email:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text"
					   value="<?php echo esc_attr( $email ); ?>"/>
			</p>

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

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'social_title' ) ); ?>"><?php esc_html_e( 'Social icons title:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social_title' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'social_title' ) ); ?>" type="text"
					   value="<?php echo esc_attr( $social_title ); ?>"/>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'soc_icon_style' ) ); ?>"><?php esc_html_e( 'Social icons style:', 'utouch' ); ?>
					:</label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'soc_icon_style' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'soc_icon_style' ) ); ?>" class="widefat">
					<option value="icons" <?php selected( 'icons', $soc_icon_style ) ?>><?php esc_html_e( 'Just icons', 'utouch' ); ?></option>
					<option value="hover" <?php selected( 'hover', $soc_icon_style ) ?>><?php esc_html_e( 'Background color on hover', 'utouch' ); ?></option>
					<option value="bg" <?php selected( 'bg', $soc_icon_style ) ?>><?php esc_html_e( 'Background color', 'utouch' ); ?></option>
				</select>
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