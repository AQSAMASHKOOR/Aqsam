<?php

$perfume_store_first_color = get_theme_mod('perfume_store_first_color');
$perfume_store_color_scheme_css = '';

/*------------------ Global First Color -----------*/

if ($perfume_store_first_color) {
  $perfume_store_color_scheme_css .= ':root {';
  $perfume_store_color_scheme_css .= '--first-theme-color: ' . esc_attr($perfume_store_first_color) . ' !important;';
  $perfume_store_color_scheme_css .= '} ';
}

$perfume_store_banner_bg_color = get_theme_mod('perfume_store_banner_bg_color');
if($perfume_store_banner_bg_color != false){
    $perfume_store_color_scheme_css .='#banner-cat{';
      $perfume_store_color_scheme_css .='background-color: '.esc_html($perfume_store_banner_bg_color).'4D;';
    $perfume_store_color_scheme_css .='}';
}

//---------------------------------Logo-Max-height--------- 
$perfume_store_logo_width = get_theme_mod('perfume_store_logo_width');
if($perfume_store_logo_width != false){
    $perfume_store_color_scheme_css .='.logo img{';
      $perfume_store_color_scheme_css .='width: '.esc_html($perfume_store_logo_width).'px;';
    $perfume_store_color_scheme_css .='}';
}

/*--------------------------- Woocommerce Product Image Border Radius -------------------*/

$perfume_store_woo_product_img_border_radius = get_theme_mod('perfume_store_woo_product_img_border_radius');
if($perfume_store_woo_product_img_border_radius != false){
    $perfume_store_color_scheme_css .='.woocommerce-shop.woocommerce .product-content .product-image img{';
    $perfume_store_color_scheme_css .='border-radius: '.esc_attr($perfume_store_woo_product_img_border_radius).'px;';
    $perfume_store_color_scheme_css .='}';
}  

/*--------------------------- Preloader Background Image ------------*/

$perfume_store_preloader_bg_image = get_theme_mod('perfume_store_preloader_bg_image');
if($perfume_store_preloader_bg_image != false){
  $perfume_store_color_scheme_css .='#preloader{';
    $perfume_store_color_scheme_css .='background: url('.esc_attr($perfume_store_preloader_bg_image).'); background-size: cover;';
  $perfume_store_color_scheme_css .='}';
}

/*--------------------------- Scroll to top positions -------------------*/

$perfume_store_scroll_position = get_theme_mod( 'perfume_store_scroll_position','Right');
if($perfume_store_scroll_position == 'Right'){
    $perfume_store_color_scheme_css .='#button{';
        $perfume_store_color_scheme_css .='right: 20px;';
    $perfume_store_color_scheme_css .='}';
}else if($perfume_store_scroll_position == 'Left'){
    $perfume_store_color_scheme_css .='#button{';
        $perfume_store_color_scheme_css .='left: 20px;';
    $perfume_store_color_scheme_css .='}';
}else if($perfume_store_scroll_position == 'Center'){
    $perfume_store_color_scheme_css .='#button{';
        $perfume_store_color_scheme_css .='right: 50%;left: 50%;';
    $perfume_store_color_scheme_css .='}';
}

/*--------------------------- Footer background image -------------------*/

$perfume_store_footer_bg_image = get_theme_mod('perfume_store_footer_bg_image');
if($perfume_store_footer_bg_image != false){
    $perfume_store_color_scheme_css .='#footer{';
        $perfume_store_color_scheme_css .='background: url('.esc_attr($perfume_store_footer_bg_image).');';
        $perfume_store_color_scheme_css .= 'background-size: cover;';  
    $perfume_store_color_scheme_css .='}';
}

/*--------------------------- Footer image position -------------------*/

$perfume_store_footer_img_position = get_theme_mod('perfume_store_footer_img_position','center center');
if($perfume_store_footer_img_position != false){
    $perfume_store_color_scheme_css .='#footer{';
        $perfume_store_color_scheme_css .='background-position: '.esc_attr($perfume_store_footer_img_position).';';
    $perfume_store_color_scheme_css .='}';
}	

/*--------------------------- Blog Post Page Image Box Shadow -------------------*/

$perfume_store_blog_post_page_image_box_shadow = get_theme_mod('perfume_store_blog_post_page_image_box_shadow',0);
if($perfume_store_blog_post_page_image_box_shadow != false){
    $perfume_store_color_scheme_css .='.blog-post img{';
        $perfume_store_color_scheme_css .='box-shadow: '.esc_attr($perfume_store_blog_post_page_image_box_shadow).'px '.esc_attr($perfume_store_blog_post_page_image_box_shadow).'px '.esc_attr($perfume_store_blog_post_page_image_box_shadow).'px #cccccc;';
    $perfume_store_color_scheme_css .='}';
}       

/*--------------------------- Single Post Page Image Box Shadow -------------------*/

$perfume_store_single_post_page_image_box_shadow = get_theme_mod('perfume_store_single_post_page_image_box_shadow',0);
if($perfume_store_single_post_page_image_box_shadow != false){
    $perfume_store_color_scheme_css .='.single-post img{';
        $perfume_store_color_scheme_css .='box-shadow: '.esc_attr($perfume_store_single_post_page_image_box_shadow).'px '.esc_attr($perfume_store_single_post_page_image_box_shadow).'px '.esc_attr($perfume_store_single_post_page_image_box_shadow).'px #cccccc;';
    $perfume_store_color_scheme_css .='}';
}  

/*--------------------------- Shop page pagination -------------------*/

$perfume_store_wooproducts_nav = get_theme_mod('perfume_store_wooproducts_nav', 'Yes');
if($perfume_store_wooproducts_nav == 'No'){
  $perfume_store_color_scheme_css .='.woocommerce nav.woocommerce-pagination{';
    $perfume_store_color_scheme_css .='display: none;';
  $perfume_store_color_scheme_css .='}';
}

/*--------------------------- Related Product -------------------*/

$perfume_store_related_product_enable = get_theme_mod('perfume_store_related_product_enable',true);
if($perfume_store_related_product_enable == false){
  $perfume_store_color_scheme_css .='.related.products{';
    $perfume_store_color_scheme_css .='display: none;';
  $perfume_store_color_scheme_css .='}';
}

/*--------------------------- Scroll to Top Button Shape -------------------*/

	$perfume_store_scroll_top_shape = get_theme_mod('perfume_store_scroll_top_shape', 'circle');
	if($perfume_store_scroll_top_shape == 'box' ){
		$perfume_store_color_scheme_css .='#button{';
			$perfume_store_color_scheme_css .=' border-radius: 0%';
		$perfume_store_color_scheme_css .='}';
	}elseif($perfume_store_scroll_top_shape == 'curved' ){
		$perfume_store_color_scheme_css .='#button{';
			$perfume_store_color_scheme_css .=' border-radius: 20%';
		$perfume_store_color_scheme_css .='}';
	}elseif($perfume_store_scroll_top_shape == 'circle' ){
		$perfume_store_color_scheme_css .='#button{';
			$perfume_store_color_scheme_css .=' border-radius: 50%;';
		$perfume_store_color_scheme_css .='}';
	}