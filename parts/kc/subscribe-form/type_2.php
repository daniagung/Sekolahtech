<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'crum_subscribe_form' );
extract( $atts );
$module_class   = utouch_module_class( 'crumina-module-subscribe-form', $atts );
$module_class[] = 'subscribe-form';

global $es_includes;
if ( ! isset( $es_includes ) || $es_includes !== true ) {
	$es_includes = true;
}

$image_url = wp_get_attachment_image_url( $image, 'full' );
?>
<div id="subscribe-section" class="<?php echo implode( ' ', $module_class ) ?>">
    <div class="subscribe-form">
        <div class="subscribe-main-content">
			<?php if ( $image_url ) { ?>
                <img class="subscribe-img" src="<?php echo esc_url( $image_url ) ?>" alt="image">
			<?php } ?>
            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                <div class="crumina-module crumina-heading">
                    <h2 class="heading-title"><?php echo esc_html( $title ) ?></h2>
                    <p class="heading-text"><?php echo esc_html( $desc ) ?></p>
                </div>
				<?php
				if ( ! empty( $shortcode ) ) {
					?>
                    <div class="mc4wp-custom-subscribe-form">
						<?php echo do_shortcode( $shortcode ); ?>
                    </div>
					<?php
				} else if ( function_exists( 'es_subbox' ) ) { ?>
                    <form class="form-inline es_shortcode_form"  data-es_form_id="es_shortcode_form">

                        <input type="email" id="es_txt_email_pg" class="es_textbox_class" name="es_txt_email_pg"
                               maxlength="40">

                        <button type="submit" class="btn btn--green  subscr-btn es_submit_button" id="es_txt_button_pg"
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

        </div>
        <div class="subscribe-layer"></div>
    </div>

</div>