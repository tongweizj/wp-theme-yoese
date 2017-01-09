<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Yoese
 * @since Yoese 1.0
 */
?>
		
		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<div class="footer widget-area" role="complementary">
			<div class="container">
				<div class="row">
					<div class="col-4" id="footer-area-left">
						<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
							<?php dynamic_sidebar( 'footer-1' ); ?>
						<?php endif; // end footer widget area left ?>
					</div>	
					<div class="col-4" id="footer-area-center">
						<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
							<?php dynamic_sidebar( 'footer-2' ); ?>
						<?php endif; // end footer widget area center ?>
					</div>
					<div class="col-4" id="footer-area-right">
						<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
							<?php dynamic_sidebar( 'footer-3' ); ?>
						<?php endif; // end footer widget area right ?>
					</div>
				</div><!-- .row -->
			</div>
		</div>
		
		<div class="footer-copy">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<div class="site-info">
							<?php yoese_credits(); ?>
							<span class="sep">/</span>
							<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'yoese' ) ); ?>"><?php printf( __( 'Powered by %s', 'yoese' ), 'WordPress' ); ?></a>
							<span class="sep"> / </span>
							<a href="<?php echo esc_url( __( 'http://www.yoese.com/', 'yoese' ) ); ?>"><?php printf( __( 'Theme by %s', 'yoese' ), '有益' ); ?></a>
						</div>
					</div>
					<div class="col-6">
						<?php if ( has_nav_menu( 'footer_navigation' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => 'footer_navigation', 'menu_class' => 'footer-menu', 'container_class' => 'footer-navigation', 'depth' => 1 ) ); ?>
						<?php } ?>
					</div>
				</div><!-- .row -->
			</div>
		</div>
	</footer><!-- #colophon -->
	
	<?php if ( get_theme_mod('yoese_scroll_up') ) { ?>
		<a href="#masthead" id="scroll-up"><span class="icon-arrow-up"></span></a>
	<?php } ?>
	
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?1840787572f564a5cf40a5b467985821";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</body>
</html>