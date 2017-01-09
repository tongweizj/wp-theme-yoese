<?php
/**
 * The template for displaying Single Post content.
 * 使用范围： 文章页
 * @package Yoese
 * @since Yoese 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && get_theme_mod('yoese_post_featured_image') ) : ?>
	
		<?php if ( get_theme_mod('yoese_post_featured_image_size', 'default') == 'default' ) : ?>
		
			<header class="entry-header has-featured-image">	
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<div class="entry-meta">
					<?php yoese_posted_on(); ?>
					<span class="sep">/</span>
					<?php yoese_entry_comments(); ?>
				</div>
				<figure class="entry-thumbnail">
					<?php the_post_thumbnail('large'); ?>
				</figure>
			</header><!-- .entry-header -->
		
		<?php endif; ?>
	
	<?php else : ?>
	
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<div class="entry-meta">
				<?php yoese_posted_on(); ?>
				<span class="sep">/</span>
				<?php yoese_entry_comments(); ?>
			</div>
		</header><!-- .entry-header -->
		
	<?php endif; ?>
		
	<div class="entry-content">
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
		<?php yoese_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<?php
	// Author bio.
	if ( get_the_author_meta( 'description' ) ) :
		get_template_part( 'template-parts/author-bio' );
	endif;
?>

<?php
	the_post_navigation( array(
    	'prev_text'	=> __( 'Previous Post', 'yoese' ) . '<span>%title</span>',
		'next_text'	=> __( 'Next Post', 'yoese' ) . '<span>%title</span>',
	) );
?>