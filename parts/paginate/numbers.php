<?php
$the_query = get_query_var( 'portfolio-ajax-query' );

if ( !$the_query ) {
    return '';
}

$links = paginate_links( array(
    'base'      => '%_%',
    'format'    => '?page=%#%',
    'total'     => $the_query->max_num_pages,
    'current'   => $the_query->get( 'paged' ),
    'mid_size'  => 3,
    'prev_next' => false,
) );

if ( !$links ) {
    return '';
}

ob_start();
get_template_part( 'parts/spinner' );
$spinner = ob_get_clean();

$links = preg_replace( array( '/page-numbers/', '/href\=\'\'/', '/href=\"\"/', '/(\<a .+?\>)(.+?)(\<\/a\>)/' ), array( 'page-numbers ajax-paginate-link bg-border-color', 'href="?page=1"', 'href="?page=1"', '$1<span class="load-more-text">$2</span>' . $spinner . '$3' ), $links );
?>

<div class="row">
    <div class="col-lg-12">
        <nav class="navigation">
            <?php echo( $links ); ?>
        </nav>
    </div>
</div>
