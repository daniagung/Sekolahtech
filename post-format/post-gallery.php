<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */

$template_blog = Utouch::template_blog();

$gallery_images = Utouch::options()->get_option( 'gallery_images', array(), Utouch_Options::SOURCE_POST );

?>


<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard post slider' ); ?>>

	<?php if ( $template_blog->show_featured ) { ?>

		<div class="swiper-container post-standard-thumb-slider">

			<div class="swiper-wrapper">
				<?php
				foreach ( $gallery_images as $image ) {
					?>
					<div class="post-thumb swiper-slide">
						<img src="<?php echo esc_url(utouch_resize($image['url'],1100,550,true))?>" alt="gallery">
					</div>
					<?php
				}
				?>

			</div>

			<!-- If we need pagination -->
			<div class="swiper-pagination pagination-white"></div>


		</div>
	<?php } ?>

	<?php get_template_part( 'parts/post/blog', 'content' ) ?>

</article>
