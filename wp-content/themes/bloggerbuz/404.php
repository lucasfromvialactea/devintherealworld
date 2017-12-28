<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Bloggerbuz
 */

get_header(); ?>
<div class="container">
    <div class="bt-wrapper">
        <div class="ht-container">
            <div class="oops-text"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bloggerbuz' ); ?></div>
        </div>
        <div class="page-404"></div>
        <div class="page-content">
        
            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'bloggerbuz' ); ?></p>
            
            <?php get_search_form(); ?>
        
        </div><!-- .page-content -->
    </div>
</div>
<?php get_footer(); ?>
