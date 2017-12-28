<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bloggerbuz
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11"> 
    <?php wp_head(); ?>
    
</head>
<body <?php body_class(); ?>>

   <div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bloggerbuz' ); ?></a>    
      
        <header id="masthead" class="site-header" role="banner">
		    <nav id="site-navigation" class="main-navigation" role="navigation">
                <div class="container">
                
                    <div class="site-text">
                        <?php if(get_theme_mod('custom_logo')){
                            the_custom_logo();
                        }else{ ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                            <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                        </a>
                        <?php } ?>
                    </div>
                    
                    <label for="toggle" class="icon">
                        <span class="ham"> </span>
                    </label>
                    <input type="checkbox" id="toggle">
                    
                    <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
                    
                    <div class="header_social_search_wrap clearfix">
                        <?php if(get_theme_mod('bloggerbuz_hide_header_search')!='1'){ ?>
                            <div class="header-search ">
                                <i class="fa fa-search"></i>
                                <?php get_search_form();?>
                            </div>
                        <?php } ?> 
                    </div>
                    
                </div>
            </nav><!-- #site-navigation -->  
     </header><!-- #masthead -->      
<div id="content" class="site-content">
<?php 
if(!is_home() && !is_front_page()){
    do_action('bloggerbuz_title'); 
}
?>