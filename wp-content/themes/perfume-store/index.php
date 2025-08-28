<?php
/**
 * Template for displaying the Home Page
 *
 * Custom Candle Shop Landing Page
 *
 * @package Candles Store
 */

get_header();
?>

<!-- Hero Banner -->
<section class="hero-banner text-center py-5 bg-light">
    <div class="container">
        <div class="hero-content mb-4">
            <h1 class="site-title"><?php bloginfo('name'); ?></h1>
            <p class="tagline"><?php bloginfo('description'); ?></p>
        </div>
        <div class="hero-image">
            <img src="<?php echo get_theme_mod('candles_store_hero_image', get_template_directory_uri() . '/assets/images/hero-candle.jpg'); ?>" alt="<?php bloginfo('name'); ?>" class="img-fluid rounded shadow">
        </div>
    </div>
</section>

<!-- Best Sellers -->
<section class="best-sellers py-5 text-center">
    <div class="container">
        <h2 class="mb-3"><?php esc_html_e('Best Sellers', 'candles-store'); ?></h2>
        <p class="subtitle"><?php esc_html_e('Illuminate Your World with Luxury Scents', 'candles-store'); ?></p>
        <p class="tagline mb-5"><?php esc_html_e('Every fragrance is a memory waiting to be relived ✨', 'candles-store'); ?></p>
        
        <div class="row">
            <?php
            // Example static collections – you can turn this into WooCommerce products later
            $collections = [
                ['title' => 'Luxury Collection', 'img' => get_template_directory_uri().'/assets/images/luxury-candle.jpg'],
                ['title' => 'Desert Collection', 'img' => get_template_directory_uri().'/assets/images/desert-candle.jpg'],
                ['title' => 'Bouquet Collection', 'img' => get_template_directory_uri().'/assets/images/bouquet-candle.jpg'],
                ['title' => 'Gift Collection', 'img' => get_template_directory_uri().'/assets/images/gift-candle.jpg'],
            ];
            foreach ($collections as $collection) : ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="collection-box p-3 border rounded shadow-sm h-100">
                        <img src="<?php echo esc_url($collection['img']); ?>" alt="<?php echo esc_attr($collection['title']); ?>" class="img-fluid rounded mb-3">
                        <h4 class="collection-title"><?php echo esc_html($collection['title']); ?></h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Custom Order -->
<section class="custom-order py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-3"><?php esc_html_e('Custom Order', 'candles-store'); ?></h2>
        <p class="mb-5"><?php esc_html_e('Customize your events with beautifully crafted, layered candles tailored to your favorite scents and personal style. Perfect for weddings, baby showers, corporate gifts, and more.', 'candles-store'); ?></p>
        
        <div class="row">
            <?php
            $custom_imgs = [
                '/assets/images/custom1.jpg',
                '/assets/images/custom2.jpg',
                '/assets/images/custom3.jpg',
                '/assets/images/custom4.jpg',
            ];
            foreach ($custom_imgs as $img) : ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <img src="<?php echo get_template_directory_uri() . $img; ?>" alt="Custom Candle" class="img-fluid rounded shadow">
                </div>
            <?php endforeach; ?>
        </div>
        <a href="<?php echo esc_url(home_url('/shop')); ?>" class="btn btn-primary mt-3 px-4 py-2">
            <?php esc_html_e('Order Now', 'candles-store'); ?>
        </a>
    </div>
</section>

<!-- Collections -->
<section class="collections py-5 text-center">
    <div class="container">
        <h2 class="mb-4"><?php esc_html_e('Our Collections', 'candles-store'); ?></h2>
        <div class="row">
            <?php
            $more_collections = [
                ['title' => 'Scented Jars', 'img' => get_template_directory_uri().'/assets/images/jar-candle.jpg'],
                ['title' => 'Decor Candles', 'img' => get_template_directory_uri().'/assets/images/decor-candle.jpg'],
                ['title' => 'Mini Candles', 'img' => get_template_directory_uri().'/assets/images/mini-candle.jpg'],
                ['title' => 'Event Candles', 'img' => get_template_directory_uri().'/assets/images/event-candle.jpg'],
            ];
            foreach ($more_collections as $collection) : ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="collection-card p-3 border rounded shadow-sm h-100">
                        <img src="<?php echo esc_url($collection['img']); ?>" alt="<?php echo esc_attr($collection['title']); ?>" class="img-fluid rounded mb-3">
                        <h4><?php echo esc_html($collection['title']); ?></h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
