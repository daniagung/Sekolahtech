<?php $item_prop = edd_add_schema_microdata() ? ' itemprop="name"' : ''; ?>
<div<?php echo ($item_prop); ?> class="product-item-content">
    <h6 class="title"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
</div>