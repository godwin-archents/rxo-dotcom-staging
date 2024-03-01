<?php

/**
 * Block Name: FAQ
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
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : 'text-bg-white';

$title = get_field('title');
?>

<div id="<?= $uid; ?>" class="<?= $className; ?> rxo-block-accordion <?=($theme === 'light')?'faq-icon-black' : '' ?>">
<div class="container position-relative  py-6 d-flex flex-column">
    <?php if ($title) : ?>
        <h2 class="px-0 mb-0"><?= $title; ?></h2>
    <?php endif; ?>
    <?php if (have_rows('slides')) : ?>
        <div class="position-relative">
            <div class="accordion" id="accordion_<?= $block['id'] ?>">
                <?php while (have_rows('slides')) : the_row();
                ?>
                    <div class="accordion-item">
                        <h4 class="accordion-header my-0 py-3" id="item_<?= $uid; ?>_<?= get_row_index(); ?>">
                            <button class="accordion-button <?= get_row_index() === 1 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#details_<?= $uid; ?>_<?= get_row_index(); ?>" aria-expanded="<?= get_row_index() === 1 ? 'true' : 'false'; ?>" aria-controls="details_<?= $uid; ?>_<?= get_row_index(); ?>">
                                <?= the_sub_field('slide_title') ?>
                            </button>
                        </h4>
                        <div id="details_<?= $uid; ?>_<?= get_row_index(); ?>" class="accordion-collapse collapse <?= get_row_index() === 1 ? 'show' : ''; ?>" aria-labelledby="item_<?= $uid; ?>_<?= get_row_index(); ?>" data-bs-parent="#accordion_<?= $block['id'] ?>">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 col-lg-6 col-xl-12 accordion-content order-lg-1">
                                        <?= the_sub_field('slide_copy') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                <?php esc_html_e('No data available to show'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>