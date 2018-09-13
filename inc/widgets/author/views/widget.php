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
	get_template_directory_uri() . '/inc/widgets/author/static/js/js.cookie.js',
	array( 'jquery' ),
	'2.1.3',
	true
);


$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );
if ( ! is_array( $instance['socials'] ) ) {
	$instance['socials'] = array();
}
if ( ! empty( $instance['button_text'] ) && ! empty( $instance['contact_email'] ) ) {
	Utouch::set_var( 'widget_contact_email', $instance['contact_email'] );
}
echo( $before_widget );

?>
<?php if ( ! empty( $instance['address'] ) ) { ?>

	<p class="contacts-text"><?php echo esc_html( $instance['address'] ) ?></p>
<?php } ?>

	<!-- Google map -->
	<div class="testimonial-img-author">
		<?php if ( ! empty( $instance['image'] ) ) {
			$image_url = utouch_resize( $instance['image'], 120, 120, true );
			?>
			<img src="<?php echo esc_url( $image_url ) ?>" alt="author">
		<?php } ?>
		<div class="socials">

			<?php foreach ( $instance['socials'] as $social ) { ?>
				<a href="<?php echo esc_html( $social['link'] ); ?>" target="_blank"
				   class="social__item <?php echo str_replace( '.svg', '', $social['network'] ) ?>"><?php
					$svg_link = get_template_directory_uri() . '/svg/socials/plain/' . $social['network'] . '.svg';
					echo utouch_get_svg_icon( $svg_link );
					?></a>
			<?php } ?>

		</div>
	</div>

<?php if ( ! empty( $instance['author'] ) ) { ?>

	<div href="#" class="h5 title"><?php echo esc_html( $instance['author'] ) ?></div>
<?php } ?>

<?php if ( ! empty( $instance['desc'] ) ) { ?>

	<p><?php echo esc_html( $instance['desc'] ) ?></p>
<?php } ?>

<?php if ( ! empty( $instance['button_text'] ) && ! empty( $instance['contact_email'] ) ) { ?>
	<a href="#"
	   class="btn btn--<?php echo esc_attr( $instance['button_color'] ) ?> full-width  btn--large  btn--with-shadow js-message-popup cd-nav-trigger">
		<?php echo esc_html( $instance['button_text'] ) ?>
	</a>
<?php } ?>

<?php
echo( $after_widget );
