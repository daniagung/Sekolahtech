<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Filters and Actions
 */





/**
 * Enqueue Google fonts style to admin screen for custom header display.
 * @internal
 */
function _action_utouch_admin_fonts() {
	wp_enqueue_style( 'utouch-font', utouch_font_url(), array(), '1.0' );
}

add_action( 'admin_print_scripts-appearance_page_custom-header', '_action_utouch_admin_fonts' );

if ( ! function_exists( '_action_utouch_setup' ) ) : /**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 * @internal
 */ {
	function _action_utouch_setup() {

		add_theme_support( "title-tag" );
		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'utouch', get_template_directory() . '/languages' );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'css/editor-style.css', utouch_font_url() ) );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 690, 420, true );
		add_image_size( 'utouch-full-width', 1038, 576, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comments__list',
			'gallery',
			'caption'
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'video',
			'audio',
			'quote',
			'link',
			'gallery',
		) );

		// Remove REST links from header
		remove_action( 'template_redirect', 'rest_output_link_header', 11 );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );

		// Declare 3-rd party plugins support
		add_theme_support( 'woocommerce', array(
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 2,
				'max_rows'        => 8,

				'default_columns' => 3,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		) );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

//		add_theme_support('customize-selective-refresh-widgets');
	}
}
endif;
add_action( 'after_setup_theme', '_action_utouch_setup' );


add_action('after_switch_theme', 'utouch_setup_plugins_options');

function utouch_setup_plugins_options () {
	add_option('fw_ext_settings_options:page-builder','a:1:{s:10:"post_types";a:0:{}}');
	add_option('kc_options','a:3:{s:9:"max_width";s:6:"1200px";s:8:"css_code";s:0:"";s:7:"license";s:41:"g62osph1-kqfg-o8qb-y7v2-89gm-5tx7ky6un2sh";}');
}

/**
 * Adjust content_width value for image attachment template.
 * @internal
 */
function _action_utouch_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}

add_action( 'template_redirect', '_action_utouch_content_width' );

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 *
 * @param array $classes A list of existing body class values.
 *
 * @return array The filtered body class list.
 * @internal
 */
function _filter_utouch_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( is_active_sidebar( 'sidebar-footer' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	$classes[] = 'crumina-grid';
	$classes[] = 'skew-rows';
	$classes[] = 'utouch';

	return $classes;
}

add_filter( 'body_class', '_filter_utouch_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @param array $classes A list of existing post class values.
 *
 * @return array The filtered post class list.
 * @internal
 */
function _filter_utouch_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}

add_filter( 'post_class', '_filter_utouch_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 *
 * @return string The filtered title.
 * @internal
 */
function _filter_utouch_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'utouch' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', '_filter_utouch_wp_title', 10, 2 );


/**
 * Flush out the transients used in utouch_categorized_blog.
 * @internal
 */
function _action_utouch_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'utouch_category_count' );
}

add_action( 'edit_category', '_action_utouch_category_transient_flusher' );
add_action( 'save_post', '_action_utouch_category_transient_flusher' );

/**
 * Register widget areas.
 * @internal
 */
function _action_utouch_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Main Widget Area', 'utouch' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'Appears in the right section of the site.', 'utouch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'utouch' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Appears in footer section. Every widget in own column ', 'utouch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s columns_class_replace">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

}

add_action( 'widgets_init', '_action_utouch_widgets_init' );


/**
 * Count Widgets
 * Count the number of widgets to add dynamic column class
 *
 * @param string $sidebar_id id of sidebar
 *
 * @since 1.0.0
 *
 * @return int
 */
function utouch_get_widget_columns( $sidebar_id ) {
	// Default number of columns in grid is 12
	$columns = apply_filters( 'utouch_columns', 12 );

	// get the sidebar widgets
	$the_sidebars = wp_get_sidebars_widgets();

	// if sidebar doesn't exist return error
	if ( ! isset( $the_sidebars[ $sidebar_id ] ) ) {
		return esc_html__( 'Invalid sidebar ID', 'utouch' );
	}

	/* count number of widgets in the sidebar
	and do some simple math to calculate the columns */
	$num = count( $the_sidebars[ $sidebar_id ] );

	switch ( $num ) {
		case 1 :
			$num = $columns;
			break;
		case 2 :
			$num = $columns / 2;
			break;
		case 3 :
			$num = $columns / 3;
			break;
		case 4 :
			$num = $columns / 4;
			break;
		case 5 :
			$num = $columns / 5;
			break;
		case 6 :
			$num = $columns / 6;
			break;
		case 7 :
			$num = $columns / 7;
			break;
		case 8 :
			$num = $columns / 8;
			break;
	}
	$num = floor( $num );

	return $num;
}

/**
 * Custom read more Link formatting
 *
 * @return string
 */
function utouch_read_more_link() {
	return '';
}

function utouch_excerpt_link( $output ) {
	return $output;
}

add_filter( 'the_content_more_link', 'utouch_read_more_link' );
add_filter( 'get_the_excerpt', 'utouch_excerpt_link' );

/**
 * Customize the Password Form on Protected Posts
 *
 * @param int $post Post ID.
 *
 * @return string
 */
function utouch_password_form( $post ) {
	$current_post = get_post( $post );
	$label        = 'pwbox-' . ( empty( $current_post->ID ) ? rand() : $current_post->ID );
	$output       = '<h6>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'utouch' ) . '</h6><form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form form-inline" method="post">
  
                <input name="post_password" required="required" id="' . $label . '" type="password" size="20" placeholder="' . esc_html__( 'Password:', 'utouch' ) . '"><button type="submit" name="Submit" class="btn btn--green">' . esc_attr__( 'Submit', 'utouch' ) . '</button>
        
    </form>';

	return $output;
}

add_filter( 'the_password_form', 'utouch_password_form' );

function utouch_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}

add_filter( 'comment_form_fields', 'utouch_move_comment_field_to_bottom' );

//add_filter(
//	'fw:option_type:icon-v2:packs',
//	'_add_more_packs'
//);

function _add_more_packs( $default_packs ) {
	return array(
		'utouch' => array(
			'name'             => 'utouch',
			'css_class_prefix' => 'seoicon',
			'css_file'         => get_template_directory() . '/css/crumina-icons.css',
			'css_file_uri'     => get_template_directory_uri() . '/css/crumina-icons.css'
		)
	);
}

function _filter_utouch_disable_sliders( $sliders ) {
	foreach ( array( 'owl-carousel', 'bx-slider', 'nivo-slider' ) as $name ) {
		$key = array_search( $name, $sliders );
		unset( $sliders[ $key ] );
	}

	return $sliders;
}

add_filter( 'fw_ext_slider_activated', '_filter_utouch_disable_sliders' );

/**
 * Add SVG capabilities
 */
function utouch_svg_mime_type( $mimes = array() ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';

	return $mimes;

}

add_filter( 'upload_mimes', 'utouch_svg_mime_type' );

/**
 * Add SVG support to admin media browser.
 */
function utouch_svg_media_display() {
	if ( function_exists( 'utouch_html_tag' ) ) {
		ob_start(); ?>
		var el = document.getElementById('tmpl-attachment');
		var pos = el.outerHTML.indexOf('
		<# } else if ( \'image\' === data.type && data.sizes ) { #>');
			var text = '
			<# } else if ( \'svg+xml\' === data.subtype ) { #>\n' +
				'
				<div class="centered">\n' +
					'<img src="{{ data.url }}" class="thumbnail" draggable="false"/>\n' +
					'
				</div>
				\n' +
				'
				<div class="filename">' +
					'
					<div>{{ data.filename }}</div>
					' +
					'
				</div>
				';
				el.outerHTML = [el.outerHTML.slice(0, pos), text, el.outerHTML.slice(pos)].join('');
		<?php
		$script_html = ob_get_clean();
		echo utouch_html_tag( 'script', array(), $script_html );
	}
}

//add_action( 'print_media_templates', 'utouch_svg_media_display', 42 );

/**
 * Add tags to allowedtags filter
 */
function utouch_extend_allowed_tags() {
	global $allowedtags;

	$allowedtags['i']    = array(
		'class' => array(),
	);
	$allowedtags['br']   = array(
		'class' => array(),
	);
	$allowedtags['img']  = array(
		'src'    => array(),
		'alt'    => array(),
		'width'  => array(),
		'height' => array(),
		'class'  => array(),
	);
	$allowedtags['span'] = array(
		'class' => array(),
		'style' => array(),
	);
	$allowedtags['a']    = array(
		'class'   => array(),
		'href'    => array(),
		'target'  => array(),
		'onclick' => array(),

	);
}

add_action( 'init', 'utouch_extend_allowed_tags' );

/**
 * Change text strings
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function utouch_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Add Sidebar' :
			$translated_text = esc_html__( 'Save changes', 'utouch' );
			break;

	}

	return $translated_text;
}

add_filter( 'gettext', 'utouch_text_strings', 20, 3 );


/**
 * Disable content editor for page template.
 */
function utouch_disable_admin_metabox() {

	$only = array(
		'only' => array( array( 'id' => 'page' ) ),
	);
	if ( function_exists( 'fw_current_screen_match' ) && fw_current_screen_match( $only ) ) {
		$post_id = ( isset( $_GET['post'] ) ) ? $_GET['post'] : '';
		if ( empty( $post_id ) ) {
			remove_meta_box( 'fw-options-box-portfolio-page', 'page', 'normal' );
			remove_meta_box( 'fw-options-box-blog-page', 'page', 'normal' );
		}
		$template_file = get_post_meta( $post_id, '_wp_page_template', true );
		if ( 'portfolio-template.php' === $template_file ) {
			remove_meta_box( 'fw-options-box-blog-page', 'page', 'normal' );
			remove_meta_box( 'fw-options-box-event-page', 'page', 'normal' );

		} elseif ( 'blog-template.php' === $template_file ) {
			remove_meta_box( 'fw-options-box-portfolio-page', 'page', 'normal' );
			remove_meta_box( 'fw-options-box-event-page', 'page', 'normal' );

		} elseif ( 'event-template.php' === $template_file ) {
			remove_meta_box( 'fw-options-box-portfolio-page', 'page', 'normal' );
			remove_meta_box( 'fw-options-box-blog-page', 'page', 'normal' );
		} else {
			remove_meta_box( 'fw-options-box-portfolio-page', 'page', 'normal' );
			remove_meta_box( 'fw-options-box-blog-page', 'page', 'normal' );
			remove_meta_box( 'fw-options-box-event-page', 'page', 'normal' );
		}
	}
}

add_action( 'do_meta_boxes', 'utouch_disable_admin_metabox', 99 );

/**
 * Extend the default WordPress category title.
 *
 * Remove 'Category' word from cat title.
 *
 * @param string $title Original category title.
 *
 * @return string The filtered category title.
 * @internal
 */
function _filter_utouch_archive_title( $title ) {
	if ( is_home() ) {
		$title = esc_html__( 'Latest posts', 'utouch' );
	} elseif ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( ( is_singular( 'post' ) ) ) {
		$category = get_the_category( get_the_ID() );
		$title    = $category[0]->name;
	} elseif ( is_singular( 'product' ) || is_singular( 'download' ) ) {
		$title = '<h2 class="stunning-header-title h1">' . esc_html__( 'Product Details', 'utouch' ) . '</h2>';
	}

	return $title;
}

add_filter( 'get_the_archive_title', '_filter_utouch_archive_title' );


function utouch_add_async_attribute( $tag, $handle ) {
	// add script handles to the array below
	$scripts_to_async = array( 'utouch-share-buttons' );

	foreach ( $scripts_to_async as $async_script ) {
		if ( $async_script === $handle ) {
			return str_replace( ' src', ' async="async" src', $tag );
		}
	}

	return $tag;
}

add_filter( 'script_loader_tag', 'utouch_add_async_attribute', 10, 2 );

/**
 * Exclude kc Section Post type from search query
 */
add_action( 'init', 'utouch_exclude_kc_section_search', 99 );
function utouch_exclude_kc_section_search() {
	global $wp_post_types;
	if ( post_type_exists( 'kc-section' ) ) {
		$wp_post_types['kc-section']->exclude_from_search = true;
	}
}

/**
 * Modify query to remove a post type from search results, but keep all others
 *
 * @author Joshua David Nelson, josh@joshuadnelson.com
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2+
 */
add_action( 'pre_get_posts', 'utouch_search_modify_query' );
function utouch_search_modify_query( $query ) {

	// First, make sure this isn't the admin and is the main query, otherwise bail
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	// If this is a search result query
	if ( $query->is_search() ) {
		// Gather all searchable post types
		$in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );
		// The post type you're removing, in this example 'kc-section'
		$post_type_to_remove = 'kc-section';
		// Make sure you got the proper results, and that your post type is in the results
		if ( is_array( $in_search_post_types ) && in_array( $post_type_to_remove, $in_search_post_types ) ) {
			// Remove the post type from the array
			unset( $in_search_post_types[ $post_type_to_remove ] );
			// set the query to the remaining searchable post types
			$query->set( 'post_type', $in_search_post_types );
		}
	}
}





/**
 * Add metabox with page content for YOAST SEO Analysis
 */

function crumina_yoast_kc_compitablity() {

	$active = defined( 'WPSEO_VERSION' ) ? true : false;

	if ( true === $active ) {
		global $pagenow, $typenow;
		if ( empty( $typenow ) && ! empty( $_GET['post'] ) ) {
			$post    = get_post( $_GET['post'] );
			$typenow = $post->post_type;
		}
		if ( ( $pagenow == 'post.php' && $typenow == 'page' ) || ( $pagenow == 'post-new.php' && $typenow == 'page' ) ) {
			wp_enqueue_script( 'crum-yoast-seo', get_template_directory_uri() . '/js/king-yoast.js', array( 'jquery' ), '1', true );
		}
	}
}

add_action( 'admin_enqueue_scripts', 'crumina_yoast_kc_compitablity' );

function crumina_add_yoast_meta_box() {
	$active = false;
	if ( function_exists( 'wpseo_auto_load' ) ) {
		$active = true;
	} elseif ( defined( 'WPSEO_VERSION' ) ) {
		$active = true;
	}

	if ( true === $active ) {
		add_meta_box(
			'utouch-yoast-metabox',
			'Yoast analize content',
			'crumina_render_yoast_meta_box_content',
			'page',
			'advanced',
			'low'
		);
	}
}

add_action( 'add_meta_boxes', 'crumina_add_yoast_meta_box' );

/**
 * Render Meta Box content
 */
function crumina_render_yoast_meta_box_content( $post ) {
	global $allowedposttags;
	$content = get_post_field( 'post_content', $post->ID );
	$content           = preg_replace( "/<style.+<\/style>/", "", $content );
	$content           = preg_replace( "/<script.+<\/script>/", "", $content );
	$content           = preg_replace( "/<svg\\b[^>]*>(.*?)<\\/svg>/s", "", $content );
	$content           = preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $content);
	$content           = preg_replace('/\<[\/]{0,1}section[^\>]*\>/i', '', $content);
	$content           = preg_replace('/\<[\/]{0,1}header[^\>]*\>/i', '', $content);
	$content           = apply_filters( 'the_content', $content );
	$content           = wp_kses( $content, $allowedposttags );
	echo '<textarea id="crumina-yoast-text">' . $content . '</textarea>';

}




/**
 * add "btn reply" class to comment reply and edit links
 */
if ( ! function_exists( '_filter_utouch_edit_comment_link' ) ) {
	function _filter_utouch_edit_reply_comment_link( $link ) {

		$link = str_replace( 'comment-reply-link', 'comment-reply-link btn reply', $link );
		$link = str_replace( 'comment-edit-link', 'comment-edit-link btn reply', $link );
		$link = str_replace( 'respond', 'leave-reply', $link );

		return $link;
	}

	add_filter( 'edit_comment_link', '_filter_utouch_edit_reply_comment_link', 10, 1 );
	add_filter( 'comment_reply_link', '_filter_utouch_edit_reply_comment_link', 10, 1 );
}

/**
 * @return array
 */
function fw_my_user_options() {
	return array(
		'social-networks' => array(
			'type'            => 'addable-box',
			'label'           => esc_html__( 'Social networks', 'utouch' ),
			'value'           => array(
				array(
					'link' => 'https://www.facebook.com/',
					'icon' => 'facebook.svg',
				),
				array(
					'link' => 'https://www.youtube.com/',
					'icon' => 'youtube.svg',
                    ),
				array(
					'link' => 'https://twitter.com',
					'icon' => 'twitter.svg',
				),
				array(
					'link' => 'https://vk.com/',
					'icon' => 'vk.svg',
				),

			),
			'box-options'     => array(
				'link' => array(
					'label' => esc_html__( 'Link to social network page', 'utouch' ),
					'type'  => 'text',
				),
				'icon' => array(
					'label'   => esc_html__( 'Icon', 'utouch' ),
					'type'    => 'select',
					'value'   => 'phone',
					'choices' => utouch_social_network_icons()
				),
			),
			'template'        => 'Icon - {{- icon }}', // box title
			'limit'           => 0,
			'add-button-text' => esc_html__( 'Add icon', 'utouch' ),
			'desc'            => esc_html__( 'Icons of social networks with links to profile', 'utouch' ),
			'sortable'        => true,
		),
		'profession'      => array(
			'type'  => 'text',
			'value' => '',
			'label' => esc_html__( 'Profession', 'utouch' ),
			'desc'  => esc_html__( 'You profession used to show in stunning header , etc.', 'utouch' ),
		)
	);
}

/**
 * Add new fields above 'Update' button.
 *
 * @param WP_User $user User object.
 */
function _action_fw_additional_profile_fields( $user ) {
	if ( ! defined( 'FW' ) ) {
		return;
	}
	$data = (array) get_the_author_meta( 'utouch_social_networks', $user->ID );

	echo fw()->backend->render_options( fw_my_user_options(), $data );
}

add_action( 'show_user_profile', '_action_fw_additional_profile_fields' );
add_action( 'edit_user_profile', '_action_fw_additional_profile_fields' );


/**
 * Save profile fields.
 *
 * @param int $user_id
 *
 * @return  bool
 */
function _action_fw_save_profile_fields( $user_id ) {
	if ( ! defined( 'FW' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	return update_user_meta( $user_id, 'utouch_social_networks', fw_get_options_values_from_input( fw_my_user_options() ) );
}

add_action( 'personal_options_update', '_action_fw_save_profile_fields' );
add_action( 'edit_user_profile_update', '_action_fw_save_profile_fields' );


function utouch_gallery_style( $html ) {

	return str_replace( 'class=\'', 'class=\'gallery-popup ', $html );
}

add_filter( 'gallery_style', 'utouch_gallery_style' );


function utouch_filter_my_custom_breadcrumbs_items( $items ) {
	if ( 'front_page' === $items[0]['type'] && null === Utouch::get_var( 'breadcrumbs_show_homepage' ) ) {
		$items = array_slice( $items, 1 );
	}

	return $items;
}

add_filter( 'fw_ext_breadcrumbs_build', 'utouch_filter_my_custom_breadcrumbs_items' );



add_action( 'init', 'utouch_ck_init', 99 );

function utouch_ck_init() {
	global $kc;
	if ( ! is_null( $kc ) ) {
		$kc->add_content_type( 'fw-event' );
		$kc->add_content_type( 'fw-portfolio' );
	}
}


function utouch_the_title( $title, $post_id ) {

	$post_type = get_post_type( $post_id );
	if ( 'fw-portfolio' === $post_type ) {
		$summary_title = Utouch::options()->get_option( 'project-title', '', Utouch_Options::SOURCE_POST, array( 'post_id' => $post_id ) );
		if ( ! empty( $summary_title ) ) {
			$title = $summary_title;
		}
	}

	return $title;
}

add_filter( 'the_title', 'utouch_the_title', 10, 2 );


function utouch_post_class( $classes, $class, $post_id ) {
	// sticky for Sticky Posts
	if ( is_sticky( $post_id ) ) {
		if ( ! is_paged() ) {
			$classes[] = 'sticky';
		}
	}

	return $classes;
}

add_filter( 'post_class', 'utouch_post_class', 10, 3 );


function _filter_theme_fw_ext_events_custom_options() {
	return array();
}

add_filter( 'fw_ext_events_post_options', '_filter_theme_fw_ext_events_custom_options' );

/** @internal */
function _filter_theme_fw_ext_events_custom_events_post_slug( $slug ) {
	return 'event';
}

add_filter( 'fw_ext_events_post_slug', '_filter_theme_fw_ext_events_custom_events_post_slug' );

/** @internal */
function _filter_theme_fw_ext_events_custom_events_taxonomy_slug( $slug ) {
	return 'events';
}

add_filter( 'fw_ext_events_taxonomy_slug', '_filter_theme_fw_ext_events_custom_events_taxonomy_slug' );

function utouch_widget_nav_menu_args( $args ) {
	$args['utouch_footer_widget'] = true;
	$args['menu_class']           = 'menu list list--primary';

	return $args;
}

add_filter( 'widget_nav_menu_args', 'utouch_widget_nav_menu_args' );


function utouch_wp_nav_menu( $html, $args ) {
	if ( ! array_key_exists( 'utouch_footer_widget', $args ) ) {
		return $html;
	}
	$html = str_replace( '</li>', '<svg class="utouch-icon utouch-icon-arrow-right"><use xlink:href="#utouch-icon-arrow-right"></use></svg></li>', $html );

	return $html;
}

add_filter( 'wp_nav_menu', 'utouch_wp_nav_menu', 10, 2 );

function utouch_register_post_type_args( $args, $name ) {
	if ( 'fw-event' === $name ) {
		$args['show_in_nav_menus'] = true;
	}

	return $args;
}

add_filter( 'register_post_type_args', 'utouch_register_post_type_args', 10, 2 );

/**
 *  Demo install config
 *
 * @param FW_Ext_Backups_Demo[] $demos
 *
 * @return FW_Ext_Backups_Demo[]
 */
function _filter_utouch_fw_ext_backups_demos( $demos ) {
	$demos_array = array(
		'utouch-main' => array(
			'title'        => esc_html__( 'Main demo', 'utouch' ),
			'screenshot'   => get_template_directory_uri() . '/images/main-demo.png',
			'preview_link' => 'https://utouch.crumina.net/',
		),
		// ...
	);

	$download_url = 'http://up.crumina.net/demo-data/utouch/upload.php';

	foreach ( $demos_array as $id => $data ) {
		$demo = new FW_Ext_Backups_Demo( $id, 'piecemeal', array(
			'url'     => $download_url,
			'file_id' => $id,
		) );
		$demo->set_title( $data['title'] );
		$demo->set_screenshot( $data['screenshot'] );
		$demo->set_preview_link( $data['preview_link'] );

		$demos[ $demo->get_id() ] = $demo;

		unset( $demo );
	}

	return $demos;
}

add_filter( 'fw:ext:backups-demo:demos', '_filter_utouch_fw_ext_backups_demos' );


add_action( 'fw:ext:backups-demo:add-install-tasks', 'utouch_after_backup_action', 10, 1 );
function utouch_after_backup_action() {

	if ( false === get_user_by( 'email', 'utouch_simpson@crumina.net' ) ) {
		$user_id = wp_create_user( 'Britney Simpson', hash( 'hash512', rand() ), 'utouch_simpson@crumina.net' );
		if ( is_int( $user_id ) ) {
			update_user_meta( $user_id, 'utouch_social_networks', array(
				'social-networks' => array(
					array(
						'link' => 'https://www.facebook.com/',
						'icon' => 'facebook.svg',
					),
					array(
						'link' => 'https://www.youtube.com/',
						'icon' => 'youtube.svg',
					)
				),
				'profession'      => 'manager',
			) );
			update_user_meta($user_id,'description','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.');
		}
	}
	if ( false === get_user_by( 'email', 'utouch_bush@crumina.net' ) ) {
		$user_id = wp_create_user( 'Christian Bush', hash( 'hash512', rand() ), 'utouch_bush@crumina.net' );
		if ( is_int( $user_id ) ) {
			update_user_meta( $user_id, 'utouch_social_networks', array(
				'social-networks' => array(
					array(
						'link' => 'https://www.facebook.com/',
						'icon' => 'facebook.svg',
					),
					array(
						'link' => 'https://www.youtube.com/',
						'icon' => 'youtube.svg',
					)

				),
				'profession'      => 'js developer',
			) );
			update_user_meta($user_id,'description','Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius quam nunc putamus claram, anteposuerit.');

		}
	}
	if ( false === get_user_by( 'email', 'utouch_nguyen@crumina.net' ) ) {
		$user_id = wp_create_user( 'Jane Nguyen', hash( 'hash512', rand() ), 'utouch_nguyen@crumina.net' );
		if ( is_int( $user_id ) ) {
			update_user_meta( $user_id, 'utouch_social_networks', array(
				'social-networks' => array(
					array(
						'link' => 'https://www.facebook.com/',
						'icon' => 'facebook.svg',
					),
					array(
						'link' => 'https://www.youtube.com/',
						'icon' => 'youtube.svg',
					)

				),
				'profession'      => 'copyright',
			) );
			update_user_meta($user_id,'description','Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima odem modo typi, qui nunc nobis.');

		}
	}
	if ( false === get_user_by( 'email', 'utouch_miller@crumina.net' ) ) {
		$user_id = wp_create_user( 'Jonathan Miller', hash( 'hash512', rand() ), 'utouch_miller@crumina.net' );
		if ( is_int( $user_id ) ) {
			update_user_meta( $user_id, 'utouch_social_networks', array(
				'social-networks' => array(
					array(
						'link' => 'https://www.facebook.com/',
						'icon' => 'facebook.svg',
					),
					array(
						'link' => 'https://www.youtube.com/',
						'icon' => 'youtube.svg',
					)

				),
				'profession'      => 'web developer',
			) );
			update_user_meta($user_id,'description','Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima odem modo typi, qui nunc nobis.');

		}
	}
}

/**
 * Extension update message
 */
add_action( 'admin_notices', 'utouch_update_checker_message' );

function utouch_update_checker_message() {

	if ( !function_exists( 'fw' ) ) {
		return;
	}

	$update_checker = fw()->extensions->get( 'update-checker' );
	if ( !$update_checker ) {
		return;
	}

	if ( !version_compare( $update_checker->manifest->get_version(), '2.0.0', '<' ) ) {
		return;
	}

	$class   = 'notice notice-error';
	$message = __( sprintf( 'Please, delete and reinstall Unison Update checker to get automatic theme updates. <a href="%1$s" class="button button-primary" target="_blank">%2$s</a>', 'https://support.crumina.net/help-center/articles/252/theme-is-not-activated', esc_html__('View instruction','utouch') ), 'utouch' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
}

/**
 * Get ajax portfolio posts
 */
add_action( 'wp_ajax_utouch_ajax_portfolio_get_posts', 'utouch_ajax_portfolio_get_posts' );
add_action( 'wp_ajax_nopriv_utouch_ajax_portfolio_get_posts', 'utouch_ajax_portfolio_get_posts' );

function utouch_ajax_portfolio_get_posts() {
    check_admin_referer( '_utouch_ajax_portfolio', 'nonce' );

    $post_ID = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );

    if ( !$post_ID ) {
        wp_send_json_error( array(
            'message' => 'Post ID is missing'
        ) );
    }

    $category = filter_input( INPUT_POST, 'category', FILTER_VALIDATE_INT );

    if ( !is_numeric( $category ) ) {
        wp_send_json_error( array(
            'message' => 'Category ID is missing'
        ) );
    }

    $page       = filter_input( INPUT_POST, 'page', FILTER_VALIDATE_INT );
    $loop_data  = json_decode( urldecode( filter_input( INPUT_POST, 'data' ) ) );
    $pagination = filter_input( INPUT_POST, 'pagination', FILTER_SANITIZE_STRING );
    $read_more = filter_input( INPUT_POST, 'read_more', FILTER_SANITIZE_STRING );
    $items_design = filter_input( INPUT_POST, 'items_design', FILTER_SANITIZE_STRING );

    $the_query = utouch_custom_loop( 'fw-portfolio', $post_ID, $category, $page );
    
    set_query_var( 'portfolio-ajax-query', $the_query );
    set_query_var( 'fw_portfolio_loop_data', $loop_data );
    set_query_var( 'read-more-text', $read_more );

    ob_start();

    while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
                    <div class="<?php echo esc_attr( $loop_data->grid_item_classes ); ?>">
	                    <?php  get_template_part( 'parts/portfolio/loop_item', $loop_data->items_design );  ?>
                    </div>
        <?php
        wp_reset_postdata();
    endwhile;

    $grid = ob_get_clean();

    ob_start();
    switch ( $pagination ) {
        case 'loadmore':
            get_template_part( 'parts/paginate/loadmore' );
            break;
        case 'numbers':
            get_template_part( 'parts/paginate/numbers' );
            break;
        case 'prev_next':
            get_template_part( 'parts/paginate/prev-next' );
            break;
    }
    $nav = ob_get_clean();

    wp_send_json_success( array(
        'grid' => $grid,
        'nav'  => $nav,
    ) );
}

/**
 * Hook for events sorting by date
 */
add_action( 'init', 'utouch_all_events_date_update' );
add_action( 'save_post', 'utouch_event_on_update', 10, 3 );

function utouch_event_on_update( $event_id, $event, $update ) {
	if ( wp_is_post_revision( $event_id ) || $event->post_type !== 'fw-event' || !function_exists( 'fw_get_db_post_option' ) ) {
		return;
	}

	$date = fw_akg( '0/schedule_date_range/from', fw_get_db_post_option( $event_id, 'schedule_group', array() ), false );

	if ( !$date ) {
		return;
	}

	update_post_meta( $event_id, 'crum_event_date_from', strtotime( $date ) );
}

function utouch_all_events_date_update() {
	$updated = get_option( 'crum_event_date_from_set' );

	if ( $updated ) {
		return;
	}

	$events = get_posts( array(
		'numberposts' => -1,
		'post_type'   => 'fw-event',
	) );

	foreach ( $events as $event ) {
		utouch_event_on_update( $event->ID, $event, false );
	}

	add_option( 'crum_event_date_from_set', 1 );
}

/**
 * Hooks for reach bio
 */
add_action( 'show_user_profile', 'utouch_bio_visual_editor' );
add_action( 'edit_user_profile', 'utouch_bio_visual_editor' );

function utouch_bio_visual_editor( $user ) {
	?>
    <table class="form-table">
        <tr>
            <th><label for="description"><?php _e( 'Biographical Info' ); ?></label></th>
            <td>
				<?php
				$description = get_user_meta( $user->ID, 'description', true );
				wp_editor( $description, 'description' );
				?>
                <p class="description"><?php _e( 'Share a little biographical information to fill out your profile. This may be shown publicly.' ); ?></p>
            </td>
        </tr>
    </table>
	<?php
}

// Don't sanitize the data for display in a textarea
add_action( 'admin_init', 'utouch_bio_vsave_filters' );

function utouch_bio_vsave_filters() {
	if ( !current_user_can( 'edit_posts' ) ) {
		return;
	}

	remove_all_filters( 'pre_user_description' );
}

// Add content filters to the output of the description
add_filter( 'get_the_author_description', 'wptexturize' );
add_filter( 'get_the_author_description', 'convert_chars' );
add_filter( 'get_the_author_description', 'wpautop' );


/**
 * Hook for events categories column and filter
 */
add_filter( 'manage_fw-event_posts_columns', 'utouch_events_columns', 20, 1 );

function utouch_events_columns( $columns ) {
	return array_merge( $columns, array(
		'taxonomy-fw-event-taxonomy-name' => esc_html__( 'Categories', 'utouch' )
	) );
}

add_action( 'restrict_manage_posts', 'utouch_filter_post_type_by_taxonomy' );

function utouch_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'fw-event';
	$taxonomy  = 'fw-event-taxonomy-name';
	if ( $typenow == $post_type ) {
		$selected      = isset( $_GET[ $taxonomy ] ) ? $_GET[ $taxonomy ] : '';
		$info_taxonomy = get_taxonomy( $taxonomy );
		wp_dropdown_categories( array(
			'show_option_all' => esc_html__( 'All', 'utouch' ) . ' ' . $info_taxonomy->label,
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		) );
	};
}

add_filter( 'parse_query', 'utouch_convert_id_to_term_in_query' );

function utouch_convert_id_to_term_in_query( $query ) {
	global $pagenow;
	$post_type = 'fw-event';
	$taxonomy  = 'fw-event-taxonomy-name';
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset( $q_vars[ 'post_type' ] ) && $q_vars[ 'post_type' ] == $post_type && isset( $q_vars[ $taxonomy ] ) && is_numeric( $q_vars[ $taxonomy ] ) && $q_vars[ $taxonomy ] != 0 ) {
		$term                = get_term_by( 'id', $q_vars[ $taxonomy ], $taxonomy );
		$q_vars[ $taxonomy ] = $term->slug;
	}
}
