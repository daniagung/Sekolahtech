<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'crum_subscribe_form' );
extract( $atts );
$module_class = utouch_module_class( 'crumina-module-subscribe-form', $atts );

global $es_includes;
if ( ! isset( $es_includes ) || $es_includes !== true ) {
	$es_includes = true;
}
?>
<div id="subscribe-section" class="<?php echo implode( ' ', $module_class ) ?>">
	<?php
	if ( ! empty( $shortcode ) && $use_shortcode === 'yes' ) {
		?>
        <div class="mc4wp-custom-subscribe-form">
			<?php echo do_shortcode( $shortcode ); ?>
        </div>
		<?php
	} else if ( function_exists( 'es_subbox' ) ) { ?>
        <form class="contact-form form-subscribe with-name subscribe-form"  data-es_form_id="es_shortcode_form">

            <input type="text" name="es_txt_name_pg" id="es_txt_name_pg"
                   placeholder="<?php echo esc_html( $name_placeholder ) ?>"
                   maxlength="225">
            <input type="email" id="es_txt_email_pg" class="es_textbox_class" name="es_txt_email_pg" maxlength="40">

            <button type="submit" class="btn btn--primary btn--with-shadow full-width subscr-btn" id="es_txt_button_pg"
                    name="es_txt_button_pg"><?php echo esc_html( $btn_label ) ?></button>


			<?php
			wp_nonce_field( 'es-subscribe', 'es-subscribe', true, true );
			?>
            <input name="es_txt_group_pg" id="es_txt_group_pg" value="" type="hidden">
            <input type="hidden" id="es_txt_name_pg" name="es_txt_name_pg" value="">

            <div style="clear: both" class="es_msg" id="es_shortcode_msg"><span id="es_msg_pg"></span></div>
        </form>
	<?php } ?>

</div>