<?php
/** @var array $atts */

extract( $atts );
$img_link = wp_get_attachment_image_src( $image, 'full' );
$img_link = utouch_resize( $img_link[0], false, 710 );

$module_class = utouch_module_class( 'display-flex info-boxes', $atts );

if ( empty( $btn_color ) ) {
	$btn_color = 'primary';
}
?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" data-mh="info-group">
		<?php for ( $i = 1, $j = count( $options ); $i <= $j; $i ++ ) {
			if ( $i % 2 === 0 ) {
				continue;
			} ?>

			<?php
			if ( is_numeric( $options[ $i ]->image ) ) {
				$info_img  = wp_get_attachment_image_url( $options[ $i ]->image, 'full' );
				$info_img  = utouch_resize( $info_img, 100, 100,true );

				$img       = '<div class="info-box-image"><img src="' . esc_url( $info_img ) . '" alt="icon" class="utouch-icon"></div>';
				$wrap_cass = 'negative-margin-right130';
			} else {
				$img       = '';
				$wrap_cass = '';
			}
			?>
			<div class="crumina-module crumina-info-box info-box--standard-round icon-right <?php echo esc_attr( $wrap_cass ) ?> ">


				<?php echo( $img ) ?>

				<div class="info-box-content">
					<h5 class="info-box-title"><?php echo esc_html( $options[ $i ]->title ) ?></h5>
					<div class="info-box-text"><?php echo esc_html( $options[ $i ]->desc ) ?></div>
				</div>
			</div>
		<?php } ?>

	</div>

	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 align-center">
		<img class="particular-image" src="<?php echo esc_url( $img_link ) ?>" alt="image">

	</div>

	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" data-mh="info-group">
		<?php for ( $i = 1, $j = count( $options ); $i <= $j; $i ++ ) {
			if ( $i % 2 === 1 ) {
				continue;
			} ?>
			<?php
			if ( is_numeric( $options[ $i ]->image ) ) {
				$info_img  = wp_get_attachment_image_url( $options[ $i ]->image, 'full' );
				$info_img  = utouch_resize( $info_img, 100, 100, true );
				$img       = '<div class="info-box-image"><img src="' . esc_url( $info_img ) . '" alt="icon" class="utouch-icon"></div>';
				$wrap_cass = 'negative-margin-left130';
			} else {
				$img       = '';
				$wrap_cass = '';
			}
			?>
			<div class="crumina-module crumina-info-box info-box--standard-round <?php echo esc_attr( $wrap_cass ) ?>">
				<?php echo( $img ) ?>
				<div class="info-box-content">
					<h5 class="info-box-title"><?php echo esc_html( $options[ $i ]->title ) ?></h5>
					<div class="info-box-text"><?php echo esc_html( $options[ $i ]->desc ) ?></div>
				</div>
			</div>
		<?php } ?>

	</div>
</div>
