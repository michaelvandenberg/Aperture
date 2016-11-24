<?php
/**
 * The search form.
 *
 * Displays the search form. Delete this file if you want to use the default WordPress search form.
 *
 * @package Aperture
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'before form', 'aperture' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'aperture' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
	</label>
	<button class="search-submit"><span class="screen-reader-text"><?php _e('Search Submit', 'aperture'); ?></span><span class="genericon genericon-search" aria-hidden="true"></span></button>
</form>
