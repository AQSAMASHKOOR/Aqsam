<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Perfume Store
 */

get_header(); ?>

<div id="content" >
    <?php
        $perfume_store_banner = get_theme_mod('perfume_store_banner', false);
        $perfume_store_banner_pageboxes = get_theme_mod('perfume_store_banner_pageboxes', false);

        if ($perfume_store_banner && $perfume_store_banner_pageboxes) { ?>
        <div id="banner-cat">
            <?php
            $perfume_store_querymed = new WP_Query(array(
                'page_id' => esc_attr($perfume_store_banner_pageboxes)
            ));
            while ($perfume_store_querymed->have_posts()) : $perfume_store_querymed->the_post(); ?>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-6 col-12 align-self-center">
                            <div class="bannerbox">
                                <?php if (get_theme_mod('perfume_store_banner_small_title') != '') { ?>
                                    <p class="banner-smalltitle text-capitalize mb-2"><?php echo esc_html(get_theme_mod('perfume_store_banner_small_title')); ?></p>
                                <?php } ?>
                                <h1 class="mb-3 text-capitalize banner-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                <?php
                                    $perfume_store_trimexcerpt = get_the_excerpt();
                                    $perfume_store_shortexcerpt = wp_trim_words($perfume_store_trimexcerpt, 38);
                                    echo '<p class="banner-content">' . esc_html($perfume_store_shortexcerpt) . '</p>';
                                ?>
                                <div class="bannerbtn mt-5">
                                    <?php
                                        $perfume_store_button_text = get_theme_mod('perfume_store_button_text', 'Browse More');
                                        $perfume_store_button_link_banner = esc_url(get_theme_mod('perfume_store_button_link_banner', get_permalink()));
                                        if ($perfume_store_button_text || !empty($perfume_store_button_link_banner)) { ?>
                                        <?php if ($perfume_store_button_text != '') { ?>
                                            <a href="<?php echo esc_url($perfume_store_button_link_banner); ?>" class="button">
                                                <?php echo esc_html($perfume_store_button_text); ?>
                                                <span class="screen-reader-text"><?php echo esc_html($perfume_store_button_text); ?></span>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="offset-xl-1 offset-lg-1 col-xl-6 col-lg-6 col-md-6 col-12 align-self-center text-center banner-img position-relative">
                            <div class="img-bg1 position-absolute"></div>
                            <div class="img-bg2 position-absolute"></div>
                            <div class="img-bg3 position-absolute"></div>
                            <?php if (has_post_thumbnail()) { ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endwhile;
                wp_reset_postdata();
            ?>
        </div>
    <?php } ?>

    <!-- Trending Products Section -->
    <?php 
        $perfume_store_hide_trending_section = get_theme_mod('perfume_store_disabled_trending_section', true);
        if ($perfume_store_hide_trending_section){ ?>
        <section id="trending-section" class="py-4">
            <div class="container">
                <div class="blog-bx mb-2 text-center">
                    <?php if (get_theme_mod('perfume_store_trending_title') != "") { ?>
                        <h2 class="trending-title pb-3 text-capitalize"><?php echo esc_html(get_theme_mod('perfume_store_trending_title')); ?></h2>
                    <?php } ?>
                </div>
                <div class="row">
                    <?php if (class_exists('woocommerce')) {
                        $perfume_store_selected_category = get_theme_mod('perfume_store_hot_products_cat');
                        
                        if ($perfume_store_selected_category && $perfume_store_selected_category !== 'select') {
                            $perfume_store_args = array(
                                'post_type' => 'product',
                                'product_cat' => $perfume_store_selected_category,
                                'order' => 'ASC',
                                'posts_per_page' => 4,
                            );
                            $perfume_store_loop = new WP_Query($perfume_store_args);
                            if ($perfume_store_loop->have_posts()) {
                                while ($perfume_store_loop->have_posts()) : $perfume_store_loop->the_post(); 
                                    global $product;
                                    $perfume_store_product_categories = wp_get_post_terms($product->get_id(), 'product_cat');
                                    if (!empty($perfume_store_product_categories) && !is_wp_error($perfume_store_product_categories)) {
                                        $perfume_store_product_category = $perfume_store_product_categories[0];
                                    }
                                    $perfume_store_regular_price = $product->get_regular_price();
                                    $perfume_store_sale_price = $product->get_sale_price();
                                    $perfume_store_percentage_discount = 0;

                                    if ($perfume_store_regular_price && $perfume_store_sale_price) {
                                        $perfume_store_percentage_discount = -1 * round( ( ($perfume_store_regular_price - $perfume_store_sale_price) / $perfume_store_regular_price ) * 100 ); 
                                    }
                                ?>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                                    <div class="product-content">
                                        <div class="product-image position-relative">
                                            <?php
                                            if (has_post_thumbnail($perfume_store_loop->post->ID)) {
                                                the_post_thumbnail($perfume_store_loop->post->ID, 'shop_catalog');
                                            } else {
                                                echo '<img src="' . esc_url(wc_placeholder_img_src()) . '" alt="' . esc_attr__('product-image', 'perfume-store') . '" />';
                                            }
                                            ?>
                                            <div class="img-overlay position-absolute"></div>
                                            <?php if($perfume_store_percentage_discount != 0) { ?>
                                                <div class="discount-badge"><?php echo $perfume_store_percentage_discount; ?>%</div>
                                            <?php } ?>
                                            <div class="addcart">
                                                <?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_add_to_cart( $perfume_store_loop->post, $product ); } ?>
                                            </div>
                                            <?php if (class_exists('YITH_WCWL')): ?>
                                                <div class="wishlist-box">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-detail text-center">
                                            <h3 class="my-2 text-capitalize product-heading">
                                                <a href="<?php echo esc_url(get_permalink($perfume_store_loop->post->ID)); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <?php if( $product->is_type( 'simple' ) ){ ?>
                                                <div class="rating">
                                                    <?php woocommerce_template_loop_rating( $perfume_store_loop->post, $product ); ?>
                                                </div>
                                            <?php } ?>
                                            <div class="price my-2">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; 
                                wp_reset_postdata();
                            }
                        }
                    } ?>
                </div>
            </div>
        </section>
    <?php } ?>
</div>
<?php get_footer(); ?>