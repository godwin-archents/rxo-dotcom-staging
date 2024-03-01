<?php

/**
 * Block Name: Awards
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

<div class="<?php echo $uid; ?> <?php echo esc_attr($className); ?> px-5 px-md-7 px-xl-9">
    <?php if (have_rows('awards')) : ?>
        <div id="<?php echo $block['id']; ?>" class="owl-carousel owl-theme text-center awards-carousel">
            <?php while (have_rows('awards')) : the_row(); ?>
                <div class="item">
                    <h5 class="pb-7 text-secondary"><?php echo get_sub_field('category_title'); ?></h5>
                    <?php if (have_rows('award_detail')) : ?>
                        <div class="row justify-content-center">
                            <?php
                            while (have_rows('award_detail')) : the_row();
                                $award_img = get_sub_field('award_icon'); ?>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <?php if ($award_img['url']) : ?>
                                        <img src="<?php echo $award_img['url']; ?>" class="mx-auto w-auto" style="height:48px;" />
                                    <?php endif; ?>
                                    <p class="p-2"><?php echo get_sub_field('award_description'); ?></p>
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

<script>
    <?php if (have_rows('awards')) : ?>
        $(document).ready(function() {
            $('#<?= $block['id']; ?>').owlCarousel({
                loop: true,
                autoPlay: 3000,
                margin: 10,
                items: 1,
                nav: true,
                autoHeight: true,
                navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
            });
        });
    <?php endif; ?>
</script>