<?php
/**
 * Template part for displaying portfolio short content.
 *
 * @package Utouch
 */

$portfolio  = Utouch::get_portfolio( get_the_ID() );
$img_width  = 460;
$img_height = 820;
$summary_class   = array();
$summary_class[] = '';
if ( 'skew' === $portfolio->summary_row_style ) {
	$summary_class[] = 'bg-skew';
}

$style = $portfolio->style_bg_color;

if('skew' !== $portfolio->summary_row_style){
	$style .= $portfolio->style_bg_image;
}

global $allowedposttags;
?>
<section class="<?php echo implode( ' ', $summary_class ) ?>" style="<?php echo esc_attr( $style ) ?>;">
	<div class="container">
		<div class="row medium-padding100">
			<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
				<div class="crumina-module crumina-heading align-center c-white custom-color" style="<?php echo esc_attr( $portfolio->style_text_color ) ?>">
					<?php echo utouch_html_tag( 'h2', array( 'class' => 'h1 heading-title' ), esc_html( $portfolio->title ) ); ?>
					<div class="heading-text"><?php echo wp_kses( $portfolio->desc, $allowedposttags ); ?></div>
					<?php
					foreach ( $portfolio->buttons as $btn_data ) {

						Utouch_Helper_Html::new_button( $btn_data );
					} ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
				<div class="align-center">
					<?php
					$thumbnail_id = get_post_thumbnail_id();
					if ( ! empty( $thumbnail_id ) ) {
						$thumbnail       = get_post( $thumbnail_id );
						$image           = utouch_resize( $thumbnail->ID, $img_width, $img_height, true );
						$thumbnail_title = $thumbnail->post_title;
					} else {
						$image           = fw()->extensions->get( 'portfolio' )->locate_URI( '/static/img/no-photo.jpg' );
						$thumbnail_title = $image;
					} ?>
					<img src="<?php echo esc_url( $image ) ?>" width="<?php echo esc_attr( $img_width ) ?>"
						 height="<?php echo esc_attr( $img_height ) ?>" alt="<?php echo esc_attr( $thumbnail_title ) ?>"/>
				</div>
			</div>
		</div>
	</div>
	<?php
	if ( 'skew' === $portfolio->summary_row_style ) {
		echo '<div class="skew-background" style="'.$portfolio->style_bg_image.'"></div>';
	}
	?>

</section>

