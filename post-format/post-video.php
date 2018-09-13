<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */
$template_blog = Utouch::template_blog();
$video_oembed  = Utouch::options()->get_option( 'video_oembed', array(), Utouch_Options::SOURCE_POST );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard video' ); ?>>

	<?php if ( $template_blog->show_featured && ! empty( $video_oembed ) ) { ?>
		<div class="post-thumb">
			<?php
			if ( has_post_thumbnail() ) {
				$post_thumbnail_id = get_post_thumbnail_id( $post );
				$image_url         = wp_get_attachment_image_url( $post_thumbnail_id, 'full' );

				$image_url = utouch_resize( $image_url, 800, 430, true );
				?>
				<img src="<?php echo esc_url( $image_url ) ?>" alt="video">
				<div class="overlay-standard"></div>
				<a href="<?php echo esc_url( $video_oembed ) ?>" class="video-control js-popup-iframe">
					<img src="<?php echo get_template_directory_uri() ?>/img/play.png" alt="play">
				</a>
				<?php
			} else {
				echo wp_oembed_get( $video_oembed, array( 'width' => '1200px' ) );
			}
			?>

		</div>
	<?php } ?>

	<?php get_template_part( 'parts/post/blog', 'content' ) ?>

</article>
