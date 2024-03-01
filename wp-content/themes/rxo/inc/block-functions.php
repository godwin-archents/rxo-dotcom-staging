<?php

// Add Custom Blocks Panel in Gutenberg
function rxo_acf_block_categories($categories, $post)
{
    return array_merge($categories, array(array(
        'slug'  => 'rxo-acf-blocks',
        'title' => __('RXO | ACF Blocks'),
    )));
}
add_filter('block_categories', 'rxo_acf_block_categories', 10, 2);

add_action('acf/init', 'rxo_acf_init');
function rxo_acf_init()
{
    // check function exists
    if (function_exists('acf_register_block')) {

        // Using brand logo svg as icon
        $block_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 425.02734 149.13867"><polygon points="276.81641 2.29004 230.89648 2.29004 203.81982 40.59814 176.74365 2.29004 130.61377 2.29004 180.75488 73.2168 128.7417 146.84863 174.66016 146.84863 203.81396 105.63184 232.7666 146.84863 278.90723 146.84863 226.67676 73.21436 276.81641 2.29004"/><path d="M403.24121,21.42236C389.17676,7.60791,369.9502,0,349.10352,0c-20.8584,0-40.12012,7.60693-54.2373,21.41943-14.11816,13.81348-21.89355,32.65234-21.89355,53.04541,0,42.57129,32.72949,74.67383,76.13086,74.67383,43.2832,0,75.92383-32.10254,75.92383-74.67383,0-20.40479-7.7373-39.24219-21.78613-53.04248Zm-18.03027,53.04248c0,21.41602-15.52246,37.56543-36.10742,37.56543s-36.10645-16.14941-36.10645-37.56543c0-21.29639,15.52246-37.35596,36.10645-37.35596s36.10742,16.05957,36.10742,37.35596Z"/><path d="M122.27734,52.6001c0-28.68164-23.15088-50.31006-53.85059-50.31006H0V38.14941H68.42676c8.00098,0,14.03467,6.2124,14.03467,14.45068,0,8.49414-5.90234,14.65918-14.03467,14.65918H0v79.58936H38.56738v-43.93652h21.62646l25.40479,43.93652h43.14307l-30.09766-52.08301c14.83887-9.02246,23.6333-24.6377,23.6333-42.16553Z"/></svg>';


        // jsx enabled blocks (support other blocks as child elements)
        acf_register_block_type(array(
            'name'              => 'rxo-acf-container',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Container'),
            'description'       => __('Display a grid of posts.'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-article-with-sidebar',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Article container with sidebar'),
            'description'       => __('Article container with sidebar'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('news_article'),
            'supports'          => array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-cta-banner',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('CTA Banner'),
            'description'       => __('CTA Banner, Decision CTA, ship with us'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-multilingual',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Multilingual (Translatepress)'),
            'description'       => __('Block wrap for multilanguage'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
        ));

        // Common blocks
        acf_register_block(array(
            'name'              => 'rxo-acf-button',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Button (Theme style)'),
            'description'       => __('Theme style button'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-by-the-numbers',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('By the numbers'),
            'description'       => __('By the numbers section (multiple columns)'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-hotline-numbers',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Contact Numbers'),
            'description'       => __('Hotline numbers list with country name and numbers'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-text-grid',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Text Grid'),
            'description'       => __('Text Grid with title and description'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-text-grid-enhanced',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Text Grid Enhanced'),
            'description'       => __('Text Grid with new features'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-stat-grid',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Stat Grid'),
            'description'       => __('Stat Grid with simple and graphic designs'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-media-download',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Media Download'),
            'description'       => __('Brand media kit with downloadable assets'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        // Featured blocks
        acf_register_block(array(
            'name'              => 'rxo-acf-shortcode',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Shortcode (with preview)'),
            'description'       => __('Shortcode with editor preview'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-embed-iframe',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Embed Iframe'),
            'description'       => __('Embed code with alignment'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'edit',
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-accordion',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Accordion'),
            'description'       => __('Accordion block with image and responsive design layout'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-leadership',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Leadership'),
            'description'       => __('Display leaders list in grid and their biography in a modal'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-tab-grid',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Tab Grid'),
            'description'       => __('Display Tab Grid'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-program-tiers',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Program Tiers'),
            'description'       => __('Display Rewards of Programs'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-feature-post',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Feature Post'),
            'description'       => __('Display feature post'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-latest-news',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Latest News'),
            'description'       => __('To display latest news'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-tabs',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Tabs'),
            'description'       => __('Tabs with shortcode'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-promo-modal',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Promo Modal'),
            'description'       => __('Promo modal with title and description'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'supports'          => array('multiple' => false)
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-post-filter',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Post Filter'),
            'description'       => __('Filter posts by date and order by sorting'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page','news_article'),
            'enqueue_assets' => function () {
                wp_enqueue_script('rxo-filter', get_template_directory_uri() . '/js/rxo-filter.js', array('jquery'), filemtime(get_template_directory() . '/js/rxo-filter.js'), false);
                wp_localize_script('rxo-filter', 'rxo_filter', array(
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('ajax-nonce')
                ));
                wp_enqueue_script('choices-js', get_template_directory_uri() . '/js/choices.min.js', '', '10.1.0', false);
                wp_enqueue_script('vanilla-dapicker', get_template_directory_uri() . '/js/datepicker.min.js', array(), '', false);
            },
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-newsroom-filter',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Newsroom Filter'),
            'description'       => __('Display latest posts from selected category with date and catergory filters'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_script('rxo-filter', get_template_directory_uri() . '/js/rxo-filter.js', array('jquery'), filemtime(get_template_directory() . '/js/rxo-filter.js'), false);
                wp_localize_script('rxo-filter', 'rxo_filter', array(
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('ajax-nonce')
                ));
                wp_enqueue_script('choices-js', get_template_directory_uri() . '/js/choices.min.js', '', '10.1.0', false);
                wp_enqueue_script('vanilla-dapicker', get_template_directory_uri() . '/js/datepicker.min.js', array(), '', false);
            },
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-awards',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Awards'),
            'description'       => __('Display RXO awards in a slider'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', '', '2.3.4', false);
                wp_enqueue_style('owl-carousel-css-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', '', '2.3.4', false);
                wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', '', '2.3.4', false);
            },
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-logo-slider',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Logo Slider'),
            'description'       => __('Display RXO logos in slider'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', '', '2.3.4', false);
                wp_enqueue_style('owl-carousel-css-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', '', '2.3.4', false);
                wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', '', '2.3.4', false);
            },
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-quote',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Quote'),
            'description'       => __('Display quotes abour RXO in a slider'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', '', '2.3.4', false);
                wp_enqueue_style('owl-carousel-css-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', '', '2.3.4', false);
                wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', '', '2.3.4', false);
            },
        ));

        // Blocks for internal tools
        acf_register_block(array(
            'name'              => 'rxo-acf-interview-questions',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Interview Questions'),
            'description'       => __('A custom interview questions block.'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_script('choices-js', get_template_directory_uri() . '/js/choices.min.js', '', '10.1.0', false);
                wp_enqueue_script('rxo-interview', get_template_directory_uri() . '/js/rxo-interview.js', '', filemtime(get_template_directory() . '/js/rxo-interview.js'), false);
                wp_enqueue_script('sejda-js-api', '//www.sejda.com/js/sejda-js-api.min.js', '', '', false);
            },
            'supports'          => array('multiple' => false)
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-email-signature-tool',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Email signature tool'),
            'description'       => __('A custom component to generate email signature for all employees.'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_script('choices-js', get_template_directory_uri() . '/js/choices.min.js', '', '10.1.0', false);
                wp_enqueue_script('clipboard-js', get_template_directory_uri() . '/js/clipboard.min.js', '', '2.0.11', false);
            },
            'supports'          => array('multiple' => false)
        ));


        acf_register_block(array(
            'name'              => 'rxo-acf-carrier-info',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Carrier Info'),
            'description'       => __('A custom component to display carrier information results.'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-driver-dispatch',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Driver Dispatch'),
            'description'       => __('A custom component to display driver dispatch results.'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_script('choices-js', get_template_directory_uri() . '/js/choices.min.js', '', '10.1.0', false);
            },
        ));


        acf_register_block(array(
            'name'              => 'rxo-acf-featured-articles',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Featured Articles'),
            'description'       => __('To display featured articles'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-latest-articles',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Latest Articles'),
            'description'       => __('To display latest articles'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-deeper-dive',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Deeper Dive'),
            'description'       => __('To display deeper dive posts'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-curated-series',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Curated Series'),
            'description'       => __('To display Curated Series Selected or Related Posts'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-heading-with-tagline',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Heading with Tagline'),
            'description'       => __('To display Heading with Tagline on any posts or page content'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-list-with-numbers',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('List with Numbers'),
            'description'       => __('To display list items with ordered numbers on any posts or page content'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-all-posts',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('All Posts'),
            'description'       => __('Display latest posts from selected content type'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page', 'resource_center'),
            'enqueue_assets' => function () {
                wp_enqueue_script('rxo-filter', get_template_directory_uri() . '/js/rxo-filter.js', array('jquery'), filemtime(get_template_directory() . '/js/rxo-filter.js'), false);
                wp_localize_script('rxo-filter', 'rxo_filter', array(
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('ajax-nonce')
                ));
            },
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-rc-author',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('RC Author'),
            'description'       => __('Display rc author for the post'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-policy-grid',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Policy Grid'),
            'description'       => __('To display policy details with grid'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-policy-grid-search',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Policy Grid Search'),
            'description'       => __('To display policy details with grid'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-card-grid',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Card Grid'),
            'description'       => __('Card Grid with title and description'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-content-image-block',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Content Image Block'),
            'description'       => __('To display content with image side by side'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-hero-block',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Hero Block'),
            'description'       => __('To display hero'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-complex-cta',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Complex CTA'),
            'description'       => __('CTA Banner, Decision CTA'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'rxo-acf-form-container',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Form Container'),
            'description'       => __('Display a form inside container.'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
        ));
        acf_register_block(array(
            'name'              => 'rxo-acf-complex-accordion',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Complex Accordion'),
            'description'       => __('Complex Accordion block with image and responsive design layout'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-faq',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('FAQ'),
            'description'       => __('Frequently Asked Questions'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));
        
        acf_register_block(array(
            'name'              => 'rxo-acf-awards-enhanced',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Awards Enhanced'),
            'description'       => __('Display RXO awards enhanced in a slider'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', '', '2.3.4', false);
                wp_enqueue_style('owl-carousel-css-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', '', '2.3.4', false);
                wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', '', '2.3.4', false);
            },
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-quote-enhanced',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Quote Enhanced'),
            'description'       => __('Display quotes abour RXO in a slider'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', '', '2.3.4', false);
                wp_enqueue_style('owl-carousel-css-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', '', '2.3.4', false);
                wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', '', '2.3.4', false);
            },
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-video',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Video'),
            'description'       => __('Image placholder for video'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-widgets',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Widgets'),
            'description'       => __('Display Widget Posts and Pages'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-vehicle-services-api',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Vehicle Services API'),
            'description'       => __('Display Vehicle Info'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'enqueue_assets' => function () {
                wp_enqueue_script('rxo-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), '', false);
                wp_enqueue_script('vanilla-dapicker', get_template_directory_uri() . '/js/datepicker.min.js', array(), '', false);
            },
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-hero-media',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Hero Image/Video Block'),
            'description'       => __('Display Hero Image/Video Posts and Pages'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-breakout-cta',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Breakout CTA'),
            'description'       => __('Display Breakout CTA Posts and Pages'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-content-block',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Content Block'),
            'description'       => __('This block has few iterations of content block'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => true,
                'jsx' => true,
                'innerBlocks'  => true,
            ),
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-internal-tools-widget',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Internal Tools Widget'),
            'description'       => __('Display Internal Tools Widget Posts and Pages'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'enqueue_assets' => function () {
                wp_enqueue_script('choices-js', get_template_directory_uri() . '/js/choices.min.js', '', '10.1.0', false);
                wp_enqueue_script('clipboard-js', get_template_directory_uri() . '/js/clipboard.min.js', '', '2.0.11', false);
                wp_enqueue_script('rxo-interview', get_template_directory_uri() . '/js/rxo-interview.js', '', filemtime(get_template_directory() . '/js/rxo-interview.js'), false);
                wp_enqueue_script('sejda-js-api', '//www.sejda.com/js/sejda-js-api.min.js', '', '', false);
            },
            'supports'          => array('multiple' => true)
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-news-feed',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('RXO FrontPage Content'),
            'description'       => __('To Display RXO FrontPage Content'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview',
            'enqueue_assets' => function () {
                wp_enqueue_script('choices-js', get_template_directory_uri() . '/js/choices.min.js', '', '10.1.0', false);
            },
        ));

        acf_register_block(array(
            'name'              => 'rxo-acf-add-new-market',
            'category'          => 'rxo-acf-blocks',
            'title'             => __('Add New Market'),
            'description'       => __('Add a new market that will be visible in the dropdown "Market requesting support"'),
            'render_callback'   => 'rxo_acf_block_template',
            'icon'              => $block_icon,
            'mode'              => 'preview'
        )); 

    }
}

function rxo_acf_block_template($block)
{

    // convert slug name ("acf/rxo-acf-testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/rxo-acf-', '', $block['name']);

    // template parts from within the "template-parts/blocks" folder
    $block_template = get_theme_file_path("/template-parts/blocks/{$slug}.php");

    // fallback to default block template 
    $default_template = get_theme_file_path("/template-parts/blocks/default.php");

    // checking if block template exists
    if (!file_exists($block_template)) {
        $block_template = $default_template;
    }

    // Including template for custom block
    if (file_exists($block_template)) {
      include($block_template);
    }
}


// Post type Select Box Filter
function rxo_get_post_type($field)
{
    $args = array(
        'public' => true,
    );

    $post_types = get_post_types($args);

    $exclude_types = array(
        'attachment',
        'page'
    );

    foreach ($exclude_types as $exclude_type) {
        unset($post_types[$exclude_type]);
    }

    $choices = array();

    foreach ($post_types as $post_type) {
        $display_name = str_replace(array('-', '_'), " ", $post_type);
        $choices[$post_type] = ucwords($display_name);
    }

    $field['choices'] = $choices;

    return $field;
}

add_filter('acf/load_field/name=post_type', 'rxo_get_post_type');

function rxo_get_only_published_posts($args, $field, $post_id)
{
    $args['post_status'] = 'publish';
    return $args;
}
add_filter('acf/fields/post_object/query', 'rxo_get_only_published_posts', 10, 3);
