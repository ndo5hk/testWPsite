<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package landscape
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="secondary widget-area" role="complementary">
	<div class="sidebar-wrap">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- .wrap -->
</div><!-- .secondary -->
