<?php
$desc = $custom_class = $list_icon = $icon = $icon_color = '';

$wrap_class = apply_filters( 'kc-el-class', $atts );

extract( $atts );

$wrap_class[] = 'crumina-module';
$wrap_class[] = 'crumina-module-list';

if ( ! empty( $custom_class ) ) {
	$wrap_class[] = $custom_class;
}

$content = do_shortcode( $desc );

if ( 'number' === $list_icon ) {
	$wrap_class[] = 'list styled-list';
	$content = str_replace('<ul','<ol',$content);
	$content = str_replace('</ul>','</ol>',$content);

} else {
	$wrap_class[] = 'list';
	if ( 'check' === $list_icon ) {
		$content = str_replace( '<li>', '<li><svg class="utouch-icon utouch-icon-correct-symbol-1"><use xlink:href="#utouch-icon-correct-symbol-1"></use></svg><div class="ovh">', $content );
	} elseif ( 'check_circle' === $list_icon ) {
		$content = str_replace( '<li>', '<li><svg class="utouch-icon utouch-icon-checked"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#utouch-icon-checked"></use></svg><div class="ovh">', $content );
	}elseif('custom' === $list_icon){
		$content = str_replace('<li>','<li><i class="utouch-icon '.$icon.'"></i><div class="ovh">',$content);
	}
	$content = str_replace('</li>','</div></li>',$content);

}
?>

<div class="<?php echo esc_attr( implode( " ", $wrap_class ) ); ?>" data-icon="<?php echo esc_attr( $icon ) ?>">
	<?php echo( $content ) ?>
</div>
