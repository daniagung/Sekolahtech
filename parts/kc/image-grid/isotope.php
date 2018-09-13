<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'crum_image_grid' );
extract( $atts );

$module_class = utouch_module_class( 'crumina-module-image-grid', $atts );
$module_class[] = 'align-center';
?>

<div class="<?php echo implode( ' ', $module_class ) ?>">
	<ul class="cat-list-bg-style sorting-menu">
		<li class="cat-list__item active" data-filter="*"><a href="#"
															 class=""><?php echo esc_html__( 'All', 'utouch' ) ?></a>
		</li>
		<?php foreach ( $cat_slugs as $slug => $name ) { ?>
			<li class="cat-list__item" data-filter=".<?php echo esc_attr( $slug ) ?>"><a href="#"
																						 class=""><?php echo esc_html( $name ) ?></a>
			</li>
		<?php } ?>
	</ul>

	<div class="row sorting-container" id="image-grid-<?php echo esc_attr( $_id ) ?>" data-layout="masonry">
		<?php foreach ( $attachments as $attachment ) { ?>
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 sorting-item <?php echo implode( ' ', $attachment['terms'] ) ?>">
				<div class="screenshots-item">
                    <a href="<?php echo esc_url( $attachment['url_full'] ) ?>" class=" js-zoom-image">
					<img src="<?php echo esc_url( $attachment['url_full'] ) ?>"
                         alt="<?php echo  esc_attr( get_post_meta( $attachment['ID'], '_wp_attachment_image_alt', true ) ) ?>"
                         title="<?php echo esc_attr( get_the_title($attachment['ID']) ) ?>"
                    >
					<div class="overlay-standard overlay--blue-dark"></div>

                        <span class="expand">
						<svg class="utouch-icon utouch-icon-expand">
							<use xlink:href="#utouch-icon-expand"></use>
						</svg>
						<?php echo esc_html__( 'Expand', 'utouch' ) ?>
                            </span>
					</a>
				</div>
			</div>
		<?php } ?>
	</div>

	<?php utouch_ajax_loadmore( $the_query, 'image-grid-' . $_id ); ?>
</div>


