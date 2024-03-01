<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SpinCo
 */

?>
<?php if (is_page(1974)) :  ?>
    <footer class="py-5X text-center text-md-startX">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="fs-7 my-3">© 2022 RXO, Inc. All rights reserved.</div>
                </div>
            </div>
        </div>
    </footer>
<?php else : ?>
    <footer class="text-center text-md-start bg-black text-white">
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
                        'depth'             => 2,
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
<?php endif; ?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>