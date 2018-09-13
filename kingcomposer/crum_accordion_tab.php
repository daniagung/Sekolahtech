<?php
/**
 * kc_accordion_tab shortcode
 **/
$id          = $panel_heading_class = $panel_link_class = $panel_content_class = '';
$css_class   = apply_filters( 'kc-el-class', $atts );
$css_class[] = 'accordion-panel';

$title = 'Title';

if ( isset( $atts['id'] ) ) {
	$id = $atts['id'];
}
if ( isset( $atts['title'] ) ) {
	$title = $atts['title'];
}
$open = isset( $atts['open'] ) && $atts['open'] == "yes" ? "true" : "false";

if ( $open === 'true' ) {
	$panel_heading_class = 'active';
	$css_class[] = 'active';
	$panel_content_class = 'collapse in';
} else {
	$panel_link_class    = 'collapsed';
	$panel_content_class = 'collapse';
}

if ( isset( $atts['class'] ) ) {
	array_push( $css_class, $atts['class'] );
}

$tab_id = uniqid( 'tab-' );

$output = '<div class="accordion-panel panel ' . esc_attr( implode( ' ', $css_class ) ) . '">
                            <div class="panel-heading ' . esc_attr( $panel_heading_class ) . '" role="tab">
                                <a href="#' . esc_attr( $tab_id ) . '" class="accordion-heading ' . esc_attr( $panel_link_class ) . '" data-toggle="collapse" data-parent="#' . esc_attr( $id ) . '" aria-expanded="' . esc_attr( $open ) . '" aria-controls="' . esc_attr( $tab_id ) . '" role="button">
                                        <span class="icons">
										<svg class="utouch-icon utouch-icon-add"><use xlink:href="#utouch-icon-add"></use></svg>
										<svg class="utouch-icon active utouch-icon-minus"><use xlink:href="#utouch-icon-minus"></use></svg>
									</span>
                                    <span class="ovh title">' . esc_html( $title ) . '</span>
                                </a>
                            </div>
                            <div id="' . esc_attr( $tab_id ) . '" class="panel-collapse ' . esc_attr( $panel_content_class ) . '" aria-expanded="false" role="tabpanel">
                                <div class="panel-info">
                                    ' .
          ( ( '' === trim( $content ) )
	          ? esc_html__( 'Empty section. Edit page to add content here.', 'utouch' )
	          : do_shortcode( str_replace( 'kc_accordion_tab#', 'kc_accordion_tab', $content ) ) ) .
          '
                                </div>
                            </div>
                        </div>';

echo ( $output );