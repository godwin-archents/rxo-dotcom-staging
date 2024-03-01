<?php

/**
 * Block Name: Embed Multilingual
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 */

// create id attribute for specific styling
$uid = 'spinco-block-' . $block['id'];

$className = 'spinco-block ' . str_replace('acf/spinco-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$iframe_alignment = get_field('iframe_alignment');
$align_class = 'iframe-stretch-to-section';

if ($iframe_alignment === 'auto') {
    $align_class = 'iframe-auto-align';
}

if ($iframe_alignment === '4-3') {
    $align_class = 'iframe-ratio-4-3';
}

if ($iframe_alignment === '16-9') {
    $align_class = 'iframe-ratio-16-9';
}

?>

<div class="<?php echo $uid; ?> <?php echo esc_attr($className); ?>">
    <div class="col-12 <?php echo $align_class; ?>">
        <?php if (have_rows('iframes')) : ?>
            <?php while (have_rows('iframes')) : the_row();
                $iframe_code = get_sub_field('iframe_code');
                $language_code = get_sub_field('language_code');
                if ($iframe_code && $language_code->post_content) :
                    echo do_shortcode('[trp_language language="' . $language_code->post_content . '"]' . $iframe_code . '[/trp_language]');
                endif;
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