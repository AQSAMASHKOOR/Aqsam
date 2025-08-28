<?php
/**
 * @package Perfume Store
 * Setup the WordPress core custom header feature.
 *
 * @uses perfume_store_header_style()
 */
function perfume_store_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'perfume_store_custom_header_args', array(
		'default-text-color'     => 'fff',
		'width'                  => 2500,
		'height'                 => 300,
		'wp-head-callback'       => 'perfume_store_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'perfume_store_custom_header_setup' );

if ( ! function_exists( 'perfume_store_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see perfume_store_custom_header_setup().
 */
function perfume_store_header_style() {
	$perfume_store_header_text_color = get_header_textcolor();

	?>
	<style type="text/css">
	<?php
		$perfume_store_header_image = get_header_image() ? get_header_image() : get_template_directory_uri() . '/images/headerimg.png';
	?>
		.box-image .single-page-img{
			background-image: url('<?php echo esc_url( $perfume_store_header_image ); ?>');
	        background-repeat: no-repeat;
	        background-position: center bottom;
	        background-size: cover !important;
	        height: 300px;
		}


	h1.site-title a, p.site-title a{
		color: <?php echo esc_attr(get_theme_mod('perfume_store_sitetitle_color')); ?> !important;
	}

	.site-description{
		color: <?php echo esc_attr(get_theme_mod('perfume_store_sitetagline_color')); ?> !important;
	}

	.main-nav ul li a {
		color: <?php echo esc_attr(get_theme_mod('perfume_store_menu_color')); ?> !important;
	}

	.main-nav a:hover{
		color: <?php echo esc_attr(get_theme_mod('perfume_store_menuhrv_color')); ?> !important;
	}

	.main-nav ul ul a{
		color: <?php echo esc_attr(get_theme_mod('perfume_store_submenu_color')); ?> !important;
	}

	.main-nav ul ul a:hover {
		color: <?php echo esc_attr(get_theme_mod('perfume_store_submenuhrv_color')); ?> !important;
	}

	.copywrap, .copywrap a{
		color: <?php echo esc_attr(get_theme_mod('perfume_store_footercoypright_color')); ?> !important;
	}
	#footer h3 {
		color: <?php echo esc_attr(get_theme_mod('perfume_store_footertitle_color')); ?> !important;

	}
	#footer p {
		color: <?php echo esc_attr(get_theme_mod('perfume_store_footerdescription_color')); ?>;
	}
	#footer ul li a {
		color: <?php echo esc_attr(get_theme_mod('perfume_store_footerlist_color')); ?>;

	}
	#footer {
		background-color: <?php echo esc_attr(get_theme_mod('perfume_store_footerbg_color')); ?>;
	}
	</style>
	<?php 
}
endif;