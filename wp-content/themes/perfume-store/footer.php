<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Candles Store
 */
?>
<div id="footer">
  <?php 
    $candles_store_footer_widget_enabled = get_theme_mod('candles_store_footer_widget', true);
    if ($candles_store_footer_widget_enabled !== false && $candles_store_footer_widget_enabled !== '') { ?>
    <?php 
        $candles_store_widget_areas = get_theme_mod('candles_store_footer_widget_areas', '4');
        if ($candles_store_widget_areas == '3') {
            $candles_store_cols = 'col-lg-4 col-md-6';
        } elseif ($candles_store_widget_areas == '4') {
            $candles_store_cols = 'col-lg-3 col-md-6';
        } elseif ($candles_store_widget_areas == '2') {
            $candles_store_cols = 'col-lg-6 col-md-6';
        } else {
            $candles_store_cols = 'col-lg-12 col-md-12';
        }
    ?>
    <div class="footer-widget">
        <div class="container">
          <div class="row">
            <!-- Footer 1 -->
            <div class="<?php echo esc_attr($candles_store_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <aside id="categories" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'candles-store'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Shop by Category', 'candles-store'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 2 -->
            <div class="<?php echo esc_attr($candles_store_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <aside id="archives" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer2', 'candles-store'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Collections', 'candles-store'); ?></h3>
                        <ul>
                            <?php wp_get_archives(array('type' => 'monthly')); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 3 -->
            <div class="<?php echo esc_attr($candles_store_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <aside id="meta" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer3', 'candles-store'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Customer Care', 'candles-store'); ?></h3>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url('/about-us') ); ?>"><?php esc_html_e('About Us', 'candles-store'); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url('/contact') ); ?>"><?php esc_html_e('Contact', 'candles-store'); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url('/faq') ); ?>"><?php esc_html_e('FAQs', 'candles-store'); ?></a></li>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 4 -->
            <div class="<?php echo esc_attr($candles_store_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php else : ?>
                    <aside id="newsletter-widget" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer4', 'candles-store'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Stay Lit ✨', 'candles-store'); ?></h3>
                        <p><?php esc_html_e('Subscribe to get special offers, free giveaways, and updates on new candle collections.', 'candles-store'); ?></p>
                        <?php the_widget('WP_Widget_Search'); ?>
                    </aside>
                <?php endif; ?>
            </div>
          </div>
        </div>
    </div>

    <?php } ?>
    <div class="clear"></div>
    <div class="copywrap text-center">
        <?php $candles_store_social_links_present = get_theme_mod('candles_store_footer_facebook_link') || get_theme_mod('candles_store_footer_instagram_link') || get_theme_mod('candles_store_footer_pinterest_link') || get_theme_mod('candles_store_footer_twitter_link') || get_theme_mod('candles_store_footer_youtube_link'); ?>
        <div class="container copywrap-info <?php echo $candles_store_social_links_present ? '' : 'center-content'; ?>">
            <p>
                <a href="<?php 
                $candles_store_copyright_link = get_theme_mod('candles_store_copyright_link', '');
                if (empty($candles_store_copyright_link)) {
                    echo esc_url('https://www.yoursite.com');
                } else {
                    echo esc_url($candles_store_copyright_link);
                } ?>" target="_blank">
                <?php echo esc_html(get_theme_mod('candles_store_copyright_line', __('Candles Store WordPress Theme', 'candles-store'))); ?>
                </a> 
                <?php echo esc_html('By Your Company', 'candles-store'); ?>
            </p>
            <?php if ( $candles_store_social_links_present ) { ?>
                <div class="footer-social d-flex gap-3">
                    <?php if ( get_theme_mod('candles_store_footer_facebook_link') ) { ?>
                        <a title="<?php echo esc_attr('facebook', 'candles-store'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('candles_store_footer_facebook_link')); ?>"><i class="fa-brands fa-facebook-f"></i></a> 
                    <?php } ?>
                    <?php if ( get_theme_mod('candles_store_footer_instagram_link') ) { ?> 
                        <a title="<?php echo esc_attr('instagram', 'candles-store'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('candles_store_footer_instagram_link')); ?>"><i class="fa-brands fa-instagram"></i></a>
                    <?php } ?>
                    <?php if ( get_theme_mod('candles_store_footer_pinterest_link') ) { ?>
                        <a title="<?php echo esc_attr('pinterest', 'candles-store'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('candles_store_footer_pinterest_link')); ?>"><i class="fa-brands fa-pinterest"></i></a>
                    <?php } ?>
                    <?php if ( get_theme_mod('candles_store_footer_twitter_link') ) { ?> 
                        <a title="<?php echo esc_attr('twitter', 'candles-store'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('candles_store_footer_twitter_link')); ?>"><i class="fa-brands fa-twitter"></i></a>
                    <?php } ?>
                    <?php if ( get_theme_mod('candles_store_footer_youtube_link') ) { ?>
                        <a title="<?php echo esc_attr('youtube', 'candles-store'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('candles_store_footer_youtube_link')); ?>"><i class="fa-brands fa-youtube"></i></a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php if(get_theme_mod('candles_store_scroll_hide',true)){ ?>
    <a id="button"><?php echo esc_html( get_theme_mod('candles_store_scroll_text',__('BACK TO TOP ↑', 'candles-store' )) ); ?></a>
<?php } ?>
  
<?php wp_footer(); ?>
</body>
</html>
