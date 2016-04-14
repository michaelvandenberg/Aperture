<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Aperture
 */

function aperture_jetpack_setup() {
	/**
	 * Add theme support for Infinite Scroll.
	 * See: https://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'type'		=> 'scroll',
		'container' => 'main',
		'render'    => 'aperture_infinite_scroll_render',
		'footer'    => 'page',
	) );

	/**
	 * Add theme support for Featured Content.
	 * See: http://jetpack.me/support/featured-content/
	 */
	add_theme_support( 'featured-content', array(
		'filter'     => 'aperture_get_featured_posts',
		'max_posts'  => 5,
		'post_types' => array( 'post', 'page', 'portfolio' ),
	) );

	/**
	* Add theme support for Responsive Videos.
	* See: http://jetpack.me/support/responsive-videos/
	*/
	add_theme_support( 'jetpack-responsive-videos' );
	

	/**
	* Add theme support for Portfolio Custom Post Type.
	* See: http://jetpack.me/support/custom-content-types/
	*/
	//add_theme_support( 'jetpack-portfolio' );


} // end function aperture_jetpack_setup
add_action( 'after_setup_theme', 'aperture_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function aperture_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function aperture_infinite_scroll_render

/**
 * Custom render function for Infinite Scroll.
 */
function aperture_get_featured_posts() {
	return apply_filters( 'aperture_get_featured_posts', array() );
} // end function aperture_get_featured__posts

/**
 * Get the number of featured posts.
 */
function aperture_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() )
		return false;

	$minimum = absint( $minimum );
	$featured_posts = apply_filters( 'aperture_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) )
		return false;

	if ( $minimum > count( $featured_posts ) )
		return false;

	return true;
} // end function aperture_has_featured_posts
