<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

class Utouch_Widget_Events extends WP_Widget {

	/**
	 * Construct.
	 *
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array(
			'description' => esc_html__( 'Theme styles latest events', 'utouch' ),
			'classname'   => 'w-events crumina-module-slider'
		);
		parent::__construct( false, esc_html__( 'Theme widget: Latest Events', 'utouch' ), $widget_ops );
	}

	/**
	 * Options.
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

		$cache = wp_cache_get( 'widget_latest_news', 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
//			echo( $cache[ $args['widget_id'] ] );// WPCS: XSS ok, sanitization ok.
//			return;
		}

		if ( defined( 'FW' ) ) {

			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

			if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
				$number = 10;
			}

			if ( ! isset( $instance['order'] ) || ( 'ASC' !== $instance['order'] && 'DESC' !== $instance['order'] ) ) {
				$order = 'DESC';
			} else {
				$order = $instance['order'];
			}
			$latest_posts = new WP_Query(
				array(
					'post_type'           => 'fw-event',
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'orderby'             => 'post_date',
					'order'               => $order,
				)
			);

			while ( $latest_posts->have_posts() ) {
				$latest_posts->the_post();
				$post = get_post();

				$date = new DateTime( $post->post_date );
				$date = $date->format( 'M Y' );

				ob_start();
				if ( has_post_thumbnail() ) {
					?>
					<div class="img-author">
						<?php the_post_thumbnail( array(
							'height' => 45,
							'width'  => 45,
						) ) ?>
					</div>
					<?php
				} else {
					?>
					<div class="img-author" style="background-color: #c5c5c5">

					</div>
					<?php
				}
				$thumb             = ob_get_clean();
				$events[ $date ][] = array(
					'title'      => get_the_title(),
					'permalink'  => get_the_permalink(),
					'thumb'      => $thumb,
					'date_range' => Utouch::get_event( get_the_ID() )->get_dates_range(),
				);

			}
			$latest_posts->reset_postdata();


			// Widget frontend. Can be modified via child theme.
			$view_path = fw_locate_theme_path( '/inc/widgets/events/views/widget.php' );
			ob_start();

			echo fw_render_view( $view_path, compact( 'args', 'title', 'events', 'latest_posts' ) );

			$cache[ $args['widget_id'] ] = ob_get_flush();
		}
	}


	function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['order']  = $new_instance['order'];
		$this->flush_cache();


		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_recent_entries'] ) ) {
			delete_option( 'widget_recent_entries' );
		}

		return $instance;
	}

	function flush_cache() {
		wp_cache_delete( 'widget_latest_news', 'widget' );
	}

	function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

		$order = isset( $instance['order'] ) ? esc_attr( $instance['order'] ) : 'DESC';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'utouch' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
				   value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of events to show:', 'utouch' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text"
				   value="<?php echo esc_attr( $number ); ?>" size="3"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'utouch' ); ?>
				:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" class="widefat">
				<option value="DESC" <?php selected( 'DESC', $order ) ?>><?php esc_html_e( 'Descending', 'utouch' ); ?></option>
				<option value="ASC" <?php selected( 'ASC', $order ) ?>><?php esc_html_e( 'Ascending', 'utouch' ); ?></option>
			</select>
		</p>
		<?php


	}
}
