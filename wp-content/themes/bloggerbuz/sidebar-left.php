<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bloggerbuz
 * @subpackage Bloggerbuz
 * @since 1.0.0
 */


?>
   <aside id="secondary" class="left-sidebar widget-area" role="complementary">
    	<?php 
    		if ( ! is_active_sidebar( 'bloggerbuz-sidebar-left' ) ) { return; }
    		dynamic_sidebar( 'bloggerbuz-sidebar-left' ); 
        ?>
   </aside><!-- #secondary -->