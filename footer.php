<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Aperture
 */
$customtext = get_theme_mod( 'aperture_footer_text', 'Some custom text here!' );
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="container">

			<?php get_sidebar( 'bottom' ); ?>

			<div class="site-info">

				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav id="bottom-social" class="social-links">
						<?php get_template_part( 'template-parts/navigation-social' ); ?>
					</nav><!-- #social-links -->
				<?php endif; ?>

				<div class="credits">
					<span class="credits-top"><?php echo esc_html__( 'Powered by ', 'aperture' ) ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'aperture' ) ); ?>" rel="generator">WordPress</a></span>
					<span class="sep"> | </span>
					<span class="credits-bottom"><?php printf( esc_html__( 'The %1$s theme by %2$s', 'aperture' ), '<a href="https://michaelvandenberg.com/themes/#aperture" rel="theme">Aperture</a>', '<a href="https://michaelvandenberg.com/" rel="designer">MvdB</a>' ); ?></span>
				</div><!-- .credits -->

				<div class="custom-text">
					<span><?php echo sanitize_text_field( $customtext ) ?></span>
				</div><!-- .custom-text -->
			</div><!-- .site-info -->

		</div><!-- .container -->

		<a href="#content" class="back-to-top"><span class="genericon genericon-top"></span></a>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
