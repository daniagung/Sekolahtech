<span class="label"><?php esc_html_e( 'Share', 'utouch' ); ?>:</span>
<button  class="social__item sharer" data-sharer="facebook" data-url="<?php the_permalink(); ?>">
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/plain/facebook.svg" alt="facebook">
</button>
<button class="social__item sharer" data-sharer="twitter" data-title="<?php echo esc_attr(get_the_title()); ?>" data-url="<?php the_permalink();?>" >
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/plain/twitter.svg" alt="twitter">
</button>
<button class="social__item sharer" data-sharer="linkedin" data-url="<?php the_permalink(); ?>">
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/plain/linkedin.svg" alt="linkedin">
</button>
<button class="social__item sharer" data-sharer="googleplus" data-url="<?php the_permalink(); ?>">
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/plain/google-plus.svg" alt="google">
</button>
<button class="social__item sharer" data-sharer="pinterest" data-url="<?php the_permalink(); ?>" data-image="<?php the_post_thumbnail_url('large'); ?>" >
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/plain/pinterest.svg" alt="pinterest">
</button>
<button class="social__item sharer" data-sharer="VK" data-url="<?php the_permalink(); ?>" data-image="<?php the_post_thumbnail_url('large'); ?>" >
    <img src="<?php echo get_template_directory_uri() ?>/svg/socials/plain/vk.svg" alt="vk">
</button>