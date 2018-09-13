<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 */
Utouch::set_var( 'custom_stunning_taxonomy', 'fw-portfolio-category' );

$layout          = utouch_sidebar_conf( true );
$container_width = 'container';
$padding_class   = 'medium-padding30';
$builder_meta    = get_post_meta( get_the_ID(), 'kc_data', true );
if ( isset( $builder_meta['mode'] ) && 'kc' === $builder_meta['mode'] && 'full' === $layout['position'] ) {
	$container_width = 'page-builder-wrap';
	$padding_class   = '';
}
$portfolio = Utouch::get_portfolio( get_the_ID() );
get_header(); ?>
	<div id="primary">

		<?php while ( have_posts() ) : the_post();
			?>
		<div class="<?php echo esc_attr( $container_width ) ?>">
			<div class="row <?php echo esc_attr( $padding_class ) ?>">

				<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
					<main id="main" class="site-main">
						<?php
						the_content();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>
					</main><!-- #main -->
				</div>
				<?php if ( 'full' !== $layout['position'] ) { ?>
					<div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
						<?php get_sidebar(); ?>
					</div>
				<?php ?>
			</div><!-- #row -->
		</div>
			<?php }
		endwhile; // End of the loop.
		?>
	</div><!-- #primary -->
</div>
	</div>
<?php
get_footer();
