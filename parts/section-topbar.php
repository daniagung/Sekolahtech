<?php
$data            = fw_get_db_customizer_option( 'sections-top-bar/show', array() );
$social_networks = utouch_akg( 'social-networks', $data, array() );
$soc_icons_style = utouch_akg( 'icons-style', $data, 'plain' );
$info_boxes      = utouch_akg( 'info-boxes', $data, array() );
$panel_icons     = array(
	'phone' => '<svg class="utouch-icon utouch-icon-telephone-keypad-with-ten-keys"><use xlink:href="#utouch-icon-telephone-keypad-with-ten-keys"></use></svg>',
	'mail'  => '<svg class="utouch-icon utouch-icon-letter"><use xlink:href="#utouch-icon-letter"></use></svg>'
);

$theme_style = utouch_akg( 'theme-style', $data, '' );

if ( is_singular() && function_exists( 'fw_get_db_post_option' ) ) {
	// Header options
	$enable_customization = fw_get_db_post_option( $page_id, 'custom-header/enable', 'no' );
	if ( 'yes' === $enable_customization ) {
		$custom_header_opt = fw_get_db_post_option( $page_id, 'custom-header/yes/sections-top-bar/show', array() );
		$theme_style = utouch_akg( 'theme-style', $custom_header_opt, '' );
		$soc_icons_style = utouch_akg( 'icons-style', $custom_header_opt, 'plain' );

	}
}

?>
<div class="top-bar <?php echo esc_attr( $theme_style ); ?>">
	<div class="container">
		<div class="top-bar-contact">
			<?php if ( ( utouch_akg( 'show-languages/status', $data ) == 'show' ) && ( utouch_akg( 'show-languages/show/language-select/status', $data ) == 'plugin-select' ) ) {
				echo do_shortcode( utouch_akg( 'show-languages/show/language-select/plugin-select/shortcode', $data ) );
			} elseif ( ( utouch_akg( 'show-languages/status', $data ) == 'show' )
			           && ( utouch_akg( 'show-languages/show/language-select/status', $data ) != 'plugin-select' )
			           && ( function_exists( 'icl_get_languages' ) )
			) {
				$data['top-bar-lang'] = icl_get_languages( 'skip_missing=0&orderby=code' );
				$active_languages     = ( isset( $data['top-bar-lang'] ) && ! empty( $data['top-bar-lang'] ) ) ? $data['top-bar-lang'] : array();
				$lang_img             = '';
				$active_lang_key      = '';
				$lang_options_str     = '';
				foreach ( $active_languages as $lang_key => $lang_conf ) {
					if ( $lang_conf['active'] ) {
						$lang_img        = $lang_conf['country_flag_url'];
						$active_lang_key = $lang_key;
					}
					$lang_options_str .= '<option data-url="' . $lang_conf['url'] . '" data-image="' . esc_url( $lang_conf['country_flag_url'] ) . '" 
					value="' . $lang_key . '"' . ( ( $lang_key == $active_lang_key ) ? 'selected="selected"' : '' ) . '>' . $lang_conf['native_name'] . '</option>';
				} ?>
				<div class="contact-item language-switcher">
					<svg class="utouch-icon world utouch-icon-world-map">
						<use xlink:href="#utouch-icon-world-map"></use>
					</svg>
					<select id="top-bar-language" class="nice-select">
						<?php echo ($lang_options_str); ?>
					</select>
				</div>
			<?php } ?>
			<?php if ( ! empty( $info_boxes ) ) {
				foreach ( $info_boxes as $infoField ) { ?>
					<div class="contact-item">
						<?php
						$field = $infoField['info'];

						/** @var array $panel_icons */
						$panel_icons = apply_filters( 'utouch_topbar_icons', $panel_icons );

						if ( utouch_is_phone( $field ) ) {
							echo utouch_akg( 'phone', $panel_icons, '' );
							echo '<a href="tel:' . $field . '">' . $field . '</a>';
						} elseif ( utouch_is_email( $field ) ) {
							echo utouch_akg( 'mail', $panel_icons, '' );
							echo '<a href="mailto:' . $field . '">' . $field . '</a>';
						} else {
							echo wp_kses( $field, wp_kses_allowed_html( $field ) );
						} ?>
					</div>
				<?php }
			} ?>
		</div>
		<?php if ( ! empty( $social_networks ) ) {
			?>

			<div class="follow_us">
				<span><?php esc_html_e( 'Follow us:', 'utouch' ); ?></span>
				<div class="socials">
					<?php foreach ( $social_networks as $social ) { ?>
						<a href="<?php echo esc_html( $social['link'] ); ?>" target="_blank"
						   class="social__item"><?php $svg_link = get_template_directory_uri() . '/svg/socials/' . $soc_icons_style . '/' . $social['icon'];
							echo utouch_get_svg_icon( $svg_link ); ?></a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>

		<a href="#" class="top-bar-close" id="top-bar-close-js">
			<svg class="utouch-icon utouch-icon-cancel-1">
				<use xlink:href="#utouch-icon-cancel-1"></use>
			</svg>
		</a>

	</div>
</div>
