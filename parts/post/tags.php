<?php
/**
 * @package utouch-wp
 */


$post  = get_post();
$terms = get_the_terms( $post->ID, 'post_tag' );
if ( is_array( $terms ) && ! empty( $terms ) ) {
	$count     = count( $terms );
	$tags_html = '';
	foreach ( $terms as $i => $term ) {
		/**
		 * @var WP_Term $term
		 */
		$tags_html .= '<li><a href="' . get_category_link( $term ) . '">' . $term->name . '</a>';
		if ( $i + 1 == $count ) {
			$tags_html .= '</li>';
		} else {
			$tags_html .= '&nbsp;,&nbsp;</li>';
		}
	}

	?>

	<ul class="tags-inline">
		<li><?php echo esc_html__( 'Tags:', 'utouch' ) ?> </li>
		<?php echo ($tags_html) ?>
	</ul>

<?php } ?>