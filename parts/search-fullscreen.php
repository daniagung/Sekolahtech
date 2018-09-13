<?php
/**
 * Template part for displaying search form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */
$search_color = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'search-icon/yes/color-scheme', 'search--white' ) : 'search--white';
$class[] = 'search-popup';
$class[] = $search_color;
?>

<!-- # Overlay Search-->
