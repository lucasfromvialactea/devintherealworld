<?php
/**
 * Recent Post
 *
 * @package bloggerbuz
 */

/**
 * Adds Recent post display widget.
 */
add_action( 'widgets_init', 'bloggerbuz_register_author_widget' );
function bloggerbuz_register_author_widget() {
    register_widget( 'bloggerbuz_author_widget' );
}
class bloggerbuz_Author_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'bloggerbuz_author',
			esc_html__('Bloggerbuz : Author','bloggerbuz'),
    			array(
    				'description'	=> esc_html__( 'A widget To Display Recent Posts', 'bloggerbuz' )
    			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
        $page_list = bloggerbuz_page_lists();
		$fields = array(
            'author_title' => array(
                'bloggerbuz_widgets_name' => 'author_title',
                'bloggerbuz_widgets_title' => esc_html__('Title','bloggerbuz'),
                'bloggerbuz_widgets_field_type' => 'text',
            ),
			'author_post' => array(
                'bloggerbuz_widgets_name' => 'author_post',
                'bloggerbuz_widgets_title' => esc_html__('About Author Post','bloggerbuz'),
                'bloggerbuz_widgets_field_type' => 'select',
                'bloggerbuz_widgets_description' => esc_html__('To Display Author Detail & Image','bloggerbuz'),
                'bloggerbuz_widgets_field_options' => $page_list,
            ),
            'author_description_excerpt' => array(
                'bloggerbuz_widgets_name' => 'author_description_excerpt',
                'bloggerbuz_widgets_title' => esc_html__('Excerpt Content','bloggerbuz'),
                'bloggerbuz_widgets_field_type' => 'number',
                'bloggerbuz_widgets_description' => esc_html__('Set Author Dscription Excerpt Content','bloggerbuz'),
            ),
		);
		
		return $fields;
	 }


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
        extract($args);
            
        $author_post = isset($instance['author_post']) ? $instance['author_post'] : '';
        $author_description_excerpt = isset($instance['author_description_excerpt']) ? $instance['author_description_excerpt'] : '';
        if($author_description_excerpt == ''){
            $author_description_excerpt = 20;
        }
        $author_post_query = new WP_Query(array('post_type' =>'page','post__in'=> array($author_post)));
        echo $before_widget;
            $title_widget = apply_filters( 'widget_title', empty( $instance['author_title'] ) ? '' : $instance['author_title'], $instance, $this->id_base );
            if (!empty($title_widget)):
                echo $args['before_title'] . esc_attr($title_widget) . $args['after_title'];
            endif;
            
            if($author_post_query->have_posts()) : ?>
                <?php while($author_post_query->have_posts()) : $author_post_query->the_post(); ?>
                    <div class="author-detail-wrap">
                        <?php
                        $author_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'bloggerbuz-author-thumb');
                        if($author_image[0]){
                        ?>
                        <div class="author-iage">
                            <img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo esc_url($author_image[0]); ?>" />
                        </div>
                        <?php } ?>
                        <?php if(get_the_content() || get_the_title()){ ?>
                        <div class="author-content">
                        
                            <?php if(get_the_title()){ ?>
                                <a href="<?php the_permalink(); ?>"><h2 class="author-title"><?php the_title(); ?></h2></a>
                            <?php } ?>
                            
                            <?php if(get_the_content()){ ?>
                                <p>
                                    <?php echo esc_attr(wp_trim_words(get_the_content(),$author_description_excerpt,'...')); ?>
                                </p>
                            <?php } ?>
                        
                        </div>
                        <?php } ?>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif; 
            
        echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param	array	$new_instance	Values just sent to be saved.
	 * @param	array	$old_instance	Previously saved values from database.
	 *
	 * @uses	bloggerbuz_widgets_updated_field_value()		defined in widget-fields.php
	 *
	 * @return	array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {

			extract( $widget_field );
	
			// Use helper function to get updated field values
			$instance[$bloggerbuz_widgets_name] = bloggerbuz_widgets_updated_field_value( $widget_field, $new_instance[$bloggerbuz_widgets_name] );
			
		}
				
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param	array $instance Previously saved values from database.
	 *
	 * @uses	accesspress_pro_widgets_show_widget_field()		defined in widget-fields.php
	 */
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
			// Make array elements available as variables 
			extract( $widget_field );
			$bloggerbuz_widgets_field_value = isset( $instance[$bloggerbuz_widgets_name] ) ? esc_attr( $instance[$bloggerbuz_widgets_name] ) : '';
			bloggerbuz_widgets_show_widget_field( $this, $widget_field, $bloggerbuz_widgets_field_value );
		}	
	}
}