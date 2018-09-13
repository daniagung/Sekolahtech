<?php
/**
 * Template Name: Portfolio
 */
$ext_portfolio_instance = Utouch::get_extension( 'portfolio' );
if ( !$ext_portfolio_instance ) {
    die( __( 'Portfolio extension needed!', 'utouch' ) );
}

get_header();
$the_query              = utouch_custom_loop( 'fw-portfolio' );
$ext_portfolio_settings = $ext_portfolio_instance->get_settings();

$taxonomy   = $ext_portfolio_settings[ 'taxonomy_name' ];
$term       = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
$term_id    = (!empty( $term->term_id ) ) ? $term->term_id : 0;
$categories = fw_ext_portfolio_get_listing_categories( $term_id );

$page_title   = '' !== get_the_excerpt() ? get_the_excerpt() : get_the_title();
$layout       = utouch_sidebar_conf();
$items_design = fw_get_db_customizer_option('portfolio_layout_design/value', 'apps');
$sort_panel   = fw_get_db_post_option( get_the_ID(), 'sorting_panel/value', 'yes' );
$sort_type    = fw_get_db_post_option( get_the_ID(), 'sorting_panel/yes/action', 'sort' );
$pagination   = fw_get_db_post_option( get_the_ID(), 'pagination_type', false );
$read_more    = fw_get_db_post_option( get_the_ID(), 'more_text', esc_html__( 'View Case', 'utouch' ) );

if ( "View Case" == $read_more || empty( $read_more ) ) {
	$read_more    = fw_get_db_customizer_option( 'portfolio_more_text', esc_html__( 'View Case', 'utouch' ) );
}

$meta_terms   = fw_get_db_post_option( get_the_ID(), 'taxonomy_select' );
$meta_exclude = fw_get_db_post_option( get_the_ID(), 'exclude' );

$grid_item_classes = '';

set_query_var( 'read-more-text', $read_more );
set_query_var( 'portfolio-ajax-query', $the_query );

if ( 'sort' === $sort_type ) {
    $filter_id  = 'ajax-portfolio-filter';
    $grid_id    = 'ajax-portfolio-grid';
    $grid_class = '';
} else {
    $grid_item_classes .= ' sorting-item';
    $filter_id         = 'portfolio-filter';
    $grid_id           = 'portfolio-loop';
    $grid_class        = 'sorting-container';
}

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

$listing_classes = fw_ext_portfolio_get_sort_classes( $the_query->posts, $categories );
$loop_data = array(
	'settings'          => $ext_portfolio_instance->get_settings(),
	'categories'        => $categories,
	'items_design'       => $items_design,
	'listing_classes'   => $listing_classes,
	'grid_item_classes' => $grid_item_classes
);
set_query_var( 'fw_portfolio_loop_data', $loop_data );
?>
<!-- Case Item -->
<div id="primary" class="container">
    <div class="row medium-padding30">
        <div class="<?php echo esc_attr( $layout[ 'content-classes' ] ) ?>">
            <main id="main" class="site-main">
                <div id="page-content" class="ovh">
                    <?php
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
                <?php if ( $the_query->have_posts() ) { ?>
                    <?php if ( !empty( $categories ) && 'no' !== $sort_panel ) : ?>
                        <ul id="<?php echo esc_attr( $filter_id ); ?>" class="cat-list-bg-style align-center">
                            <?php if ( 'sort' === $sort_type ) { ?>
                                <li class="cat-list__item active">
                                    <a href="#" data-cat="0" class="filter-btn">
                                        <span> <?php esc_html_e( 'All Projects', 'utouch' ); ?></span>
                                        <?php get_template_part( 'parts/spinner' ); ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php foreach ( $categories as $category ) { ?>
                                <?php
                                if ( !empty( $meta_terms ) && (($meta_exclude && in_array( $category->term_id, $meta_terms )) || (!$meta_exclude && !in_array( $category->term_id, $meta_terms )) ) ) {
                                    continue;
                                }
                                ?>
                                <?php if ( 'sort' === $sort_type ) { ?>
                                    <li class="cat-list__item">
                                        <a data-cat="<?php echo esc_attr( $category->term_id ); ?>" href="#" class="filter-btn">
                                            <span><?php echo esc_html( $category->name ); ?></span>
                                            <?php get_template_part( 'parts/spinner' ); ?>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <?php $active = ( $category->term_id == $term_id ) ? 'active' : ''; ?>
                                    <li class="cat-list__item <?php echo esc_attr( $active ) ?>">
                                        <a href="<?php echo esc_url( get_term_link( $category->slug, $taxonomy ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    <?php endif; ?>
                    <div id="<?php echo esc_attr( $grid_id ); ?>" class="row case-item-wrap portfolio-loop <?php echo esc_attr( $grid_class ); ?>"
                         data-id="<?php echo esc_attr( get_the_ID() ); ?>"
                         data-page="<?php echo esc_attr( $the_query->get( 'paged' ) + 1 ); ?>"
                         data-nonce="<?php echo esc_attr( wp_create_nonce( '_utouch_ajax_portfolio' ) ); ?>"
                         data-url="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>"
                         data-pagination="<?php echo esc_attr( $pagination ); ?>"
                         data-items_design="<?php echo esc_attr( $items_design ); ?>"
                         data-read-more="<?php echo esc_attr( $read_more ); ?>"
                         data-data="<?php echo urlencode( json_encode( $loop_data ) ); ?>"
                         data-layout="packery">
                             <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <div class="<?php echo esc_attr( $grid_item_classes ); ?>">
                                <?php  get_template_part( 'parts/portfolio/loop_item', $items_design );  ?>
                            </div>
                            <?php
                        endwhile;
                        ?>
                    </div>
                    <?php
                    if ( 'sort' === $sort_type ) {
                        ?>
                        <div id="ajax-portfolio-paginate">
                            <?php
                            switch ( $pagination ) {
                                case 'loadmore':
                                    get_template_part( 'parts/paginate/loadmore' );
                                    break;
                                case 'numbers':
                                    get_template_part( 'parts/paginate/numbers' );
                                    break;
                                case 'prev_next':
                                    get_template_part( 'parts/paginate/prev-next' );
                                    break;
                            }
                            ?>
                        </div>
                        <?php
                    } else {
                        switch ( $pagination ) {
                            case 'loadmore':
                                utouch_ajax_loadmore( $the_query, $container_id = 'portfolio-loop' );
                                break;
                            case 'numbers':
                                utouch_paging_nav( $the_query, 'align-center' );
                                break;
                            case 'prev_next':
                                utouch_prev_next_nav( $the_query );
                                break;
                        }
                    }
                    ?>
                <?php } ?>
            </main><!-- #main -->
        </div>
        <?php if ( 'full' !== $layout[ 'position' ] ) { ?>
            <div class="<?php echo esc_attr( $layout[ 'sidebar-classes' ] ) ?>">
                <?php get_sidebar(); ?>
            </div>
        <?php } ?>
    </div><!-- #row -->
</div><!-- #primary -->
<!-- End Case Item -->
<?php
unset( $ext_portfolio_instance );
unset( $ext_portfolio_settings );
set_query_var( 'fw_portfolio_loop_data', '' );

get_footer();
