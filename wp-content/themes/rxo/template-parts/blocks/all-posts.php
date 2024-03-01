<?php

/**
 * Block Name: All Posts
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$uid = $block['anchor'] ?? 'rxo-block-' . str_replace('block_', '', $block['id']);

$className = 'rxo-block-' . str_replace('acf/rxo-acf-', '', $block['name']);

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if( !empty($block['align']) ) {
    $className .= ' ' . $block['align'];
}

$theme = get_field('theme');
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : '');


$post_type = get_field('post_type');
$posts_per_page = get_field('posts_per_page');
$post_categories = get_field('post_categories');
$current_page = 1;

$exclude_resource_POSTID = get_id_by_slug('all-resources','resource_center');
$args = array(
    'posts_per_page'    => $posts_per_page,
    'post_type'         => $post_type,
    'post_status'       => 'publish',
    'has_password'      => FALSE,
    'paged'             => $current_page,
    'orderby'           => 'date',
    'order'             => 'DESC',
);

if($post_type == 'resource_center'){
    $args['meta_query'] = array(
            'relation'      => 'AND',
            array(
                'key'       => 'content_toggles',
                'value'     => 'not_recommendations',
                'compare'   => 'NOT LIKE'
            )
    );

    $args['post__not_in']=array($exclude_resource_POSTID);
}

if ($post_categories) {
    $args['tax_query'] = array(
        'relation' => 'OR'
    );

    foreach ($post_categories as $post_category) {
        $args['tax_query'][] = array(
            'taxonomy' => $post_category->taxonomy,
            'field' => 'slug',
            'terms' => $post_category->slug,
        );
    }
}

// query posts
$query = new WP_Query($args);

$max_pages = $query->max_num_pages;
$is_max_paged = ($max_pages > $current_page) ? false : true;

$all_post_count = count($query->posts); 

$cls_btm_space = 'mb-5';
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="row" id="filtered-results" data-filter-args='<?= base64_encode(json_encode($args)) ?>' data-filter-page="<?= ++$current_page ?>" data-max-paged="<?= $is_max_paged ?>" data-action="rxo_resource_center_filter_posts">
        <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post();
            // echo '<pre>';
            // print_r($query);
            // echo '</pre>';
                // get_template_part('template-parts/filter-templates/post-latest-article', 'news_template', array('display_image' => true));
                get_template_part('template-parts/filter-templates/post-news-article', 'news_template', 
                    array(
                        'post_type' => 'resource_center',
                        'cls_btm_space' => $cls_btm_space,
                    ),
                );
            endwhile; ?>
        <?php elseif (show_block_error()) : ?>
            <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
                <div class="toast-body">
                    No data available
                </div>
            </div>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </div>
    <?php if($all_post_count == 0){ ?>
    <h3 id="empty-results" class="text-danger col-12">No results found.</h3>
    <?php } ?>
    <div id="ajax-loading-error" class="mb-5 text-danger"></div>
    <div id="ajax-loader-message" class="mb-5"></div>
</div>  
