<?php
$social_classes       = array(
	'icons' => 'socials',
	'hover' => 'socials socials--round',
	'bg'    => 'socials socials--round socials--colored',
);
$atts['social_class'] = $social_classes[ utouch_akg( 'social_class', $atts, 'icons' ) ];
Utouch::set_var( 'crum_team_member', $atts );
get_template_part( 'parts/kc/crum-team/' . utouch_akg( 'layout', $atts, '' ) );
Utouch::delete_var( 'crum_team_member' );
return;

$title      = $subtitle = $desc = $image = $custom_class = $data_img = $data_title = $data_desc = $data_subtitle = $img_size = $data_socials = $socials = $data_button = '';
$layout     = 1;
$wrap_class = apply_filters( 'kc-el-class', $atts );

extract( $atts );

$wrap_class[] = 'crumina-module';
$wrap_class[] = 'crumina-teammembers-item';

if ( ! empty( $custom_class ) ) {
	$wrap_class[] = $custom_class;
}

if ( ! empty( $link ) ) {
	$link_page = explode( '|', $link );
	$link_page = $link_page[0];
}
?>
<div class="<?php echo implode( ' ', $wrap_class ); ?>">
	<div class="module-image">
		<?php if ( $image > 0 ) {
		$img_link = wp_get_attachment_image_src( $image, $img_size );
		$img_link = $img_link[0];
		if ( ! empty( $link_page ) ) { ?>
			<a href="<?php echo esc_url( $link_page ) ?>">
				<img src="<?php echo esc_url( $img_link ); ?>" alt="<?php echo esc_attr( $title ) ?>">
			</a>
		<?php } else { ?>
			<img src="<?php echo esc_url( $img_link ); ?>" alt="<?php echo esc_attr( $title ) ?>">
		<?php } ?>
	</div>
	<?php }
	if ( ! empty( $title ) ) { ?>
		<h5 class="teammembers-item-name">
			<?php if ( ! empty( $link_page ) ) {
				echo '<a href="' . esc_url( $link_page ) . '">' . esc_html( $title ) . '</a>';
			} else {
				echo esc_html( $title );
			} ?>
		</h5>
	<?php }
	if ( ! empty( $subtitle ) ) { ?>
		<p class="teammembers-item-prof"><?php echo esc_html( $subtitle ) ?></p>
	<?php }

	if ( ! empty( $social_networks ) ) {
		echo '<div class="socials">';
		foreach ( $social_networks as $key => $item ) {
			echo '<a href="' . esc_url( $item->link ) . '" class="social__item">';
			echo '<img src="' . get_template_directory_uri() . '/svg/socials/plain/' . esc_attr( $item->icon ) . '" alt="icon">';
			echo '</a>';
		}
		echo '</div>';
	} ?>
</div>