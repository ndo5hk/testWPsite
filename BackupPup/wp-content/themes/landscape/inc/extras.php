<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package landscape
 */


/**
 * Check if a post has a post thumbnail.
 * @uses has_post_thumbnail()
 */
function landscape_check_featured_image() {
	if ( is_singular() && has_post_thumbnail( get_the_ID() ) ) {
		return true;
	}

	return false;
}
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function landscape_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_front_page() ) {
		if ( get_header_image() || ( is_singular() && landscape_check_featured_image() == true ) ) {
			$classes[] = 'has-header-image';
			$classes[] = 'has-header-image-home';
		}
	} elseif ( get_header_image() || ( is_singular() && landscape_check_featured_image() == true ) ) {
		$classes[] = 'has-header-image';
	}

	if ( is_page_template( 'template-parts/homepage-template.php' ) ) {
		$classes[] = 'homepage';
	}

	return $classes;
}
add_filter( 'body_class', 'landscape_body_classes' );

/**
 * Adds featured image as background of site header for single posts/pages if one is set
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function landscape_featured_image_header_css() {
	if ( '' != get_the_post_thumbnail() ) {
		$banner_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'landscape-banner' );
		$banner = $banner_src[0]; ?>
		<style type="text/css">
			#masthead {
				background-image: url(<?php echo esc_url( $banner ); ?>);
				background-position: center center;
				-webkit-background-size: cover;
				background-size: cover;
			}
		</style>
	<?php } else {
		$header_img = get_header_image(); ?>
		<style type="text/css">
			#masthead {
				background-image: url(<?php echo esc_url( $header_img ); ?>);
				background-position: center center;
				-webkit-background-size: cover;
				background-size: cover;
			}
		</style>
	<?php }
}
add_action( 'wp_head', 'landscape_featured_image_header_css' );
