<?php
/**
 * @package utouch-wp
 */

/**
 * Class Utouch_Portfolio
 *
 * @property int ID
 * @property string title
 * @property string text_color
 * @property string bg_color
 * @property string style_bg_color
 * @property string style_text_color
 * @property string style_fill_text_color
 */
class Utouch_Portfolio {

	const SUMMARY_DEFAULT = 'default';
	const SUMMARY_DISABLE = 'disable';

	private $data;


	public function __construct( $data ) {
		$this->data = $data;

		$this->data['style_bg_color'] = empty($this->bg_color) ? '' : 'background-color: ' . $this->bg_color . ';';
		$this->data['style_text_color'] = empty($this->text_color) ? '' : 'color: ' . $this->text_color . ';';
		$this->data['style_fill_text_color'] = empty($this->text_color) ? '' : 'fill: ' . $this->text_color . ';';

	}

	/**
	 * Get class property
	 *
	 * @param string $name name of class property.
	 *
	 * @return mixed
	 */
	public function __get( $name ) {

		return isset( $this->data[ $name ] ) ? $this->data[ $name ] : null;
	}

	/**
	 * Check is class property is set
	 *
	 * @param string $name name of class property.
	 *
	 * @return bool
	 */
	public function __isset( $name ) {
		return isset( $this->data[ $name ] );
	}

}