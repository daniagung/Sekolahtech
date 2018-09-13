<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * @var array $args
 * @var string $title
 * @var array $instance
 */

wp_enqueue_script(
	'js-cookie',
	get_template_directory_uri() . '/inc/widgets/follow-us/static/js/js.cookie.js',
	array( 'jquery' ),
	'2.1.3',
	true
);

$before_widget = $after_widget = $before_title = $after_title = '';

extract( $args );

if ( ! is_array( $instance['links'] ) ) {
	$instance['links'] = array();
}

echo( $before_widget );

if ( $title ) {
	echo( $before_title . esc_html( $title ) . $after_title );
}
?>
	<ul class="list list--primary">
		<li>
		</li>
		<?php foreach ( $instance['links'] as $link_item ) { ?>
			<li>
				<a href="<?php echo esc_url($link_item['link'])?>"><?php echo esc_html($link_item['txt'])?></a>
				<svg class="utouch-icon utouch-icon-arrow-right"><use xlink:href="#utouch-icon-arrow-right"></use></svg>
			</li>
		<?php } ?>
	</ul>

<?php
echo( $after_widget );
