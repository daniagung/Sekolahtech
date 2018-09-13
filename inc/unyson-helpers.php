<?php
/**
 * @package utouch-wp
 */

if ( ! function_exists( 'utouch_htmlspecialchars' ) ) {
	/**
	 * Use this id do not want to enter every time same last two parameters
	 * Info: Cannot use default parameters because in php 5.2 encoding is not UTF-8 by default
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	function utouch_htmlspecialchars( $string ) {
		return htmlspecialchars( $string, ENT_QUOTES, 'UTF-8' );
	}
}

if ( ! function_exists( 'utouch_html_tag' ) ) {
	/**
	 * Generate html tag
	 *
	 * @param string $tag Tag name
	 * @param array $attr Tag attributes
	 * @param bool|string $end Append closing tag. Also accepts body content
	 *
	 * @return string The tag's html
	 */
	function utouch_html_tag( $tag, $attr = array(), $end = false ) {
		$html = '<' . $tag . ' ' . utouch_attr_to_html( $attr );

		if ( $end === true ) {
			$html .= '></' . $tag . '>';
		} else if ( $end === false ) {
			$html .= '/>';
		} else {
			$html .= '>' . $end . '</' . $tag . '>';
		}

		return $html;
	}
}

if ( ! function_exists( 'utouch_attr_to_html' ) ) {
	/**
	 * Generate attributes string for html tag
	 *
	 * @param array $attr_array array('href' => '/', 'title' => 'Test')
	 *
	 * @return string 'href="/" title="Test"'
	 */
	function utouch_attr_to_html( array $attr_array ) {
		$html_attr = '';

		foreach ( $attr_array as $attr_name => $attr_val ) {
			if ( $attr_val === false ) {
				continue;
			}

			$html_attr .= $attr_name . '="' . utouch_htmlspecialchars( $attr_val ) . '" ';
		}

		return $html_attr;
	}
}

if ( ! function_exists( 'utouch_akg' ) ) {
	/**
	 * Recursively find a key's value in array
	 *
	 * @param string $keys 'a/b/c'
	 * @param array|object $array_or_object
	 * @param null|mixed $default_value
	 * @param string $keys_delimiter
	 *
	 * @return null|mixed
	 */
	function utouch_akg( $keys, $array_or_object, $default_value = null, $keys_delimiter = '/' ) {
		if ( ! is_array( $keys ) ) {
			$keys = explode( $keys_delimiter, (string) $keys );
		}

		$key_or_property = array_shift( $keys );
		if ( $key_or_property === null ) {
			return $default_value;
		}

		$is_object = is_object( $array_or_object );

		if ( $is_object ) {
			if ( ! property_exists( $array_or_object, $key_or_property ) ) {
				return $default_value;
			}
		} else {
			if ( ! is_array( $array_or_object ) || ! array_key_exists( $key_or_property, $array_or_object ) ) {
				return $default_value;
			}
		}

		if ( isset( $keys[0] ) ) { // not used count() for performance reasons
			if ( $is_object ) {
				return utouch_akg( $keys, $array_or_object->{$key_or_property}, $default_value );
			} else {
				return utouch_akg( $keys, $array_or_object[ $key_or_property ], $default_value );
			}
		} else {
			if ( $is_object ) {
				return $array_or_object->{$key_or_property};
			} else {
				return $array_or_object[ $key_or_property ];
			}
		}
	}
}



