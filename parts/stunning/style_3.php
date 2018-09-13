<?php
$user     = wp_get_current_user();
$stunning = Utouch::template_stunning();
$classes  = $stunning->classes;

$classes[] = 'stunning-header--content-center';
$classes[] = 'stunning-header--breadcrumbs-bottom-center';
$classes[] = 'align-center';
$classes[] = 'c-white';
$classes[] = 'fill-white';
$classes[] = 'custom-color';
?>
<div id="stunning-section" class="<?php Utouch_Helper_Html::attr_class( $classes ) ?>"><!--inline-css-->

	<?php
	if ( Utouch_Template_Stunning::BG_TYPE_VIDEO === $stunning->bg_type ) {
		Utouch_Helper_Html::bg_video_layer( $stunning->video_attr );
	}
	if ( Utouch_Template_Stunning::BG_TYPE_IMAGE === $stunning->bg_type && Utouch_Template_Stunning::BG_EFFECT_TILT === $stunning->bg_effect ) {
		Utouch_Helper_Html::bg_image_tilt( $stunning->bg_image );
	}
	?>
	<div class="container">
		<div class="stunning-header-content margin-b-60">
			<?php $stunning->category_html( 'h6' ) ?>
			<?php $stunning->title_html( 'h2' ) ?>
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
			foreach ( $stunning->buttons as $button ) {
				Utouch_Helper_Html::button( $button );
			}
			?>


		</div>

	</div>
	<?php
	if ( $stunning->breadcrumbs && function_exists( 'fw_ext_breadcrumbs' ) && ! is_home() && ! is_front_page() && ! is_search()&& ! is_author() ) {

		?>
		<div class="breadcrumbs-wrap inline-items">


			<div class="breadcrumbs breadcrumbs--semitransparent">
				<?php
				Utouch::set_var( 'breadcrumbs_show_homepage', true );
				fw_ext_breadcrumbs( '<span class="utouch-icon breadcrumbs-custom">/</span>' ); ?>
			</div>
		</div>
		<?php
	}
	?>

	<?php Utouch_Helper_Html::overlay( $stunning->overlay_color ) ?>
</div>


