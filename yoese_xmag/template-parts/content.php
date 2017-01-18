<?php
/**
 * 这是列表中，单篇文章模板
 * @package Yoese
 * @since Yoese 1.0
 */
?>
	
	<?php
	$thumb_size = yoese_thumb_size();
	?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'list-post' ); ?>>
			
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<figure class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail($thumb_size); ?>
					<span class="format-icon"></span>
				</a>
			</figure>
		<?php else : ?>
			<figure class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<img width="300" height="63" src="http://52sask.com/wp-content/uploads/2015/12/saskatoon-life-span.png" class="attachment-medium size-medium wp-post-image">
					<span class="format-icon"></span>
				</a>
			</figure>
		<?php endif; // if has_post_thumbnail ?>
		<div class='post-c'>
			<header class="entry-header">

				<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			</header><!-- .entry-header -->
			
			<div class="entry-summary">
				<?php echo get_the_excerpt(); ?>
					<?php if ( get_theme_mod( 'yoese_read_more' ) ) { ?>
						<a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php _e( 'Read more', 'yoese' ); ?>
						</a>
					<?php } ?>
			</div><!-- .entry-summary -->
			<div class="entry-meta">
				<span class="posted-on">
					<?php the_time( get_option( 'date_format' ) ); ?>
				</span>
				<span class="sep"></span>
				<span class="category"><?php the_category(' '); ?></span>
			</div><!-- .entry-meta -->
		</div>
	</article><!-- #post-## -->
