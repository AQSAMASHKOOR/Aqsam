<?php
/**
 * Perfume Store functions and definitions
 *
 * @package Perfume Store
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'perfume_store_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function perfume_store_setup() {
	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 680;
	
	load_theme_textdomain( 'perfume-store', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'custom-header', array(
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 100,
		'flex-height' => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'perfume-store' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	/* Starter Content */
	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'footer-1' => array(
				'categories',
			),
			'footer-2' => array(
				'archives',
			),
			'footer-3' => array(
				'meta',
			),
			'footer-4' => array(
				'search',
			),
		),
    ));

	add_editor_style( 'editor-style.css' );

	global $pagenow;

    if ( is_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
        add_action('admin_notices', 'perfume_store_deprecated_hook_admin_notice');
    }
}
endif; // perfume_store_setup
add_action( 'after_setup_theme', 'perfume_store_setup' );

function perfume_store_the_breadcrumb() {
    echo '<div class="breadcrumb my-3">';

    if (!is_home()) {
        echo '<a class="home-main align-self-center" href="' . esc_url(home_url()) . '">';
        bloginfo('name');
        echo "</a> >> ";

        if (is_category() || is_single()) {
            the_category(' >> ');
            if (is_single()) {
                echo ' >> <span class="current-breadcrumb">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (is_page()) {
            echo '<span class="current-breadcrumb">' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</div>';
}

function perfume_store_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'perfume-store' ),
		'description'   => __( 'Appears on blog page sidebar', 'perfume-store' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'perfume-store' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'perfume-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'perfume-store' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'perfume-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar(array(
        'name'          => __('Shop Sidebar', 'perfume-store'),
        'description'   => __('Sidebar for WooCommerce shop pages', 'perfume-store'),
		'id'            => 'woocommerce-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
	register_sidebar(array(
        'name'          => __('Single Product Sidebar', 'perfume-store'),
        'description'   => __('Sidebar for single product pages', 'perfume-store'),
		'id'            => 'woocommerce-single-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));		
	
	$perfume_store_widget_areas = get_theme_mod('perfume_store_footer_widget_areas', '4');
	for ($perfume_store_i=1; $perfume_store_i<=$perfume_store_widget_areas; $perfume_store_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'perfume-store' ) . $perfume_store_i,
			'id'            => 'footer-' . $perfume_store_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="ftr-4-box widget-column-4 %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

}
add_action( 'widgets_init', 'perfume_store_widgets_init' );

// Change number of products per row to 4
add_filter('loop_shop_columns', 'perfume_store_loop_columns');
if (!function_exists('perfume_store_loop_columns')) {
    function perfume_store_loop_columns() {
        $colm = get_theme_mod('perfume_store_products_per_row', 4); // Default to 4 if not set
        return $colm;
    }
}

// Use the customizer setting to set the number of products per page
function perfume_store_products_per_page($cols) {
    $cols = get_theme_mod('perfume_store_products_per_page', 8); // Default to 8 if not set
    return $cols;
}
add_filter('loop_shop_per_page', 'perfume_store_products_per_page', 8);

function perfume_store_scripts() {
	
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri())."/css/bootstrap.css" );
	wp_enqueue_style('perfume-store-style', get_stylesheet_uri(), array() );
		wp_style_add_data('perfume-store-style', 'rtl', 'replace');
	require get_parent_theme_file_path( '/inc/color-scheme/custom-color-control.php' );
	wp_add_inline_style( 'perfume-store-style',$perfume_store_color_scheme_css );
	wp_enqueue_style( 'perfume-store-default', esc_url(get_template_directory_uri())."/css/default.css" );
	wp_enqueue_style( 'perfume-store-style', get_stylesheet_uri() );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'perfume-store-theme', esc_url(get_template_directory_uri()) . '/js/theme.js' );
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/css/fontawesome-all.css" );
	wp_enqueue_style( 'perfume-store-block-style', esc_url( get_template_directory_uri() ).'/css/blocks.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// font-family
    $perfume_store_body_font = esc_html(get_theme_mod('perfume_store_body_fonts'));
    $perfume_store_heading_font = esc_html(get_theme_mod('perfume_store_headings_fonts'));
    $perfume_store_sub_title_font = esc_html(get_theme_mod('perfume_store_sub_title_fonts'));
    $perfume_store_body_anchor_font = esc_html(get_theme_mod('perfume_store_body_anchor_fonts'));

    if ($perfume_store_body_font) {
        wp_enqueue_style('perfume-store-body-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($perfume_store_body_font));
    } else {
        wp_enqueue_style('Poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
    }

    if ($perfume_store_heading_font) {
        wp_enqueue_style('perfume-store-body-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($perfume_store_heading_font));
    } else {
        wp_enqueue_style('Jockey One', 'https://fonts.googleapis.com/css2?family=Jockey+One');
    }

    if ($perfume_store_sub_title_font) {
        wp_enqueue_style('perfume-store-body-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($perfume_store_sub_title_font));
    } else {
        wp_enqueue_style('Kalam', 'https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700');
    }

    if ($perfume_store_body_anchor_font) {
        wp_enqueue_style('perfume-store-body-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($perfume_store_body_anchor_font));
    } else {
        wp_enqueue_style('Inter', 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900');
    }

}
add_action( 'wp_enqueue_scripts', 'perfume_store_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Sanitization Callbacks.
 */
require get_template_directory() . '/inc/sanitization-callbacks.php';

/**
 * Webfont-Loader.
 */
require get_template_directory() . '/inc/wptt-webfont-loader.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/upgrade-to-pro.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * select .
 */
require get_template_directory() . '/inc/select/category-dropdown-custom-control.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/inc/tgm/tgm.php';

/**
 * Theme Info Page.
 */
require get_template_directory() . '/inc/addon.php';

function perfume_store_setup_theme() {
	if ( ! defined( 'PERFUME_STORE_PRO_NAME' ) ) {
		define( 'PERFUME_STORE_PRO_NAME', __( 'About Perfume Store', 'perfume-store' ));
	}
	if ( ! defined( 'PERFUME_STORE_PREMIUM_PAGE' ) ) {
		define('PERFUME_STORE_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/perfume-wordpress-theme','perfume-store'));
	}
	if ( ! defined( 'PERFUME_STORE_THEME_PAGE' ) ) {
		define('PERFUME_STORE_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','perfume-store'));
	}
	if ( ! defined( 'PERFUME_STORE_SUPPORT' ) ) {
		define('PERFUME_STORE_SUPPORT',__('https://wordpress.org/support/theme/perfume-store/','perfume-store'));
	}
	if ( ! defined( 'PERFUME_STORE_REVIEW' ) ) {
		define('PERFUME_STORE_REVIEW',__('https://wordpress.org/support/theme/perfume-store/reviews/','perfume-store'));
	}
	if ( ! defined( 'PERFUME_STORE_PRO_DEMO' ) ) {
		define('PERFUME_STORE_PRO_DEMO',__('https://live.theclassictemplates.com/perfume-store-pro/','perfume-store'));
	}
	if ( ! defined( 'PERFUME_STORE_THEME_DOCUMENTATION' ) ) {
		define('PERFUME_STORE_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/perfume-store-free/','perfume-store'));
	}
}
add_action( 'after_setup_theme', 'perfume_store_setup_theme' );
    
// logo
if ( ! function_exists( 'perfume_store_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function perfume_store_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

/* Activation Notice */

function perfume_store_deprecated_hook_admin_notice() {
    $perfume_store_theme = wp_get_theme();
    $perfume_store_dismissed = get_user_meta( get_current_user_id(), 'perfume_store_dismissable_notice', true );
    if ( !$perfume_store_dismissed) { ?>
        <div class="getstrat updated notice notice-success is-dismissible notice-get-started-class">
            <div class="admin-image">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
            </div>
            <div class="admin-content" >
                <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'perfume-store' ), esc_html($perfume_store_theme->get( 'Name' )), esc_html($perfume_store_theme->get( 'Version' ))); ?>
                </h1>
                <p><?php _e('Get Started With Theme By Clicking On Getting Started.', 'perfume-store'); ?></p>
                <div style="display: grid;">
                    <a class="admin-notice-btn button button-hero upgrade-pro" target="_blank" href="<?php echo esc_url( PERFUME_STORE_PREMIUM_PAGE ); ?>"><?php esc_html_e('Upgrade Pro', 'perfume-store') ?><i class="dashicons dashicons-cart"></i></a>
                    <a class="admin-notice-btn button button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=perfume-store' )); ?>"><?php esc_html_e( 'Get started', 'perfume-store' ) ?><i class="dashicons dashicons-backup"></i></a>
                    <a class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( PERFUME_STORE_THEME_DOCUMENTATION ); ?>"><?php esc_html_e('Free Doc', 'perfume-store') ?><i class="dashicons dashicons-visibility"></i></a>
                    <a  class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( PERFUME_STORE_PRO_DEMO ); ?>"><?php esc_html_e('View Demo', 'perfume-store') ?><i class="dashicons dashicons-awards"></i></a>
                </div>
            </div>
        </div>
    <?php }
}