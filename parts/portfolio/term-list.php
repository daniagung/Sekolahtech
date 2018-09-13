<?php
$show_portfolio_cats    = false;
$ext_portfolio_instance = Utouch::get_extension( 'portfolio' );
if ( $ext_portfolio_instance ) {
    $ext_portfolio_settings     = $ext_portfolio_instance->get_settings();
    $ext_portfolio_settings_tax = $ext_portfolio_settings[ 'taxonomy_name' ];
    $show_portfolio_cats        = is_tax( $ext_portfolio_settings_tax );
}

if ( !$show_portfolio_cats ) {
    return;
}

$categories = fw_ext_portfolio_get_listing_categories( 0 );

if ( !empty( $categories ) ) {
    ?>
    <ul id="portfolio-filter" class="cat-list-bg-style align-center">
        <?php
        foreach ( $categories as $category ) {
            $active = ( $category->term_id == get_queried_object_id() ) ? 'active' : '';
            ?>
            <li class="cat-list__item <?php echo esc_attr( $active ) ?>">
                <a href="<?php echo esc_url( get_term_link( $category->slug, $taxonomy ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
}