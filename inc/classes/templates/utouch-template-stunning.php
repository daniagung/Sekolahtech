<?php

/**
 * Class Utouch_Template_Stunning
 *
 * @property bool show
 * @property string type
 * @property string height
 * @property string text_color
 * @property string link_color
 * @property string bg_type
 * @property string bg_color
 * @property string bg_image
 * @property string overlay_color
 * @property string bg_effect
 * @property string bg_image_size
 * @property string bg_video_type
 * @property array bg_video_source
 * @property string video_attr
 *
 * @property array buttons
 *
 * @property bool title
 * @property bool category
 * @property bool breadcrumbs
 * @property bool author
 * @property bool additional
 *
 * @property string title_text
 * @property string sub_title_text
 * @property array categories
 *
 * @property array classes
 * @property array styles
 */
class Utouch_Template_Stunning extends Utouch_Singleton {
	/**
	 * Constants used for checking variables without anti pattern "magic string"
	 *
	 * @var string STYLE_DISABLED stunning disabled style. template with this style name not exists so nothing to render
	 */
	const STYLE_DEFAULT = 'default';
	const STYLE_DISABLED = 'disabled';


	const BG_TYPE_IMAGE = 'image_bg';
	const BG_TYPE_VIDEO = 'video_bg';
	const BG_TYPE_NONE = 'none_bg';

	const BG_EFFECT_NONE = '';
	const BG_EFFECT_TILT = 'tilt';
	const BG_EFFECT_FIXED = 'fixed';

	const BG_VIDEO_OEMBED = 'oembed';
	const BG_VIDEO_SELF = 'self';
	/**
	 * Class instance
	 *
	 * @var Utouch_Template_Stunning
	 */
	protected static $instance;

	/**
	 * @inheritdoc
	 */
	protected function __construct() {

		// collect all data fromt customizer settings and page/post/category metaboxes
		$this->collect_data();

		/**
		 * @var array $classes classes for current stunning header
		 * @var array $styles attr style for main stunning header wrapper
		 */
		$classes = array( 'crumina-stunning-header' );
		$styles = array();

		if ( ! empty( $this->height ) ) {
			$styles['min-height'] = $this->height . 'px';
		}
		if ( ! empty( $this->text_color ) ) {
			$styles['color'] = $this->text_color;
			$classes[]       = 'custom-color';
		}


		if ( self::BG_TYPE_IMAGE === $this->bg_type ) {

			if ( ! empty( $this->bg_color ) ) {
				$styles['background-color'] = $this->bg_color;
			}
			if ( self::BG_EFFECT_FIXED === $this->bg_effect ) {
				$styles['background-attachment'] = 'fixed';
			}

			//for tilt effect it is <img> handler that rendered in stunning header template
			if ( self::BG_EFFECT_TILT !== $this->bg_effect ) {

				if ( ! empty( $this->bg_image_size ) ) {
					$styles['background-size'] = $this->bg_image_size;
				}
				if ( ! empty( $this->bg_image ) ) {
					$styles['background-image'] = 'url(' . $this->bg_image . ')';
				}
			}

		} elseif ( self::BG_TYPE_VIDEO === $this->bg_type ) {
			if ( ! empty( $this->bg_image ) ) {
				$styles['background-image'] = 'url(' . $this->bg_image . ')';
			}
			$video_attr = '';
			if ( 'oembed' === $this->bg_video_type ) {
				$source = utouch_akg( 'source', $this->bg_video_source, '' );
				if ( ! empty( $source ) ) {
					$video_attr = utouch_htmlspecialchars( json_encode( array(
						'source' => array(
							'autoPlay' => true,
							'video'    => $source,
							'poster'   => $this->bg_image
						)
					) ) );
				}
			} else {
				$videos = array();
				foreach ( $this->bg_video_source as $key => $value ) {
					if ( ! empty( $value ) ) {
						$videos[ $key ] = $value['url'];
					}
				}

				$video_attr = utouch_htmlspecialchars( json_encode( array( 'source' => array_merge( array( 'poster' => $this->bg_image ), $videos ) ) ) );
			}

			$this->data['video_attr'] = $video_attr;

		}

		// save classes and styles to main storage so it could accessed any time
		$this->data['classes'] = $classes;
		$this->data['styles']  = $styles;

	}

	/**
	 * This function collect all options customizer and any other data that needed for stunning header templates
	 * Also check what options is custom from page/post/category
	 */
	protected function collect_data() {

		$options = Utouch::options();


		$customizer_atts = $options->get_option( '', array(), Utouch_Options::SOURCE_CUSTOMIZER );
		if ( is_singular() ) {

			$metabox_atts = $options->get_option( '', array(), Utouch_Options::SOURCE_POST );

		} elseif ( is_category() || is_tax() ) {
			$term     = get_queried_object();

			$metabox_atts = $options->get_option( '', array(), Utouch_Options::SOURCE_TAXONOMY, array(
				'term_id'  => $term->term_id,
				'taxonomy' => $term->taxonomy,
			) );

		} else {
			$metabox_atts = array();
		}

		$_custom          = utouch_akg( 'stunning_style', $metabox_atts, self::STYLE_DEFAULT );
		$_custom_show     = 'yes' === utouch_akg( 'stunning-show', $metabox_atts, 'no' );
		$_custom_design   = 'yes' === utouch_akg( 'enable_stunning_design', $metabox_atts, 'no' );
		$_custom_elements = 'yes' === utouch_akg( 'enable_stunning_elements', $metabox_atts, 'no' );


		if ( self::STYLE_DEFAULT === $_custom ) {
			$this->data['show'] = 'yes' === utouch_akg( 'stunning-show/value', $customizer_atts, 'yes' );
			$this->data['type'] = utouch_akg( 'stunning-show/yes/style', $customizer_atts, 'style_0' );

		} else {
			$this->data['show'] = self::STYLE_DISABLED !== $_custom;
			$this->data['type'] = $_custom;

		}
		$st_header_height = utouch_akg( 'stunning-show/yes/height', $customizer_atts, '' );
		if ( $_custom_design ) {
			$atts                 = utouch_akg( 'stunning_design', $metabox_atts, array() );
			$meta_height = utouch_akg( 'height', $atts, $st_header_height );
			if ( empty( $meta_height ) ) {
				$this->data['height'] = $st_header_height;
			} else {
				$this->data['height'] = $meta_height;
			}
		} else {
			$atts                 = $customizer_atts;
			$this->data['height'] = $st_header_height;
		}

		//when nothing is selected set default color
		$this->data['bg_color'] = '#273f5b';

		$this->data['bg_color']      = utouch_akg( 'stunning_background_color', $atts, '#273f5b' );
		$this->data['overlay_color'] = utouch_akg( 'stunning_overlay_color', $atts, '' );
		$this->data['text_color'] = utouch_akg( 'stunning_text_color', $atts, '' );
		$this->data['link_color'] = utouch_akg( 'stunning_link_color', $atts, '' );
		$this->data['bg_type']    = utouch_akg( 'stunning_bg_options/selected', $atts, self::BG_TYPE_IMAGE );

		$prefix = 'stunning_bg_options/' . $this->bg_type . '/';

		if ( self::BG_TYPE_IMAGE === $this->bg_type ) {
			$this->data['bg_image']      = utouch_akg( $prefix . 'background_image/url', $atts, '' );
			$this->data['bg_effect']     = utouch_akg( $prefix . 'bg_effect', $atts, self::BG_EFFECT_NONE );
			$this->data['bg_image_size'] = utouch_akg( $prefix . 'image_size', $atts, '' );


		} elseif ( self::BG_TYPE_VIDEO === $this->bg_type ) {
			$classes[]                   = 'js-section-background';
			$this->data['bg_image']      = utouch_akg( $prefix . 'placeholder/url', $atts, '' );
			$this->data['bg_video_type']   = utouch_akg( $prefix . 'selected/source', $atts, self::BG_VIDEO_OEMBED );
			$this->data['bg_video_source'] = utouch_akg( $prefix . 'selected/' . $this->bg_video_type, $atts, array() );

		}

		if ( $_custom_show ) {
			$atts = utouch_akg( 'stunning_content', $metabox_atts, array() );
		} else {
			$atts = $customizer_atts;
		}
		$this->data['title']       = 'yes' === utouch_akg( 'stunning_title/show', $atts, 'yes' );
		$this->data['category']    = 'yes' === utouch_akg( 'stunning_category', $atts, 'no' );
		$this->data['breadcrumbs'] = 'yes' === utouch_akg( 'stunning_breadcrumbs', $atts, 'yes' );
		$this->data['author']      = 'yes' === utouch_akg( 'stunning_author', $atts, 'no' );
		$this->data['additional']  = 'yes' === utouch_akg( 'stunning_additional', $atts, 'no' );


		$this->data['buttons'] = $_custom_show ? utouch_akg( 'stunning_content/stunning-buttons', $metabox_atts, array() ) : array();

		if ( $_custom_show && $this->title ) {
			$this->data['title_text']     = utouch_akg( 'stunning_content/stunning_title/yes/stunning-custom-title', $metabox_atts, '' );
			$this->data['sub_title_text'] = utouch_akg( 'stunning_content/stunning_title/yes/stunning-custom-subtitle', $metabox_atts, '' );


		}
		if ( empty( $this->title_text ) ) {
			$this->data['title_text'] = $this->get_title_text();
		}

		if ( empty( $this->sub_title_text ) ) {
			$this->data['sub_title_text'] = '';
		}

		if ( null !== $taxonomy_name = Utouch::get_var( 'custom_stunning_taxonomy' ) ) {
			$this->data['categories'] = get_the_terms( get_the_ID(), $taxonomy_name );
		} else {
			$this->data['categories'] = get_the_category();
		}


	}

	/**
	 * Get default title text based on the current page
	 * @return string
	 */
	public function get_title_text() {
		if ( is_home() ) {
			return esc_html__( 'Latest posts', 'utouch' );
		} elseif ( is_search() ) {
			return sprintf( esc_html__( 'Search Results for: %s', 'utouch' ), get_search_query() );
		} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
			if ( is_shop() && apply_filters( 'woocommerce_show_page_title', true ) ) {
				return woocommerce_page_title( false );
			} elseif ( is_product() ) {
				return esc_html__( 'Product Details', 'utouch' );
			} elseif ( is_cart() || is_checkout() || is_checkout_pay_page() ) {
				return get_the_title();
			}
		} elseif ( is_singular() ) {
			return get_the_title();
		} elseif ( is_author() ) {
			$author_id = get_queried_object_id();
			return esc_html__( 'Author:', 'utouch' ) .' '. get_the_author_meta( 'display_name', $author_id );
		} else {
			return get_the_archive_title();
		}

		return get_the_title();
	}

	/**
	 * Display category html
	 *
	 * @param string $tag
	 */
	public function category_html( $tag = 'h6' ) {
		echo ($this->get_category_html( $tag ));
	}

	/**
	 * Get category html
	 *
	 * @param string $header_tag
	 *
	 * @return string
	 */
	public function get_category_html( $header_tag = 'h6' ) {
		if ( ! $this->category || ! is_singular() || empty( $this->categories ) ) {
			return '';
		}

		$cat_html = '';
		foreach ( $this->categories as $category ) {
			$atts = array( 'href' => get_term_link( $category ) );

			$cat_html .= utouch_html_tag( 'a', $atts, $category->name ) . ', ';
		}
		$atts['class'] = 'category-link custom-color ' . $header_tag;
		if ( ! empty( $this->link_color ) ) {
			$atts['style'] = 'color:' . $this->link_color . ';';
		}
		return utouch_html_tag( 'div',$atts, rtrim( $cat_html, ', ' ) );
	}

	/**
	 * Display title html
	 *
	 * @param string $tag
	 * @param $class
	 */
	public function title_html( $tag = 'h1', $class = '' ) {
		echo ($this->get_title_html( $tag, $class ));
	}

	/**
	 * Get title html
	 *
	 * @param string $tag
	 *
	 * @param string $class
	 *
	 * @return string
	 */
	public function get_title_html( $tag = 'h1', $class = '' ) {
		if ( ! $this->title ) {
			return '';
		}

		return utouch_html_tag( $tag, array( 'class' => $class ), $this->title_text );
	}

	/**
	 * Display sub title html
	 *
	 * @param string $tag
	 */
	public function sub_title_html( $tag = 'h6' ) {
		echo ($this->get_sub_title_html( $tag ));
	}

	/**
	 * Get sub title html
	 *
	 * @param string $tag
	 *
	 * @return string
	 */
	public function get_sub_title_html( $tag = 'h6' ) {
		if ( empty( $this->sub_title_text ) ) {
			return '';
		}

		return utouch_html_tag( $tag, array( 'class' => 'stunning-header-sub-title' ), $this->sub_title_text );
	}

	public function get_css(){
		return '#stunning-section{ ' . Utouch_Helper_Html::attr_style( $this->styles, false ) . '}';
	}
}