<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Half background style
 */

$event = Utouch::get_event( get_the_ID() );
$wrapper_class = array( 'curriculum-event' );
if(null === $preview_size = Utouch::get_var('event_preview_size')){
	$preview_size = $event->preview_size;
}


if ( 'small' === $preview_size || true === Utouch::get_var( 'related_events_preview' ) ) {
	$img_width  = 370;
	$img_height = 440;

	$container_class = true === Utouch::get_var( 'related_events_preview' ) ? '' : 'col-lg-4 col-md-12 col-sm-12 col-xs-12';
	$tag = 'h5';

} else {
	$img_width  = 550;
	$img_height = 650;

	$container_class = 'col-lg-6 col-md-12 col-sm-12 col-xs-12';
	$wrapper_class[] = 'event-big';
	$tag = 'h4';

}

if ( null === Utouch::get_var( 'related_events_preview' ) && true === Utouch::get_var( 'utouch_sidebar_enabled' ) ) {
	if('small' === $preview_size){
		$container_class = 'col-lg-6 col-md-12 col-sm-12 col-xs-12';
	}else{
		$container_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
	}
}


$wrapper_class[] = 'thumb-full-block';

if ( has_post_thumbnail() ) {

	$thumbnail_id = get_post_thumbnail_id();
	$thumbnail    = get_post( $thumbnail_id );

	$style = 'background-image: url(' . esc_url( $thumbnail->guid ) . ')';
} else {
	$style = '';
}

?>
<div class="<?php echo esc_attr( $container_class ) ?>" id="utouch-event-id-<?php echo esc_attr( $event->ID ) ?>">
	<div class="<?php echo implode( ' ', $wrapper_class ) ?>" data-mh="curriculum-event"
		 style="color: <?php echo esc_attr($event->preview_accent_color) ?>">
		<div class="curriculum-event-thumb" style="<?php echo( $style ) ?>">

			<?php get_template_part( 'parts/event/preview/category' ) ?>
			<div class="curriculum-event-content">
				<a href="<?php the_permalink() ?>" class="<?php echo esc_attr($tag)?> title"><?php the_title() ?></a>
				<p class="text"><?php
					if ( has_excerpt() ) {
						$excerpt = get_the_excerpt();
					} else {
						$excerpt = get_the_content();
					}
					$excerpt = wp_trim_words( $excerpt, 10 );
					echo esc_html( $excerpt );
					?></p>
				<?php
				get_template_part( 'parts/event/speaker' );
				?>
			</div>
			<div class="overlay-standard" style="background-color: <?php echo esc_attr($event->preview_overlay) ?>"></div>
		</div>
	</div>
</div>


