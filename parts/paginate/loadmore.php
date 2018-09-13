<?php
$the_query = get_query_var( 'portfolio-ajax-query' );

if ( !$the_query ) {
    return '';
}

$page = $the_query->get( 'paged' );
$max  = $the_query->max_num_pages;
$next = ($page < $max) ? $page + 1 : 0;
?>

<div class="align-center">
    <a href="<?php echo esc_attr( "?page={$next}" ); ?>" class="ajax-paginate-link btn btn-border btn-more btn--primary load-more">
        <span class="load-more-text">
            <?php echo ($page < $max) ? __( 'Load more', 'utouch' ) : __( 'Loaded all', 'utouch' ); ?>
        </span>
        <?php get_template_part( 'parts/spinner' ); ?>
    </a>
</div>