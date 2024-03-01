<?php

/**
 * Block Name: Feature Post
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

$selected_post = get_field('post');
$exclude_news_POSTID = get_id_by_slug('press-releases','news_article');

if (!$selected_post || get_post_status($selected_post->ID) != 'publish') {
    $post_arr = wp_get_recent_posts(array('post_type' => 'news_article', 'numberposts' => 1, 'post_status' => 'publish','has_password' => FALSE,'post__not_in'=>[$exclude_news_POSTID]));
    $post = get_post($post_arr[0]['ID']);
}else{
    $post = get_post($selected_post);
}
global $wp_session;
$wp_session['featured_post_id'] = $post->ID;

$post_link = get_the_permalink($post->ID);
$link_attributes = '';
$link_text = 'Read more';

if (get_field('attachment_link', $post->ID)) {
    $post_link = get_field('attachment_link', $post->ID);
    $link_attributes = 'download target="_blank" rel="noopener noreferrer"';
    $link_text = 'Download Report';
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <?php if ($post) : ?>
        <div class="row align-items-center">
            <div class="col-lg-6 col-12">
                <div class="card-image overflow-hidden rounded-4"><?= get_the_post_thumbnail($post->ID); ?></div>
            </div>
            <div class="col-lg-6 col-12">
                <p class="fw-600">Featured</p>
                <h2><?= $post->post_title; ?></h2>
                <p><?= post_excerpt_by_id($post->ID); ?></p>
                <div class="mt-4">
                    <a href="<?= $post_link ?>" class="btn <?= ($theme === 'dark' ? 'btn-primary' : 'btn-secondary') ?>" <?= $link_attributes ?>>
                        <?= $link_text; ?>
                    </a>
                </div>
            </div>
        </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No data available
            </div>
        </div>
    <?php endif; ?>
</div>