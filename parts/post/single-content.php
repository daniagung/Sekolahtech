<?php
/**
 * @package utouch-wp
 */

$stunning            = Utouch::template_stunning();
$stunning_with_title = $stunning->show && $stunning->title;
$template_post       = Utouch::template_post();
$builder_meta        = get_post_meta( get_the_ID(), 'kc_data', true );

?>
	<div class="post__content">

		<?php
		if ( $template_post->show_share ) {
			get_template_part( 'parts/post/share', 'dropdown' );
		}
		?>

		<?php
		if ( $template_post->show_meta && ! $stunning_with_title ) {
			Utouch::set_var( 'modified_single', get_the_ID() );
			get_template_part( 'parts/post/modified' );
		}
		?>

		<div class="post__content-info">
			<?php
			if ( !$stunning_with_title ) { ?>

				<h3 class="h3 post__title entry-title"><?php the_title() ?></h3>
			<?php } ?>
			<div class="post-additional-info">
				<?php
				if ( $template_post->show_meta && $stunning_with_title ) {
					Utouch::set_var( 'modified_single', get_the_ID() );
					get_template_part( 'parts/post/modified' );
				}
				?>
				<?php if ( $template_post->show_author ) {
					utouch_post_author( get_the_author_meta( 'ID' ) );
				} ?>

				<?php if ( $template_post->show_meta ) {
					utouch_comments_count();
				} ?>
			</div>

		</div>

		<?php if ( ! Utouch::template_stunning()->show && isset( $builder_meta['mode'] ) && 'kc' !== $builder_meta['mode'] ) { ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		<?php } ?>

		<?php the_content() ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'utouch' ),
			'after'  => '</div>',
		) );
		?>

		<div class="post-details-shared">
			<?php
			edit_post_link(
				sprintf(
				/* translators: %s: Name of current post */
					esc_html__( 'Edit', 'utouch' ) ),
				'',
				'',
				0,
				'post-edit-link btn btn--green'
			);
			?>
			<?php if ( $template_post->show_meta ) {
				get_template_part( 'parts/post/tags' );
			} ?>

			<?php if ( $template_post->show_share ) {
				get_template_part( 'parts/post/share', 'icons' );
			} ?>

		</div>

	</div>

<?php
