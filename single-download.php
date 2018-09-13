<?php
/**
 * The template for displaying easy digital downloads products.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Utouch
 */

get_header();
$layout          = utouch_sidebar_conf();
$main_class      = 'full' !== $layout['position'] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
$container_width = 'container';
$padding_class   = 'medium-padding120';
$builder_meta    = get_post_meta( get_the_ID(), 'kc_data', true );
if ( isset( $builder_meta['mode'] ) && 'kc' === $builder_meta['mode'] && 'full' === $layout['position'] ) {
	$container_width = 'page-builder-wrap';
	$padding_class   = '';
} ?>
    <div id="primary" class="<?php echo esc_attr( $container_width ) ?>">
        <div class="row <?php echo esc_attr( $padding_class ) ?>">
            <div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
                <main id="main" class="<?php echo esc_attr( $main_class ) ?>">

					<?php
					while ( have_posts() ) : the_post(); ?>
                        <div class="entry-content">
							<?php if ( ! Utouch::template_stunning()->show && isset( $builder_meta['mode'] ) && 'kc' !== $builder_meta['mode'] ) { ?>
                                <header class="entry-header">
									<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                                </header><!-- .entry-header -->
							<?php } ?>
							<?php if ( ! isset( $builder_meta['mode'] ) || 'kc' !== $builder_meta['mode'] ) { ?>
                                <div class="post-thumb">
									<?php the_post_thumbnail( 'full-width', array(
										'title' => esc_attr( get_the_title( get_post_thumbnail_id() ) ),
									) ); ?>
                                </div>
                                <div class="post__content">

									<?php the_content(); ?>

									<?php wp_link_pages( array(
										'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'utouch' ),
										'after'  => '</div>',
									) );
									?>
                                </div>
							<?php } else {
								the_content();
							} ?>

                        </div><!-- .entry-content -->

						<?php if ( get_edit_post_link() ) : ?>
                            <footer class="entry-footer">
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
                            </footer><!-- .entry-footer -->
						<?php endif; ?>
					<?php endwhile; // End of the loop.
					?>

                </main><!-- #main -->
            </div>
			<?php if ( 'full' !== $layout['position'] ) { ?>
                <div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
					<?php get_sidebar(); ?>
                </div>
			<?php } ?>
        </div><!-- #row -->
    </div><!-- #primary -->
<?php
get_footer();