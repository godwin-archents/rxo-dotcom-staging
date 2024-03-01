<?php

/**
 * Block Name: Tabs
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
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <?php
    // check if the repeater field has rows of data
    if (have_rows('tabs')) : ?>
        <div class="nav nav-tabs justify-content-center flex-wrap border-0 border-bottom" id="tabs_<?= $uid; ?>" role="tablist">
            <?php
            while (have_rows('tabs')) : the_row();
                $tab_title = get_sub_field('tab_title');
            ?>
                <button class="nav-link bg-transparent fw-600 <?= get_row_index() === 1 ? 'active' : '' ?>" id="tab-<?= get_row_index(); ?>" data-bs-toggle="tab" data-bs-target="#tab-<?= get_row_index(); ?>-pane" type="button" role="tab" aria-controls="tab-<?= get_row_index(); ?>-pane" aria-selected="<?= get_row_index() === 1 ? 'true' : 'false' ?>"><?= $tab_title ?></button>
            <?php endwhile; ?>
        </div>
        <div class="tab-content pt-4 pt-md-3 " id="tabs_<?= $uid; ?>Content">
            <?php
            while (have_rows('tabs')) : the_row();
                $tab_content = get_sub_field('tab_content');
            ?>
                <div class="tab-pane fade <?= get_row_index() === 1 ? 'show active' : '' ?>" id="tab-<?= get_row_index(); ?>-pane" role="tabpanel" aria-labelledby="tab-<?= get_row_index(); ?>" tabindex="0"><?= $tab_content ?></div>
            <?php endwhile; ?>
        </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No data available
            </div>
        </div>
    <?php endif; ?>
</div>