<?php
/**
 * Perfume Store Theme Customizer
 *
 * @package Perfume Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function perfume_store_customize_register( $wp_customize ) {

	function perfume_store_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	wp_enqueue_style('perfume-store-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	// Enable / Disable Logo
	$wp_customize->add_setting('perfume_store_logo_enable',array(
		'default' => true,
		'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'perfume_store_logo_enable', array(
	   'settings' => 'perfume_store_logo_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Logo','perfume-store'),
	   'type'      => 'checkbox'
	));

	//Logo
    $wp_customize->add_setting('perfume_store_logo_width', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'perfume_store_sanitize_integer'
    ));
    $wp_customize->add_control(new Perfume_Store_Slider_Custom_Control($wp_customize, 'perfume_store_logo_width', array(
    	'label'          => __( 'Logo Width', 'perfume-store'),
        'section' => 'title_tagline',
        'settings' => 'perfume_store_logo_width',
        'input_attrs' => array(
            'step' => 1,
            'min' => 0,
            'max' => 300,
        ),
    )));

	// color site title
	$wp_customize->add_setting('perfume_store_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'perfume_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'perfume_store_sitetitle_color', array(
	   'settings' => 'perfume_store_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'perfume-store'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('perfume_store_title_enable',array(
		'default' => false,
		'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'perfume_store_title_enable', array(
	   'settings' => 'perfume_store_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','perfume-store'),
	   'type'      => 'checkbox'
	));

	// color site tagline
	$wp_customize->add_setting('perfume_store_sitetagline_color',array(
		'default' => '',
		'sanitize_callback' => 'perfume_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_sitetagline_color', array(
	   'settings' => 'perfume_store_sitetagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'perfume-store'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('perfume_store_tagline_enable',array(
		'default' => false,
		'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'perfume_store_tagline_enable', array(
	   'settings' => 'perfume_store_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','perfume-store'),
	   'type'      => 'checkbox'
	));

	// woocommerce section
	$wp_customize->add_section('perfume_store_woocommerce_page_settings', array(
		'title'    => __('WooCommerce Page Settings', 'perfume-store'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	$wp_customize->add_setting('perfume_store_shop_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'perfume_store_sanitize_checkbox'
	 ));
	 $wp_customize->add_control('perfume_store_shop_page_sidebar',array(
		'type' => 'checkbox',
		'label' => __(' Check To Enable Shop page sidebar','perfume-store'),
		'section' => 'perfume_store_woocommerce_page_settings',
	 ));

    // shop page sidebar alignment
    $wp_customize->add_setting('perfume_store_shop_page_sidebar_position', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'perfume_store_sanitize_choices',
	));
	$wp_customize->add_control('perfume_store_shop_page_sidebar_position',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Sidebar', 'perfume-store'),
		'section'        => 'perfume_store_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'perfume-store'),
			'Right Sidebar' => __('Right Sidebar', 'perfume-store'),
		),
	));	 

	$wp_customize->add_setting('perfume_store_wooproducts_nav',array(
		'default' => 'Yes',
		'sanitize_callback'	=> 'perfume_store_sanitize_choices'
	 ));
	 $wp_customize->add_control('perfume_store_wooproducts_nav',array(
		'type' => 'select',
		'label' => __('Shop Page Products Navigation','perfume-store'),
		'choices' => array(
			 'Yes' => __('Yes','perfume-store'),
			 'No' => __('No','perfume-store'),
		 ),
		'section' => 'perfume_store_woocommerce_page_settings',
	 ));

	 $wp_customize->add_setting( 'perfume_store_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'perfume_store_sanitize_checkbox'
    ) );
    $wp_customize->add_control('perfume_store_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Check To Enable Single Product Page Sidebar','perfume-store'),
		'section' => 'perfume_store_woocommerce_page_settings'
    ));

	// single product page sidebar alignment
    $wp_customize->add_setting('perfume_store_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'perfume_store_sanitize_choices',
	));
	$wp_customize->add_control('perfume_store_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page Sidebar', 'perfume-store'),
		'section'        => 'perfume_store_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'perfume-store'),
			'Right Sidebar' => __('Right Sidebar', 'perfume-store'),
		),
	));

	$wp_customize->add_setting('perfume_store_related_product_enable',array(
		'default' => true,
		'sanitize_callback'	=> 'perfume_store_sanitize_checkbox'
	));
	$wp_customize->add_control('perfume_store_related_product_enable',array(
		'type' => 'checkbox',
		'label' => __('Check To Enable Related product','perfume-store'),
		'section' => 'perfume_store_woocommerce_page_settings',
	));

	$wp_customize->add_setting( 'perfume_store_woo_product_img_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'perfume_store_sanitize_integer'
    ) );
    $wp_customize->add_control(new Perfume_Store_Slider_Custom_Control( $wp_customize, 'perfume_store_woo_product_img_border_radius',array(
		'label'	=> esc_html__('Woo Product Img Border Radius','perfume-store'),
		'section'=> 'perfume_store_woocommerce_page_settings',
		'settings'=>'perfume_store_woo_product_img_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	// Add a setting for number of products per row
    $wp_customize->add_setting('perfume_store_products_per_row', array(
	    'default'   => '4',
	    'transport' => 'refresh',
	    'sanitize_callback' => 'perfume_store_sanitize_integer'  
    ));

   	$wp_customize->add_control('perfume_store_products_per_row', array(
	   'label'    => __('Products Per Row', 'perfume-store'),
	   'section'  => 'perfume_store_woocommerce_page_settings',
	   'settings' => 'perfume_store_products_per_row',
	   'type'     => 'select',
	   'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
	  ),
   	) );
   
   	// Add a setting for the number of products per page
	$wp_customize->add_setting('perfume_store_products_per_page', array(
		'default'   => '8',
		'transport' => 'refresh',
		'sanitize_callback' => 'perfume_store_sanitize_integer'
	));

	$wp_customize->add_control('perfume_store_products_per_page', array(
		'label'    => __('Products Per Page', 'perfume-store'),
		'section'  => 'perfume_store_woocommerce_page_settings',
		'settings' => 'perfume_store_products_per_page',
		'type'     => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'step' => 1,
		),
	));

	//Theme Options
	$wp_customize->add_panel( 'perfume_store_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'perfume-store' ),
	) );

	//Site Layout Section
	$wp_customize->add_section('perfume_store_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section ','perfume-store'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','perfume-store'),
		'priority'	=> 1,
		'panel' => 'perfume_store_panel_area',
	));

	$wp_customize->add_setting('perfume_store_preloader',array(
		'default' => false,
		'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'perfume_store_preloader', array(
	   'section'   => 'perfume_store_site_layoutsec',
	   'label'	=> __('Check to Show preloader','perfume-store'),
	   'type'      => 'checkbox'
 	));	

	$wp_customize->add_setting('perfume_store_preloader_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'perfume_store_preloader_bg_image',array(
        'section' => 'perfume_store_site_layoutsec',
		'label' => __('Preloader Background Image','perfume-store'),
	)));

	$wp_customize->add_setting( 'perfume_store_theme_page_breadcrumb',array(
		'default' => false,
        'sanitize_callback'	=> 'perfume_store_sanitize_checkbox',
	) );
	$wp_customize->add_control('perfume_store_theme_page_breadcrumb',array(
       'section' => 'perfume_store_site_layoutsec',
	   'label' => __( 'Check To Enable Theme Page Breadcrumb','perfume-store' ),
	   'type' => 'checkbox'
    ));		

	$wp_customize->add_setting('perfume_store_box_layout',array(
		'default' => false,
		'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'perfume_store_box_layout', array(
	   'section'   => 'perfume_store_site_layoutsec',
	   'label'	=> __('Check to Show Box Layout','perfume-store'),
	   'type'      => 'checkbox'
 	));

	// Add Settings and Controls for Page Layout
    $wp_customize->add_setting('perfume_store_sidebar_page_layout',array(
		'default' => 'full',
	 	'sanitize_callback' => 'perfume_store_sanitize_choices'
	));
	$wp_customize->add_control('perfume_store_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'perfume-store'),
		'section' => 'perfume_store_site_layoutsec',
		'choices' => array(
			'full' => __('Full','perfume-store'),
			'left' => __('Left','perfume-store'),
			'right' => __('Right','perfume-store'),
		),
	));

	$wp_customize->add_setting( 'perfume_store_layout_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_layout_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(PERFUME_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'perfume_store_site_layoutsec'
	));

	//Global Color
	$wp_customize->add_section('perfume_store_global_color', array(
		'title'    => __('Manage Global Color Section', 'perfume-store'),
		'panel'    => 'perfume_store_panel_area',
	));

	$wp_customize->add_setting('perfume_store_first_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'perfume_store_first_color', array(
		'label'    => __('Theme Color', 'perfume-store'),
		'section'  => 'perfume_store_global_color',
		'settings' => 'perfume_store_first_color',
	)));

	$wp_customize->add_setting( 'perfume_store_global_color_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_global_color_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(PERFUME_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'perfume_store_global_color'
	));

	// Header Section
	$wp_customize->add_section('perfume_store_topbar_section',array(
	    'title' => __('Manage Header Sidebar Section','perfume-store'),
	    'description' => __('<p class="sec-title">Manage Header Sidebar Section</p>', 'perfume-store'),
	    'priority'  => null,
	    'panel' => 'perfume_store_panel_area',
	));	

	$wp_customize->add_setting('perfume_store_stickyheader',array(
		'default' => false,
		'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control( 'perfume_store_stickyheader', array(
	   'section'   => 'perfume_store_topbar_section',
	   'label'	=> __('Check To Show Sticky Header','perfume-store'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('perfume_store_topbar_text_title', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('perfume_store_topbar_text_title', array(
	    'settings' => 'perfume_store_topbar_text_title',
	    'section'  => 'perfume_store_topbar_section',
	    'label'    => __('Add Text', 'perfume-store'),
	    'type'     => 'text',
	));	

	$wp_customize->add_setting('perfume_store_topbar_mail_title', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('perfume_store_topbar_mail_title', array(
	    'settings' => 'perfume_store_topbar_mail_title',
	    'section'  => 'perfume_store_topbar_section',
	    'label'    => __('Add Mail Title', 'perfume-store'),
	    'type'     => 'text',
	));	

	$wp_customize->add_setting('perfume_store_email_address',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_email',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_email_address', array(
	   'settings' => 'perfume_store_email_address',
	   'section'   => 'perfume_store_topbar_section',
	   'label' => __('Add Email Address', 'perfume-store'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('perfume_store_topbar_phone_title', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('perfume_store_topbar_phone_title', array(
	    'settings' => 'perfume_store_topbar_phone_title',
	    'section'  => 'perfume_store_topbar_section',
	    'label'    => __('Add Phone Title', 'perfume-store'),
	    'type'     => 'text',
	));	

	$wp_customize->add_setting('perfume_store_phone_number',array(
		'default' => '',
		'sanitize_callback' => 'perfume_store_sanitize_phone_number',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_phone_number', array(
	   'settings' => 'perfume_store_phone_number',
	   'section'   => 'perfume_store_topbar_section',
	   'label' => __('Add Phone Number', 'perfume-store'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('perfume_store_facebook_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_facebook_link', array(
	   'settings' => 'perfume_store_facebook_link',
	   'section'   => 'perfume_store_topbar_section',
	   'label' => __('Facebook Link', 'perfume-store'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('perfume_store_twitter_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_twitter_link', array(
	   'settings' => 'perfume_store_twitter_link',
	   'section'   => 'perfume_store_topbar_section',
	   'label' => __('Twitter Link', 'perfume-store'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('perfume_store_instagram_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_instagram_link', array(
	   'settings' => 'perfume_store_instagram_link',
	   'section'   => 'perfume_store_topbar_section',
	   'label' => __('Instagram Link', 'perfume-store'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('perfume_store_youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_youtube_link', array(
	   'settings' => 'perfume_store_youtube_link',
	   'section'   => 'perfume_store_topbar_section',
	   'label' => __('Youtube Link', 'perfume-store'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting( 'perfume_store_topbar_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_topbar_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(PERFUME_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'perfume_store_topbar_section'
	));

    // Banner Section
	$wp_customize->add_section('perfume_store_banner_section',array(
	    'title' => __('Manage Banner Section','perfume-store'),
	    'priority'  => null,
	    'description'	=> __('<p class="sec-title">Manage Banner Section</p> Select Page from the Dropdowns for banner, Also use the given image dimension (380 x 490).','perfume-store'),
	    'panel' => 'perfume_store_panel_area',
	));	

	$wp_customize->add_setting('perfume_store_banner',array(
		'default' => false,
		'sanitize_callback' => 'perfume_store_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_banner', array(
	   'settings' => 'perfume_store_banner',
	   'section'   => 'perfume_store_banner_section',
	   'label'     => __('Check To Enable This Section','perfume-store'),
	   'type'      => 'checkbox'
	));

	// Page Dropdown
	$wp_customize->add_setting('perfume_store_banner_pageboxes', array(
	    'default'           => '0',
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'perfume_store_sanitize_dropdown_pages',
	));
	$wp_customize->add_control('perfume_store_banner_pageboxes', array(
	    'type'     => 'dropdown-pages',
	    'label'    => __('Select Page to display Banner', 'perfume-store'),
	    'section'  => 'perfume_store_banner_section',
	));

	// Small Title
	$wp_customize->add_setting('perfume_store_banner_small_title', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('perfume_store_banner_small_title', array(
	    'settings' => 'perfume_store_banner_small_title',
	    'section'  => 'perfume_store_banner_section',
	    'label'    => __('Add Banner Small Title', 'perfume-store'),
	    'type'     => 'text',
	));

	// Button Text
	$wp_customize->add_setting('perfume_store_button_text', array(
	    'default'           => 'Browse More',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('perfume_store_button_text', array(
	    'settings' => 'perfume_store_button_text',
	    'section'  => 'perfume_store_banner_section',
	    'label'    => __('Add Banner Button Text', 'perfume-store'),
	    'type'     => 'text',
	));

	// Button Link
	$wp_customize->add_setting('perfume_store_button_link_banner', array(
	    'default'           => '',
	    'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('perfume_store_button_link_banner', array(
	    'label'    => __('Add Banner Button Link', 'perfume-store'),
	    'section'  => 'perfume_store_banner_section',
	    'type'     => 'url',
	));

	$wp_customize->add_setting('perfume_store_banner_bg_color',array(
		'default' => '',
		'sanitize_callback' => 'perfume_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_banner_bg_color', array(
		'settings' => 'perfume_store_banner_bg_color',
		'section'   => 'perfume_store_banner_section',
		'label' => __('Banner Color', 'perfume-store'),
		'type'      => 'color'
	));

	$wp_customize->add_setting( 'perfume_store_banner_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_banner_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(PERFUME_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'perfume_store_banner_section'
	));

	// Trending Products Section
	$wp_customize->add_section('perfume_store_trending_section', array(
	    'title'       => __('Manage Trending Products Section', 'perfume-store'),
	    'description' => __('<p class="sec-title">Manage Trending Products Section</p>', 'perfume-store'),
	    'priority'    => null,
	    'panel'       => 'perfume_store_panel_area',
	));

	$wp_customize->add_setting('perfume_store_disabled_trending_section', array(
	    'default'           => true,
	    'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('perfume_store_disabled_trending_section', array(
	    'settings' => 'perfume_store_disabled_trending_section',
	    'section'  => 'perfume_store_trending_section',
	    'label'    => __('Check To Enable Section', 'perfume-store'),
	    'type'     => 'checkbox',
	));

	$wp_customize->add_setting('perfume_store_trending_title', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('perfume_store_trending_title', array(
	    'settings' => 'perfume_store_trending_title',
	    'section'  => 'perfume_store_trending_section',
	    'label'    => __('Add Trending Products Title', 'perfume-store'),
	    'type'     => 'text',
	));

	$perfume_store_args = array(
       	'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
	$perfume_store_categories = get_categories($perfume_store_args);
	$perfume_store_cat_posts = array();
	$perfume_store_m = 0;
	$perfume_store_cat_posts[]='Select';
	foreach($perfume_store_categories as $perfume_store_category){
		if($perfume_store_m==0){
			$perfume_store_default = $perfume_store_category->slug;
			$perfume_store_m++;
		}
		$perfume_store_cat_posts[$perfume_store_category->slug] = $perfume_store_category->name;
	}

	$wp_customize->add_setting('perfume_store_hot_products_cat',array(
		'default'	=> 'select',
		'sanitize_callback' => 'perfume_store_sanitize_choices',
	));
	$wp_customize->add_control('perfume_store_hot_products_cat',array(
		'type'    => 'select',
		'choices' => $perfume_store_cat_posts,
		'label' => __('Select category to display products ','perfume-store'),
		'section' => 'perfume_store_trending_section',
	));

	$wp_customize->add_setting( 'perfume_store_products_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_products_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(PERFUME_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'perfume_store_trending_section'
	));

	//Blog post
	$wp_customize->add_section('perfume_store_blog_post_settings',array(
        'title' => __('Manage Post Section', 'perfume-store'),
        'priority' => null,
        'panel' => 'perfume_store_panel_area'
    ) );

	$wp_customize->add_setting('perfume_store_metafields_date', array(
	    'default' => true,
	    'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control('perfume_store_metafields_date', array(
	    'settings' => 'perfume_store_metafields_date', 
	    'section'   => 'perfume_store_blog_post_settings',
	    'label'     => __('Check to Enable Date', 'perfume-store'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('perfume_store_metafields_comments', array(
		'default' => true,
		'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));	
	$wp_customize->add_control('perfume_store_metafields_comments', array(
		'settings' => 'perfume_store_metafields_comments',
		'section'  => 'perfume_store_blog_post_settings',
		'label'    => __('Check to Enable Comments', 'perfume-store'),
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('perfume_store_metafields_author', array(
		'default' => true,
		'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control('perfume_store_metafields_author', array(
		'settings' => 'perfume_store_metafields_author',
		'section'  => 'perfume_store_blog_post_settings',
		'label'    => __('Check to Enable Author', 'perfume-store'),
		'type'     => 'checkbox',
	));		

	$wp_customize->add_setting('perfume_store_metafields_time', array(
		'default' => true,
		'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control('perfume_store_metafields_time', array(
		'settings' => 'perfume_store_metafields_time',
		'section'  => 'perfume_store_blog_post_settings',
		'label'    => __('Check to Enable Time', 'perfume-store'),
		'type'     => 'checkbox',
	));	

	$wp_customize->add_setting('perfume_store_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','perfume-store'),
		'description' => __('Ex: "/", "|", "-", ...','perfume-store'),
		'section' => 'perfume_store_blog_post_settings'
	)); 

    // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('perfume_store_sidebar_post_layout',array(
		'default' => 'right',
		'sanitize_callback' => 'perfume_store_sanitize_choices'
	));
	$wp_customize->add_control('perfume_store_sidebar_post_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Post Sidebar Position', 'perfume-store'),
		'description'   => __('This option work for blog page, archive page and search page.', 'perfume-store'),
		'section' => 'perfume_store_blog_post_settings',
		'choices' => array(
			'full' => __('Full','perfume-store'),
			'left' => __('Left','perfume-store'),
			'right' => __('Right','perfume-store'),
			'three-column' => __('Three Columns','perfume-store'),
			'four-column' => __('Four Columns','perfume-store'),
			'grid' => __('Grid Layout','perfume-store')
     ),
	) );

	$wp_customize->add_setting('perfume_store_blog_post_description_option',array(
    	'default'   => 'Excerpt Content', 
        'sanitize_callback' => 'perfume_store_sanitize_choices'
	));
	$wp_customize->add_control('perfume_store_blog_post_description_option',array(
        'type' => 'radio',
        'label' => __('Post Description Length','perfume-store'),
        'section' => 'perfume_store_blog_post_settings',
        'choices' => array(
            'No Content' => __('No Content','perfume-store'),
            'Excerpt Content' => __('Excerpt Content','perfume-store'),
            'Full Content' => __('Full Content','perfume-store'),
        ),
	) );

	$wp_customize->add_setting('perfume_store_blog_post_thumb',array(
        'sanitize_callback' => 'perfume_store_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('perfume_store_blog_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Show / Hide Blog Post Thumbnail', 'perfume-store'),
        'section'     => 'perfume_store_blog_post_settings',
    ));

    $wp_customize->add_setting( 'perfume_store_blog_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'perfume_store_sanitize_integer'
    ) );
    $wp_customize->add_control(new Perfume_Store_Slider_Custom_Control( $wp_customize, 'perfume_store_blog_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Blog Page Image Box Shadow','perfume-store'),
		'section'=> 'perfume_store_blog_post_settings',
		'settings'=>'perfume_store_blog_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'perfume_store_blog_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_blog_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(PERFUME_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'perfume_store_blog_post_settings'
	));

	//Single Post Settings
	$wp_customize->add_section('perfume_store_single_post_settings',array(
		'title' => __('Manage Single Post Section', 'perfume-store'),
		'priority' => null,
		'panel' => 'perfume_store_panel_area'
	));

	$wp_customize->add_setting( 'perfume_store_single_page_breadcrumb',array(
		'default' => true,
        'sanitize_callback'	=> 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control('perfume_store_single_page_breadcrumb',array(
       'section' => 'perfume_store_single_post_settings',
	   'label' => __( 'Check To Enable Breadcrumb','perfume-store' ),
	   'type' => 'checkbox'
    ));	

	$wp_customize->add_setting('perfume_store_single_post_date',array(
		'default' => true,
		'sanitize_callback'	=> 'perfume_store_sanitize_checkbox'
	));
	$wp_customize->add_control('perfume_store_single_post_date',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Date ','perfume-store'),
		'section' => 'perfume_store_single_post_settings'
	));	

	$wp_customize->add_setting('perfume_store_single_post_author',array(
		'default' => true,
		'sanitize_callback'	=> 'perfume_store_sanitize_checkbox'
	));
	$wp_customize->add_control('perfume_store_single_post_author',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Author','perfume-store'),
		'section' => 'perfume_store_single_post_settings'
	));

	$wp_customize->add_setting('perfume_store_single_post_comment',array(
		'default' => true,
		'sanitize_callback'	=> 'perfume_store_sanitize_checkbox'
	));
	$wp_customize->add_control('perfume_store_single_post_comment',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Comments','perfume-store'),
		'section' => 'perfume_store_single_post_settings'
	));	

	$wp_customize->add_setting('perfume_store_single_post_time',array(
		'default' => true,
		'sanitize_callback'	=> 'perfume_store_sanitize_checkbox'
	));
	$wp_customize->add_control('perfume_store_single_post_time',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Time','perfume-store'),
		'section' => 'perfume_store_single_post_settings'
	));	

	$wp_customize->add_setting('perfume_store_single_post_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_single_post_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','perfume-store'),
		'description' => __('Ex: "/", "|", "-", ...','perfume-store'),
		'section' => 'perfume_store_single_post_settings'
	)); 

	$wp_customize->add_setting('perfume_store_sidebar_single_post_layout',array(
    	'default' => 'right',
    	 'sanitize_callback' => 'perfume_store_sanitize_choices'
	));
	$wp_customize->add_control('perfume_store_sidebar_single_post_layout',array(
   		'type' => 'radio',
    	'label'     => __('Single post sidebar layout', 'perfume-store'),
     	'section' => 'perfume_store_single_post_settings',
     	'choices' => array(
			'full' => __('Full','perfume-store'),
			'left' => __('Left','perfume-store'),
			'right' => __('Right','perfume-store'),
     ),
	));

	$wp_customize->add_setting( 'perfume_store_single_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'perfume_store_sanitize_integer'
    ) );
    $wp_customize->add_control(new Perfume_Store_Slider_Custom_Control( $wp_customize, 'perfume_store_single_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Single Post Image Box Shadow','perfume-store'),
		'section'=> 'perfume_store_single_post_settings',
		'settings'=>'perfume_store_single_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'perfume_store_single_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_single_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(PERFUME_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'perfume_store_single_post_settings'
	));

	// 404 Page Settings
	$wp_customize->add_section('perfume_store_page_not_found', array(
		'title'	=> __('Manage 404 Page Section','perfume-store'),
		'priority'	=> null,
		'panel' => 'perfume_store_panel_area',
	));
	
	$wp_customize->add_setting('perfume_store_page_not_found_heading',array(
		'default'=> __('404 Not Found','perfume-store'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_page_not_found_heading',array(
		'label'	=> __('404 Heading','perfume-store'),
		'section'=> 'perfume_store_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('perfume_store_page_not_found_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('perfume_store_page_not_found_content',array(
		'label'	=> __('404 Text','perfume-store'),
		'input_attrs' => array(
			'placeholder' => __( 'Looks like you have taken a wrong turn.....Don\'t worry... it happens to the best of us.', 'perfume-store' ),
		),
		'section'=> 'perfume_store_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'perfume_store_page_not_found_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_page_not_found_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(PERFUME_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'perfume_store_page_not_found'
	));

	// Footer Section
	$wp_customize->add_section('perfume_store_footer', array(
		'title'	=> __('Manage Footer Section','perfume-store'),
		'description'	=> __('<p class="sec-title">Manage Footer Section</p>','perfume-store'),
		'priority'	=> null,
		'panel' => 'perfume_store_panel_area',
	));

	$wp_customize->add_setting('perfume_store_footer_widget', array(
	    'default' => true,
	    'sanitize_callback' => 'perfume_store_sanitize_checkbox',
	));
	$wp_customize->add_control('perfume_store_footer_widget', array(
	    'settings' => 'perfume_store_footer_widget',
	    'section'   => 'perfume_store_footer',
	    'label'     => __('Check to Enable Footer Widget', 'perfume-store'),
	    'type'      => 'checkbox',
	));

	//  footer bg color
	$wp_customize->add_setting('perfume_store_footerbg_color',array(
		'default' => '',
		'sanitize_callback' => 'perfume_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_footerbg_color', array(
		'settings' => 'perfume_store_footerbg_color',
		'section'   => 'perfume_store_footer',
		'label' => __('Footer Background Color', 'perfume-store'),
		'type'      => 'color'
	));

	$wp_customize->add_setting('perfume_store_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'perfume_store_footer_bg_image',array(
        'label' => __('Footer Background Image','perfume-store'),
        'section' => 'perfume_store_footer',
    )));

	$wp_customize->add_setting('perfume_store_footer_img_position',array(
		'default' => 'center center',
		'transport' => 'refresh',
		'sanitize_callback' => 'perfume_store_sanitize_choices'
	));
	$wp_customize->add_control('perfume_store_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','perfume-store'),
		'section' => 'perfume_store_footer',
		'choices' 	=> array(
			'center center'   => esc_html__( 'Center', 'perfume-store' ),
			'center top'   => esc_html__( 'Top', 'perfume-store' ),
			'left center'   => esc_html__( 'Left', 'perfume-store' ),
			'right center'   => esc_html__( 'Right', 'perfume-store' ),
			'center bottom'   => esc_html__( 'Bottom', 'perfume-store' ),
		),
	));	

	$wp_customize->add_setting('perfume_store_footer_widget_areas',array(
		'default'           => 4,
		'sanitize_callback' => 'perfume_store_sanitize_choices',
	));
	$wp_customize->add_control('perfume_store_footer_widget_areas',array(
		'type'        => 'radio',
		'section' => 'perfume_store_footer',
		'label'       => __('Footer widget area', 'perfume-store'),
		'choices' => array(
		   '1'     => __('One', 'perfume-store'),
		   '2'     => __('Two', 'perfume-store'),
		   '3'     => __('Three', 'perfume-store'),
		   '4'     => __('Four', 'perfume-store')
		),
	));

	$wp_customize->add_setting('perfume_store_copyright_line',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'perfume_store_copyright_line', array(
	   'section' 	=> 'perfume_store_footer',
	   'label'	 	=> __('Copyright Line','perfume-store'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	$wp_customize->add_setting('perfume_store_copyright_link',array(
    	'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'perfume_store_copyright_link', array(
	   'section' 	=> 'perfume_store_footer',
	   'label'	 	=> __('Copyright Link','perfume-store'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	//  footer coypright color
	$wp_customize->add_setting('perfume_store_footercoypright_color',array(
		'default' => '',
		'sanitize_callback' => 'perfume_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_footercoypright_color', array(
	   'settings' => 'perfume_store_footercoypright_color',
	   'section'   => 'perfume_store_footer',
	   'label' => __('Coypright Color', 'perfume-store'),
	   'type'      => 'color'
	));

	//  footer title color
	$wp_customize->add_setting('perfume_store_footertitle_color',array(
		'default' => '',
		'sanitize_callback' => 'perfume_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_footertitle_color', array(
	   'settings' => 'perfume_store_footertitle_color',
	   'section'   => 'perfume_store_footer',
	   'label' => __('Title Color', 'perfume-store'),
	   'type'      => 'color'
	));

	//  footer description color
	$wp_customize->add_setting('perfume_store_footerdescription_color',array(
		'default' => '',
		'sanitize_callback' => 'perfume_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_footerdescription_color', array(
	   'settings' => 'perfume_store_footerdescription_color',
	   'section'   => 'perfume_store_footer',
	   'label' => __('Description Color', 'perfume-store'),
	   'type'      => 'color'
	));

	//  footer list color
	$wp_customize->add_setting('perfume_store_footerlist_color',array(
		'default' => '',
		'sanitize_callback' => 'perfume_store_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_footerlist_color', array(
	   'settings' => 'perfume_store_footerlist_color',
	   'section'   => 'perfume_store_footer',
	   'label' => __('List Color', 'perfume-store'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('perfume_store_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'perfume_store_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'perfume_store_scroll_hide',array(
        'label'          => __( 'Check To Show Scroll To Top', 'perfume-store' ),
        'section'        => 'perfume_store_footer',
        'settings'       => 'perfume_store_scroll_hide',
        'type'           => 'checkbox',
    )));

	$wp_customize->add_setting('perfume_store_scroll_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'perfume_store_sanitize_choices'
    ));
    $wp_customize->add_control('perfume_store_scroll_position',array(
        'type' => 'radio',
        'section' => 'perfume_store_footer',
        'label'	 	=> __('Scroll To Top Positions','perfume-store'),
        'choices' => array(
            'Right' => __('Right','perfume-store'),
            'Left' => __('Left','perfume-store'),
            'Center' => __('Center','perfume-store')
        ),
    ) );

	$wp_customize->add_setting('perfume_store_scroll_text',array(
		'default'	=> __('TOP','perfume-store'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('perfume_store_scroll_text',array(
		'label'	=> __('Scroll To Top Button Text','perfume-store'),
		'section'	=> 'perfume_store_footer',
		'type'		=> 'text'
	));

	$wp_customize->add_setting( 'perfume_store_scroll_top_shape', array(
		'default'           => 'circle',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	
	$wp_customize->add_control( 'perfume_store_scroll_top_shape', array(
		'label'    => __( 'Scroll to Top Button Shape', 'perfume-store' ),
		'section'  => 'perfume_store_footer',
		'settings' => 'perfume_store_scroll_top_shape',
		'type'     => 'radio',
		'choices'  => array(
			'box'        => __( 'Box', 'perfume-store' ),
			'curved' => __( 'Curved', 'perfume-store'),
			'circle'     => __( 'Circle', 'perfume-store' ),
		),
	) );

	$wp_customize->add_setting( 'perfume_store_footer_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_footer_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(PERFUME_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'perfume_store_footer'
	));

	// Footer Social Section
	$wp_customize->add_section('perfume_store_footer_social_icons', array(
		'title'	=> __('Manage Footer Social Section','perfume-store'),
		'description'	=> __('<p class="sec-title">Manage Footer Social Section</p>','perfume-store'),
		'priority'	=> null,
		'panel' => 'perfume_store_panel_area',
	));

	$wp_customize->add_setting('perfume_store_footer_facebook_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_footer_facebook_link', array(
		'settings' => 'perfume_store_footer_facebook_link',
		'section'   => 'perfume_store_footer_social_icons',
		'label' => __('Facebook Link', 'perfume-store'),
		'type'      => 'url'
	));

	$wp_customize->add_setting('perfume_store_footer_instagram_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_footer_instagram_link', array(
		'settings' => 'perfume_store_footer_instagram_link',
		'section'   => 'perfume_store_footer_social_icons',
		'label' => __('Instagram Link', 'perfume-store'),
		'type'      => 'url'
	));

	$wp_customize->add_setting('perfume_store_footer_pinterest_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_footer_pinterest_link', array(
		'settings' => 'perfume_store_footer_pinterest_link',
		'section'   => 'perfume_store_footer_social_icons',
		'label' => __('Pinterest Link', 'perfume-store'),
		'type'      => 'url'
	));

	$wp_customize->add_setting('perfume_store_footer_twitter_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_footer_twitter_link', array(
		'settings' => 'perfume_store_footer_twitter_link',
		'section'   => 'perfume_store_footer_social_icons',
		'label' => __('Twitter Link', 'perfume-store'),
		'type'      => 'url'
	));
	
	$wp_customize->add_setting('perfume_store_footer_youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'perfume_store_footer_youtube_link', array(
		'settings' => 'perfume_store_footer_youtube_link',
		'section'   => 'perfume_store_footer_social_icons',
		'label' => __('Youtube Link', 'perfume-store'),
		'type'      => 'url'
	));

	$wp_customize->add_setting( 'perfume_store_footer_social_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('perfume_store_footer_social_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(PERFUME_STORE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'perfume_store_footer_social_icons'
	));
    
	// Google Fonts
	$wp_customize->add_section( 'perfume_store_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'perfume-store' ),
		'priority'    => 24,
	) );

	$font_choices = array(
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'perfume_store_headings_fonts', array(
		'sanitize_callback' => 'perfume_store_sanitize_fonts',
	));
	$wp_customize->add_control( 'perfume_store_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'perfume-store'),
		'section' => 'perfume_store_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'perfume_store_body_fonts', array(
		'sanitize_callback' => 'perfume_store_sanitize_fonts'
	));
	$wp_customize->add_control( 'perfume_store_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'perfume-store' ),
		'section' => 'perfume_store_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'perfume_store_sub_title_fonts', array(
		'sanitize_callback' => 'perfume_store_sanitize_fonts',
	));
	$wp_customize->add_control( 'perfume_store_sub_title_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the sub-heading.', 'perfume-store'),
		'section' => 'perfume_store_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'perfume_store_body_anchor_fonts', array(
		'sanitize_callback' => 'perfume_store_sanitize_fonts',
	));
	$wp_customize->add_control( 'perfume_store_body_anchor_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the anchors.', 'perfume-store'),
		'section' => 'perfume_store_google_fonts_section',
		'choices' => $font_choices
	));
  
}
add_action( 'customize_register', 'perfume_store_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function perfume_store_customize_preview_js() {
	wp_enqueue_script( 'perfume_store_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'perfume_store_customize_preview_js' );
