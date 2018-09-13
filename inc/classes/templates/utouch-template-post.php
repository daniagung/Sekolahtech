<?php
/**
 * @package utouch-wp
 */

/**
 * Class Utouch_Template_Post
 *
 * @property bool show_featured
 * @property bool show_author
 * @property bool show_meta
 * @property bool show_share
 * @property bool show_author_box
 * @property bool show_related
 * @property string related_primary_post
 *
 */
class Utouch_Template_Post extends Utouch_Singleton {

	/**
	 * Class instance
	 *
	 * @var Utouch_Template_Post
	 */
	protected static $instance;

	protected function __construct() {

		$options = Utouch::options()->get_option( '', array(), Utouch_Options::SOURCE_CUSTOMIZER );

		$this->data['show_featured']        = 'yes' === utouch_akg( 'single-featured-show', $options, 'yes' );
		$this->data['show_author']          = 'yes' === utouch_akg( 'single-author-show', $options, 'yes' );
		$this->data['show_meta']            = 'yes' === utouch_akg( 'single-meta-show', $options, 'yes' );
		$this->data['show_share']           = 'yes' === utouch_akg( 'single-share-show', $options, 'yes' );
		$this->data['show_author_box']      = 'yes' === utouch_akg( 'single-author-box-show', $options, 'yes' );
		$this->data['show_related']         = 'yes' === utouch_akg( 'single-related-show/value', $options, 'yes' );
		$this->data['related_primary_post'] = utouch_akg( 'single-related-show/yes/page_select', $options, '' );
	}

}