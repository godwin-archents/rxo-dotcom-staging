<?php

/**
 * Block Name: Accordion
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

$section_title = get_field('section_title');
$section_tag = get_field('section_tag');
$complex_accordion = get_field('complex_accordion');
$default_image = get_field('default_image');
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <?php if ($section_tag) : ?>
        <h6 class="my-0"><?= $section_tag; ?></h6>
    <?php endif; ?>
    <?php if ($section_title) : ?>
        <h2 class="px-0 mb-0"><?= $section_title; ?></h2>
    <?php endif; ?>
    <?php if (have_rows('accordion_items')) : ?>
        <div class="position-relative">
            <div class="accordion <?= $complex_accordion ? 'complex-accordion' : '' ?>" id="accordion_<?= $block['id'] ?>">
                <?php while (have_rows('accordion_items')) : the_row();
                    $link = get_sub_field('button_url');
                    $link_type = get_link_type($link);
                    $link_attributes = '';
                    switch ($link_type) {
                        case 'file':
                            $link_attributes = 'download target="_blank"';
                            break;
                        case 'external':
                            $link_attributes = 'target="_blank"';
                            break;
                        default:
                            $link_attributes = '';
                    }
                ?>
                    <div class="accordion-item">
                        <h4 class="accordion-header my-0 py-3" id="item_<?= get_row_index(); ?>">
                            <button class="accordion-button <?= get_row_index() === 1 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#details_<?= get_row_index(); ?>" aria-expanded="<?= get_row_index() === 1 ? 'true' : 'false'; ?>" aria-controls="details_<?= get_row_index(); ?>">
                                <?= the_sub_field('item_title') ?>
                            </button>
                        </h4>
                        <div id="details_<?= get_row_index(); ?>" class="accordion-collapse collapse <?= get_row_index() === 1 ? 'show' : ''; ?>" aria-labelledby="item_<?= get_row_index(); ?>" data-bs-parent="#accordion_<?= $block['id'] ?>">
                            <div class="accordion-body">
                                <div class="row">
                                    <?php if (get_sub_field('item_image')) : ?>
                                        <div class="col-12 col-lg-6 col-xl-12 accordion-image d-none d-md-block order-lg-2 mb-md-3 mb-md-0">
                                            <img src="<?= the_sub_field('item_image') ?>" class="img-fluid rounded-4" />
                                        </div>
                                    <?php elseif ($default_image && $complex_accordion) : ?>
                                        <div class="col-12 col-lg-6 col-xl-12 accordion-image d-none d-lg-block d-xl-none order-lg-2 mb-md-3 mb-md-0">
                                            <img src="<?= $default_image ?>" class="img-fluid rounded-4" />
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-12 col-lg-6 col-xl-12 accordion-content order-lg-1">
                                        <?= the_sub_field('item_content') ?>
                                        <?php if ($link) : ?>
                                            <div class="my-3">
                                                <a href="<?= $link ?>" class="btn btn-primary" <?= $link_attributes ?>><?= the_sub_field('button_text') ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php if ($default_image && $complex_accordion) : ?>
                <div class="accordion-image-placeholder">
                    <div class="row">
                        <div class="col-12 accordion-image mb-md-3">
                            <img src="<?= $default_image ?>" class="img-fluid rounded-4" />
                        </div>
                    </div>
                </div>
                <script>
                    if ($(window).width() > 1299) {
                        $('#accordion_<?= $block['id'] ?>').on('hidden.bs.collapse', function(e) {
                            const ele = this;
                            if (!$(ele).find('[aria-expanded=true]').length) {
                                $(ele).siblings('.accordion-image-placeholder').addClass('show');
                            }
                        }).on('show.bs.collapse', function(e) {
                            const ele = this;
                            if ($(e.target).find('.accordion-image').length) {
                                $(ele).siblings('.accordion-image-placeholder').removeClass('show');
                            } else {
                                $(ele).siblings('.accordion-image-placeholder').addClass('show');
                            }
                        });
                    }
                </script>
            <?php endif; ?>
        </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                <?php esc_html_e('No data available to show'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>