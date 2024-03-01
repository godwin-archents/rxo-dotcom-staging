<?php

/**
 * Block Name: Card Grid
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

if($theme === 'dark'){
    $className .= ' text-bg-black dark-theme';
    $borderColor = ' border-white';
} else {
    $className .= ' text-bg-white';
    $borderColor = ' border-black';
}

$section_title = get_field('section_title');
$section_image = get_field('section_image');
$section_button_link = get_field('section_button_link');
$section_button_text = get_field('section_button_text');
$cards_per_row = get_field('cards_per_row');
$card_image = get_field('card_image');

$column_class = "col-12 ";
switch ($cards_per_row) {
    case 3:
        $column_class .= "col-md-6 col-lg-4";
        break;
    case 2:
        $column_class .= "col-md-12 col-lg-6";
        break;
    default:
        $column_class .= "col-md-6 col-lg-4";
        break;
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="container position-relative pt-6 pb-4 d-flex flex-column">
        <div class="row align-items-center pb-4">
            <?php if ($section_title) : ?>
                <div class="col">
                    <h3 class="m-0"><?= $section_title; ?></h3>
                </div>
            <?php endif; ?>
            <?php if ($section_button_link) : ?>
                <div class="col-auto mb-4 mb-md-0 text-end">
                    <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $section_button_link; ?>"><?= $section_button_text; ?></a>
                </div>
            <?php endif; ?>
        </div>
        <div class="row text-start <?= $cards_per_row === 3 ? 'row-cols-lg-4' : '' ?>">
            <?php
            // check if the repeater field has rows of data
            if (have_rows('card_sets')) :
                // loop through the rows of data
                while (have_rows('card_sets')) : the_row();
                    $title = get_sub_field('title');
                    $category = get_sub_field('category');
                    $link = get_sub_field('link');
                    $image_url = get_sub_field('image');
                    $description = get_sub_field('description');
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
                    <div class="<?= $column_class ?> py-4">
                        <div class="d-flex align-items-start <?= ($card_image === 'no')?$borderColor:''; ?><?= ($card_image === 'no') ? ' border-top pt-5' : '' ?>">
                            <div class="col">
                            <?php if ($image_url && ($card_image === 'yes')) : ?>
                                    <div class="card-image mb-4 overflow-hidden rounded-4 ratio ratio-16x9">
                                        <img src="<?= $image_url; ?>" />
                                    </div>
                                <?php endif; ?>
                                <?php if ($category) : ?>
                                    <h6 class="mt-0 subheading-primary"><?= $category ?></h6>
                                <?php endif; ?>
                                <h4 class="post-link-title mt-0"><?= $title ?></h4>
                                <?php /* if ($description) : ?>
                                    <p><?php if($cards_per_row == 2) {
                                        echo wp_trim_words($description , 10); 
                                    } else {  
                                        echo wp_trim_words($description , 15 ); 
                                    } ?></p>
                                <?php endif; */ ?>
                                <?php if ($description) : ?>
                                    <p><?php echo $description; ?></p>
                                <?php endif; ?>
                                <?php if ($link && $button_text) : ?>
                                    <div class="mt-3">
                                        <a href="<?= $link ?>" class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" <?= $link_attributes ?>>
                                            <?= $button_text ?>
                                        </a>
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
</div>