<?php

/**
 * Block Name: Shortcode 
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */


// create id attribute for specific styling
$uid = 'spinco-acf-container-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'spinco-block ' . str_replace('acf/spinco-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= sprintf(' %s', $block['className']);
}


$shortcode_text = get_field('shortcode_text');

?>

<div class=" <?php echo $uid; ?> <?php echo esc_attr($className); ?>">
    <?php if ($shortcode_text) : ?>
        <?= do_shortcode($shortcode_text); ?>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                <?php esc_html_e('No data available to show'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>