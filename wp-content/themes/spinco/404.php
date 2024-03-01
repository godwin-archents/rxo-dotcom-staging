<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package SpinCo
 */

get_header();
?>

<main id="primary" class="site-main" style="min-height:600px;">

    <section class="container py-6 error-404 not-found">
        <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'spinco'); ?></h1>

        <div class="page-content">
            <p><?php esc_html_e('It looks like nothing was found at this location.', 'spinco'); ?></p>

            <?php
            /*
            get_search_form();

            the_widget('WP_Widget_Recent_Posts');
            */
            ?>
        </div><!-- .page-content -->
    </section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
