<?php
/**
 * @package utouch-wp
 */

extract( $atts );
$module_class   = utouch_module_class( 'crumina-module-info-list', $atts );
$module_class[] = 'choose';

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
	<?php if ( ! empty( $boxes ) ) { ?>
		<?php foreach ( $boxes as $box ) { ?>
            <div class="choose-item"
                 style="background-color: <?php echo esc_attr( $box->color ) ?>; border-color: <?php echo esc_attr( $box->color ) ?>">
                <h6 class="title"><?php echo esc_html( $box->title ) ?></h6>
                <p class="text"><?php echo esc_html( $box->desc ) ?></p>
				<?php
				$link   = explode( '|', $box->link );
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
		<?php } ?>
	<?php } ?>
</div>