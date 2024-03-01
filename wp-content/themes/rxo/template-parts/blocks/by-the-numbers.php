<?php

/**
 * Block Name: By the numbers 
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
$block_class = 'col-md-4';

$columns = get_field('columns');

switch ($columns) {
    case 'four':
        $block_class = 'col-md-6 col-lg-3';
        break;
    case 'three':
        $block_class = 'col-md-4';
        break;
    case 'two':
        $block_class = 'col-md-6';
        break;
    default:
        $block_class = 'col-md-4';
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <?php if ($section_title) : ?>
        <h3 class="px-0 mb-0"><?= $section_title; ?></h3>
    <?php endif; ?>
    <div class="row">
        <?php
        // check if the repeater field has rows of data
        if (have_rows('numbers_set')) :
            // loop through the rows of data
            while (have_rows('numbers_set')) : the_row();
        ?>
                <div class="<?= $block_class; ?> mt-3">
                    <div class="border-top border-2 ">
                        <h2 class="<?= $theme === 'dark' ? 'text-primary' : 'text-primary-dark' ?>"><?= the_sub_field('number') ?></h2>
                        <p class="mb-4"><?= the_sub_field('description') ?></p>
                    </div>
                </div>
            <?php
            endwhile;
        elseif (show_block_error()) : ?>
            <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
                <div class="toast-body">
                    <?php esc_html_e('No data available to show'); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>