<?php

/**
 * Block Name: Latest Articles
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

if( !empty($block['className']) ) { $className .= ' ' . $block['className']; }

if( !empty($block['align']) ) { $className .= ' ' . $block['align']; }

$theme = get_field('theme');
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : '');

$section_title = get_field('section_title');
$button_text = get_field('button_text');
$button_link = get_field('button_link');
$button_id = get_field('button_id');
$exclude_resource_POSTID = get_id_by_slug('all-resources','resource_center');

$excluded_post_ids = (!empty($selected_posts))?array_merge([$exclude_resource_POSTID],[$current_article_id], $selected_posts):array_merge([$exclude_resource_POSTID],[$current_article_id]);

$args = array(
    'post_type' => 'resource_center',
    'post_status' => 'publish',
    'has_password' => FALSE,
    'orderby' => 'date', 
    'order' => 'DESC',
    'posts_per_page' => 3,
    'post__not_in' => $excluded_post_ids,
    'meta_query' => array (
        'relation' => 'AND',
            array (
                'key' => 'content_toggles',
                'value' => 'not_recommendations',
                'compare' => 'NOT LIKE',
            ),

            array(
                'key'       => 'content_toggles',
                'value'     => 'featured',
                'compare'   => 'NOT LIKE',
            ),
    ),
);


$latest_posts = get_posts($args);


$cls_la_mb_space = ' mb-xl-0 mb-lg-0 mb-sm-5';
?>

<div id="<?= $uid; ?>" class="<?= $className; ?> position-relative rc-latest-articles py-6">

    <?php if ( !empty($section_title) || !empty($button_link) ) : ?>
        <div class="row align-items-center mb-6">
            <div class="col-xl-10 col-lg-9 col-md-8 col-12">
                <h3 class="m-0"><?= $section_title; ?></h3>
            </div>
            
            <div class="col-xl-2 col-lg-3 col-md-4 col-12 text-end">
                <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
            </div>
        </div>
    <?php endif; ?>    
    <?php if ($latest_posts) : ?>
        <div class="row mb-4-5">
            <?php foreach($latest_posts as $post):
                get_template_part(
                    'template-parts/filter-templates/post-news-article',
                    'news_template',
                    array(
                        'post_type' => 'resource_center',
                        'theme' => $theme,
                        'id' => $post->ID,
                        'cls_la_mb_space' => $cls_la_mb_space,
                    )
                );
            endforeach;
            ?>
        </div>
        <?php wp_reset_postdata(); ?>
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