<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package landscape
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( ! is_front_page() ) { 
			get_sidebar(); 
		} // end if ?>

		<div class="site-info">
			<?php printf( esc_html__( '%1$s %2$s.', 'landscape' ), 'Powered by', '<a href="https://wordpress.org/">WordPress</a>' ); ?>

			<?php printf( esc_html__( '%1$s by %2$s.', 'landscape' ), 'Landscape', '<a href="https://diversethemes.com" rel="designer">Diverse Themes</a>' ); ?>
		</div><!-- .site-info -->

		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav id="social-navigation" class="social-navigation" role="navigation">
				<?php
					// Social links navigation menu.
					wp_nav_menu( array(
						'theme_location' => 'social',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					) );
				?>
			</nav><!-- .social-navigation -->
		<?php endif; // end social nav check ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
