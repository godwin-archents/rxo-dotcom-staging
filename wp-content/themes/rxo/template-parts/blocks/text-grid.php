<?php

/**
 * Block Name: Highlights
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
$section_description = get_field('section_description');
$section_button_link = get_field('section_button_link');
$section_button_text = get_field('section_button_text');
$card_border = get_field('card_border');
$highlights_per_row = get_field('highlights_per_row');
$column_class = "col-12 ";
switch ($highlights_per_row) {
    case 5:
        $column_class .= "col-md-6 col-lg";
        break;
    case 4:
        $column_class .= "col-md-6 col-lg-3";
        break;
    case 2:
        $column_class .= "col-md-12 col-lg-6";
        break;
    case 1:
        $column_class .= "col-md-12 col-lg-12";
        break;
    default:
        $column_class .= "col-md-6 col-lg-4";
        break;
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="row align-items-center">
        <?php if ($section_title) : ?>
            <div class="col">
                <h3><?= $section_title; ?></h3>
            </div>
        <?php endif; ?>
        <?php if ($section_button_link) : ?>
            <div class="col-auto mb-4 mb-md-0 text-end">
                <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $section_button_link; ?>"><?= $section_button_text; ?></a>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($section_description) : ?>
        <div class="row align-items-center">
            <div class="col-12 col-lg-8 col-xl-6"><?= $section_description; ?></div>
        </div>
    <?php endif; ?>
    <div class="row text-start mt-3 <?= $highlights_per_row === 5 ? 'row-cols-lg-5' : '' ?>">
        <?php
        // check if the repeater field has rows of data
        if (have_rows('highlight_sets')) :
            // loop through the rows of data
            while (have_rows('highlight_sets')) : the_row();
                $title = get_sub_field('title');
                $label = get_sub_field('label');
                $link = get_sub_field('link');
                $description = get_sub_field('description');
                $image_url = get_sub_field('image');
                $image_position = get_sub_field('image_position');
                $button_text = get_sub_field('button_text');
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
                <div class="<?= $column_class ?> mt-6">
                    <div class="d-flex align-items-start <?= $card_border ? 'border-black border-top pt-5' : '' ?>">
                        <?php if ($image_url && ($image_position === 'left')) : ?>
                            <div class="col-3 pe-3">
                                <img class="img-auto img-fluid rounded-4" src="<?= $image_url; ?>" />
                            </div>
                        <?php endif; ?>
                        <div class="col">
                            <?php if ($image_url && ($image_position === 'top')) : ?>
                                <div class="card-image mb-3">
                                    <img class="img-auto img-fluid rounded-4" src="<?= $image_url; ?>" />
                                </div>
                            <?php endif; ?>
                            <?php if ($label) : ?>
                                <h6 class="mt-0"><?= $label ?></h6>
                            <?php endif; ?>
                            <h4 class="post-link-title mt-0">
                                <?php if ($link && $link_type !== 'file') : ?>
                                    <a href="<?= $link ?>" class="inherit-color" <?= $link_attributes ?>>
                                        <?= $title ?>
                                    </a>
                                <?php else : ?>
                                    <?= $title ?>
                                <?php endif; ?>
                            </h4>
                            <?php if ($description) : ?>
                                <p><?= $description ?></p>
                            <?php endif; ?>
                            <?php if ($link && $button_text) : ?>
                                <div class="mt-3">
                                    <a href="<?= $link ?>" class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" <?= $link_attributes ?>>
                                        <?= $button_text ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if ($image_url && ($image_position === 'bottom')) : ?>
                                <div class="card-image mt-3">
                                    <img class="img-auto img-fluid rounded-4" src="<?= $image_url; ?>" />
                                </div>
                            <?php endif; ?>
                        </div>
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