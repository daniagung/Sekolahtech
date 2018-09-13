<?php
/** @var array $atts */
$effect       = $loop = $autoscroll = $slider_autoplay_attr = '';
$wrap_class   = apply_filters( 'kc-el-class', $atts );
$time         = 10;
$wrap_class[] = 'crumina-module-slider';
extract( $atts );

if ( ! empty( $el_class ) ) {
	$wrap_class[] = $el_class;
}
if ( ! isset( $effect ) || empty( $effect ) ) {
	$effect = 'slide';
}
$loop = isset( $loop ) && $loop === 'yes' ? 'true' : 'false';
if ( isset( $autoscroll ) && 'yes' === $autoscroll ) {
	$slider_autoplay_attr = 'data-autoplay="' . esc_attr( intval( $time ) * 1000 ) . '"';
}

preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches );

$i   = 1;
$all = 0;
if ( isset( $matches[0] ) ) {
	$all = count( $matches[0] );
}
?>
<?php if ( isset( $_GET['kc_action'] ) && $_GET['kc_action'] === 'live-editor' ) {
	?>
	<div style="width: 100%;">
		<h1 class=" heading-title">Not available to edit on frontend</h1>
		<div class="heading-decoration"><span class="first"></span><span class="second"></span></div>
		<h5>For best performance, the Module has been disabled in frontend editing mode. Please
			use Backend editor</h5>
	</div>

<?php } else { ?>
	<div class="<?php echo implode( ' ', $wrap_class ) ?>">
		<?php if ( $all > 0 ) { ?>
		<!-- Slider main container -->
		<div class="swiper-container navigation-bottom swiper-container-horizontal"
			<?php echo esc_attr( $slider_autoplay_attr ) ?>
			 data-loop="<?php echo esc_attr( $loop ) ?>" data-mouse-scroll="false"
			 data-effect="<?php echo esc_attr( $effect ) ?>">
			<div class="slider-slides" >
				<?php for ( $j = 1; $j <= $all; $j ++ ) { ?>
					<a href="#" class="slides-item <?php if ( 1 === $j )
						echo 'slide-active' ?>">
						<?php echo( $j ); ?>
					</a>
				<?php } ?>
			</div>
			<div class="swiper-wrapper">
				<?php foreach ( $matches[0] as $single_shortcode ) {
					echo '<div class="swiper-slide" data-data-swiper-slide-index="'.($i-1).'">';
					echo do_shortcode( $single_shortcode );
					echo '</div>';
					$i ++;
				}
				} ?>
			</div>
			<div class="btn-slider-wrap navigation-left-bottom">

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
		</div>
	</div>
<?php } ?>