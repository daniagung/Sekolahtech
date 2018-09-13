<?php
/**
 * @package utouch-wp
 */

$module_class   = utouch_module_class( 'crumina-teammembers-slider', $atts );
$module_class[] = 'crumina-module-slider';

$social_classes = array(
	'icons' => 'socials',
	'hover' => 'socials socials--round',
	'bg'    => 'socials socials--round socials--colored',
);
$social_class   = $social_classes[ utouch_akg( 'social_class', $atts, 'icons' ) ];

Utouch::set_var( 'crum_team_slider_social_class', $social_class );
Utouch::set_var( 'crum_team_slider_layout', $atts['layout'] );
?>
<div class="<?php echo implode( ' ', $module_class ) ?>">

	<div class="swiper-container navigation-bottom" data-show-items="2">

		<div class="swiper-wrapper">
			<?php echo do_shortcode( $content ); ?>
		</div>

		<?php if ( 'yes' === $atts['arrows'] ) { ?>
			<div class="btn-slider-wrap navigation-center-bottom">

				<div class="btn-prev">
					<svg class="utouch-icon icon-hover utouch-icon-arrow-left-1">
						<use xlink:href="#utouch-icon-arrow-left-1"></use>
					</svg>
					<svg class="utouch-icon utouch-icon-arrow-left1">
						<use xlink:href="#utouch-icon-arrow-left1"></use>
					</svg>
				</div>

				<div class="btn-next">
					<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1">
						<use xlink:href="#utouch-icon-arrow-right-1"></use>
					</svg>
					<svg class="utouch-icon utouch-icon-arrow-right1">
						<use xlink:href="#utouch-icon-arrow-right1"></use>
					</svg>
				</div>

			</div>
		<?php } ?>
	</div>
</div>
<?php kc_js_callback( 'CRUMINA.initSwiper' ); ?>