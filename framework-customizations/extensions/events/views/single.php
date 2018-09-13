<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 */

$only_countdown = false;
Utouch::set_var( 'custom_stunning_taxonomy', 'fw-event-taxonomy-name' );
$event = Utouch::get_event( get_the_ID() );
/**
 * @var Utouch_Event $event
 */

$layout          = utouch_sidebar_conf( true );
$container_width = 'container';
$padding_class   = 'medium-padding30';
$builder_meta    = get_post_meta( get_the_ID(), 'kc_data', true );

if ( 'full' === $layout['position'] && $event->show_aside_block ) {
	$layout         = array(
		'content-classes' => 'col-lg-8 col-md-8 col-sm-12',
		'sidebar-classes' => 'col-lg-4 col-md-4 col-sm-12',
		'position'        => 'right',
	);
	$only_countdown = true;
}
get_header(); ?>
	<div id="primary">

		<?php while ( have_posts() ) : the_post();
			?>
		<div class="<?php echo esc_attr( $container_width ) ?>">
		<div class="row <?php echo esc_attr( $padding_class ) ?>">

			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<div class="conference-details">

					<?php
					if ( ! $event->show_schedule && ! $event->show_speakers && ! $event->show_location ) {
						get_template_part( 'parts/event/content/workshops' );
						?>
					<?php } else {
						?>
						<ul class="conference-details-control tabs-with-line" role="tablist">

							<li role="presentation" class="tab-control active">
								<a href="#workshops" role="tab" data-toggle="tab"
								   class="control-item"><?php echo esc_html( $event->workshop_label ) ?></a>
							</li>

							<?php if ( $event->show_schedule ) { ?>
								<li role="presentation" class="tab-control">
									<a href="#schedule" role="tab" data-toggle="tab"
									   class="control-item"><?php echo esc_html( $event->schedule_label ) ?></a>
								</li>
							<?php } ?>

							<?php if ( $event->show_speakers ) { ?>

								<li role="presentation" class="tab-control">
									<a href="#speakers" role="tab" data-toggle="tab"
									   class="control-item"><?php echo esc_html( $event->speakers_label ) ?></a>
								</li>
							<?php } ?>

							<?php if ( $event->show_location ) { ?>

								<li role="presentation" class="tab-control">
									<a href="#location" id="event_location" role="tab" data-toggle="tab"
									   class="control-item"><?php echo esc_html( $event->location_label ) ?></a>
								</li>
							<?php } ?>

						</ul>

						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="workshops">
								<?php get_template_part( 'parts/event/content/workshops' ); ?>

							</div>

							<?php if ( $event->show_schedule ) { ?>

								<div role="tabpanel" class="tab-pane fade" id="schedule">
									<?php get_template_part( 'parts/event/content/schedule' ); ?>

								</div>
							<?php } ?>
							<?php if ( $event->show_speakers ) { ?>

								<div role="tabpanel" class="tab-pane fade" id="speakers">
									<?php get_template_part( 'parts/event/content/speakers' ); ?>

								</div>
							<?php } ?>
							<?php if ( $event->show_location ) { ?>

								<div role="tabpanel" class="tab-pane fade" id="location">
									<?php get_template_part( 'parts/event/content/location' ); ?>
								</div>

							<?php } ?>
						</div>
					<?php } ?>

					<?php if ( $event->show_share ) {
						echo '<div class="post-details-shared">';
						get_template_part( 'parts/post/share-icons' );
						echo '</div>';
					}
					?>
				</div>

			</div>
			<?php

			if ( 'full' !== $layout['position'] ) {
				?>
				<div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
					<?php
					if ( $event->show_aside_block ) {
						get_template_part( 'parts/event/countdown' );
					}
					?>
					<?php
					if ( ! $only_countdown ) {
						get_sidebar();
					}
					?>
				</div>
				<?php ?>
				</div><!-- #row -->
				</div>
			<?php }
		endwhile; // End of the loop.
		?>

		<?php if ( 'prev_next' === $event->navigation_type ) { ?>
			<section class="bg-blue-lighteen">
				<div class="<?php echo esc_attr( $container_width ) ?> ">
					<div class="row">
						<div class="col-lg-12">
							<?php get_template_part( 'parts/event/navigation' ) ?>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>

	</div><!-- #primary -->

<?php
if ( 'related' === $event->navigation_type ) {
	get_template_part( 'parts/event/same-category-events' );
}
?>
<?php
get_footer();
