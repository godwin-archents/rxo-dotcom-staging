<?php

/**
 * Block Name: Hero Block
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

if($theme === 'background_image'){
  $className .= ' text-bg-black';
  $button_1_style = 'btn-primary';
  $button_2_style = 'btn-outline-white btn-secondary';
} /*else if($theme === 'light'){
    $className .= ' text-bg-white';
    $button_1_style = 'btn-primary';
    $button_2_style = 'btn-outline-secondary';
} */
else if($theme === 'light_image'){
    $className .= ' text-bg-white';
    $button_1_style = 'btn-primary';
    $button_2_style = 'btn-outline-secondary';
}else if($theme === 'dark_image'){
    $className .= ' text-bg-black dark-theme';
    $button_1_style = 'btn-primary';
    $button_2_style = 'btn-outline-white';
}else{
  $className .= ' text-bg-black dark-theme';
  $button_1_style = 'btn-primary';
  $button_2_style = 'btn-outline-white';
}
$layout = get_field('layout');
$size = get_field('size');
$image = get_field('image_under_content');
$background_image = get_field('background_image');
$image_type = get_field('image_type');

$title_type = get_field('title_type');
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

if($image_type == "black") {
  $bg_linear_gradient = "linear-gradient(black, black), ";
  $bg_blend_mode = "background-blend-mode: saturation";
  $title_color = "subheading-primary subheading-primary--light";
}

$bg_linear_gradient = isset($bg_linear_gradient) ? $bg_linear_gradient : '';
$bg_blend_mode = isset($bg_blend_mode) ? $bg_blend_mode : '';
$title_color = isset($title_color) ? $title_color : '';

if(!empty($title) || !empty($subtitle) || !empty($button_1_text && $button_1_url) || !empty($button_2_text && $button_2_url) || !empty($image)) { ?>

  <div id="<?= $uid; ?>" class="<?= $className; ?> hero-block-height position-relative">
    <?php if ($theme === 'dark_image') :
      if($size === 'small') { ?>
        <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100">
            <div class="bg-element w-100 h-100 position-absolute hero-block-bg-dark hero-block-bg-dark--small" style="background-image: url(<?php echo get_site_url() ?>/wp-content/uploads/2023/10/Small_Dark_Hero_Dots.jpg); background-repeat: no-repeat; "></div>
        </div>
      <?php } elseif(!empty($image)) { ?>
        <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100">
          <div class="bg-element w-100 h-100 position-absolute" style="background-image: url(<?php echo get_site_url() ?>/wp-content/uploads/2023/10/Large_Dark_Hero_Dots.jpg); background-position: top right !important; background-repeat: no-repeat; "></div>
        </div>
      <?php } else { ?>
        <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100 d-xl-block d-lg-none d-md-none d-sm-none">
          <div class="bg-element w-100 h-100 position-absolute" style="background-image: url(<?php echo get_site_url() ?>/wp-content/uploads/2023/11/Medium_Dark_Hero_Dots.png); background-position: top right !important; background-repeat: no-repeat; "></div>
        </div>
        <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100 d-xl-none d-lg-block d-md-block d-sm-block">
          <div class="bg-element w-100 h-100 position-absolute hero-block-bg-dark hero-block-bg-dark--medium" style="background-image: url(<?php echo get_site_url() ?>/wp-content/uploads/2023/10/Small_Dark_Hero_Dots.jpg); background-repeat: no-repeat; "></div>
        </div>
      <?php } ?>
    <?php endif; ?>

    <?php if ($theme === 'light_image') :
      if($size === 'small') { ?>
        <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100">
          <div class="bg-element w-100 h-100 position-absolute hero-block-bg-light hero-block-bg-light--simple" style="background-image: url(<?php echo get_site_url() ?>/wp-content/uploads/2023/10/Small_Light_Hero_Dots.jpg); background-repeat: no-repeat; "></div>
        </div>
      <?php } elseif(!empty($image)) { ?>
        <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100">
          <div class="bg-element w-100 h-100 position-absolute hero-block-bg-light hero-block-bg-light--medium" style="background-image: url(<?php echo get_site_url() ?>/wp-content/uploads/2023/10/Large_Light_Hero_Dots.jpg); background-repeat: no-repeat; "></div>
        </div>
      <?php } else { ?>
        <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100">
          <div class="bg-element w-100 h-100 position-absolute hero-block-bg-light hero-block-bg-light--medium" style="background-image: url(<?php echo get_site_url() ?>/wp-content/uploads/2023/10/Medium_Light_Hero_Dots.jpg); background-repeat: no-repeat; "></div>
        </div>
      <?php } ?>
    <?php endif; ?>
    <?php if ($theme === 'background_image') :?>
      <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100">
        <div class="bg-element w-100 h-100 position-absolute bg-overlay" style="background-image: <?= $bg_linear_gradient; ?>url(<?= $background_image; ?>); background-position: top right, 0% 0%; background-repeat: no-repeat; background-size: cover !important; <?= $bg_blend_mode; ?>; opacity: 0.6;">
        </div>
      </div>
    <?php endif;
    if($size == 'medium') { ?>
      <!-- <div class="d-table-cell align-middle"> -->
    <?php } ?>

    <div class="row align-items-center <?php echo ($theme === 'background_image') ? 'py-8':'py-6';?><?= ($size == 'small') ? ' min-height-small ' : ' min-height-medium d-table w-100';?>">

      <div class="container position-relative">
        <div class="row align-items-center">
            <?php if($size === 'small') { ?>
              <div class="col-12 col-lg-11 col-xl-11">
                <?php if ($title) : 
                  echo $title = ($title_type == 'h1') ? '<h1 class=" m-0 '.$title_color.'">'. $title.'</h1>' : '<h2 class=" m-0 '.$title_color.'">'. $title.'</h2>';
                endif; ?>
              </div>
            <?php } else { ?>
              <div class="col-12 col-lg-11 col-xl-11">
                <?php if ($title) : 
                  if(!empty($subtitle) || !empty($button_1_text && $button_1_url) || !empty($button_2_text && $button_2_url) || !empty($image) || $theme != 'background_image') {
                    $title_btm_space = ' m-0 mb-4 ';
                  } else {
                    $title_btm_space = ' m-0 ';
                  }
                  echo $title = ($title_type == 'h1') ? '<h1 class="'.$title_btm_space.$title_color.'">'. $title.'</h1>' : '<h2 class="mt-0 '.$title_btm_space.$title_color.'">'. $title.'</h2>';
                endif;
                if (!empty($subtitle)) :
                  if(empty($button_1_text && $button_1_url) && empty($button_2_text && $button_2_url) && !empty($image)) {
                    $subtitle_btm_space = ' mb-md-4-5 ';
                  } elseif(!empty($button_1_text && $button_1_url) && !empty($button_2_text && $button_2_url)) {
                    $subtitle_btm_space = ' mb-4';
                  } else {
                    $subtitle_btm_space = '';
                  } ?>
                  <p class="<?= $subtitle_btm_space; ?>"><?= $subtitle; ?></p>
                <?php endif;
                if(!empty($image)) {
                  $buttons_btm_space = ' mb-md-4-5';
                } else {
                  $buttons_btm_space = ' ';
                }  ?>
                <?php if ($button_1_text && $button_1_url || $button_2_text && $button_2_url) : ?>
                  <div class="d-sm-block d-md-flex d-flex <?= $buttons_btm_space; ?> gap-5">
                    <?php if ($button_1_text && $button_1_url) : ?>
                      <div class="mb-sm-3 mb-md-0">
                        <a href="<?= $button_1_url; ?>" class="btn <?= $button_1_style; ?>" <?= $button_1_link_attributes ?>"><?= $button_1_text; ?></a>
                      </div>
                    <?php endif; ?>
                    <?php if ($button_2_text && $button_2_url) : ?>
                      <div class="">
                        <a href="<?= $button_2_url; ?>" class="btn <?= $button_2_style; ?> " <?= $button_2_link_attributes ?>><?= $button_2_text; ?></a>
                      </div>
                    <?php endif; ?>
                  </div><!-- d-flex -->
                <?php endif; ?>
                <?php
                if($theme === 'dark_image' || $theme === 'light_image') {
                  if($image) { ?>
                      <div class="card-image overflow-hidden rounded-4"> <img src="<?= $image; ?>"></div>
                    <?php } ?>
                <?php } ?>

                </div><!-- col-12 col-lg-11 col-xl-11 -->
            <?php } ?>
        </div><!-- row -->
        <?php if($size == 'medium') { ?>
          <!-- </div> table-cell -->
        <?php } ?>
      </div><!-- container -->
    </div><!-- row div -->
  </div><!-- main div -->
<?php } ?>