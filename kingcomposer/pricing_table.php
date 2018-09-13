<?php
/*
 * Pricing Table wrapper template
 */
$layout       = $columns = $wrap_class = '';
$column_class = array();
extract( $atts );

/**
 * @var int columns
 * @var int _id
 * @var string $pricing_variants
 * @var string $pricing_title
 * @var string $pricing_subtitle
 * @var string $pricing_desc
 * @var string $default_price
 * @var string $wrap_class
 */

$wrap_class   = apply_filters( 'kc-el-class', $atts );
$wrap_class[] = 'crumina-pricings';

preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches );
$column_class[] = 'col-xs-12';
if ( 3 == $columns || 6 == $columns ) {
	$column_class[] = 'col-sm-12';
	$column_class[] = 'col-md-12';
} else {
	$column_class[] = 'col-sm-6';
	$column_class[] = 'col-md-6';
}

$column_class[] = 'col-lg-' . intval( 12 / $columns );
$i              = 1;
$all            = 0;
if ( isset( $matches[0] ) ) {
	$all = count( $matches[0] );
}
if('yes' !== $atts['column_padding']){
	$column_class[] = 'no-padding';
}

Utouch::set_var( 'default_price', $atts['default_price'] );
?>
<div class="<?php echo implode( ' ', $wrap_class ) ?>">
	<div class="row mb60">
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12 align-center">
			<div class="crumina-module crumina-heading">
				<?php if ( ! empty( $pricing_subtitle ) ) { ?>
					<h6 class="heading-sup-title"><?php echo esc_html( $pricing_subtitle ) ?></h6>
				<?php } ?>
				<?php if ( ! empty( $pricing_title ) ) { ?>
					<h2 class="heading-title"><?php echo esc_html( $pricing_title ) ?></h2>
				<?php } ?>
				<?php if ( ! empty( $pricing_desc ) ) { ?>
					<div class="text"><?php echo esc_html( $pricing_desc ) ?></div>
				<?php } ?>
			</div>
			<?php if ( 'yes' === $pricing_variants ) { ?>
				<label class="tgl">
					<input class="js-check-toggle" type="checkbox" <?php if ( 'year' === $atts['default_price'] ) {
						echo 'checked';
					} ?>/>
					<span class="js-pricing-switcher" data-default="<?php echo esc_attr($atts['default_price'] ) ?>" data-on="<?php echo esc_html__( 'Annually', 'utouch' ) ?>"
						  data-off="<?php echo esc_html__( 'Monthly', 'utouch' ) ?>"></span>
				</label>
			<?php } ?>
		</div>
	</div>
	<div class="pricing-wrap ">

		<div class="row">

			<?php if ( $all > 0 ) {
				foreach ( $matches[0] as $single_shortcode ) {
					echo '<div class="' . implode( ' ', $column_class ) . '">';
					echo do_shortcode( $single_shortcode );
					echo '</div>';
					$i ++;
				}
			} ?>
		</div>
	</div>
</div>