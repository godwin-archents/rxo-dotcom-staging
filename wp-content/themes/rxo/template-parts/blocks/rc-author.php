<?php

/**
 * Block Name: RC Author
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

$rc_auther_info = get_field('rc_author');
?>

<div id="<?= $uid; ?>" class="<?= $className; ?> my-8">
    <?php if ($rc_auther_info) : ?>
        <div class="row align-items-top">
            <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                <?php if(!empty(get_the_post_thumbnail($rc_auther_info->ID))) { ?>
                    <div class="card-image overflow-hidden rounded-4 mb-md-3 mb-sm-3"><?= get_the_post_thumbnail($rc_auther_info->ID); ?></div>
                <?php } ?>
            </div>
            <div class="col-xl-10 col-lg-10 col-md-9 col-12">
                <div class="d-grid gap-2 d-md-block mt-0">
                    <h5 class="mt-0 mb-md-3 mb-sm-0">Written by <?= $rc_auther_info->post_title; ?>
                    <?php if(!empty(get_field('linkedin_profile',$rc_auther_info->ID))) { ?>
                        <a href="<?= get_field('linkedin_profile',$rc_auther_info->ID); ?>" target="_blank" rel="noopener">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.5195 0H1.47656C0.660156 0 0 0.644531 0 1.44141V18.5547C0 19.3516 0.660156 20 1.47656 20H18.5195C19.3359 20 20 19.3516 20 18.5586V1.44141C20 0.644531 19.3359 0 18.5195 0ZM5.93359 17.043H2.96484V7.49609H5.93359V17.043ZM4.44922 6.19531C3.49609 6.19531 2.72656 5.42578 2.72656 4.47656C2.72656 3.52734 3.49609 2.75781 4.44922 2.75781C5.39844 2.75781 6.16797 3.52734 6.16797 4.47656C6.16797 5.42188 5.39844 6.19531 4.44922 6.19531ZM17.043 17.043H14.0781V12.4023C14.0781 11.2969 14.0586 9.87109 12.5352 9.87109C10.9922 9.87109 10.7578 11.0781 10.7578 12.3242V17.043H7.79688V7.49609H10.6406V8.80078H10.6797C11.0742 8.05078 12.043 7.25781 13.4844 7.25781C16.4883 7.25781 17.043 9.23438 17.043 11.8047V17.043Z" fill="#757575"></path>
                            </svg>
                        </a>
                    <?php } ?>
                </div>
                <?php if(!empty(get_field('author_position',$rc_auther_info->ID))) { ?>
                    <p class="mb-xl-3 mb-lg-3 mb-md-3 mb-sm-2"><span class="gray-txt-700"><?= get_field('author_position',$rc_auther_info->ID);?></span></p>
                <?php }
                
                if(!empty(get_field('short_description',$rc_auther_info->ID))) { ?>
                    <p><?= get_field('short_description',$rc_auther_info->ID); ?></p>
                <?php } ?>
            </div>
        </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No data available
            </div>
        </div>
    <?php endif; ?>
</div>