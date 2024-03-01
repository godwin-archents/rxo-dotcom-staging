<?php

/**
 * Block Name: Promo Modal
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
$className .= ' ' . $block['className'] ?? '';
$className .= ' ' . $block['align'] ?? '';

$theme = get_field('theme');
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : '');

$is_promo_active = true;

date_default_timezone_set("EST");
$current_date = date('Y-m-d H:i:s');
$start_date = get_field('start_date');
$end_date = get_field('end_date');

if ($start_date && (date("Y-m-d H:i:s", strtotime($start_date)) > $current_date)) {
    $is_promo_active = false;
}

if ($end_date && (date("Y-m-d H:i:s", strtotime($end_date)) < $current_date)) {
    $is_promo_active = false;
}

$title = get_field('title');
$description = get_field('description');
$link = get_field('button_url');
$link_type = get_link_type($link);
$link_attributes = '';
switch ($link_type) {
    case 'file':
        $link_attributes = 'download target="_blank"';
        break;
    case 'external':
        $link_attributes = 'target="_blank"';
        break;
    default:
        $link_attributes = '';
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <?php if ($is_promo_active) : ?>
        <div class="modal fade" id="promo_modal_<?= $uid ?>" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg text-black">
                <div class="modal-content overflow-hidden rounded-3">
                    <div class="modal-header p-0 border-0">
                        <button type="button" class="btn btn-close btn-icon btn-rounded btn-secondary icon-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 p-md-5 px-lg-7">
                        <h3 id="promoModalLabel" class="pe-3"><?= $title ?></h3>
                        <hr class="border-4 border-primary opacity-100">
                        <div class="my-4"><?= $description ?></div>
                        <div class="d-flex justify-content-start gap-4 mb-3 flex-wrap">
                            <a href="<?= $link ?>" class="btn btn-primary" $link_attributes><?= the_field('button_text') ?></a>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No thanks</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var promo_modal = new bootstrap.Modal(document.getElementById('promo_modal_<?= $uid ?>'), {});
            const is_promo_displayed = localStorage.getItem('promo_modal_<?= $uid ?>') || false;
            if (!is_promo_displayed) {
                promo_modal.show();
                document.getElementById('promo_modal_<?= $uid ?>').addEventListener('hidden.bs.modal', event => {
                    localStorage.setItem('promo_modal_<?= $uid ?>', true);
                });
            }
        </script>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No active promos available
            </div>
        </div>
    <?php endif; ?>
</div>