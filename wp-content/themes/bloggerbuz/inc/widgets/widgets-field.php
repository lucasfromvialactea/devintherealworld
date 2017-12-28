<?php
/**
 * Define fields for Widgets.
 * 
 * @package bloggerbuz
 */

function bloggerbuz_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
	$bloggerbuz_pagelist[0] = array(
        'value' => 0,
        'label' => esc_html__('--choose--','bloggerbuz')
    );
    $arg = array('posts_per_page'   => -1);
    $bloggerbuz_pages = get_pages($arg);
    foreach($bloggerbuz_pages as $bloggerbuz_page) :
        $bloggerbuz_pagelist[$bloggerbuz_page->ID] = array(
            'value' => $bloggerbuz_page->ID,
            'label' => $bloggerbuz_page->post_title
        );
    endforeach;
    //print_r($widget_field);
	extract( $widget_field );
	
	switch( $bloggerbuz_widgets_field_type ) {
	
		// Standard text field
		case 'text' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>"><?php echo esc_html($bloggerbuz_widgets_title); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $bloggerbuz_widgets_name )); ?>" type="text" value="<?php echo esc_html($athm_field_value); ?>" />
				
				<?php if( isset( $bloggerbuz_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($bloggerbuz_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Textarea field
		case 'textarea' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>"><?php echo esc_html($bloggerbuz_widgets_title); ?>:</label>
				<textarea class="widefat" rows="6" id="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $bloggerbuz_widgets_name )); ?>"><?php echo esc_html($athm_field_value); ?></textarea>
			</p>
			<?php
			break;
			
		// Checkbox field
		case 'checkbox' : ?>
			<p>
				<input id="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $bloggerbuz_widgets_name )); ?>" type="checkbox" value="1" <?php checked( '1', $athm_field_value ); ?>/>
				<label for="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>"><?php echo esc_html($bloggerbuz_widgets_title); ?></label>

				<?php if( isset( $bloggerbuz_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($bloggerbuz_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		// Radio fields
		case 'radio' : ?>
			<p>
				<?php
				echo esc_attr($bloggerbuz_widgets_title); 
				echo '<br />';
				foreach( $bloggerbuz_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
					<input id="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $bloggerbuz_widgets_name )); ?>" type="radio" value="<?php echo esc_html($athm_option_name); ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
					<label for="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>"><?php echo esc_html($athm_option_title); ?></label>
					<br />
				<?php } ?>
				
				<?php if( isset( $bloggerbuz_widgets_description ) ) { ?>
				<small><?php echo esc_html($bloggerbuz_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		// Select field
		case 'select' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>"><?php echo esc_html($bloggerbuz_widgets_title); ?>:</label>
				<select name="<?php echo esc_attr($instance->get_field_name( $bloggerbuz_widgets_name )); ?>" id="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>" class="widefat">
					<?php
					foreach ( $bloggerbuz_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
						<option value="<?php echo esc_html($athm_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo esc_html($athm_option_title); ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $bloggerbuz_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($bloggerbuz_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		case 'number' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>"><?php echo esc_html($bloggerbuz_widgets_title); ?>:</label><br />
				<input name="<?php echo esc_attr($instance->get_field_name( $bloggerbuz_widgets_name )); ?>" type="number" step="1" min="1" id="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>" value="<?php echo esc_html($athm_field_value); ?>" class="small-text" />
				
				<?php if( isset( $bloggerbuz_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($bloggerbuz_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Select field
		case 'selectpage' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>"><?php echo esc_html($bloggerbuz_widgets_title); ?> :</label>
				<select name="<?php echo esc_attr($instance->get_field_name( $bloggerbuz_widgets_name )); ?>" id="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_widgets_name )); ?>" class="widefat">
					<?php
					foreach ( $bloggerbuz_pagelist as $bloggerbuz_single_page ) { ?>
						<option value="<?php echo esc_attr($bloggerbuz_single_page['value']); ?>" id="<?php echo esc_attr($instance->get_field_id( $bloggerbuz_single_page['label']) ); ?>" <?php selected( $bloggerbuz_single_page['value'], $athm_field_value ); ?>><?php echo esc_html($bloggerbuz_single_page['label']); ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $bloggerbuz_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($bloggerbuz_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
            
        case 'upload' :

            $output = '';
            $id = esc_attr($instance->get_field_id($bloggerbuz_widgets_name));
            $class = '';
            $int = '';
            $value = esc_html($athm_field_value);
            $name = esc_attr($instance->get_field_name($bloggerbuz_widgets_name));


            if ($value) {
                $class = ' has-file';
            }
            $output .= '<div class="sub-option widget-upload">';
            $output .= '<label for="' . esc_attr($instance->get_field_id($bloggerbuz_widgets_name)) . '">' . esc_attr($bloggerbuz_widgets_title) . '</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_html__('No file chosen', 'bloggerbuz') . '" />' . "\n";
            if (function_exists('wp_enqueue_media')) {
                
                    $output .= '<input id="upload-' . $id . '" class="upload-button button" type="button" value="' . esc_html__('Upload', 'bloggerbuz') . '" />' . "\n";

            } else {
                $output .= '<p><i>' . esc_html__('Upgrade your version of WordPress for full media support.', 'bloggerbuz') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";

            if ($value != '') {
                $remove = '<a class="remove-image remove-screenshot">'.esc_html__('Remove','bloggerbuz').'</a>';
                $attachment_id = attachment_url_to_postid($value);

                $image_array = wp_get_attachment_image_src($attachment_id, 'medium');
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img src="' . esc_url($image_array[0]) . '" alt="" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }

                    // No output preview if it's not an image.
                    $output .= '';

                    // Standard generic output if it's not an image.
                    $title = esc_html__('View File', 'bloggerbuz');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;
	}
	
}

function bloggerbuz_widgets_updated_field_value( $widget_field, $new_field_value ) {
    
	extract( $widget_field );
	
	// Allow only integers in number fields
	if( $aglite_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
		
	// Allow some tags in textareas
	} elseif( $aglite_widgets_field_type == 'textarea' ) {
		// Check if field array specifed allowed tags
		if( !isset( $aglite_widgets_allowed_tags ) ) {
			// If not, fallback to default tags
			$aglite_widgets_allowed_tags = '<p><strong><em><a>';
		}
		return strip_tags( $new_field_value, $aglite_widgets_allowed_tags );
		
	// No allowed tags for all other fields
	} else {
		return strip_tags( $new_field_value );
	}

}