<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */
?>
<?php
 session_start();
 $csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_stylesheet_directory_uri() ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_stylesheet_directory_uri() ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_stylesheet_directory_uri() ?>/favicon-16x16.png">
    <link rel="manifest" href="<?= get_stylesheet_directory_uri() ?>/site.webmanifest">
    <link rel="mask-icon" href="<?= get_stylesheet_directory_uri() ?>/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="google-site-verification" content="ljrg0Hs8YWjQ8gWHlSBmtnhp2VZbVnNvWk-O7-vXJcU" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <?php wp_head(); ?>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
		<!-- <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=6263054c76e56100197a0b91&product=sticky-share-buttons' async='async'></script> -->
        <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-98786755-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-98786755-2');
        </script> -->
<!-- Hotjar Tracking Code for https://mariasplace.com -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:3554976,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
<!-- END - Hotjar Tracking Code for https://mariasplace.com -->
    </head>
    <body <?php body_class(); ?>>
        <?php
        if (function_exists('wp_body_open')) {
            wp_body_open();
        } else {
            do_action('wp_body_open');
        }
        ?>
        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'MariasPlace'); ?></a>
            <?php if (!is_page_template('blank-page.php') && !is_page_template('blank-page-with-container.php')) : ?>
                <header id="masthead" class="site-header navbar-static-top <?php echo wp_bootstrap_starter_bg_class(); ?>">
                    <div class="container-fluid">
                        <nav class="navbar navbar-expand-lg p-0">
                            <div class="site-logo col-lg-3 col-md-4 col-sm-6 p-0 px-md-3">
                                <div class="navbar-brand m-0">
                                    <?php if (get_theme_mod('wp_bootstrap_starter_logo')) : ?>
                                        <a href="<?php echo esc_url(home_url('/')); ?>">
                                            <img width="238" height="72" src="<?php echo esc_url(get_theme_mod('wp_bootstrap_starter_logo')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                        </a>
                                    <?php else : ?>
                                        <a class="site-title" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_url(bloginfo('name')); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- LOGO -->
                            <div class="site-navigation col-lg-6">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'container' => 'div',
                                    'container_id' => 'main-nav',
                                    'container_class' => 'collapse navbar-collapse justify-content-md-center',
                                    'menu_id' => false,
                                    'menu_class' => 'navbar-nav align-items-center',
                                    'depth' => 3,
                                ));
                                ?>
                            </div>
                            <!-- Navigation -->
                            <div id="mobile-widget" class="col-lg-3 col-md-8 col-sm-6 pl-0 text-right">
                                <button class="navbar-toggler pull-right" type="button" data-bs-toggle="collapse" data-bs-target="#mobile-navigation" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <ul class="navbar-nav pull-right">
                                <?php
                                $current_page_slug = get_post_field( 'post_name', get_post() );
                                        echo do_shortcode('[google-translator language="Spanish" label="Español" text="yes"]');
                                    // }
                                ?>
                                
                                    <?php
                                    $items = "";
                                    if (is_user_logged_in()) {
                                        $items .= '<li id="myaccount-menu" class="nav-item user-menu"><a class="nav-link button is-primary" href="' . site_url() . '/my-account/    ">My Account</a></li>';
                                        $items .= '<li id="logout-menu" class="nav-item user-menu"><a class="nav-link" href="' . wp_logout_url(home_url()) . '">Logout</a></li>';
                                    } else {
                                        $items .= '<li id="login-menu" class="nav-item user-menu"><a class="nav-link button is-secondary" href="/login">Login</a></li>';
                                        $items .= '<li id="signup-menu" class="nav-item user-menu"><a class="nav-link button is-primary" href="/registration/">Sign up</a></li>';
                                    }
                                    //_data-toggle="modal" _data-target="#Login"   _data-toggled="modal" _data-targetd="#Registeration" 
                                    if ($woocommerce) {
	                                    $cartValue = wc_get_cart_url();	                                    
                                        $shopping_icon_url = get_template_directory_uri() . '/inc/assets/images/shopping-icon.png';
                                        $items .= '<li id="shopping-cart" class="nav-item user-menu"><a class="nav-link" id="mobile-cart-link" href="' . $cartValue . '"><img width="20" height="20" src="' . $shopping_icon_url . '" alt="Shopping Icon"/>';

                                        if ($woocommerce->cart->cart_contents_count > 0) {
                                            $items .= '<span class="cart-total-items">' . $woocommerce->cart->cart_contents_count . '</span>';
                                        }
                                        $items .= '</a></li>';
                                    }

                                    $search_icon_url = get_template_directory_uri() . '/inc/assets/images/search-icon.png';
                                    $items .= '<li id="mobile-search-item" class="nav-item user-menu"><img width="20" height="20" src="' . $search_icon_url . '" alt="Search Icon"/></li>';
                                    echo $items
                                    ?>
                                </ul>
                                <div class="search_form_div"><aside id="searchformWrap" class="d-none">
                                    <form action="<?php echo esc_url(home_url('/')); ?>" id="searchform" method="get">
                                    <input type="text" name="s" id="s" placeholder="Start Typing..."><em class="d-block">Press enter to begin your search</em>
                                    <input type="hidden" name="csrf_token" value="<?php echo esc_attr($_SESSION['csrf_token']); ?>">
                                </form></aside></div>
                            </div>
                        </nav>
                    </div>
                    <div id="mobile-navigation">
                        <i id="close-btn" class="fa fa-close"></i>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container' => 'div',
                            'container_id' => 'mobile-nav',
                            'container_class' => 'mobile-nav-bar',
                            'menu_id' => false,
                            'menu_class' => 'navbar-nav align-items-center',
                            'depth' => 0,
                        ));
                        ?> 
                    </div>
                </header><!-- #masthead -->
                <div id="content" class="site-content">
                    <?php
                    if (!is_attachment() && (!is_front_page() && !is_home())) {
                        echo custom_breadcrumbs();
                    }
                    ?>
                    <?php
                    if (get_page_template_slug(get_queried_object_id()) == 'fullwidth.php' || get_post_type(get_queried_object_id()) == 'post' || get_page_template_slug(get_queried_object_id()) == 'templates/splash-template.php' || get_page_template_slug(get_queried_object_id()) == 'templates/sign-up-lock.php') {
                        $container = 'container-fluid';
                    } else {
                        $container = 'container';
                    }
                    if (!is_product()) {
                        ?>
                        <div class="<?= $container; ?>">
                            <div class="row">
                    <?php
                        }
                    ?>
                <?php endif; ?>