<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
if ( defined( 'FW' ) ) {
	class Utouch_Widget_Link_List extends WP_Widget {

		/**
		 * Construct.
		 *
		 * @internal
		 */
		public function __construct() {
			$widget_ops = array(
				'description'                 => esc_html__( 'Links list', 'utouch' ),
				'classname'                   => 'w-list',
				'customize_selective_refresh' => true
			);
			parent::__construct( false, esc_html__( 'Theme widget: Links list', 'utouch' ), $widget_ops );
		}

		/**
		 * Options.
		 *
		 * @param array $args
		 * @param array $instance
		 */

		function widget( $args, $instance ) {
			if ( defined( 'FW' ) ) {

				$title   = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

				// Widget frontend. Can be modified via child theme.
				$view_path = fw_locate_theme_path( '/inc/widgets/link-list/views/widget.php' );
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

			$links = isset( $instance['links'] )
				? array_values( $instance['links'] )
				: array( array( 'id' => 1, 'txt' => '', 'link' => '' ) );

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'utouch' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
					   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
					   value="<?php echo esc_attr( $title ); ?>"/>
			</p>

			<!-- segment #2 -->

			<?php ob_start(); ?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'links' ) ); ?>-<%- id %>-txt"><?php esc_html_e( 'Text', 'utouch' ) ?>
					:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'links' ) ); ?>-<%- id %>-txt"
					   name="<?php echo esc_attr( $this->get_field_name( 'links' ) ); ?>[<%- id %>][txt]" type="text"
					   value="<%- txt %>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'links' ) ); ?>-<%- id %>-link"><?php esc_html_e( 'Link', 'utouch' ) ?>
					:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'links' ) ); ?>-<%- id %>-link"
					   name="<?php echo esc_attr( $this->get_field_name( 'links' ) ); ?>[<%- id %>][link]" type="text"
					   value="<%- link %>"/>
			</p>
			<p>
				<input name="<?php echo esc_attr( $this->get_field_name( 'links' ) ); ?>[<%- id %>][id]" type="hidden"
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
			var linksJSON = <?php echo json_encode( $links ) ?>;
			myWidgets.repopulateSocials( '<?php echo esc_attr( $this->id ); ?>', linksJSON );
			<?php $js_content = ob_get_clean();
			echo utouch_html_tag( 'script', array( 'type' => 'text/javascript' ), $js_content ); ?>

			<?php
		}
	}
}