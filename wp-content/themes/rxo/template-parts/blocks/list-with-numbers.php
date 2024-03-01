<?php

/**
 * Block Name: List with Numbers
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
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : 'text-bg-white');

// $list_items = get_field('list_items');
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="col-12">
        <?php if (have_rows('list_items')) :
            // loop through the rows of data
            echo '<ol class="list-with-numbers">';
                while (have_rows('list_items')) : the_row(); 
                
                    $list_number = get_sub_field('list_number'); 
                    $list_item = get_sub_field('list_item'); 
                    
                    if(!empty($list_item)) { ?>
                        <li><div class="lnb-list-number"><?php if(!empty($list_number)) { echo $list_number; } ?></div><div class="list-content-sec"><?php echo $list_item; ?></div></li>            
                    <?php }
                endwhile;
            echo '</ol>';
        elseif (show_block_error()) : ?>
            <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
                <div class="toast-body">
                    <?php esc_html_e('No data available to show'); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>