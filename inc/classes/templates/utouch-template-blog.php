<?php
/**
 * @package utouch-wp
 */

/**
 * Class Utouch_Template_Blog
 *
 * @property bool show_featured
 * @property bool show_author
 * @property bool show_meta
 * @property bool show_share
 *
 */
class Utouch_Template_Blog extends Utouch_Singleton {

	/**
	 * Class instance
	 *
	 * @var Utouch_Template_Blog
	 */
	protected static $instance;

	protected function __construct() {

		$options = Utouch::options()->get_option( '', array(), Utouch_Options::SOURCE_CUSTOMIZER );

		$this->data['show_featured']        = 'yes' === utouch_akg( 'blog-featured-show', $options, 'yes' );
		$this->data['show_author']          = 'yes' === utouch_akg( 'blog-author-show', $options, 'yes' );
		$this->data['show_meta']            = 'yes' === utouch_akg( 'blog-meta-show', $options, 'yes' );
		$this->data['show_share']           = 'yes' === utouch_akg( 'blog-share-show', $options, 'yes' );
	}

}