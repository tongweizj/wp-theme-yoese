<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Yoese
 * @since Yoese 1.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function yoese_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'yoese_jetpack_setup' );
