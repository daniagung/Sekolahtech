<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
$names = array();

function utouch_update_go_pricing_options() {
	$plugin_options                  = get_option( 'go_pricing_table_settings' );
	$plugin_options['public_assets'] = 'global';
	update_option( 'go_pricing_table_settings', $plugin_options );
	update_option( 'go_pricing_table_theme_compatible', 'yes' );
}

if ( 'yes' !== get_option( 'go_pricing_table_theme_compatible' ) ) {
	utouch_update_go_pricing_options();
}

if ( class_exists( 'GW_GoPricing_Data' ) ) {

	global $pagenow;

	if ( $pagenow != 'post.php' &&
	     $pagenow != 'post-new.php' &&
	     $pagenow != 'nav-menus.php' &&
	     ( $pagenow != 'admin-ajax.php' || $pagenow == 'admin-ajax.php' && isset( $_POST['action'] ) ) ) {
		return;
	}

	$pricing_tables = GW_GoPricing_Data::get_tables( '', false, 'title', 'ASC' );

	if ( ! empty( $pricing_tables ) ) {
		foreach ( $pricing_tables as $pricing_table ) {
			if ( ! empty( $pricing_table['name'] ) && ! empty( $pricing_table['id'] ) ) {
				$names[]                               = $pricing_table['name'];
				$name_count                            = array_count_values( $names );
				$dropdown_data[ $pricing_table['id'] ] = sprintf( '%1$s (#%2$s)', $pricing_table['name'], $pricing_table['postid'] );

			}
		}
	}
}

if ( empty( $dropdown_data ) ) {
	$dropdown_data[0] = __( 'No tables found!', 'utouch' );
}

// Small text shortcodes. Without dedicated blocks.
if ( function_exists( 'kc_add_map' ) ) {
	kc_add_map(
		array(
			'go_pricing' => array(
				'name'        => __( 'Go Pricing', 'utouch' ),
				'description' => __( 'Amazing responsive pricing tables', 'utouch' ),
				'icon'        => 'kc-crum-icon-go-pricing',
				'category'    => esc_html__( 'Content', 'utouch' ),
				'assets'      =>
					array(
						'styles' => 'go_pricing-styles',
					),
				'params'      => array(
					'general' => array(
						array(
							'name'        => 'id',
							'type'        => 'select',
							'label'       => esc_html__( 'Select Pricing Table', 'utouch' ),
							'options'     => $dropdown_data,
							'admin_label' => true
						),
						array(
							'name'        => 'wrap_class',
							'label'       => esc_html__( 'Extra class', 'utouch' ),
							'type'        => 'text',
							'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'utouch' ),
						),
					),
				)
			),  // End of elemnt kc_icon
		)
	);
}