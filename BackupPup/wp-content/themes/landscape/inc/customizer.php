<?php
/**
 * landscape Theme Customizer
 *
 * @package landscape
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function landscape_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_section( 'landscape_theme_options', array(
		'title'    => __( 'Landscape Options', 'landscape' ),
		'priority' => 130,
	) );

	/* Front Page: Featured Page One */
	$wp_customize->add_setting( 'landscape_featured_page_one_front_page', array(
		'default'           => '',
		'sanitize_callback' => 'landscape_sanitize_pages',
	) );
	$wp_customize->add_control( 'landscape_featured_page_one_front_page', array(
		'label'             => __( 'Homepage: Featured Page One', 'landscape' ),
		'section'           => 'landscape_theme_options',
		'priority'          => 2,
		'type'              => 'dropdown-pages',
	) );

	/* Front Page: Featured Page Two */
	$wp_customize->add_setting( 'landscape_featured_page_two_front_page', array(
		'default'           => '',
		'sanitize_callback' => 'landscape_sanitize_pages',
	) );
	$wp_customize->add_control( 'landscape_featured_page_two_front_page', array(
		'label'             => __( 'Homepage: Featured Page Two', 'landscape' ),
		'section'           => 'landscape_theme_options',
		'priority'          => 3,
		'type'              => 'dropdown-pages',
	) );

	/* Front Page: Featured Page Three */
	$wp_customize->add_setting( 'landscape_featured_page_three_front_page', array(
		'default'           => '',
		'sanitize_callback' => 'landscape_sanitize_pages',
	) );
	$wp_customize->add_control( 'landscape_featured_page_three_front_page', array(
		'label'             => __( 'Homepage: Featured Page Three', 'landscape' ),
		'section'           => 'landscape_theme_options',
		'priority'          => 4,
		'type'              => 'dropdown-pages',
	) );
}
add_action( 'customize_register', 'landscape_customize_register' );

/**
 * Sanitize the drop down select
 */
function landscape_sanitize_pages( $input ) {
	if( is_numeric( $input ) ) {
		return intval( $input );
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function landscape_customize_preview_js() {
	wp_enqueue_script( 'landscape_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'landscape_customize_preview_js' );