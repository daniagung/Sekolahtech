<?php
/**
 * accordion shortcode
 **/
/** @var array $atts */

$css = $title = $id = $accordion = '';
extract( $atts );

$output = '';

$parent_id = uniqid( 'accordion' );

$css_classes   = apply_filters( 'kc-el-class', $atts );
$css_classes[] = 'crumina-module crumina-accordion';

if ( isset( $class ) ) {
    array_push( $css_classes, $class );
}

$element_attributes = array( 'accordion-group' );

if ( $accordion == 'yes' ) {
    $element_attributes[] = 'panel-group';
}

$css_class = implode( ' ', $css_classes );

?>
<div class="<?php echo esc_attr( trim( $css_class ) ) ?>">
    <div id="<?php echo esc_attr( $parent_id ) ?>" class="<?php echo implode( ' ', $element_attributes ); ?>" role="tablist"  aria-multiselectable="true">
        <?php $content = str_replace( '[crum_accordion_tab', '[crum_accordion_tab id="' . $parent_id . '"', $content ); ?>
        <?php $result_html = do_shortcode( str_replace( 'crum_accordion#', 'crum_accordion', $content ) );
        if ( $accordion !== 'yes' ) {
	        $result_html = str_replace( 'data-parent', 'data-wrapper', $result_html );
        }
        echo( $result_html );
        ?>
    </div>
</div>
