<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package landscape
 */

if ( ! function_exists( 'landscape_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function landscape_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'landscape' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'landscape' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'landscape_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function landscape_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'landscape' ) );
		if ( $categories_list && landscape_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'landscape' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'landscape' ) );
		if ( $tags_list ) {
						printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'landscape' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'landscape' ), esc_html__( '1 Comment', 'landscape' ), esc_html__( '% Comments', 'landscape' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'landscape' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function landscape_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'landscape_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'landscape_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so landscape_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so landscape_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in landscape_categorized_blog.
 */
function landscape_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'landscape_categories' );
}
add_action( 'edit_category', 'landscape_category_transient_flusher' );
add_action( 'save_post',     'landscape_category_transient_flusher' );

/**
 * Display info pages on Homepage.
 */
function landscape_info_pages() {
	$featured_page_1 = esc_attr( get_theme_mod( 'landscape_featured_page_one_front_page', '0' ) );
	$featured_page_2 = esc_attr( get_theme_mod( 'landscape_featured_page_two_front_page', '0' ) );
	$featured_page_3 = esc_attr( get_theme_mod( 'landscape_featured_page_three_front_page', '0' ) );

	if ( 0 == $featured_page_1 && 0 == $featured_page_2 && 0 == $featured_page_3 ) {
		get_sidebar();
	}
?>

	<div class="featured-page-area">
		<?php for ( $page_number = 1; $page_number <= 3; $page_number++ ) : ?>
			<?php if ( 0 != ${'featured_page_' . $page_number} ) : // Check if a featured page has been set in the customizer ?>

				<?php
					// Create new argument using the page ID of the page set in the customizer
					$featured_page_args = array(
						'page_id' => ${'featured_page_' . $page_number},
					);
					// Create a new WP_Query using the argument previously created
					$featured_page_query = new WP_Query( $featured_page_args );
				?>
				<?php while ( $featured_page_query->have_posts() ) : $featured_page_query->the_post(); ?>

					<div class="featured-page">
						<?php get_template_part( 'template-parts/content', 'info-pages' ); ?>
					</div>
				<?php
					endwhile;
					wp_reset_postdata();
				?>

			<?php endif; ?>
		<?php endfor; ?>
	</div>

<?php
}

/*	Custom Excerpt  */

if( ! function_exists( 'landscape_excerpt_length' ) ) {
    function landscape_excerpt_length( $length ) {
    	return 30;
    }
    add_filter( 'excerpt_length', 'landscape_excerpt_length' );
}

/**
 * Returns a "Continue Reading" link for excerpts
 */
function landscape_reading_link() {
	return ' <span class="more-link"><a href="'. esc_url( get_permalink() ) . '">' . __( 'Read More', 'landscape' ) . '</a></span>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and landscape_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function landscape_auto_excerpt_more( $more ) {
	return '...' . landscape_reading_link();
}
add_filter( 'excerpt_more', 'landscape_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function landscape_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= landscape_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'landscape_custom_excerpt_more' );

/**
 * Add excerpt module to pages
 */
function landscape_excerpt() {
     add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'landscape_excerpt' );
