<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array $args
 * @var string $title
 * @var array $instance
 */

wp_enqueue_script(
	'js-cookie',
	get_template_directory_uri() . '/inc/widgets/contacts/static/js/js.cookie.js',
	array( 'jquery' ),
	'2.1.3',
	true
);

$social_classes = array(
	'icons' => 'socials',
	'hover' => 'socials socials--round',
	'bg'    => 'socials socials--round socials--colored',
);

if ( empty( $instance['soc_icon_style'] ) || ! array_key_exists( $instance['soc_icon_style'], $social_classes ) ) {
	$soc_class = $social_classes['icons'];
} else {
	$soc_class = $social_classes[ $instance['soc_icon_style'] ];
}

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

if (!isset($instance['socials']) || ! is_array( $instance['socials'] ) ) {
	$instance['socials'] = array();
}
if ( ! empty( $instance['button_text'] ) && ( ! empty( $instance['contact_email'] ) || ! empty( $instance['contact_form'] ) ) ) {
	Utouch::set_var( 'widget_contact_email', $instance['contact_email'] );
	Utouch::set_var( 'widget_contact_shortcode', $instance['contact_form'] );
}
echo( $before_widget );

if ( $title ) {
	echo( $before_title . esc_html( $title ) . $after_title );
}
?>
<?php if ( ! empty( $instance['address'] ) ) { ?>

	<p class="contacts-text" style="color: #4b5d73;"><?php echo esc_html( $instance['address'] ) ?></p>
<?php } ?>

	<!-- Google map -->

<?php
if ( ! empty( $instance['address_oembed'] ) ) {
	echo '<div id="map">';
	echo str_replace( '<iframe', '<iframe style="max-height:100%;"', $instance['address_oembed'] );
	echo '</div>';
}
?>

	<!-- End Google map -->
<?php if ( ! empty( $instance['phone'] ) ) { ?>
	<div class="contact-item display-flex">
		<svg class="utouch-icon utouch-icon-telephone-keypad-with-ten-keys">
			<use xlink:href="#utouch-icon-telephone-keypad-with-ten-keys"></use>
		</svg>
		<a class="info" href="tel:<?php echo esc_attr( str_replace(' ','',$instance['phone']) ) ?>"><?php echo esc_html( $instance['phone'] ) ?></a>
	</div>
<?php } ?>
<?php if ( ! empty( $instance['phone'] ) ) { ?>

	<div class="contact-item display-flex">
		<svg class="utouch-icon utouch-icon-message-closed-envelope-1">
			<use xlink:href="#utouch-icon-message-closed-envelope-1"></use>
		</svg>
		<a class="info" href="mailto:<?php echo esc_attr( $instance['email'] ) ?>"><?php echo esc_html( $instance['email'] ) ?></a>
	</div>
<?php } ?>

<?php if ( ! empty( $instance['button_text'] ) && ( ! empty( $instance['contact_email'] ) || ! empty( $instance['contact_form'] ) ) ) { ?>
	<a href="#"
	   class="btn btn--<?php echo esc_attr( $instance['button_color'] ) ?>  btn--with-shadow js-message-popup cd-nav-trigger">
		<?php echo esc_html( $instance['button_text'] ) ?>
	</a>
<?php } ?>

<?php if ( ! empty( $instance['socials'] ) ) { ?>

	<ul class="<?php echo esc_attr( $soc_class ) ?>">
		<?php if ( ! empty( $instance['social_title'] ) ) { ?>
			<li><?php echo esc_html( $instance['social_title'] ) ?></li>
		<?php } ?>
		<?php foreach ( $instance['socials'] as $social ) { ?>
			<li>
				<a href="<?php echo esc_html( $social['link'] ); ?>" target="_blank"
				   class="social__item <?php echo str_replace( '.svg', '', $social['network'] ) ?>"><?php
					$svg_link = get_template_directory_uri() . '/svg/socials/plain/' . $social['network'] . '.svg';
					echo utouch_get_svg_icon( $svg_link );
					?></a>
			</li>
		<?php } ?>
	</ul>
<?php } ?>
<?php
echo( $after_widget );
