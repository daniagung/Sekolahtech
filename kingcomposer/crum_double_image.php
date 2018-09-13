<?php
global $allowedposttags;
$output = $wrap_class = $left_image = $image = $right_image = '';

extract( $atts );

$el_class   = apply_filters( 'kc-el-class', $atts );
$el_class[] = 'crumina-module';
$el_class[] = 'crumina-double-image';


$el_class[] = $wrap_class;

?>

<div class="<?php echo esc_attr( implode( ' ', $el_class ) ) ?>">



	<?php if ( ! empty( $left_image ) ) {
		echo wp_get_attachment_image( $left_image,'full');
	}
	if ( ! empty( $right_image ) ) {
		echo wp_get_attachment_image( $right_image, 'full' );
	} ?>
</div>