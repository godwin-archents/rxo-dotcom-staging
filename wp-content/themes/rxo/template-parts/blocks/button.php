<?php

/**
 * Block Name: Button
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

$button_text = get_field('button_text');
$button_link = get_field('button_link');
$button_target = get_field('button_target');

$button_theme = get_field('button_theme');
$button_style = get_field('button_style');
$button_size = get_field('button_size');
$button_icon = get_field('button_icon');
$button_class = get_field('button_class');

$button_id = get_field('button_id');

$btn_class = "btn btn-";

switch ($button_style) {
    case 'outline':
        $btn_class .= "outline-";
        break;
    case 'link':
        $btn_class .= "link btn-";
        break;
    default:
        $btn_class .= "";
}

$btn_class .= $button_theme;
$btn_class .= " " . $button_size;
$btn_class .= $button_icon ? " btn-icon " . $button_icon : "";
$btn_class .= " " . $button_class;

?>

<div id="<?= $uid; ?>" class="py-3 <?= $className; ?>">
    <a class="<?= $btn_class; ?>" href="<?= $button_link; ?>" target="<?= $button_target; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
</div>