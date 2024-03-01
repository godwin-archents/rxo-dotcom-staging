<?php

/**
 * Block Name: Add New Market
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


?>

<div id="<?= $uid; ?>" class="<?= $className; ?> position-relative padd-top-btm">
  <div class="container position-relative py-7">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-6 col-xl-6">
        <div class="d-grid gap-5">
          <h3 class="m-0 p-0">Market requesting support</h3>
          <p class="m-0">Submit this form to add a new market that will be visible in the dropdown 'Market requesting support'</p>
          <form class="rxo-add-new-market-form" method="post" action="#">
            <div class="rxo-input-text">
              <label for="rxo-input-market-name" class="d-block p-2">Market Name <span class="rxo-required-label">*</span></label>
              <input type="text" id="rxo-add-new-market-name" class="w-100 p-2" required="">
            </div>
            <button type="submit" class="btn btn-primary rxo-add-new-market-submit">Add Market</button>
          </form>
      </div><!-- col -->
    </div><!-- row -->
  </div><!-- container -->
</div><!-- main div -->
