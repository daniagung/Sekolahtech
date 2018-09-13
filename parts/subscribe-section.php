<?php if ( ! defined( 'FW' ) ) {
	return;
}
/**
 * Template part for displaying Subscribe panel before footer.
 *
 * You free to customize widget contents in child theme.
 * Copy that file into 'parts' folder of your Child Theme.
 *
 * @package Utouch
 */
wp_enqueue_script( 'scrollmagic-velocity' );

global $allowedtags;
$enable_customization = fw_get_db_post_option( get_the_ID(), 'custom-subscribe/enable', 'no' );
$show_section         = fw_get_db_post_option( get_the_ID(), 'custom-subscribe/yes/subscribe-show/value', 'yes' );

if ( $show_section === 'no' ) {
	return;
}

$section_options = fw_get_db_customizer_option( 'section-subscribe-form', array() );
$animated_bg     = fw_get_db_customizer_option( 'subscribe_animated', false );
$section_bg      = fw_get_db_customizer_option( 'subscribe_bg_color', '' );
$section_color   = fw_get_db_customizer_option( 'subscribe_text_color', '' );
if ( 'yes' === $enable_customization ) {
	$panel_options   = fw_get_db_post_option( get_the_ID(), 'custom-subscribe/yes/subscribe-show', array() );
	$section_options = utouch_akg( 'yes/section-subscribe-form', $panel_options, array() );
	$animated_bg     = utouch_akg( 'yes/subscribe_animated', $panel_options, false );
}

$title            = utouch_akg( 'title', $section_options, '' );
$text             = utouch_akg( 'desc', $section_options, '' );
$custom_form      = utouch_akg( 'custom-form/value', $section_options, 'no' );
$custom_form_html = utouch_akg( 'custom-form/yes/html', $section_options, '' );
$name_field       = utouch_akg( 'custom-form/no/name_field', $section_options, false );

$section_class = 'subscribe-section';
if ( ! empty( $section_color ) ) {
	$section_class .= ' font-color-custom';
}
$subsscribe_class  = ( true === $name_field ) ? 'form-subscribe with-name subscribe-form es_shortcode_form' : 'form-subscribe subscribe-form es_shortcode_form';
$email_placeholder = ( true === $name_field ) ? __( 'Email', 'utouch' ) : __( 'Your Email Address', 'utouch' );

$section_class .= true === $animated_bg ? ' js-animated' : '';
?>
<!-- Subscribe Form -->
<section id="subscribe-section" class="<?php echo esc_attr( $section_class ) ?>">
	<div class="subscribe container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-5 col-md-12 col-md-offset-0 col-sm-12 col-xs-12">
				<?php if ( ! empty( $title ) ) {
					echo '<h4 class="subscribe-title">' . esc_html( $title ) . '</h4>';
				}
				if ( 'yes' === $custom_form && ! empty( $custom_form_html ) ) {
					echo( do_shortcode( $custom_form_html ) );
				} elseif ( function_exists( 'es_subbox' ) ) {
					?>
					<form class="<?php echo esc_attr( $subsscribe_class ) ?>" action="#subscribe-section">
						<div class="es_msg"><span id="es_msg_pg"></span></div>
						<input class="email input-standard-grey input-white" name="es_txt_email_pg" id="es_txt_email_pg"
							   maxlength="225" required="required"
							   placeholder="<?php echo esc_html( $email_placeholder ) ?>" type="email">
						<?php if ( true === $name_field ) { ?>
							<input type="text" id="es_txt_name" class="name input-standard-grey input-white"
								   name="es_txt_name"
								   placeholder="<?php esc_html_e( 'Name', 'utouch' ); ?>"
								   maxlength="225">
						<?php } ?>
						<button class="subscr-btn" name="es_txt_button_pg" id="es_txt_button_pg"
								onclick="return es_submit_pages(<?php echo esc_url( "'" . home_url() . "'" ) ?>)"><?php esc_html_e( 'Subscribe', 'utouch' ) ?>
					    </button>
						<input name="es_txt_name_pg" id="es_txt_name_pg" value="" type="hidden">
						<input name="es_txt_group_pg" id="es_txt_group_pg" value="" type="hidden">
					</form>
				<?php }
				if ( ! empty( $text ) ) {
					echo '<div class="sub-title">' . wp_kses( $text, $allowedtags ) . '</div>';
				} ?>
			</div>
			<?php if ( true === $animated_bg ) { ?>
				<div class="images-block">
					<img src="<?php echo get_template_directory_uri() ?>/images/animated/subscr-gear.png" alt="gear"
						 class="gear">
					<img src="<?php echo get_template_directory_uri() ?>/images/animated/subscr1.png" alt="subscr1"
						 class="mail">
					<img src="<?php echo get_template_directory_uri() ?>/images/animated/subscr-mailopen.png" alt="mailopen"
						 class="mail-2">
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<!-- End Subscribe Form -->