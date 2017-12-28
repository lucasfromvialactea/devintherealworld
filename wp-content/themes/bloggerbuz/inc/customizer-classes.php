<?php
       if( class_exists( 'WP_Customize_Control' ) ):
       
        /**  BloggerbuzPro Link **/
        class bloggerbuz_Link_Section extends WP_Customize_Section {
    
            public $type = 'bloggerbuz-pro';
    
            public $pro_text = '';
    
            public $pro_url = '';
    
            public function json() {
                $json = parent::json();
                $json['pro_text'] = $this->pro_text;
                $json['pro_url']  = esc_url( $this->pro_url );
                return $json;
            }
            protected function render_template() { ?>
    
                <li id="custom-section-{{ data.id }}" class="custom-section control-section control-section-{{ data.type }} cannot-expand">
                    <h3 class="custom-section-title">
                        {{ data.title }}
                        <# if ( data.pro_text && data.pro_url ) { #>
                            <a href="{{ data.pro_url }}" class="button button-custom alignright" target="_blank">{{ data.pro_text }}</a>
                        <# } #>
                    </h3>
                </li>
            <?php }
        }
        
        /**
     * Theme info
     */
    class bloggerbuz_Theme_Info extends WP_Customize_Control {
        public function render_content(){

            $our_theme_infos = array(
                'demo' => array(
                   'link' => esc_url( 'http://buzthemes.com/demo/bloggerbuz/' ),
                   'text' => esc_html__( 'View Demo', 'bloggerbuz' ),
                ),
                'documentation' => array(
                   'link' => esc_url( 'https://buzthemes.com/doc/bloggerbuz/' ),
                   'text' => esc_html__( 'Documentation', 'bloggerbuz' ),
                ),
                'support' => array(
                   'link' => esc_url( 'https://buzthemes.com/forums/forum/bloggerbuz/' ),
                   'text' => esc_html__( 'Support', 'bloggerbuz' ),
                ),
            );
            foreach ( $our_theme_infos as $our_theme_info ) {
                echo '<p><a target="_blank" href="' . $our_theme_info['link'] . '" >' . esc_html( $our_theme_info['text'] ) . ' </a></p>';
            }
        ?>
        	<label>
        	    <h2 class="customize-title"><?php echo esc_html( $this->label ); ?></h2>
        	    <span class="customize-text_editor_desc">                 
        	        <ul class="admin-pro-feature-list">   
                        <li><span><?php esc_html_e('One Click Demo Import','bloggerbuz'); ?> </span></li>
        	            <li><span><?php esc_html_e('Modern and elegant design','bloggerbuz'); ?> </span></li>
                        <li><span><?php esc_html_e('5 Homepage Layouts','bloggerbuz'); ?> </span></li>
        	            <li><span><?php esc_html_e('100% Responsive theme','bloggerbuz'); ?> </span></li>
        	            <li><span><?php esc_html_e('Advanced Typography','bloggerbuz'); ?> </span></li>
        	            <li><span><?php esc_html_e('Breadcrumb Settings','bloggerbuz'); ?> </span></li>
        	            <li><span><?php esc_html_e('Highly configurable home page','bloggerbuz'); ?> </span></li>
        	            <li><span><?php esc_html_e('Four Footer Widget Areas','bloggerbuz'); ?> </span></li>
        	            <li><span><?php esc_html_e('Sidebar Options','bloggerbuz'); ?> </span></li>
        	            <li><span><?php esc_html_e('Translation ready','bloggerbuz'); ?> </span></li>
                        <li><span><?php esc_html_e('WordPress Live Customizer Based','bloggerbuz'); ?> </span></li>
        	        </ul>
        	        <?php $bloggerbuz_pro_link = 'https://buzthemes.com/demo/bloggerbuz-pro/'; ?>
        	        <a href="<?php echo esc_url($bloggerbuz_pro_link); ?>" class="button button-primary buynow" target="_blank"><?php esc_html_e('Buy Now','bloggerbuz'); ?></a>
        	    </span>
        	</label>
        <?php
        }
    }
    
        /** Exclude Multiple Category Control **/
       class bloggerbuz_WP_Customize_Cat_Exclude_Control extends WP_Customize_Control {
           public function render_content() {
            
               $category_post = $this->bloggerbuz_cat_list();
               $values = $this->value();
               
               if ( empty( $category_post ) )
               return;
               ?>
               <label>
                   <?php if ( ! empty( $this->label ) ) : ?>
                       <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                   <?php endif;
                   if ( ! empty( $this->description ) ) : ?>
                       <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                   <?php endif; ?>
                   
                   <?php if ( ! empty( $this->label ) ) : ?>
                       <div class="exclude-cat-wrap">
                       
                           <?php $category_array = explode(',', $values); array_pop($category_array); $count = 1; ?>
                           <?php foreach($category_post as $id => $label) : ?>
                               <div class="chk-group <?php if($count++%2 == 0){echo "right";}else{echo "left";} ?>">
                                   <input id="exclude-cat-<?php echo absint($id); ?>" type="checkbox" value="<?php echo absint($id); ?>" <?php if(in_array($id,$category_array)){ echo "checked"; }; ?> />
                                   <label for="exclude-cat-<?php echo absint($id); ?>"><?php echo esc_attr($label); ?></label>
                               </div>
                           <?php endforeach; ?>
                           
                       </div>
                       <input type="hidden" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
                   <?php endif; ?>    
               </label>
               <?php
           }
           
           public function bloggerbuz_cat_list() {
               $catlist = array();
               $categories = get_categories( array('hide_empty' => 0) );
               
               foreach($categories as $cat){
                   $catlist[$cat->term_id] = $cat->name;
               }
               
               return $catlist;
           }
       }
    endif;