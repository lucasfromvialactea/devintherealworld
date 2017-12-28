<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bloggerbuz
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
 // Sidebar Layout

 
 function bloggerbuz_body_classes($classes){
        global $post;
        if(is_home() || is_front_page()){
        	    if(get_theme_mod('bloggerbuz_home_page_layout_setting','fullwidth-home') == 'gridview-home'){
        	        $classes[]= 'gridview-home';
        	    }
                elseif(get_theme_mod('bloggerbuz_home_page_layout_setting','fullwidth-home') == 'fullwidth-home'){
                    $classes[]='fullwidth-home';
                }
                
                if(get_theme_mod('bloggerbuz_design_web_layout','fullwidth') == 'boxed'){
        	        $classes[]= 'boxed-layout';
        	    }
                elseif(get_theme_mod('bloggerbuz_design_web_layout','fullwidth') == 'fullwidth'){
                    $classes[]='fullwidth';
                }
                $bloggerbuz_slider_option = get_theme_mod('bloggerbuz_homepage_setting_slider_section_option','no');
                if($bloggerbuz_slider_option == 'no'){
                    $classes[]='no-slider';
                }
        }
        
    	// Adds a class of group-blog to blogs with more than 1 published author.
    	if ( is_multi_author() ) {
    		$classes[] = 'group-blog';
    	}
    
    	// Adds a class of hfeed to non-singular pages.
    	if ( ! is_singular() ) {
    		$classes[] = 'hfeed';
    	}
        
        $sidebar_meta_option = 'sidebar-right';
        if( is_home() && is_front_page()) {
    		$sidebar_meta_option = get_theme_mod( 'bloggerbuz_sidebar_layout', 'sidebar-right' );
            $classes[] = $sidebar_meta_option;
        }
        elseif(is_archive()) {
            $classes[] = 'sidebar-right';
        }else{
            
            if( 'post' === get_post_type() ) {
                $sidebar_meta_option = esc_attr(get_post_meta( $post->ID, 'bloggerbuz_sidebar_layout', true ));
                $classes[] = $sidebar_meta_option;
            }
            elseif( 'page' === get_post_type() ) {
            	$sidebar_meta_option = esc_attr(get_post_meta( $post->ID, 'bloggerbuz_sidebar_layout', true ));
                $classes[] = $sidebar_meta_option;
            }else{
                $classes[] = 'sidebar-right';
            }
        }
	    return $classes;
 }
 add_filter( 'body_class', 'bloggerbuz_body_classes' );
 function bloggerbuz_sanitize_bradcrumb($input){
    $all_tags = array(
        'a'=>array(
            'href'=>array()
        )
     );
    return wp_kses($input,$all_tags);
    
}
// bloggerbuz breadcrumbs settingg
 if ( ! function_exists( 'bloggerbuz_breadcrumbs' ) ) :
    function bloggerbuz_breadcrumbs() {
       global $post;
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

    $delimiter = '&gt;';

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $homeLink = esc_url( home_url() );

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1)
            echo '<div id="bloggerbuz-breadcrumb"><a href="' . $homeLink . '">' . esc_html__('Home', 'bloggerbuz') . '</a></div></div>';
    } else {

        echo '<div id="bloggerbuz-breadcrumb"><a href="' . $homeLink . '">' . esc_html__('Home', 'bloggerbuz') . '</a> ' . esc_attr($delimiter) . ' ';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0)
                echo get_category_parents($thisCat->parent, TRUE, ' ' . esc_attr($delimiter) . ' ');
            echo '<span class="current">' . esc_html__('Archive by category','bloggerbuz').' "' . single_cat_title('', false) . '"' . '</span>';
        } elseif (is_search()) {
            echo '<span class="current">' . esc_html__('Search results for','bloggerbuz'). '"' . get_search_query() . '"' . '</span>';
        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_attr(get_the_time('Y')) . '</a> ' . esc_attr($delimiter) . ' ';
            echo '<a href="' . esc_url(get_month_link(get_the_time('Y')), esc_attr(get_the_time('m'))) . '">' . esc_attr(get_the_time('F')) . '</a> ' . esc_attr($delimiter) . ' ';
            echo '<span class="current">' . esc_attr(get_the_time('d')) . '</span>';
        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_attr(get_the_time('Y')) . '</a> ' . esc_attr($delimiter) . ' ';
            echo '<span class="current">' . esc_attr(get_the_time('F')) . '</span>';
        } elseif (is_year()) {
            echo '<span class="current">' . esc_attr(get_the_time('Y')) . '</span>';
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . esc_attr($post_type->labels->singular_name) . '</a>';
                if ($showCurrent == 1)
                    echo ' ' . esc_attr($delimiter) . ' ' . '<span class="current">' . esc_attr(get_the_title()) . '</span>';
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                if ($showCurrent == 0)
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo bloggerbuz_sanitize_bradcrumb($cats);
                if ($showCurrent == 1)
                    echo '<span class="current">' . esc_attr(get_the_title()) . '</span>';
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            if($post_type){
            echo '<span class="current">' . esc_attr($post_type->labels->singular_name) . '</span>';
            }
        } elseif (is_attachment()) {
            if ($showCurrent == 1) echo ' ' . '<span class="current">' . esc_attr(get_the_title()) . '</span>';
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1)
                echo '<span class="current">' . esc_attr(get_the_title()) . '</span>';
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo bloggerbuz_sanitize_bradcrumb($breadcrumbs[$i]);
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . esc_attr($delimiter). ' ';
            }
            if ($showCurrent == 1)
                echo ' ' . esc_attr($delimiter) . ' ' . '<span class="current">' . esc_attr(get_the_title()) . '</span>';
        } elseif (is_tag()) {
            echo '<span class="current">' . esc_html__('Posts tagged','bloggerbuz').' "' . esc_attr(single_tag_title('', false)) . '"' . '</span>';
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo '<span class="current">' . esc_html__('Articles posted by ','bloggerbuz'). esc_attr($userdata->display_name) . '</span>';
        } elseif (is_404()) {
            echo '<span class="current">' . esc_html__('Error 404','bloggerbuz') . '</span>';
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo esc_html__('Page', 'bloggerbuz') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</div>';
    }
    }
endif;


 if ( ! function_exists( 'bloggerbuz_page_title' ) ) :
    function bloggerbuz_page_title(){
    ?>
        <header class="page-header">
            <div class="foto-container">
                <div class="header-banner" style="background-image: url('<?php echo esc_url(get_theme_mod('bloggerbuz_page_bg_image')); ?>');">
                    <div class="banner-title">
                        <?php
        					if(is_archive()) {
        						the_archive_title( '<h1 class="page-title">', '</h1>' );
        						the_archive_description( '<div class="taxonomy-description">', '</div>' );
        					} elseif(is_single() || is_singular('page')) {
        						wp_reset_postdata();
        						the_title('<h1 class="page-title">', '</h1>');
        					} elseif(is_search()) {
                                ?>
                                <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'bloggerbuz' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                                <?php
                            } elseif(is_404()) {
                                ?>
                                <h1 class="page-title"><?php esc_html_e( '404 Error', 'bloggerbuz' ); ?></h1>
                                <?php
                            }
        				?>
                        <?php bloggerbuz_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        </header>
    <?php
    }
endif;
add_action('bloggerbuz_title','bloggerbuz_page_title');


?>