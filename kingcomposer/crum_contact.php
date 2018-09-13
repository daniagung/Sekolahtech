<?php
extract( $atts );

if ( empty( $btn_color ) ) {
	$btn_color = 'primary';
}
Utouch::set_var( 'widget_contact_email', $email );

$module_class = utouch_module_class( 'widget w-contacts w-contacts--style2', $atts );

if(empty($btn_color)){
	$btn_color = 'primary';
}
?>

<div class="<?php echo implode( ' ', $module_class ) ?>">
    <?php if ( ! empty( $address ) ) { ?>
	<div class="contact-item display-flex">
		<svg class="utouch-icon utouch-icon-placeholder-3">
			<use xlink:href="#utouch-icon-placeholder-3"></use>
		</svg>
		<span class="info"><?php echo esc_html( $address ) ?></span>
	</div>
    <?php } ?>
    <?php if ( ! empty( $phone_1 ) || ! empty( $phone_2 ) ) { ?>
	<div class="contact-item display-flex">
		<svg class="utouch-icon utouch-icon-telephone-keypad-with-ten-keys">
			<use xlink:href="#utouch-icon-telephone-keypad-with-ten-keys"></use>
		</svg>
		<div class="info-wrap">
			<?php if ( ! empty( $phone_1 ) ) { ?>
				<span class="info"><?php echo utouch_html_tag( 'a', array( 'href' => 'tel:' . $phone_1 ), esc_html( $phone_1 ) ) ?><?php if ( ! empty( $phone_1_desc ) ) { ?> <span>
						- <?php echo esc_html( $phone_1_desc ) ?></span><?php } ?></span>
			<?php } ?>
			<?php if ( ! empty( $phone_2 ) ) { ?>
				<span class="info"><?php echo utouch_html_tag( 'a', array( 'href' => 'tel:' . $phone_2 ), esc_html( $phone_2 ) ) ?><?php if ( ! empty( $phone_2_desc ) ) { ?> <span>
						- <?php echo esc_html( $phone_2_desc ) ?></span><?php } ?></span>
			<?php } ?>
		</div>
	</div>
    <?php } ?>

    <?php if ( ! empty( $email ) ) { ?>
	<div class="contact-item display-flex">
		<svg class="utouch-icon utouch-icon-message">
			<use xlink:href="#utouch-icon-message"></use>
		</svg>
		<a href="mailto:<?php echo esc_attr( $email ) ?>" class="info"><?php echo esc_html( $email ) ?></a>
	</div>
    <?php } ?>
	<?php if ( ! empty( $btn_label ) ) { ?>
		<a href="#" class="btn btn--<?php echo esc_attr( $btn_color ) ?> btn--with-shadow js-message-popup cd-nav-trigger">
			<?php echo esc_html( $btn_label ) ?>
		</a>
	<?php } ?>
</div>

