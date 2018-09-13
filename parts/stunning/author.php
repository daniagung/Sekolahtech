<?php
/**
 * @package utouch-wp
 */

$user_id = get_post_field( 'post_author', get_queried_object_id() );
$user_info = get_userdata( $user_id );
$utouch_user_data = get_user_meta($user_id,'utouch_social_networks',true);
?>
<div class="author-block inline-items">
	<div class="author-avatar">
		<?php echo get_avatar( $user_id ) ?>
	</div>
	<div class="author-info">
		<div class="author-prof"><?php echo esc_html(utouch_akg('profession',$utouch_user_data,'')) ?></div>
		<a href="<?php echo get_author_posts_url( $user_id ) ?>"
		   class="h6 author-name"><?php echo esc_html( $user_info->display_name ) ?></a>
	</div>
</div>
