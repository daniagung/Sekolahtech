<?php
/**
 * Unyson Forms shortcode
 **/

$form_id   = $custom_class = $color_form = $color_btn = $button_class = '';
$form_tags = $submit_atts = array();

/** @var array $atts */
extract( $atts );

//Kingcomposer wrapper class for each element
$wrap_class = apply_filters( 'kc-el-class', $atts );
//custom class element
$wrap_class[] = 'crumina-module';
$wrap_class[] = 'contact-form-module';
$wrap_class[] = $custom_class;

if ( empty( $color_btn ) ) {
	$color_btn = 'primary';
}


if ( isset( $form_id ) && $form_id > 0 ) { ?>
    <div class="<?php echo implode( ' ', $wrap_class ); ?>">

		<?php Utouch_Helper_Html::generate_crumina_form( $form_id, $color_btn, $button_class ); ?>

    </div>
<?php } else { ?>
	<?php esc_html_e( 'Please create new and select contact form.', 'utouch' ); ?>
<?php } ?>