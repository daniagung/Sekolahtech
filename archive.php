<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */

get_header();
$layout     = utouch_sidebar_conf();
$items_design = fw_get_db_customizer_option('portfolio_layout_design/value', 'apps');
$grid_item_classes = '';

if ( 'full' !== $layout['position'] ) {
	Utouch::set_var( 'utouch_sidebar_enabled', true );
	if ( 'grid' === $items_design ) {
		$grid_item_classes .= ' col col-lg-6 col-md-6 col-sm-12';
	} else {
		$grid_item_classes .= ' col col-lg-12 col-md-12 col-sm-12';
	}
} else {
	if ( 'grid' === $items_design ) {
		$grid_item_classes .= ' col col-lg-4 col-md-6 col-sm-12';
	} else {
		$grid_item_classes .= ' col col-lg-6 col-md-6 col-sm-12';
	}
}

$main_class = 'full' !== $layout['position'] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
set_query_var( 'post_excerpt', get_option( 'rss_use_excerpt' ) );
set_query_var( 'post_layout', $layout['position'] );



?>

	<div id="primary" class="container">
		<div class="row medium-padding30">

			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<main id="main" class="<?php echo esc_attr( $main_class ) ?>">

                    <?php
                    if ( is_author() ) {
                        get_template_part( 'parts/author', 'box' );
                    }
                    get_template_part( 'parts/portfolio/term-list' );
                    ?>

					<?php
					if ( have_posts() ) :
						$queried_object = get_queried_object();

						if ( is_tax() && 'fw-event-taxonomy-name' === $queried_object->taxonomy ) {

							Utouch::set_var('event_preview_size','small');
							?>
							<div class="row">
								<div class="curriculum-event-wrap case-item-wrap portfolio-loop"
									 data-layout="packery" id="event-loop">
									<?php while ( have_posts() ) : the_post();
										get_template_part( 'parts/event/preview/item-style-' . Utouch::get_event( get_the_ID() )->preview_style );
									endwhile;
									?>
								</div>
							</div>
							<?php
						} elseif ( is_tax() && 'fw-portfolio-category' === $queried_object->taxonomy ) {

							?>
							<div class="row  case-item-wrap portfolio-loop" data-layout="packery" id="portfolio-loop">
								<?php while ( have_posts() ) : the_post(); ?>
                                    <div class="<?php echo esc_attr( $grid_item_classes ); ?>">
										<?php get_template_part( 'parts/portfolio/loop_item', $items_design ); ?>
                                    </div>
								<?php endwhile; ?>
							</div>
							<?php
						} else {

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								$format = get_post_format();
								if ( false === $format ) {
									$format = 'standard';
								}

								get_template_part( 'post-format/post', $format );

							endwhile;
						}


						utouch_paging_nav();

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
