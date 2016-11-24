<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Aperture
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function aperture_body_classes( $classes ) {
	// Adds a class when the slider page template is active.
	if ( is_page_template( 'template-parts/page-slider.php' ) ) {
		$classes[] = 'fullscreen-slider';
	}

	// Adds a class depending on whether sidebar is active and the selection in the customizer.
	$sidebar = get_theme_mod( 'aperture_sidebar', 'right-sidebar' );

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	elseif ( is_active_sidebar( 'sidebar-1' ) && $sidebar == 'right-sidebar' ) {
		$classes[] = 'right-sidebar';
	}

	elseif ( is_active_sidebar( 'sidebar-1' ) && $sidebar == 'left-sidebar' ) {
		$classes[] = 'left-sidebar';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'aperture_body_classes' );

/**
 * Remove custom-background class from the array of body classes.
 */
function aperture_remove_body_class($classes) {
	// Remove the custom background when the page slider is displayed.
	if ( is_page_template( 'template-parts/page-slider.php' ) && aperture_has_featured_posts( 2 ) ) :
		foreach( $classes as $key => $value ) {
			if ($value == 'custom-background' ) unset( $classes[$key] );
		}
	endif;
	return $classes;
}
add_filter('body_class', 'aperture_remove_body_class', 20, 2);
