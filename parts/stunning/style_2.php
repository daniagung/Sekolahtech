<?php
$user = wp_get_current_user();
$stunning = Utouch::template_stunning();
$classes = $stunning->classes;
$classes[] = 'stunning-header--breadcrumbs-bottom-left';
$classes[] = 'stunning-header--content-padding100';
$classes[] = 'c-white';
$classes[] = 'fill-white';
$classes[] = 'custom-color';
?>

<div id="stunning-section" class="<?php Utouch_Helper_Html::attr_class( $classes ) ?>" ><!--inline-css-->
	<?php
	if ( Utouch_Template_Stunning::BG_TYPE_VIDEO === $stunning->bg_type ) {
		Utouch_Helper_Html::bg_video_layer( $stunning->video_attr );
	}
	if ( Utouch_Template_Stunning::BG_TYPE_IMAGE === $stunning->bg_type && Utouch_Template_Stunning::BG_EFFECT_TILT === $stunning->bg_effect ) {
		Utouch_Helper_Html::bg_image_tilt( $stunning->bg_image );
	}
	?>
	<div class="container">
		<div class="stunning-header-content">
			<?php $stunning->category_html( 'h6' ) ?>
			<?php $stunning->title_html( 'h4' ) ?>
			<?php $stunning->sub_title_html( 'h6' ) ?>


			<?php if ( is_singular() && ( $stunning->author || $stunning->additional ) ) {
				?>
				<div class="inline-items">
					<?php
					if ( $stunning->author ) {

						get_template_part( 'parts/stunning/author' );
					} ?>
					<?php if ( $stunning->additional ) {
						get_template_part( 'parts/stunning/date' );
					} ?>
				</div>
				<?php
			} ?>
			<?php
			foreach($stunning->buttons as $button){
				Utouch_Helper_Html::button($button);
			}
			?>

			<?php
			if ($stunning->breadcrumbs && function_exists( 'fw_ext_breadcrumbs' ) && ! is_home() && ! is_front_page() && ! is_search()&& ! is_author() ) {

				?>
				<div class="breadcrumbs-wrap inline-items c-black custom-color">

					<a href="<?php echo esc_url(home_url())?>" class="btn btn--black btn--round breadcrumbs-custom">
						<svg class="utouch-icon utouch-icon-home-icon-silhouette breadcrumbs-custom"><use xlink:href="#utouch-icon-home-icon-silhouette"></use></svg>
					</a>

					<div class="breadcrumbs breadcrumbs--rounded">
						<?php fw_ext_breadcrumbs( '<svg class="utouch-icon utouch-icon-media-play-symbol breadcrumbs-custom"><use xlink:href="#utouch-icon-media-play-symbol"></use></svg>' );?>
					</div>
				</div>
				<?php
			}
			?>

		</div>
	</div>

	<?php Utouch_Helper_Html::overlay( $stunning->overlay_color ) ?>
</div>
