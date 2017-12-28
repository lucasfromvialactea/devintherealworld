<?php
/**
 * bloggerbuz Theme Customizer
 *
 * @package bloggerbuz
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 
 function bloggerbuz_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	require get_template_directory() . '/inc/admin-panel/sanitize.php';

// bloggerbug posts list.

/** Upgrade to Bloggerbuz **/
$wp_customize->register_section_type( 'bloggerbuz_Link_Section' );

// Register sections.
$wp_customize->add_section(
    new bloggerbuz_Link_Section(
        $wp_customize,
        'bloggerbuz-pro',
        array(
            'title'    => esc_html__( 'Upgrade To Bloggerbuz Pro', 'bloggerbuz' ),
            'pro_text' => esc_html__( 'Go Pro','bloggerbuz' ),
            'pro_url'  => 'https://buzthemes.com/wordpress_themes/bloggerbuz-pro/',
            'priority' => 1,
        )
    )
);

/** Theme Info section **/
$wp_customize->add_section(
    'bloggerbuz_theme_info_section',
    array(
        'title'		=> esc_html__( 'Theme Info', 'bloggerbuz' ),
        'priority'  => 1,
    )
);
// More Themes
$wp_customize->add_setting(
    'bloggerbuz_por_information', 
    array(
        'type'              => 'theme_info',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new bloggerbuz_Theme_Info( 
    $wp_customize ,
    'bloggerbuz_por_information',
        array(
          'label' => esc_html__( 'Bloggerbuz Pro Theme' , 'bloggerbuz' ),
          'section' => 'bloggerbuz_theme_info_section',
        )
    )
);

$bloggerbuz_category_lists 	=	bloggerbuz_category_lists();
$posts_list = bloggerbuz_post_list();

//DEAFAULT SETTING 

  $wp_customize->add_panel('bloggerbuz_default_setting',array(
      'priority' => 2,
      'title' => esc_html__('Default/Basic Setting', 'bloggerbuz'),
      'panel' => 'bloggerbuz_default_setting'
      ));
  $wp_customize->get_section('title_tagline')->panel = 'bloggerbuz_default_setting'; //priority 20
  $wp_customize->get_section('colors')->panel = 'bloggerbuz_default_setting'; //priority 40
  $wp_customize->get_section('header_image')->panel = 'bloggerbuz_default_setting'; //priority 60
  $wp_customize->get_section('background_image')->panel = 'bloggerbuz_default_setting'; //priority 80
  $wp_customize->get_section('static_front_page')->panel = 'bloggerbuz_default_setting'; //priority 120

   //BLOGGERBUZ HEADER SETTING 
  //LOGO SETTING
   $wp_customize->add_panel('bloggerbug_header_settings', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 10,
      'title' => esc_html__('Header Setting', 'bloggerbuz')
  ));
  
   $wp_customize->add_section('bloggerbuz_logo_alignment',array(
		'title' => esc_html__('Header Logo Alignment Setting','bloggerbuz'),
		'priority' => '40',
		'panel' => 'bloggerbug_header_settings'
		));

	// SEARCH SETTING
    
    $wp_customize->add_section('bloggerbuz_header_search',array(
		'title' => esc_html__('Header Search Setting','bloggerbuz'),
		'priority' => '30',
		'panel' => 'bloggerbug_header_settings'
		));
	$wp_customize->add_setting('bloggerbuz_hide_header_search',array(
		'default' => '0',
		'sanitize_callback' => 'bloggerbuz_sanitize_radio_integer',
		));
	$wp_customize->add_control('bloggerbuz_hide_header_search',array(
		'type' => 'radio',
		'label' => esc_html__('Hide Search From Header','bloggerbuz'),
		'description' => esc_html__('Selecting Yes will Hide Search Bar From Header','bloggerbuz'),
		'section' => 'bloggerbuz_header_search',
		'choices' => array(
			'1' => esc_html__('Yes','bloggerbuz'),
			'0' => esc_html__('No','bloggerbuz')
			)
		));
  
  //Bredcrumbs Setting for bloggerbuz
  $wp_customize->add_section('bloggerbuz_bredcrumb',array(
    'title' => esc_html__('Page Breadcrumb','bloggerbuz'),
    'priority' => '40',
    'panel' => 'bloggerbug_header_settings'
    ));

  $wp_customize->add_setting(
    'bloggerbuz_page_bg_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
   );
  $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'bloggerbuz_page_bg_image',
           array(
               'label'      => __( 'Page Breadcrumb Backgeound Image', 'bloggerbuz' ),
               'section'    => 'bloggerbuz_bredcrumb',
               'settings'   => 'bloggerbuz_page_bg_image',
               'priority' => 10,
           )
       )
   );
  
    //PANEL HOMEPAGE SECTION 
   $wp_customize->add_panel('bloggerbug_homepage_settings', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 30,
      'title' => esc_html__('Homepage Settings', 'bloggerbuz')
   ));
   
   //SLIDER SECTION
   $wp_customize->add_section('bloggerbuz_slider_setting', 
                array(
                'priority' => 10,
                'title' => esc_html__('Slider Section', 'bloggerbuz'),
                'panel' => 'bloggerbug_homepage_settings',
          ));

   // SLIDER ENABLE/DISBLE
   
    $wp_customize->add_setting(
		            'bloggerbuz_homepage_setting_slider_section_option',
                    array(
		                'default'           =>  'no',
		                'sanitize_callback' =>  'bloggerbuz_sanitize_radio_yes_no',
		                )
		            );
   $wp_customize->add_control(
		            'bloggerbuz_homepage_setting_slider_section_option',array(
		                'description'   =>  esc_html__('Do you want to enable this section?','bloggerbuz'),
		                'section'       =>  'bloggerbuz_slider_setting',
		                'setting'       =>  'bloggerbuz_homepage_setting_slider_section_option',
		                'priority'      =>  5,
		                'type'          =>  'radio',
		                'choices'        =>  array(
		                    'yes'   =>  esc_html__('Yes','bloggerbuz'),
		                    'no'    =>  esc_html__('No','bloggerbuz')
		                    )
		                )                   
		            );
    //SELECT CATEORY FOR SLIDER
  $wp_customize->add_setting(
		            'bloggerbuz_homepage_setting_slider_section_category',array(
		                'default'           =>  '0',
		                'sanitize_callback' =>  'bloggerbuz_sanitize_category_select',
		                )
		            );
  $wp_customize->add_control(
		            'bloggerbuz_homepage_setting_slider_section_category',array(
		                'priority'      =>  6,
		                'label'         =>  esc_html__('Select category','bloggerbuz'),
		                'section'       =>  'bloggerbuz_slider_setting',
		                'setting'       =>  'bloggerbuz_homepage_setting_slider_section_category',
		                'type'          =>  'select',  
		                'choices'       =>  $bloggerbuz_category_lists
		                )                                     
		            );     

    //SLIDER BUTTON TEXT
   $wp_customize->add_setting(
		            'bloggerbuz_homepage_setting_slider_section_readmore',array(
		                'default'           =>  esc_html__('Get Started','bloggerbuz'),
		                'sanitize_callback' =>  'sanitize_text_field',
		                )
		            );

   $wp_customize->add_control(
		            'bloggerbuz_homepage_setting_slider_section_readmore',array(
		                'priority'      =>  7,
		                'label'         =>  esc_html__('Read more text','bloggerbuz'),
		                'section'       =>  'bloggerbuz_slider_setting',
		                'setting'       =>  'bloggerbuz_homepage_setting_slider_section_readmore',
		                'type'          =>  'text',  
		                )                                     
		            );
                    
    //FEATURE SECTION
   $wp_customize->add_section('bloggerbuz_feature_section',array(
               	'priority' => 30  ,
               	'title' => esc_html__('Feature Section', 'bloggerbuz'),
               	'panel' => 'bloggerbug_homepage_settings',
        	));
    //ENABLE/DISABLE FEATURE SECTION
   $wp_customize->add_setting('bloggerbuz_option',array(
              'default' => 'disable',
              'capability' => 'edit_theme_options',
              'sanitize_callback' => 'bloggerbuz_radio_sanitize_enabledisable',
           ));

   $wp_customize->add_control('bloggerbuz_option',array(
              'type' => 'radio',
              'label' => esc_html__('Enable Disable Feature Section', 'bloggerbuz'),
              'section' => 'bloggerbuz_feature_section',
              'setting' => 'bloggerbuz_option',
              'choices' => array(
                 'enable' => esc_html__('Enable', 'bloggerbuz'),
                 'disable' => esc_html__('Disable', 'bloggerbuz'),
              )
           ));

    //FEATURE CATEGORY
   $wp_customize->add_setting(
                'bloggerbuz_homepage_setting_feature_section_category',array(
                    'default'           =>  '0',
                    'sanitize_callback' =>  'bloggerbuz_sanitize_category_select',
                    )
                );

   $wp_customize->add_control(
                'bloggerbuz_homepage_setting_feature_section_category',array(
                    'priority'      =>  25,
                    'label'         =>  esc_html__('Select category','bloggerbuz'),
                    'section'       =>  'bloggerbuz_feature_section',
                    'setting'       =>  'bloggerbuz_homepage_setting_feature_section_category',
                    'type'          =>  'select',  
                    'choices'       =>  $bloggerbuz_category_lists
                    )                                     
                );
                
   // HIGHLIGHTED   SECTION
   $wp_customize->add_section('bloggerbuz_highlighted_section', array(
        'priority' => 30  ,
        'title' => esc_html__('Highlighted Section', 'bloggerbuz'),
        'panel' => 'bloggerbug_homepage_settings',
    ));
    
    //ENABLE/DISABLE HIGHLIGHTED SECTION
   $wp_customize->add_setting('bloggerbuz_highlighted_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'bloggerbuz_radio_sanitize_enabledisable',
   ));

   $wp_customize->add_control('bloggerbuz_highlighted_option', array(
      'type' => 'radio',
      'label' => esc_html__('Enable Disable Highlighted Section', 'bloggerbuz'),
      'section' => 'bloggerbuz_highlighted_section',
      'setting' => 'bloggerbuz_highlighted_option',
      'choices' => array(
         'enable' => esc_html__('Enable', 'bloggerbuz'),
         'disable' => esc_html__('Disable', 'bloggerbuz'),
      )
   ));

  //HIGHLIGHTED SECTION POST
  $wp_customize->add_setting('bloggerbuz_highlighted_setting_post',array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bloggerbuz_integer_sanitize',
        'transport' => 'postMessage'
   ));
   
   $wp_customize->add_control('bloggerbuz_highlighted_setting_post', array(
        'type' => 'select',
        'label' => esc_html__('Select a Post to show in Highlighted Secion','bloggerbuz'),
        'section' => 'bloggerbuz_highlighted_section',
        'setting' => 'bloggerbuz_highlighted_option',
        'choices' => $posts_list
    ));
   
   // Recent Blog SECTION
   $wp_customize->add_section('bloggerbuz_recent_blog_section', array(
        'priority' => 30  ,
        'title' => esc_html__('Recent Blog Section', 'bloggerbuz'),
        'panel' => 'bloggerbug_homepage_settings',
    ));
    
   // Blog Esclude
   $wp_customize->add_setting( 'bloggerbuz_exclude_category', array( 
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
   $wp_customize->add_control( new bloggerbuz_WP_Customize_Cat_Exclude_Control(
       $wp_customize,
       'bloggerbuz_exclude_category',
       array(
           'label'      => esc_html__( 'Exclude Category', 'bloggerbuz' ),
           'description' => esc_html__('Exclude Categories From Recent Post', 'bloggerbuz'),
           'section'    => 'bloggerbuz_recent_blog_section',
           'settings'   => 'bloggerbuz_exclude_category',
       )
   ));
    
    // DESIGN SETTING
   $wp_customize -> add_panel(
        'bloggerbuz_design_setting_panel',array(
            'priority' => 35,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__('Design Setting', 'bloggerbuz')
        )
    );     
        
    $wp_customize -> add_section(
        'bloggerbuz_home_page_layout_section',array(
            'title' => esc_html__('Home Page Layout','bloggerbuz'),
            'priority' => 20,
            'panel' => 'bloggerbuz_design_setting_panel'
        )
    );

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bloggerbuz_logo_upload', array(
		'label' => esc_html__('Upload logo for your site', 'bloggerbuz'),
		'section' => 'bloggerbuz_logo_setting',
		'setting' => 'bloggerbuz_logo_upload'
	)));
    
 //ADD WEBPAGE LAYOUT
    $wp_customize->add_section(
        'bloggerbuz_design_web_layout',array(
        'title'         =>  esc_html__('Web Layout', 'bloggerbuz'),
        'panel'         =>  'bloggerbuz_design_setting_panel'
            )        
        );
        
    $wp_customize->add_setting('bloggerbuz_design_web_layout', array(
      'default' => 'fullwidth',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'bloggerbuz_radio_sanitize_webpagelayout',
   ));

   $wp_customize->add_control('bloggerbuz_design_web_layout', array(
      'type' => 'radio',
      'label' => esc_html__('Choose the layout that you want', 'bloggerbuz'),
      'section' => 'bloggerbuz_design_web_layout',
      'setting' => 'bloggerbuz_design_web_layout',
      'choices' => array(
         'fullwidth' => esc_html__('Full Width', 'bloggerbuz'),
         'boxed' => esc_html__('Boxed', 'bloggerbuz')
      )
   ));
   
// HOMEPAGE SIDE BAR LAYOUT
  $wp_customize->add_section(
        'bloggerbuz_homepage_sidebar_setting',array(
          'title' => esc_html__('Home Sidebar Layout', 'bloggerbuz'),
          'panel' => 'bloggerbuz_design_setting_panel'
          )
      );
  $wp_customize->add_setting(
      'bloggerbuz_sidebar_layout',array(
        'default' =>  'sidebar-right',
        'sanitize_callback' =>  'bloggerbuz_radio_sanitize_sidebar'
        )
      );  
    $wp_customize->add_control(
      'bloggerbuz_sidebar_layout',array(
        'description' => esc_html__('Choose the sidebar Layout for the home page','bloggerbuz'),
        'section' => 'bloggerbuz_homepage_sidebar_setting',
        'type'    =>  'radio',
        'choices' =>  array(
            'sidebar-left' =>  esc_html__('Left Sidebar','bloggerbuz'),
            'sidebar-right' =>  esc_html__('Right Sidebar','bloggerbuz'),
            'no-sidebar' =>  esc_html__('No Sidebar','bloggerbuz'),
          )
        )
      );
   //HOMEPAGE LAYOUT
    $wp_customize -> add_section(
        'bloggerbuz_home_page_layout_section',
        array(
            'title' => esc_html__('Home Page Layout','bloggerbuz'),
            'priority' => 20,
            'panel' => 'bloggerbuz_design_setting_panel'
        )
    );
    
    $wp_customize -> add_setting(
        'bloggerbuz_home_page_layout_setting',
        array(
            'default' => 'fullwidth-home',
            'sanitize_callback' => 'bloggerbuz_sanitize_homelayout_radio'
        )
    );
    
    $wp_customize -> add_control(
        'bloggerbuz_home_page_layout_setting',
        array(
            'label' => esc_html__('Home Layout Option', 'bloggerbuz'),
            'section' => 'bloggerbuz_home_page_layout_section',
            'type' => 'radio',
            'choices' => array(
                            'fullwidth-home' => esc_html__('FullWidth','bloggerbuz'),
                            'gridview-home' => esc_html__('Grid view','bloggerbuz'),
                        )
        )
    );
   
// FOOTER SECTION
     $wp_customize -> add_panel(
        'bloggerbuz_footer_setting_panel',array(
            'priority' => 35,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__('Footer Setting', 'bloggerbuz')
        )
    );
  
//FOTTER SECTION
  $wp_customize -> add_panel(
        'bloggerbuz_social_setting_panel',array(
            'priority' => 36,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__('Social Link Setting', 'bloggerbuz')
        )
    ); 


  $wp_customize->add_section(
        'bloggerbuz_social_link',array(
            'title' =>esc_html__('Footer Social Link','bloggerbuz'),
            'panel' =>'bloggerbuz_social_setting_panel',
        )
    );
    
// SETTING FOR SOCIAL LINK
   $wp_customize->add_setting(
        'bloggerbuz_footer_social_icon_enable',array(
                'default' => '',
                'sanitize_callback'=>'bloggerbuz_sanitize_checkbox'
            )
    );
    $wp_customize->add_control(
        'bloggerbuz_footer_social_icon_enable',array(
            'label' => esc_html__('Footer Social Link','bloggerbuz'),
            'section' => 'bloggerbuz_social_link',
            'type' => 'checkbox',
            'priority' => 2
        )
    );
    $wp_customize->add_setting(
        'bloggerbuz_facebook_text',array(
                'default'=>'',
                'sanitize_callback' => 'esc_url_raw',
            )
    );
    $wp_customize->add_setting(
        'bloggerbuz_twitter_text',array(
                'default'=>'',
                'sanitize_callback' => 'esc_url_raw',
            )
    );
    $wp_customize->add_setting(
        'bloggerbuz_googleplus_text',array(
                'default'=>'',
                'sanitize_callback' => 'esc_url_raw',
            )
    );
    $wp_customize->add_setting(
        'bloggerbuz_youtube_text',array(
                'default'=>'',
                'sanitize_callback' => 'esc_url_raw',
            )
    );
    $wp_customize->add_setting(
        'bloggerbuz_pinterest_text',array(
                'default'=>'',
                'sanitize_callback' => 'esc_url_raw',
            )
    );
   
    $wp_customize->add_setting(
        'bloggerbuz_linkedin_text',array(
                'default'=>'',
                'sanitize_callback' => 'esc_url_raw',
            )
    );
     $wp_customize->add_setting(
        'bloggerbuz_instagram_text',array(
                'default'=>'',
                'sanitize_callback' => 'esc_url_raw',
            )
    );
   $wp_customize->add_control(
        'bloggerbuz_facebook_text', array(
                'label' => esc_html__('Facebook Link','bloggerbuz'),
                'section' => 'bloggerbuz_social_link',
                'type' => 'text',
            )
    );
    $wp_customize->add_control(
        'bloggerbuz_twitter_text',array(
                'label' => esc_html__('Twitter Link','bloggerbuz'),
                'section' => 'bloggerbuz_social_link',
                'type' => 'text',
            )
    );
    $wp_customize->add_control(
        'bloggerbuz_googleplus_text',array(
                'label' => esc_html__('GooglePlus Link','bloggerbuz'),
                'section' => 'bloggerbuz_social_link',
                'type' => 'text',
            )
    );

    $wp_customize->add_control(
        'bloggerbuz_youtube_text',array(
                'label' => esc_html__('Youtube Link','bloggerbuz'),
                'section' => 'bloggerbuz_social_link',
                'type' => 'text',
            )
    );
    $wp_customize->add_control(
        'bloggerbuz_pinterest_text',array(
                'label' => esc_html__('Pinterest Link','bloggerbuz'),
                'section' => 'bloggerbuz_social_link',
                'type' => 'text',
            )
    );
    $wp_customize->add_control(
        'bloggerbuz_linkedin_text',array(
                'label' => esc_html__('Linkedin Link','bloggerbuz'),
                'section' => 'bloggerbuz_social_link',
                'type' => 'text',
            )
    );
    $wp_customize->add_control(
        'bloggerbuz_instagram_text',array(
                'label' => esc_html__('Instagram Link','bloggerbuz'),
                'section' => 'bloggerbuz_social_link',
                'type' => 'text',
            )
    );
    
    
}
add_action( 'customize_register', 'bloggerbuz_customize_register' );