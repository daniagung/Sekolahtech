<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */

$template_blog = Utouch::template_blog();

global $allowedtags;
$content    = get_the_content();
$post_url   = get_url_in_content( $content );
$link_parts = parse_url( $post_url );

if ( has_post_thumbnail() ) {
	$poster_class       = 'custom-bg';
	$post_thumbnail_id  = get_post_thumbnail_id( get_the_ID() );
	$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
	$poster_style       = 'style="background-image:url(' . esc_url( $post_thumbnail_url ) . ');"';
} else {
	$poster_style = '';
	$poster_class = 'bg-green';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard link' ); ?>>
	<?php if ( $template_blog->show_featured ) { ?>

		<div class="post-thumb <?php echo esc_attr( $poster_class ); ?>" <?php echo( $poster_style ) // WPCS: XSS OK. ?>>
			<div class="thumb-content">
				<a href="<?php echo esc_url( $post_url ); ?>"
				   class="h3 thumb-content-title"><?php echo strip_tags( $content ) ?></a>
				<a href="<?php echo esc_url( $post_url ); ?>" class="h6 site-link" rel="nofollow"
				   target="_blank"><?php echo esc_attr( $link_parts['host'] ) ?></a>
				<a href="<?php echo esc_url( $post_url ); ?>" class="post-link">
					<img src="<?php echo get_template_directory_uri()?>/svg/link2.svg" alt="link">
				</a>
			</div>
		</div>

	<?php } ?>

</article>