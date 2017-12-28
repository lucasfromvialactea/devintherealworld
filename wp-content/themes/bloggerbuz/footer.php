<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bloggerbuz
 */
?>
</div> 
</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <!-- Fotter Widget Area -->
      <div id="footer-widgets">
            <div class="container">
               <div id="footer-one">
                  <?php
                  if(is_active_sidebar('bloggerbuz-footer-one')){
                        dynamic_sidebar('bloggerbuz-footer-one');
                  }
                    ?>
                </div>
                <div id="footer-two">
                       <?php
                       if(is_active_sidebar('bloggerbuz-footer-two')){
                            dynamic_sidebar('bloggerbuz-footer-two');
                       }
                      ?>
                 </div>
                 <div id="footer-three">
                          <?php
                           if(is_active_sidebar('bloggerbuz-footer-three')){
                                dynamic_sidebar('bloggerbuz-footer-three');
                           }
                         ?>
                 </div>
                 <div id="footer-four">
                      <?php
                           if(is_active_sidebar('bloggerbuz-footer-four')){
                                dynamic_sidebar('bloggerbuz-footer-four');
                           }
                         ?>
                 </div>
       </div>
       <div class="site-info">
              <div class="container">
                  <div class="footer_btm_left">
                     <?php
                      $bloggerbuz_footer_copyright_text = get_theme_mod('bloggerbuz_footer_text_setting');
                      ?><a href="<?php echo esc_url('http://buzthemes.com/wordpress_themes/bloggerbuz/' ); ?>"><?php printf( esc_html__( 'Bloggerbuz', 'bloggerbuz' ) ); ?></a><?php echo esc_html__( '  |  Powered by WordPress' , 'bloggerbuz' );?>
                      <div id="ed-top"><i class="fa fa-arrow-up"></i></div>
                      <?php wp_footer(); ?>
                   </div>
                   <div class="footer_social_icon_front_footer">
                     <?php 
                     $bloggerbuz_footer_social_link = get_theme_mod('bloggerbuz_footer_social_icon_enable');
                     if($bloggerbuz_footer_social_link){
                     do_action('bloggerbuz_header_footer_social_link_action');
                     } ?>
                  </div>
               </div><!-- .site-info -->
         </div>
    </div>
 </footer><!-- #colophon -->
</div><!-- #page -->
</body>
</html>
