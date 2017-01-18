<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 * 
 * @package Yoese
 * @since Yoese 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri() ?>/aside/main.css" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
<div id="page" class="hfeed site">
	
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'yoese' ); ?></a>
	
	<aside id="mobile-header" class="mobile-header">
		<a class="mobile-menu-toggle" id="mobile-menu-toggle" href="#mobile-nav" title="<?php esc_attr_e( 'Menu', 'yoese' ); ?>"><span class="button-toggle"></span></a>
		<a class="mobile-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	</aside>
	
	<nav id="mobile-navigation" class="mobile-navigation" role="navigation"></nav>

	<header id="masthead" class="site-header" role="banner">
		
		<div class="header-top collapse">
			<div class="container">
				<div class="row">
					<div class="col-4">
						<div class="site-branding">
						<?php if ( function_exists( 'the_custom_logo' ) ) {
					the_custom_logo();
				}?>
							<?php if ( is_front_page() && is_home() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php endif; ?>
							
							<?php $description = get_bloginfo( 'description', 'display' ); ?>
							<?php if ( $description || is_customize_preview() ) { ?>
									<p class="site-description"><?php echo $description; ?></p>
							<?php } ?>
						</div><!-- .site-branding -->
					</div>
					<div class="col-8">
						<div class="header-navigation">
							<?php if ( get_theme_mod( 'yoese_show_search', 1 ) ) { ?>
								<div class="search-top">
									<?php get_search_form(); ?>
								</div>
							<?php } ?><!-- Search Form -->
							<nav id="top-navigation" class="top-navigation" role="navigation">
								<?php 
									if ( has_nav_menu( 'top_navigation' ) ) {
									wp_nav_menu( array( 'theme_location' => 'top_navigation', 'menu_class' => 'top-menu', 'container' => false  ) );
									} 
								?>
							</nav><!-- #top-navigation -->
						</div>
					</div>
				</div><!-- .row -->
			</div>
		</div><!-- Header Top -->
		
		<?php if ( get_header_image() ) { yoese_header_image(); } // End header image check ?>
			
	
	</header><!-- #masthead -->
	
	<div id="content" class="site-content">
		<div class="container">
			