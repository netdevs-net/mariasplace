<?php
/**
 * WP Bootstrap Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Bootstrap_Starter
 */
if (function_exists('header_remove')) {
    header_remove('X-Powered-By'); // PHP 5.3+
    @ini_set('expose_php', 'off');
} else {
    @ini_set('expose_php', 'off');
}
if (!function_exists('wp_bootstrap_starter_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function wp_bootstrap_starter_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on WP Bootstrap Starter, use a find and replace
         * to change 'MariasPlace' to the name of your theme in all the template files.
         */
        load_theme_textdomain('MariasPlace', get_template_directory() . '/languages');
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_theme_support('post-formats', array('standard', 'video', 'gallery'));
        set_post_thumbnail_size(600, 450, true);
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'MariasPlace'),
        ));
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'caption',
        ));
        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('wp_bootstrap_starter_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        function wp_boostrap_starter_add_editor_styles() {
            add_editor_style('custom-editor-style.css');
        }
        add_action('admin_init', 'wp_boostrap_starter_add_editor_styles');
    }
endif;
add_action('after_setup_theme', 'wp_bootstrap_starter_setup');
/**
 * Add Welcome message to dashboard
 */
function wp_bootstrap_starter_reminder() {
    $theme_page_url = 'https://wpsuperheroes.com';
    if (!get_option('triggered_welcomet')) {
        $message = sprintf(
                __('Welcome to WP Bootstrap Starter Theme! Before diving in to your new theme, please visit the <a style="color: #fff; font-weight: bold;" href="%1$s" target="_blank">theme\'s</a> page for access to dozens of tips and in-depth tutorials.', 'MariasPlace'), esc_url($theme_page_url)
        );
        printf(
                '<div class="notice is-dismissible" style="background-color: #6C2EB9; color: #fff; border-left: none;">
                        <p>%1$s</p>
                    </div>', $message
        );
        add_option('triggered_welcomet', '1', '', 'yes');
    }
}
add_action('admin_notices', 'wp_bootstrap_starter_reminder');
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_bootstrap_starter_content_width() {
    $GLOBALS['content_width'] = apply_filters('wp_bootstrap_starter_content_width', 1170);
}
add_action('after_setup_theme', 'wp_bootstrap_starter_content_width', 0);
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_starter_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'MariasPlace'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'MariasPlace'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Promotional Area', 'MariasPlace'),
        'id' => 'footer-promotion',
        'description' => esc_html__('Add widgets here.', 'MariasPlace'),
        'before_widget' => '<div class="grid-item"><div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="widget-title d-none">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'MariasPlace'),
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'MariasPlace'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'MariasPlace'),
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'MariasPlace'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'MariasPlace'),
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here.', 'MariasPlace'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'wp_bootstrap_starter_widgets_init');
/**
 * Enqueue scripts and styles.
 */
function wp_bootstrap_starter_scripts() {
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css' );
    wp_enqueue_style('MariasPlace-fontawesome-cdn', get_template_directory_uri() . '/inc/assets/css/fontawesome.css');
    wp_enqueue_style('MariasPlace-style', get_stylesheet_uri());
    wp_enqueue_script('jquery');
    wp_enqueue_script('html5hiv', get_template_directory_uri() . '/inc/assets/js/html5.js', array(), '3.7.0', false);
    wp_script_add_data('html5hiv', 'conditional', 'lt IE 9');
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js' );
    wp_enqueue_script( 'bootstrap-popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js' );
    wp_enqueue_script('MariasPlace-themejs', get_template_directory_uri() . '/inc/assets/js/theme-script.js', array(), '', true);
    wp_enqueue_script('MariasPlace-skip-link-focus-fix', get_template_directory_uri() . '/inc/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true);
    wp_localize_script('MariasPlace-themejs', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wp_bootstrap_starter_scripts');
function wp_bootstrap_starter_preload($hints, $relation_type) {
    if ('preconnect' === $relation_type && get_theme_mod('cdn_assets_setting') === 'yes') {
        $hints[] = [
            'href' => 'https://cdn.jsdelivr.net/',
            'crossorigin' => 'anonymous',
        ];
        $hints[] = [
            'href' => 'https://use.fontawesome.com/',
            'crossorigin' => 'anonymous',
        ];
    }
    return $hints;
}
function wp_bootstrap_starter_password_form() {
    global $post;
    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $o = '<form action="' . esc_url(home_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
    <div class="d-block mb-3">' . __("To view this protected post, enter the password below:", "MariasPlace") . '</div>
    <div class="form-group form-inline"><label for="' . $label . '" class="mr-2">' . __("Password:", "MariasPlace") . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> <input type="submit" name="Submit" value="' . esc_attr__("Submit", "MariasPlace") . '" class="btn btn-primary"/></div>
    </form>';
    return $o;
}
add_filter('the_password_form', 'wp_bootstrap_starter_password_form');
/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';
/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load plugin compatibility file.
 */
require get_template_directory() . '/inc/plugin-compatibility/plugin-compatibility.php';
/**
 * Load custom WordPress nav walker.
 */
if (!class_exists('wp_bootstrap_navwalker')) {
    require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
}
/**
 * Implement the Custom Team feature.
 */
require get_template_directory() . '/inc/addons/team.php';
/**
 * Implement the Custom Woocommerce feature.
 */
require get_template_directory() . '/inc/woocommerce-functions.php';

function recent_posts_loacked($atts) {
    global $paged;
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $atts = shortcode_atts(
            array(
                'items' => 6,
                'type' => 'free',
                'pagination' => 'yes',
            ), $atts
    );
    if ($atts['type'] == 'paid') {
        $type = 0;
    } elseif ($atts['type'] == 'free') {
        $type = 1;
    } else {
        $type = 1;
    }
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $atts['items'],
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'free_content',
                'value' => $type
            )
        )
    );
    $wpex_query = new WP_Query($args);
    if ($wpex_query->have_posts()) {
        $html = '<div class="other_craft_div archive py-3"><div class="grid-container grid-3">';
        while ($wpex_query->have_posts()) {
            $wpex_query->the_post();
            ob_start();
            get_template_part('template-parts/content', 'loop');
            $html .= ob_get_contents();
            ob_end_clean();
        }
        $html .= '</div></div>';
        if ($atts['pagination'] == 'yes' || $atts['pagination'] == 'Yes' || $atts['pagination'] == 'YES') {
            $html .= themes_pagination($wpex_query->max_num_pages);
        }
    }

    return $html;
}

add_shortcode('recent_posts', 'recent_posts_loacked');
function parent_category($atts) {
    $atts = shortcode_atts(
            array(
                'id' => 0,
                'items' => 3,
            ), $atts
    );
    $html = '';
    $categories = get_categories(array($atts['id']));
    $item = '';
    foreach ($categories as $category) {
        $term_id = $category->term_id;
        $InputCat = $atts['id'];
        if ($term_id == $InputCat) :
            $args = array(
                'type' => 'post',
                'child_of' => $term_id,
                'hide_empty' => FALSE,
                'hierarchical' => 1,
                'taxonomy' => 'category',
            );
            $subcategories = get_categories($args);
            foreach ($subcategories as $subcategory) {
                if ($subcategory->category_parent == $term_id) {
                    if (z_taxonomy_image_url($subcategory->cat_ID)) {
                        $feature_img_url = '<img width="600" height="450" src="' . z_taxonomy_image_url($subcategory->cat_ID) . '" class="attachment-large size-large wp-post-image" alt="' . $subcategory->cat_name . '">';
                    } else {
                        $feature_img_url = '<img width="600" height="450" src="' . get_template_directory_uri() . '/inc/assets/images/default-feature.png' . '" class="attachment-large size-large wp-post-image" alt="' . $subcategory->cat_name . '">';
                    }
                    $post_image = '<div class="post-thumbnail"><a href="' . get_category_link($subcategory->cat_ID) . '" rel="bookmark">' . $feature_img_url . '</a></div>';
                    $post_content = '<div class="post-item-content ' . $subcategory->cat_ID . '"><a class="post-item-title" href="' . get_category_link($subcategory->cat_ID) . '" rel="bookmark">' . $subcategory->cat_name . '</a><p class="post-item-
                    ">' . wp_trim_words($subcategory->category_description, 15, '') . '</p></div>';
                    $item .= '<div class="grid-item">';
                    $item .= '<div class="post-item h-100">';
                    $item .= '<div class="post-item-body">';
                    $item .= $post_image;
                    $item .= $post_content;
                    $item .= '</div>';
                    $item .= '</div>';
                    $item .= '</div>';
                }
                ?>
                <?php
            }
        endif;
    }
    $html .= '<div id="category-id-' . $term_id . '" class="grid-container grid-3 archive">';
    $html .= $item;
    $html .= '</div>';
    return $html;
}
add_shortcode('category', 'parent_category');
/**
 * Check if given term has child terms
 *
 * @param Integer $term_id
 * @param String $taxonomy
 *
 * @return Boolean
 */
function category_has_children($term_id = 0, $taxonomy = 'category') {
    $children = get_categories(array(
        'parent' => $term_id,
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'fields' => 'ids',
        'depth'  => 1
    ));
    $item = '';
    if (!empty($children)) {

        foreach ($children as $subcategory) {
            $cat_Item = get_category($subcategory);
            $cat_ID = $cat_Item->cat_ID;
            $cat_name = $cat_Item->cat_name;
            $category_description = $cat_Item->category_description;
//            pre(get_category($subcategory));
            if (z_taxonomy_image_url($cat_ID)) {
                $feature_img_url = '<img width="600" height="450" src="' . z_taxonomy_image_url($cat_ID) . '" class="attachment-large size-large wp-post-image" alt="' . $cat_name . '">';
            } else {
                $feature_img_url = '<img width="600" height="450" src="' . get_template_directory_uri() . '/inc/assets/images/default-feature.png' . '" class="attachment-large size-large wp-post-image" alt="' . $cat_name . '">';
            }
            $post_image = '<div class="post-thumbnail"><a href="' . get_category_link($cat_ID) . '" rel="bookmark">' . $feature_img_url . '</a></div>';
            $post_content = '<div class="post-item-content ' . $cat_ID . '"><a class="post-item-title" href="' . get_category_link($cat_ID) . '" rel="bookmark">' . $cat_name . '</a><p class="post-item-text">' . wp_trim_words($category_description, 15, '') . '</p></div>';
            $item .= '<div class="grid-item">';
            $item .= '<div class="post-item h-100">';
            $item .= '<div class="post-item-body">';
            $item .= $post_image;
            $item .= $post_content;
            $item .= '</div>';
            $item .= '</div>';
            $item .= '</div>';
            ?>
            <?php
        }
    }

    return $item;
}

/* Testimonials Slider Used for Reviews 
 *  USE:  [testimonials_slider category="review" arrow="yes" dots="yes" items="3"]
 */

function testimonials_slider($atts) {
    // Attributes
    $atts = shortcode_atts(
            array(
                'category' => '',
                'quotes' => '',
                'arrow' => '',
                'dots' => '',
                'items' => '3',
            ), $atts
    );
    // WP_Query arguments
    $args = array(
        'post_type' => array('testimonial'),
        'order' => 'ASC',
        'posts_per_page' => $atts['items'],
        'orderby' => 'date',
    );
    if (!empty($atts['quotes'])) {
        $Quotes = ' no-quotes';
    } else {
        $Quotes = '';
    }
    if (!empty($atts['category'])) {
        $tax_query = array(
            array(
                'taxonomy' => 'testimonial-category',
                'field' => 'slug',
                'terms' => $atts['category']
            )
        );
        $args['tax_query'] = $tax_query;
    }
    $testimonial_query = new WP_Query($args);
    $html = '';
    // The Loop
    if ($testimonial_query->have_posts()) {
        $html .= '<div id="testimonialsSlider" class="carousel slide' . $Quotes . '"  data-bs-ride="carousel"><div class="carousel-inner">';
        $index = 0;
        $indicators = '<ul class="carousel-indicators">';
        for ($i = 0; $i < count($testimonial_query->posts); $i++) {
            if ($i == 0) {
                $current_item = ' active';
            } else {
                $current_item = '';
            }
            $indicators .= '<li data-bs-target="#testimonialsSlider" data-bs-slide-to="' . $i . '" class="' . $current_item . '" aria-current="true" aria-label="Slide ' . $i . ' "></li>';
        }
        $indicators .= '</ul>';

        $arrow = '<div class="carousel-controls"><span class="carousel-control-prev" data-bs-target="#testimonialsSlider" data-bs-slide="prev">
              <i class="fa fa-angle-left"></i>
                </span>
              <span class="carousel-control-next" data-bs-target="#testimonialsSlider" data-bs-slide="next">
                  <i class="fa fa-angle-right"></i>
              </span>
              </div>';

        while ($testimonial_query->have_posts()) {
            $testimonial_query->the_post();
            if ($index == 0) {
                $current_item = ' active';
            } else {
                $current_item = '';
            }
            if (has_post_thumbnail()) {
                $feature_image = get_the_post_thumbnail(get_the_id(), 'full', array('sizes' => '(min-width:320px) 20rem, (min-width:768px) 30rem, (min-width:1024px) 100rem'), array('class' => 'img-fluid'));
            } else {
                $feature_image = '<img width="120" height="120" src="' . get_template_directory_uri() . '/inc/assets/images/review-author.jpg' . '" class="attachment-large size-large wp-post-image" alt="flower arrangement">';
            }
            $Name = get_post_meta(get_the_id(), '_testimonial_client');
            $job = get_post_meta(get_the_id(), '_testimonial_job');
            $company = get_post_meta(get_the_id(), '_testimonial_company');
            if (!empty($job[0])) {
                $position = $job[0];
            } else {
                $position = '';
            }
            if (!empty($company[0])) {
                $company = $company[0];
            } else {
                $company = '';
            }
            if (!empty($position) && !empty($company)) {
                $sep = ', ';
            } else {
                $sep = '';
            }
            $content = '<div class="carousel-item' . $current_item . '" interval="5000" >';
            $content .= '<div id="testimonial-' . get_the_id() . '" class="testimonial-item">';
//            $content .= '<div class="testimonial-body mb-3">' . wp_trim_words(get_the_content(), 80, '') . '</div>';
            $content .= '<div class="testimonial-body mb-3">' . get_the_content() . '</div>';
            $content .= '<div class="testimonial-footer font-weight-bold d-flex align-items-center h3 text-left mb-3"><span class="review-author-img d-inline-block mr-3">' . $feature_image . '</span><span class="d-inline-block review-author-meta"> -' . get_the_title() . '<small class="ml-2 d-block font-weight-normal author-position">' . $position . $sep . $company . '</small></span></div>';
            $content .= '</div>';
            $content .= '</div>';
            $html .= $content;
            $index++;
        }

        $html .= '</div>';
        if ($atts['arrow'] == 'yes' || $atts['arrow'] == 'Yes') {
            $html .= $arrow;
        }
        if ($atts['dots'] == 'yes' || $atts['dots'] == 'Yes') {
            $html .= $indicators;
        }

        $html .= '</div>';
    } else {
        // no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();

    return $html;
}

add_shortcode('testimonials_slider', 'testimonials_slider');
/* Pricing Slider Used for Reviews 
 *  USE:  [pricing_slider category="home" arrow="yes" dots="yes" items="3"]
 */

function pricing_slider($atts) {
    // Attributes
    $atts = shortcode_atts(
            array(
                'category' => '',
                'quotes' => '',
                'arrow' => '',
                'dots' => '',
                'items' => '3',
            ), $atts
    );
    // WP_Query arguments
    $args = array(
        'post_type' => array('testimonial'),
        'order' => 'ASC',
        'posts_per_page' => $atts['items'],
        'orderby' => 'date',
    );
    if (!empty($atts['quotes'])) {
        $Quotes = ' no-quotes';
    } else {
        $Quotes = '';
    }
    if (!empty($atts['category'])) {
        $tax_query = array(
            array(
                'taxonomy' => 'testimonial-category',
                'field' => 'slug',
                'terms' => $atts['category']
            )
        );
        $args['tax_query'] = $tax_query;
    }
    $testimonial_query = new WP_Query($args);
    $html = '';
    // The Loop
    if ($testimonial_query->have_posts()) {
        $html .= '<div id="pricingSlider" class="carousel slide' . $Quotes . '" data-interval="false" data-bs-ride="carousel" data-pause="hover" ><div class="carousel-inner">';
        $index = 0;
        $indicators .= '<ul class="carousel-indicators">';
        for ($i = 0; $i < count($testimonial_query->posts); $i++) {
            if ($i == 0) {
                $current_item = ' active';
            } else {
                $current_item = '';
            }
            $indicators .= '<li data-bs-target="#pricingSlider" data-bs-slide-to="' . $i . '" class="' . $current_item . '" aria-current="true" aria-label="Slide ' . $i . ' "></li>';
        }
        $indicators .= '</ul>';

        $arrow = '<div class="carousel-controls"><span class="carousel-control-prev" data-bs-target="#pricingSlider" data-bs-slide="prev">
              <i class="fa fa-angle-left"></i>
                </span>
              <span class="carousel-control-next" data-bs-target="#pricingSlider" data-bs-slide="next">
                  <i class="fa fa-angle-right"></i>
              </span>
              </div>';

        while ($testimonial_query->have_posts()) {
            $testimonial_query->the_post();
            if ($index == 0) {
                $current_item = ' active';
            } else {
                $current_item = '';
            }
//            if (has_post_thumbnail()) {
//                $feature_image = get_the_post_thumbnail(get_the_id(), 'full', array('sizes' => '(min-width:320px) 20rem, (min-width:768px) 30rem, (min-width:1024px) 100rem'), array('class' => 'img-fluid'));
//            } else {
//                $feature_image = '<img width="120" height="120" src="' . get_template_directory_uri() . '/inc/assets/images/review-author.jpg' . '" class="attachment-large size-large wp-post-image" alt="flower arrangement">';
//            }
//            $Name = get_post_meta(get_the_id(), '_testimonial_client');
//            $job = get_post_meta(get_the_id(), '_testimonial_job');
//            $company = get_post_meta(get_the_id(), '_testimonial_company');
//            if (!empty($job[0])) {
//                $position = $job[0];
//            } else {
//                $position = '';
//            }
//            if (!empty($company[0])) {
//                $company = $company[0];
//            } else {
//                $company = '';
//            }
//            if (!empty($position) && !empty($company)) {
//                $sep = ', ';
//            } else {
//                $sep = '';
//            }
            $content = '<div class="carousel-item' . $current_item . '">';
            $content .= '<div id="pricing-' . get_the_id() . '" class="pricing-item">';
//            $content .= '<div class="testimonial-body mb-3">' . wp_trim_words(get_the_content(), 80, '') . '</div>';
            $content .= '<div class="pricing-body mb-3">' . get_the_content() . '</div>';
//            $content .= '<div class="pricing-footer font-weight-bold d-flex align-items-center h3 text-left mb-3"><span class="review-author-img d-inline-block mr-3">' . $feature_image . '</span><span class="d-inline-block review-author-meta"> -' . get_the_title() . '<small class="ml-2 d-block font-weight-normal author-position">' . $position .$sep. $company . '</small></span></div>';
            $content .= '</div>';
            $content .= '</div>';
            $html .= $content;
            $index++;
        }

        $html .= '</div>';
        if ($atts['arrow'] == 'yes' || $atts['arrow'] == 'Yes') {
            $html .= $arrow;
        }
        if ($atts['dots'] == 'yes' || $atts['dots'] == 'Yes') {
            $html .= $indicators;
        }

        $html .= '</div>';
    } else {
        // no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();

    return $html;
}


add_shortcode('pricing_slider', 'pricing_slider');

//Change Link of Return to shop Button
function mp_empty_cart_redirect_url() {
    $url = home_url('/pricing/'); // change this link to your need
    return esc_url($url);
}

add_filter('woocommerce_return_to_shop_redirect', 'mp_empty_cart_redirect_url');

function pre($param) {
    echo '<pre>';
    print_r($param);
    echo '</pre>';
}

function getPostcontentteam() {
    $my_postid = $_POST['post_id'];
    $post = get_post($my_postid);
    $post_thumbnail = get_the_post_thumbnail($my_postid);
    $post_title = get_the_title($my_postid);
    echo $post_content = $post->post_content;
}

add_action('wp_ajax_nopriv_getPostcontentteam', 'getPostcontentteam');
add_action('wp_ajax_getPostcontentteam', 'getPostcontentteam');

/**
 * Grab all img src from a string
 */
function get_iframe_src($input) {
    preg_match_all("/<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i", $input, $output);
    $return = array();
    if (isset($output[1][0])) {
        $return = $output[1];
    }
    return $return;
}

//Start Develop By Amit Kakadiya
function user_login_form($atts) {
    if ($_SERVER['HTTP_REFERER']) {
        $redirect_to = $_SERVER['HTTP_REFERER'];
        $cookie_name = 'pmpro_common_redirect_to';
        $path = parse_url($redirect_to, PHP_URL_PATH);
        if (substr($path, 0, 7) == "/logout") {
            unset($_COOKIE[$cookie_name]);
            $res = setcookie($cookie_name, '', time() - 3600);
        } else {
            //setcookie( "pmpro_login_redirect_to", $redirect_to, time() + 3600, '/' );
        }
    }
    extract(
            shortcode_atts(array(
        'redirect' => ''), $atts)
    );
    if ($redirect != '') {
        $redirect_to = $redirect;
    } else {
        $redirect_to = home_url();
    }
    ob_start();
    ?>
    <div class="user-login-wrapper">
        <form name="loginform" class="loginform loginform_all_page" action="javascript:;" method="post">
            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
            <div class="vc_row social-shortcode">
                <div class="vc_col-md-12">
                    <?php
                    $redirect = get_home_url() . "/welcome-back/";
                    if (is_single() && 'post' == get_post_type()) :
                        $redirect = get_permalink($post = 0, $leavename = false);
                    endif;
                    ?>


                    <?php echo do_shortcode('[nextend_social_login provider="facebook" redirect="' . $redirect . '"]'); ?>
                </div>
            </div>
            <div class="vc_row login-subheader">
                <div class="vc_col-md-12">
                    <p class="text-center vs_login_text my-3 my-sm-4">or login with</p>
                </div>
            </div>
            <div  class="vc_row mb-2 mb-sm-3">
                <div class="vc_col-md-12">
                    <label>Username</label>
                    <input type="text" name="log"  class="input user_login" value="" size="20" required="" placeholder="Username or Email">
                </div>
            </div>
            <div class="vc_row mb-2 mb-sm-3">
                <div class="vc_col-md-12">
                    <label>Password</label>
                    <input type="password" name="pwd" class="input user_pass" value="" size="20" data-com.agilebits.onepassword.user-edited="yes" required="" placeholder="Password">
                </div>
            </div>
            <div class="vc_row">
                <div class="vc_col-md-12 text-center">
                    <div class="user-controls  justify-content-between align-items-center">
                        <a class="lost-password-link ml-auto" href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password">Lost your Password?</a>
                    </div>
                    <input type="submit" name="wp-submit"  class="button button-login mt-3 wp-submit" value="Login">
                    <?php if (is_single() && 'post' == get_post_type()) : ?>
                        <input type="hidden" name="redirect_to" class="redirect_to" value="<?php echo get_permalink($post = 0, $leavename = false); ?>">
                    <?php else : ?>
                        <input type="hidden" name="redirect_to" class="redirect_to" value="/welcome-back/"> 
                    <?php endif; ?>

                    <div class="loginform_status"><p class="status"></p></div>
                </div>
            </div>
            <div class='vc_row'>
                <div class="vc_col-md-12 text-center">
                    <h4 class="vs_have_account">Don't have an account? <a class="button button-signup" href="/registration/?level=26" data-bs-toggle="modal" data-bs-target="#Registeration">Register here</a></h4>
                    <!-- <a class="button button-signup" href="<?php echo home_url(); ?>/pricing">Sign Up</a> -->
                </div>
            </div>
        </form> 
    </div>
    <?php
    $output = ob_get_clean();
    return $output;
}

add_shortcode('loginform', 'user_login_form');

//Start Develop By Amit Kakadiya
function user_login_form_single_page($atts) {
/* 
 * Ryan@wpsuperheroes.com
 * 8/23/2022
 *
*/
    if (isset($_SERVER['HTTP_REFERER'])) {
        $redirect_to = $_SERVER['HTTP_REFERER'];
        $cookie_name = 'pmpro_common_redirect_to';
        $path = parse_url($redirect_to, PHP_URL_PATH);
        if (substr($path, 0, 7) == "/logout") {
            unset($_COOKIE[$cookie_name]);
            $res = setcookie($cookie_name, '', time() - 3600);
        } else {
            //setcookie( "pmpro_login_redirect_to", $redirect_to, time() + 3600, '/' );
        }
    }
    extract(
            shortcode_atts(array(
        'redirect' => ''), $atts)
    );
    if ($redirect != '') {
        $redirect_to = $redirect;
    } else {
        $redirect_to = home_url();
    }
    ob_start();
    ?>
    <div class="user-login-wrapper">
        <form name="loginform" class="loginform loginform_single_page" action="javascript:;" method="post">
            <?php wp_nonce_field('ajax-login-nonce', 'security_single'); ?>
            <div class="vc_row social-shortcode">
                <div class="vc_col-md-12">
                    <?php
                    $redirect = get_home_url() . "/welcome-back/";
                    if (is_single() && 'post' == get_post_type()) :
                        $redirect = get_permalink($post = 0, $leavename = false);
                    endif;
                    ?>
                    <?php echo do_shortcode('[nextend_social_login provider="facebook" redirect="' . $redirect . '"]'); ?>
                </div>
            </div>
            <div class="vc_row login-subheader">
                <div class="vc_col-md-12">
                    <p class="text-center vs_login_text my-3 my-sm-4">or login with</p>
                </div>
            </div>
            <div  class="vc_row mb-2 mb-sm-3">
                <div class="vc_col-md-12">
                    <label>Username</label>
                    <input type="text" name="log"  class="input user_login" value="" size="20" required="" placeholder="Username or Email">
                </div>
            </div>
            <div class="vc_row mb-2 mb-sm-3">
                <div class="vc_col-md-12">
                    <label>Password</label>
                    <input type="password" name="pwd" class="input user_pass" value="" size="20" data-com.agilebits.onepassword.user-edited="yes" required="" placeholder="Password">
                </div>
            </div>
            <div class="vc_row">
                <div class="vc_col-md-12 text-center">
                    <div class="user-controls justify-content-between">
                        <!-- <div class="vs_custom_checkbox">
                            <input name="rememberme" type="checkbox" class="rememberme" value="forever"> 
                            <label>Always remember me </label>
                        </div> -->
                        <a class="lost-password-link ml-auto" href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password">Lost your Password?</a>
                    </div>
                    <input type="submit" name="wp-submit"  class="button button-login mt-3 wp-submit" value="Login">
                    <!--<input type="hidden" name="redirect_to" id="redirect_to" value="<?php echo $redirect_to; ?>">-->
                    <?php if (is_single() && 'post' == get_post_type()) : ?>
                        <input type="hidden" name="redirect_to" class="redirect_to" value="<?php echo get_permalink($post = 0, $leavename = false); ?>">
                    <?php else : ?>
                        <input type="hidden" name="redirect_to" class="redirect_to" value="/welcome-back/"> 
                    <?php endif; ?>
                    <div class="loginform_status"><p class="status"></p></div>
                </div>
            </div>
            <div class='vc_row'>
                <div class="vc_col-md-12 text-center">
                    <h4 class="vs_have_account">Don't have an account? <a class="button button-signup" href="/registration/?level=26" data-bs-toggle="modal" data-bs-target="#Registeration">Register here</a></h4>
                    <!-- <a class="button button-signup" href="<?php echo home_url(); ?>/pricing">Sign Up</a> -->
                </div>
            </div>
        </form> 
    </div>
    <?php
    $output = ob_get_clean();
    return $output;
}

// add_shortcode('loginform_single_page', 'user_login_form_single_page');

// function my_pmpro_default_registration_level($user_id) {
//     //Give all members who register membership level 1
//     pmpro_changeMembershipLevel(26, $user_id);
// }

// add_action('user_register', 'my_pmpro_default_registration_level');

function other_craft_activities($atts) {
    $atts = shortcode_atts(
            array(
                'post_id' => '',
            ), $atts
    );

    $post_id = $atts['post_id'];

    $args = array(
        'posts_per_page' => 3, // How many items to display
        'post__not_in' => array($post_id), // Exclude current post
        'no_found_rows' => true, // We don't ned pagination so this speeds up the query
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'free_content',
            )
        )
    );

    $cats = wp_get_post_terms($post_id, 'category');

    $cats_ids = array();

    foreach ($cats as $wpex_related_cat) {
        $cats_ids[] = $wpex_related_cat->term_id;
    }

    if (!empty($cats_ids)) {
        $args['category__in'] = $cats_ids;
    }


    $wpex_query = new wp_query($args);
    $html = '';
    if ($wpex_query->have_posts()) {
        $html .= '<section class="other-activities archive col-12 px-0 py-5">';
        $html .= '<div class="container">';
        $html .= '<div class="craft_title mb-5"><h3 class="section-main-title text-center">Other ' . $cats[0]->name . '</h3></div>';
        $html .= '<div class="grid-container grid-3">';
        while ($wpex_query->have_posts()) {
            $wpex_query->the_post();
            ob_start();
            get_template_part('template-parts/content', 'loop');
            $html .= ob_get_contents();
            ob_end_clean();
        }
        $html .= '</div>';
        $html .= '<div class="col-12 text-center"><a href="' . get_category_link($cats[0]->term_id) . '" class="btn-more-activity">See more ' . $cats[0]->name . '</a></div>';
        $html .= '</div>';
        $html .= '</section>';
    }
    return $html;
}

add_shortcode('other_craft', 'other_craft_activities');

function related_post_activities($atts) {

    $atts = shortcode_atts(
            array(
                'post_id' => '',
            ), $atts
    );

    $post_id = $atts['post_id'];

    $terms = wp_get_post_tags($post_id);
    $term_array = [];

    foreach ($terms as $term) { // Loop found categories
        $term_array[] = $term->slug;
    }
//pre($term_array);
    $args = array(
        'posts_per_page' => 3,
        'post__not_in' => array($post_id),
        'tag' => implode(",", $term_array),
        'post_type' => 'post',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'free_content',
            )
        )
    );

    $wpex_query = new wp_query($args);
//    pre($wpex_query);
    $html = '';
    if ($wpex_query->have_posts()) {
        $html .= '<section class="related-activities archive col-12 px-0 py-5">';
        $html .= '<div class="container">';
        $html .= '<div class="related-post-title mb-5"><h3 class="section-main-title text-center">Related Posts</h3></div>';
        $html .= '<div class="grid-container grid-3">';
        while ($wpex_query->have_posts()) {
            $wpex_query->the_post();
            ob_start();
            get_template_part('template-parts/content', 'loop');
            $html .= ob_get_contents();
            ob_end_clean();
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</section>';
    }
    return $html;
}

add_shortcode('related_post', 'related_post_activities');
function wp_bootstrap_starter_custom_scripts() {
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/inc/assets/css/custom-style.css');
    if(get_page_template_slug() == "templates/splash-template.php" || is_product()){
        wp_enqueue_style( 'bulmapress-bulma-style', get_template_directory_uri() . '/inc/assets/frontend/bulmapress/css/bulmapress.css' );
        wp_enqueue_style( 'sass-style', get_template_directory_uri() . '/inc/assets/sass/style.css' );
    }
}

add_action('wp_enqueue_scripts', 'wp_bootstrap_starter_custom_scripts');

add_action('woocommerce_after_quantity_input_field', 'ts_quantity_plus_sign');

function ts_quantity_plus_sign() {
    echo '<input class="plus" type="button" value="+">';
}

add_action('woocommerce_before_quantity_input_field', 'ts_quantity_minus_sign');

function ts_quantity_minus_sign() {
    echo '<input class="minus" type="button" value="-">';
}

function woocommerce_if_login_redirection() {
    if (is_user_logged_in() && (is_page('login') || is_page('registration'))) {
        $my_account = get_permalink(get_option('woocommerce_myaccount_page_id'));
        wp_redirect($my_account);
//        wp_redirect('/welcome-back');
    }
}

add_action('wp_head', 'woocommerce_if_login_redirection');
// remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
add_filter('woocommerce_order_button_text', 'misha_custom_button_text');

function misha_custom_button_text($button_text) {
    return 'Place Your Order'; // new text is here 
}

add_action('wp_ajax_nopriv_ajax_login', 'ajax_login');

function ajax_login() {

    // First check the nonce, if it fails the function will break
    check_ajax_referer('ajax-login-nonce', 'security');

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];

    // if ($_POST['remember'] == "forever") {
    //     $info['remember'] = true;
    // } else {
    //     $info['remember'] = false;
    // }

    $user_signon = wp_signon($info, false);
    if (is_wp_error($user_signon)) {
        echo json_encode(array('loggedin' => false, 'message' => __('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin' => true, 'redirect_to' => $_POST['redirect_to'], 'message' => __('Login successful, redirecting...')));
    }

    die();
}

// function free_post($post_id){
//     global $wpdb;
//     $results = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_pmpro_memberships_pages WHERE page_id = %d', $post_id));
//     return $results;
// }
add_action('pre_get_posts', 'free_posts_order');

function free_posts_order($query) {
    if (is_category()) {
//        $query->set('orderby', 'Date');
//        $query->set('order', 'DESC');
        if ($query->is_main_query()) {
            //        $query->set('post_type', 'post');
            $query->set('meta_key', 'free_content');
            $query->set('orderby', array('meta_value_num' => 'DESC', 'date' => 'DESC'));
            //query->set('order', 'DESC');
            $query->set('meta_query', array(
                array(
                    'key' => 'free_content'
                ),
            ));
        }
//      pre($query);      
    }
}

add_filter("wc_stripe_elements_styling", "snippetpress_style_stripe_1");

function snippetpress_style_stripe_1($styles) {
    $styles = array(
        "base" => array(
            "color" => "#495057",
            "fontSize" => "1.25rem",
            "::placeholder" => array(
                "color" => "#CFD7E0",
            ),
        ),
    );
    return $styles;
}

function filter_search($query) {
    if ($query->is_search) {
        $query->set('post_type', array('post'));
        $query->set('orderby', array('meta_value_num' => 'DESC', 'date' => 'DESC'));
        $query->set('meta_query', array(
            array(
                'key' => 'free_content'
            ),
        ));
    };

    return;
}

if (!is_admin()) {
    add_action('pre_get_posts', 'filter_search');
}


add_filter('manage_users_columns', 'rudr_modify_user_table');

function rudr_modify_user_table($columns) {

    // unset( $columns['posts'] ); // maybe you would like to remove default columns
    $columns['registration_date'] = 'Signup Date/Time'; // add new

    return $columns;
}

add_filter('manage_users_custom_column', 'rudr_modify_user_table_row', 10, 3);

function rudr_modify_user_table_row($row_output, $column_id_attr, $user) {

    $date_format = 'j M, Y H:i';

    switch ($column_id_attr) {
        case 'registration_date' :
            return date($date_format, strtotime(get_the_author_meta('registered', $user)));
            break;
        default:
    }

    return $row_output;
}

add_filter('manage_users_sortable_columns', 'rudr_make_registered_column_sortable');

function rudr_make_registered_column_sortable($columns) {
    return wp_parse_args(array('registration_date' => 'registered'), $columns);
}

/**
 * Kim
 * 08-29-22
 * Remove Number of logins in user table
 ** /
// add_filter('manage_users_columns', 'rudr_modify_number_logins_user_table');

// function rudr_modify_number_logins_user_table($columns) {

//     // unset( $columns['posts'] ); // maybe you would like to remove default columns
//     $columns['number_of_logins'] = 'Number of Logins'; // add new

//     return $columns;
// }

// add_filter('manage_users_custom_column', 'rudr_modify_number_logins_user_table_row', 10, 3);

// function rudr_modify_number_logins_user_table_row($row_output, $column_id_attr, $user) {

//     $date_format = 'j M, Y H:i';

//     if($column_id_attr == 'number_of_logins'){
//         $user_meta = get_the_author_meta('session_tokens', $user);
//         if(is_countable($user_meta) && count($user_meta) > 0){                    
//             return count($user_meta);
//         }
//     }

//     // switch ($column_id_attr) {
//     //     case 'number_of_logins' :
//     //             $user_meta = get_the_author_meta('session_tokens', $user);
//     //             if(is_countable($user_meta) && count($user_meta) > 0){
//     //                 return count($user_meta);
//     //             }
//     //         break;
//     //     default: 
//     //         return get_the_author_meta('session_tokens', $user);
//     // }

//     return $row_output;
// }

remove_filter('the_content', 'wpautop');
**/

/**
 * Kim
 * 09-27-22
 * Uncommented this block to support [membership_shortcode] shortcode on the sites products
 * */
function membership_options_shortcode_single_product($atts) {

    $atts2 = shortcode_atts(
            array(
                'id' => '',
                'title' => 'Membership Options',
                'class' => 'member_top_sec',
            ), $atts
    );

    // $test=array("id"=>"47460","id"=>"47460","id"=>"47460");
    $product_ids = explode(",", $atts['id']);
    $section_title = $atts['title'];
    $html_output = '<section class="member_top_sec ' . $atts['class'] . '">';
    $html_output .= '<div class="membership_top">';
    $html_output .= '<div class="container">';
    $html_output .= '<div class="row">';
    $html_output .= '<div class="col-12">';
    $html_output .= '<h2 class="section-main-title text-center py-md-5 py-3">' . $section_title . '</h2>';
    $html_output .= '</div>';
    $html_output .= '</div>';
    $html_output .= '</div>';
    $html_output .= '</div>';
    $html_output .= '<div class="membership_bottom">';
    $html_output .= '<div class="container">';
    $html_output .= '<div class="row justify-content-center">';

    foreach ($product_ids as $key => $product_id) {
        if($product_id != "11"){
            $product_icon = get_field('product_icon', $product_id);
            $product = wc_get_product($product_id);
            $active_cls = '';

            if ($product_id == get_the_ID()) {
                $active_cls = 'active';
            } else {
                $active_cls = '';
            }
            $html_output .= '<div class="col-lg-3 col-sm-4 col-12">';
            $html_output .= '<div class="membership_box ' . $active_cls . '">';
            $html_output .= '<div class="image_box text-center d-flex justify-content-center align-items-center">';
            $html_output .= '<a href="'. get_permalink($post = $product_id, $leavename = false) . '" class="d-block"><img src="' . $product_icon['url'] . '" alt="Membership Box"></a>';
            $html_output .= '</div>';
            $html_output .= '<p class="font-36 text-center mmt-md-4 my-sm-3 my-2 mb-sm-0">' . $product->get_title() . '</p>';
            $html_output .= '<div class="text-center"><a href="https://mariasplace.com/product/activity-box/?add-to-cart='.$product_id.'" class="btn btn-pink btn-pricing-1 px-2 py-1 my-1 button is-secondary" style="font-size:15px;margin-top:1rem !important;">Add to Cart</a></div>';
            $html_output .= '</div>';
            $html_output .= '</div>';
        }else{
                $html_output .= '<div class="col-lg-3 col-sm-4 col-12">';
                $html_output .= '<div class="membership_box">';
                $html_output .= '<div class="image_box text-center d-flex justify-content-center align-items-center">';
                $html_output .= '<a href="/bulk-orders/" target="_blank" class="d-block"><img src="/wp-content/uploads/2023/05/bulk-order.png" alt="Bulk order"></a>';
                $html_output .= '</div>';
                $html_output .= '<p class="font-36 text-center mmt-md-4 my-sm-3 my-2 mb-sm-0">Bulk Order</p>';
                $html_output .= '<div class="text-center"><a href="/bulk-order/" target="_blank" class="btn btn-pink btn-pricing-1 px-2 py-1 my-1 button is-secondary" style="font-size:15px;margin-top:1rem !important;">Learn More</a></div>';
                $html_output .= '</div>';
                $html_output .= '</div>';
        }
    }
    $html_output .= '</div>';
    $html_output .= '</div>';
    $html_output .= '</div>';
    $html_output .= '</section>';
    return $html_output;
}

add_shortcode('membership_shortcode', 'membership_options_shortcode_single_product');

/**
 * Kim
 * 08-29-22
 * Remove Number of logins in user table
 ** /

function archive_to_custom_archive() {
    if (is_post_type_archive('team')) {
        wp_redirect(home_url('/about-us/'), 301);
        exit();
    }
}

add_action('template_redirect', 'archive_to_custom_archive');

add_filter('woocommerce_checkout_fields', 'custom_woocommerce_checkout_fields');

function custom_woocommerce_checkout_fields($fields) {

    $fields['order']['order_comments']['placeholder'] = 'Add your gift message here...';
    $fields['order']['order_comments']['label'] = ' ';

    return $fields;
}

/*
	This code is deprecated and needs to be updated with the new Methods. 
	
*/
function bbloomer_simplify_checkout_virtual($fields) {

    $only_virtual = true;

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        // Check if there are non-virtual products
        if (!$cart_item['data']->is_virtual())
            $only_virtual = false;
    }

    if ($only_virtual) {
        add_filter('woocommerce_enable_order_notes_field', '__return_false');
    }

    return $fields;
}

add_filter('woocommerce_checkout_fields', 'bbloomer_simplify_checkout_virtual');



add_action('wp_logout', 'auto_redirect_after_logout');

function auto_redirect_after_logout() {

    wp_redirect(home_url());
    exit();
}

// Remove WooCommerce Password Strength
function iconic_remove_password_strength() {
    wp_dequeue_script('wc-password-strength-meter');
}

add_action('wp_print_scripts', 'iconic_remove_password_strength', 10);

function save_additional_account_details($user_ID) {

    $pass_cur = !empty($_POST['password_current']) ? $_POST['password_current'] : '';

    $pass1 = !empty($_POST['password_1']) ? $_POST['password_1'] : ''; //

    $pass2 = !empty($_POST['password_2']) ? $_POST['password_2'] : ''; // 

    if (!empty($pass_cur) && empty($pass1) && empty($pass2)) {
        wc_clear_notices();
        wc_add_notice(__('Please fill out all password fields.', 'woocommerce'), 'error');
        $save_pass = false;
    } elseif (!empty($pass1) && empty($pass_cur)) {
        wc_clear_notices();
        wc_add_notice(__('Please enter your current password.', 'woocommerce'), 'error');
        $save_pass = false;
    } elseif (!empty($pass1) && empty($pass2)) {
        wc_clear_notices();
        wc_add_notice(__('Please re-enter your password.', 'woocommerce'), 'error');
        $save_pass = false;
    } elseif ((!empty($pass1) || !empty($pass2) ) && $pass1 !== $pass2) {
        wc_clear_notices();
        wc_add_notice(__('New passwords do not match.', 'woocommerce'), 'error');
        $save_pass = false;
    } elseif (!empty($pass_cur) && !empty($pass1) && !empty($pass2)) {
        wc_clear_notices();
        wc_add_notice(__('Your Password has been successfully changed', 'woocommerce'));
        $save_pass = true;
    }
}

add_action('woocommerce_save_account_details', 'save_additional_account_details');

add_filter('wp_nav_menu_items', function ($items, $args) {

    // Only used on main menu
    if ('primary' != $args->theme_location) {
        return $items;
    }

    if (is_user_logged_in()) {

        $items .= '<li class="mmy-custom-login-logout-link menu-button menu-item">';
        $my_account_text = 'My Account';
        $my_account_redirect = home_url('/my-account/'); // Change logout redirect URl here

        $items .= '<a href="' . $my_account_redirect . '" title="' . esc_attr($my_account_text) . '" class="wpex-logout">' . strip_tags($my_account_text) . '</a>';
        $items .= '</li>';
    }

    // Add custom item
    // Log-out link
    if (is_user_logged_in()) {
        $items .= '<li class="mmy-custom-login-logout-link menu-button menu-item">';

        $text = 'Logout';
        $logout_redirect = home_url('/'); // Change logout redirect URl here

        $items .= '<a href="' . wp_logout_url($logout_redirect) . '" title="' . esc_attr($text) . '" class="wpex-logout">' . strip_tags($text) . '</a>';
        $items .= '</li>';
    }

    // Log-in link
    else {
        $items .= '<li class="mmy-custom-login-logout-link menu-button menu-item">';
        $text = 'Login';
        $login_url = home_url('/login/'); // Change if you want a custom login url

        $items .= '<a href="' . esc_url($login_url) . '" title="' . esc_attr($text) . '">' . strip_tags($text) . '</a>';
        $items .= '</li>';

        $items .= '<li class="mmy-custom-login-logout-link menu-button menu-item">';

        $reg_text = 'Sign up';
        $reg_url = home_url('/registration/?level=26'); // Change if you want a custom login url

        $items .= '<a href="' . esc_url($reg_url) . '" title="' . esc_attr($reg_text) . '">' . strip_tags($reg_text) . '</a>';

        $items .= '</li>';
    }



    // Return nav $items
    return $items;
}, 20, 2);
//add_action('wp_head', 'my_account_page');

function my_account_page() {
    if (!is_user_logged_in()) {
        if (is_page('my-account')) {
            wp_redirect(home_url().'/login');
        }
    }
}


add_filter( 'body_class', 'login_status_body_class' );
function login_status_body_class( $classes ) {
	
  if (is_user_logged_in()) {
    $classes[] = 'hero-cst-user-logged-in';
  } else {
    $classes[] = 'hero-cst-user-logged-out';
  }
  return $classes;
	
}


/**
 * Kim
 * 08-30-2022
 * Add filter to show signup on popup
 * */
add_filter( 'widget_text', 'do_shortcode' );


/*
* Paul
* 10/21/2022
* Add redirect to previous page after registration
*/

function mpsave_url(){
    session_start();
    $_SESSION['prevurl'] = $_SERVER['REQUEST_URI'];  
}

add_action( 'wp_head', 'mpsave_url' );

function mpregister_redirect(){
    if(isset($_SESSION['prevurl'])){ 
       $url = site_url( ) . $_SESSION['prevurl']; // url for last page visited.
       wp_redirect( $url);
    }

}

///////////////////////////////////////
// This is Important Don't Remove it //
/////////////////////////////////////// 
//Added by Parth
// Checkout Back to membership page

// add_action('user_register','mpregister_redirect');
// add_action( 'woocommerce_before_checkout_form', 'return_to_cart_notice_button' );
// function return_to_cart_notice_button(){
//     // HERE Type your displayed message and text button
//     $message = __('Go back to the Membership page', 'woocommerce');
//     $product_val="yes";
//     foreach ( WC()->cart->get_cart() as $cart_item ) {
//         $product = $cart_item['data'];
//         if(!empty($product)){
//             if($product->virtual=="no"){
//                 $product_val="no";
//             }
//         }
//     }
//     if($product_val=="no"){
//         $message = __('Go back to the Membership page<p>For shipping in the US only.</p>', 'woocommerce');
//     }
//     $button_text = __('Back to Membership', 'woocommerce');
//     $cart_link = "/pricing/";
//     wc_add_notice( '<a href="' . $cart_link . '" class="button wc-forward">' . $button_text . '</a>' . $message, 'notice' );
// }

// Added by Parth
// Country validation for checkout page if shipping required not for virtual products


///////////////////////////////////////
// This is Important Don't Remove it //
/////////////////////////////////////// 
add_action('woocommerce_checkout_process', 'deli_products_country_valid');
function deli_products_country_valid() {
    $product_val="yes";
    foreach ( WC()->cart->get_cart() as $cart_item ) {
        $product = $cart_item['data'];
        if(!empty($product)){
            if($product->virtual=="no"){
                $product_val="no";
            }
        }
    }
    if($_POST["ship_to_different_address"]==0){
        if($product_val=="no" && (!empty($_POST['billing_country']) && $_POST['billing_country'] != "US" )){
            wc_add_notice( __($car."This product is not allowed to purchase outside United States."), 'error' );
        }
    }else{
        if($product_val=="no" && (!empty($_POST['shipping_country']) && $_POST['shipping_country'] != "US" )){
            wc_add_notice( __($car."This product is not allowed to purchase outside United States. You can change in shipping address."), 'error' );
        }
    }
}

// add_action( 'user_registration_redirect_from_registration_page', 'redirect_back_after_registration', 10, 2 );
// function redirect_back_after_registration( $redirect_url, $user ) {
//     $redirect = get_transient( 'originalRegisterRefererURL' );
//     delete_transient( 'originalRegisterRefererURL' );
//     return $redirect;
// }
// else if(isset($_SERVER['HTTP_REFERER'])) {
//     $vari=parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
//     echo do_shortcode('[nextend_social_login redirect="'.$vari.'"]');
// }
function parth_register_fn( $atts ) {
    ob_start();
    if(isset($_GET['redirect_url'])) {
        echo do_shortcode('[nextend_social_login redirect="'.$_GET['redirect_url'].'"]');
    }else{
        echo do_shortcode('[nextend_social_login redirect="/welcome-back/"]');
    }
    $output = ob_get_clean();
    return $output;
}
add_shortcode( 'parth_register_sc', 'parth_register_fn');
function parth_user_register_fn( $atts ) {
    ob_start();
    if(isset($_GET['redirect_url'])) {
        echo do_shortcode('[user_registration_my_account redirect_url="'.$_GET['redirect_url'].'"]');
    }else{
        echo do_shortcode('[user_registration_my_account redirect_url="/welcome-back/"]');
    }
    $output = ob_get_clean();
    return $output;
}
add_shortcode( 'parth_user_register_sc', 'parth_user_register_fn');
///////////////////////////////////

// <p style="text-align: center;">[user_registration_form id="34864" redirect_url = "/welcome-back/"]</p>

// <div class="sign-up-msg" style="text-align: center;">Already have an account? <a href="/login/">Log in here</a></div>

function signup_btn( $atts ) {
	$btn = shortcode_atts( array(
		'logged-in-url' => '#',
		'logged-out-url' => '#',        
		'logged-in-label' => 'Sign Up',
		'logged-out-label' => 'Sign Up',        
        'class' => ''
	), $atts );
    $label = is_user_logged_in() ? $btn['logged-in-label'] : $btn['logged-out-label'];
    $url = is_user_logged_in() ? $btn['logged-in-url'] : $btn['logged-out-url'];
    $html .= "<a class='btn ".$btn['class']."' href='".$url."'>" . $label . "</a>";
	return $html;
}
add_shortcode( 'mpbutton', 'signup_btn' );

add_filter( 'wpcf7_validate_text*', 'custom_text_validation_filter', 20, 2 );

function custom_text_validation_filter( $result, $tag ) {
    if ( 'your-name' == $tag->name ) {
        // matches any utf words with the first not starting with a number
        $re = '/^[A-Za-z]+$/';

        if (!preg_match($re, $_POST['your-name'], $matches)) {
            $result->invalidate($tag, "This is not a valid name!" );
        }
    }

    return $result;
}

function getimgalt($img){
    $id[0] = attachment_url_to_postid($img);
    $image_alt = get_post_meta( $id[0], '_wp_attachment_image_alt', true);
    return $image_alt;
}

// Paul - Clean html issues 21/12/2022
// Remove svg filter tag
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

// Disable REST API link tag
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Disable oEmbed Discovery Links
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// Disable REST API link in HTTP headers
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

// Paul - SVG Support
function svgs_upload_mimes( $mimes = array() ) {

	// allow SVG file upload
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;

}
add_filter( 'upload_mimes', 'svgs_upload_mimes', 99 );

function svgs_allow_svg_upload( $data, $file, $filename, $mimes ) {

global $wp_version;
if ( $wp_version !== '4.7.1' || $wp_version !== '4.7.2' ) {
	return $data;
}

$filetype = wp_check_filetype( $filename, $mimes );

return [
	'ext'				=> $filetype['ext'],
	'type'				=> $filetype['type'],
	'proper_filename'	=> $data['proper_filename']
];

}
add_filter( 'wp_check_filetype_and_ext', 'svgs_allow_svg_upload', 10, 4 );


function change_heading_text( $items ) {    
    $items["payment-methods"] = "Card Details"; 
    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'change_heading_text', 99, 1 );


function package_button($id){
    $subscriptions = wcs_user_has_subscription( get_current_user_id(), $id, 'active' );
    if(!$subscriptions){
        echo '<a href="/cart/?add-to-cart='.$id.'" class="btn btn-pink px-2 py-1 button is-secondary my-1" style="margin-top:0.5rem !important;">Add to Cart</a>';
    }else{
        echo "<p style='font-size: 1rem;color: #000;margin:.7rem 0;'>Subscribed</p>";
    }
}

function get_prod_price($id){
    $_product = wc_get_product( $id );
    return "<sup>$</sup>" . $_product->get_regular_price();     
}


add_shortcode('pricing-packages', 'pricing_packages');
function pricing_packages(){
    ob_start();
    ?>
            <div style="text-align:center;">
            <img class="maria-img" src="/wp-content/uploads/2021/04/MariasLogo-2x.png" style="height:6rem;width:auto;" alt="Mariasplace logo">
            </div>
            <table class="table _table-responsive pricing-table">
                <thead>
                    <tr class="table-heading">
                        <th class="plans">
                            <?= get_field("table_heading") ?>
                        </th>
                        <th class="header">
                            <p class="item-maintext" style="font-size:26px;"><?= get_field("table1_heading") ?></p>
                            <span class="item-price">
                                <sup>$</sup>0<small class="cust_price">month</small>
                            </span>
        <a href="<?= get_field("table_column_1_url") ?>" class="btn btn-pink px-2 py-1 my-1 button is-secondary" style="font-size:15px;">Learn More</a>
                        </th>
                        <th class="header">
                            <p class="item-maintext"><?= get_field("table2_heading") ?></p>
                            <span class="item-price">
                                <?= get_prod_price(get_field('table2_product')) ?><small class="cust_price">month</small>
                            </span>
        <a href="<?= get_field("table_column_2_url") ?>" class="btn btn-pink px-2 py-1 my-1 button is-secondary" style="font-size:15px;">Learn More</a>
                        </th>
                        <th class="header">
                            <p class="item-maintext"><?= get_field("table3_heading") ?></p>
                            <span class="item-price">
                            <?= get_prod_price(get_field('table3_product')) ?><small class="cust_price">month</small>
                            </span>
        <a href="<?= get_field("table_column_3_url") ?>" class="btn btn-pink px-2 py-1 my-1 button is-secondary" style="font-size:15px;">Learn More</a>
                        </th>
                        <th class="header">
                            <p class="item-maintext"><?= get_field("table4_heading") ?></p>
                            <span class="item-price">
                            TBD
                            <!-- get_prod_price(get_field('table4_product')) -->
                            <small class="cust_price">month</small>
                            </span>
        <a href="<?= get_field("table_column_4_url") ?>" class="btn btn-pink px-2 py-1 my-1 button is-secondary" target="_blank" style="font-size:15px;">Learn More</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if( have_rows('pricing_items') ):

                            while( have_rows('pricing_items') ) : the_row();
                                ?>
                                    <tr>
                                        <td class="row-heading"><?= get_sub_field('pricing_title') ?></td>
                                        <?php if(get_sub_field('is_free')[0]):?> <td class="data"><img class="h-30p svg-blue" alt="Checked" src="/wp-content/themes/MariasPlace/inc/assets/images/check-mark.svg"></td> <?php else: ?> <td class="data"></td><?php  endif ;?>
                                        <?php if(get_sub_field('2nd_col')[0]):?> <td class="data data-pink1"><div><img class="h-30p svg-blue" alt="Checked" src="/wp-content/themes/MariasPlace/inc/assets/images/check-mark.svg"></div></td> <?php else: ?> <td class="data data-pink1"><div>&nbsp;</div></td><?php  endif ;?>
                                        <?php if(get_sub_field('3rd_col')[0]):?> <td class="data data-pink2"><div><img class="h-30p svg-blue" alt="Checked" src="/wp-content/themes/MariasPlace/inc/assets/images/check-mark.svg"></div></td> <?php else: ?> <td class="data data-pink2"><div>&nbsp;</div></td><?php  endif ;?>
                                        <?php if(get_sub_field('4th_col')[0]):?> <td class="data data-pink3"><div><img class="h-30p svg-blue" alt="Checked" src="/wp-content/themes/MariasPlace/inc/assets/images/check-mark.svg"></div></td> <?php else: ?> <td class="data"></td><?php  endif ;?>                                
                                    </tr>   
                                <?php
                            endwhile;
                        endif;
                    ?>            
                </tbody>
                <tfoot>
                    <tr style="border-color:transparent;">
                        <td class="row-heading"></td>
                        <td class="text-center data"><a href="<?= get_field("table_column_1_url") ?>" class="learn_more_link text-navyblue button is-primary is-inverted learn-more" style="display:block;margin-top:0.5rem !important;">Learn More</a><a href="/registration" class="btn btn-pink px-3 py-1 button is-secondary my-1" style="margin-top:0.5rem !important;">Join Now</a><span class="d-block country-atext">Available Worldwide.</span></td>
                        <td class="text-center data"><a href="<?= get_field("table_column_2_url") ?>" class="learn_more_link text-navyblue button is-primary is-inverted learn-more" style="display:block;margin-top:0.5rem !important;">Learn More</a><?php package_button(get_field('table2_product')) ?><span class="d-block country-atext">Available Worldwide.</span></td>
                        <td class="text-center data"><a href="<?= get_field("table_column_3_url") ?>" class="learn_more_link text-navyblue button is-primary is-inverted learn-more" style="display:block;margin-top:0.5rem !important;">Learn More</a><?php package_button(get_field('table3_product')) ?><span class="d-block country-atext">Available in US only.</span></td>
                        <td class="text-center data"><a href="<?= get_field("table_column_4_url") ?>" target="_blank" class="learn_more_link text-navyblue button is-primary is-inverted learn-more" style="display:block;margin-top:0.5rem !important;">Learn More</a><a href="/bulk-orders/#bulk-order" target="_blank" class="btn btn-pink px-3 py-1 button is-secondary my-1" style="padding: 0.3rem 0.9rem !important;margin-top:0.5rem !important;">Get Quote</a><span class="d-block country-atext">Available in US only.</span></td>
                    </tr>
                </tfoot>
            </table>    
    <?php
    $output = ob_get_clean();
    return $output;
}
add_filter( 'woocommerce_product_description_heading', '__return_null' );


/* Creative Activities Shortcode - David */

function creative_activities_func() {
    ob_start();
    // Replace 'parent-category-slug' with the slug of your parent category
    $parent_category_slug = 'creative-activities';
    // Get the parent category ID based on its slug
    $parent_category = get_term_by('slug', $parent_category_slug, 'category');

    if ($parent_category) {

        $child_categories = get_categories(array(
            'child_of' => $parent_category->term_id,
            'number' => 7,
        ));

        ?>
        <!-- <h2 class="creative_activities_heading">Creative Activities</h2>
        <p class="creative_activities_heading_desc">100s of Creative activities for seniors and the elderly. Activity ideas for the social, mental, and physical well-being of older adults.</p> -->
        <div class="creative_activities_div">
            <?php
                // Loop through the child categories
                foreach ($child_categories as $child_category) {
                    $category_link = get_term_link($child_category);
                    ?>
                    <div class="creative_activities_inner">
                        <div id="thumbnail">
                            <a href="<?= $category_link ?>"><img src="<?= z_taxonomy_image_url($child_category->term_id) ?>"></a>
                        </div>
                        <a href="<?= $category_link ?>"><h3 id="creative_activities_title"><?= $child_category->name ?></h3></a>
                        <p id="creative_activities_desc"><?= substr($child_category->description, 0, 104) ?></p>
                    </div>
                    <?php
                }
            ?>
        </div>
        <?php
    }
    $output = ob_get_clean();
    return $output;
   
}
add_shortcode( 'creative_activities_list', 'creative_activities_func');