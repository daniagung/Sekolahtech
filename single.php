<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Utouch
 */

get_header();
$layout        = utouch_sidebar_conf();
$main_class    = 'full' !== $layout['position'] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
$padding_class = 'medium-padding30';
$builder_meta  = get_post_meta( get_the_ID(), 'kc_data', true );
if ( isset( $builder_meta['mode'] ) && 'kc' === $builder_meta['mode'] && 'full' === $layout['position'] ) {
	$padding_class = '';
} ?>

	<div id="primary" class="container">
		<div class="row <?php echo esc_attr( $padding_class ) ?>">
			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<main id="main" class="<?php echo esc_attr( $main_class ) ?>"  >

					<?php if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							$format = get_post_format();
							if ( 'quote' === $format || 'link' === $format ) {
								get_template_part( 'post-format/post', $format );
							} else {
								get_template_part( 'post-format/post', 'single' );
							}

							if ( Utouch::template_post()->show_related ) {
								get_template_part( 'parts/post/navigation' );
							}
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						endwhile;

					else :

						get_template_part( 'parts/content', 'none' );

					endif; ?>

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
