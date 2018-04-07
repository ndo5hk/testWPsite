<?php
/**
 * The template used for displaying page content on the homepage
 *
 * @package landscape
 */
?>

<article class="featured-items">
	<header class="entry-header">
		<?php if ( '' != get_the_post_thumbnail() ) : ?>
			<div class="front-featured"><a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'homepage-thumbnail' ); ?></a></div>
		<?php endif; ?>

		<?php the_title( sprintf( '<h3 class="featured-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
