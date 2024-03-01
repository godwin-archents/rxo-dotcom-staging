<?php

/**
 * Block Name: Button
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 */

// create id attribute for specific styling
$uid = 'spinco-block-' . $block['id'];

$className = 'spinco-block ' . str_replace('acf/spinco-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$button_text = get_field('button_text');
$button_link = get_field('button_link');
$button_style = get_field('button_style');
$button_target = get_field('button_target');
$button_id = get_field('button_id');
$btn_class = "btn btn-primary btn-theme";

switch ($button_style) {
    case 'outline':
        $btn_class = "btn btn-outline-primary";
        break;
    case 'link':
        $btn_class = "btn btn-link btn-arrow text-decoration-underline px-0";
        break;
    case 'download':
        $btn_class = "btn btn-link btn-arrow-down text-decoration-underline px-0";
        break;
    default:
        $btn_class = "btn btn-primary";
}

?>

<div class="py-3 <?php echo $uid; ?> <?php echo esc_attr($className); ?>">
    <a class="<?php echo $btn_class; ?>" href="<?php echo $button_link; ?>" target="<?php echo $button_target; ?>" <?php echo $button_id ? 'id="' . $button_id . '"' : ''; ?> ><?php echo $button_text; ?></a>
</div>