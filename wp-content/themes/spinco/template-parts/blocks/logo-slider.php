<?php

/**
 * Block Name: Logo Slider
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 */

// create id attribute for specific styling
$uid = 'spinco-acf-container-' . $block['id'];

$className = 'spinco-block ' . str_replace('acf/spinco-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
?>

<div class="<?php echo $uid; ?> <?php echo esc_attr($className); ?>">
    <?php if (have_rows('logos')) : ?>
        <div id="owl-carousel1" class="owl-carousel owl-theme">
            <?php while (have_rows('logos')) : the_row();
                $logo_img = get_sub_field('logo_icon'); ?>
                <div class="item text-center">
                    <img src="<?php echo $logo_img['url']; ?>" class="mx-auto w-auto" alt="<?php echo the_sub_field('logo_title') ?>">
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
    $(document).ready(function() {
        $('#owl-carousel1').owlCarousel({
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
</script>