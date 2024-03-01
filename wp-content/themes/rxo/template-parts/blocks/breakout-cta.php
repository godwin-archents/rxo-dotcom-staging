<?php

/**
 * Block Name: Breakout CTA Block
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

$vertical_padding = '';
$container_size = '';

$container_class = $container_size === 'article' ? 'article-width' : '';
$container_class .= $vertical_padding;

$bg = get_field('background_options');

$sidebar = get_field('sidebar_opitons');

$min_height = ($bg['height'] !== 'auto') ? true : false;
if ($min_height) {
    $className .= ' ' . $bg['height'] . ' d-flex';
    $container_class .= ' d-flex flex-column ' . $bg['content_vertical_alignment'];
}

$title = get_field('title');

$theme = 'background_image';

$call1_title = get_field('callout_1_title');
$call1_desc = get_field('callout_1_details');
$call1_image = get_field('callout_1_image');

$call1_button_1_text = get_field('callout_1_button_1_text');
$call1_button_2_text = get_field('callout_1_button_2_text');
$call1_button_1_url = get_field('callout_1_button_1_url');
$call1_button_2_url = get_field('callout_1_button_2_url');

$call1_button_1_link_type = get_link_type($call1_button_1_url);
$call1_button_2_link_type = get_link_type($call1_button_2_url);

$call1_button_1_link_attributes = '';
$call1_button_2_link_attributes = '';


$call2_title = get_field('callout_2_title');
$call2_desc = get_field('callout_2_details');
$call2_image = get_field('callout_2_image');

$call2_button_1_text = get_field('callout_2_button_1_text');
$call2_button_2_text = get_field('callout_2_button_2_text');
$call2_button_1_url = get_field('callout_2_button_1_url');
$call2_button_2_url = get_field('callout_2_button_2_url');

$call2_button_1_link_type = get_link_type($call2_button_1_url);
$call2_button_2_link_type = get_link_type($call2_button_2_url);

$call2_button_1_link_attributes = '';
$call2_button_2_link_attributes = '';

/* CTA */

$cta1 = get_field('cta_1_button');
$cta1_title = get_field('cta_1_title');
$cta1_desc = get_field('cta_1_details');

$cta1_button_1_text = get_field('cta_1_button_1_text');
$cta1_button_2_text = get_field('cta_1_button_2_text');
$cta1_button_1_url = get_field('cta_1_button_1_url');
$cta1_button_2_url = get_field('cta_1_button_2_url');

$cta1_button_1_link_type = get_link_type($cta1_button_1_url);
$cta1_button_2_link_type = get_link_type($cta1_button_2_url);

$cta1_button_1_link_attributes = '';
$cta1_button_2_link_attributes = '';


$cta2 = get_field('cta_2_button');
$cta2_title = get_field('cta_2_title');
$cta2_desc = get_field('cta_2_details');

$cta2_button_1_text = get_field('cta_2_button_1_text');
$cta2_button_2_text = get_field('cta_2_button_2_text');
$cta2_button_1_url = get_field('cta_2_button_1_url');
$cta2_button_2_url = get_field('cta_2_button_2_url');

$cta2_button_1_link_type = get_link_type($cta2_button_1_url);
$cta2_button_2_link_type = get_link_type($cta2_button_2_url);

$cta2_button_1_link_attributes = '';
$cta2_button_2_link_attributes = '';


if($theme === 'background_image'){
    $className .= ' text-bg-black';
    $button_1_style = 'btn-primary';
    $button_2_style = 'btn-outline-secondary';
  } else if($theme === 'light'){
      $className .= ' text-bg-white';
      $button_1_style = 'btn-primary';
      $button_2_style = 'btn-outline-secondary';
  } else if($theme === 'light_image'){
      $className .= ' text-bg-white';
      $button_1_style = 'btn-primary';
      $button_2_style = 'btn-primary';
  }else if($theme === 'dark_image'){
      $className .= ' text-bg-black dark-theme';
      $button_1_style = 'btn-primary';
      $button_2_style = 'btn-outline-secondary';
  }else{
    $className .= ' text-bg-black dark-theme';
    $button_1_style = 'btn-primary';
    $button_2_style = 'btn-outline-secondary';
  }

switch ($cta1_button_1_link_type) {
    case 'file':
        $cta1_button_1_link_type = 'download target="_blank"';
        break;
    case 'external':
        $cta1_button_1_link_type = 'target="_blank"';
        break;
    default:
        $cta1_button_1_link_type = '';
}

switch ($cta1_button_2_link_type) {
  case 'file':
      $cta1_button_2_link_type = 'download target="_blank"';
      break;
  case 'external':
      $cta1_button_2_link_type = 'target="_blank"';
      break;
  default:
      $cta1_button_2_link_type = '';
}


switch ($cta2_button_1_link_type) {
    case 'file':
        $cta2_button_1_link_type = 'download target="_blank"';
        break;
    case 'external':
        $cta2_button_1_link_type = 'target="_blank"';
        break;
    default:
        $cta2_button_1_link_type = '';
}

switch ($cta2_button_2_link_type) {
  case 'file':
      $cta2_button_2_link_type = 'download target="_blank"';
      break;
  case 'external':
      $cta2_button_2_link_type = 'target="_blank"';
      break;
  default:
      $cta2_button_2_link_type = '';
}

if((!empty($cta1)) && empty($cta2)) {
    $fullwidth = ' col-full ';
}

if((empty($cta1)) && !empty($cta2)) {
    $fullwidth = ' col-full ';
}

?>

<div id="<?= $uid; ?>" class="<?= $className; ?> position-relative">

    <?php if ($bg) : ?>
        <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100">
            <div class="bg-element w-100 h-100 position-absolute breakout-bg-img breakout-bg-video <?= $bg['black_overlay'] ? 'bg-overlay' : '' ?> <?= $bg['video_alignment']; ?>" style="background-image: url(<?= $bg['image']; ?>); background-position: <?= $bg['image_vertical_focal_point'] ?> <?= $bg['image_horizontal_focal_point'] ?>, <?= $bg['vertical_focal_adjsutment'] ?>% <?= $bg['horizontal_focal_adjsutment'] ?>%">
                <?= $bg['video']; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if((!empty($cta1)) || !empty($cta2)) { ?>
   
        <div class="container position-relative fixed-top container-cta <?= $container_class; ?>">
                
            <div class="row">
                <?php if($cta1) : ?>           

                    <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="text-bg-white rounded-4 breakout-cta-wrap">
                            <div class="breakout-cta">
                                <?php if(!empty($cta1_title)) { ?>
                                    <h4 class="m-0 mb-5 p-0"><?=$cta1_title?></h4>
                                <?php } ?>
                                <?php if(!empty($cta1_desc)) { ?>
                                    <div class="cta-description mb-5"><?=$cta1_desc?></div>
                                <?php } ?>
                                <?php if(!empty($cta1_button_1_text) || !empty($cta1_button_2_text)) : ?>
                                    <div class="d-xl-flex d-lg-block d-md-block d-sm-block gap-xl-3 gap-lg-3 gap-md-3 gap-sm-0">
                                        <?php if ($cta1_button_1_text && $cta1_button_1_url) : ?>
                                            <div class="mb-xl-0 mb-lg-3 mb-md-3 mb-sm-3">
                                                <a class="btn btn-primary w-xl-auto w-lg-100 w-md-100 w-sm-10" href="<?= $cta1_button_1_url; ?>" <?= $cta2_button_1_link_attributes ?>><?= $cta1_button_1_text; ?></a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($cta1_button_2_text && $cta1_button_2_url) : ?>
                                            <div class="">
                                                <a class="btn btn-outline-secondary w-xl-auto w-lg-100 w-md-100 w-sm-10" href="<?= $cta1_button_2_url; ?>" <?= $cta1_button_2_link_attributes ?>><?= $cta1_button_2_text; ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($cta2) : ?>
                    
                    <div class="col-12 col-md-12 col-lg-6 col-xl-6">

                        <div class="text-bg-white rounded-4 breakout-cta-wrap">

                            <div class="breakout-cta">
                                <?php if(!empty($cta2_title)) { ?>
                                    <h4 class="m-0 mb-5 p-0"><?=$cta2_title?></h4>
                                <?php } ?>
                                <?php if(!empty($cta2_desc)) { ?>
                                    <div class="cta-description mb-5"><?=$cta2_desc?></div>
                                <?php } ?>                        
                                <?php if(!empty($cta2_button_1_text) || !empty($cta2_button_2_text)) : ?>
                                    <div class="d-xl-flex d-lg-block d-md-block d-sm-block gap-xl-3 gap-lg-3 gap-md-3 gap-sm-0">
                                        <?php if ($cta2_button_1_text && $cta2_button_1_url) : ?>
                                            <div class="mb-xl-0 mb-lg-3 mb-md-3 mb-sm-3">
                                                <a class="btn btn-primary w-xl-auto w-lg-100 w-md-100 w-sm-10" href="<?= $cta2_button_1_url; ?>" <?= $cta2_button_1_link_attributes ?>><?= $cta2_button_1_text; ?></a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($cta2_button_2_text && $cta2_button_2_url) : ?>
                                            <div class="">
                                                <a class="btn btn-outline-secondary w-xl-auto w-lg-100 w-md-100 w-sm-10" href="<?= $cta2_button_2_url; ?>" <?= $cta2_button_2_link_attributes ?>><?= $cta2_button_2_text; ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>    
                        </div>          
                    </div>          
                <?php endif; ?>
            </div>
        </div>

    <?php } ?>

    <div class="container position-relative breakout-cta-bottom <?= $container_class; ?>">
                
        <?php if ($title) : ?>
            <h2 class="text-primary text-center m-0 my-xl-7 my-lg-7 my-md-5 my-sm-5"><?=$title?></h2>
        <?php endif; ?>
            
        <div class="breakout-bottom-info-wrap row">                    
            <div class="col-12 col-md-12 col-lg-6 col-xl-6 pe-xl-7 pe-lg-7 first">
                <div class="breakout-bottom-info">
                    <?php if(!empty($call1_image)) { ?>
                        <h3 class="m-0 mb-5 p-0"><?=$call1_title?></h3>
                    <?php } ?>
                    <?php if(!empty($call1_image)) { ?>
                        <div class="card-image overflow-hidden rounded-4 mb-5">
                        <figure class="m-0"><img src="<?= $call1_image['url']; ?>">
                            <?php if($call1_image['caption']):?>
                                <figcaption class="rxo-img-caption text-center fw-bold pb-0"><?= $call1_image['caption']; ?></figcaption>
                            <?php endif; ?>
                        </figure>
                        </div>
                    <?php } ?>
                    <?php if(!empty($call1_desc)) { ?>
                        <div class="cta-bottom-description mb-5"><?=$call1_desc?></div>
                    <?php } ?>                
                    <?php if($call1_button_1_text || $call1_button_2_text) : ?>
                        <div class="d-xl-flex d-lg-block d-md-block d-sm-block gap-xl-3 gap-lg-3 gap-md-3 gap-sm-0">
                            <?php if ($call1_button_1_text && $call1_button_1_url) : ?>
                                <div class="mb-xl-0 mb-lg-3 mb-md-3 mb-sm-3">
                                    <a class="btn btn-primary w-xl-auto w-lg-100 w-md-100 w-sm-10" href="<?= $call1_button_1_url; ?>" <?= $call1_button_1_link_attributes ?>><?= $call1_button_1_text; ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if ($call1_button_2_text && $call1_button_2_url) : ?>
                                <div class="">
                                    <a class="btn btn-outline-white w-xl-auto w-lg-100 w-md-100 w-sm-10" href="<?= $call1_button_2_url; ?>" <?= $call1_button_2_link_attributes ?>><?= $call1_button_2_text; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 col-xl-6 ps-xl-7 ps-lg-7">
                <div class="breakout-bottom-info">
                    <?php if(!empty($call1_image)) { ?>
                        <h3 class="m-0 mb-5 p-0"><?=$call2_title?></h3>
                    <?php } ?>
                    <?php if(!empty($call2_image)) { ?>
                        <div class="card-image overflow-hidden rounded-4 mb-5">
                        <figure class="m-0"><img src="<?= $call2_image['url']; ?>">
                            <?php if($call2_image['caption']):?>
                                <figcaption class="rxo-img-caption text-center fw-bold pb-0"><?= $call2_image['caption']; ?></figcaption>
                            <?php endif; ?>
                        </figure>
                        </div>
                    <?php } ?>
                    <?php if(!empty($call2_desc)) { ?>
                        <div class="cta-bottom-description mb-5"><?=$call2_desc?></div>
                    <?php } ?>                       
                    <?php if($call2_button_1_text || $call2_button_2_text) : ?>
                        <div class="d-xl-flex d-lg-block d-md-block d-sm-block gap-xl-3 gap-lg-3 gap-md-3 gap-sm-0">
                            <?php if ($call2_button_1_text && $call2_button_1_url) : ?>
                                <div class="mb-xl-0 mb-lg-3 mb-md-3 mb-sm-3">
                                    <a class="btn btn-primary w-xl-auto w-lg-100 w-md-100 w-sm-10" href="<?= $call2_button_1_url; ?>" <?= $call2_button_1_link_attributes ?>><?= $call2_button_1_text; ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if ($call2_button_2_text && $call2_button_2_url) : ?>
                                <div class="">
                                    <a class="btn btn-outline-white w-xl-auto w-lg-100 w-md-100 w-sm-10" href="<?= $call2_button_2_url; ?>" <?= $call2_button_2_link_attributes ?>><?= $call2_button_2_text; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
           
        </div>

          

    </div>
    
</div>