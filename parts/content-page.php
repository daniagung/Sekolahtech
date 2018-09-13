<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */
$show_stunning = get_query_var( 'show_stunning' );
$builder_meta  = get_post_meta( get_the_ID(), 'kc_data', true );

?>

<div id="page-<?php the_ID(); ?>">

	<div class="entry-content">
		<?php if ( ! Utouch::template_stunning()->show && isset( $builder_meta['mode'] ) && 'kc' !== $builder_meta['mode'] ) { ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		<?php } ?>
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'utouch' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
				/* translators: %s: Name of current post */
					esc_html__( 'Edit', 'utouch' )),
				'',
				'',
				0,
				'post-edit-link btn btn--green'
			);

			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</div><!-- #post-## -->
