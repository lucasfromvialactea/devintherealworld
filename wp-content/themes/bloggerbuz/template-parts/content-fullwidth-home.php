<?php
/**
 * The template used for displaying latest post in full width in home page
 *
 * @package Bloggerbuz
 */
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('post_content_article'); ?>>
    
        <?php
        $bloggerbuz_comment_count = get_comments_number();
        $bloggerbuz_slide_cat = get_the_category();?>
        <div class="entry-content">
            <?php
                $bloggerbuz_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'bloggerbuz-slider-thumb');
                if($bloggerbuz_img_src){ 
            ?>
            <div class="bloggerbuz_img_wrap">
              <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($bloggerbuz_img_src[0]); ?>" /></a>
            </div>
            <?php } ?>
            <div class="title_cat_wrap">
                <a class="bloggerbuz_post_title" href="<?php the_permalink(); ?>"><?php echo esc_attr(get_the_title()); ?></a>
            </div>
                <div class="date_comment_author">
                    <div class="wrap11">
                        <span class="date_post"><?php echo esc_attr(get_the_date(get_option('date_format'))); ?></span>
                        <span class="author_post"><?php  echo esc_url(the_author_posts_link()); ?></span>
                    </div>        
                </div>
             <div class="excerpt_post_content">
              <?php the_excerpt(); ?>
             </div>
             <div class="read_more_share">
                 <a class="continue_link" href="<?php the_permalink(); ?>"><?php  esc_html_e('Continue Reading...','bloggerbuz'); ?> <i class="fa fa-angle-right"></i></a>
                 <div class="bt-comments">   
                      <?php comments_number(0); ?>
                      <i class="fa fa-comment-o"></i>
                  </div>

             </div>
       </div><!-- .entry-content -->
    </article><!-- #post-## -->