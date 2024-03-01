<?php

/**
 * Block Name: Curated Series 
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

//[125,105]
$selected_posts = get_field('posts');

$button_text = get_field('button_text');
$button_link = get_field('button_link');
$button_id = get_field('button_id');

$max_post_count = 3;
$post_type = 'resource_center';

// Get the current article ID
$current_article_id = get_the_ID();
$exclude_resource_POSTID = get_id_by_slug('all-resources','resource_center');

$excluded_post_ids = (!empty($selected_posts))?array_merge([$current_article_id], $selected_posts):array_merge([$exclude_resource_POSTID],[$current_article_id]);

$post_ids = (!empty($selected_posts))?$selected_posts:'';
$selected_post_count = (!empty($selected_posts))?count($selected_posts):'0';

if ($selected_post_count < $max_post_count) {
    $args = array(
        "post_type" => $post_type,
        'post_status' => 'publish',
        'has_password' => FALSE,
        'posts_per_page' => $max_post_count - $selected_post_count,
        'meta_query'    => array(
            'relation'      => 'AND',
            array(
                'key'       => 'content_toggles',
                'value'     => 'not_recommendations',
                'compare'   => 'NOT LIKE'
            )

        )
    );
    $args['post__not_in'] = $excluded_post_ids;

    $post_category = wp_get_post_terms($current_article_id, $post_type == 'resource_center' ? 'resource_center_category' : 'news_category', array('fields' => 'ids'));

    if ($post_category) {
        $args['tax_query'] = array(
            'relation' => 'OR',
        );

        $args['tax_query'][] = array(
            'taxonomy' => 'resource_center_category',
            'field'    => 'id',
            'terms'    => $post_category,
            'operator' => 'IN',
        );
    }
    
    $rc_curated_posts = new WP_Query($args);  
    $post_ids = (!empty($selected_posts))?array_merge($selected_posts, wp_list_pluck($rc_curated_posts->posts, 'ID')):$rc_curated_posts->posts;
}

$cls_cat_name_min_read = 'mb-3';
$cls_desc_section = 'my-3';
$cls_mb_curated = 'mb-5';

?>

<div class="<?php echo $uid; ?> <?php echo esc_attr($className); ?> rc-curated-series">
    <div class="row mt-3-5 mb-6 heading-with-link-end align-items-center">
        <?php if ($section_title) : ?>
            <div class="col-xl-9 col-lg-9 col-md-8 col-12">
                <h3 class="m-0"><?php echo $section_title; ?></h3>
            </div>
        <?php endif; ?>
        <div class="col-xl-3 col-lg-3 col-md-4 col-12 mb-4 mb-md-0 text-end">
            <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
        </div>
    </div>
    <?php if (count($post_ids)) : ?>
        <div class="row mb-11-5">
            <?php
            foreach ($post_ids as $post_id) {
                get_template_part(
                    'template-parts/filter-templates/post-news-article',
                    'news_template',
                    array(
                        'post_type' => 'resource_center',
                        'display_image' => true,
                        'post_layout' => 'three-posts',
                        'post_count' => 3,
                        'theme' => $theme,
                        'id' => $post_id,
                        'cls_cat_name_min_read' => $cls_cat_name_min_read,
                        'cls_desc_section' => $cls_desc_section,
                        'cls_mb_curated' => $cls_mb_curated,
                    )
                );
            }
            ?>
        </div>
        <?php if ($button_placement === 'bottom') : ?>
            <div class="my-5 text-center">
                <a class="btn btn-primary" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
            </div>
        <?php endif; ?>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No data available
            </div>
        </div>
    <?php endif; ?>
</div>
