<?php

/**
 * Block Name: Shortcode 
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
$className .= ' ' . $block['className'] ?? '';
$className .= ' ' . $block['align'] ?? '';

$theme = get_field('theme');
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : '');

$section_title = get_field('section_title');
$max_post_count = 3;

$current_post_id = get_the_ID();
$current_post_id = empty($current_post_id) ? my_acf_post_id() : $current_post_id;
$excluded_post_ids = [$current_post_id];

$args = array(
    "post_type" => get_post_type($current_post_id),
    'post_status' => 'publish',
    'posts_per_page' => $max_post_count,
    'post__not_in' => $excluded_post_ids
);

$related = new WP_Query();

$taxonomies = get_post_taxonomies($current_post_id);

if (in_array('post_tag', $taxonomies)) {
    $tags = wp_get_post_terms($current_post_id, 'post_tag', array('fields' => 'ids'));
    if ($tags && count($tags)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'post_tag',
            'field' => 'id',
            'terms' => $tags
        );

        $tag_related = new WP_Query($args);
        $related->posts = $tag_related->posts;
        $related->post_count = count($related->posts);
    }
}

if ($related->post_count < $max_post_count) {
    $args['tax_query'] = [];
    foreach ($taxonomies as $taxonomy) {
        if ($taxonomy != 'post_tag') {
            // get array of ids of selected taxonomies
            $terms = wp_get_post_terms($current_post_id, $taxonomy, ['fields' => 'ids']);
            if ($terms && count($terms)) {
                $args['tax_query'][] = array(
                    'taxonomy' => $taxonomy,
                    'field' => 'id',
                    'terms' => $terms
                );
            }
        }
    }

    $args['posts_per_page'] = $max_post_count - $related->post_count;
    $args['post__not_in'] = array_merge($excluded_post_ids, wp_list_pluck($related->posts, 'ID'));

    $tax_related = new WP_Query($args);
    if ($related->post_count > 0) {
        $related->posts = array_merge($related->posts, $tax_related->posts);
    } else {
        $related->posts = $tax_related->posts;
    }
    $related->post_count = count($related->posts);
}

?>

<div class="<?php echo $uid; ?> <?php echo esc_attr($className); ?>">
    <?php if ($related->have_posts()) : ?>
        <div class="row align-items-center">
            <?php if ($section_title) : ?>
                <div class="col">
                    <h2 class="py-3"><?php echo $section_title; ?></h2>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php
            while ($related->have_posts()) : $related->the_post();
                get_template_part('template-parts/filter-templates/post-news-article', 'news_template', array('display_image' => true));
            endwhile;
            ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No data available
            </div>
        </div>
    <?php endif; ?>
</div>