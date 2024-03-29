<?php

/**
 * Block Name: quotes
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
$count = count(get_field('quotes'));
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <?php if ($section_title) : ?>
        <h2 class="mb-2 pb-5 pb-lg-6"><?= $section_title; ?></h2>
    <?php endif; ?>
    <?php if (have_rows('quotes')) : ?>
        <div id="carousel-<?= $block['anchor'] ?? $block['id']; ?>" class="<?= ($count > 1) ? 'owl-carousel owl-theme quote-carousel' : '' ?>">
            <?php while (have_rows('quotes')) : the_row(); ?>
                <div class="item">
                    <div class="rounded-5 p-5 px-3 px-md-5 px-xl-6 py-xl-5 bg-100">
                        <span class="display-3 text-primary-dark m-0 lh-1 fst-italic fw-bold">“</span>
                        <div class="mb-xl-2 pb-md-5 pb-xl-6 <?= ($count > 1) ? 'fs-quote' : 'h3' ?>"><?= get_sub_field('quote') ?></div>
                        <h5 class="m-0"><?= get_sub_field('person_name') ?></h5>
                        <p class="mb-0 mb-xl-2"><?= get_sub_field('person_title') ?></p>
                    </div>
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

<script>
    <?php if ($count > 1) : ?>
        <?php if (have_rows('quotes')) : ?>
            $(document).ready(function() {
                $('#carousel-<?= $block['anchor'] ?? $block['id']; ?>').owlCarousel({
                    loop: true,
                    margin: 32,
                    nav: true,
                    dots: false,
                    autoHeight: false,
                    navText: [
                        "<div class='nav-btn prev-slide'></div>",
                        "<div class='nav-btn next-slide'></div>",
                    ],
                    responsive: {
                        0: {
                            items: 1.3,
                        },
                        600: {
                            items: 1.4,
                        },
                        800: {
                            items: 1.5,
                        },
                        1300: {
                            items: 1.7,
                        },
                    },
                });
            });
        <?php endif; ?>
    <?php else : ?>
        $(document).ready(function() {
            $('#carousel-<?= $block['anchor'] ?? $block['id']; ?>').show();
        });
    <?php endif; ?>
</script>