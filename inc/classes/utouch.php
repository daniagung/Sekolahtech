<?php

/**
 * Class Utouch
 *
 * Used for easy access to utouch theme classes
 */
class Utouch {
	protected static $inline_css = '';
	private static $temp = array();

	/**
	 * Get options class
	 *
	 * @return Utouch_Options
	 */
	public static function options() {
		return Utouch_Options::get_instance();
	}

	/**
	 * Get class with stunning template options
	 *
	 * @return Utouch_Template_Stunning
	 */
	public static function template_stunning() {
		return Utouch_Template_Stunning::get_instance();
	}

	/**
	 * Get class with post template options
	 *
	 * @return Utouch_Template_Post
	 */
	public static function template_post() {
		return Utouch_Template_Post::get_instance();
	}

	/**
	 * Get class with blog template options
	 *
	 * @return Utouch_Template_Blog
	 */
	public static function template_blog() {
		return Utouch_Template_Blog::get_instance();
	}

	/**
	 * @param $event_id
	 *
	 * @return Utouch_Event
	 */
	public static function get_event( $event_id ) {
		return Utouch_Event_Factory::get_instance()->get( $event_id );
	}

	/**
	 * @param $portfolio_id
	 *
	 * @return Utouch_Portfolio
	 */
	public static function get_portfolio( $portfolio_id ) {
		return Utouch_Portfolio_Factory::get_instance()->get( $portfolio_id );
	}

	/**
	 * Add custom css from different sources
	 *
	 * @param string $css
	 */
	public static function add_inline_css( $css ) {
		static::$inline_css .= $css;
	}

	/**
	 * get all collected custom css
	 * @return string
	 */
	public static function get_inline_css() {
		return static::$inline_css;
	}

	/**
	 * @param $key
	 * @param $data
	 */
	public static function set_var( $key, $data ) {
		static::$temp[ $key ] = $data;
	}

	/**
	 * @param $key
	 */
	public static function delete_var( $key ) {
		unset( static::$temp[ $key ] );
	}

	public static function remove_var( $key ) {
		if ( key_exists( $key, static::$temp ) ) {
			$var = static::$temp[ $key ];
			unset( static::$temp[ $key ] );

			return $var;
		} else {
			return null;
		}

	}

	/**
	 * @param $key
	 *
	 * @return mixed
	 */
	public static function get_var( $key ) {
		return key_exists( $key, static::$temp ) ? static::$temp[ $key ] : null;
	}

    /**
     * Get Utouch extension.
     *
     * @param string $extension Extension name.
     */
    public static function get_extension( $extension = false ) {
        if ( !$extension || !function_exists( 'fw' ) ) {
            return null;
        }

        return fw()->extensions->get( $extension );
    }

}