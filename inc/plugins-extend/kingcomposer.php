<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

// Verify KingKomposer Extended license.
define('KC_LICENSE', 'g62osph1-kqfg-o8qb-y7v2-89gm-5tx7ky6un2sh');

/*
* KingComposer editor additional hooks and actions.
*/
add_action( 'init', 'utouch_kingkomposer_modifications', 999 );




// Plain HTML field for composer admin panel.
function kc_utouch_html_field() {
	echo '<div id="{{data.name}}" class="kc-param">{{{data.value}}}</div>';
}

// Number field for composer admin panel.
function kc_utouch_number_field() {
	echo '<input name="{{data.name}}" class="kc-param" value="{{data.value}}" type="number" min="1" />';
}

// Proper date field for composer admin panel.
function kc_utouch_date_field() { ?>
	<input name="{{data.name}}" class="kc-param" value="{{data.value}}" type="text"/>
	<#
			data.callback = function( wrp, $ ){
			var d = new Pikaday(
			{
			field: wrp.find('.kc-param').get(0),
			firstDay: 1,
			formatStrict:true,
			format: 'L',
			minDate: false,
			maxDate: false,
			yearRange: [2000,2020],
			});
			}
			#>
	<?php
}
function kc_utouch_type_event_taxonomy(){

	$post_types = get_post_types( array(
		'public'   => true,
		'_builtin' => false
	),
		'names'
	);

	$post_types = array_merge( array( 'post' => 'post'), $post_types );

	foreach($post_types as $post_type){
		$taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
		$taxonomy = key( $taxonomy_objects );
		$args[ $post_type ] = kc_get_terms( $taxonomy, 'slug' );
	}

	echo '<select class="kc-content-type">';
	foreach( $args as $k => $v ){
		echo '<option value="'.esc_attr($k).'">'.ucwords( str_replace(array('-','_'), array(' ', ' '), $k ) ).'</option>';
	}
	echo '</select>';
	echo '<div class="kc-select-wrp">';
	echo '<select style="height: 150px" multiple class="kc-taxonomies-select">';

	foreach( $args as $type => $arg ){

		echo '<option class="'.esc_attr($type).'-st" value="'.esc_attr($type).'" style="display:none;">'.esc_html($type).'</option>';

		foreach( $arg as $k => $v ){

			$k = $type.':'.str_replace( ':', '&#58;', $k );

			echo '<option class="'.esc_attr($type).' '.esc_attr($k).'" value="'.esc_attr($k).'" style="display:none;">'.esc_html($v).'</option>';

		}
	}

	echo '</select>';
	echo '<button class="button unselected" style="margin-top: 10px;">Remove selection</button>';
	echo '</div>';

	?>
    <# data.callback = kc.ui.callbacks.taxonomy; #>
	<?php
}



// Theme modifcations and new modules
function utouch_kingkomposer_modifications() {
	global $kc;

    // Change kingcomposer modules path
	if ( $kc && is_child_theme() ) {
		$kc->set_template_path(get_stylesheet_directory().KDS.'kingcomposer'.KDS);
	}
	//add new parameters for composer
	$kc->add_param_type( 'html-full', 'kc_utouch_html_field' );
	$kc->add_param_type( 'crum-number', 'kc_utouch_number_field' );
	$kc->add_param_type( 'crum_date_picker', 'kc_utouch_date_field' );
	$kc->add_param_type( 'event_taxonomy', 'kc_utouch_type_event_taxonomy' );

	// Add custom icon pack.
	if ( function_exists( 'kc_add_icon' ) ) {
		kc_add_icon( get_template_directory_uri() . '/css/crumina-icons.css' );
	}

	$live_tmpl   = get_template_directory() . '/kingcomposer/live_editor/';
	$images_path = get_template_directory_uri() . '/images/admin/';

	/* Row options modifications */
	$kc->remove_map_param( 'kc_row', 'animate', 'animate' );

	$kc->update_map(
		'kc_row',
		'live_editor',
		$live_tmpl . 'crum_row.tpl'
	);
	$kc->add_map_param(
		'kc_row',
		array(
			'name' => 'row_content_bottom',
			'label' => 'Row content bottom',
			'type' => 'toggle',  // USAGE RADIO TYPE
			'description' => 'Place content at bottom',
		),
		4,
		'general'
	);
	$kc->add_map_param(
		'kc_row',
		array(
			'name'  => 'row_style',
			'label' => 'Row appearance',

			'type'    => 'radio',  // USAGE RADIO TYPE
			'options' => array(    // REQUIRED
				'classic' => esc_html__( 'Classic', 'utouch' ),
				'skew'    => esc_html__( 'Skew', 'utouch' ),
				'curved'  => esc_html__( 'Curved', 'utouch' ),
			),

			'value' => 'classic', // remove this if you do not need a default content
		),
		1,
		'styling'
	);
	$kc->add_map_param(
		'kc_row',
		array(
			'name'  => 'curve_style',
			'label' => 'Curve style',

			'type'    => 'radio',  // USAGE RADIO TYPE
			'options' => array(    // REQUIRED
				'style1' => esc_html__( 'Style 1', 'utouch' ),
				'style2' => esc_html__( 'Style 2', 'utouch' ),
				'style3' => esc_html__( 'Style 3', 'utouch' ),
				'style4' => esc_html__( 'Style 4', 'utouch' ),
			),
			'value' => 'style1',

			'relation' => array(
				'parent'    => 'row_style',
				'show_when' => 'curved',
			),
		),
		2,
		'styling'
	);

	$kc->add_map_param(
		'kc_row',
		array(
			'name'  => 'hide_decor_part',
			'label' => 'Hide row decor part',

			'type'    => 'radio',  // USAGE RADIO TYPE
			'options' => array(    // REQUIRED
				'top' => esc_html__( 'Top part', 'utouch' ),
				'bottom' => esc_html__( 'Bottom part', 'utouch' ),
			),


			'relation' => array(
				'parent'    => 'row_style',
				'hide_when' => 'classic',
			),
		),
		3,
		'styling'
	);

	$kc->add_map_param(
		'kc_row',
		array(
			'name'        => 'row_text_color',
			'label'       => esc_html__( 'Text color', 'utouch' ),
			'type'        => 'color_picker',
			'description' => esc_html__( 'Primary color option for inner text. Can be changed in any inner module.', 'utouch' )
		), 4, 'styling'
	);


	// Remove some default modules.
	if ( function_exists( 'kc_remove_map' ) ) {
		kc_remove_map( 'kc_nested' );
		kc_remove_map( 'kc_box' );
		kc_remove_map( 'kc_coundown_timer' );
		kc_remove_map( 'kc_divider' );
		kc_remove_map( 'kc_pricing' );
		kc_remove_map( 'kc_image_hover_effects' );
		kc_remove_map( 'kc_creative_button' );
		kc_remove_map( 'kc_tooltip' );
        //kc_remove_map( 'kc_blog_posts' );
        kc_remove_map( 'kc_post_type_list' );
		kc_remove_map( 'kc_creative_button' );
		kc_remove_map( 'kc_flip_box' );
		kc_remove_map( 'kc_progress_bars' );
		kc_remove_map( 'kc_pie_chart' );
		kc_remove_map( 'kc_button' );
		kc_remove_map( 'kc_title' );
		kc_remove_map( 'kc_accordion' );
		kc_remove_map( 'kc_team' );
		kc_remove_map( 'kc_single_image' );
		kc_remove_map( 'kc_dropcaps' );
		kc_remove_map( 'kc_google_maps' );
		kc_remove_map( 'kc_video_play' );
		kc_remove_map( 'kc_counter_box' );
		kc_remove_map( 'kc_icon' );
		kc_remove_map( 'kc_feature_box' );
		kc_remove_map( 'kc_testimonial' );
		kc_remove_map( 'kc_call_to_action' );
		kc_remove_map( 'kc_carousel_post' );
		kc_remove_map( 'kc_contact_form7' );

		kc_remove_map( 'kc_image_gallery' );
		kc_remove_map( 'kc_image_fadein' );
		kc_remove_map( 'kc_carousel_images' );
	}

	// Small text shortcodes. Without dedicated blocks.
	if ( function_exists( 'kc_add_map' ) ) {
		kc_add_map(
			array(
				'tip' => array(
					'name'        => 'Tooltip',
					'system_only' => true,
					'assets'      =>
						array(
							'styles'  =>
								array(
									'tippy-css' => get_template_directory_uri() . '/css/tippy.css',
								),
							'scripts' =>
								array(
									'tippy-js' => get_template_directory_uri() . '/js/tippy.min.js',
								),
						),
					'params'      => array(
						'general' => array(
							array(
								'name'  => 'text',
								'label' => esc_html__( 'Text', 'utouch' ),
								'type'  => 'text',
							),
						),
					)
				),
			)
		);
	}

	$modules_path = get_template_directory() . '/inc/modules/';

	$crum_modules = array(
		'crum_image_gallery.php',
		'crum_testimonial_slider.php',
		'crum_image_grid.php',
		'crum_info_list.php',
		'crum_colored_info.php',
		'crum_clients_slider.php',
		'crum_info_box_slider.php',
		'crum_single_image.php',
		'crum_triple_image.php',
		'crum_image_slider.php',
		'crum_video_slider.php',
		'crum_info_list_slider.php',
		'crum_accordion.php',
		'crum_maps.php',
		'crum_call_to_action.php',
		'crum_clients.php',
		'crum_zoom_image.php',
		'crum_contact.php',
		'crum_testimonial.php',
		'crum_info_group.php',
		'crum_pricing_table.php',
		'crum_icon.php',
		'crum_counter.php',
		'crum_ul_style.php',
		'crum_breadcrumbs.php',
		'crum_chartjs.php',
		'crum_double_image.php',
		'crum_portfolio_slider.php',
		'crum_team.php',
		'crum_dropcaps.php',
		'crum_info_box.php',
		'crum_pie_chart.php',
		'crum_video.php',
		'crum_button.php',
		'crum_subscribe_form.php',
		'crum_title.php',
		'crum_team_slider.php',
		'crum_horizontal_slider.php',
		'crum_vertical_slider.php',
		'crum_team_slider_tab.php',
		'crum_contacts.php',
		'crum_event_summary.php',
		'crum_event_list.php',
		'crum_progress_bars.php',
		'crum_post_type_list.php',
		'crum_woocommerce.php',
	);

	foreach ( $crum_modules as $crum_module ) {
		load_template( $modules_path . $crum_module, true );
	}
}