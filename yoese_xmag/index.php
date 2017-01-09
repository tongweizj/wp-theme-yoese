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
		<div class="top-item-box clearfix">

                <?php
                    if( is_active_sidebar( 'index_top_big_box' ) ) {
                        if ( !dynamic_sidebar( 'index_top_big_box' ) ):
                        endif;
                    }
                ?>  <!--big-pic end-->

                        <?php
                    if( is_active_sidebar( 'index_top_s1_box' ) ) {
                        if ( !dynamic_sidebar( 'index_top_s1_box' ) ):
                        endif;
                    }
                ?>
     <!--big2-pic end-->
          <?php
                    if( is_active_sidebar( 'index_top_s2_box' ) ) {
                        if ( !dynamic_sidebar( 'index_top_s2_box' ) ):
                        endif;
                    }
                ?>
    <!--big2-pic end-->	
		</div><!-- .featured-slider-section -->
		<nav id="main-navbar" class="main-navbar">
			<div class="container">
				<div id="main-navigation" class="main-navigation">						
					<?php yoese_menu('main_navigation'); ?>
				</div>
			</div>
		</nav><!-- Main Navbar -->
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
