<?php
/**
 * The template for displaying search results pages.
 *
 * @package Yoese
 * @since Yoese 1.0
 */

get_header(); ?>
	
	<?php
	/* Archive Options */
	$post_template = yoese_archive_post_template();
	?>
	
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'yoese' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<div class="posts-loop">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
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
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
