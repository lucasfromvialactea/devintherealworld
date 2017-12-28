<?php
/**
* The main template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @package Bloggerbuz
* @since Bloggerbuz
*/

get_header(); ?>
<!-- RECENT POST -->
<div class="container">
    <div class="inner-container">
        <div class="bloggerbuz-wrapper default_home">
            <div id="primary" class="content-area">
            
                <div class="bloggerbuz-wrapper default_home">
                    <main id="main" class="site-main clearfix" role="main">
                    
                        <?php if ( have_posts() ) : 
                        
                                $bloggerbuz_layout_home = get_theme_mod('bloggerbuz_home_page_layout_setting');
                                if($bloggerbuz_layout_home == ''){
                                    $bloggerbuz_layout_home = 'fullwidth-home';
                                }
                                
                                /* Start the Loop */ 
                                while ( have_posts() ) : the_post(); 
                                
                                    get_template_part( 'template-parts/content', $bloggerbuz_layout_home );
                                
                                endwhile;
                                
                                the_posts_pagination(); 
                                else :
                                    get_template_part( 'template-parts/content', 'none' );
                                wp_reset_postdata(); ?>
                                
                        <?php endif; ?>
                    
                    </main><!-- #main -->
                </div>
                
            </div><!-- #primary -->
        <?php bloggerbuz_get_sidebar();?>
        </div>
    </div>
</div>
<?php get_footer();?>