<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bloggerbuz
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
        <?php
        $bloggerbuz_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'bloggerbuz-slider-thumb', false );
        if($bloggerbuz_img_src){ 
        ?>
        <div class="bloggerbuz_img_wrap">
          <img src="<?php echo esc_url($bloggerbuz_img_src[0]); ?>" />
        </div>
        <?php } ?>
   </header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		 the_content();
         wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bloggerbuz' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'bloggerbuz' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
