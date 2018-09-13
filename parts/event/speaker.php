<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$event = Utouch::get_event( get_the_ID() );

$speaker = get_user_by( 'email', $event->main_speaker );
if(false === $speaker){
	return;
}
$avatar  = get_avatar( $speaker->user_email );

if ( $avatar instanceof WP_Error || $speaker instanceof WP_Error ) {
	return;
}
global $allowedtags;
?>
<div class="author-block inline-items">
	<div class="author-avatar">
		<?php echo wp_kses($avatar,$allowedtags); ?>
	</div>
	<div class="author-info">
		<div class="author-prof"><?php echo esc_html__( 'Speaker', 'utouch' ) ?></div>
		<a href="#" class="h6 author-name"><?php echo esc_html( $speaker->display_name ) ?></a>
	</div>
</div>