<?php

/**
 * Block Name: Stat grid
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

$type = get_field('type');

$className .= ' text-bg-black dark-theme';

$cta_title = get_field('cta_title');

//$cta_button_style = get_field('cta_button_style');
$cta_button_style = 'fill';

$stat_1_title = get_field('stat_1_title');
$stat_1_subtitle = get_field('stat_1_subtitle');
$stat_2_title = get_field('stat_2_title');
$stat_2_subtitle = get_field('stat_2_subtitle');
$stat_3_title = get_field('stat_3_title');
$stat_3_subtitle = get_field('stat_3_subtitle');

if( !empty($stat_1_title) || (empty($stat_2_title) && empty($stat_3_title)) ) {
    $col_class = 'stat1 col-12';
} elseif( !empty($stat_2_title) || (empty($stat_1_title) && empty($stat_3_title)) ) {
    $col_class = 'stat2 col-12';
} elseif( !empty($stat_3_title) || (empty($stat_1_title) && empty($stat_2_title)) ) {
    $col_class = 'stat3 col-12';
}

if( empty($stat_1_title) && (!empty($stat_2_title) && !empty($stat_3_title)) ) {
    $col_class = 'stat16 col-xl-6 col-lg-6 col-md-6';
} elseif( empty($stat_2_title) && (!empty($stat_1_title) && !empty($stat_3_title)) ) {
    $col_class = 'stat26 col-xl-6 col-lg-6 col-md-6';
} elseif( empty($stat_3_title) && (!empty($stat_1_title) && !empty($stat_2_title)) ) {
    $col_class = 'stat36 col-xl-6 col-lg-6 col-md-6';
}

$column_class = "col-12 col-lg-4";

if( !empty($stat_1_title) && !empty($stat_2_title) && !empty($stat_3_title) ) {
    $col_class = 'col-12 col-lg-4 col-md-4';
}

$button_1_text = get_field('cta_1_text');
$button_2_text = get_field('cta_2_text');
$button_1_url = get_field('cta_1_url');
$button_2_url = get_field('cta_2_url');

$button_1_link_type = get_link_type($button_1_url);
$button_2_link_type = get_link_type($button_2_url);

$button_1_link_attributes = '';
$button_2_link_attributes = '';

switch ($button_1_link_type) {
    case 'file':
        $button_1_link_attributes = 'download target="_blank"';
        break;
    case 'external':
        $button_1_link_attributes = 'target="_blank"';
        break;
    default:
        $button_1_link_attributes = '';
}

switch ($button_2_link_type) {
    case 'file':
        $button_2_link_attributes = 'download target="_blank"';
        break;
    case 'external':
        $button_2_link_attributes = 'target="_blank"';
        break;
    default:
        $button_2_link_attributes = '';
}

?>

<div id="<?= $uid; ?>" class="<?= $className; ?> <?php echo ($type == 'Graphic')?'hero-block-height':''; ?>  position-relative <?= ($type == 'Simple') ? ' p-6 ' : ''; ?>">
    <?php if($type == 'Simple') : ?>
        <div class="container position-relative">
            <div class="rounded-4 text-bg-white">
                <div class="row mx-0 px-xl-5 py-xl-3 px-lg-5 py-lg-3 px-md-5 py-md-3 py-sm-6 px-sm-4 align-items-center">
                    <?php if( !empty($stat_1_title) && !empty($stat_1_subtitle) ) { ?>    
                        <div class="<?= $col_class ?> stats text-center ps-0 py-xl-0 py-lg-0 py-md-0 py-sm-3">
                            <h3 class="p-0 m-0 mb-1"><?= $stat_1_title; ?></h3>
                            <p class="m-0"><?= $stat_1_subtitle; ?></p>
                        </div>
                    <?php } ?>
                    <?php if( !empty($stat_2_title) && !empty($stat_2_subtitle) ) { ?>    
                        <div class="<?= $col_class ?> stats text-center border py-xl-0 py-lg-0 py-md-0 py-sm-3">
                            <h3 class="p-0 m-0 mb-1"><?= $stat_2_title; ?></h3>
                            <p class="m-0"><?= $stat_2_subtitle; ?></p>
                        </div>
                    <?php } ?>
                    <?php if( !empty($stat_3_title) && !empty($stat_3_subtitle) ) { ?>
                        <div class="<?= $col_class ?> stats text-center border pe-0 py-xl-0 py-lg-0 py-md-0 py-sm-3">
                            <h3 class="p-0 m-0 mb-1"><?= $stat_3_title; ?></h3>
                            <p class="m-0"><?= $stat_3_subtitle; ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php else :  ?>
        <?php if ($type === 'Graphic') :?>
            <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100">
                <div class="bg-element w-100 h-100 position-absolute" style="background-image: url(<?php echo get_site_url() ?>/wp-content/uploads/2023/11/stat-grid-bg.png); background-position: top right, 0% 0%; background-repeat: no-repeat; "></div>
            </div>
        <?php endif; ?>
        <div class="container position-relative py-xl-10 py-lg-10 py-md-10 py-sm-7">
            <?php if ($cta_title) : ?>
                <h2 class="m-0 mb-4"><?= $cta_title; ?></h2>
            <?php endif;  ?>
            
            <div class="d-sm-block d-md-flex d-flex gap-5 mb-xl-12 mb-lg-12 mb-md-9 mb-sm-7">
                <?php if ($button_1_text && $button_1_url) : ?>
                    <div class="mb-sm-5 mb-md-0">
                        <a href="<?= $button_1_url; ?>" class="btn btn-primary" <?= $button_1_link_attributes ?>>
                        <?= $button_1_text; ?></a>
                    </div>
                <?php endif; ?>
                <?php if ($button_2_text && $button_2_url) : ?>
                    <div class="">
                        <a href="<?= $button_2_url; ?>" class="btn btn-primary" <?= $button_2_link_attributes ?>><?= $button_2_text; ?></a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row mx-0">
                <?php if( !empty($stat_1_title) && !empty($stat_1_subtitle) ) { ?>    
                    <div class="<?= $col_class ?> col-md-12 mb-5 stats">
                        <h3 class="p-0 m-0 mb-3"><?= $stat_1_title; ?></h3>
                        <p class="text-primary m-0"><?= $stat_1_subtitle; ?></p>
                    </div>
                <?php } ?>
                <?php if( !empty($stat_2_title) && !empty($stat_2_subtitle) ) { ?>    
                    <div class="<?= $col_class ?> col-md-12 mb-5 stats">
                        <h3 class="p-0 m-0 mb-3"><?= $stat_2_title; ?></h3>
                        <p class="text-primary m-0"><?= $stat_2_subtitle; ?></p>
                    </div>
                <?php } ?>
                <?php if( !empty($stat_3_title) && !empty($stat_3_subtitle) ) { ?>    
                    <div class="<?= $col_class ?> col-md-12 mb-5 stats">
                        <h3 class="p-0 m-0 mb-3"><?= $stat_3_title; ?></h3>
                        <p class="text-primary m-0"><?= $stat_3_subtitle; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php endif; ?>
</div>