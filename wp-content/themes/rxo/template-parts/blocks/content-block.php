<?php

/**
 * Block Name: Content Block
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

$theme = get_field('content_blocks');
$cb_app_download_image = get_field('cb_app_download_image');

if($cb_app_download_image === 'green') {
  $cb_app_download_image_cls = "cb-app-green-bg";
} else {
  $cb_app_download_image_cls = "cb-app-dark-bg";
}

$cb_subheading_color = '';

if($theme === 'dark_simple' || $theme === 'dark_dots'){
    $className .= ' text-bg-black dark-theme';
    $cb_button_1_style = 'btn-primary';
    $cb_button_2_style = 'btn-outline-white';
    $cb_subheading_color = 'subheading-primary';
} else if($theme === 'light'){
    $className .= ' text-bg-white';
    $cb_button_1_style = 'btn-primary';
    $cb_button_2_style = 'btn-outline-secondary';
    $cb_subheading_color = '';
} else if($theme === 'grey'){
    $className .= ' text-bg-light';
    $cb_button_1_style = 'btn-secondary';
    $cb_button_2_style = 'btn-outline-secondary';
    $cb_subheading_color = '';
}

/* 
* Left Column Fields
*/

// Image
$cb_left_img_image = get_field('cb_left_img_image');

// App Download Image
$cb_left_img_app_download_image = get_field('cb_left_img_app_download_image');

// App Download Copy
$cb_left_app_download_title = get_field('cb_left_app_download_title');
$cb_left_app_download_content = get_field('cb_left_app_download_content');
$cb_left_apple_store_download_link = get_field('cb_left_apple_store_download_link');
$cb_left_google_play_store_download_link = get_field('cb_left_google_play_store_download_link');

$cb_left_apple_store_download_link_type = get_link_type($cb_left_apple_store_download_link);
$cb_left_google_play_store_download_link_type = get_link_type($cb_left_google_play_store_download_link);

$cb_left_apple_store_download_link_attributes = '';
$cb_left_google_play_store_download_link_attributes = '';

switch ($cb_left_apple_store_download_link_type) {
  case 'file':
      $cb_left_apple_store_download_link_attributes = 'download target="_blank"';
      break;
  case 'external':
      $cb_left_apple_store_download_link_attributes = 'target="_blank"';
      break;
  default:
      $cb_left_apple_store_download_link_attributes = '';
}

switch ($cb_left_google_play_store_download_link_type) {
  case 'file':
      $cb_left_google_play_store_download_link_attributes = 'download target="_blank"';
      break;
  case 'external':
      $cb_left_google_play_store_download_link_attributes = 'target="_blank"';
      break;
  default:
      $cb_left_google_play_store_download_link_attributes = '';
}

// Copy
$choose_left_column_content_type = get_field('choose_left_column_content_type');

$cb_left_copy_category = get_field('cb_left_copy_category');
$cb_left_copy_title = get_field('cb_left_copy_title');
$cb_left_copy_content = get_field('cb_left_copy_content');
$cb_left_copy_button_1_text = get_field('cb_left_copy_button_1_text');
$cb_left_copy_button_1_url = get_field('cb_left_copy_button_1_url');
$cb_left_copy_button_2_text = get_field('cb_left_copy_button_2_text');
$cb_left_copy_button_2_url = get_field('cb_left_copy_button_2_url');

$cb_left_copy_button_1_link_type = get_link_type($cb_left_copy_button_1_url);
$cb_left_copy_button_2_link_type = get_link_type($cb_left_copy_button_2_url);

$cb_left_copy_button_1_link_attributes = '';
$cb_left_copy_button_2_link_attributes = '';

switch ($cb_left_copy_button_1_link_type) {
  case 'file':
      $cb_left_copy_button_1_link_attributes = 'download target="_blank"';
      break;
  case 'external':
      $cb_left_copy_button_1_link_attributes = 'target="_blank"';
      break;
  default:
      $cb_left_copy_button_1_link_attributes = '';
}

switch ($cb_left_copy_button_2_link_type) {
  case 'file':
      $cb_left_copy_button_2_link_attributes = 'download target="_blank"';
      break;
  case 'external':
      $cb_left_copy_button_2_link_attributes = 'target="_blank"';
      break;
  default:
      $cb_left_copy_button_2_link_attributes = '';
}


/* 
* Right Column Fields
*/
// Image
$cb_right_img_image = get_field('cb_right_img_image');

// App Download Image
$cb_right_img_app_download_image = get_field('cb_right_img_app_download_image');

// App Download Copy
$cb_right_app_download_title = get_field('cb_right_app_download_title');
$cb_right_app_download_content = get_field('cb_right_app_download_content');
$cb_right_apple_store_download_link = get_field('cb_right_apple_store_download_link');
$cb_right_google_play_store_download_link = get_field('cb_right_google_play_store_download_link');

$cb_right_apple_store_download_link_type = get_link_type($cb_right_apple_store_download_link);
$cb_right_google_play_store_download_link_type = get_link_type($cb_right_google_play_store_download_link);

$cb_right_apple_store_download_link_attributes = '';
$cb_right_google_play_store_download_link_attributes = '';

switch ($cb_right_apple_store_download_link_type) {
  case 'file':
      $cb_right_apple_store_download_link_attributes = 'download target="_blank"';
      break;
  case 'external':
      $cb_right_apple_store_download_link_attributes = 'target="_blank"';
      break;
  default:
      $cb_right_apple_store_download_link_attributes = '';
}

switch ($cb_right_google_play_store_download_link_type) {
  case 'file':
      $cb_right_google_play_store_download_link_attributes = 'download target="_blank"';
      break;
  case 'external':
      $cb_right_google_play_store_download_link_attributes = 'target="_blank"';
      break;
  default:
      $cb_right_google_play_store_download_link_attributes = '';
}

// Copy
$choose_right_column_content_type = get_field('choose_right_column_content_type');
$cb_right_copy_category = get_field('cb_right_copy_category');
$cb_right_copy_title = get_field('cb_right_copy_title');
$cb_right_copy_content = get_field('cb_right_copy_content');
$cb_right_copy_button_1_text = get_field('cb_right_copy_button_1_text');
$cb_right_copy_button_1_url = get_field('cb_right_copy_button_1_url');
$cb_right_copy_button_2_text = get_field('cb_right_copy_button_2_text');
$cb_right_copy_button_2_url = get_field('cb_right_copy_button_2_url');

$cb_right_copy_button_1_link_type = get_link_type($cb_right_copy_button_1_url);
$cb_right_copy_button_2_link_type = get_link_type($cb_right_copy_button_2_url);

$cb_right_copy_button_1_link_attributes = '';
$cb_right_copy_button_2_link_attributes = '';

switch ($cb_right_copy_button_1_link_type) {
  case 'file':
      $cb_right_copy_button_1_link_attributes = 'download target="_blank"';
      break;
  case 'external':
      $cb_right_copy_button_1_link_attributes = 'target="_blank"';
      break;
  default:
      $cb_right_copy_button_1_link_attributes = '';
}

switch ($cb_right_copy_button_2_link_type) {
  case 'file':
      $cb_right_copy_button_2_link_attributes = 'download target="_blank"';
      break;
  case 'external':
      $cb_right_copy_button_2_link_attributes = 'target="_blank"';
      break;
  default:
      $cb_right_copy_button_2_link_attributes = '';
}



if($choose_left_column_content_type == 'Image') {
  $cb_img_classes = ' order-xl-1 order-lg-1 order-md-3 order-sm-3';
} 

// else {
//   $cb_img_classes = ' order-xl-2 order-lg-2 order-md-1 order-sm-1 ';
// }

if($choose_left_column_content_type == 'App Download Image') {
  $cb_app_img_classes = ' order-xl-1 order-lg-1 order-md-3 order-sm-3 ';
} else {
  $cb_app_img_classes = ' order-xl-3 order-lg-3 order-md-1 order-sm-1 ';
}

if($choose_right_column_content_type == 'Copy' || $choose_right_column_content_type == 'App Download Copy') {
  $cb_copy_classes = ' order-xl-3 order-lg-3 order-md-1 order-sm-1 ';
} else {
  $cb_copy_classes = ' order-xl-1 order-lg-1 order-md-2 order-sm-2 ';
}

if($choose_left_column_content_type == 'Select WP Form' || $choose_right_column_content_type == 'Select WP Form') {
  $row_align_class = ' align-items-top ';
} else {
  $row_align_class = ' align-items-center ';
}

?>

<div id="<?= $uid; ?>" class="<?= $className; ?> position-relative padd-top-btm">
  <?php if ($theme === 'dark_dots') :?>
    <div class="h-100 left-0 overflow-hidden position-absolute top-0 w-100">
      <div class="bg-element w-100 h-100 position-absolute" style="background-image: url(<?php echo get_site_url() ?>/wp-content/uploads/2023/11/pattern-1.png); background-position: right bottom, 0% 0%; background-repeat: no-repeat; "></div>
    </div>
  <?php endif; ?>
  <div class="container position-relative">
    <div class="row <?= $row_align_class; ?> gap-xl-0 gap-lg-0 gap-md-6 gap-sm-5">
      <!-- Left Column Blocks -->
      <?php if(!empty($cb_left_img_image)) { ?>
        <!-- Content Block - Image - Left Column -->
        <div class="col-lg-6 <?= $cb_img_classes; ?>">
          <div class="overflow-hidden rounded-4">
            <figure class="m-0"><img src="<?= $cb_left_img_image['url']; ?>" loading="lazy">
            </figure>
          </div>
        </div>
      <?php } ?>

      <?php if(!empty($cb_left_img_app_download_image)) { ?>
        <!-- Content Block - App Download Image - Left Column -->
        <div class="col-lg-5 <?= $cb_app_img_classes; ?>">
          <div class="overflow-hidden rounded-4 <?= $cb_app_download_image_cls; ?>">
            <figure class="m-0 text-center"><img class="w-auto" src="<?= $cb_left_img_app_download_image['url']; ?>" loading="lazy">
            </figure>
          </div>
        </div>
        <div class="col-lg-1 order-2 order-lg-2 d-none d-lg-block d-xl-block">&nbsp;</div>
      <?php } ?>

      <?php if($choose_left_column_content_type == 'Copy') { ?>
        <div class="col-lg-5 order-1 order-lg-1 order-md-1 order-sm-1 mb-6">
          <div class="d-grid gap-xl-6 gap-lg-6 gap-md-6 gap-sm-5">
            <div class="d-grid gap-xl-5 gap-lg-4 gap-md-4 gap-sm-4">
              <?php if ($cb_left_copy_category) { ?>
                <p class="fw-600 m-0 <?= $cb_subheading_color; ?>"><?= $cb_left_copy_category; ?></p>
              <?php } ?>
              <?php if ($cb_left_copy_title) {?>
                <h2 class="p-0 m-0"><?= $cb_left_copy_title; ?></h2>  
              <?php } ?>
              <?php if ($cb_left_copy_content) { ?>
                <div class="content-desc"><?= $cb_left_copy_content; ?></div>
              <?php } ?>
            </div>
            <div class="d-grid gap-4 two-col">
              <?php if ($cb_left_copy_button_1_text && $cb_left_copy_button_1_url) { ?>
                  <a href="<?= $cb_left_copy_button_1_url; ?>" class="btn <?= $cb_button_1_style; ?>" <?= $button_1_link_attributes ?>><?= $cb_left_copy_button_1_text; ?></a>
                <?php } ?>
                <?php if ($cb_left_copy_button_2_text && $cb_left_copy_button_2_url) { ?>
                  <a href="<?= $cb_left_copy_button_2_url; ?>" class="btn <?= $cb_button_2_style; ?>" <?= $button_2_link_attributes ?>><?= $cb_left_copy_button_2_text; ?></a>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="col-lg-1 order-2 order-lg-2 d-none d-lg-block d-xl-block">&nbsp;</div>
      <?php } ?>

      <?php if($choose_left_column_content_type == 'App Download Copy') { ?>
        <div class="col-lg-6">
          <div class="d-grid gap-xl-6 gap-lg-6 gap-md-6 gap-sm-5 text-center">
            <div class="d-grid gap-xl-5 gap-lg-4 gap-md-4 gap-sm-4">
              <?php if ($cb_left_app_download_title) {?>
                <h2 class="p-0 m-0"><?= $cb_left_app_download_title; ?></h2>  
              <?php } ?>
              <?php if ($cb_left_app_download_content) { ?>
                <div class="content-desc"><?= $cb_left_app_download_content; ?></div>
              <?php } ?>
            </div>
            <div class="d-xl-flex d-lg-flex d-md-flex d-sm-grid gap-4 justify-content-center">
              <?php if ($cb_left_apple_store_download_link) { ?>
                  <a href="<?= $cb_left_apple_store_download_link; ?>" class="cb-app-store-img cb-app-store-img--apple" <?= $cb_left_apple_store_download_link_attributes ?>>&nbsp;</a>
              <?php } ?>
              <?php if ($cb_left_google_play_store_download_link) { ?>
                  <a href="<?= $cb_left_google_play_store_download_link; ?>" class="cb-app-store-img cb-app-store-img--gplay" <?= $cb_left_google_play_store_download_link_attributes ?>>&nbsp;</a>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php if($choose_left_column_content_type == 'Select WP Form') { ?>
        <div class="col-lg-6">
          <?php if($theme == 'light') { ?>
            <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( array( 'wpforms/form-selector' ) ) ); ?>" />
            <?php } else { ?>
                <p>Form will not support other themes. Please select the light theme add the form. </p>
            <?php } ?>
        </div>
      <?php } ?>

      <!-- Right Column Blocks -->

      <?php if(!empty($cb_right_img_image)) { ?>        
        <!-- Content Block - Image - Right Column  -->
        <div class="col-lg-6 order-3 order-lg-3 order-md-3 order-sm-3">
          <div class="overflow-hidden rounded-4">
            <figure class="m-0"><img src="<?= $cb_right_img_image['url']; ?>" loading="lazy">
            </figure>
          </div>
        </div>
      <?php } ?>
      
      <?php if(!empty($cb_right_img_app_download_image)) { ?>        
        <!-- Content Block - App Download Image - Right Column -->
        <div class="col-lg-1 d-none d-lg-block d-xl-block">&nbsp;</div>
        <div class="col-lg-5 <?= $cb_app_img_classes; ?>">
          <div class="overflow-hidden rounded-4 <?= $cb_app_download_image_cls; ?>">
            <figure class="m-0 text-center"><img class="w-auto" src="<?= $cb_right_img_app_download_image['url']; ?>" loading="lazy">
            </figure>
          </div>
        </div>
      <?php } ?>

      <!-- Content Block - Copy - Right Column -->
      <?php if($choose_right_column_content_type == 'Copy') { ?>
        <div class="col-lg-1 order-2 order-lg-2 d-none d-lg-block d-xl-block">&nbsp;</div>
        <div class="col-lg-5 <?= $cb_copy_classes; ?>">
          <div class="d-grid gap-xl-6 gap-lg-6 gap-md-6 gap-sm-5">
            <div class="d-grid gap-xl-5 gap-lg-4 gap-md-4 gap-sm-4">
              <?php if ($cb_right_copy_category) { ?>
                <p class="fw-600 m-0 <?= $cb_subheading_color; ?>"><?= $cb_right_copy_category; ?></p>
              <?php } ?>
              <?php if ($cb_right_copy_title) {?>
                <h2 class="p-0 m-0"><?= $cb_right_copy_title; ?></h2>  
              <?php } ?>
              <?php if ($cb_right_copy_content) { ?>
                <div class="content-desc"><?= $cb_right_copy_content; ?></div>
              <?php } ?>
            </div>
            <div class="d-grid gap-4 two-col">
              <?php if ($cb_right_copy_button_1_text && $cb_right_copy_button_1_url) { ?>
                  <a href="<?= $cb_right_copy_button_1_url; ?>" class="btn <?= $cb_button_1_style; ?>" <?= $button_1_link_attributes ?>><?= $cb_right_copy_button_1_text; ?></a>
                <?php } ?>
                <?php if ($cb_right_copy_button_2_text && $cb_right_copy_button_2_url) { ?>
                  <a href="<?= $cb_right_copy_button_2_url; ?>" class="btn <?= $cb_button_2_style; ?>" <?= $button_2_link_attributes ?>><?= $cb_right_copy_button_2_text; ?></a>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
      
      <?php if($choose_right_column_content_type == 'App Download Copy') { ?>     
        <div class="col-lg-6 order-xl-2 order-lg-2 order-md-1 order-sm-1">
          <div class="d-grid gap-xl-6 gap-lg-6 gap-md-6 gap-sm-5 text-center">
            <div class="d-grid gap-xl-5 gap-lg-4 gap-md-4 gap-sm-4">
              <?php if ($cb_right_app_download_title) {?>
                <h2 class="p-0 m-0"><?= $cb_right_app_download_title; ?></h2>  
              <?php } ?>
              <?php if ($cb_right_app_download_content) { ?>
                <div class="content-desc"><?= $cb_right_app_download_content; ?></div>
              <?php } ?>
            </div>
            <div class="d-xl-flex d-lg-flex d-md-flex d-sm-grid gap-4 justify-content-center">
              <?php if ($cb_right_apple_store_download_link) { ?>
                  <a href="<?= $cb_right_apple_store_download_link; ?>" class="cb-app-store-img cb-app-store-img--apple" <?= $cb_right_apple_store_download_link_attributes ?>>&nbsp;</a>
              <?php } ?>
              <?php if ($cb_right_google_play_store_download_link) { ?>
                  <a href="<?= $cb_right_google_play_store_download_link; ?>" class="cb-app-store-img cb-app-store-img--gplay" <?= $cb_right_google_play_store_download_link_attributes ?>>&nbsp;</a>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php if($choose_right_column_content_type == 'Select WP Form') { ?>
        <div class="col-lg-6 order-xl-1 order-lg-1 order-md-3 order-sm-3">
          <div class="d-grid gap-5">
            <?php if($theme == 'light') { ?>
              <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( array( 'wpforms/form-selector' ) ) ); ?>" />
            <?php } else { ?>
                <p>Form will not support other themes. Please select the light theme add the form. </p>
            <?php } ?>
          </div>
        </div>
      <?php } ?>

    </div><!-- row -->
  </div><!-- container -->
</div><!-- main div -->


