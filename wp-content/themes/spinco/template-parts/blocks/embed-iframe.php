<?php

/**
 * Block Name: Embed Iframe
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$uid = $block['anchor'] ?? 'spinco-block-' . $block['id'];

$className = 'spinco-block ' . str_replace('acf/spinco-acf-', '', $block['name']);
$className .= ' ' . $block['className'] ?? '';
$className .= ' ' . $block['align'] ?? '';

$mode = get_field('theme');
$className .= ($mode === 'dark') ? ' bg-black text-white' : '';

$iframe_alignment = get_field('iframe_alignment');
$align_class = 'iframe-stretch-to-section';

if ($iframe_alignment === 'auto') {
    $align_class = 'iframe-auto-align';
}

if ($iframe_alignment === '4-3') {
    $align_class = 'iframe-ratio-4-3';
}

if ($iframe_alignment === '16-9') {
    $align_class = 'iframe-ratio-16-9';
}

$iframe_code = get_field('iframe_code');
$iframe_caption = get_field('iframe_caption');
?>

<div id="<?= $uid; ?>" class="my-4 <?= $className; ?>">
    <?php if ($iframe_code) : ?>
        <div class="col-12 <?= $align_class; ?> rounded-4">
            <?= $iframe_code; ?>
        </div>
        <?php if ($iframe_caption) : ?>
            <h4 class="mt-4 p-0"><?= $iframe_caption ?></h4>
        <?php endif ?>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                <?php esc_html_e('No data available to show'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>