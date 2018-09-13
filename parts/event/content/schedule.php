<?php
/**
 * @package utouch-wp
 */
$event = Utouch::get_event( get_the_ID() );

$day_dates  = array_values( $event->day_dates );
$days_count = count( $day_dates );

$half_size_item_count = $days_count - ( $days_count % 2 );
?>

<?php
$tab_title = '';
if(!empty($event->schedule_title)){
	echo utouch_html_tag('h3',array(),esc_html( $event->schedule_title ));
}
if(!empty($event->schedule_desc)){
	echo utouch_html_tag('p',array('class'=>'weight-bold'),esc_html( $event->schedule_desc ));
}

?>
<div class="row">
	<?php
	for ( $i = 0; $i < $days_count; $i ++ ) {
		$col_class         = $i < $half_size_item_count ? 'col-lg-6 col-md-6 col-sm-12 col-xs-12' : 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
		$list_events_class = $i < $half_size_item_count ? 'list-events' : 'list-events col-2';
		?>
		<div class="<?php echo( $col_class ) ?>">
			<div class="schedule-item">
				<h4 class="title"> <?php echo esc_html__( 'Day', 'utouch' ) ?> 0<?php echo( $i + 1 ) ?> /
					<span><?php echo esc_html($day_dates[ $i ]['day']->format( 'F j' )) ?> </span></h4>
				<ul class="<?php echo( $list_events_class ) ?>">
					<?php
					foreach ( $day_dates[ $i ]['dates'] as $schedule_date ) {
						?>
						<li>
							<div> <?php
								echo esc_html($schedule_date['from']->format( 'g:i a' ));
								if ( ! empty( $schedule_date['title'] ) ) {
									echo ' / ' . $schedule_date['title'];
								}
								?></div>
							<?php if ( ! empty( $schedule_date['desc'] ) ) { ?>
								<h6 class="event-title"><?php echo esc_html( $schedule_date['desc'] ); ?></h6>
							<?php } ?>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	<?php } ?>

</div>
