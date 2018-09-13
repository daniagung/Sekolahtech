<?php
/**
 * @package utouch-wp
 */

$event = Utouch::get_event( get_the_ID() );

$now = new DateTime();

if(empty($event->date_start) || $now > $event->date_start ){
	return;
}
?>

<div class="utouch-clock clock"
     data-countdown="<?php echo esc_attr( $event->date_start->format( 'o-m-d G:i' ) ) ?>">
</div>

