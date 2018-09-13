<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */

$template_blog = Utouch::template_blog();


?>


<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard post' ); ?>>

	<?php if ( $template_blog->show_featured && has_post_thumbnail() ) { ?>
		<div class="post-thumb-wrap">
			<div class="post-thumb">
				<img src="<?php echo utouch_resize( wp_get_attachment_image_url( get_post_thumbnail_id(), 'ful-size' ), 800, 450, true ) ?>"
                     alt="<?php echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); ?>"
                    title="<?php echo esc_attr( get_the_title(get_post_thumbnail_id()) ); ?>"/>

				<a href="<?php the_post_thumbnail_url( 'full' ); ?>" class="link-image js-zoom-image">
					<svg class="utouch-icon utouch-icon-zoom-increasing-button-outline">
						<use xlink:href="#utouch-icon-zoom-increasing-button-outline"></use>
					</svg>
				</a>
				<a href="<?php the_permalink() ?>" class="link-post">
					<svg class="utouch-icon utouch-icon-link-chain">
						<use xlink:href="#utouch-icon-link-chain"></use>
					</svg>
				</a>
				<div class="overlay-standard overlay--blue-dark"></div>
			</div>
		</div>
	<?php } ?>

	<?php get_template_part( 'parts/post/blog', 'content' ) ?>

</article>
