<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rxo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
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

    <?php if(is_search()){
        echo "<title>Search Results - ". get_search_query().'</title>';
    } ?>

    <?php wp_head(); ?>

    <?php
    //GET HOSTNAME INFO
    $hostname = $_SERVER['SERVER_NAME'];

    $hostname_prod_array = array('rxo.com', 'internal-tools.rxo.com', 'engage.rxo.com', 'onboarding.rxo.com', 'ethics.rxo.com', 'lastmile-mobile.rxo.com', 'procurement.rxo.com', 'apisolutions.rxo.com', 'gso.rxo.com');

    //Environment variables
    if (in_array($hostname, $hostname_prod_array)) { ?>

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5L4WMJF');</script>
        <!-- End Google Tag Manager -->
    <?php } ?>

    <!-- <meta name="facebook-domain-verification" content="jag17eajhiagtfs5mtid6kd46ewc70" /> -->
</head>

<body <?php has_nav_menu('header-secondary') ? body_class('has-secondary-header') : body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php if (in_array($hostname, $hostname_prod_array)) { ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5L4WMJF" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->    
    <?php } ?>

    <div id="page" class="site">
        <?php if (is_legacy()) { ?>
            <header class="site-header">
                <nav id="site-navigation" class="navbar navbar-expand-xl" aria-label="Main navigation">
                    <div class="container position-relative">
                        <?= the_custom_logo(); ?>
                    </div>
                </nav><!-- #site-navigation -->
            </header><!-- #masthead -->
        <?php } else { ?>
            <header class="site-header fixed-top ">
                <nav id="site-navigation" class="navbar navbar-expand-xl py-2 flex-grow-1 <?= has_nav_menu('header-secondary') ? 'has-top-menu' : '' ?> navbar-megamenu" aria-label="Main navigation">
                    <div class="container position-relative bg-white">
                        <div class="d-flex align-items-stretch gap-xl-4 gap-lg-4 gap-md-3 gap-sm-2 rxo-logo-wrap">
                            <?= the_custom_logo(); ?>
                            <?php
                            $site_moniker = get_theme_mod('site_moniker');
                            if (!empty($site_moniker)) : ?>
                                <div class="site-moniker d-flex align-items-center border-start ps-xl-4 ps=lg-4 ps-md-3 ps-sm-2"><?= $site_moniker ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex align-items-center d-xl-none rxo-search-wrap">

                            <?php if (!hide_search_bar()) : ?>
                                <button type="submit" aria-label="search" class="btn btn-link py-0 me-3 mobile-search-icon enter" data-search="target_1">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6368 11.8022C9.52023 12.6702 8.11723 13.187 6.59352 13.187C2.95202 13.187 0 10.235 0 6.59352C0 2.95202 2.95202 0 6.59352 0C10.235 0 13.187 2.95202 13.187 6.59352C13.187 8.11718 12.6702 9.52013 11.8023 10.6366L16 14.8343L14.8344 15.9998L10.6368 11.8022ZM11.5387 6.59352C11.5387 9.32463 9.32463 11.5387 6.59352 11.5387C3.8624 11.5387 1.64838 9.32463 1.64838 6.59352C1.64838 3.8624 3.8624 1.64838 6.59352 1.64838C9.32463 1.64838 11.5387 3.8624 11.5387 6.59352Z" fill="#1C1C1C"></path>
                                    </svg>
                                </button>
                            <?php endif; ?>
                            <button id="mobile-search-clear-btn" class="btn btn-link py-0 me-3" type="button" aria-label="close searchbar">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.53267 8L15.6633 1.86253C16.0886 1.43681 16.0886 0.745011 15.6633 0.31929C15.2381 -0.10643 14.5471 -0.10643 14.1218 0.31929L7.99114 6.45676L1.86047 0.337029C1.43522 -0.0886917 0.744186 -0.0886917 0.318937 0.337029C-0.106312 0.762749 -0.106312 1.45455 0.318937 1.88027L6.44961 8L0.336656 14.1375C-0.0885936 14.5632 -0.0885936 15.255 0.336656 15.6807C0.761905 16.1064 1.45293 16.1064 1.87818 15.6807L8.00886 9.54324L14.1395 15.6807C14.5648 16.1064 15.2558 16.1064 15.6811 15.6807C16.1063 15.255 16.1063 14.5632 15.6811 14.1375L9.53267 8Z" fill="#1C1C1C"></path>
                                </svg>
                            </button>
                            <button class="navbar-toggler p-0 border-0 shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar rounded-pill"></span>
                                <span class="icon-bar rounded-pill"></span>
                                <span class="icon-bar rounded-pill"></span>
                            </button>
                        </div>
                        <div id="navbarMenu" class="collapse navbar-collapse justify-content-end">
                        <?php if (!hide_search_bar()) : ?>
                            <div class="d-sm-none d-md-none d-lg-none d-xl-flex overflow-hidden mb-4 mb-xl-0" id="search-form-container" data-target="target_1">
                                <div class="container">
                                    <form class="align-items-center border-2 border-bottom border-primary-dark d-flex" action="/" method="GET" id="searchform-page">
                                        <input type="text" placeholder="Search for people, technology, capabilities, etc" name="s" id="search-input" class="form-control flex-grow-1 order-1 border-0 bg-transparent" oninput="typeSearchContainer()" required="">
                                        <button class="btn btn-link py-0" type="submit" aria-label="search">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6368 11.8022C9.52023 12.6702 8.11723 13.187 6.59352 13.187C2.95202 13.187 0 10.235 0 6.59352C0 2.95202 2.95202 0 6.59352 0C10.235 0 13.187 2.95202 13.187 6.59352C13.187 8.11718 12.6702 9.52013 11.8023 10.6366L16 14.8343L14.8344 15.9998L10.6368 11.8022ZM11.5387 6.59352C11.5387 9.32463 9.32463 11.5387 6.59352 11.5387C3.8624 11.5387 1.64838 9.32463 1.64838 6.59352C1.64838 3.8624 3.8624 1.64838 6.59352 1.64838C9.32463 1.64838 11.5387 3.8624 11.5387 6.59352Z" fill="#1C1C1C"></path>
                                            </svg>
                                        </button>
                                        <button id="search-input-clear-btn" class="btn btn-link py-0 order-3" type="button" aria-label="close searchbar" onclick="hideSearchContainer()">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.53267 8L15.6633 1.86253C16.0886 1.43681 16.0886 0.745011 15.6633 0.31929C15.2381 -0.10643 14.5471 -0.10643 14.1218 0.31929L7.99114 6.45676L1.86047 0.337029C1.43522 -0.0886917 0.744186 -0.0886917 0.318937 0.337029C-0.106312 0.762749 -0.106312 1.45455 0.318937 1.88027L6.44961 8L0.336656 14.1375C-0.0885936 14.5632 -0.0885936 15.255 0.336656 15.6807C0.761905 16.1064 1.45293 16.1064 1.87818 15.6807L8.00886 9.54324L14.1395 15.6807C14.5648 16.1064 15.2558 16.1064 15.6811 15.6807C16.1063 15.255 16.1063 14.5632 15.6811 14.1375L9.53267 8Z" fill="#1C1C1C"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php
                        if (has_nav_menu('header-primary')) {
                            wp_nav_menu(array(
                                'theme_location'    => 'header-primary',
                                'menu_class'        => 'navbar-nav ms-auto',
                                'depth'             => 3,
                                'container'         => 'div',
                                //'container_class'   => 'ms-auto',
                                'container_class'   => '',
                                'container_id'      => '',
                                'container_atts'  => array('role'=> 'navigation'),
                                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'          => new WP_Bootstrap_Navwalker(),
                            ));                                
                        }
                        ?>
                        <hr class="dropdown-divider d-xl-none" data-target="target_3">
                        <div id="topbar-navigation" class="fs-legal px-xl-7 px-lg-6 px-md-5 px-sm-4" data-target="target_4">
                            <div class="container p-0">
                                <div class="d-xl-flex justify-content-end">
                                    <?php
                                    if (has_nav_menu('header-secondary')) {
                                        wp_nav_menu(array(
                                            'theme_location'    => 'header-secondary',
                                            'menu_class'        => 'navbar-nav',
                                            'depth'             => 3,
                                            'container'         => 'div',
                                            'container_class'   => '',
                                            'container_id'      => '',
                                            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                            'walker'          => new WP_Bootstrap_Navwalker(),
                                        ));
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php if (!hide_search_bar()) : ?>
                            <div class="menu-search d-none d-xl-flex" data-target="target_5">
                                <button class="btn btn-link btn-rounded p-0" onclick="showSearchContainer()" type="button" aria-label="search">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6368 11.8022C9.52023 12.6702 8.11723 13.187 6.59352 13.187C2.95202 13.187 0 10.235 0 6.59352C0 2.95202 2.95202 0 6.59352 0C10.235 0 13.187 2.95202 13.187 6.59352C13.187 8.11718 12.6702 9.52013 11.8023 10.6366L16 14.8343L14.8344 15.9998L10.6368 11.8022ZM11.5387 6.59352C11.5387 9.32463 9.32463 11.5387 6.59352 11.5387C3.8624 11.5387 1.64838 9.32463 1.64838 6.59352C1.64838 3.8624 3.8624 1.64838 6.59352 1.64838C9.32463 1.64838 11.5387 3.8624 11.5387 6.59352Z" fill="#1C1C1C"></path>
                                    </svg>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                    </div>
                </nav>
            </header>
        <?php } ?>