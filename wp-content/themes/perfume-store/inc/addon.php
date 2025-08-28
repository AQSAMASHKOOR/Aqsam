<?php
/*
 * @package Perfume Store
 */

function perfume_store_admin_enqueue_scripts() {
    wp_enqueue_style( 'perfume-store-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'perfume_store_admin_enqueue_scripts' );

function perfume_store_theme_info_menu_link() {

    $perfume_store_theme = wp_get_theme();
    add_theme_page(
        /* translators: 1: Theme name, 2: Theme version */
        sprintf( esc_html__( 'Welcome to %1$s %2$s', 'perfume-store' ), $perfume_store_theme->get( 'Name' ), $perfume_store_theme->get( 'Version' ) ),
        esc_html__( 'Theme Info', 'perfume-store' ),'edit_theme_options','perfume-store','perfume_store_theme_info_page'
    );

    // Add "Theme Demo Import" page
    add_theme_page(
        esc_html__( 'Theme Demo Import', 'perfume-store' ),
        esc_html__( 'Theme Demo Import', 'perfume-store' ),
        'edit_theme_options',
        'perfume-store-demo',
        'perfume_store_demo_content_page'
    );

}
add_action( 'admin_menu', 'perfume_store_theme_info_menu_link' );

function perfume_store_theme_info_page() {

    $perfume_store_theme = wp_get_theme();
    ?>
<div class="wrap theme-info-wrap">
    <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'perfume-store' ), esc_html($perfume_store_theme->get( 'Name' )), esc_html($perfume_store_theme->get( 'Version' ))); ?>
    </h1>
    <p class="theme-description">
    <?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'perfume-store' ); ?>
    </p>
    <div class="important-link">
        <p class="main-box columns-wrapper clearfix">
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Pro version of our theme', 'perfume-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you exited for our theme? Then we will proceed for pro version of theme.', 'perfume-store' ); ?></p>
                <a class="get-premium" href="<?php echo esc_url( PERFUME_STORE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'perfume-store' ); ?></a>
                <p><strong><?php esc_html_e( 'Check all classic features', 'perfume-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Explore all the premium features.', 'perfume-store' ); ?></p>
                <a href="<?php echo esc_url( PERFUME_STORE_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'perfume-store' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Need Help?', 'perfume-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Go to our support forum to help you out in case of queries and doubts regarding our theme.', 'perfume-store' ); ?></p>
                <a href="<?php echo esc_url( PERFUME_STORE_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'perfume-store' ); ?></a>
                <p><strong><?php esc_html_e( 'Leave us a review', 'perfume-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you enjoying our theme? We would love to hear your feedback.', 'perfume-store' ); ?></p>
                <a href="<?php echo esc_url( PERFUME_STORE_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'perfume-store' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Check Our Demo', 'perfume-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Here, you can view a live demonstration of our premium them.', 'perfume-store' ); ?></p>
                <a href="<?php echo esc_url( PERFUME_STORE_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'perfume-store' ); ?></a>
                <p><strong><?php esc_html_e( 'Theme Documentation', 'perfume-store' ); ?></strong></p>
                <p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed theme setup.', 'perfume-store' ); ?></p>
                <a href="<?php echo esc_url( PERFUME_STORE_THEME_DOCUMENTATION ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'perfume-store' ); ?></a>
            </div>
        </p>
    </div>
    <div id="getting-started">
        <h3><?php 
        /* translators: %s: Theme name */
        printf( esc_html__( 'Getting started with %s', 'perfume-store' ),
        esc_html($perfume_store_theme->get( 'Name' ))); ?></h3>
        <div class="columns-wrapper clearfix">
            <div class="column column-half clearfix">
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Description', 'perfume-store' ); ?></h4>
                    <div class="theme-description-1"><?php echo esc_html($perfume_store_theme->get( 'Description' )); ?></div>
                </div>
            </div>
            <div class="column column-half clearfix">
                <img src="<?php echo esc_url( $perfume_store_theme->get_screenshot() ); ?>" alt="<?php echo esc_attr( 'screenshot', 'perfume-store'); ?>"/>
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Options', 'perfume-store' ); ?></h4>
                    <p class="about">
                    <?php 
                    /* translators: %s: Theme name */
                    printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'perfume-store' ),esc_html($perfume_store_theme->get( 'Name' ))); ?></p>
                    <p>
                    <div class="themelink-1">
                        <a target="_blank" href="<?php echo esc_url( wp_customize_url() ); ?>"><?php esc_html_e( 'Customize Theme', 'perfume-store' ); ?></a>
                        <a class="get-premium" href="<?php echo esc_url( PERFUME_STORE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Checkout Premium', 'perfume-store' ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="theme-author">
      <p><?php
      /* translators: 1: Theme name, 2: Developer name, 3: Call to action */
        printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'perfume-store' ),
            esc_html($perfume_store_theme->get( 'Name' )),
            '<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'perfume-store' ) . '">classictemplate</a>',
            '<a target="_blank" href="' . esc_url( PERFUME_STORE_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'perfume-store' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'perfume-store' ) . '</a>'
        );
        ?></p>
    </div>
</div>
<?php
}

function perfume_store_demo_content_page() {

    $perfume_store_theme = wp_get_theme();
    ?>
    <div class="container">
       <div class="start-box">
          <div class="columns-wrapper m-0"> 
             <div class="column column-half clearfix">
               <div class="wrapper-info"> 
                  <img src="<?php echo esc_url( get_template_directory_uri().'/images/Logo.png' ); ?>" />
                  <h2><?php esc_html_e( 'Welcome to Perfume Store', 'perfume-store' ); ?></h2>
                  <span class="version"><?php esc_html_e( 'Version', 'perfume-store' ); ?>: <?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></span>	
                  <p><?php esc_html_e( 'To begin, locate the run importer button and click on it to initiate the importation of all the demo content.', 'perfume-store' ); ?></p>
                  <?php require get_parent_theme_file_path( '/inc/demo-content.php' ); ?>
               </div>
             </div>
             <div class="column column-half clearfix">
             <div class="get-screenshot">
               <img src="<?php echo esc_url( get_template_directory_uri().'/screenshot.png' ); ?>" />
             </div>   
             </div>
          </div>
       </div>
    </div>
<?php
}

?>
