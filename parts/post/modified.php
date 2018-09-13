<?php
/**
 * @package utouch-wp
 */
?>
<div class="post__date">
	<time class="published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ) ?>">
		<?php if ( get_the_ID() === Utouch::get_var( 'modified_single' ) ) { ?>
			<span class="number"><?php echo esc_html( get_the_date() ) ?></span>
		<?php } else { ?>
			<a href="<?php the_permalink() ?>" class="number"><?php echo esc_html( get_the_date('d') ) ?></a>
            <span class="month"><?php echo esc_html( get_the_date( 'M Y' ) ) ?></span>
            <span class="day"><?php echo esc_html( get_the_date( 'l' ) ) ?></span>
		<?php } ?>
	</time>
</div>
