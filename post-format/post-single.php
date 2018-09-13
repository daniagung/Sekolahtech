<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */


$template_post = Utouch::template_post();

$format = get_post_format();
if ( false === $format ) {
	$format = 'standard';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post post-standard-details' ); ?>>
	<?php if ( $template_post->show_featured ) : ?>

		<?php
		if ( 'gallery' === $format ) {
			$gallery_images = Utouch::options()->get_option( 'gallery_images', array(), Utouch_Options::SOURCE_POST );

			?>
			<div class="swiper-container post-standard-thumb-slider">

				<div class="swiper-wrapper">
					<?php
					foreach ( $gallery_images as $image ) {
						?>
						<div class="post-thumb swiper-slide">
							<img src="<?php echo esc_url( $image['url'] ) ?>" alt="gallery">
						</div>
						<?php
					}
					?>

				</div>

				<!-- If we need pagination -->
				<div class="swiper-pagination pagination-white"></div>


			</div>

		<?php } else { ?>
			<div class="post-thumb">
				<?php
				if ( 'video' === $format ) {
					$video_oembed = Utouch::options()->get_option( 'video_oembed', '', Utouch_Options::SOURCE_POST );

					echo wp_oembed_get( $video_oembed,array('width'=>'1200px'));

				} elseif ( 'audio' === $format ) {
					$audio_oembed = Utouch::options()->get_option( 'audio_oembed', array(), Utouch_Options::SOURCE_POST );
					echo wp_oembed_get( $audio_oembed, array(
						'width'  => 'full',
						'height' => 'full'
					) );
				} elseif ( 'standard' === $format && has_post_thumbnail() ) {
					the_post_thumbnail( 'full-width', array(
						'title'	=> esc_attr( get_the_title(get_post_thumbnail_id())),
					));
				} ?>
			</div>
		<?php } ?>
	<?php endif; ?>

	<?php get_template_part( 'parts/post/single', 'content' ); ?>
</article>

<?php
if ( $template_post->show_author_box ) {
	get_template_part( 'parts/author', 'box' );
} ?>
