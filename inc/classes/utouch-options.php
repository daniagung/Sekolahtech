<?php
/**
 * Class Utouch_Options
 */
class Utouch_Options extends Utouch_Singleton {
	const SOURCE_SETTINGS = 'get_settings_option';
	const SOURCE_CUSTOMIZER = 'get_customizer_option';
	const SOURCE_POST = 'get_post_option';
	const SOURCE_TAXONOMY = 'get_taxonomy_option';
	/**
	 * Class instance
	 *
	 * @var Utouch_Options
	 */
	protected static $instance;

	/**
	 * Bloom_Logo constructor.
	 */
	protected final function __construct() {

	}

	/**
	 * Get blog option.
	 *
	 * @param string $option_id option name.
	 * @param mixed $default_value default value if option_id not found.
	 * @param string $source source to get option.
	 *
	 * @param array $atts
	 *
	 * @return mixed
	 */
	public function get_option( $option_id, $default_value, $source = self::SOURCE_CUSTOMIZER, $atts = array() ) {
		return $this->$source( $option_id, $default_value, $atts );
	}

	/**
	 * Get settings options
	 *
	 * @param string $option_id option name.
	 * @param mixed $default_value default value if option_id not found.
	 *
	 * @return mixed
	 */
	private function get_settings_option( $option_id, $default_value, $atts ) {
		return function_exists( 'fw_get_db_settings_option' ) ? fw_get_db_settings_option( $option_id, $default_value ) : $default_value;
	}

	/**
	 * Get customizer options
	 *
	 * @param string $option_id option name.
	 * @param mixed $default_value default value if option_id not found.
	 *
	 * @return mixed
	 */
	private function get_customizer_option( $option_id, $default_value, $atts  ) {
		return function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( $option_id, $default_value ) : $default_value;
	}

	/**
	 * Get options from post
	 *
	 * @param string $option_id option name.
	 * @param mixed $default_value default value if option_id not found.
	 *
	 * @param $atts
	 *
	 * @return mixed
	 */
	private function get_post_option( $option_id, $default_value, $atts  ) {
		if(!isset($atts['post_id'])){
			$post = get_post();
			$atts['post_id'] = $post->ID;
		}
		return function_exists( 'fw_get_db_post_option' ) ? fw_get_db_post_option( $atts['post_id'], $option_id, $default_value ) : $default_value;
	}

	/**
	 * Get options from taxonomy
	 *
	 * @param string $option_id option name.
	 * @param mixed $default_value default value if option_id not found.
	 *
	 * @return mixed
	 */
	private function get_taxonomy_option( $option_id, $default_value, $atts  ) {
		if(!isset($atts['term_id'])){
			$atts['term_id'] = 0;
		}
		if(!isset($atts['taxonomy'])){
			$atts['taxonomy'] = 0;
		}

		return function_exists( 'fw_get_db_term_option' ) ? fw_get_db_term_option( $atts['term_id'], $atts['taxonomy'], $option_id, $default_value ) : $default_value;
	}

}
