<?php
add_action('add_meta_boxes', 'bloggerbuz_add_sidebar_layout_box');
function bloggerbuz_add_sidebar_layout_box()
{
    add_meta_box(
             'bloggerbuz_sidebar_layout', // $id
             'Sidebar Layout', // $title
             'bloggerbuz_sidebar_layout_callback', // $callback
             'page', // $page
             'normal', // $context
             'high' // $priority
         ); 
    add_meta_box(
             'bloggerbuz_post_sidebar_layout', // $id
             'Sidebar Layout for Posts', // $title
             'bloggerbuz_sidebar_layout_callback', // $callback
             'post', // $page
             'normal', // $context
             'high' // $priority
         );
}
$bloggerbuz_sidebar_layout = array(
    'sidebar-left' => array(
        'value'     => 'sidebar-left',
        'label'     => esc_html__( 'Left sidebar', 'bloggerbuz' ),
        'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-left.png'
        ), 
    'sidebar-right' => array(
        'value' => 'sidebar-right',
        'label' => esc_html__( 'Right sidebar (default)', 'bloggerbuz' ),
        'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-right.png'
        ),
    'sidebar-both' => array(
        'value'     => 'sidebar-both',
        'label'     => esc_html__( 'Both Sidebar', 'bloggerbuz' ),
        'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-both.png'
        ),
    
    'sidebar-no' => array(
        'value'     => 'sidebar-no',
        'label'     => esc_html__( 'No sidebar', 'bloggerbuz' ),
        'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-no.png'
        )   

    );
function bloggerbuz_sidebar_layout_callback(){ 
    global $post , $bloggerbuz_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'bloggerbuz_sidebar_layout_nonce' ); 
    ?>
    <table class="form-table">
        <tr>
            <td colspan="4"><em class="f13"><?php echo esc_html__('Choose Sidebar Template','bloggerbuz');?></em></td>
        </tr>

        <tr>
            <td>
                <?php  
                foreach($bloggerbuz_sidebar_layout as $field){  
                    $bloggerbuz_sidebar_metalayout = get_post_meta( $post->ID, 'bloggerbuz_sidebar_layout', true ); ?>
                    <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                        <label class="description">
                         <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span></br>
                         <input type="radio" name="bloggerbuz_sidebar_layout" value="<?php echo esc_attr($field['value']); ?>" <?php checked( $field['value'], $bloggerbuz_sidebar_metalayout ); if(empty($bloggerbuz_sidebar_metalayout) && $field['value']=='sidebar-right'){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_attr($field['label']); ?>
                        </label>
                    </div>
                <?php } // end foreach 
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table>
    <?php } 
/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function bloggerbuz_save_sidebar_layout( $post_id ) { 
    global $bloggerbuz_sidebar_layout, $post; 
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'bloggerbuz_sidebar_layout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'bloggerbuz_sidebar_layout_nonce' ], basename( __FILE__ ) ) )
        return;
    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
    
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
        return $post_id;  
    }  
    
    foreach ($bloggerbuz_sidebar_layout as $field) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'bloggerbuz_sidebar_layout', true); 
        $new = sanitize_text_field($_POST['bloggerbuz_sidebar_layout']);
        if ($new && $new != $old) {  
            update_post_meta($post_id, 'bloggerbuz_sidebar_layout', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'bloggerbuz_sidebar_layout', $old);  
        } 
     } // end foreach   
 }
 add_action('save_post', 'bloggerbuz_save_sidebar_layout');