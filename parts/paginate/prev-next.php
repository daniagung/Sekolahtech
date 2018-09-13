<?php
$the_query = get_query_var( 'portfolio-ajax-query' );

if ( !$the_query ) {
    return '';
}

$page = $the_query->get( 'paged' );
$max  = $the_query->max_num_pages;
$prev = $page - 1;
$next = $page + 1;
?>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
        <div class="btn-slider-wrap pt80">
            <nav class="navigation navigation-prev-next ">
                <?php if ( 1 < $page ) { ?>
                    <a class="prev ajax-paginate-link" href="<?php echo esc_attr( "?page={$prev}" ) ?>">
                        <div class="btn-prev btn--style">
                            <div class="load-more-text">
                                <svg class="utouch-icon icon-hover utouch-icon-arrow-left-1"><use xlink:href="#utouch-icon-arrow-left-1"></use></svg>
                                <svg class="utouch-icon utouch-icon-arrow-left1"><use xlink:href="#utouch-icon-arrow-left1"></use></svg>
                                <span>Prev Page</span>
                            </div>
                            <?php get_template_part( 'parts/spinner' ); ?>
                        </div>
                    </a>
                <?php } ?>
                <?php if ( $page < $max ) { ?>
                    <a class="next ajax-paginate-link" href="<?php echo esc_attr( "?page={$next}" ) ?>">
                        <div class="btn-next btn--style">
                            <div class="load-more-text">
                                <span>Next Page</span>
                                <svg class="utouch-icon icon-hover utouch-icon-arrow-right-1"><use xlink:href="#utouch-icon-arrow-right-1"></use></svg>
                                <svg class="utouch-icon utouch-icon-arrow-right1"><use xlink:href="#utouch-icon-arrow-right1"></use></svg>
                            </div>
                            <?php get_template_part( 'parts/spinner' ); ?>
                        </div>
                    </a>
                <?php } ?>
            </nav>
        </div>
    </div>
</div>