<?php
/**
 * Theme functions and definitions
 *
 * @package Yoese
 * @since Yoese 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet
 */
if ( ! isset( $content_width ) ) {
	$content_width = 740; /* pixels */
}


if ( ! function_exists( 'yoese_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function yoese_setup() {
	
	// Make theme available for translation. Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'yoese', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnail
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'yoese-thumb', 1200, 520, true );
	
	// This theme styles the visual editor to resemble the theme style
	add_editor_style( array( 'css/editor-styles.css', ) );
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main_navigation' => __( 'Main Menu', 'yoese' ),
		'top_navigation' => __( 'Top Menu', 'yoese' ),
		'footer_navigation' => __( 'Footer Menu', 'yoese' ),
		'social_navigation' => __( 'Social Menu', 'yoese' ),
	) );


	// Set up the WordPress custom logo feature.
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );


	/*
	 * end add by wtong
	 */


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array(
		'audio', 'gallery', 'image', 'link', 'quote', 'status', 'video',
	) );
	
	// Custom template tags for this theme
	require get_template_directory() . '/inc/template-tags.php';	

	// Theme Customizer
	require get_template_directory() . '/inc/customizer.php';
	
	// Set up the WordPress Custom Background Feature.
	$defaults = array(
    'default-color'	=> 'f2f2f2',
    'default-image'	=> '',
	);
	add_theme_support( 'custom-background', $defaults );
	
	// Load Jetpack compatibility file
	require get_template_directory() . '/inc/jetpack.php';
	
}
endif; // yoese_setup
add_action( 'after_setup_theme', 'yoese_setup' );


/**
 * Enqueues scripts and styles.
 */
function yoese_scripts() {
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'yoese-fonts', array(), null );
	
	// Add Icons font, used in the main stylesheet.
	wp_enqueue_style( 'yoese-icons', get_template_directory_uri() . '/fonts/simple-line-icons.css', array(), '2.2.2' );
	
	// Loads our main stylesheet.
	wp_enqueue_style( 'yoese-style', get_stylesheet_uri(), array(), '1.1.8' );
	
	// Loads our main js.
	wp_enqueue_script( 'yoese-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '20160906', true );
	
	// Sticky Menu.
	if ( get_theme_mod( 'yoese_sticky_menu', 0 ) == 1 ) {
	wp_enqueue_script( 'yoese-sticky-menu', get_template_directory_uri() . '/js/jquery.sticky.js', array( 'jquery' ), '20160906', true );
    wp_enqueue_script( 'yoese-sticky-menu-setting', get_template_directory_uri() . '/js/sticky-setting.js', array( 'yoese-sticky-menu' ), '20160906', true );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'yoese_scripts' );


/**
 * Register widget area
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function yoese_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Top Item Box', 'yoese' ),
		'id'            => 'top_item_box',
		'description'   => '',
		'before_widget' => '<div class="top-item-box"> ',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Index Top Big Box', 'yoese' ),
		'id'            => 'index_top_big_box',
		'description'   => '',
		'before_widget' => '<div class="big-pic"> ',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Index Top S1 Box', 'yoese' ),
		'id'            => 'index_top_s1_box',
		'description'   => '',
		'before_widget' => '<div class="big2-pic big2-pic-index big2-pic-index-top"> ',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Index Top S2 Box', 'yoese' ),
		'id'            => 'index_top_s2_box',
		'description'   => '',
		'before_widget' => '<div class="big2-pic big2-pic-index big2-pic-index-bottom"> ',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'yoese' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area Left', 'yoese' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area Center', 'yoese' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area Right', 'yoese' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
}
add_action( 'widgets_init', 'yoese_widgets_init' );


/**
 * Implement the WordPress Custom Header Feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Add Upsell "pro" link to the customizer
 *
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/customize-pro/class-customize.php' );


/**
 * Main Navigation
 */
if (!function_exists( 'yoese_menu' ) ) {
	function yoese_menu( $location ) {
		
		if ( has_nav_menu( $location ) ) {
			wp_nav_menu( array( 'theme_location' => $location, 'container' => false, 'menu_class' => 'main-menu' ) );
		} else {
			echo '<ul class="main-menu">';
			wp_list_pages( 'title_li=' );
			echo '</ul>';
		}
	}
}


/**
 * Filter the except length to 40 characters.
 *
 */
function yoese_custom_excerpt_length( $length ) {
    
    if ( is_home() && get_theme_mod( 'yoese_blog', 'layout2' ) == 'layout3' ) {
	    return 35;
	} elseif ( is_archive() || is_search() && get_theme_mod( 'yoese_archive', 'layout2' ) == 'layout3' ) {
		return 35;
	} 
	else {
		return 40;
	}
	
}
add_filter( 'excerpt_length', 'yoese_custom_excerpt_length', 999 );


/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function yoese_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'yoese_excerpt_more' );


/**
 * Thumb size for Layout 1 and 2
 */
function yoese_thumb_size() {
	if ( is_home() ) {
		if ( get_theme_mod( 'yoese_blog', 'layout2' ) == 'layout1' ) {
			$thumb_size = 'thumbnail';
		} else {
			$thumb_size = 'medium';
		}
	} else {
		if ( get_theme_mod( 'yoese_archive', 'layout2' ) == 'layout1' ) {
			$thumb_size = 'thumbnail';
		} else {
			$thumb_size = 'medium';
		}
	}
	return $thumb_size;
}


/**
 * Prints Credits in the Footer
 */
function yoese_credits() {
	$website_credits = '';
	$website_author = get_bloginfo('name');
	$website_date =  date ('Y');
	$website_credits = '&copy; ' . $website_date . ' ' . $website_author;	
	echo esc_html( $website_credits );
}


/** 
 * Add specific CSS class by filter
 *
 */
function yoese_custom_classes( $classes ) {
	// add 'class-name' to the $classes array
	$classes[] = get_option( 'yoese_layout_style', 'site-fullwidth' );
	
	// Adds a class to Homepage
	if ( is_home() ) {
    $classes[] = get_theme_mod( 'yoese_blog', 'layout2' );
	}
	
	// Adds a class to Archive and Search Pages
	if ( is_archive() || is_search() ) {
    $classes[] = get_theme_mod( 'yoese_archive', 'layout2' );
	}

	// return the $classes array
	return $classes;
}
add_filter( 'body_class', 'yoese_custom_classes' );


/**
 * Header Image
 *
 */
function yoese_header_image() {
	if ( get_theme_mod( 'yoese_show_header_image', 1 ) ) {
	 	
		if ( is_home() || is_front_page() ) { ?>
			<figure class="header-image">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
				</a>
			</figure>
		<?php }
		 
	} else { ?>
		
		<figure class="header-image">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
			</a>
		</figure>
		
	<?php }
}	


/**
 * Helper function for getting the script/style `.min` suffix for minified files.
 *
 */
function yoese_get_min_suffix() {
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
}


/**
 * Filters the 'stylesheet_uri' to allow theme developers to offer a minimized version of their main 
 * 'style.css' file.  It will detect if a 'style.min.css' file is available and use it if SCRIPT_DEBUG 
 * is disabled.
 *
 */
function yoese_min_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {

	/* Get the minified suffix. */
	$suffix = yoese_get_min_suffix();

	/* Use the .min stylesheet if available. */
	if ( !empty( $suffix ) ) {

		/* Remove the stylesheet directory URI from the file name. */
		$stylesheet = str_replace( trailingslashit( $stylesheet_dir_uri ), '', $stylesheet_uri );

		/* Change the stylesheet name to 'style.min.css'. */
		$stylesheet = str_replace( '.css', "{$suffix}.css", $stylesheet );

		/* If the stylesheet exists in the stylesheet directory, set the stylesheet URI to the dev stylesheet. */
		if ( file_exists( trailingslashit( get_stylesheet_directory() ) . $stylesheet ) )
			$stylesheet_uri = trailingslashit( $stylesheet_dir_uri ) . $stylesheet;
	}

	/* Return the theme stylesheet. */
	return $stylesheet_uri;
}
/* Load the development stylsheet in script debug mode. */
add_filter( 'stylesheet_uri', 'yoese_min_stylesheet_uri', 5, 2 );


/**
 * Blog: Posts Templates
 */
function yoese_blog_post_template() {
	
	$blog_type = get_theme_mod( 'yoese_blog', 'layout2' );
	
    if ( $blog_type == 'layout3' || $blog_type == 'layout11' ) {
	// Layout 3,11
	$blog_template = 'content-large';
	} else {
	// Layout 1,2
	$blog_template = 'content';
	}
	return esc_attr($blog_template);
}


/**
 * Archives: Posts Templates
 */
function yoese_archive_post_template() {
	
	$archive_type = get_theme_mod( 'yoese_archive', 'layout2' );
	
    if ( $archive_type == 'layout3' ) {
	// Layout 3
	$archive_template = 'content-large';
	} else {
	// Layout 1,2
		if ( is_search() ) {
			$archive_template = 'content-search';	
		} else {
			$archive_template = 'content';	
		}
	}
	return esc_attr($archive_template);
}

//allow redirection, even if my theme starts to send output to the browser
add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}
