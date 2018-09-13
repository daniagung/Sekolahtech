<?php
/**
 * @package utouch-wp
 */

$event = Utouch::get_event( get_the_ID() );

$now = new DateTime();

?>
<div class="counting-down">
	<?php if ( ! empty( $event->date_start ) ) { ?>

		<?php if ( $now > $event->date_start ) { ?>
			<div class="counting-header">
				<h6 class="title"><?php echo esc_html__( 'Event already started!','utouch' ) ?></h6>
			</div>
		<?php } else { ?>
			<div class="counting-header">
				<h6 class="title"><?php echo esc_html( $event->countdown_title ) ?></h6>
				<?php get_template_part( 'parts/event/countdown-clock' ) ?>
				<svg class="utouch-icon utouch-icon-stopwatch">
					<use xlink:href="#utouch-icon-stopwatch"></use>
				</svg>
			</div>
		<?php } ?>

		<div class="counting-date">
			<div class="icon-text-item display-flex">
				<svg class="utouch-icon utouch-icon-calendar-2">
					<use xlink:href="#utouch-icon-calendar-2"></use>
				</svg>
				<div class="text"><?php echo esc_html($event->get_date_location()) ?></div>
			</div>
		</div>
	<?php } ?>

	<div class="counting-footer">
		<?php
		if ( false !== $main_speaker = get_user_by( 'email', $event->main_speaker ) ) {

			$user_info = get_userdata( $main_speaker->ID );
			$user_utouch_meta = get_user_meta( $main_speaker->ID, 'utouch_social_networks', true );
			?>
			<div class="author-block inline-items">
				<div class="author-avatar">
					<img src="<?php echo get_avatar_url( $main_speaker->ID, array( 'size' => '60' ) ) ?>"
						 alt="speaker">

				</div>
				<div class="author-info">
					<div class="author-prof"><?php esc_html__('Main Speaker','utouch')?></div>
					<a href="<?php echo esc_url( get_author_posts_url( $main_speaker->ID ) ) ?>"
					   class="h6 author-name"><?php echo esc_html( $user_info->display_name ) ?></a>
				</div>
			</div>
			<?php
		}
		?>
		<a href="<?php echo esc_url( $event->button_url ) ?>" target="<?php echo esc_attr( $event->button_target ) ?>"
		   class="btn btn-small full-width btn--<?php echo esc_attr( $event->button_color ) ?> btn--with-shadow">
			<?php echo esc_html( $event->button_label ) ?>
		</a>
	</div>
</div>

