<?php
/**
 * Template part for displaying Login widget when user authorized.
 * You free to customize widget contents in child theme.
 * Copy that file into 'parts' folder of your Child Theme.
 *
 * @package Utouch
 */

global $allowedposttags;
$template_uri = get_template_directory_uri();
$author_id    = get_the_author_meta( 'ID' );
$description  = get_the_author_meta( 'description' );
$socials      = get_the_author_meta( 'utouch_social_networks' );
$socials      = utouch_akg( 'social-networks', $socials, array() );
if ( ! empty( $description ) ) {
	?>



<?php }