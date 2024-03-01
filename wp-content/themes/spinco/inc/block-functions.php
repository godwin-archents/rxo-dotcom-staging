<?php

// Add Custom Blocks Panel in Gutenberg
function spinco_acf_block_categories($categories, $post)
{
    return array_merge($categories, array(array(
        'slug'  => 'spinco-acf-blocks',
        'title' => __('SPINCO | ACF Blocks'),
    )));
}
add_filter('block_categories', 'spinco_acf_block_categories', 10, 2);

add_action('acf/init', 'spinco_acf_init');
function spinco_acf_init()
{

    // check function exists
    if (function_exists('acf_register_block')) {

        acf_register_block(array(
            'name'                => 'spinco-acf-article-with-sidebar',
            'category'          => 'spinco-acf-blocks',
            'title'                => __('Article container with sidebar'),
            'description'        => __('Article container with sidebar'),
            'mode'              => 'preview',
            'post_types'        => array('news_article'),
            'supports'          => array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'                => 'layout',
        ));

        acf_register_block(array(
            'name'              => 'spinco-acf-embed-iframe',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Embed Iframe'),
            'description'       => __('Embed code with alignment'),
            'render_callback'   => 'spinco_acf_block_template',
            'icon'              => 'layout',
            'mode'              => 'edit',
        ));

        acf_register_block(array(
            'name'              => 'spinco-acf-awards',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Awards'),
            'description'       => __('A custom feature white block to display RXO awards'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'              => 'admin-comments',
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', '', '2.3.4', false);
                wp_enqueue_style('owl-carousel-css-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', '', '2.3.4', false);
                wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', '', '2.3.4', false);
            },
        ));

        acf_register_block(array(
            'name'                => 'spinco-acf-button',
            'category'          => 'spinco-acf-blocks',
            'title'                => __('Button (Theme style)'),
            'description'        => __('Theme style button'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'                => 'layout',
            'mode'              => 'preview'
        ));

        acf_register_block_type(array(
            'name'              => 'spinco-acf-container',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Container'),
            'description'        => __('Display a grid of posts.'),
            'icon'                => 'align-full-width',
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
            'render_callback'    => 'spinco_acf_block_template',
        ));

        acf_register_block(array(
            'name'                => 'spinco-acf-embed-multilingual',
            'category'          => 'spinco-acf-blocks',
            'title'                => __('Embed (Multi language)'),
            'description'        => __('Embed code for multilanguage'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'                => 'layout',
            'mode'              => 'edit',
        ));

        acf_register_block(array(
            'name'              => 'spinco-acf-latest-news',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Latest News'),
            'description'       => __('To display latest news in the home page'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'              => 'admin-comments',
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'spinco-acf-leadership',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Leadership'),
            'description'       => __('A custom feature white block to display leadership biography'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'              => 'admin-comments',
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'spinco-acf-logo-slider',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Logo Slider'),
            'description'       => __('A custom feature white block to display RXO logos'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'              => 'admin-comments',
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', '', '2.3.4', false);
                wp_enqueue_style('owl-carousel-css-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', '', '2.3.4', false);
                wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', '', '2.3.4', false);
            },
        ));

        acf_register_block(array(
            'name'                => 'spinco-acf-shortcode',
            'category'          => 'spinco-acf-blocks',
            'title'                => __('Shortcode (with preview)'),
            'description'        => __('Shortcode with editor preview'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'                => 'layout',
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'spinco-acf-ajax-call',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Ajax Call'),
            'description'       => __('A custom components to dispay ajax call results.'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'              => 'admin-comments',
            'mode'              => 'preview'
        ));


        acf_register_block(array(
            'name'              => 'spinco-acf-carrier-info',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Carrier Info'),
            'description'       => __('A custom components to dispay ajax call results.'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'              => 'admin-comments',
            'mode'              => 'preview'
        ));

        acf_register_block(array(
            'name'              => 'spinco-acf-driver-dispatch',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Driver Dispatch'),
            'description'       => __('A custom components to dispay driver dispatch results.'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'              => 'admin-comments',
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_script('choices-js', get_template_directory_uri() . '/js/choices.min.js', '', '10.1.0', false);
            },
        ));

        acf_register_block(array(
            'name'              => 'spinco-acf-interview-questions',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Interview Questions'),
            'description'       => __('A custom interview questions block.'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'              => 'admin-comments',
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_script('choices-js', get_template_directory_uri() . '/js/choices.min.js', '', '10.1.0', false);
                wp_enqueue_script('clipboard-js', get_template_directory_uri() . '/js/clipboard.min.js', '', '2.0.11', false);
                wp_enqueue_script('rxo-interview', get_template_directory_uri() . '/js/rxo-interview.js', '', filemtime(get_template_directory() . '/js/rxo-interview.js'), false);
            },
            'supports'          => array('multiple' => false)
        ));

        acf_register_block(array(
            'name'              => 'spinco-acf-email-signature-tool',
            'category'          => 'spinco-acf-blocks',
            'title'             => __('Email signature tool'),
            'description'       => __('A custom component to generate email signature for all employees.'),
            'render_callback'    => 'spinco_acf_block_template',
            'icon'              => 'admin-comments',
            'mode'              => 'preview',
            'post_types'        => array('page'),
            'enqueue_assets' => function () {
                wp_enqueue_script('choices-js', get_template_directory_uri() . '/js/choices.min.js', '', '10.1.0', false);
                wp_enqueue_script('clipboard-js', get_template_directory_uri() . '/js/clipboard.min.js', '', '2.0.11', false);
            },
            'supports'          => array('multiple' => false)
        ));
    }
}

function spinco_acf_block_template($block)
{

    // convert slug name ("acf/spinco-acf-testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/spinco-acf-', '', $block['name']);

    // template parts from within the "template-parts/blocks" folder
    $block_template = get_theme_file_path("/template-parts/blocks/{$slug}.php");

    // fallback to default block template 
    $default_template = get_theme_file_path("/template-parts/blocks/default.php");

    // checking if block template exists
    if (!file_exists($block_template)) {
        $block_template = $default_template;
    }

    // Including template for custom block
    include($block_template);
}


// Post type Select Box Filter
function spinco_get_post_type($field)
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

add_filter('acf/load_field/name=post_type', 'spinco_get_post_type');
