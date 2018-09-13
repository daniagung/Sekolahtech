<?php
/**
 * @package utouch-wp
 */

$template_blog = Utouch::template_blog();

?>
<div class="post__content">

	<?php
	if ( $template_blog->show_share ) {
		get_template_part( 'parts/post/share', 'dropdown' );
	}
	?>

	<?php
	if ( $template_blog->show_meta ) {
		get_template_part( 'parts/post/modified' );
	}
	?>

	<div class="post__content-info">

		<h2  class="h5 post__title entry-title"><a  rel="bookmark" href="<?php the_permalink()?>"><?php the_title() ?></a></h2>

			<?php
			if ( ! has_excerpt() ) {
				the_content();
			} else {
				the_excerpt();
			}
			?>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'utouch' ),
				'after'  => '</div>',
			) );
			?>

		<div class="post-additional-info">
			<?php if ( $template_blog->show_author ) {
				utouch_post_author( get_the_author_meta( 'ID' ) );
			} ?>

			<?php if ( $template_blog->show_meta ) {
				utouch_comments_count();
			} ?>
			<a href="<?php the_permalink()?>" class="btn-next">
				<svg class="utouch-icon icon-hover utouch-icon-arrow-right-1"><use xlink:href="#utouch-icon-arrow-right-1"></use></svg>
				<svg class="utouch-icon utouch-icon-arrow-right1"><use xlink:href="#utouch-icon-arrow-right1"></use></svg>
			</a>

		</div>

	</div>
</div>

