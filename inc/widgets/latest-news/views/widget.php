<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array $args
 * @var string $title
 * @var WP_Query $latest_posts
 * @var WP_Query $popular_posts
 * @var array $comments
 */
$the_query     = new WP_Query();
$before_widget = $after_widget = $before_title = $after_title = '';

$theme_uri = get_template_directory_uri();
$post_formats = array(
	'gallery'  => 'src="'.$theme_uri.'/svg/pictures.svg"',
	'audio'    => 'src="'.$theme_uri.'/svg/music.svg"',
	'video'    => 'src="'.$theme_uri.'/svg/google-play.svg"',
	'standard' => 'src="'.$theme_uri.'/svg/flag.svg"',
	'link'     => 'src="'.$theme_uri.'/svg/link2.svg"',
	'quote'    => 'src="'.$theme_uri.'/img/quote.png"',
);

extract( $args );

echo( $before_widget );

if ( $title ) {
	echo( $before_title . esc_html( $title ) . $after_title );
} ?>

	<ul class="latest-news-control" role="tablist">

		<li role="presentation" class="tab-control active">
			<a href="#latest" role="tab" data-toggle="tab"
			   class="control-item"><?php echo esc_html__( 'Latest', 'utouch' ) ?></a>
		</li>

		<li role="presentation" class="tab-control">
			<a href="#popular" role="tab" data-toggle="tab"
			   class="control-item"><?php echo esc_html__( 'Popular', 'utouch' ) ?></a>
		</li>

		<li role="presentation" class="tab-control">
			<a href="#w-latest-comments" role="tab" data-toggle="tab"
			   class="control-item"><?php echo esc_html__( 'Comments', 'utouch' ) ?></a>
		</li>

	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane fade in active" id="latest">
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
										$post_format = get_post_format();
										if(!$post_format){
											$post_format = 'standard';
										}
										echo '<img ' . utouch_akg( $post_format, $post_formats, '' ) . ' alt="news" />';
										?>
									</div>
								<?php } ?>
								<div class="post-additional-info">
									<h6 class="post__title entry-title" itemprop="name">
										<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
									</h6>
									<span class="post__date">
										<?php echo utouch_posted_time(); ?>
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
		</div>
		<div role="tabpanel" class="tab-pane fade" id="popular">
			<ul class="latest-news-list">
				<?php
				while ( $popular_posts->have_posts() ) {
					$popular_posts->the_post();
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

										$post_format = get_post_format(get_the_ID());
										if(!$post_format){
											$post_format = 'standard';
										}
										echo '<img ' . utouch_akg( $post_format, $post_formats, '' ) . ' alt="news" />';
										?>
									</div>
								<?php } ?>
								<div class="post-additional-info">
									<h6 class="post__title entry-title" itemprop="name">
										<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
									</h6>
									<span class="post__date">
										<?php echo utouch_posted_time(); ?>
									</span>
								</div>
							</header>
						</article>
					</li>
					<?php
				}
				$popular_posts->reset_postdata();
				?>
			</ul>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="w-latest-comments">
			<ul class="latest-news-list">


				<?php
				if ( $comments ) : foreach ( $comments as $comment ) :
					?>
					<li>
						<article itemscope="" itemtype="http://schema.org/NewsArticle" class="latest-news-item">

							<header>
								<div class="post-thumb">
									<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID ?>">

										<?php echo get_avatar( $comment->comment_author_email, 70 ); ?>
									</a>

								</div>
								<div class="post-additional-info">
									<h6 class="post__title entry-title" itemprop="name">
										<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID ?>"><?php echo esc_html( $comment->comment_author ) ?></a>
									</h6>
									<p class="clip"><?php echo strip_tags( apply_filters( 'get_comment_text', $comment->comment_content ) ) ?></p>
								</div>
							</header>
						</article>
					</li>
					<?php
				endforeach;
				else :
					echo '<li><p>' . esc_html__( 'No comments', 'utouch' ) . '</p></li>';
				endif;
				?>
			</ul>
		</div>
	</div>

<?php
echo( $after_widget );