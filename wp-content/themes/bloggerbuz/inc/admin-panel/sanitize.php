<?php

    /**
     * SANITIZATION
     */
     
function bloggerbuz_sanitize_radio_yes_no($input){
        $option = array(
                'yes'   =>  esc_html__('Yes','bloggerbuz'),
                'no'    =>  esc_html__('No','bloggerbuz')
            );
        if(array_key_exists($input, $option)){
            return $input;
        }
        else
            return '';
    }
    
function bloggerbuz_sanitize_radio_integer( $input){
	$valid_keys = array(
		'1' => esc_html__('Yes','bloggerbuz'),
		'0' => esc_html__('No','bloggerbuz')
		);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//integer sanitize
function bloggerbuz_integer_sanitize($input){
    return intval( $input );
}  
   
function bloggerbuz_radio_sanitize_sidebar($input) {
    $valid_keys = array(
        'sidebar-left' =>  esc_html__('Left Sidebar','bloggerbuz'),
        'sidebar-right' =>  esc_html__('Right Sidebar','bloggerbuz'),
        'no-sidebar' =>  esc_html__('No Sidebar','bloggerbuz'),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}
  
function bloggerbuz_sanitize_category_select($input){
    $bloggerbuz_category_lists = bloggerbuz_category_lists();
    if(array_key_exists($input,$bloggerbuz_category_lists)){
        return $input;
    }else{
        return '';
    }
}
    
function bloggerbuz_radio_sanitize_webpagelayout($input) {
    $valid_keys = array(
        'fullwidth' => esc_html__('Full Width', 'bloggerbuz'),
        'boxed' => esc_html__('Boxed', 'bloggerbuz')
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}
    
function bloggerbuz_sanitize_checkbox( $input ) {
        if ( $input == 1 ) {
            return 1;
        } else {
            return '';
        }
    }

function bloggerbuz_radio_sanitize_enabledisable($input) {
      $valid_keys = array(
        'enable'=> esc_html__('Enable', 'bloggerbuz'),
        'disable'=> esc_html__('Disable', 'bloggerbuz')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   
function bloggerbuz_sanitize_homelayout_radio($input){
    $valid_keys = array(
    		'fullwidth-home' => esc_html__('fullwidth-home', 'bloggerbuz'),
    		'gridview-home' => esc_html__('gridview-home', 'bloggerbuz'),
            'fullwidth-sidebar-home' => esc_html__('fullwidth-sidebar-home', 'bloggerbuz'),
		);
	if ( array_key_exists( $input, $valid_keys)) {
		return $input;
	} else {
		return '';
	}
}