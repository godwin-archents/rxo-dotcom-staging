<?php

/**
 * Block Name: CTA Banner
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
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : 'text-bg-white');

$section_title = get_field('section_title');
$section_description = get_field('section_description');
$large_banner = get_field('large_banner')
?>

<div id="<?= $uid; ?>" class="<?= $className; ?> row gx-3 align-items-center overflow-hidden <?= $large_banner ? 'large-banner py-3' : 'py-3 px-2 px-md-3 px-lg-5 mx-0 rounded-4' ?>">
    <div class="col-12 <?= $large_banner ? 'col-md-9 col-lg-6' : 'col-md-6' ?>">
        <?php if ($section_title) : ?>
            <h4><?= $section_title; ?></h4>
        <?php endif; ?>
        <?php if ($section_description) : ?>
            <p><?= $section_description; ?></p>
        <?php endif; ?>
    </div>
    <div class="col-12 <?= $large_banner ? 'col-md-12 col-lg-6 gap-lg-0 justify-content-lg-end align-content-md-end flex-column flex-md-row flex-lg-column' : 'col-md-6 justify-content-md-end flex-column flex-md-row' ?> d-flex flex-wrap gap-md-3">
        <InnerBlocks allowedBlocks="<?= esc_attr(wp_json_encode(['acf/rxo-acf-button'])); ?>" />
    </div>
</div>