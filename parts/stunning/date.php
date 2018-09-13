<?php
/**
 * @package utouch-wp
 */
if ( 'fw-event' === get_post_type() ) {
	$event = Utouch::get_event( get_the_ID() );
	$date  = $event->get_date_location();
} else {
	$date = get_the_modified_date();
}
?>
<?php
if ( ! empty( $date ) ) {
	?>
	<div class="icon-text-item inline-items">
		<svg class="utouch-icon utouch-icon-calendar-2">
			<use xmlns:xlink="http://www.w3.org/1999/xlink"
				 xlink:href="#utouch-icon-calendar-2"></use>
		</svg>
		<div class="text"><?php
			echo esc_html( $date );
			?></div>
	</div>
	<?php
} ?>
