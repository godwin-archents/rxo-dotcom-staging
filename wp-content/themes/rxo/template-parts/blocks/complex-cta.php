<?php

/**
 * Block Name: Complex CTA
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
$title = get_field('title');
$subtitle = get_field('subtitle');

$button_1_text = get_field('button_1_text');
$button_2_text = get_field('button_2_text');
$button_1_url = get_field('button_1_url');
$button_2_url = get_field('button_2_url');

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

// Adding spacing for banner and decision CTAs

$cta_spacer = ($type=='decision') ? 'padd-cta-decision' :'padd-cta-banner';

$cta_btn_spacer = ($type=='decision') ? 'w-75' :'mx-xl-0 mx-lg-0';

$btn_btm_space = ( !empty($stat_1_title) && !empty($stat_1_subtitle) ) ? 'w-75' :'mx-xl-0 mx-lg-0 mx-md-auto';

if( !empty($button_1_text) && !empty($button_1_url) || !empty($button_2_text) && !empty($button_2_url) ) {
    $col_left_gap = ' mb-xl-0 mb-lg-0 mb-md-6 mb-sm-5 ';
}

?>

<div class="container position-relative <?= $cta_spacer; ?>">
    <div class="d-flex flex-column">
        <div id="<?= $uid; ?>" class="<?= $className; ?> position-relative align-items-center overflow-hidden rounded-4 <?= ($type=='decision') ? 'large-banner rxo-cta-decision' : 'rxo-block-cta-banner rxo-cta-banner text-bg-black dark-theme';?>">
            <div class="row align-items-center">
                <div class="col-12 col-xl-6 col-lg-6 <?= ($type=='decision') ? 'col-md-12 '. $col_left_gap :'col-md-6 mb-12px';?>">
                    <?php if($type=='decision' && !empty($title)) { ?>
                        <h2 class="m-0 p-0 cta-decision-title <?= (!empty($subtitle)) ? 'mb-4' : '' ?>"><?= $title; ?></h2>
                    <?php } else {
                        if ($title) : ?>
                            <h4 class="m-0 p-0 cta-banner-title <?= (!empty($subtitle)) ? 'mb-xlg-12px' : '' ?>"><?= $title; ?></h4>
                        <?php endif; 
                    } ?>
                    <?php if ($subtitle) : ?>
                        <p class="m-0"><?= $subtitle; ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-xl-6 col-lg-6 flex-column align-items-xl-center align-items-lg-center align-items-md-center align-items-sm-stretch justify-content-xl-end justify-content-lg-end justify-content-md-end flex-md-row d-flex flex-wrap <?= ($type=='decision') ? 'col-md-12 gap-xl-5 gap-lg-5 gap-md-3 gap-sm-5' :'col-md-6';?>">
                    <?php if ($button_1_text && $button_1_url) : ?>
                        <div class="<?= $cta_btn_spacer; ?>">
                            <a href="<?= $button_1_url; ?>" class="btn btn-primary btn m-0 <?= ($type=='decision') ? 'd-block btn-lg h4 my-0 btn-icon icon-arrow' :'';?>" <?= $button_1_link_attributes ?>> <?= $button_1_text; ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if ($button_2_text && $button_2_url) : ?>
                        <div class="<?= $cta_btn_spacer; ?>">
                            <a href="<?= $button_2_url; ?>" class="d-block btn btn btn-primary btn-lg h4 my-0 btn-icon icon-arrow m-0" <?= $button_2_link_attributes ?>><?= $button_2_text; ?></a>
                        </div>
                    <?php endif; ?>
                </div>            
            </div>
        </div>
    </div>
</div>