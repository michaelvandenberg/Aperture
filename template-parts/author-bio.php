<?php
/**
 * The template for displaying Author bios
 *
 * @package Aperture
 * @since Aperture 1.0
 */
?>

<div class="author-info">
	<h2 class="author-heading screen-reader-text"><?php esc_html_e( 'Published by', 'aperture' ); ?></h2>
	<div class="author-info-inner">
		<div class="author-avatar">
			<?php
			/**
			 * Filter the author bio avatar size.
			 *
			 * @since Aperture 1.0
			 *
			 * @param int $size The avatar height and width size in pixels.
			 */
			$author_bio_avatar_size = apply_filters( 'aperture_author_bio_avatar_size', 74 );

			echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
			?>
		</div><!-- .author-avatar -->

		<div class="author-description">
			<h3 class="author-title"><?php echo esc_html( get_the_author() ); ?></h3>

			<p class="author-bio">
				<?php the_author_meta( 'description' ); ?>
				<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
					<?php printf( esc_html__( 'View all posts by %s', 'aperture' ), esc_html( get_the_author() ) ); ?>
				</a>
			</p><!-- .author-bio -->

		</div><!-- .author-description -->
	</div><!-- .author-info-inner -->
</div><!-- .author-info -->
