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

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function aperture_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'aperture' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'aperture_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function aperture_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'aperture_render_title' );
endif;
