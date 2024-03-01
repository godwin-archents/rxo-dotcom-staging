<?php

/**
 * Block Name: Awards Enhanced
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

$auto_rorate = get_field('auto_rorate');
$size = get_field('size');
$section_title = get_field('award_section_title');

?>

<div id="<?= $uid; ?>" class="<?= $className; ?> px-5 px-md-7 px-xl-9 py-6">
    <?php if ($section_title) : ?>
        <div class="container position-relative">
            <h3 class="wp-block-heading has-text-align-center"><?= $section_title; ?></h3>
        </div>
    <?php endif; ?>
    <?php if (have_rows('awards')) : ?>
        <div id="carousel-<?= $block['anchor'] ?? $block['id']; ?>" class="owl-carousel owl-theme text-center awards-carousel owl-loaded owl-drag">
            <?php while (have_rows('awards')) : the_row(); ?>
                <div class="item">
                    <h5 class="pb-7 text-secondary" style="color:#00A86B !important;"><?= get_sub_field('category_title'); ?></h5>
                    <?php if (have_rows('award_detail')) : ?>
                        <div class="row justify-content-center">
                            <?php
                            while (have_rows('award_detail')) : the_row();
                                $award_img = get_sub_field('award_icon');
                                $award_title = get_sub_field('award_title');
                            ?>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <?php if ($award_img['url']) : ?>
                                        <img src="<?= $award_img['url']; ?>" class="mx-auto w-auto" style="height:48px;" />
                                    <?php endif; ?>
                                    <?php if ($award_title) : ?>
                                        <h6><?= $award_title ?></h6>
                                    <?php endif; ?>
                                    <p class="p-2"><?= get_sub_field('award_description'); ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                <?php esc_html_e('No data available to show'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php $count = count(get_field('awards')); ?>
<script>
    <?php if($count>1) : ?>
    <?php if (have_rows('awards')) : ?>

        <?php if ($auto_rorate=='No') : ?>
            $(document).ready(function() {
                $('#carousel-<?= $block['anchor'] ?? $block['id']; ?>').owlCarousel({
                    loop: true,
                    autoPlay: false,
                    margin: 10,
                    items: 1,
                    nav: true,
                    autoHeight: true,
                    navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
                });
            });
        <?php endif; ?>
        <?php if ($auto_rorate=='Yes') : ?>
            $(document).ready(function() {
                $('#carousel-<?= $block['anchor'] ?? $block['id']; ?>').owlCarousel({
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplaySpeed: 5000,
                    autoplayHoverPause: false,
                    margin: 10,
                    items: 1,
                    nav: true,
                    autoHeight: true,
                    navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
                });
            });
        <?php endif; ?>

    <?php endif; ?>
    <?php else : ?>
        $(document).ready(function() {
            $('#carousel-<?= $block['anchor'] ?? $block['id']; ?>').show();
        });     
    <?php endif; ?>
</script>