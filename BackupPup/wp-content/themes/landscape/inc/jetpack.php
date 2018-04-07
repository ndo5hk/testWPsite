<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package landscape-pro
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function landscape_pro_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'render'         => 'landscape_pro_infinite_scroll_render',
		'footer'         => 'page',
		'footer_widgets' => true,
	) );
} // end function landscape_pro_jetpack_setup
add_action( 'after_setup_theme', 'landscape_pro_jetpack_setup' );

/**
 * Prevent Jetpack from enabling modules by default.
 */
add_filter( 'jetpack_get_default_modules', '__return_empty_array', 99 );


/**
 * Custom render function for Infinite Scroll.
 */
function landscape_pro_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function landscape_pro_infinite_scroll_render
