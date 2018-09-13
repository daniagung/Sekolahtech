<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

class Utouch_Widget_Latest_News extends WP_Widget {

	/**
	 * Construct.
	 *
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array(
			'description' => esc_html__( 'Theme styled latest posts', 'utouch' ),
			'classname'   => 'w-latest-news'
		);
		parent::__construct( false, esc_html__( 'Theme widget: Latest News', 'utouch' ), $widget_ops );
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
			echo( $cache[ $args['widget_id'] ] );// WPCS: XSS ok, sanitization ok.
			return;
		}

		if ( defined( 'FW' ) ) {

			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

			if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
				$number = 10;
			}

			$latest_posts = new WP_Query(
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				)
			);


			$popular_posts = new WP_Query(
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
//					'meta_key'            => 'popular_posts',
					'orderby'             => 'comment_count',
					'order' => 'DESC',
				)
			);
			$comments      = new WP_Comment_Query( array(
				'number' => $number,
				'status' => 'approve'
			) );
			$comments = $comments->get_comments();
			// Widget frontend. Can be modified via child theme.
			$view_path = fw_locate_theme_path( '/inc/widgets/latest-news/views/widget.php' );
			ob_start();

			echo fw_render_view( $view_path, compact( 'args', 'title', 'the_query', 'latest_posts', 'popular_posts', 'comments' ) );

			$cache[ $args['widget_id'] ] = ob_get_flush();
		}
	}


	function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
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


		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'utouch' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
				   value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of news to show:', 'utouch' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text"
				   value="<?php echo esc_attr( $number ); ?>" size="3"/>
		</p>
		<?php
	}
}
