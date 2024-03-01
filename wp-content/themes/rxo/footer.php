<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rxo
 */

?>
<?php if (is_legacy()) { ?>
    <footer class="text-center text-md-start text-bg-black">
        <div class="container py-6">
            <div class="align-items-center row">
                <div class="col-12 col-md-3 col-lg-4 col-xl-6">
                    <div class="fs-7 copyright-text pb-4 pb-md-0">© <?= date("Y"); ?> RXO, Inc. All rights reserved.</div>
                </div>
                <div class="col-12 col-md-9 col-lg-8 col-xl-6">
                    <?php
                    wp_nav_menu(array(
                        'theme_location'    => 'footer-social',
                        'menu_class'        => 'navbar-nav',
                        'depth'             => 3,
                        'container'         => 'div',
                        'container_class'   => '',
                        'container_id'      => '',
                        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'          => new WP_Bootstrap_Navwalker(),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->
<?php } else { ?>
    <footer class="text-center text-md-start text-bg-black fs-footer">
        <div class="container py-6">
            <div class="row">
                <div class="col-12 col-lg-5 col-xl-6 mb-lg-10 rxo-footer-logo">
                    <a href="<?= get_site_url() ?>" class="custom-logo-link" rel="home" aria-current="page">
                        <img width="425" height="149" src="<?= get_template_directory_uri() . '/images/rxo-logo-white.svg' ?>" class="custom-logo" alt="RXO">
                    </a>
                </div>
                <div class="col-12 col-lg-7 col-xl-6">
                    <div class="row justify-content-end text-start">
                        <?php
                        if (has_nav_menu('footer-primary')) {
                            wp_nav_menu(array(
                                'theme_location'    => 'footer-primary',
                                'menu_class'        => 'navbar-nav row flex-row justify-content-start justify-content-md-end pb-4 pb-md-0',
                                'li_class'          => 'col',
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
                <div class="col-12 col-md-9 col-lg-5 col-xl-6 position-relative">
                    <div id="copyright-container" class="mt-5 mt-lg-0">
                        <?php
                        if (has_nav_menu('footer-social')) {
                            wp_nav_menu(array(
                                'theme_location'    => 'footer-social',
                                'menu_class'        => 'navbar-nav flex-row mb-3',
                                'depth'             => 3,
                                'container'         => 'div',
                                'container_class'   => '',
                                'container_id'      => '',
                                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'          => new WP_Bootstrap_Navwalker(),
                            ));
                        }
                        ?>
                        <?php
                        if (has_nav_menu('footer-privacy')) {
                            wp_nav_menu(array(
                                'theme_location'    => 'footer-privacy',
                                'menu_class'        => 'navbar-nav flex-row my-1',
                                'depth'             => 3,
                                'container'         => 'div',
                                'container_class'   => '',
                                'container_id'      => '',
                                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'          => new WP_Bootstrap_Navwalker(),
                            ));
                        }
                        ?>
                        <div class="fs-footer copyright-text pb-lg-2">Copyright <?= date("Y"); ?> RXO Inc. All rights reserved.</div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->
<?php } ?>
</div><!-- #page -->
<?php wp_footer(); ?>
<?php if(is_page('api-solutions-documentation')) { ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#api-document-file').on("change", function() {

            var getFileName = $(this).val(); 
            var changeFileName = getFileName.replace(/^.*[\\\/]/, '');

            $('.rxo-intl-file-upload-text').text(changeFileName);
        });

    });
    </script>
<?php } ?>
</body>
</html>
