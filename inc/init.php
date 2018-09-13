<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

class Utouch_Includes {
	private static $rel_path = null;

	private static $include_isolated_callable;

	private static $initialized = false;

	public static function init() {
		if ( self::$initialized ) {
			return;
		} else {
			self::$initialized = true;
		}

		/**
		 * Include a file isolated, to not have access to current context variables
		 */
        self::$include_isolated_callable = function($path = false) {
            if(!$path){
                return;
            }
            include $path;
        };

        /**
		 * Both frontend and backend
		 */
		{
			self::include_child_first( '/helpers.php' );
			self::include_child_first( '/includes/fw-resize.php' );
			self::include_child_first( '/unyson-helpers.php' );
			self::include_child_first( '/includes/content-width.php' );
			self::include_child_first( '/includes/custom-walkers.php' );
			self::include_child_first( '/includes/modules_filters.php' );
			self::include_child_first( '/includes/mr-image-resize.php' );
			self::include_child_first( '/includes/plugins-includes.php' );
			self::include_child_first( '/includes/post-like.php' );
			self::include_child_first( '/includes/related-posts.php' );
			self::include_child_first( '/includes/styles.php' );
			self::include_child_first( '/includes/template-tags.php' );
			self::include_child_first( '/hooks.php' );

			add_action( 'init', array( __CLASS__, '_action_init' ) );
			add_action( 'widgets_init', array( __CLASS__, '_action_widgets_init' ) );


		}

		/**
		 * Only frontend
		 */
		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, '_action_enqueue_scripts' ),
				20 // Include later to be able to make wp_dequeue_style|script()
			);
		}
	}

	private static function get_rel_path( $append = '' ) {
		return '/inc' . $append;
	}

	/**
	 * @param string $dirname 'foo-bar'
	 *
	 * @return string 'Foo_Bar'
	 */
	private static function dirname_to_classname( $dirname ) {
		$class_name = explode( '-', $dirname );
		$class_name = array_map( 'ucfirst', $class_name );
		$class_name = implode( '_', $class_name );

		return $class_name;
	}

	public static function get_parent_path( $rel_path ) {
		return get_template_directory() . self::get_rel_path( $rel_path );
	}

	public static function get_child_path( $rel_path ) {
		if ( ! is_child_theme() ) {
			return null;
		}

		return get_stylesheet_directory() . self::get_rel_path( $rel_path );
	}

	public static function include_isolated( $path ) {
		call_user_func( self::$include_isolated_callable, $path );
	}

	public static function include_child_first( $rel_path ) {
		if ( is_child_theme() ) {
			$path = self::get_child_path( $rel_path );

			if ( file_exists( $path ) ) {
				self::include_isolated( $path );
			}
		}

		{
			$path = self::get_parent_path( $rel_path );

			if ( file_exists( $path ) ) {
				self::include_isolated( $path );
			}
		}
	}

	/**
	 * @internal
	 */
	public static function _action_enqueue_scripts() {
		self::include_child_first( '/static.php' );
	}

	/**
	 * @internal
	 */
	public static function _action_init() {
		self::include_child_first( '/menus.php' );
	}

	/**
	 * @internal
	 */
	public static function _action_widgets_init() {
		$widgets = array(
			'author',
			'categories',
			'contacts',
			'events',
			'facebook',
			'flickr',
			'instagram',
			'latest-news',
			'latest-projects',
			'link-list',
			'tags',
			'text-button',
		);

		foreach($widgets as $widget_name){
			self::include_child_first( "/widgets/$widget_name/class-widget-$widget_name.php" );
			$widget_class = 'Utouch_Widget_' . self::dirname_to_classname( $widget_name );
			if ( class_exists( $widget_class ) ) {
				register_widget( $widget_class );
			}
		}
	}
}

Utouch_Includes::init();