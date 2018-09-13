<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
global $allowedtags;
/**
 * @var array $args
 * @var string $title
 * @var string $widget_text
 * @var string $button_text
 * @var string $button_link
 */

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );
echo( $before_widget );
if ( $title ) {
	echo( $before_title . esc_html( $title ) . $after_title );
}

$link = ! empty( $button_link ) ? $button_link : '#';
if ( ! empty( $description ) ) {
	echo '<div class="text-wrap">' . do_shortcode( $widget_text ) . '</div>';
} ?>
<?php if ( ! empty( $button_text ) ) { ?>
	<a href="<?php echo esc_url( $link ); ?>" class="btn btn--<?php echo esc_attr( $button_color ) ?> btn-border btn--with-shadow">
		<?php echo esc_html( $button_text ); ?>
	</a>
<?php } ?>
<?php
echo( $after_widget );