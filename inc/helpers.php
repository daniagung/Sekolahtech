<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Helper functions and classes with static methods for usage in theme
 */

/**
 * Callback function will be displayed if main menu is empty.
 *
 */
function utouch_menu_fallback() {

	$output = '<ul class="primary-menu-menu"><li><div class="no-menu-box">';
	// Translators 1: Link to Menus, 2: Link to Customize
	$output .= sprintf( esc_attr__( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'utouch' ),
		sprintf( wp_kses( __( '<a href="%s">Menus</a>', 'utouch' ), array( 'a' => array( 'href' => array() ) ) ),
			get_admin_url( get_current_blog_id(), 'nav-menus.php' )
		),
		sprintf( wp_kses( __( '<a href="%s">Customize</a>', 'utouch' ), array( 'a' => array( 'href' => array() ) ) ),
			get_admin_url( get_current_blog_id(), 'customize.php' )
		)
	);
	$output .= '</div></li></ul>';

	echo( $output );
}

/**
 * Register Lato Google font.
 *
 * @return string
 */
function utouch_font_url() {
	if ( function_exists( 'fw_get_db_customizer_option' ) ) {
		$font_families = array();
		$tags = array( 'body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'nav', 'logo' );
		foreach ( $tags as $single_tag ) {
			$font_options = fw_get_db_customizer_option( 'typography_' . $single_tag, array() );
			if ( true === utouch_akg( 'google_font', $font_options, false ) ) {
				$font_families[] = $font_options['family'] . ':' . $font_options['variation'] . '&subset=latin,' . $font_options['subset'] . '';
			}
		}
	}
	$font_families[]     = 'Nunito:300,400,700,900';
	$custom_google_fonts = implode( '|', $font_families );
	if ('Nunito:300,400,700,900' == $custom_google_fonts){
		$font_url = get_template_directory_uri() . '/css/nunito-font.css';
    } else {
		$font_url            = esc_url( add_query_arg( 'family', urlencode( $custom_google_fonts ),
			"//fonts.googleapis.com/css" ) );
		$font_url            = str_replace( '%2B', '+', $font_url );
    }


	return $font_url;
}


if ( ! function_exists( 'utouch_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @param array $wp_query WordPress query.
	 * @param string $classes
	 */
	function utouch_paging_nav( $wp_query = null, $classes = '' ) {

		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 3,
			'prev_next' => false,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => '<div class="btn-prev btn--style">
						<svg class="utouch-icon icon-hover utouch-icon-arrow-left-1"><use xlink:href="#utouch-icon-arrow-left-1"></use></svg>
						<svg class="utouch-icon utouch-icon-arrow-left1"><use xlink:href="#utouch-icon-arrow-left1"></use></svg>
					</div>',
			'next_text' => '<div class="btn-next btn--style">
						<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1"><use xlink:href="#utouch-icon-arrow-right-1"></use></svg>
						<svg class="utouch-icon utouch-icon-arrow-right1"><use xlink:href="#utouch-icon-arrow-right1"></use></svg>
					</div>',
		) );

		if ( $links ) :
			$links = str_replace( 'class=\'page-numbers', 'class=\'page-numbers bg-border-color', $links );
			?>
            <h5 class="screen-reader-text"><?php esc_html_e( 'Posts pagination', 'utouch' ); ?></h5>
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navigation <?php echo esc_attr( $classes ) ?>">
						<?php echo( $links ); ?>
                    </nav>
                </div>
            </div>
		<?php
		endif;
	}
endif;

add_filter(
	'fw:option_type:icon-v2:packs',
	'_add_more_packs'
);

function _utouch_add_more_packs( $default_packs ) {
	return array(
		'utouch' => array(
			'name'             => 'utouch',
			'css_class_prefix' => 'seoicon',
			'css_file'         => get_template_directory() . '/css/crumina-icons.css',
			'css_file_uri'     => get_template_directory_uri() . '/css/crumina-icons.css'
		)
	);
}

if ( ! function_exists( 'utouch_prev_next_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @param array $wp_query WordPress query.
	 * @param string $classes
	 */
	function utouch_prev_next_nav( $wp_query = null, $classes = '' ) {

		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 0,
			'end_size'  => 0,
			'prev_next' => true,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => '<div class="btn-prev btn--style">
						<svg class="utouch-icon icon-hover utouch-icon-arrow-left-1"><use xlink:href="#utouch-icon-arrow-left-1"></use></svg>
						<svg class="utouch-icon utouch-icon-arrow-left1"><use xlink:href="#utouch-icon-arrow-left1"></use></svg>
						<span>' . esc_html__( 'Prev Page', 'utouch' ) . '</span>
					</div>',
			'next_text' => '<div class="btn-next btn--style">
						<span>' . esc_html__( 'Next Page', 'utouch' ) . '</span>
						<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1"><use xlink:href="#utouch-icon-arrow-right-1"></use></svg>
						<svg class="utouch-icon utouch-icon-arrow-right1"><use xlink:href="#utouch-icon-arrow-right1"></use></svg>
					</div>',
		) );

		if ( $links ) :
			$links = str_replace( 'page-numbers', '', $links );
			?>
            <h5 class="screen-reader-text"><?php esc_html_e( 'Posts pagination', 'utouch' ); ?></h5>

            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                    <div class="btn-slider-wrap pt80">
                        <nav class="navigation navigation-prev-next <?php echo esc_attr( $classes ) ?>">
							<?php echo( $links ); ?>
                        </nav>
                    </div>
                </div>
            </div>
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'utouch_module_class' ) ) {
	function utouch_module_class( $module_class, $atts ) {
		$classes   = apply_filters( 'kc-el-class', $atts );
		$classes[] = 'crumina-module';
		$classes[] = $module_class;

		return $classes;
	}
}

if ( ! function_exists( 'utouch_ajax_loadmore' ) ) :
	/**
	 * include localized js file for ajax pagination
	 *
	 * @param array|null $wp_query WordPress query.
	 * @param string $container_id Id of div to append items
	 */
	function utouch_ajax_loadmore( $wp_query = null, $container_id = 'portfolio-loop' ) {
		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged         = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$max_num_pages = $wp_query->max_num_pages;

		wp_enqueue_script( 'utouch-loadmore' );
		wp_localize_script(
			'utouch-loadmore',
			'pagination_data',
			array(
				'startPage'  => $paged,
				'maxPages'   => $max_num_pages,
				'loadedText' => esc_html__( 'Loaded all', 'utouch' ),
				'container'  => $container_id
			)
		);

		$load_link = next_posts( $max_num_pages, false );
		if ( empty( $load_link ) ) {
			global $wp;
			$load_link = home_url( add_query_arg( '', $wp->request ) ) . '/2/';
		} ?>
        <div class="align-center">
            <a href="#" class="btn btn-border btn-more btn--primary load-more ajax-paginate-link" id="load-more-button"
               data-load-link="<?php echo esc_url( $load_link ) ?>"
               data-container="<?php echo esc_attr( $container_id ) ?>">
                <span class="load-more-text"><?php esc_html_e( 'Load more', 'utouch' ); ?></span>
                <?php get_template_part( 'parts/spinner' ); ?>
            </a>
        </div>

	<?php }
endif;

if ( ! function_exists( 'utouch_ajax_custom_loop_load' ) ) :
	/**
	 * Js localized params for custom loop load
	 *
	 * @param array|null $wp_query WordPress query.
	 * @param string $container_id Id of div to append items
	 */
	function utouch_ajax_custom_loop_load( $wp_query = null, $container_id = 'main') {
		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		wp_localize_script( 'utouch_custom_loadmore', 'utouch_loadmore_params', array(
			'ajaxurl' => admin_url('admin-ajax.php'), // WordPress AJAX
			'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
			'current_page' => 1,
			'max_page' => $wp_query->max_num_pages,
            'container_id' => '#'.$container_id
		) );

		wp_enqueue_script( 'utouch_custom_loadmore' );

?>
        <div class="align-center">
            <a href="#" class="btn btn-border btn-more btn--primary custom_loadmore"
               data-container="<?php echo esc_attr( $container_id ) ?>" data-loading-text="<?php esc_html_e( 'Loading ...', 'utouch' ); ?>">
                <span class="load-more-text"><?php esc_html_e( 'Load more', 'utouch' ); ?></span>
            </a>
        </div>

	<?php }
endif;


if ( ! function_exists( 'utouch_loadmore_ajax_handler' ) ):
	function utouch_loadmore_ajax_handler() {

		// prepare our arguments for the query
		$args                = json_decode( stripslashes( $_POST['query'] ), true );
		$args['paged']       = $_POST['page'] + 1; // we need next page to be loaded
		$args['post_status'] = 'publish';
		$post_type = $args['post_type'];

		// it is always better to use WP_Query but not here
		query_posts( $args );

		if ( have_posts() ) :
			while ( have_posts() ): the_post();

				if ( 'fw-event' === $post_type  ) {
					get_template_part( 'parts/event/preview/item-style-' . Utouch::get_event( get_the_ID() )->preview_style );
				} else {
					get_template_part( 'post-format/post', get_post_format() );
				}
			endwhile;
		endif;
		die; // here we exit the script and even no wp_reset_query() required!
	}
endif;

add_action('wp_ajax_loadmore', 'utouch_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'utouch_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}



if ( ! function_exists( 'utouch_backgrounds' ) ):
	/**
	 * Return List of backgrounds patterns.
	 *
	 * @return array
	 */
	function utouch_backgrounds() {
		$background_image['none'] = array(
			'icon' => get_template_directory_uri() . '/images/thumb/bg-0.png',
			'css'  => array(
				'background-image' => 'none'
			),
		);
		for ( $i = 1; $i < 22; $i ++ ) {
			$background_image[ 'bg-' . $i . '' ] = array(
				'icon' => get_template_directory_uri() . '/images/thumb/bg-' . $i . '.png',
				'css'  => array(
					'background-image' => 'url("' . get_template_directory_uri() . '/images/thumb/bg-' . $i . '.png' . '")'
				),
			);
		}

		return $background_image;
	}
endif;


if ( ! function_exists( 'utouch_get_menus' ) ) :
	/**
	 * Get array with menus for theme options
	 *
	 * @return array
	 */
	function utouch_get_menus() {
		$menus_list = array( '' => esc_html__( 'Default', 'utouch' ) );
		$menus      = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		if ( is_array( $menus ) ) {
			foreach ( $menus as $menu_instance ) {
				$menus_list[ $menu_instance->term_id ] = $menu_instance->name;
			}
		}

		return $menus_list;
	}
endif;


if ( ! function_exists( 'utouch_user_social_networks' ) ) {
	/**
	 * List of aviable social networks for user fields.
	 *
	 * @return array
	 */
	function utouch_user_social_networks() {
		$socials        = utouch_social_network_icons();
		$widget_socials = array();
		foreach ( $socials as $svg => $label ) {
			$id = str_replace( '.svg', '', $svg );

			$widget_socials[ $id ] = array(
				'label' => $label,
				'icon'  => '',
			);
		}


		return $widget_socials;
	}
}

if ( ! function_exists( 'utouch_sidebar_conf' ) ) {
	/**
	 * Return classes for content / sidebar positions.
	 *
	 * @return array
	 */
	function utouch_sidebar_conf( $is_page = false ) {

		$sidebar_width_classes = 'col-lg-3 col-md-4 col-sm-12';
		$content_width_classes = 'col-lg-12 col-md-12 col-sm-12';
		$current_position      = 'full';


		if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) {
			$current_position = fw_ext_sidebars_get_current_position();
			if ( 'right' === $current_position ) {
				$content_width_classes = 'col-lg-8 col-md-12 col-sm-12';
				$sidebar_width_classes = 'col-lg-4 col-md-12 col-sm-12';
			} elseif ( 'left' === $current_position ) {
				$content_width_classes = ' col-lg-push-4 col-lg-8 col-md-12 col-sm-12';
				$sidebar_width_classes = ' col-lg-pull-8 col-lg-4 col-md-12 col-sm-12';
			} elseif ( null === $current_position && ( is_home() || is_category() || is_singular( 'post' ) || is_search() ) ) {
				$content_width_classes = 'col-lg-8 col-md-12 col-sm-12';
				$sidebar_width_classes = 'col-lg-4 col-md-12 col-sm-12';
				$current_position      = 'right';
			} else {
				$current_position = 'full';
			}
		} elseif ( ! $is_page ) {
			$content_width_classes = 'col-lg-8 col-md-12 col-sm-12';
			$sidebar_width_classes = 'col-lg-4 col-md-12 col-sm-12';
			$current_position      = 'right';
		}

		return array(
			'content-classes' => $content_width_classes,
			'sidebar-classes' => $sidebar_width_classes,
			'position'        => $current_position
		);
	}
}

if ( ! function_exists( 'utouch_gen_link_for_shortcode' ) ) :
	/**
	 * Generate link from block options
	 *
	 * @param array $atts Shortcode options
	 *
	 * @return array
	 */
	function utouch_gen_link_for_shortcode( $atts ) {
		$link_source = utouch_akg( 'link/selected/selected', $atts, '' );
		if ( 'page' === $link_source ) {
			$link = get_permalink( utouch_akg( 'link/selected/page/link/0', $atts, '' ) );
		} else {
			$link = utouch_akg( 'link/selected/url/link', $atts, '' );
		}
		$target = utouch_akg( 'link/target', $atts, '_self' );

		$url['link']   = $link;
		$url['target'] = $target;

		return $url;
	}
endif;


if ( ! function_exists( 'utouch_get_attachment_categories' ) ) {
	function utouch_get_attachment_categories() {

		$attachment_categories = get_terms( 'category_media' );
		if ( empty( $attachment_categories ) || $attachment_categories instanceof WP_Error ) {
			$attachment_categories = array();
		}
//		$attachment_categories = get_categories('taxonomy=attachment_taxonomy&type=attachment');
		$category_map = array();
		foreach ( $attachment_categories as $category ) {
			/**
			 * @var WP_Term $category
			 */
			$category_map[ $category->term_id ] = $category->name;
		}

		return $category_map;
	}
}

if ( ! function_exists( 'utouch_social_network_icons()' ) ) :
	/**
	 * List of social networks names with file names for options;
	 *
	 * @return array
	 */
	function utouch_social_network_icons() {
		$networks = array(
			'amazon.svg'          => 'Amazon',
			'behance.svg'         => 'Behance',
			'bing.svg'            => 'Bing',
			'creative-market.svg' => 'Creative Market',
			'deviantart.svg'      => 'Deviantart',
			'dribbble.svg'        => 'Dribbble',
			'dropbox.svg'         => 'Dropbox',
			'envato.svg'          => 'Envato',
			'facebook.svg'        => 'Facebook',
			'flickr.svg'          => 'Flickr',
			'googleplus.svg'      => 'Google+',
			'instagram.svg'       => 'Instagram',
			'kickstarter.svg'     => 'Kickstarter',
			'linkedin.svg'        => 'Linkedin',
			'medium.svg'          => 'Medium',
			'periscope.svg'       => 'Periscope',
			'pinterest.svg'       => 'Pinterest',
			'quora.svg'           => 'Quora',
			'reddit.svg'          => 'Reddit',
			'shutterstock.svg'    => 'Shutterstock',
			'skype.svg'           => 'Skype',
			'slack.svg'           => 'Slack',
			'snapchat.svg'        => 'Snapchat',
			'soundcloud.svg'      => 'Soundcloud',
			'spotify.svg'         => 'Spotify',
			'trello.svg'          => 'Trello',
			'telegram.svg'        => 'Telegram',
			'tumblr.svg'          => 'Tumblr',
			'twitter.svg'         => 'Twitter',
			'vimeo.svg'           => 'Vimeo',
			'vk.svg'              => 'VK.com',
			'whatsapp.svg'        => 'Whatsapp',
			'wikipedia.svg'       => 'Wikipedia',
			'wordpress.svg'       => 'WordPress',
			'youtube.svg'         => 'Youtube',
		);

		return $networks;
	}
endif;


if ( ! function_exists( 'utouch_button_colors' ) ) :
	/**
	 * List of button color variations for options;
	 *
	 * @return array
	 */
	function utouch_button_colors() {
		$colors = array(
			'primary'      => esc_html__( 'Primary color', 'utouch' ),
			'secondary'    => esc_html__( 'Secondary color', 'utouch' ),
			'white'        => esc_html__( 'White', 'utouch' ),
			'dark'         => esc_html__( 'Dark', 'utouch' ),
			'black'        => esc_html__( 'Black', 'utouch' ),
			'grey'         => esc_html__( 'Gray', 'utouch' ),
			'dark-gray'    => esc_html__( 'Dark gray', 'utouch' ),
			'grey-light'   => esc_html__( 'Gray light', 'utouch' ),
			'blue'         => esc_html__( 'Blue', 'utouch' ),
			'dark-blue'    => esc_html__( 'Dark blue', 'utouch' ),
			'purple'       => esc_html__( 'Purple', 'utouch' ),
			'breez'        => esc_html__( 'Breez', 'utouch' ),
			'orange'       => esc_html__( 'Orange', 'utouch' ),
			'orange-light' => esc_html__( 'Orange light', 'utouch' ),
			'yellow'       => esc_html__( 'Yellow', 'utouch' ),
			'green'        => esc_html__( 'Green', 'utouch' ),
			'light-green'  => esc_html__( 'Green light', 'utouch' ),
			'brown'        => esc_html__( 'Brown', 'utouch' ),
			'red'          => esc_html__( 'Red', 'utouch' ),
			'rose'         => esc_html__( 'Rose', 'utouch' ),
			'violet'       => esc_html__( 'Violet', 'utouch' ),
			'olive'        => esc_html__( 'Olive', 'utouch' ),
			'lime'         => esc_html__( 'Lime', 'utouch' ),
			'transparent'  => esc_html__( 'Transparent', 'utouch' ),


		);

		return $colors;
	}
endif;

if ( ! function_exists( '_utouch_google_map_custom_styles' ) ) {
	/**
	 * Custom styles for map shortcode
	 *
	 * @return array
	 */
	function _utouch_google_map_custom_styles() {
		return array(
			'default'            => array(
				esc_html__( "Default", 'utouch' ),
				""
			),
			'dark'               => array(
				esc_html__( "Dark", 'utouch' ),
				"[{'featureType':'all','elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#000000'},{'lightness':40}]},{'featureType':'all','elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#000000'},{'lightness':16}]},{'featureType':'all','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':17},{'weight':1.2}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':21}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':16}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':19}]},{'featureType':'water','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':17}]}]"
			),
			'omni'               => array(
				esc_html__( "Omni", 'utouch' ),
				"[{'featureType':'landscape','stylers':[{'saturation':-100},{'lightness':65},{'visibility':'on'}]},{'featureType':'poi','stylers':[{'saturation':-100},{'lightness':51},{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'road.arterial','stylers':[{'saturation':-100},{'lightness':30},{'visibility':'on'}]},{'featureType':'road.local','stylers':[{'saturation':-100},{'lightness':40},{'visibility':'on'}]},{'featureType':'transit','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'administrative.province','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':-25},{'saturation':-100}]},{'featureType':'water','elementType':'geometry','stylers':[{'hue':'#ffff00'},{'lightness':-25},{'saturation':-97}]}]"
			),
			'coy-beauty'         => array(
				esc_html__( "Coy Beauty", 'utouch' ),
				"[{'featureType':'all','elementType':'geometry.stroke','stylers':[{'visibility':'simplified'}]},{'featureType':'administrative','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels','stylers':[{'visibility':'simplified'},{'color':'#a31645'}]},{'featureType':'landscape','elementType':'all','stylers':[{'weight':'3.79'},{'visibility':'on'},{'color':'#ffecf0'}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'landscape','elementType':'geometry.stroke','stylers':[{'visibility':'on'}]},{'featureType':'poi','elementType':'all','stylers':[{'visibility':'simplified'},{'color':'#a31645'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'saturation':'0'},{'lightness':'0'},{'visibility':'off'}]},{'featureType':'poi','elementType':'geometry.stroke','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'all','stylers':[{'visibility':'simplified'},{'color':'#d89ca8'}]},{'featureType':'poi.business','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'poi.business','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'saturation':'0'}]},{'featureType':'poi.business','elementType':'labels','stylers':[{'color':'#a31645'}]},{'featureType':'poi.business','elementType':'labels.icon','stylers':[{'visibility':'simplified'},{'lightness':'84'}]},{'featureType':'road','elementType':'all','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','elementType':'all','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'color':'#d89ca8'},{'visibility':'on'}]},{'featureType':'water','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#fedce3'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'off'}]}]"
			),
			'subtle-grayscale'   => array(
				esc_html__( "Subtle Grayscale", 'utouch' ),
				"[{'featureType':'landscape','stylers':[{'saturation':-100},{'lightness':65},{'visibility':'on'}]},{'featureType':'poi','stylers':[{'saturation':-100},{'lightness':51},{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'road.arterial','stylers':[{'saturation':-100},{'lightness':30},{'visibility':'on'}]},{'featureType':'road.local','stylers':[{'saturation':-100},{'lightness':40},{'visibility':'on'}]},{'featureType':'transit','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'administrative.province','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':-25},{'saturation':-100}]},{'featureType':'water','elementType':'geometry','stylers':[{'hue':'#ffff00'},{'lightness':-25},{'saturation':-97}]}]"
			),
			'pale-dawn'          => array(
				esc_html__( "Pale Dawn", 'utouch' ),
				"[{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#acbcc9'}]},{'featureType':'landscape','stylers':[{'color':'#f2e5d4'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'color':'#c5c6c6'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#e4d7c6'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#fbfaf7'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#c5dac6'}]},{'featureType':'administrative','stylers':[{'visibility':'on'},{'lightness':33}]},{'featureType':'road'},{'featureType':'poi.park','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':20}]},{},{'featureType':'road','stylers':[{'lightness':20}]}]"
			),
			'blue-water'         => array(
				esc_html__( "Blue water", 'utouch' ),
				"[{'featureType':'water','stylers':[{'color':'#46bcec'},{'visibility':'on'}]},{'featureType':'landscape','stylers':[{'color':'#f2f2f2'}]},{'featureType':'road','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels.text.fill','stylers':[{'color':'#444444'}]},{'featureType':'transit','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'off'}]}]"
			),
			'shades-of-grey'     => array(
				esc_html__( "Shades of Grey", 'utouch' ),
				"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':16}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':21}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#000000'},{'lightness':16}]},{'elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#000000'},{'lightness':40}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':19}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':17},{'weight':1.2}]}]"
			),
			'midnight-commander' => array(
				esc_html__( "Midnight Commander", 'utouch' ),
				"[{'featureType':'water','stylers':[{'color':'#021019'}]},{'featureType':'landscape','stylers':[{'color':'#08304b'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#0c4152'},{'lightness':5}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#0b434f'},{'lightness':25}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.arterial','elementType':'geometry.stroke','stylers':[{'color':'#0b3d51'},{'lightness':16}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'elementType':'labels.text.stroke','stylers':[{'color':'#000000'},{'lightness':13}]},{'featureType':'transit','stylers':[{'color':'#146474'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#144b53'},{'lightness':14},{'weight':1.4}]}]"
			),
			'retro'              => array(
				esc_html__( "Retro", 'utouch' ),
				"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'water','stylers':[{'color':'#84afa3'},{'lightness':52}]},{'stylers':[{'saturation':-17},{'gamma':0.36}]},{'featureType':'transit.line','elementType':'geometry','stylers':[{'color':'#3f518c'}]}]"
			),
			'light-monochrome'   => array(
				esc_html__( "Light Monochrome", 'utouch' ),
				"[{'featureType':'water','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':-78},{'lightness':67},{'visibility':'simplified'}]},{'featureType':'landscape','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'simplified'}]},{'featureType':'road','elementType':'geometry','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'simplified'}]},{'featureType':'poi','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'off'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'hue':'#e9ebed'},{'saturation':-90},{'lightness':-8},{'visibility':'simplified'}]},{'featureType':'transit','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':10},{'lightness':69},{'visibility':'on'}]},{'featureType':'administrative.locality','elementType':'all','stylers':[{'hue':'#2c2e33'},{'saturation':7},{'lightness':19},{'visibility':'on'}]},{'featureType':'road','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'on'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':-2},{'visibility':'simplified'}]}]"
			),
			'paper'              => array(
				esc_html__( "Paper", 'utouch' ),
				"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'road.arterial','stylers':[{'visibility':'off'}]},{'featureType':'water','stylers':[{'color':'#5f94ff'},{'lightness':26},{'gamma':5.86}]},{},{'featureType':'road.highway','stylers':[{'weight':0.6},{'saturation':-85},{'lightness':61}]},{'featureType':'road'},{},{'featureType':'landscape','stylers':[{'hue':'#0066ff'},{'saturation':74},{'lightness':100}]}]"
			),
			'gowalla'            => array(
				esc_html__( "Gowalla", 'utouch' ),
				"[{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'},{'lightness':20}]},{'featureType':'administrative.land_parcel','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'road.local','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'hue':'#a1cdfc'},{'saturation':30},{'lightness':49}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'hue':'#f49935'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'hue':'#fad959'}]}]"
			),
			'greyscale'          => array(
				esc_html__( "Greyscale", 'utouch' ),
				"[{'featureType':'all','stylers':[{'saturation':-100},{'gamma':0.5}]}]"
			),
			'apple-maps-esque'   => array(
				esc_html__( "Apple Maps-esque", 'utouch' ),
				"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#a2daf2'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'color':'#f7f1df'}]},{'featureType':'landscape.natural','elementType':'geometry','stylers':[{'color':'#d0e3b4'}]},{'featureType':'landscape.natural.terrain','elementType':'geometry','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#bde6ab'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.medical','elementType':'geometry','stylers':[{'color':'#fbd3da'}]},{'featureType':'poi.business','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#ffe15f'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#efd151'}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'road.local','elementType':'geometry.fill','stylers':[{'color':'black'}]},{'featureType':'transit.station.airport','elementType':'geometry.fill','stylers':[{'color':'#cfb2db'}]}]"
			),
			'subtle'             => array(
				esc_html__( "Subtle", 'utouch' ),
				"[{'featureType':'poi','stylers':[{'visibility':'off'}]},{'stylers':[{'saturation':-70},{'lightness':37},{'gamma':1.15}]},{'elementType':'labels','stylers':[{'gamma':0.26},{'visibility':'off'}]},{'featureType':'road','stylers':[{'lightness':0},{'saturation':0},{'hue':'#ffffff'},{'gamma':0}]},{'featureType':'road','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'lightness':50},{'saturation':0},{'hue':'#ffffff'}]},{'featureType':'administrative.province','stylers':[{'visibility':'on'},{'lightness':-50}]},{'featureType':'administrative.province','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'administrative.province','elementType':'labels.text','stylers':[{'lightness':20}]}]"
			),
			'neutral-blue'       => array(
				esc_html__( "Neutral Blue", 'utouch' ),
				"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#193341'}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#2c5a71'}]},{'featureType':'road','elementType':'geometry','stylers':[{'color':'#29768a'},{'lightness':-37}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#3e606f'},{'weight':2},{'gamma':0.84}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'administrative','elementType':'geometry','stylers':[{'weight':0.6},{'color':'#1a3541'}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#2c5a71'}]}]"
			),
			'flat-map'           => array(
				esc_html__( "Flat Map", 'utouch' ),
				"[{'stylers':[{'visibility':'off'}]},{'featureType':'road','stylers':[{'visibility':'on'},{'color':'#ffffff'}]},{'featureType':'road.arterial','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'road.highway','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'landscape','stylers':[{'visibility':'on'},{'color':'#f3f4f4'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#7fc8ed'}]},{},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#83cead'}]},{'elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'weight':0.9},{'visibility':'off'}]}]"
			),
			'shift-worker'       => array(
				esc_html__( "Shift Worker", 'utouch' ),
				"[{'stylers':[{'saturation':-100},{'gamma':1}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'saturation':50},{'gamma':0},{'hue':'#50a5d1'}]},{'featureType':'administrative.neighborhood','elementType':'labels.text.fill','stylers':[{'color':'#333333'}]},{'featureType':'road.local','elementType':'labels.text','stylers':[{'weight':0.5},{'color':'#333333'}]},{'featureType':'transit.station','elementType':'labels.icon','stylers':[{'gamma':1},{'saturation':50}]}]"
			),
		);
	}
}

/*
 * */
if ( ! function_exists( 'utouch_show_oembed' ) ):
	function utouch_show_oembed( $video_link ) {
		$youtube_id = $vimeo_id = '';
		if ( preg_match( "/(youtube.com)/", $video_link ) ) {
			$video_id   = explode( "v=", preg_replace( "/(&)+(.*)/", null, $video_link ) );
			$youtube_id = $video_id[1];
		} elseif ( preg_match( "/(youtu.be)/", $video_link ) ) {
			$video_id   = explode( "/", preg_replace( "/(&)+(.*)/", null, $video_link ) );
			$youtube_id = $video_id[3];

		} elseif ( preg_match( "/(vimeo.com)/", $video_link ) ) {
			$regexstr = '/https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/';
			preg_match( $regexstr, $video_link, $matches );
			$vimeo_id = $matches[3];
		}

		if ( ! empty( $youtube_id ) ) {
			echo '<div data-video-id="' . $youtube_id . '" data-type="youtube"></div>';
		} elseif ( ! empty( $vimeo_id ) ) {
			echo '<div data-video-id="' . $vimeo_id . '" data-type="vimeo"></div>';
		}

	}
endif;

if ( ! function_exists( 'utouch_animated_images_collection' ) ):
	function utouch_animated_images_collection( $row_animation ) {
		$data_animation_images = array();

		if ( function_exists( 'fw_locate_theme_path_uri' ) ) {
			$images_path = fw_locate_theme_path_uri( '/images/animated/' );
		} else {
			$images_path = get_template_directory_uri() . '/images/animated/';
		}

		if ( $row_animation === 'seo-score' ) {
			$data_animation_images = array(
				'seoscore1' => $images_path . 'seoscore1.png',
				'seoscore2' => $images_path . 'seoscore2.png',
				'seoscore3' => $images_path . 'seoscore3.png',
			);
		} elseif ( $row_animation === 'background-mountains' ) {
			$data_animation_images = array(
				'mountain1' => $images_path . 'mountain1.png',
				'mountain2' => $images_path . 'mountain2.png',
			);
		} elseif ( $row_animation === 'testimonial-slider' ) {
			$data_animation_images = array(
				'testimonial1' => $images_path . 'testimonial1.png',
				'testimonial2' => $images_path . 'testimonial2.png',
			);
		} elseif ( $row_animation === 'subscribe' ) {
			$data_animation_images = array(
				'gear'  => $images_path . 'subscr-gear.png',
				'mail'  => $images_path . 'subscr1.png',
				'mail2' => $images_path . 'subscr-mailopen.png',
			);
		} elseif ( $row_animation === 'our-vision' ) {
			$data_animation_images = array(
				'elements' => $images_path . 'elements.png',
				'eye'      => $images_path . 'eye.png',
			);
		}

		return $data_animation_images;
	}
endif;

function utouch_empty_content( $str ) {
	return trim( str_replace( '&nbsp;', '', strip_tags( $str ) ) ) == '';
}


if ( ! function_exists( 'utouch_get_svg_icon' ) ) {
	/**
	 * Insert into page svg icons as inline elements.
	 *
	 * @param $svg_url string Path to svg file
	 *
	 * @return bool|string
	 */
	function utouch_get_svg_icon( $svg_url ) {

		$svg_file_new = '';
		$find_string  = '<svg';

		$svg_file      = wp_remote_get( esc_url_raw( $svg_url ) );
		$response_code = wp_remote_retrieve_response_code( $svg_file );
		if ( 200 === $response_code ) {
			$svg_file = wp_remote_retrieve_body( $svg_file );
			// Remove dimensions
			$svg_file = preg_replace( "/(width|height)=\".*?\"/", "", $svg_file );
			// Add class "utouch-icon"
			if ( false === strpos( $svg_file, 'utouch-icon' ) ) {
				$svg_file = str_replace( $find_string, $find_string . ' class="utouch-icon" ', $svg_file );
			}
			$position     = strpos( $svg_file, $find_string );
			$svg_file_new = substr( $svg_file, $position );
		}

		return $svg_file_new;
	}
}


/**
 * Convert text in tweets to links.
 *
 * @param string $tweet Tweet.
 *
 * @return string
 */
function utouch_twitter_convert_links( $tweet ) {

	//Convert urls to <a> links
	$tweet = preg_replace( "/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $tweet );

//Convert hashtags to twitter searches in <a> links
	$tweet = preg_replace( "/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"https://twitter.com/search?q=$1\">#$1</a>", $tweet );

//Convert attags to twitter profiles in &lt;a&gt; links
	$tweet = preg_replace( "/@([A-Za-z0-9\/\.]*)/", "<a href=\"https://www.twitter.com/$1\">@$1</a>", $tweet );

	return $tweet;
}

// Related posts plugin addition.
add_filter( 'rp4wp_append_content', '__return_false' );

/**
 * Get instagram Photos without API keys
 *
 * @param string $username Instagram Username
 * @param int $slice Limit number of photos
 * @param int $cachetime Time to store in cache (in hours)
 *
 * @return array|WP_Error
 */
function utouch_scrape_instagram( $username, $slice = 9, $cachetime = 2 ) {
	$username  = trim( strtolower( $username ) );
	$by_hashtag = ( substr( $username, 0, 1 ) == '#' );
	$transient_name = 'crum_w_instagramm_' . sanitize_title_with_dashes( $username );
	$instagram = get_transient( $transient_name );

	if ( false === $instagram ) {

		$request_param = ( $by_hashtag ) ? 'explore/tags/' . substr( $username, 1 ) : trim( $username );
		$remote = wp_remote_get( 'https://instagram.com/'. $request_param );

		if ( is_wp_error( $remote ) ) {
			return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'utouch' ) );
		}

		if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
			return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'utouch' ) );
		}

		$shards = explode( 'window._sharedData = ', $remote['body'] );
		$insta_json = explode( ';</script>', $shards[1] );
		$insta_array = json_decode( $insta_json[0], TRUE );

		if ( ! $insta_array ){
			return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'utouch' ) );
		}

		if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
			$images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
		} elseif( $by_hashtag && isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
			$images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
		} else {
			return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'utouch' ) );
		}

		if ( ! is_array( $images ) ) {
			return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'utouch' ) );
		}

		$instagram = array();

		foreach ( $images as $image ) {
			$image = $image['node'];
			$caption = esc_html__( 'Instagram Image', 'utouch' );
			if ( ! empty( $image['edge_media_to_caption']['edges'][0]['node']['text'] ) ) $caption = $image['edge_media_to_caption']['edges'][0]['node']['text'];

			$image['thumbnail_src'] = preg_replace( "/^https:/i", "", $image['thumbnail_src'] );
			$image['thumbnail'] = preg_replace( "/^https:/i", "", $image['thumbnail_resources'][0]['src'] );
			$image['medium'] = preg_replace( "/^https:/i", "", $image['thumbnail_resources'][2]['src'] );
			$image['large'] = $image['thumbnail_src'];

			$type = ( $image['is_video'] ) ? 'video' : 'image';

			$instagram[] = array(
				'description'   => $caption,
				'link'		  	=> '//instagram.com/p/' . $image['shortcode'],
				'comments'	  	=> $image['edge_media_to_comment']['count'],
				'likes'		 	=> $image['edge_liked_by']['count'],
				'thumbnail'	 	=> $image['thumbnail'],
				'medium'		=> $image['medium'],
				'large'			=> $image['large'],
				'type'		  	=> $type
			);
		}

		// Do not set an empty transient - should help catch private or empty accounts.
		if ( ! empty( $instagram ) ) {
			$instagram = json_encode( serialize( $instagram ) );
			set_transient( 'crum_instagram_' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * $cachetime ) );
		}
	}
	if ( ! empty( $instagram ) ) {
		$instagram = unserialize( json_decode( $instagram ) );

		return array_slice( $instagram, 0, $slice );
	} else {
		return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'utouch' ) );
	}
}



//Convert col decimal format to class
// Replace for King Composer plugin class
function utouch_column_width_class( $width ) {

	if ( empty( $width ) ) {
		return 'col-md-12 col-sm-12';
	}

	if ( strpos( $width, '%' ) !== false ) {
		$width = (float) $width;
		if ( $width < 12 ) {
			return 'col-md-1 col-sm-6 col-xs-12';
		} else if ( $width < 18 ) {
			return 'col-md-2 col-sm-6 col-xs-12';
		} else if ( $width < 22.5 ) {
			return 'kc_col-of-5';
		} else if ( $width < 29.5 ) {
			return 'col-md-3 col-sm-6 col-xs-12';
		} else if ( $width < 37 ) {
			return 'col-md-4 col-sm-12';
		} else if ( $width < 46 ) {
			return 'col-md-5 col-sm-12';
		} else if ( $width < 54.5 ) {
			return 'col-md-6 col-sm-12';
		} else if ( $width < 63 ) {
			return 'col-md-7 col-sm-12';
		} else if ( $width < 71.5 ) {
			return 'col-md-8 col-sm-12';
		} else if ( $width < 79.5 ) {
			return 'col-md-9 col-sm-12';
		} else if ( $width < 87.5 ) {
			return 'col-md-10 col-sm-12';
		} else if ( $width < 95.5 ) {
			return 'col-md-11 col-sm-12';
		} else {
			return 'col-md-12 col-sm-12';
		}
	}

	$matches     = explode( '/', $width );
	$width_class = '';
	$n           = 12;
	$m           = 12;

	if ( isset( $matches[0] ) && ! empty( $matches[0] ) ) {
		$n = $matches[0];
	}
	if ( isset( $matches[1] ) && ! empty( $matches[1] ) ) {
		$m = $matches[1];
	}

	if ( $n == 2.4 ) {
		$width_class = 'kc_col-of-5';
	} else {
		if ( $n > 0 && $m > 0 ) {
			$value = ceil( ( $n / $m ) * 12 );
			if ( $value > 0 && $value <= 12 ) {
				$width_class = 'col-md-' . $value;
			}
		}
	}

	return $width_class;
}

function utouch_stunning_header_partial_template() {
	if ( ! Utouch::template_stunning()->show ) {
		return '';
	}
	ob_start();
	get_template_part( 'parts/stunning/' . Utouch::template_stunning()->type );

	$html = ob_get_clean();


	$css  = utouch_html_tag( 'style', array(), Utouch::template_stunning()->get_css() );
	$html = substr_replace( $html, $css, '', 0 );

	$html = str_replace( '<!--inline-css-->', $css, $html );

	return $html;
}

function utouch_header_partial_template() {
	$dropdown_style     = $color_scheme = $header_style = $custom_menu = $header_absolute = $header_animation = $sticky_atts = $sticky_pinned = $sticky_unpinned = '';
	$header_class       = array();
	$header_class[]     = 'header';
	$page_id            = get_the_ID();
	$show_top_bar       = 'hide';
	$show_sticky_header = 'yes';
	$header_animation   = 'swing';
	$decorative_line    = 'show';

	$dropdown_styles = array(
		'1' => '',
		'2' => 'header--menu-rounded',
		'3' => 'header--small-lines',
	);
	if ( function_exists( 'fw_get_db_customizer_option' ) ) {
		$show_top_bar       = fw_get_db_customizer_option( 'sections-top-bar/status', 'hide' );
		$show_sticky_header = fw_get_db_customizer_option( 'sticky_header/value', 'yes' );
		$header_animation   = fw_get_db_customizer_option( 'sticky_header/yes/style', 'swing' );
		$decorative_line    = fw_get_db_customizer_option( 'decorative-line', 'show' );
//	$color_scheme       = fw_get_db_customizer_option( 'color-scheme', '' );
		$dropdown_style    = fw_get_db_customizer_option( 'dropdown-style/type', '1' );
		$header_text_color = fw_get_db_customizer_option( 'header-text-color', '' );

	}
	if ( is_singular() && function_exists( 'fw_get_db_post_option' ) ) {
		// Header options
		$enable_customization = fw_get_db_post_option( $page_id, 'custom-header/enable', 'no' );
		if ( 'yes' === $enable_customization ) {
			$custom_header_opt = fw_get_db_post_option( $page_id, 'custom-header/yes', array() );
			$show_top_bar      = utouch_akg( 'sections-top-bar/status', $custom_header_opt, 'hide' );
			$decorative_line   = utouch_akg( 'decorative-line', $custom_header_opt, 'show' );
//		$color_scheme      = utouch_akg( 'color-scheme', $custom_header_opt, '' );
			$dropdown_style    = utouch_akg( 'dropdown-style/type', $custom_header_opt, '1' );
			$header_text_color = utouch_akg( 'header-text-color', $custom_header_opt, '' );

			Utouch::set_var( 'header_page_bg_color', utouch_akg( 'header_bg_color', $custom_header_opt, '' ) );
		}
	}
	if ( ! array_key_exists( $dropdown_style, $dropdown_styles ) ) {
		$dropdown_style = $dropdown_styles[1];
	} else {
		$dropdown_style = $dropdown_styles[ $dropdown_style ];

	}
	if ( ! empty( $header_text_color ) ) {
		$header_class[] = 'header-color-inherit';
	}

	if ( ! empty( $color_scheme ) ) {
		$header_class[] = $color_scheme;
	}
	if ( ! empty( $dropdown_style ) ) {
		$header_class[] = $dropdown_style;
	}
	if ( $show_sticky_header === 'no' ) {
		$header_class[] = 'header-absolute';
		$header_class[] = 'disable-sticky';
	} else {
		switch ( $header_animation ) {
			case 'swing':
				$sticky_pinned   = 'swingInX';
				$sticky_unpinned = 'swingOutX';
				break;
			case 'slide':
				$sticky_pinned   = 'slideDown';
				$sticky_unpinned = 'slideUp';
				break;
			case 'flip':
				$sticky_pinned   = 'flipInX';
				$sticky_unpinned = 'flipOutX';
				break;
			case 'bounce':
				$sticky_pinned   = 'bounceInDown';
				$sticky_unpinned = 'bounceOutUp';
				break;
			case 'none':
				$sticky_pinned   = '';
				$sticky_unpinned = '';
				break;
			default:
				$sticky_pinned   = 'swingInX';
				$sticky_unpinned = 'swingOutX';
		}
	}

	if ( 'show' === $show_top_bar ) {
		$header_class[] = 'header-top-bar';
		$header_class[] = 'header-has-topbar';
	}
	$menu_args = array(
		'menu'           => $custom_menu,
		'theme_location' => 'primary',
		'menu_id'        => 'primary-menu-menu',
		'menu_class'     => 'primary-menu-menu',
		'container'      => 'ul',
		'fallback_cb'    => 'utouch_menu_fallback'
	);

	if ( class_exists( 'Utouch_Mega_Menu_Custom_Walker' ) ) {
		$menu_args['walker'] = new Utouch_Mega_Menu_Custom_Walker();
	}
	if ( 'header--dark' === $color_scheme ) {
		$menu_args['menu_class'] = 'primary-menu-menu primary-menu--dark';
	}

	ob_start();
	?>
    <header class="<?php echo esc_attr( implode( ' ', $header_class ) ); ?>" id="site-header"
            data-pinned="<?php echo esc_attr( $sticky_pinned ) ?>"
            data-unpinned="<?php echo esc_attr( $sticky_unpinned ) ?>">

		<?php if ( 'show' === $show_top_bar ) {
			get_template_part( 'parts/section', 'topbar' );
		} ?>
		<?php if ( 'show' === $decorative_line ): ?>
            <div class="header-lines-decoration">
                <span class="bg-secondary-color"></span>
                <span class="bg-blue"></span>
                <span class="bg-blue-light"></span>
                <span class="bg-orange-light"></span>
                <span class="bg-red"></span>
                <span class="bg-green"></span>
                <span class="bg-secondary-color"></span>
            </div>
		<?php endif; ?>


        <div class="container">
			<?php if ( $show_top_bar ) { ?>
                <a href="#" id="top-bar-js" class="top-bar-link">
                    <svg class="utouch-icon utouch-icon-arrow-top">
                        <use xlink:href="#utouch-icon-arrow-top"></use>
                    </svg>
                </a>
			<?php } ?>

            <div class="header-content-wrapper">
                <div class="site-logo">
					<?php utouch_logo(); ?>
                </div>

                <nav id="primary-menu" class="primary-menu">

                    <!-- menu-icon-wrapper -->
                    <a href='javascript:void(0)' id="menu-icon-trigger" class="menu-icon-trigger showhide">
                        <span class="mob-menu--title"><?php esc_html_e( 'Menu', 'utouch' ); ?></span>
                        <span id="menu-icon-wrapper" class="menu-icon-wrapper">
                            <svg width="1000px" height="1000px">
                                <path id="pathD"
                                      d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800"></path>
                                <path id="pathE" d="M 300 500 L 700 500"></path>
                                <path id="pathF"
                                      d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200"></path>
                            </svg>
                        </span>
                    </a>

                    <!-- menu-icon-wrapper -->

					<?php wp_nav_menu( $menu_args ); ?>
					<?php utouch_additional_nav(); ?>
                </nav>

            </div>
        </div>
    </header>
	<?php
	if ( $header_absolute !== true ) {

		echo '<div id="header-spacer" class="header-spacer"></div>';
	} ?>

	<?php

	$search_color = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'search-icon/yes/color-scheme', 'search--white' ) : 'search--white';

	?>
    <div class="search-popup <?php echo esc_attr( $search_color ) ?>">
        <a href="#" class="popup-close js-popup-close cd-nav-trigger">
            <svg class="utouch-icon utouch-icon-cancel-1">
                <use xlink:href="#utouch-icon-cancel-1"></use>
            </svg>
        </a>

        <div class="search-full-screen">

            <div class="search-standard">
                <form id="search-header" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>"
                      class="search-inline" name="form-search-header">
                    <input class="search-input" name="s" value="<?php get_search_query(); ?>"
                           placeholder="<?php echo esc_html__( 'What are you looking for?', 'utouch' ) ?>"
                           autocomplete="off" type="search">
                    <button type="submit" class="form-icon">
                        <svg class="utouch-icon utouch-icon-search">
                            <use xlink:href="#utouch-icon-search"></use>
                        </svg>
                    </button>
                    <span class="close js-popup-clear-input form-icon">
							<svg class="utouch-icon utouch-icon-cancel-1"><use xlink:href="#utouch-icon-cancel-1"></use></svg>
						</span>
                </form>
            </div>

        </div>

    </div>
	<?php
	$html = ob_get_clean();

	$custom_css = '';

	if ( null === $header_bg_color = Utouch::get_var( 'header_page_bg_color' ) ) {
		$header_bg_color = fw_get_db_customizer_option( 'header_bg_color', '' );
	}
	if ( ! empty( $header_bg_color ) ) {
		$custom_css .= '#site-header{ background:' . esc_attr( $header_bg_color ) . ' }';
	}

	$header_text_color = fw_get_db_customizer_option( 'header-text-color', '' );
	if ( is_singular() && function_exists( 'fw_get_db_post_option' ) ) {
		// Header options
		if ( 'yes' === fw_get_db_post_option( get_the_ID(), 'custom-header/enable', 'no' ) ) {
			$header_text_color = fw_get_db_post_option( get_the_ID(), 'custom-header/yes/header-text-color', '#fff' );
		}
	}
	if ( ! empty( $header_text_color ) ) {
		$custom_css .= '#site-header{ color:' . esc_attr( $header_text_color ) . ' }';
		$custom_css .= '#site-header{ fill:' . esc_attr( $header_text_color ) . ' }';
		$custom_css .= '#site-header{ border-color:' . esc_attr( $header_text_color ) . ' }';
	}
	$html .= utouch_html_tag( 'style', array( 'id' => 'header-customize-css' ), $custom_css );

	return $html;
}

function utouch_footer_partial_template() {


	$copyright_class = $footer_contacts = $description_enable = $description_title = $description_text = $description_columns = $description_class = $description_socials = $footer_fixed = $footer_text = '';

	global $allowedtags;
	global $allowedposttags;
	$my_theme = wp_get_theme();

	$show_to_top      = 'yes';
	$fixed_totop      = false;
	$show_search      = 'yes';
	$show_subscribe   = 'no';
	$search_style     = 'fullscreen';
	$footer_copyright = '<span>Copyright &copy; 2017 <a href="' . esc_html( $my_theme->get( 'AuthorURI' ) ) . '">Utouch by Crumina</a></span>
                    <span>Site is built on <a href="https://wordpress.org">WordPress</a></span>';

	if ( function_exists( 'fw_get_db_customizer_option' ) ) {
		$show_search  = fw_get_db_customizer_option( 'search-icon/value', 'yes' );
		$search_style = fw_get_db_customizer_option( 'search-icon/yes/style', 'fullscreen' );

		$show_subscribe = fw_get_db_customizer_option( 'show_subscribe_section', 'yes' );

		$footer_fixed = fw_get_db_customizer_option( 'footer_fixed', false );
		$footer_text  = fw_get_db_customizer_option( 'footer_text_color', '' );
		$footer_title = fw_get_db_customizer_option( 'footer_title_color', '' );

		$site_description    = fw_get_db_customizer_option( 'site-description', '' );
		$description_enable  = utouch_akg( 'value', $site_description, 'no' );
		$description_title   = utouch_akg( 'yes/description/title', $site_description, '' );
		$description_text    = utouch_akg( 'yes/description/desc', $site_description, '' );
		$description_columns = utouch_akg( 'yes/width-columns', $site_description, '7' );
		$description_class   = utouch_akg( 'yes/class', $site_description, '' );
		$description_socials = utouch_akg( 'yes/social-networks', $site_description, array() );

		$footer_contacts  = fw_get_db_customizer_option( 'footer_contacts', '' );
		$footer_copyright = fw_get_db_customizer_option( 'footer_copyright', '' );
		$copyright_class  = fw_get_db_customizer_option( 'size_copyright_section', 'large' );

		$copyright_text = fw_get_db_customizer_option( 'copyright_text_color', '' );

		$scroll_option = fw_get_db_customizer_option( 'scroll_top_icon', array() );
		$show_to_top   = utouch_akg( 'value', $scroll_option, 'yes' );
		$fixed_totop   = utouch_akg( 'yes/fixed', $scroll_option, false );

	}
	$footer_class = true === $footer_fixed ? 'js-fixed-footer' : '';
	if ( ! empty( $footer_text ) || ! empty( $footer_title ) ) {
		$footer_class .= ' font-color-custom';
	}
	if ( ! empty( $copyright_text ) ) {
		$copyright_class .= ' font-color-custom';
	}

	$scroll_button_class = true === $fixed_totop ? 'back-to-top-fixed' : '';
	$desc_columns_class  = 'col-lg-' . $description_columns . ' col-md-' . $description_columns . ' col-sm-12 col-xs-12';

	if ( 'yes' === $description_enable ) {
		$column = intval( 11 - $description_columns );
		$offset = '1';
		if ( $column < 2 ) {
			$column = 12;
			$offset = '0';
		}
		$sidebar_columns = 'col-lg-offset-' . $offset . ' col-lg-' . $column . ' col-md-' . ( $column + 1 ) . ' col-sm-12 col-xs-12';
	} else {
		$sidebar_columns = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 row info';
	}


	if ( ( 'yes' !== $description_enable || ( empty( $description_title ) && empty( $description_text ) ) ) && ! is_active_sidebar( 'sidebar-footer' ) ) {
		$footer_class .= ' footer-empty ';
	}

	ob_start();

	?>
    <footer class="footer  <?php echo esc_attr( $footer_class ) ?>" id="site-footer">
        <div class="header-lines-decoration">
            <span class="bg-secondary-color"></span>
            <span class="bg-blue"></span>
            <span class="bg-blue-light"></span>
            <span class="bg-orange-light"></span>
            <span class="bg-red"></span>
            <span class="bg-green"></span>
            <span class="bg-secondary-color"></span>
        </div>

        <div class="container">
            <div class="row">
				<?php if ( 'yes' === $description_enable &&
				           ( ! empty( $description_title ) || ! empty( $description_text ) ) ||
				           ( ! empty( $description_socials ) && is_array( $description_socials ) )
				) { ?>
                    <div class="<?php echo esc_attr( $desc_columns_class ) ?>">
						<?php if ( ! empty( $description_title ) || ! empty( $description_text ) ) { ?>
                            <div class="widget w-info">
								<?php if ( ! empty( $description_title ) ) { ?>
                                    <h5 class="widget-title"><?php echo esc_html( $description_title ) ?></h5>
                                    <div class="heading-line">
                                        <span class="short-line"></span>
                                        <span class="long-line"></span>
                                    </div>
								<?php }
								if ( ! empty( $description_text ) ) {

									?>
                                    <div class="heading-text">
										<?php echo( $description_text ) ?>
                                    </div>
								<?php } ?>
                            </div>
						<?php } ?>
                    </div>

				<?php } ?>

				<?php
				if ( is_active_sidebar( 'sidebar-footer' ) ) {
					?>
                    <div class="<?php echo esc_attr( $sidebar_columns ); ?>">
                        <div class="row">
							<?php
							ob_start();
							dynamic_sidebar( 'sidebar-footer' );
							$output                 = ob_get_clean();
							$footer_sibebar_columns = utouch_get_widget_columns( 'sidebar-footer' );
							$footer_sibebar_columns = 'col-lg-' . $footer_sibebar_columns . ' col-md-' . $footer_sibebar_columns . ' col-sm-12 col-xs-12';
							echo str_replace( 'columns_class_replace', $footer_sibebar_columns, $output );
							?>
                        </div>
                    </div>
				<?php } ?>
            </div>

        </div>

        <div class="sub-footer">
			<?php if ( 'yes' === $show_to_top ) { ?>

                <a class="back-to-top <?php echo esc_attr( $scroll_button_class ); ?>" href="#">
                    <svg class="utouch-icon utouch-icon-arrow-top">
                        <use xlink:href="#utouch-icon-arrow-top"></use>
                    </svg>
                </a>
			<?php } ?>

			<?php if ( ! empty( $footer_copyright ) ) { ?>

                <div class="container  <?php echo esc_attr( $copyright_class ) ?>">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<span class="site-copyright-text">
							<?php echo wp_kses( $footer_copyright, $allowedtags ) ?>
						</span>
                        </div>
                    </div>
                </div>
			<?php } ?>


        </div>

    </footer>

	<?php get_template_part( 'parts/contact', 'form' ) ?>

	<?php
	$html = ob_get_clean();

	$footer_bg       = fw_get_db_customizer_option( 'footer_bg_color', '' );
	$footer_bg_img   = fw_get_db_customizer_option( 'footer_bg_image', '' );
	$footer_bg_cover = fw_get_db_customizer_option( 'footer_bg_cover', false );
	$footer_text     = fw_get_db_customizer_option( 'footer_text_color', '' );
	$footer_title    = fw_get_db_customizer_option( 'footer_title_color', '' );

	$custom_css = '';
	if ( ! empty( $footer_bg ) || ! empty( $footer_bg_img ) || ! empty( $footer_text ) ) {
		$custom_css .= '#site-footer{';
		if ( ! empty( $footer_bg ) ) {
			$custom_css .= 'background-color:' . esc_attr( $footer_bg ) . ';';
		}
		if ( ! empty( $footer_bg_img ) ) {
			$bg_img_url = utouch_akg( 'data/css/background-image', $footer_bg_img, '' );
			if ( isset( $footer_bg_img ) && ! empty( $footer_bg_img ) ) {
				$custom_css .= 'background-image:' . ( $bg_img_url ) . ';';

				if ( true === $footer_bg_cover ) {
					$custom_css .= 'background-size:cover;';
				}
			}
		}
		if ( ! empty( $footer_text ) ) {
			$custom_css .= 'color:' . esc_attr( $footer_text ) . ';';
		}
		$custom_css .= '}';
	}
	if ( ! empty( $footer_title ) ) {
		$custom_css .= '#site-footer .widget .widget-title, #site-footer > .container a:not(.btn), #site-footer a.social__item svg, #site-footer .w-list ul.list, #site-footer .widget_nav_menu ul.list{';
		$custom_css .= 'color:' . esc_attr( $footer_title ) . ';';
		$custom_css .= 'fill:' . esc_attr( $footer_title ) . ';';
		$custom_css .= '}';
	}

	// Copyright section styling.
	$copyright_bg   = fw_get_db_customizer_option( 'copyright_bg_color', '' );
	$copyright_text = fw_get_db_customizer_option( 'copyright_text_color', '' );
	if ( ! empty( $copyright_bg ) || ! empty( $copyright_text ) ) {
		if ( ! empty( $copyright_bg ) ) {
			$custom_css .= '#site-footer .sub-footer{ background-color:' . esc_attr( $copyright_bg ) . '}';
		}
		if ( ! empty( $copyright_text ) ) {
			$custom_css .= '#site-footer .site-copyright-text{ color:' . esc_attr( $copyright_text ) . '}';
		}
	}

	$html .= utouch_html_tag( 'style', array( 'id' => 'footer-customize-css' ), $custom_css );

	return $html;
}

function utouch_is_phone( $phone ) {
	preg_match( '/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/', $phone, $output_array );

	return ! empty( $output_array );
}

function utouch_is_email( $email ) {
	preg_match( '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/', $email, $output_array );

	return ! empty( $output_array );
}

function utouch_custom_loop( $post_type = '', $post_id = 0, $terms = 0,
                             $page = 0 ) {
    $sticky_posts = get_option( 'sticky_posts' );
    $post_id      = $post_id ? $post_id : get_the_ID();

    if ( 'fw-portfolio' === $post_type ) {
        $per_page = fw_get_db_settings_option( 'per_page', 9 );
        $order    = fw_get_db_settings_option( 'order', 'DESC' );
        $orderby  = fw_get_db_settings_option( 'orderby', 'date' );
        $taxonomy = 'fw-portfolio-category';
    } else {
        $per_page = get_option( 'posts_per_page' );
        $order    = 'DESC';
        $orderby  = 'date';
        $taxonomy = 'category';
    }

    if ( function_exists( 'fw_get_db_post_option' ) ) {
        $meta_per_page = fw_get_db_post_option( $post_id, 'per_page' );
        $meta_order    = fw_get_db_post_option( $post_id, 'order' );
        $meta_orderby  = fw_get_db_post_option( $post_id, 'orderby' );
        $meta_terms    = fw_get_db_post_option( $post_id, 'taxonomy_select' );
        $meta_exclude  = fw_get_db_post_option( $post_id, 'exclude' );
    }

    if ( isset( $meta_per_page ) && !empty( $meta_per_page ) ) {
        $per_page = $meta_per_page;
    }

    if ( isset( $meta_order ) && !empty( $meta_order ) && !( 'default' === $meta_order ) ) {
        $order = $meta_order;
    }

    if ( isset( $meta_orderby ) && !empty( $meta_orderby ) && !( 'default' === $meta_orderby ) ) {
        $orderby = $meta_orderby;
    }

    if ( is_front_page() ) {
        $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
    } else {
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    }

    /* if ( 'category' === $taxonomy && ! empty( $sticky_posts ) && 1 === $paged ) {
      $per_page = intval($per_page - 1);
      } */

    if ( $terms ) {
        $meta_terms   = array( $terms );
        $meta_exclude = false;
    }

    if ( $page ) {
        $paged = $page;
    }

    $args = array(
        'post_type'      => $post_type,
        'paged'          => $paged,
        'posts_per_page' => $per_page,
        'order'          => $order,
        'orderby'        => $orderby,
    );

    if ( !empty( $meta_terms ) ) {
        if ( true === $meta_exclude ) {
            $operator = 'NOT IN';
        } else {
            $operator = 'IN';
        }
        $args[ 'tax_query' ] = array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $meta_terms,
                'operator' => $operator,
            ),
        );
    }

    $porfolio_query = new WP_Query( $args );

    return $porfolio_query;
}

add_action( 'wp_head', 'utouch_wp_head', 999, 0 );
function utouch_wp_head() {
	echo utouch_html_tag( 'style', array(), 'html {    margin-top: 0 !important;}' );
}

