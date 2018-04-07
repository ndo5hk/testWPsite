<?php
/*
 * Template Name: Homepage template
 *
 * @package landscape
*/

get_header(); ?>

	<div class="wrap">

		<div class="primary content-area">
			<main id="main" class="site-main intro" role="main">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); global $more;
$more = 0; ?>

				<div class="entry-content">
					<?php the_content('<a href="'. get_permalink($post->ID) . '">' . 'Read More' . '</a>.'); ?>
					
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'landscape' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->

			<?php endwhile; ?>

			</main><!-- #main -->
		</div><!-- .primary -->

	<?php landscape_info_pages(); ?>

	</div><!-- .wrap -->

<?php get_footer(); ?>