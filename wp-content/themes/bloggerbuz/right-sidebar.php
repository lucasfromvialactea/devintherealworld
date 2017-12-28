<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bloggerbuz
 */

if ( ! is_active_sidebar( 'bloggerbuz-right-side-bar' ) ) {
	return;
}
?>
<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'bloggerbuz-right-side-bar' ); ?>
</aside><!-- #secondary -->







