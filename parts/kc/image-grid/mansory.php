<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'crum_image_gallery' );
extract( $atts );

$module_class = utouch_module_class( 'crumina-module-image-grid', $atts );
$module_class[] = 'crumina-screenshots';

?>

<div class="<?php echo implode( ' ', $module_class ) ?>"
	 id="image-grid-<?php echo esc_attr( $_id ) ?>">

	<?php foreach ( $attachments as $attachment ) { ?>

		<div class="col-item">
			<div>
                <a href="<?php echo esc_url( $attachment['url_full'] ) ?>" class=" js-zoom-image">
				<img src="<?php echo esc_url( $attachment['url_full'] ) ?>"
                     alt="<?php echo  esc_attr( get_post_meta( $attachment['ID'], '_wp_attachment_image_alt', true ) ) ?>"
                     title="<?php echo esc_attr( get_the_title($attachment['ID']) ) ?>">
				<div class="overlay-standard overlay--blue-dark"></div>


                    <span class="expand">
					<svg class="utouch-icon utouch-icon-expand">
						<use xlink:href="#utouch-icon-expand"></use>
					</svg>
                        </span>
				</a>
			</div>
		</div>
	<?php } ?>

</div>

<?php utouch_ajax_loadmore( $the_query, 'image-grid-' . $_id ); ?>
