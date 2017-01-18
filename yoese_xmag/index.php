<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Yoese
 * @since Yoese 1.0
 */

get_header(); ?>

	<?php
	/* Blog Options */
	$post_template = yoese_blog_post_template();
	?>
	<div id="primary" class="content-area">
		<?php if ( is_active_sidebar( 'index_banner_big' ) ) : ?>
			<?php dynamic_sidebar( 'index_banner_big' ); ?>
		<?php endif; // end index_banner_big ?>

		<?php if ( is_active_sidebar( 'index_banner_s1' ) ) : ?>
				<div class='index-banner-s3 clr'>
				<?php dynamic_sidebar( 'index_banner_s1' ); ?>
		<?php endif; // end index_banner_s1 ?>
		<?php if ( is_active_sidebar( 'index_banner_s2' ) ) : ?>
				<?php dynamic_sidebar( 'index_banner_s2' ); ?>
		<?php endif; // end index_banner_s2 ?>
		<?php if ( is_active_sidebar( 'index_banner_s3' ) ) : ?>
				<?php dynamic_sidebar( 'index_banner_s3' ); ?>
		<?php endif; // end index_banner_s3 ?>
		<?php if ( is_active_sidebar( 'index_banner_s1' ) ) : ?>
			</div>
		<?php endif; // end index_banner_s1 ?>
		<!--index-banner-big-->
		<main id="main" class="site-main" role="main">
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<div class="posts-loop">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/' . $post_template );
					?>

				<?php endwhile; ?>
				</div><!-- / .posts-loop -->

				<?php the_posts_pagination( array(
					'mid_size' => 2,
    				'prev_text' => esc_html( '&larr;' ),
    				'next_text' => esc_html( '&rarr;' ),
				) ); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
