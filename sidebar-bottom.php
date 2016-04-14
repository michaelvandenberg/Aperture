<?php
/**
 * The sidebar containing the bottom widget area.
 *
 * @package Aperture
 */

if ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'template-parts/page-slider.php' ) ) {
	return;
}
?>

<div id="tertiary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</div><!-- #secondary -->
