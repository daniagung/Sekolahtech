<?php
/**
 * Template part for displaying search form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Utouch
 */
$search_color = function_exists( 'fw_get_db_customizer_option' ) ? fw_get_db_customizer_option( 'search-icon/yes/color-scheme', 'search--white' ) : 'search--white';
$class[] = 'search-standard';
$class[] = $search_color;
?>
<!-- Dropdown Search-->
<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">
    <form id="search-header" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-inline" name="form-search-header">
        <label for="search-drop-input" class="screen-reader-text"><?php echo esc_attr__( 'Search', 'utouch' ); ?></label>

        <input class="search-input" required="required" name="s"
               placeholder="<?php esc_html_e( 'What are you looking for?', 'utouch' ); ?>" type="search"
               value="<?php get_search_query(); ?>">

        <button type="submit" class="form-icon">
            <svg class="utouch-icon utouch-icon-search"><use xlink:href="#utouch-icon-search"></use></svg>
        </button>
        <span class="close js-search-close form-icon">
			<svg class="utouch-icon utouch-icon-cancel-1"><use xlink:href="#utouch-icon-cancel-1"></use></svg>
		</span>
    </form>
</div>
<!-- # Dropdown Search-->