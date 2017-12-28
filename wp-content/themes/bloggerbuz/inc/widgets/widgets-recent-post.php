<?php
/**
 * Recent Post
 *
 * @package bloggerbuz
 */

/**
 * Adds Recent post display widget.
 */
add_action( 'widgets_init', 'bloggerbuz_register_recent_posts_widget' );
function bloggerbuz_register_recent_posts_widget() {
    register_widget( 'bloggerbuz_recent_posts_widget' );
}
class bloggerbuz_recent_posts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'bloggerbuz_recent_posts',
			esc_html__('Bloggerbuz : Recent Posts','bloggerbuz'),
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
        $bloggerbuz_category_lists 	=	bloggerbuz_category_lists();
		$fields = array(
            'recent_post_title' => array(
                'bloggerbuz_widgets_name' => 'recent_post_title',
                'bloggerbuz_widgets_title' => esc_html__('Title','bloggerbuz'),
                'bloggerbuz_widgets_field_type' => 'text',
            ),
            'recent_post_category' => array(
                'bloggerbuz_widgets_name' => 'recent_post_category',
                'bloggerbuz_widgets_title' => esc_html__('Recent Post Category','bloggerbuz'),
                'bloggerbuz_widgets_field_type' => 'select',
                'bloggerbuz_widgets_description' => esc_html__('If you leave recent category empty widget will show recent posts','bloggerbuz'),
                'bloggerbuz_widgets_field_options' => $bloggerbuz_category_lists,
            ),
			'recent_post_show_num' => array(
                'bloggerbuz_widgets_name' => 'recent_post_show_num',
                'bloggerbuz_widgets_title' => esc_html__('No of posts to show','bloggerbuz'),
                'bloggerbuz_widgets_field_type' => 'number',
                'bloggerbuz_widgets_description' => esc_html__('Displays the latest five post if left empty','bloggerbuz'),
            ),
            'recent_post_show_img' => array(
                'bloggerbuz_widgets_name' => 'recent_post_show_img',
                'bloggerbuz_widgets_title' => esc_html__('Display post image','bloggerbuz'),
                'bloggerbuz_widgets_field_type' => 'checkbox',
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
            
        $post_num = isset( $instance['recent_post_show_num'] ) ? $instance['recent_post_show_num'] : '5' ;
        $recent_post_category = isset( $instance['recent_post_category'] ) ? $instance['recent_post_category'] : '' ;
        $show_img = isset($instance['recent_post_show_img']) ? $instance['recent_post_show_img'] : '';
        $recent_post_query = new WP_Query(array('post_type' =>'post','category_name' => $recent_post_category,'posts_per_page' => $post_num,'order' => 'DESC','status' => 'publish'));
        echo $before_widget;
        
            $title_widget = apply_filters( 'widget_title', empty( $instance['recent_post_title'] ) ? '' : $instance['recent_post_title'], $instance, $this->id_base );
            if (!empty($title_widget)):
                echo $args['before_title'] . esc_attr($title_widget) . $args['after_title'];
            endif;
            
            if($recent_post_query->have_posts()) : ?>
                <?php while($recent_post_query->have_posts()) : $recent_post_query->the_post(); ?>
                
                <div class="recent-post-wrap">
                    
                    <?php if($show_img):
                    
                        $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'bloggerbuz-recent-post-thumb', false ); 
                        if($img_src[0]){ ?>
                            <div class="image_wrap_recent">
                                <a href="<?php the_permalink(); ?>" class="img_recent_post_img"><img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo esc_url($img_src[0]); ?>"/></a>
                            </div>
                        <?php } ?>
                    
                    <?php endif; ?>
                    
                    <div class="recent-post-content">
                        <?php if(get_the_title()){ ?>
                            <a href="<?php the_permalink(); ?>" class="recent-post-title-widget"><?php the_title(); ?></a>
                        <?php } ?>
                        <span class="date_recent_post"><?php echo esc_attr(wp_trim_words(get_the_content(),10,'...')); ?></span>
                    </div>
                    
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