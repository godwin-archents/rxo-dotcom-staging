<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SpinCo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php if (is_page(1974)) :  ?>
        <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600&display=swap" rel="stylesheet">
    <?php else : ?>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <?php endif; ?>
    <style id="antiClickjack">
        body {
            display: none !important;
        }
    </style>

    <script type="text/javascript">
        if (self.location.origin === top.location.origin) {
            var antiClickjack = document.getElementById("antiClickjack");
            antiClickjack.parentNode.removeChild(antiClickjack);
        } else {
            top.location = self.location;
        }
    </script>
    <?php wp_head(); ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5L4WMJF');</script>
    <!-- End Google Tag Manager -->
    <!-- Google Tag Manager 
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W4C29QZ');</script>
     End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5L4WMJF" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Google Tag Manager (noscript) 
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W4C29QZ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
     End Google Tag Manager (noscript) -->
    <div id="page" class="site">
        <header class="site-header">
            <nav id="site-navigation" class="navbar navbar-expand-xl" aria-label="Main navigation">
                <div class="container position-relative">
                    <?php echo the_custom_logo(); ?>
                    <div class="d-flex align-items-center d-xl-none">
                        <button class="navbar-toggler p-0 border-0 shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar rounded-pill"></span>
                            <span class="icon-bar rounded-pill"></span>
                            <span class="icon-bar rounded-pill"></span>
                        </button>
                    </div>
                    <div id="navbarMenu" class="collapse navbar-collapse">
                        <?php
                        wp_nav_menu(array(
                            'theme_location'    => 'header-primary',
                            'menu_class'        => 'navbar-nav ms-auto',
                            'depth'             => 2,
                            'container'         => 'div',
                            'container_class'   => 'ms-auto',
                            'container_id'      => '',
                            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'          => new WP_Bootstrap_Navwalker(),
                        ));
                        ?>
                    </div>
                </div>
            </nav><!-- #site-navigation -->
        </header><!-- #masthead -->