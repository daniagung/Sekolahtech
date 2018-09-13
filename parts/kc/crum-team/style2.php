<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'crum_team_member' );
extract( $atts );

$module_class   = utouch_module_class( 'crumina-teammembers-item', $atts );
$module_class[] = 'teammember-item--author-in-round';

$link   = explode( '|', $link );
$href   = ! empty( $link[0] ) ? $link[0] : '#';
$target = ! empty( $link[1] ) ? $link[1] : '_blank';

$image_url = wp_get_attachment_image_url( $image, 'full' );
$image_url = utouch_resize( $image_url, 200, 200, true );

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">

	<div class="teammembers-thumb">
		<img src="<?php echo esc_url( $image_url ) ?>" alt="<?php echo esc_attr( $title ) ?>">
		<?php if ( ! empty( $email ) ) { ?>
			<a href="mailto:<?php echo esc_attr( $email ) ?>" class="btn btn--round btn--green btn--with-shadow">
				<svg class="utouch-icon utouch-icon-message-closed-envelope-1">
					<use xlink:href="#utouch-icon-message-closed-envelope-1"></use>
				</svg>
			</a>
		<?php } ?>
	</div>

	<div class="teammember-content">

		<div class="teammembers-item-prof"><?php echo esc_html( $subtitle ) ?></div>

		<a href="<?php echo esc_url( $href ) ?>" target="<?php echo esc_attr( $target ) ?>"
		   class="h5 teammembers-item-name"><?php echo esc_html( $title ) ?></a>

		<div><?php echo esc_html( $desc ) ?></div>

		<ul class="<?php echo esc_attr( $social_class ) ?>">
			<?php
			foreach ( $social_networks as $network ) {
				$class = str_replace( '.svg', '', $network->icon );
				$file  = get_template_directory_uri() . '/svg/socials/plain/' . $network->icon;
				?>
				<li>
					<a href="<?php echo esc_url( $network->link ) ?>"
					   class="social__item <?php echo esc_attr( $class ) ?>">
						<?php echo utouch_get_svg_icon($file) ?>
					</a>
				</li>
			<?php } ?>

		</ul>
	</div>
</div>
