<?php

/**
 * @var string $type
 */
$text_title    = $label = $link = $show_icon = $icon = $align = $icon_position = $ex_class = $wrap_class = $color = $size = $shadow = $outlined = $element_id = '';
$icon_position = 'right';
$wrapper_class = apply_filters( 'kc-el-class', $atts );
$button_attr   = array();

extract( $atts );

$link = ( '||' === $link ) ? '' : $link;
$link = kc_parse_link( $link );

$a_target = '';
if ( strlen( $link['url'] ) > 0 ) {
	$a_href   = $link['url'];
	$a_title  = $link['title'];
	$a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}
$wrapper_class[] = 'crumina-module';
$wrapper_class[] = 'crum-button';
if ( ! isset( $a_href ) ) {
	$a_href = "#";
}

if ( ! empty( $wrap_class ) ) {
	$wrapper_class[] = $wrap_class;
}

if ( $align == 'none' ) {
	$wrapper_class[] = 'inline-block';
} else {
	$wrapper_class[] = $align;
}

if ( empty( $color ) ) {
	$color = 'primary';
}
if ( 'regular' === $type ) {

	$el_class   = array();
	$el_class[] = 'btn';
	$el_class[] = 'btn-' . $size; // Size class.
	$el_class[] = 'yes' === $shadow ? 'btn--with-shadow' : ''; // Shadow class
	$el_class[] = 'btn--' . $color; // Color class.
	if ( 'yes' == $outlined ) {
		$el_class[] = 'btn-border';
	}
	if ( 'yes' === $show_icon ) {
		$el_class[] = 'btn--with-icon';
		if ( 'right' === $icon_position ) {
			$el_class[] = 'btn--icon-right';
		}
	}
} else {
	$el_class   = array();
	$el_class[] = 'btn';
	$el_class[] = 'btn-market';
	$el_class[] = 'yes' === $shadow ? 'btn--with-shadow' : ''; // Shadow class
}


if ( ! empty( $ex_class ) ) {
	$el_class[] = $ex_class;
}

if ( ! empty( $el_class ) ) {
	$button_attr[] = 'class="' . esc_attr( implode( ' ', $el_class ) ) . '"';
}

if ( ! empty( $a_href ) ) {
	$button_attr[] = 'href="' . esc_attr( $a_href ) . '"';
}

if ( ! empty( $a_target ) ) {
	$button_attr[] = 'target="' . esc_attr( $a_target ) . '"';
}

if ( ! empty( $a_title ) ) {
	$button_attr[] = 'title="' . esc_attr( $a_title ) . '"';
}

if ( ! empty( $onclick ) ) {
	$button_attr[] = 'onclick="' . $onclick . '"';
}
if ( ! empty( $element_id ) ) {
	$button_attr[] = 'id="' . esc_attr( $element_id ) . '"';
}


?>

<div class="<?php echo implode( " ", $wrapper_class ); ?>">
	<?php if ( 'app-store' === $type ) { ?>
		<a <?php echo implode( ' ', $button_attr ); ?>>
			<img class="utouch-icon" src="<?php echo get_template_directory_uri() ?>/svg/apple-logotype.svg"
				 alt="apple">
			<div class="text">
				<span class="sup-title"><?php echo esc_html__( 'Download on the', 'utouch' ) ?></span>
				<span class="title"><?php echo esc_html__( 'App Store', 'utouch' ) ?></span>
			</div>
		</a>
	<?php } elseif ( 'google-play' === $type ) { ?>
		<a <?php echo implode( ' ', $button_attr ); ?>>
			<img class="utouch-icon" src="<?php echo get_template_directory_uri() ?>/svg/google-play.svg"
				 alt="google">
			<div class="text">
				<span class="sup-title"><?php echo esc_html__( 'Download on the', 'utouch' ) ?></span>
				<span class="title"><?php echo esc_html__( 'Google Play', 'utouch' ) ?></span>
			</div>
		</a>
	<?php } else { ?>
		<a <?php echo implode( ' ', $button_attr ); ?>>
			<?php

			if ( $show_icon == 'yes' ) {
				echo '<i class="utouch-icon ' . esc_attr( $icon ) . '"></i>';
			}
			if ( ! empty( $label ) ) {
				echo '<span class="text">' . esc_html( $label ) . '</span>';
			}

			?>
		</a>
	<?php } ?>
</div>