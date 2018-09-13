<?php
global $allowedposttags;
$output = $wrap_class = $left_image = $image = $right_image = '';

extract( $atts );

$el_class   = apply_filters( 'kc-el-class', $atts );
$el_class[] = 'crumina-module';
$el_class[] = 'crumina-tripple-image';


$el_class[] = $wrap_class;

?>
<div class="<?php echo esc_attr( implode( ' ', $el_class ) ) ?>">
	<?php if ( ! empty( $left_image ) ) {
		?><img src="<?php echo wp_get_attachment_image_url( $left_image, 'full' ) ?>"
               alt="<?php echo  esc_attr( get_post_meta( $left_image, '_wp_attachment_image_alt', true ) ) ?>"
               title="<?php echo esc_attr( get_the_title($left_image) ) ?>"><?php
	} ?>
	<?php if ( ! empty( $image ) ) {
		?><img src="<?php echo wp_get_attachment_image_url( $image, 'full' ) ?>"
               alt="<?php echo  esc_attr( get_post_meta( $image, '_wp_attachment_image_alt', true ) ) ?>"
               title="<?php echo esc_attr( get_the_title($image) ) ?>"><?php
	} ?>
	<?php if ( ! empty( $right_image ) ) {
		?><img src="<?php echo wp_get_attachment_image_url( $right_image, 'full' ) ?>"
               alt="<?php echo  esc_attr( get_post_meta( $right_image, '_wp_attachment_image_alt', true ) ) ?>"
               title="<?php echo esc_attr( get_the_title($right_image) ) ?>"><?php
	} ?>

</div>

