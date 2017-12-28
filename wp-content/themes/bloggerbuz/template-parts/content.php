<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bloggerbuz
 */
?>
 <article id="post-<?php the_ID(); ?>" <?php post_class('post_content_article single_page_wrap'); ?>>
	<header class="entry-header">
        <?php
        $bloggerbuz_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'bloggerbuz-slider-thumb', false );
        if($bloggerbuz_img_src){ 
        ?>
        <div class="bloggerbuz_img_wrap">
          <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($bloggerbuz_img_src[0]); ?>" /></a>
        </div>
        <?php } ?>	
    </header>
  <div class="entry-content">
     <div class="title_cat_wrap">
      <a class="bloggerbuz_post_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </div>
      <div class="date_comment_author">
         <div class="wrap11">
         <span class="date_post"><?php echo esc_attr(get_the_date()); ?></span>
           <span class="author_post"><?php  echo esc_url(the_author_posts_link()); ?></span>
         </div>        
     </div>
      <div class="recent_post_content">
        
        <?php if(is_home() || is_archive()){ ?>
                <?php the_excerpt(); ?>
                <div class="read_more_share">
                    <a class="continue_link" href="<?php the_permalink(); ?>"><?php esc_html_e('Continue Reading...','bloggerbuz'); ?> <i class="fa fa-angle-right"></i></a>
                </div>
         <?php }else{
            the_content();
            wp_link_pages( array(
              'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bloggerbuz' ),
              'after'  => '</div>',
            ) );
         } ?>
          <div class="bt-comments">   
          <?php comments_number(0); ?>
             <i class="fa fa-comment-o"></i>
          </div>
      </div>

   </div>
</article><!-- #post-## -->
