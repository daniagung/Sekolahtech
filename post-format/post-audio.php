<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */
$template_blog = Utouch::template_blog();
$audio_oembed = Utouch::options()->get_option( 'audio_oembed', array(), Utouch_Options::SOURCE_POST );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard' ); ?>>

	<?php if ( $template_blog->show_featured && ! empty( $audio_oembed ) ) { ?>
		<div class="post-thumb">
			<?php
			echo wp_oembed_get( $audio_oembed,array(
				'width'  => 'full',
				'height' => 'full'
			) );
			?>
		</div>
	<?php } ?>

	<?php get_template_part('parts/post/blog','content'); ?>

</article>
