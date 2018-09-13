<?php
/**
 * @package utouch-wp
 */

extract( $atts );
$module_class   = utouch_module_class( 'crumina-module-info-list', $atts );
$module_class[] = 'choose';

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">

	<div class="choose-item " style="background-color: <?php echo esc_attr( $left_color ) ?>; border-color: <?php echo esc_attr($left_color)?>">
		<h6 class="title"><?php echo esc_html( $left_title ) ?></h6>
		<p class="text"><?php echo esc_html( $left_desc ) ?></p>
		<?php
		$link   = explode( '|', $left_link );
		$url    = array_key_exists( 0, $link ) ? $link[0] : '';
		$target = array_key_exists( 2, $link ) ? $link[0] : '_self';
		if ( ! empty( $url ) ) {
			?>
			<a href="<?php echo esc_url( $url ) ?>" target="<?php echo esc_attr( $target ) ?>" class="btn-next">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1">
					<use xlink:href="#utouch-icon-arrow-right-1"></use>
				</svg>
				<svg class="utouch-icon utouch-icon-arrow-right1">
					<use xlink:href="#utouch-icon-arrow-right1"></use>
				</svg>
			</a>
			<?php
		}
		?>

	</div>

	<div class="choose-item " style="background-color: <?php echo esc_attr( $center_color ) ?>; border-color: <?php echo esc_attr($center_color)?>">
		<h6 class="title"><?php echo esc_html( $center_title ) ?></h6>
		<p class="text"><?php echo esc_html( $center_desc ) ?></p>
		<?php
		$link   = explode( '|', $center_link );
		$url    = array_key_exists( 0, $link ) ? $link[0] : '';
		$target = array_key_exists( 2, $link ) ? $link[0] : '_self';
		if ( ! empty( $url ) ) {
			?>
			<a href="<?php echo esc_url( $url ) ?>" target="<?php echo esc_attr( $target ) ?>" class="btn-next">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1">
					<use xlink:href="#utouch-icon-arrow-right-1"></use>
				</svg>
				<svg class="utouch-icon utouch-icon-arrow-right1">
					<use xlink:href="#utouch-icon-arrow-right1"></use>
				</svg>
			</a>
			<?php
		}
		?>
	</div>

	<div class="choose-item " style="background-color: <?php echo esc_attr( $right_color ) ?>; border-color: <?php echo esc_attr($right_color)?>">
		<h6 class="title"><?php echo esc_html( $right_title ) ?></h6>
		<p class="text"><?php echo esc_html( $right_desc ) ?></p>
		<?php
		$link   = explode( '|', $right_link );
		$url    = array_key_exists( 0, $link ) ? $link[0] : '';
		$target = array_key_exists( 2, $link ) ? $link[0] : '_self';
		if ( ! empty( $url ) ) {
			?>
			<a href="<?php echo esc_url( $url ) ?>" target="<?php echo esc_attr( $target ) ?>" class="btn-next">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1">
					<use xlink:href="#utouch-icon-arrow-right-1"></use>
				</svg>
				<svg class="utouch-icon utouch-icon-arrow-right1">
					<use xlink:href="#utouch-icon-arrow-right1"></use>
				</svg>
			</a>
			<?php
		}
		?>
	</div>

</div>