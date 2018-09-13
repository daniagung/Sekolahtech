<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */

$template_blog = Utouch::template_blog();
$post_options  = Utouch::options()->get_option( '', array(), Utouch_Options::SOURCE_POST );
$quote_author     = utouch_akg( 'quote_author', $post_options, '' );
$quote_dopinfo    = utouch_akg( 'quote_dopinfo', $post_options, '' );
$quote_avatar     = utouch_akg( 'quote_avatar/url', $post_options, '' );
$quote_text_color = utouch_akg( 'quote_text_color', $post_options, '' );

if ( has_post_thumbnail() ) {
	$poster_class       = 'custom-bg';
	$post_thumbnail_id  = get_post_thumbnail_id( get_the_ID() );
	$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
	$poster_style       = 'style="background-image:url(' . esc_url( $post_thumbnail_url ) . ');"';
} else {
	$poster_style = '';
	$poster_class = 'bg-red';
}
$text_style = ! empty( $quote_text_color ) ? 'style="color:' . esc_attr( $quote_text_color ) . ';"' : '';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard post quote' ); ?>>
	<?php if ( $template_blog->show_featured ) { ?>

		<div class="post-thumb <?php echo esc_attr( $poster_class ); ?>" <?php echo( $poster_style ) // WPCS: XSS OK. ?>>
			<div class="testimonial-content">
				<div class="text custom-color" <?php echo( $text_style ) ?>><?php the_content(); ?></div>
				<div class="author-info-wrap">

						<?php if ( ! empty( $quote_avatar ) ) {
							echo '<div class="testimonial-img-author">';
							echo utouch_html_tag( 'img', array(
								'src' => utouch_resize( $quote_avatar, 60, 60, false ),
								'alt' => $quote_author
							), false );
							echo '</div>';
						} ?>
					<?php if ( ! empty( $quote_author ) ) { ?>
					<div class="author-info">
						<?php if ( ! empty( $quote_author ) ) { ?>
							<a class="h6 author-name c-yellow"><?php echo esc_html( $quote_author ) ?></a>
						<?php }
						if ( ! empty( $quote_dopinfo ) ) { ?>
							<div class="author-company c-white"><?php echo esc_html( $quote_dopinfo ) ?></div>
						<?php } ?>
					</div>
					<?php }?>
				</div>
				<div class="quote">
					<img src="<?php echo get_template_directory_uri()?>/img/quote.png" alt="quote">
				</div>
			</div>

		</div>
	<?php } ?>

</article>