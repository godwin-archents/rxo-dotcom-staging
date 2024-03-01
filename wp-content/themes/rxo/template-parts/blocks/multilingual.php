<?php

/**
 * Block Name: Multilingual
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

// $current_language = get_locale();
$current_language = trp_get_locale();
$current_language_selector = 'current_language';
$display_languages = get_field('display_languages');

$allowed = wp_list_pluck($display_languages, 'post_content');

$display_content = count($allowed) ? false : true;

if (in_array($current_language_selector, $allowed) || in_array($current_language, $allowed)) {
    $display_content = true;
}

if (acf_is_block_editor()) {
    $display_content = true;
}

?>
<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <?php if ($display_content) : ?>
        <InnerBlocks />
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                <?php esc_html_e('No data available to show'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>