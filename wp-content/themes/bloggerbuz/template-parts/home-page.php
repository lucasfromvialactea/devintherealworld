<?php
/**
 * Template Name: Home Page
 */
get_header(); ?> 
<!-- SLIDER SECTION -->
    <?php
    if(is_home() || is_front_page() ):
        $bloggerbuz_slider_enable = get_theme_mod('bloggerbuz_homepage_setting_slider_section_option','no');
        if($bloggerbuz_slider_enable == 'yes'){ 
            $bloggerbuz_slider_cat = get_theme_mod('bloggerbuz_homepage_setting_slider_section_category');?>
            <div class="bloggerbuz-slider-wrapper">
                <div class="bloggerbuz-container">
                    <?php do_action('bloggerbuz_home_slider'); ?>
                </div>
            </div>
        <?php }
    endif; ?>
    <div class="container">
    
        <!---FEATURE SECTION STARTING-->
        <?php
        if(get_theme_mod('bloggerbuz_option','disable') == 'enable'):
            $feature_cat = esc_attr(get_theme_mod('bloggerbuz_homepage_setting_feature_section_category',''));
            if($feature_cat):
                $args_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' =>-1, 'category_name' => $feature_cat));  
                if ($args_query->have_posts()) :?>
                    
                    <section id="feature-section" class="feature-slider-section">
                        <div class="container">
                        <ul class="feature-slider">
                        
                            <?php
                            while ($args_query->have_posts()):
                                $args_query->the_post();
                                $feature_slider_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'bloggerbuz-feature-thumb');
                                ?>
                                <li class="slide">
                                    <div class="slide-caption">
                                            <?php if(has_post_thumbnail()): ?>
                                            <div class="feature-image">
                                                <img src="<?php echo esc_url($feature_slider_image[0]); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                                            </div>
                                            <?php endif; ?>
                                            
                                            <div class="slide-content">
                                                <?php if(get_the_title()){ ?>
                                                    <a class="caption-title" href="<?php the_permalink(); ?>"><?php the_title();?></a>
                                                <?php } ?>
                                                <div class="wrap11">
                                                    <span class="date-post"><?php echo esc_attr(get_the_date()); ?></span>
                                                    <span class="author-post"><?php echo esc_attr(get_the_author()); ?></span>              
                                                </div>
                                            </div> 
                                    </div>
                                </li>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        
                        </ul>
                        </div>
                    </section>
                    
                    <?php 
                endif;
            endif;
        endif;
        
        ?>
        <!--HIGHLIGHTED SECTION STARTING-->
        <div class="inner-container">
            <div class="bloggerbuz-wrapper default_home">
                <div id="primary" class="content-area">
                    <?php
                    if (get_theme_mod('bloggerbuz_highlighted_option','disable')=='enable') {
                        $post_id = get_theme_mod('bloggerbuz_highlighted_setting_post');
                        if($post_id):
                            ?>
                            <section class="highlighted">
                                <?php
                                $highlighted_query = new WP_Query(array('post_type'=>'post', 'post__in' => array($post_id), 'post_status' => 'publish'));
                                if ($highlighted_query->have_posts()):
                                    while ($highlighted_query->have_posts()):
                                        $highlighted_query->the_post();
                                        $image_highlighted = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'bloggerbuz-slider-thumb',true); ?>
                                        
                                        <?php if ($image_highlighted[0]): ?>
                                            <a href="<?php the_permalink();?>">
                                                <figure class="highlighted-img" >
                                                        <img src="<?php echo esc_url($image_highlighted[0]); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                                                </a>
                                                <div class="date_comment_author">
                                                    <div class="wrap11">
                                                        <span class="date_post"><?php echo esc_attr(get_the_date(get_option('date_format'))); ?></span>
                                                        <span class="author_post"><?php  echo esc_url(the_author_posts_link()); ?></span>
                                                        <?php comments_number(0); ?>
                                                         <i class="fa fa-comment-o"></i>
                                                    </div>        
                                                 </div>
                                                </figure>
                                            
                                        <?php endif; ?>
                                        <?php if(get_the_title()){ ?>
                                            <div class="highlighted-content-wrap">
                                                <a class="title home-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            
                                                <div class="highlighted-section-desc">
                                                    <?php echo esc_attr(wp_trim_words(get_the_content(),70,'&hellip;')); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                    ?>
                                <?php if(get_the_content()){ ?>
                                    <div class="recent_post_content"><?php the_excerpt(); ?></div>
                                <?php } ?>
                            </section>
                            <?php
                        endif;
                    }
                    ?>
          <div class="bloggerbuz-wrapper default_home">
		     <main id="main" class="site-main clearfix" role="main">
              
              <?php
                $home_query = new WP_Query(array('post_type' => 'post'));
               if ( $home_query->have_posts() ) :
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $home_query = new WP_Query(array('post_type' => 'post','paged' => $paged));
                        $bloggerbuz_layout_home = get_theme_mod('bloggerbuz_home_page_layout_setting');
                        if($bloggerbuz_layout_home == ''){
                            $bloggerbuz_layout_home = 'fullwidth-home';
                        }
                          
                        while ($home_query-> have_posts() ) : $home_query->the_post(); 
                        
                            get_template_part( 'template-parts/content', $bloggerbuz_layout_home );
                        
                        endwhile;
                        
                        else :
                            get_template_part( 'template-parts/content', 'none' );
                        wp_reset_postdata(); ?>
                        
              <?php endif; ?>
             
             </main><!-- #main -->
             <?php $total_pages = $home_query->max_num_pages; ?>
                                <div class="nav-pagination">
                                    <nav class="pagination-wrap">
                                        <?php
                                        if ($total_pages > 1){
                                            $current_page = max(1, get_query_var('paged'));
                                            echo paginate_links(array(
                                                'base' => get_pagenum_link(1) . '%_%',
                                                'format' => '/page/%#%',
                                                'current' => $current_page,
                                                'total' => $total_pages,
                                                'prev_text'    => ('<'),
                                                'next_text'    => ('>'),
                                            ));
                                        }
                                        ?>
                                    </nav>
                                </div>
           </div>
         </div><!-- #primary -->
                <?php bloggerbuz_get_sidebar();?>
       </div>
   </div>
</div>
<?php get_footer();?>