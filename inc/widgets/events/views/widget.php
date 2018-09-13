<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array $args
 * @var string $title
 * @var array $events
 * @var string $button_text
 * @var string $button_link
 * @var string $button_color
 */
$the_query     = new WP_Query();
$before_widget = $after_widget = $before_title = $after_title = '';
extract( $args );

echo( $before_widget );

if ( $title ) {
	echo( $before_title . esc_html( $title ) . $after_title );
} ?>

	<ul class="latest-news-list">
		<?php
		while ( $latest_posts->have_posts() ) {
			$latest_posts->the_post();
			?>
			<li>
				<article id="post-<?php the_ID(); ?>" itemscope="" itemtype="http://schema.org/NewsArticle"
						 class="latest-news-item">
					<header>

						<?php if ( has_post_thumbnail() ) { ?>
							<div class="post-thumb">
								<?php
								$thumbnail_id = get_post_thumbnail_id();

								$url= wp_get_attachment_image_url($thumbnail_id,'full');

								echo '<img src="'.utouch_resize($url,70,70,true).'" />';
								?>
							</div>
						<?php } else { ?>
							<div class="post-thumb post-formats" style="background-color: #c5c5c5">
								<?php

								echo '<img src="' . get_template_directory_uri() . '/svg/flag.svg" alt="news" />';
								?>
							</div>
						<?php } ?>
						<div class="post-additional-info">
							<h6 class="post__title entry-title" itemprop="name">
								<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
							</h6>
							<span class="post__date">
										<?php
										echo Utouch::get_event( get_the_ID() )->get_dates_range();
										?>
									</span>
						</div>
					</header>
				</article>
			</li>
			<?php
		}
		$latest_posts->reset_postdata();
		?>
	</ul>

<?php
echo( $after_widget );