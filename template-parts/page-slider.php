<?php
/**
 * Template Name: Fullscreen Slider
 *
 * @package Aperture
 */

$featured = aperture_get_featured_posts();
$animation = get_theme_mod( 'aperture_slider_animation', 'slide' );

get_header(); ?>

	<?php if ( aperture_has_featured_posts( 2 ) ) : ?>

		<div id="featured-content" class="flexslider multiple-featured-posts">
			<ul class="featured-posts slides">

				<?php
				foreach ( $featured as $post ) :
					setup_postdata( $post );

					if ( has_post_thumbnail() ) : ?>

						<?php 	$post_thumbnail_id = get_post_thumbnail_id();
								$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id ); ?>

							<li class="featured" style="background: url(<?php echo esc_url( $post_thumbnail_url ); ?>);">
								<div class="featured-hentry-wrap <?php echo esc_attr( $animation ); ?>-animation">
									<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<?php the_title( '<div class="slider-header"><h2 class="slider-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2></div>' ); ?>
										<div class="slider-excerpt"><?php the_excerpt(); ?></div>
										<div class="slider-link"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'aperture' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">Read more...</a></div>
									</div><!-- #post-## -->
								</div><!-- .featured-hentry-wrap -->
							</li>
				<?php
					endif;
				endforeach;
				wp_reset_postdata();
				?>
			</ul><!-- .featured-posts -->
		</div><!-- #featured-content -->

	<?php elseif ( aperture_has_featured_posts( 1 ) ) : ?>

		<div id="featured-content" class="flexslider single-featured-post">
			<ul class="featured-posts slides">

				<?php
				foreach ( $featured as $post ) :
					setup_postdata( $post );

					if ( has_post_thumbnail() ) : ?>

						<?php 	$post_thumbnail_id = get_post_thumbnail_id();
								$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id ); ?>

							<li class="featured" style="background: url(<?php echo esc_url( $post_thumbnail_url ); ?>);">
								<div class="featured-hentry-wrap">
									<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<?php the_title( '<div class="slider-header"><h2 class="slider-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2></div>' ); ?>
										<div class="slider-excerpt"><?php the_excerpt(); ?></div>
										<div class="slider-link"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'aperture' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">Read more...</a></div>
									</div><!-- #post-## -->
								</div><!-- .featured-hentry-wrap -->
							</li>
				<?php
					endif;
				endforeach;
				wp_reset_postdata();
				?>
			</ul><!-- .featured-post -->
		</div><!-- #featured-content -->

	<?php else : ?>

	<div id="no-featured-content" class="no-featured-post">
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	</div><!-- #no-featured-content -->

	<?php endif; ?>

<?php get_footer(); ?>
