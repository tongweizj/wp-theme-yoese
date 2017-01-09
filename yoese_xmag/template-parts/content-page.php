<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Yoese
 * @since Yoese 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( has_post_thumbnail() && get_theme_mod('yoese_page_featured_image') ) : ?>
	
		<?php if ( get_theme_mod('yoese_page_featured_image_size', 'default') == 'default' ) : ?>
			<figure class="entry-thumbnail">
					<?php the_post_thumbnail('large'); ?>
			</figure><!-- .entry-thumbnail -->	
			<header class="entry-header has-featured-image">	
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		
		<?php endif; ?>
	
	<?php else : ?>	
		
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>
		
	<?php endif; ?>

	<div class="entry-content article-wrap">
		<?php 
			the_content();
			wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'yoese' ),
			'after'  => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'yoese' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->
