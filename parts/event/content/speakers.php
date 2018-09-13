<?php
/**
 * @package utouch-wp
 */
$event = Utouch::get_event( get_the_ID() );

?>

<?php
$tab_title = '';
if(!empty($event->speakers_title)){
	echo utouch_html_tag('h3',array(),esc_html( $event->speakers_title ));
}
if(!empty($event->speakers_desc)){
	echo utouch_html_tag('p',array('class'=>'weight-bold'),esc_html( $event->speakers_desc ));
}

?>

<ul class="teammember-list">
	<?php
	foreach ( $event->speakers as $speaker_email ) {
		$speaker = get_user_by( 'email', $speaker_email );
		if(false === $speaker){
			continue;
		}
		$speaker_id = $speaker->ID;
		$user_utouch_meta = get_user_meta( $speaker_id, 'utouch_social_networks', true );
		$user_desc = get_user_meta( $speaker_id, 'description', true );
		?>
		<li class="crumina-module crumina-teammembers-item teammember-item--author-in-round">

			<div class="teammembers-thumb">
				<img src="<?php echo get_avatar_url( $speaker_id, array( 'size' => '200' ) ) ?>" alt="team member">
			</div>

			<div class="teammember-content">
				<?php if ( ! empty( $user_utouch_meta['profession'] ) ) { ?>
					<div class="teammembers-item-prof"><?php echo esc_html( $user_utouch_meta['profession'] ) ?></div>
				<?php } ?>

				<a href="<?php echo esc_url( get_author_posts_url( $speaker_id ) ) ?>"
				   class="h5 teammembers-item-name"><?php echo esc_html( $speaker->display_name ) ?></a>


				<?php if ( ! empty( $user_desc ) ) { ?>
					<p><?php echo ( $user_desc ) ?></p>
				<?php } ?>
			</div>
		</li>
	<?php } ?>
</ul>
