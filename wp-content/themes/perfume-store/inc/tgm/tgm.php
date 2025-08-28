<?php
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function perfume_store_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'WooCommerce', 'perfume-store' ),
			'slug'             => 'woocommerce',
			'required'         => false,
			'force_activation' => false,
		),
		array(
            'name'             => __( 'YITH WooCommerce Wishlist', 'perfume-store' ),
            'slug'             => 'yith-woocommerce-wishlist',
            'source'           => '',
            'required'         => false,
            'force_activation' => false,
        ),
		array(
			'name'             => __( 'Classic Blog Grid', 'perfume-store' ),
			'slug'             => 'classic-blog-grid',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'perfume_store_register_recommended_plugins' );