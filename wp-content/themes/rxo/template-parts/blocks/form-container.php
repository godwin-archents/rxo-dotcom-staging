<?php

/**
 * Block Name: Form Container 
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

$container_size = get_field('size');

if($container_size=='12-Column') {
    $container_class = 'col-12 col-md-12 col-lg-12 col-xl-12'; 
} else if($container_size=='8-Column') {
    $container_class = 'col-12 col-md-12 col-lg-8 col-xl-8';
} else if($container_size=='6-Column') {
    $container_class = 'col-12 col-md-12 col-lg-6 col-xl-6';
} else if($container_size=='4-Column') {
    $container_class = 'col-12 col-md-12 col-lg-4 col-xl-4';
} else {
    $container_class = 'col-12 col-md-12 col-lg-12 col-xl-12';
}

 
?>

<div id="<?= $uid; ?>" class="<?= $className; ?> position-relative py-6">    
    <div class="container position-relative">
        <div class="mx-auto <?= $container_class; ?>">
            <InnerBlocks />
        </div>
    </div> 
</div>