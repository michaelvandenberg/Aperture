<?php
/**
 * The template for displaying all single posts.
 *
 * @package Aperture
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation(); ?>

			<?php
				// Author bio.
				if ( is_single() && get_the_author_meta( 'description' ) ) :
					get_template_part( 'template-parts/author-bio' );
				endif;
			?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>
