<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array $args
 * @var string $title
 * @var WP_Query $latest_projects
 */
$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

echo( $before_widget );

if ( $title ) {
	echo( $before_title . esc_html( $title ) . $after_title );
} ?>

	<div class="swiper-container">

		<div class="swiper-wrapper">
			<?php
			while ( $latest_projects->have_posts() ) {
				$latest_projects->the_post();
				$accent_color = fw_get_db_post_option( get_the_ID(), 'accent-color', '#fff' );

				?>
				<div class="swiper-slide product-item">
					<div class="product-item-thumb">
						<div class="square-colored"
							 style="background-color: <?php echo esc_attr( $accent_color ); ?>;"></div>
						<a href="<?php the_permalink() ?>"> <?php the_post_thumbnail( 'full-size' ) ?></a>
					</div>
					<div class="product-item-content">
						<a href="<?php the_permalink() ?>" class="title h6"><?php the_title() ?></a>
					</div>
				</div>

				<?php
			}
			$latest_projects->reset_postdata();
			?>
		</div>
		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>

	</div>


<?php
echo( $after_widget );