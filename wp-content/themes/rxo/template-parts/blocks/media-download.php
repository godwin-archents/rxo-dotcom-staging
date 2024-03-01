<?php

/**
 * Block Name: Media download
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
$package_link = get_field('package_link');
$package_link_text = get_field('package_link_text');
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="row align-items-center">
        <?php if ($section_title || $package_link) : ?>
            <div class="col mb-3">
                <h3><?= $section_title; ?></h3>
            </div>
        <?php endif; ?>
        <?php if ($package_link) : ?>
            <div class="col-auto mb-3 text-end">
                <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $package_link; ?>" download target="_blank" rel="noopener noreferrer"><?= $package_link_text; ?></a>
            </div>
        <?php endif; ?>
    </div>

    <?php
    // check if the repeater field has rows of data
    if (have_rows('media_list')) : ?>
        <div class="row">
            <?php
            // loop through the rows of data
            while (have_rows('media_list')) : the_row();

                $media_poster_url = get_template_directory_uri() . '/images/thumbnail.png';
                $media_poster_alt = 'thumbnail';

                $media = get_sub_field('media');
                $media_url = $media['url'];
                $media_title = $media['title'];
                $media_caption = $media['caption'];
                if (empty($media_caption)) {
                    $media_caption = $media_title;
                }

                if ($media['type'] == 'image') {
                    $media_poster_url = $media['url'];
                    $media_poster_alt = $media['alt'];
                }

                $media_poster = get_sub_field('media_poster');
                if ($media_poster) {
                    $media_poster_url = $media_poster['url'];
                    $media_poster_alt = $media_poster['alt'];
                }

                $width_class = '';
                if (get_sub_field('auto_width')) {
                    $width_class = 'w-auto';
                }
            ?>
                <div class="col-12 col-md-6 col-lg-4 mb-5">
                    <div class="media-container overflow-hidden position-relative">
                        <div class="inner-container position-absolute top-0 end-0 bottom-0 start-0">
                            <div class="centered w-100 h-100 position-absolute top-0 start-0">
                                <img class="img-fluid <?= $width_class; ?>" src="<?= esc_url($media_poster_url); ?>" alt="<?= esc_attr($media_poster_alt); ?>" />
                            </div>
                            <div class="media-cover p-4 text-bg-dark bg-opacity-75 d-flex align-items-start flex-column justify-content-between position-absolute end-0 bottom-0 start-0">
                                <div class="fs-5 overflow-hidden"><?= esc_html($media_caption); ?></div>
                                <a class="btn btn-link btn-secondary btn-icon icon-download" href="<?= esc_url($media_url); ?>" download target="_blank" rel="noopener noreferrer">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
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