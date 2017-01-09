<?php
/**
 * Yoese Customizer functionality
 *
 * @package Yoese
 * @since Yoese 1.0
 */


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function yoese_customize_preview_js() {
	wp_enqueue_script( 'yoese_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20150920', true );
}
add_action( 'customize_preview_init', 'yoese_customize_preview_js' );


/**
 * Custom Classes
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	class DL_Important_Links extends WP_Customize_Control {

    	public $type = "yoese-important-links";
	
		public function render_content() {
        $important_links = array(
	        'documentation' => array(
			'link' => esc_url('http://www.designlabthemes.com/yoese-wordpress-theme/'),
			'text' => __('Theme Homepage &rarr;', 'yoese'),
			),
			'rating' => array(
			'link' => esc_url('https://wordpress.org/support/theme/yoese/reviews/#new-post'),
			'text' => __('Rate This Theme &rarr;', 'yoese'),
			),

        );
        foreach ($important_links as $important_link) {
        	echo '<p><a target="_blank" href="' . esc_url( $important_link['link'] ). '" >' . esc_html($important_link['text']) . ' </a></p>';
        	}
    	}
	}

} // end if class_exists


/**
 * Yoese Theme Customizer
 */
function yoese_theme_customizer( $wp_customize ) {
	
	// Add postMessage support for site title and description for the Theme Customizer
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	// Move Background Color Control to 'yoese_layout_section'
	$wp_customize->get_control( 'background_color' )->section = 'yoese_layout_section';
	// Add Callback Function to Background Color
	$wp_customize->get_control( 'background_color' )->active_callback = 'yoese_has_boxed_layout';
	// Add Callback Function to Background Section
	$wp_customize->get_section( 'background_image' )->active_callback = 'yoese_has_boxed_layout';
		
	// Theme Settings
	$wp_customize->add_panel( 'yoese_panel', array(
    	'title' => __( 'Theme Settings', 'yoese' ),
		'priority' => 10,
	) );
	
	// Header Section
	$wp_customize->add_section( 'yoese_header_section', array(
		'title'       => __( 'Header', 'yoese' ),
		'priority'    => 10,
		'panel' => 'yoese_panel',
	) );
	
	// Main Menu Style
	$wp_customize->add_setting( 'yoese_menu_style', array(
        'default' => 'dark',
        'sanitize_callback' => 'yoese_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'yoese_menu_style', array(
	    'label'    => __( 'Main Menu Style', 'yoese' ),
	    'section'  => 'yoese_header_section',
	    'settings' => 'yoese_menu_style',
	    'type'     => 'radio',
		'choices'  => array(
			'dark' => __('Dark', 'yoese'),
			'light' => __('Light', 'yoese'),
			'custom' => __('Custom Background', 'yoese'),
		),
	) );
	
	// Main Menu Background
	$wp_customize->add_setting( 'main_menu_background', array(
		'default' => '#e54e53',
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_background', array(
		'description' => __( 'Set a custom background for the Main Menu', 'yoese' ),
		'section'  => 'yoese_header_section',
		'settings' => 'main_menu_background',
		'active_callback' => 'yoese_has_custom_menu',
	) ) );
	
	// Sticky Menu
	$wp_customize->add_setting( 'yoese_sticky_menu', array(
        'default' => '',
        'sanitize_callback' => 'yoese_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'yoese_sticky_menu', array(
	    'label'    => __( 'Sticky Main Menu', 'yoese' ),
	    'section'  => 'yoese_header_section',
	    'settings' => 'yoese_sticky_menu',
	    'type'     => 'checkbox',
	) );
	
	// Home Icon
	$wp_customize->add_setting( 'yoese_home_icon', array(
        'default' => 1,
        'sanitize_callback' => 'yoese_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'yoese_home_icon', array(
	    'label'    => __( 'Show the Home icon in the Main Menu', 'yoese' ),
	    'section'  => 'yoese_header_section',
	    'settings' => 'yoese_home_icon',
	    'type'     => 'checkbox',
	) );
	
	// Search Form
	$wp_customize->add_setting( 'yoese_show_search', array(
        'default' => 1,
        'sanitize_callback' => 'yoese_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'yoese_show_search', array(
	    'label'    => __( 'Show Search Form', 'yoese' ),
	    'section'  => 'yoese_header_section',
	    'settings' => 'yoese_show_search',
	    'type'     => 'checkbox',
	) );
	
	// Header Image
	$wp_customize->add_setting( 'yoese_show_header_image', array(
        'default' => 1,
        'sanitize_callback' => 'yoese_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'yoese_show_header_image', array(
	    'label'    => __( 'Show Header Image on Front Page Only', 'yoese' ),
	    'section'  => 'yoese_header_section',
	    'settings' => 'yoese_show_header_image',
	    'type'     => 'checkbox',
	) );
	
	// General Section
	$wp_customize->add_section( 'yoese_general_section', array(
		'title'       => __( 'General', 'yoese' ),
		'priority'    => 15,
		'panel' => 'yoese_panel',
		'description'	=> __( 'General Settings.', 'yoese' ),
	) );
	
	// Layout Style
	$wp_customize->add_setting( 'yoese_layout_style', array(
        'default' => 'site-fullwidth',
        'type' => 'option',
		'capability' => 'edit_theme_options',
        'sanitize_callback' => 'yoese_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'yoese_layout_style', array(
	    'label'    => __( 'Layout Style', 'yoese' ),
	    'description' => __( 'Choose between Full width or Boxed Layout. If you select Boxed Layout option, you can edit Background Settings.', 'yoese' ),
	    'section'  => 'yoese_general_section',
	    'settings' => 'yoese_layout_style',
	    'priority' => 1,
	    'type'     => 'select',
		'choices'  => array(
			'site-fullwidth' => __('Full Width', 'yoese'),
			'site-boxed' => __('Boxed', 'yoese'),
			),
	) );
	
	// Read More
	$wp_customize->add_setting( 'yoese_read_more', array(
        'default' => '',
        'sanitize_callback' => 'yoese_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'yoese_read_more', array(
	    'label'    => __( 'Show Read More Link', 'yoese' ),
	    'section'  => 'yoese_general_section',
	    'settings' => 'yoese_read_more',
	    'type'     => 'checkbox',
	) );
		
	// Blog Section
	$wp_customize->add_section( 'yoese_blog_section', array(
		'title'       => __( 'Blog', 'yoese' ),
		'priority'    => 20,
		'panel' => 'yoese_panel',
		'description'	=> __( 'Settings for Blog Homepage.', 'yoese' ),
	) );
	
	// Blog Layout
	$wp_customize->add_setting( 'yoese_blog', array(
        'default' => 'layout2',
        'sanitize_callback' => 'yoese_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'yoese_blog', array(
	    'label'    => __( 'Blog Layout', 'yoese' ),
	    'section'  => 'yoese_blog_section',
	    'settings' => 'yoese_blog',
	    'type'     => 'select',
		'choices'  => array(
			'layout1' => __('List: Small Thumbnail + Sidebar', 'yoese'),
			'layout2' => __('List: Medium Thumbnail + Sidebar', 'yoese'),
			'layout3' => __('Classic: Large Posts + Sidebar', 'yoese'),
			'layout11' => __('Full Content Post + Sidebar', 'yoese'),
			),
	) );
	
	// Archive Section
	$wp_customize->add_section( 'yoese_archive_section', array(
		'title'       => __( 'Categories and Archives', 'yoese' ),
		'priority'    => 25,
		'panel' => 'yoese_panel',
		'description'	=> __( 'Settings for Category, Tag, Search result, Author and Archive Pages.', 'yoese' ),
	) );
	
	// Archive Layout
	$wp_customize->add_setting( 'yoese_archive', array(
        'default' => 'layout2',
        'sanitize_callback' => 'yoese_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'yoese_archive', array(
	    'label'    => __( 'Archives Layout', 'yoese' ),
	    'section'  => 'yoese_archive_section',
	    'settings' => 'yoese_archive',
	    'type'     => 'select',
		'choices'  => array(
			'layout1' => __('Small Thumbnail + Sidebar', 'yoese'),
			'layout2' => __('Medium Thumbnail + Sidebar', 'yoese'),
			'layout3' => __('Classic: Large Posts + Sidebar', 'yoese'),
			),
	) );
	
	// Single Post Section
	$wp_customize->add_section( 'yoese_post_section', array(
		'title'       => __( 'Single Post', 'yoese' ),
		'priority'    => 30,
		'panel' => 'yoese_panel',
	) );
	
	// Featured Image
	$wp_customize->add_setting( 'yoese_post_featured_image', array(
        'default' => '',
        'sanitize_callback' => 'yoese_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'yoese_post_featured_image', array(
	    'label'    => __( 'Show Featured Image', 'yoese' ),
	    'section'  => 'yoese_post_section',
	    'settings' => 'yoese_post_featured_image',
	    'type'     => 'checkbox',
	) );
	
	// Featured Image Size
	$wp_customize->add_setting( 'yoese_post_featured_image_size', array(
        'default' => 'default',
        'sanitize_callback' => 'yoese_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'yoese_post_featured_image_size', array(
	    'description' => __( 'Featured Image Size', 'yoese' ),
	    'section'  => 'yoese_post_section',
	    'settings' => 'yoese_post_featured_image_size',
	    'type'     => 'radio',
		'choices'  => array(
			'default' => __('Default', 'yoese'),
			'fullwidth' => __('Full Width (images must be at least 1120px)', 'yoese'),
			),
		'active_callback' => 'yoese_post_has_featured_image',
	) );
	
	// Page Section
	$wp_customize->add_section( 'yoese_page_section', array(
		'title'       => __( 'Page', 'yoese' ),
		'priority'    => 35,
		'panel' => 'yoese_panel',
	) );
	
	// Featured Image
	$wp_customize->add_setting( 'yoese_page_featured_image', array(
        'default' => '',
        'sanitize_callback' => 'yoese_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'yoese_page_featured_image', array(
	    'label'    => __( 'Show Featured Image', 'yoese' ),
	    'section'  => 'yoese_page_section',
	    'settings' => 'yoese_page_featured_image',
	    'type'     => 'checkbox',
	) );
	
	// Featured Image Size
	$wp_customize->add_setting( 'yoese_page_featured_image_size', array(
        'default' => 'default',
        'sanitize_callback' => 'yoese_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'yoese_page_featured_image_size', array(
	    'label'    => __( 'Featured Image Size', 'yoese' ),
	    'section'  => 'yoese_page_section',
	    'settings' => 'yoese_page_featured_image_size',
	    'type'     => 'radio',
		'choices'  => array(
			'default' => __('Default', 'yoese'),
			'fullwidth' => __('Full Width (images must be at least 1120px)', 'yoese'),
			),
		'active_callback' => 'yoese_page_has_featured_image',
	) );
	
	// Footer Section
	$wp_customize->add_section( 'yoese_footer_section', array(
		'title'       => __( 'Footer', 'yoese' ),
		'priority'    => 40,
		'panel' => 'yoese_panel',
	) );
	
	// Scroll Up
	$wp_customize->add_setting( 'yoese_scroll_up', array(
        'default' => '',
        'sanitize_callback' => 'yoese_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'yoese_scroll_up', array(
	    'label'    => __( 'Show Scroll Up button', 'yoese' ),
	    'section'  => 'yoese_footer_section',
	    'settings' => 'yoese_scroll_up',
	    'type'     => 'checkbox',
	) );
	    	

   $wp_customize->add_setting('yoese_links', array(
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'yoese_links_sanitize',
   ) );

   $wp_customize->add_control(new DL_Important_Links($wp_customize, 'yoese_links', array(
      'section' => 'yoese_links_section',
      'settings' => 'yoese_links',
   ) ) );
   
   // Accent Color
	$wp_customize->add_setting( 'accent_color', array(
		'default' => '#e54e53',
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label' => __( 'Accent Color', 'yoese' ),
		'section' => 'colors',
		'settings' => 'accent_color',
	) ) );
	
	// Header Background
	$wp_customize->add_setting( 'header_background', array(
		'default' => '#ffffff',
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background', array(
		'label' => __( 'Header Background', 'yoese' ),
		'section' => 'colors',
		'settings' => 'header_background',
	) ) );
	
	// Footer Background
	$wp_customize->add_setting( 'footer_background', array(
		'default' => '',
		'type' => 'option', 
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background', array(
		'label' => __( 'Footer Background', 'yoese' ),
		'section' => 'colors',
		'settings' => 'footer_background',
	) ) );
    			
}
add_action('customize_register', 'yoese_theme_customizer');


/**
 * Sanitize Checkbox
 *
 */ 
function yoese_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}


/**
 * Sanitize Radio Buttons and Select Lists
 *
 */
function yoese_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}


/**
 * Sanitizes text: only safe HTML tags (the same tags that are allowed in a standard WordPress post)
 *
 */
function yoese_sanitize_text( $input ) {
    return wp_kses_post( $input );
}


/**
 * Strips all of the HTML in the content
 *
 */ 
function yoese_nohtml_sanitize( $input ) {
    return wp_filter_nohtml_kses( esc_url_raw( $input ) );
}



/**
 * Checks Main Menu Style
 */
function yoese_has_custom_menu( $control ) {
    if ( $control->manager->get_setting('yoese_menu_style')->value() == 'custom' ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Checks Layout Style
 */
function yoese_has_boxed_layout( $control ) {
    if ( $control->manager->get_setting('yoese_layout_style')->value() == 'site-boxed' ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Checks if Post has Featured Image
 */
function yoese_post_has_featured_image( $control ) {
    if ( $control->manager->get_setting('yoese_post_featured_image')->value() == 1 ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Checks is Page has Featured Image
 */
function yoese_page_has_featured_image( $control ) {
    if ( $control->manager->get_setting('yoese_page_featured_image')->value() == 1 ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Get Contrast
 *
 */
function yoese_get_brightness($hex) {
 // returns brightness value from 0 to 255
 // strip off any leading #
 $hex = str_replace('#', '', $hex);

 $c_r = hexdec(substr($hex, 0, 2));
 $c_g = hexdec(substr($hex, 2, 2));
 $c_b = hexdec(substr($hex, 4, 2));

 return (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;
}


/**
 * Add inline Custom CSS for styles handled by the Theme customizer
 *
 */
function yoese_custom_style() { 
	
	$accent_color = esc_attr( get_option('accent_color') ); 
	$header_background = esc_attr( get_option('header_background') );
	$footer_background = esc_attr( get_option('footer_background') );
	$main_menu_background = esc_attr( get_option('main_menu_background') );
	$main_menu_style = get_theme_mod('yoese_menu_style');
	
	$custom_style = "";
			
	// Accent Color
	if ( $accent_color != '' ) {
		$custom_style .= "
		a, .site-title a:hover, .entry-title a:hover,
		.post-navigation .nav-previous a:hover, .post-navigation .nav-previous a:hover span,
		.post-navigation .nav-next a:hover, .post-navigation .nav-next a:hover span,
		.widget a:hover, .block-heading a:hover, .widget_calendar a, .author-social a:hover,
		.top-menu a:hover, .top-menu .current_page_item a, .top-menu .current-menu-item a,
		.nav-previous a:hover span, .nav-next a:hover span, .more-link, .author-social .social-links li a:hover:before { 
	    color: {$accent_color};
	    }
	    button, input[type='button'], input[type='reset'], input[type='submit'],
	    .pagination .nav-links .current, .pagination .nav-links .current:hover, .pagination .nav-links a:hover,
	    .entry-meta .category a, .featured-image .category a, #scroll-up, .large-post .more-link {
		background-color: {$accent_color};
	    }
	    blockquote {
		border-left-color: {$accent_color};
	    }
	    .sidebar .widget-title span:before {
		border-bottom-color: {$accent_color};
	    }";
		if ( yoese_get_brightness($accent_color) > 150) {
	    	$custom_style .= "
			.entry-meta .category a, .featured-image .category a,
			#scroll-up, .search-submit, .large-post .more-link {
			color: rgba(0,0,0,.7);
			} 
			.entry-meta .category a:before {
			background-color: rgba(0,0,0,.7);
			}";
	    } else {
	    	$custom_style .= "
			.entry-meta .category a, .featured-image .category a,
			#scroll-up, .search-submit, .large-post .more-link {
			color: #fff;
			}
			.entry-meta .category a:before {
			background-color: #fff;
			}";
	    }
	} // if $accent_color
	
	// Footer Background
	if ( $footer_background != '' ) { 
		$custom_style .= "
		.site-footer,
		.site-boxed .site-footer {
		background-color: {$footer_background};
		} ";
		
		if ( yoese_get_brightness($footer_background) > 150) {
			$custom_style .= "
			.site-footer .footer-copy, .site-footer .widget, .site-footer .comment-author-link {
			color: rgba(0,0,0,.4);
			}
			.site-footer .footer-copy a, .site-footer .footer-copy a:hover,
			.site-footer .widget a, .site-footer .widget a:hover,
			.site-footer .comment-author-link a, .site-footer .comment-author-link a:hover {
			color: rgba(0,0,0,.5);
			}
			.site-footer .widget-title, .site-footer .widget caption {
			color: rgba(0,0,0,.6);
			}";
		} else {
		$custom_style .= "
			.site-footer .footer-copy, .site-footer .widget, .site-footer .comment-author-link {
			color: rgba(255,255,255,0.5);
			}
			.site-footer .footer-copy a, .site-footer .footer-copy a:hover,
			.site-footer .widget a, .site-footer .widget a:hover,
			.site-footer .comment-author-link a, .site-footer .comment-author-link a:hover {
			color: rgba(255,255,255,0.7);
			}
			.site-footer .widget-title, .site-footer .widget caption {
			color: #fff;
			}
			.site-footer .widget .tagcloud a {
			background-color: transparent;
			border-color: rgba(255,255,255,.1);
			}
			.footer-copy {
			border-top-color: rgba(255,255,255,.1);
			}";
		}
	} // if $footer_background
	
	// Header Background
	if ( $header_background != '' && $header_background != '#ffffff' ) {
		$custom_style .= "
		.site-header {
		background-color: {$header_background};	
		}";
		if ( yoese_get_brightness($header_background) > 150) {
			$custom_style .= "
			.site-title a, .site-description, .top-navigation > ul > li > a {
			color: rgba(0,0,0,.8);
			}
			.site-title a:hover, .top-navigation > ul > li > a:hover {
			color: rgba(0,0,0,.7);
			}";
		} else {
			$custom_style .= "
			.site-title a, .site-description, .top-navigation > ul > li > a {
			color: #fff;
			}
			.site-title a:hover, .top-navigation > ul > li > a:hover {
			color: rgba(255,255,255,0.9);
			}
			.site-header .search-field {
			border: 0;
			}
			.site-header .search-field:focus {
			border: 0;
			background-color: rgba(255,255,255,0.9);
			}";
		}
	} // if $header_background
		
	// Main Menu Custom Background
	if ( $main_menu_background != '' && $main_menu_style == 'custom' ) {
	   	$custom_style .= "
	   	.main-navbar {
		background-color: {$main_menu_background};
		position: relative;
		}
		.mobile-header {
		background-color: {$main_menu_background};
		}
		.main-menu ul {
		background-color: {$main_menu_background};
		}
		.main-menu > li a:hover, .home-link a:hover, .main-menu ul a:hover {
		background-color: rgba(0,0,0,0.05);
		}
		.main-navbar::before {
	    background-color: rgba(0, 0, 0, 0.15);
	    content: '';
	    display: block;
	    height: 4px;
	    position: absolute;
	    top: 0;
	    width: 100%;
		}
		.main-menu > li > a, .home-link a {
		line-height: 24px;
		padding: 12px 12px 10px;
		}";
		if ( yoese_get_brightness($main_menu_background) > 150) {
			$custom_style .= "
			.main-menu > li > a,
			.main-menu ul a,
			.main-navigation .home-link a,
			#mobile-header .mobile-title, 
			#mobile-header .mobile-menu-toggle {
			color: rgba(0,0,0,.8);
			}
			.main-menu > li a:hover,
			.main-menu ul a:hover,
			.home-link a:hover {
			color: rgba(0,0,0,0.9);
			}
			.mobile-header a {
			color: rgba(0,0,0,.9);
			}
			.button-toggle,
			.button-toggle:before,
			.button-toggle:after {
			background-color: rgba(0,0,0,.8);
			} ";
		} else {	
			$custom_style .= "
			.main-menu > li > a,
			.main-menu ul a,
			.home-link a,
			#mobile-header .mobile-title, 
			#mobile-header .mobile-menu-toggle {
			color: #fff;
			}
			.main-menu > li > a:hover,
			.main-menu ul a:hover,
			.home-link a:hover {
			color: rgba(255,255,255,0.9);
			}
			.mobile-header a {
			color: #fff;
			}
			.button-toggle,
			.button-toggle:before,
			.button-toggle:after {
			background-color: #fff;
			}";
		}
	} // if $main_menu_background
	
	// Main Menu Light
	if ( $main_menu_style == 'light' ) {
		$custom_style .= "
		.main-navbar {
		background-color: #fff;
		border-top: 1px solid #eee;
		border-bottom: 1px solid #eee;
		-webkit-box-shadow: 0 3px 2px 0 rgba(0, 0, 0, 0.03);
		box-shadow: 0 3px 2px 0 rgba(0, 0, 0, 0.03);
		}
		.main-menu > li > a,
		.main-navigation .home-link a {
		color: #333;
		border-left: 1px solid #f2f2f2;
		}
		.main-menu > li:last-child > a {
		border-right: 1px solid #f2f2f2;
		}
		.main-menu > li > a:hover,
		.main-navigation .home-link a:hover {
		background-color: #fff;
		color: {$accent_color};
		}
		.main-navigation .home-link a:hover:before,
		.main-menu > li:hover:before,
		.main-menu > li:active:before,
		.main-menu > li.current_page_item:before,
		.main-menu > li.current-menu-item:before {
		content: '';
		position: absolute;
		bottom: 0;
		left: 0;
		display: block;
		width: 100%;
		height: 2px;
		z-index: 2;
		background-color: {$accent_color};	
		}
		.main-menu ul {
		background-color: #fff;
		border: 1px solid #eee;
		}
		.main-menu ul a {
		border-top: 1px solid #f2f2f2;
		color: #555;
		}
		.main-menu ul a:hover {
		color: {$accent_color};
		}
		#mobile-header {
		background-color: #fff;
		border-bottom: 1px solid #eee;
		-webkit-box-shadow: 0 3px 2px 0 rgba(0, 0, 0, 0.03);
		box-shadow: 0 3px 2px 0 rgba(0, 0, 0, 0.03);
		}
		#mobile-header .mobile-title, 
		#mobile-header .mobile-menu-toggle {
		color: #333;
		}
		.button-toggle,
		.button-toggle:before,
		.button-toggle:after {
		background-color: #333;
		} ";
	} // if $main_menu_background
	
	if ( $custom_style != '' ) { 
		wp_add_inline_style( 'yoese-style', $custom_style );
	}
}
add_action( 'wp_enqueue_scripts', 'yoese_custom_style' );
