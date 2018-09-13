<?php

$el_classess = utouch_module_class( 'crumina-counter-item', $atts );

extract( $atts );
/**
 * @var string $wrap_class
 * @var string $number
 * @var string $units
 * @var string $label
 */

$el_classess[] = $wrap_class;

if ( ! empty( $wrapper_class ) ) {
	$el_classess[] = $wrapper_class;
}

?>

<div class="<?php echo implode( ' ', $el_classess ) ?>">
	<div class="counter-numbers counter">
		<span data-speed="2000" data-refresh-interval="3" data-to="<?php echo esc_attr( $number ) ?>"
			  data-from="0"></span>
		<?php if ( ! empty( $units ) ) { ?>
			<div class="units"><?php echo esc_html( $units ) ?></div>
		<?php } ?>
	</div>
	<h5 class="counter-title"><?php echo esc_html( $label ) ?></h5>
</div>
