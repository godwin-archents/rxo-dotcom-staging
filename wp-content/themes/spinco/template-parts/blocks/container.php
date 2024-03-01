<?php

/**
 * Block Name: Container 
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
if (!empty($block['anchor'])) {
    $uid = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'spinco-block spinco-block-' . str_replace('acf/spinco-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= sprintf(' %s', $block['className']);
}

if (!empty($block['align'])) {
    $className .= sprintf(' align%s', $block['align']);
}

$mode = get_field('theme');
$vertical_padding = get_field('vertical_padding');
$size = get_field('size');
$size_class = 'container';
if($size === 'article'){
    $size_class = 'article-width';
}

if ($mode === 'dark') {
    $className .= ' bg-black text-white ';
}

?>

<div id="<?php echo $uid; ?>" class="<?php echo esc_attr($className); ?>">
    <div class=" <?= $size_class; ?> py-<?php echo $vertical_padding; ?>">
        <InnerBlocks />
    </div>
</div>