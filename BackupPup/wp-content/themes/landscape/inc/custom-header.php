<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package landscape
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses landscape_header_style()
 */
function landscape_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'landscape_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/assets/images/default-header.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 1600,
		'height'                 => 650,
		'flex-height'            => true,
		'wp-head-callback'       => 'landscape_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'landscape_custom_header_setup' );

if ( ! function_exists( 'landscape_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see landscape_custom_header_setup().
 */
function landscape_header_style() {
	$header_text_color = get_header_textcolor();
	$featured_image = landscape_check_featured_image();
	$header_image = get_header_image();

	// If no custom options for text or images are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color && empty( $header_image ) ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description,
		.has-header-image .site-branding .site-title a,
		.has-header-image .site-branding .site-description,
		.has-header-image .site-branding a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>

	<?php
		if ( ! empty( $header_image ) && $featured_image == false ) :
			?>
				<style type="text/css">
					#masthead {
						background-image: url(<?php header_image(); ?>);
						background-position: center center;
						-webkit-background-size: cover;
						background-size: cover;
					}

					.has-header-image .site-branding a {
						color: #000;
					}
				</style>
			<?php endif; // endif $featured_image && $header_image
} // landscape_header_style

endif; // ! function_exists( 'landscape_header_style' )