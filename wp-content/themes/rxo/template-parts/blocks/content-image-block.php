<?php

/**
 * Block Name: Content Image Block
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

$title_btm_space = '';
$subtitle_btm_space = '';
$subheading_color = '';

if($theme === 'dark_simple' || $theme === 'dark_dots'){
    $className .= ' text-bg-black dark-theme';
    $button_1_style = 'btn-primary';
    $button_2_style = 'btn-outline-white';
    $subheading_color = 'subheading-primary';
} else if($theme === 'light'){
    $className .= ' text-bg-white';
    $button_1_style = 'btn-primary';
    $button_2_style = 'btn-outline-secondary';
    $subheading_color = '';
} else if($theme === 'grey'){
    $className .= ' text-bg-light';
    $button_1_style = 'btn-secondary';
    $button_2_style = 'btn-outline-secondary';
    $subheading_color = '';
}
$layout = get_field('layout');
$image_side = get_field('image_side');
$image = get_field('image');
$category = get_field('category');
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

if($image_side == 'right') {

  $col_class_left = ' order-1 order-lg-1 order-md-1 order-sm-1';
  // $col_class_right = ' order-3 order-lg-3 order-md-1 order-sm-1 mb-7-5';
  $col_class_right = ' order-3 order-lg-3 order-md-3 order-sm-3';
} else {
  // $col_class_right = ' order-1 order-lg-1 order-md-1 order-sm-1 mb-7-5';
  $col_class_right = ' order-1 order-lg-1 order-md-3 order-sm-3';
  $col_class_left = ' order-1 order-lg-1 order-md-1 order-sm-1 mb-6';
}

?>

<div id="<?= $uid; ?>" class="<?= $className; ?> position-relative padd-top-btm">
  <?php if ($theme === 'dark_dots') :?>
    <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100">
        <div class="bg-element w-100 h-100 position-absolute" style="background-image: url(<?php echo get_site_url() ?>/wp-content/uploads/2023/11/pattern-1.png); background-position: right bottom, 0% 0%; background-repeat: no-repeat; "></div>
    </div>
  <?php endif; ?>
  <div class="container position-relative">
    <div class="row align-items-center">
     
    <?php if(!empty($image)) { ?>
      <div class="col-lg-6 <?= $col_class_right; ?>">
        <div class="card-image overflow-hidden rounded-4">
          <figure class="m-0"><img src="<?= $image['url']; ?>" loading="lazy">
              <?php if($image['caption']):?>
                <figcaption class="rxo-img-caption text-center fw-bold pb-0"><?= $image['caption']; ?></figcaption>
              <?php endif; ?>
          </figure>
        </div>
      </div>
      <div class="col-lg-1 order-2 order-lg-2 d-none d-lg-block d-xl-block">&nbsp;</div>
    <?php } ?>

      <div class="col-lg-5 <?= $col_class_left; ?>">
        <?php if ($category) :
          if(!empty($title) || !empty($subtitle) || !empty($button_1_text && $button_1_url) || !empty($button_2_text && $button_2_url)) {
            $category_btm_space = 'mb-xl-5 mb-lg-4 mb-sm-4 ';
          } ?>
          <p class="fw-600 <?= ($category_btm_space) ? $category_btm_space : 'mb-0 '; ?><?=  $subheading_color; ?>"><?= $category; ?></p>
        <?php endif; ?>

        <?php if ($title) : 
          if(!empty($subtitle) || !empty($button_1_text && $button_1_url) || !empty($button_2_text && $button_2_url)) {
            $title_btm_space = 'mb-xl-5 mb-lg-4 mb-sm-4 ';
          } ?>
          <h2 class="p-0 mt-0 <?= ($title_btm_space) ? $title_btm_space : 'mb-0 '; ?>"><?= $title; ?></h2>  
        <?php endif; ?>

        <?php if ($subtitle) : 
          if(!empty($button_1_text && $button_1_url) || !empty($button_2_text && $button_2_url)) {
            $subtitle_btm_space = 'mb-6 ';
          } ?>
          <div class="content-desc <?= ($subtitle_btm_space) ? $subtitle_btm_space : ''; ?>"><?= $subtitle; ?></div>
        <?php endif; ?>

        <div class="row mb-xl-0 mb-lg-0 mb-md-6 mb-sm-6">
          <div class="d-grid gap-4 two-col">
            <?php if ($button_1_text && $button_1_url) : ?>
                <a href="<?= $button_1_url; ?>" class="btn <?= $button_1_style; ?>" <?= $button_1_link_attributes ?>><?= $button_1_text; ?></a>
              <?php endif; ?>
              <?php if ($button_2_text && $button_2_url) : ?>
                <a href="<?= $button_2_url; ?>" class="btn <?= $button_2_style; ?>" <?= $button_2_link_attributes ?>><?= $button_2_text; ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div><!-- row -->
  </div><!-- container -->
</div><!-- main div -->


