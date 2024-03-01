<?php

/**
 * Block Name: Driver Dispatch
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 */

// create id attribute for specific styling
$uid = 'spinco-acf-container-' . $block['id'];

$className = 'spinco-block ' . str_replace('acf/spinco-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$dirver_dispatch_title = get_field('dirver_dispatch_title');
?> 

<div class="<?php echo $uid; ?> <?php echo esc_attr($className); ?>">
<?php if ($dirver_dispatch_title) : ?>
        <div class="row">

        DESIGN HERE

        </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                <?php esc_html_e('No data available to show'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>