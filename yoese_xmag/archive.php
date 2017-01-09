<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * 分类页
 * @package Yoese
 * @since Yoese 1.0
 */

get_header(); ?>
	
	<?php
	/* Archive Options */
	$post_template = yoese_archive_post_template();
	?>
	
	<div id="primary" class="content-area">		
		<header class="page-header">
			<div class="tagsbanner">
				<div class="tags_wrapper">
					<div class="tag_tip">
						<span class="icon-tag"></span>
						<span class="tag_read">精选阅读</span>
					</div>
					<div class="content">
						<div class="tags_keywords">
							<h1 class="page-title"><?php the_title(); ?></h1>
							<span>相关的文章</span>
						</div>					
						<?php
							if ( is_category() ) {
								// show an optional category description
								$category_description = category_description();
								if ( ! empty( $category_description ) )
									echo apply_filters( 'category_archive_meta', '' . $category_description . '' );

							} elseif ( is_tag() ) {
								// show an optional tag description
								$tag_description = tag_description();
								if ( ! empty( $tag_description ) )
									echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
							}
						?><!-- /tag desc-text -->
			</div>
		<!--end of test-->
			
			
		</header><!-- .page-header -->
		
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
