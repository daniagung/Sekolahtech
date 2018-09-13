<?php
/**
 * @package utouch-wp
 */

/**
 * Class Utouch_Portfolio_Factory
 *
 * @property bool show_featured
 * @property bool show_author
 * @property bool show_meta
 * @property bool show_share
 *
 */
class Utouch_Portfolio_Factory extends Utouch_Singleton {

	/**
	 * Class instance
	 *
	 * @var Utouch_Portfolio_Factory
	 */
	protected static $instance;

	/**
	 * @var array $events array with all events
	 */
	protected $portfolio = array();

	protected $customizer_row_design = null;

	protected function __construct() {
		$customizer_opt           = Utouch::options()->get_option( '', array(), Utouch_Options::SOURCE_CUSTOMIZER );
		$this->customizer_row_design = utouch_akg( 'folio-rows-design', $customizer_opt, 'classic' );
	}

	/**
	 * Get event class by event_id
	 *
	 * @param $portfolio_id
	 *
	 * @return mixed
	 */
	public function get( $portfolio_id ) {


		if ( array_key_exists( $portfolio_id, $this->portfolio ) ) {
			return $this->portfolio[ $portfolio_id ];
		}

		$data = $this->get_portfolio_data( $portfolio_id );

		$this->portfolio[ $portfolio_id ] = new Utouch_Portfolio( $data );

		return $this->portfolio[ $portfolio_id ];
	}

	protected function get_portfolio_data( $portfolio_id ) {

		$options = Utouch::options()->get_option( '', array(), Utouch_Options::SOURCE_POST, array( 'post_id' => $portfolio_id ) );

		$data['ID'] = $portfolio_id;


		$data['text_color'] = utouch_akg( 'text-color', $options, '#fff' );
		$data['bg_color']   = utouch_akg( 'background-color', $options, '#273f5b' );

		if(empty($data['text_color'])){
			$data['text_color'] = '#fff';
		}
		if(empty($data['bg_color'])){
			$data['bg_color'] = '#273f5b';
		}
		return $data;
	}

}