<?php
/** @var array $atts */
global $allowedtags;
$title = $subtitle = $class = $align = $type = $tag = $title_link = $post_title = $el_class = $link_title = $link_target = $title_delim = $inline_link = $link_html = '';

extract( $atts );

if ( empty( $type ) ) {
	$type = 'h1';
}

$wrap_class   = apply_filters( 'kc-el-class', $atts );
$wrap_class[] = 'crumina-module';
$wrap_class[] = 'crumina-heading';
$wrap_class[] = $align;
$wrap_class[] = $class;


if ( $post_title == 'yes' ) {
	$the_title = get_the_title();
	if ( ! empty( $the_title ) ) {
		$title = esc_attr( $the_title );
	}
}
if ( 'yes' === $show_link ) {
	$el_class .= ' ' . $type;
	$type = 'a';
	$link        = explode( '|', $link );
	$link_href   = array_key_exists( 0, $link ) ? $link[0] : "";
	$link_target = array_key_exists( 2, $link ) ? $link[2] : "_self";

}
$el_class .= ' heading-title';
?>
<header class="<?php echo esc_attr( implode( ' ', $wrap_class ) ); ?>">
	<?php if ( ! empty( $top_label ) ) { ?>
		<h6 class="heading-sup-title"><?php echo esc_html( $top_label ); ?></h6>
	<?php } ?>

	<?php if ( ! empty( $title ) ) { ?>
	<?php
	$title_atts['class'] = $el_class;
	if('yes' === $show_link){
		$title_atts['href'] = $link_href;
		$title_atts['target'] = $link_target;
	}
	echo utouch_html_tag($type,$title_atts, wp_kses( wp_specialchars_decode( $title ), $allowedtags ));
	?>
<?php } ?>

<?php if ( ! empty( $subtitle ) ) { ?>
	<div class="heading-text"><?php echo esc_html( $subtitle ) ?></div>
<?php } ?>

</header>
