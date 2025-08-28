<div class="theme-offer">
   <?php
     // POST and update the customizer and other related data of Perfume Store
    if ( isset( $_POST['submit'] ) ) {

        // Check if woocommerce is installed and activated
        if (!is_plugin_active('woocommerce/woocommerce.php')) {
            // Install the plugin if it doesn't exist
            $perfume_store_plugin_slug = 'woocommerce';
            $perfume_store_plugin_file = 'woocommerce/woocommerce.php';

            // Check if plugin is installed
            $perfume_store_installed_plugins = get_plugins();
            if (!isset($perfume_store_installed_plugins[$perfume_store_plugin_file])) {
                include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
                include_once(ABSPATH . 'wp-admin/includes/file.php');
                include_once(ABSPATH . 'wp-admin/includes/misc.php');
                include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

                // Install the plugin
                $perfume_store_upgrader = new Plugin_Upgrader();
                $perfume_store_upgrader->install('https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip');
            }
            // Activate the plugin
            activate_plugin($perfume_store_plugin_file);
        }

        // Check if Classic Blog Grid plugin is installed
        if (!is_plugin_active('classic-blog-grid/classic-blog-grid.php')) {
            // Plugin slug and file path for Classic Blog Grid
            $perfume_store_plugin_slug = 'classic-blog-grid';
            $perfume_store_plugin_file = 'classic-blog-grid/classic-blog-grid.php';
        
            // Check if Classic Blog Grid is installed and activated
            if ( ! is_plugin_active( $perfume_store_plugin_file ) ) {
        
                // Check if Classic Blog Grid is installed
                $perfume_store_installed_plugins = get_plugins();
                if ( ! isset( $perfume_store_installed_plugins[ $perfume_store_plugin_file ] ) ) {
        
                    // Include necessary files to install plugins
                    include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
                    include_once( ABSPATH . 'wp-admin/includes/file.php' );
                    include_once( ABSPATH . 'wp-admin/includes/misc.php' );
                    include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
        
                    // Download and install Classic Blog Grid
                    $perfume_store_upgrader = new Plugin_Upgrader();
                    $perfume_store_upgrader->install( 'https://downloads.wordpress.org/plugin/classic-blog-grid.latest-stable.zip' );
                }
        
                // Activate the Classic Blog Grid plugin after installation (if needed)
                activate_plugin( $perfume_store_plugin_file );
            }
        }

        // ------- Create Main Menu --------
        $perfume_store_menuname = 'Primary Menu';
        $perfume_store_bpmenulocation = 'primary';
        $perfume_store_menu_exists = wp_get_nav_menu_object( $perfume_store_menuname );
    
        if (!$perfume_store_menu_exists) {
            // Create a new menu
            $perfume_store_menu_id = wp_create_nav_menu($perfume_store_menuname);

            // Define pages to be created
            $perfume_store_pages = array(
                'home' => array(
                    'title' => 'Home',
                    'template' => '/templates/template-home-page.php'
                ),
                'about-us' => array(
                    'title' => 'About Us',
                    'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'
                ),
                'categories' => array(
                    'title' => 'Categories',
                    'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'
                ),
                'shop' => array(
                    'title' => 'Shop',
                    'content' => '[products]' // Shortcode for products
                ),
                'blog' => array(
                    'title' => 'Blog',
                    'content' => ''
                ),
                'contact-us' => array(
                    'title' => 'Contact Us',
                    'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'
                ),
            );

            $perfume_store_page_ids = array();

            // Loop through the pages and create them if they don’t exist
            foreach ($perfume_store_pages as $perfume_store_slug => $perfume_store_data) {
                $perfume_store_existing_page = get_page_by_path($perfume_store_slug);

                if ($perfume_store_existing_page) {
                    // If the page already exists, use its ID
                    $perfume_store_page_id = $perfume_store_existing_page->ID;
                } else {
                    // Create a new page
                    $perfume_store_page_data = array(
                        'post_type'    => 'page',
                        'post_title'   => $perfume_store_data['title'],
                        'post_content' => isset($perfume_store_data['content']) ? $perfume_store_data['content'] : '',
                        'post_status'  => 'publish',
                        'post_author'  => get_current_user_id(), // Set author dynamically
                        'post_name'    => $perfume_store_slug,
                    );

                    $perfume_store_page_id = wp_insert_post($perfume_store_page_data);

                    // Assign custom page template if specified
                    if (!empty($perfume_store_data['template'])) {
                        update_post_meta($perfume_store_page_id, '_wp_page_template', $perfume_store_data['template']);
                    }
                }

                // Store the page IDs
                $perfume_store_page_ids[$perfume_store_slug] = $perfume_store_page_id;
            }

            // Set homepage and blog page
            update_option('page_for_posts', $perfume_store_page_ids['blog']);
            update_option('page_on_front', $perfume_store_page_ids['home']);
            update_option('show_on_front', 'page');

            // Define menu items
            $perfume_store_menu_items = array(
                'home',
                'about-us',
                'categories',
                'shop',
                'blog',
                'contact-us',
            );

            // Add menu items dynamically
            foreach ($perfume_store_menu_items as $perfume_store_slug) {
                wp_update_nav_menu_item($perfume_store_menu_id, 0, array(
                    'menu-item-title' => esc_html($perfume_store_pages[$perfume_store_slug]['title']),
                    'menu-item-url' => get_permalink($perfume_store_page_ids[$perfume_store_slug]),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $perfume_store_page_ids[$perfume_store_slug],
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type',
                ));
            }

            // Assign menu to theme location
            $perfume_store_locations = get_theme_mod('nav_menu_locations', array());
            $perfume_store_locations[$perfume_store_bpmenulocation] = $perfume_store_menu_id;
            set_theme_mod('nav_menu_locations', $perfume_store_locations);
        }

        //Logo
        set_theme_mod( 'perfume_store_the_custom_logo', esc_url( get_template_directory_uri().'/images/Logo.png'));

        //Header Section
        set_theme_mod( 'perfume_store_topbar_text_title', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.');
        set_theme_mod( 'perfume_store_topbar_mail_title', 'Email');
        set_theme_mod( 'perfume_store_email_address', 'xyz123@example.com');
        set_theme_mod( 'perfume_store_topbar_phone_title', 'Contact Us');
        set_theme_mod( 'perfume_store_phone_number', '+123456789');
        set_theme_mod( 'perfume_store_facebook_link', '#');
        set_theme_mod( 'perfume_store_twitter_link', '#');
        set_theme_mod( 'perfume_store_instagram_link', '#');
        set_theme_mod( 'perfume_store_youtube_link', '#');

        //Banner Section
        set_theme_mod( 'perfume_store_banner', true);
        set_theme_mod( 'perfume_store_banner_small_title', 'What Are We?');
        set_theme_mod( 'perfume_store_button_text', 'Browse More');

        // Create a single page 
        $perfume_store_banner_title = 'Fall In Love With Amazing Aromas';
        $perfume_store_banner_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.';

        $perfume_store_post = array(
            'post_title'    => wp_strip_all_tags($perfume_store_banner_title),
            'post_content'  => $perfume_store_banner_content,
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );

        // Insert the post into the database
        $perfume_store_post_id = wp_insert_post($perfume_store_post);

        // If the post was successfully created
        if ($perfume_store_post_id && !is_wp_error($perfume_store_post_id)) {
            // Set the theme mod for the single banner page
            set_theme_mod('perfume_store_banner_pageboxes', $perfume_store_post_id);

            // Set the featured image for the post
            $perfume_store_image_url = get_template_directory_uri() . '/images/banner.png';
            
            // Use media_sideload_image to upload and set the image
            $perfume_store_image_id = media_sideload_image($perfume_store_image_url, $perfume_store_post_id, null, 'id');

            // Check if the image was successfully uploaded and set
            if (!is_wp_error($perfume_store_image_id)) {
                // Set the image as the post's featured image
                set_post_thumbnail($perfume_store_post_id, $perfume_store_image_id);
            } else {
                // Log or handle the error
                error_log("Error setting the featured image: " . $perfume_store_image_id->get_error_message());
            }

            // Set the single created page as the default page for the banner
            set_theme_mod('perfume_store_selected_banner_page', $perfume_store_post_id);

        } else {
            // Log or handle the error if the page creation failed
            error_log("Error creating the page: " . $perfume_store_post_id->get_error_message());
        }

        //Projects Section
        set_theme_mod('perfume_store_disabled_trending_section', true);
        set_theme_mod( 'perfume_store_trending_title', 'Trending Products');

        // Set the theme mod for the product category
        set_theme_mod('perfume_store_hot_products_cat', 'productcategory1');

        // Define the single product category name, product titles, and tags
        $perfume_store_category_name = 'productcategory1';
        $perfume_store_titles = array(
            "HD Skin Matte Liquid Foundation",
            "Day And Night Moisturizer Cream",
            "Healthy Spa Concept Body Cream",
            "Beauty Aromatic Handmade Soap"
        );
        
        // Define regular prices for specific products and discounts
        $perfume_store_regular_prices = array(120.00, 150.00, 150.00, 100.00); // First product: 120, Fourth product: 100
        $discounts = array(-35, -10, -10, -10); // Discounts in percentage
        
        // Create or retrieve the product category term ID
        $perfume_store_term = term_exists($perfume_store_category_name, 'product_cat');
        if (!$perfume_store_term) {
            $perfume_store_term = wp_insert_term($perfume_store_category_name, 'product_cat');
        }
        
        if (is_wp_error($perfume_store_term)) {
            error_log('Error creating category: ' . $perfume_store_term->get_error_message());
            return; // Exit if category creation fails
        }
        
        $perfume_store_term_id = is_array($perfume_store_term) ? $perfume_store_term['term_id'] : $perfume_store_term;
        
        // Loop to create 4 products for the category
        foreach ($perfume_store_titles as $perfume_store_index => $perfume_store_title) {
            // Use specific regular price for each product
            $perfume_store_regular_price = $perfume_store_regular_prices[$perfume_store_index];
        
            // Calculate sale price based on discount
            $perfume_store_sale_price = $perfume_store_regular_price + ($perfume_store_regular_price * $discounts[$perfume_store_index] / 100);
        
            // Create product content
            $perfume_store_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
        
            // Create product post object
            $perfume_store_post_id = wp_insert_post(array(
                'post_title'    => wp_strip_all_tags($perfume_store_title),
                'post_content'  => $perfume_store_content,
                'post_status'   => 'publish',
                'post_type'     => 'product', // Post type set to 'product'
            ));
        
            if (is_wp_error($perfume_store_post_id)) {
                error_log('Error creating product: ' . $perfume_store_post_id->get_error_message());
                continue; // Skip to the next product if creation fails
            }
        
            // Assign the category to the product
            wp_set_object_terms($perfume_store_post_id, $perfume_store_term_id, 'product_cat');
        
            // Set product prices
            update_post_meta($perfume_store_post_id, '_regular_price', $perfume_store_regular_price);
            update_post_meta($perfume_store_post_id, '_sale_price', $perfume_store_sale_price);
            update_post_meta($perfume_store_post_id, '_price', $perfume_store_sale_price); // Current price is the sale price
        
            // Handle the featured image using media_sideload_image
            $perfume_store_image_url = get_template_directory_uri() . '/images/Product' . ($perfume_store_index + 1) . '.png';
            $perfume_store_image_id = media_sideload_image($perfume_store_image_url, $perfume_store_post_id, null, 'id');
        
            if (!is_wp_error($perfume_store_image_id)) {
                // Assign featured image to product
                set_post_thumbnail($perfume_store_post_id, $perfume_store_image_id);
            } else {
                error_log('Error downloading image for product: ' . $perfume_store_image_id->get_error_message());
            }
        } 

        // Show success message and the "View Site" button
         echo '<div class="success">Demo Import Successful</div>';
    }
     ?>
    <ul>
        <li>
        <hr>
        <?php 
        // Check if the form is submitted
        if ( !isset( $_POST['submit'] ) ) : ?>
           <!-- Show demo importer form only if it's not submitted -->
           <?php echo esc_html( 'Click on the below content to get demo content installed.', 'perfume-store' ); ?>
          <br>
          <small><b><?php echo esc_html('Please take a backup if your website is already live with data. This importer will overwrite existing data.', 'perfume-store' ); ?></b></small>
          <br><br>

          <form id="demo-importer-form" action="" method="POST" onsubmit="return confirm('Do you really want to do this?');">
            <input type="submit" name="submit" value="<?php echo esc_attr('Run Importer','perfume-store'); ?>" class="button button-primary button-large">
          </form>
        <?php 
        endif; 

        // Show "View Site" button after form submission
        if ( isset( $_POST['submit'] ) ) {
        echo '<div class="view-site-btn">';
        echo '<a href="' . esc_url(home_url()) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">View Site</a>';
        echo '</div>';
        }
        ?>

        <hr>
        </li>
    </ul>
 </div>