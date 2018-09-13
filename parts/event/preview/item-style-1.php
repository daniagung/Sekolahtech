<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Half background style
 */

$event         = Utouch::get_event( get_the_ID() );
$wrapper_class = array( 'curriculum-event' );
if(null === $preview_size = Utouch::get_var('event_preview_size')){
	$preview_size = $event->preview_size;
}
if ( 'small' === $preview_size || true === Utouch::get_var( 'related_events_preview' ) ) {
	$img_width       = 370;
	$img_height      = 230;
	$container_class = true === Utouch::get_var( 'related_events_preview' ) ? '' : 'col-lg-4 col-md-12 col-sm-12 col-xs-12';
	$tag             = 'h5';
} else {
	$img_width       = 550;
	$img_height      = 350;
	$container_class = 'col-lg-6 col-md-12 col-sm-12 col-xs-12';
	$wrapper_class[] = 'event-big';
	$tag             = 'h4';
}

if ( null === Utouch::get_var( 'related_events_preview' ) && true === Utouch::get_var( 'utouch_sidebar_enabled' ) ) {
	if('small' === $preview_size){
		$container_class = 'col-lg-6 col-md-12 col-sm-12 col-xs-12';
	}else{
		$container_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
	}
}


?>
<div class="<?php echo esc_attr( $container_class ) ?>" id="utouch-event-id-<?php echo esc_attr( $event->ID ) ?>">
	<div class="<?php echo implode( ' ', $wrapper_class ) ?>" data-mh="curriculum-event"
		 style="color: <?php echo esc_attr($event->preview_accent_color) ?>">
		<div class="curriculum-event-thumb">
			<?php if ( has_post_thumbnail() ) {

				$thumbnail_id = get_post_thumbnail_id();
				$thumbnail    = get_post( $thumbnail_id );
				$image        = utouch_resize( $thumbnail->guid, $img_width, $img_height, true );
				?>

				<img src="<?php echo esc_url( $image ) ?>" alt="image">
			<?php } ?>
			<?php get_template_part( 'parts/event/preview/category' ) ?>
			<div class="curriculum-event-content">
				<?php
				get_template_part( 'parts/event/speaker' );
				?>

			</div>
			<div class="overlay-standard" style="background-color: <?php echo esc_attr($event->preview_overlay) ?>"></div>
		</div>
		<div class="curriculum-event-content">
			<div class="icon-text-item display-flex">
				<svg class="utouch-icon utouch-icon-calendar-2">
					<use xlink:href="#utouch-icon-calendar-2"></use>
				</svg>
				<div class="text"><?php echo esc_html($event->get_date_location()) ?></div>
			</div>
			<a href="<?php the_permalink() ?>" class="<?php echo esc_attr( $tag ) ?> title"><?php the_title() ?></a>
		</div>
	</div>
</div>
