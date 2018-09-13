<?php
/**
 * @package utouch-wp
 */
$atts = Utouch::get_var( 'crum_image_gallery' );
extract( $atts );

$module_class = utouch_module_class( 'crumina-screenshots', $atts );
$j = 0;
?>

<div class="<?php echo implode( ' ', $module_class ) ?>">
	<?php for ( $i = 0; $i < $cols_count; $i ++ ) { ?>
		<div class="col-item">
			<?php
			if ( ! array_key_exists( $j, $images ) ) {
				echo '</div>';
				continue;
			}
			Utouch::set_var( 'image_gallery_image_id', $images[ $j ] );
			get_template_part( 'parts/kc/image-gallery/image' );

			$j++;

			if ( 0 === $i % 2 || ! array_key_exists( $j, $images ) ) {
				echo '</div>';
				continue;
			}
			Utouch::set_var( 'image_gallery_image_id', $images[ $j ] );
			get_template_part( 'parts/kc/image-gallery/image' );

			$j++;
			?>
		</div>
	<?php } ?>
</div>