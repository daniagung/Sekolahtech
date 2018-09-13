<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */

get_header();
$layout = utouch_sidebar_conf();
if ( 'full' !== $layout['position'] ) {
	Utouch::set_var( 'utouch_sidebar_enabled', true );
}
global $allowedposttags;
$author_id = get_queried_object_id();
$description  = get_the_author_meta( 'description',$author_id );
$socials      = get_the_author_meta( 'utouch_social_networks',$author_id );
$socials      = utouch_akg( 'social-networks', $socials, array() );
$main_class = 'full' !== $layout['position'] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
set_query_var( 'post_excerpt', get_option( 'rss_use_excerpt' ) );
set_query_var( 'post_layout', $layout['position'] );
?>

    <div id="primary" class="container">
        <div class="blog-details-author">

            <div class="img-author">
			    <?php echo get_avatar( $author_id, 64 ); ?>
            </div>
            <div class="author-info">
                <a href="<?php echo get_author_posts_url( $author_id ); ?>"
                   class="h6 author-name"><?php the_author_meta( 'display_name', $author_id ); ?></a>
                <p><?php echo wp_kses( $description, $allowedposttags ); ?></p>
            </div>

            <ul class="socials socials--round socials--colored">

			    <?php foreach ( $socials as $social ) { ?>
                    <li>
                        <a href="<?php echo esc_html( $social['link'] ); ?>" target="_blank"
                           class="social__item <?php echo str_replace('.svg','',$social['icon'])?>"><?php $svg_link = get_template_directory_uri() . '/svg/socials/plain/' . $social['icon'];
						    echo utouch_get_svg_icon( $svg_link ); ?></a>
                    </li>
			    <?php } ?>
            </ul>

        </div>
        <div class="row medium-padding30">

            <div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
                <main id="main" class="<?php echo esc_attr( $main_class ) ?>">

					<?php

					if ( have_posts() ) {
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							$format = get_post_format();
							if ( false === $format ) {
								$format = 'standard';
							}
							get_template_part( 'post-format/post', $format );

						endwhile;

						utouch_paging_nav();

					} else {

						 echo utouch_html_tag( 'h2', array(), esc_html__( 'No posts of this author found', 'utouch' ) );

					} ?>

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
