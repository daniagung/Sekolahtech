<?php
/** @var array $atts */
$_id                  = $js_data = $chart_type = $_class = $css = $wrap_class = $value_color_style = $hide_labels = '';
wp_enqueue_script( 'chart-js' );

extract($atts);

$random_id = 'js_chart_module_' . $_id;
$progress_bar_color_default = '#999999';
$element_attributes = array();
$el_classes = apply_filters( 'kc-el-class', $atts );
$el_classes           = array_merge($el_classes, array(
	'crumina-module',
	'chart-js',
	'chart-js-run',
	$wrap_class,
));
$options = $atts['options'];
$element_attributes[] = 'id="wrap_' . esc_attr( $random_id ) . '"';
$element_attributes[] = 'data-id="' . esc_attr( $random_id ) . '"';
$element_attributes[] = 'data-type="'.esc_attr($chart_type).'"';
$element_attributes[] = 'class="' . esc_attr( implode( ' ', $el_classes ) ) . '"'; ?>

<div <?php echo implode( ' ', $element_attributes ) ?>>
        <canvas id="<?php echo esc_attr( $random_id ) ?>" width="1000" height="1000"></canvas>
<?php if ( isset( $options ) ) { ?>
	<div class="points">
		<?php foreach ( $options as $option ) {
			$prob_style = '';
			$value      = ! empty( $option->value ) ? $option->value : 50;
			$label      = ! empty( $option->label ) ? $option->label : 'Label default';
			$prob_color = ! empty( $option->prob_color ) ? $option->prob_color : '';


			$js_data['number'][] = esc_attr( intval( $value ) );
			$js_data['label'][]  = '"' . esc_attr( $label ) . '"';
			$js_data['color'][]  = '"' . esc_attr( $prob_color ) . '"';

			if ( 'yes' !== $hide_labels){
				if ( $prob_color != '' ) {
					$prob_style .= 'background-color: ' . $prob_color . ';';
				}
				$prob_track_attributes = array();
				$prob_attributes       = array();

				//Progress bars attributes
				$prob_css_classes = array(
					'point-sircle',
					'bg-primary-color',
				);

				$prob_css_class    = implode( ' ', $prob_css_classes );
				$prob_attributes[] = 'class="' . esc_attr( trim( $prob_css_class ) ) . '"';
				$prob_attributes[] = 'style="' . esc_attr( $prob_style ) . '"';
				?>
				<div class="points-item">
					<div class="points-item-count">
						<span <?php echo implode( ' ', $prob_attributes ); ?>></span><?php echo esc_html( $value ) ?>
						<span class="c-gray"> - <?php echo esc_html( $label ); ?></span>
					</div>
				</div>
			<?php }
			} ?>
	</div>
	<div class='chart-data' data-labels='[<?php echo implode( ',', $js_data['label'] ) ?>]'
	     data-numbers='[<?php echo implode( ',', $js_data['number'])  ?>]'
	     data-colors='[<?php echo implode( ',', $js_data['color'])  ?>]'></div>
<?php } ?>
</div>