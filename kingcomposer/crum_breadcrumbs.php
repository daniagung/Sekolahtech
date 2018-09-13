<?php
/**
 * @package utouch-wp
 */
if(!function_exists( 'fw_ext_breadcrumbs' )){
	return;
}
$module_class = utouch_module_class( 'crumina-module-breadcrumb', $atts );

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
	<div class="breadcrumbs-wrap inline-items">

		<a href="<?php echo esc_url(home_url())?>" class="btn btn--transparent btn--round">
			<svg class="utouch-icon utouch-icon-home-icon-silhouette"><use xlink:href="#utouch-icon-home-icon-silhouette"></use></svg>
		</a>

		<div class="breadcrumbs">
			<?php fw_ext_breadcrumbs( '<svg class="utouch-icon utouch-icon-media-play-symbol"><use xlink:href="#utouch-icon-media-play-symbol"></use></svg>' );?>
		</div>
	</div>

</div>
