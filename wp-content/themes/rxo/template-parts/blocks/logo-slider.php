<?php

/**
 * Block Name: Logo Slider
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

//$theme = get_field('theme');
//$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : '');
$section_title = get_field('logo_section_title');
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <?php if ($section_title) : ?>
        <div class="container position-relative">
            <h3 class="wp-block-heading has-text-align-center"><?= $section_title; ?></h3>
        </div>
    <?php endif; ?>
    <?php if (have_rows('logos')) : ?>
        <div id="carousel-<?= $block['anchor'] ?? $block['id']; ?>" class="owl-carousel owl-theme owl-loaded owl-drag">
            <?php while (have_rows('logos')) : the_row();
                $logo_img = get_sub_field('logo_icon'); ?>
                <div class="item text-center">
                    <img src="<?= $logo_img['url']; ?>" class="mx-auto w-auto" alt="<?= the_sub_field('logo_title') ?>" loading="lazy" />
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
    <?php if (have_rows('logos')) : ?>
        $(document).ready(function() {
            $('#carousel-<?= $block['anchor'] ?? $block['id']; ?>').owlCarousel({
                loop: true,
                autoplay: true,
                slideTransition: 'linear',
                autoplayTimeout: 2500,
                autoplaySpeed: 2500,
                autoplayHoverPause: false,
                margin: 10,
                nav: false,
                dots: false,
                rtl: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1300: {
                        items: 6
                    }
                }
            });
        });
    <?php endif; ?>
</script>