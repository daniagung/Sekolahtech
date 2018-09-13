<?php
/**
 * Template part for displaying popup with contact form.
 *
 * @package Utouch
 */


$contact_email = Utouch::get_var( 'widget_contact_email' );
$contact_form  = Utouch::get_var( 'widget_contact_shortcode' );
$form_type = 'default';
$contact_title = esc_html__( 'Send a Message', 'utouch' );
$contact_description = '';
$contact_text_btn = esc_html__('Send a Message','utouch');
$contact_color_btn = 'green';
$contact_thanks = esc_html__('Message sent!','utouch');

if ( ! empty( $contact_form ) && function_exists( 'fw_set_db_customizer_option' ) ) {
	fw_set_db_customizer_option( 'contact_form/type', 'shortcode' );
}

if ( function_exists( 'fw_get_db_customizer_option' ) ) {
	$options   = fw_get_db_customizer_option( 'contact_form' );
	$form_type = fw_akg( 'type', $options, 'default' );
	if ( empty( $contact_form ) ) {
		$contact_form = fw_akg( 'shortcode/shortcode', $options, '' );
	}
	$form_id = fw_akg('custom/form_id', $options, '');
	$color_btn = fw_akg('custom/color_btn', $options, 'primary');

	/* Default contact form options */

	$contact_email = fw_akg( 'default/email', $options, $contact_email );
	$contact_title = fw_akg( 'default/title', $options, $contact_title );
	$contact_description = fw_akg( 'default/description', $options, $contact_description );
	$contact_text_btn = fw_akg('default/text_btn', $options, $contact_text_btn);
	$contact_color_btn = fw_akg('default/color_btn', $options, $contact_color_btn);
	$contact_thanks = fw_akg('default/thanks',$options,$contact_thanks);
	if ( empty( $contact_color_btn ) ) {
		$contact_color_btn = 'primary';
	}
} ?>
    <div class="window-popup message-popup">
        <a href="#" class="popup-close js-popup-close cd-nav-trigger">
            <svg class="utouch-icon utouch-icon-cancel-1">
                <use xlink:href="#utouch-icon-cancel-1"></use>
            </svg>
        </a>

        <div class="send-message-popup">
            <?php if ( 'shortcode' === $form_type && ! empty( $contact_form ) ) {
	            echo do_shortcode( $contact_form );
            } elseif ( 'custom' === $form_type && ! empty( $form_id ) ) {
	            Utouch_Helper_Html::generate_crumina_form( $form_id, $color_btn );
            } else {
	            $ajax_nonce = wp_create_nonce( 'widget_contact_form' );
               ?>

                <form class="contact-form" method="post" action="<?php echo site_url(); ?>?action=widget_contact_form"
                      data-thanks="<?php echo esc_attr( $contact_thanks ) ?>">

                    <?php  if ( ! empty( $contact_title ) ) {
	                    echo utouch_html_tag( 'h5', array(), esc_html( $contact_title ) );
                    }
                    if ( ! empty( $contact_description ) ) {
	                    echo utouch_html_tag( 'p', array(), esc_html( $contact_description ) );
                    } ?>

                    <input name="mail_to" type="hidden" value="<?php echo esc_attr( $contact_email ) ?>">
                    <input type="hidden" name="security" value="<?php echo esc_attr($ajax_nonce); ?>">
                    <div class="with-icon">
                        <input name="name" placeholder="<?php echo esc_html__( 'Your Name', 'utouch' ) ?>" type="text"
                               required="required">
                        <svg class="utouch-icon utouch-icon-user">
                            <use xlink:href="#utouch-icon-user"></use>
                        </svg>
                    </div>
                    <div class="with-icon">
                        <input name="email" placeholder="<?php echo esc_html__( 'Email Adress', 'utouch' ) ?>"
                               type="text" required="required">
                        <svg class="utouch-icon utouch-icon-message-closed-envelope-1">
                            <use xlink:href="#utouch-icon-message-closed-envelope-1"></use>
                        </svg>
                    </div>

                    <div class="with-icon">
                        <input class="with-icon" name="phone"
                               placeholder="<?php echo esc_html__( 'Phone Number', 'utouch' ) ?>" type="tel"
                               required="required">
                        <svg class="utouch-icon utouch-icon-telephone-keypad-with-ten-keys">
                            <use xlink:href="#utouch-icon-telephone-keypad-with-ten-keys"></use>
                        </svg>
                    </div>

                    <div class="with-icon">
                        <input class="with-icon" name="subject"
                               placeholder="<?php echo esc_html__( 'Subject', 'utouch' ) ?>" type="text"
                               required="required">
                        <svg class="utouch-icon utouch-icon-icon-1">
                            <use xlink:href="#utouch-icon-icon-1"></use>
                        </svg>
                    </div>

                    <div class="with-icon">
                        <textarea name="message" required
                                  placeholder="<?php echo esc_html__( 'Your Message', 'utouch' ) ?>"
                                  style="min-height: 180px;"></textarea>
                        <svg class="utouch-icon utouch-icon-edit">
                            <use xlink:href="#utouch-icon-edit"></use>
                        </svg>
                    </div>

                    <button class="btn btn--<?php echo esc_attr( $contact_color_btn ) ?> btn--with-shadow full-width" >
		                <?php echo esc_html( $contact_text_btn ) ?>
                    </button>
                </form>
            <?php } ?>
        </div>
    </div>