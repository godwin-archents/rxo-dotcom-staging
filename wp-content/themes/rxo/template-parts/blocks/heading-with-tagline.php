<?php

/**
 * Block Name: Heading with Tagline
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

$card_border = get_field('card_border');
$cards_per_row = get_field('cards_per_row');

$column_class = "col-6 ";
switch ($cards_per_row) {
    case 5:
        $column_class .= "col-lg-6 col-md-6 col-lg";
        break;
    case 4:
        $column_class .= "col-lg-6 col-md-6 col-lg-3";
        break;
    case 2:
        $column_class .= "col-lg-6 col-md-6 col-lg-6";
        break;
    case 1:
        $column_class .= "col-lg-6 col-md-6 col-lg-12";
        break;
    default:
        $column_class .= "col-lg-6 col-md-6 col-lg-4";
        break;
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="row text-start mt-3 <?= $cards_per_row === 5 ? 'row-cols-lg-5' : '' ?>">
        <?php
        // check if the repeater field has rows of data
        if (have_rows('cards_fields')) :
            // loop through the rows of data
            while (have_rows('cards_fields')) : the_row();

                $card_title = get_sub_field('card_title');
                $card_title_heading_type = get_sub_field('card_title_heading_type');
                $card_tagline = get_sub_field('card_tagline'); 
                ?>
                <div class="<?= $column_class ?> mt-4">
                    <div class="d-flex align-items-start <?= $card_border ? 'border-black border-top pt-3' : '' ?>">
                        <div class="col">
                            <?php if (!empty($card_title_heading_type)) {
                                if(!empty($card_title)) {
                                    echo $card_heading_tag = '<'.$card_title_heading_type.' class="text-primary-dark post-link-title mt-0">'.$card_title.'</'.$card_title_heading_type.'>';
                                }
                            }
                            if(!empty($card_tagline)) {
                                echo '<p>'.$card_tagline.'</p>';
                            } ?>
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