<?php

/**
 * Block Name: Hotline numbers
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
$contact_border = get_field('contact_border');
$contacts_per_row = get_field('contacts_per_row');
$column_class = "col-12 ";
switch ($contacts_per_row) {
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
    <?php if ($section_title) : ?>
        <h3><?= $section_title; ?></h3>
    <?php endif; ?>
    <?php if (have_rows('hotline_numbers')) : ?>
        <div class="row <?= $contacts_per_row == 5 ? 'row-cols-lg-5' : '' ?>">
            <?php while (have_rows('hotline_numbers')) : the_row();
                $address = get_sub_field('address');
            ?>
                <div class="<?= $column_class ?>">
                    <div class="py-3 <?= $contact_border ? 'border-black border-top' : '' ?>">
                        <h4><?= the_sub_field('country') ?></h4>
                        <?php if ($address) : ?>
                            <p class="mb-1"><?= $address ?></p>
                        <?php endif; ?>
                        <?php while (have_rows('phone_numbers')) : the_row(); ?>
                            <p class="mb-1"><a href="tel:<?= the_sub_field('number') ?>" class=" <?= $address ? 'text-inherit text-hover-primary pb-1' : 'btn btn-icon btn-link btn-primary icon-phone'; ?>"><?= the_sub_field('number') ?></a></p>
                        <?php endwhile; ?>
                        <?php while (have_rows('emails')) : the_row(); ?>
                            <p class="mb-1"><a href="mailto:<?= the_sub_field('email') ?>" class=" <?= $address ? 'text-inherit text-hover-primary pb-1' : 'btn btn-icon btn-link btn-primary icon-email'; ?>"><?= the_sub_field('email') ?></a></p>
                        <?php endwhile; ?>
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