<?php
/**
 * landscape functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package landscape
 */

if ( ! function_exists( 'landscape_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function landscape_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on landscape, use a find and replace
	 * to change 'landscape' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'landscape', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-thumbnail', 1600, 600, true );
	add_image_size( 'index-thumbnail', 1000, 200, true );
	add_image_size( 'homepage-thumbnail', 684, 475, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'landscape' ),
		'social' => esc_html__( 'Social Menu', 'landscape' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add styles to the post editor
	add_editor_style( array( 'editor-style.css', landscape_font_url() ) );

}
endif; // landscape_setup
add_action( 'after_setup_theme', 'landscape_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function landscape_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'landscape_content_width', 1000 );
}
add_action( 'after_setup_theme', 'landscape_content_width', 0 );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 */
function landscape_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'landscape' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'landscape_widgets_init' );

/**
 * Register Google font.
 */
function landscape_font_url() {
	$fonts_url = '';
	 
	/* Translators: If there are characters in your language that are not
	* supported by libre, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$libre = _x( 'on', 'libre font: on or off', 'landscape' );
	 
	/* Translators: If there are characters in your language that are not
	* supported by Open Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'landscape' );
	 
	if ( 'off' !== $libre || 'off' !== $open_sans ) {
	$font_families = array();
	 
	if ( 'off' !== $libre ) {
	$font_families[] = 'Libre Baskerville:400,700';
	}
	 
	if ( 'off' !== $open_sans ) {
	$font_families[] = 'Open Sans:700italic,400,800,600';
	}
	 
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);
	 
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	 
	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function landscape_scripts() {
	wp_enqueue_style( 'landscape-style', get_stylesheet_uri() );

	wp_enqueue_style( 'landscape-google-font', landscape_font_url(), array(), null );

	wp_register_style( 'landscape-genericons', get_stylesheet_directory_uri() . '/assets/fonts/genericons/genericons.css', array(), '3.4.1', true );

	wp_enqueue_style( 'landscape-genericons' );

	wp_register_style( 'landscape-social-logos', get_stylesheet_directory_uri() . '/assets/fonts/social-logos/social-logos.css', array() );

	wp_enqueue_style( 'landscape-social-logos' );

	 wp_enqueue_style( 'landscape-dashicons', get_stylesheet_uri(), array( 'dashicons' ), '1.0' );

	wp_enqueue_script( 'landscape-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'landscape-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'landscape_scripts' );


/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
