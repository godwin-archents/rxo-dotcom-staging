<?php

/**
 * Template part for displaying leadership posts in custom filter block
 */

$leader_img = get_field('landscape_photo', get_the_ID());
?>
<div class="col-12 col-md-6 col-lg-3 p-3 content">
    <div class="my-3 mt-lg-6 rounded-4 overflow-hidden">
        <div class="d-block d-lg-none">
            <img src="<?= $leader_img['url']; ?>" alt="<?= get_the_title(); ?>" />
        </div>
        <div class="d-none d-lg-block">
            <?= get_the_post_thumbnail(get_the_ID(), 'full'); ?>
        </div>
    </div>
    <p class="mb-0"><?= get_field('position', get_the_ID()); ?></p>
    <h4 class="pt-0 pb-1"><?= get_the_title(); ?></h4>
    <button type="button" class="btn btn-link btn-secondary text-primary border-primary" data-bs-toggle="modal" data-bs-target="#leadershipModal_<?= get_the_ID(); ?>">
        Read Bio
    </button>
    <div class="modal fade" id="leadershipModal_<?= get_the_ID(); ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content overflow-hidden rounded-3">
                <div class="modal-header p-0">
                    <img src="<?= $leader_img['url']; ?>" alt="<?= get_the_title(); ?>" />
                    <button type="button" class="btn btn-close btn-icon btn-rounded btn-secondary icon-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black p-4 p-md-5 px-lg-8 py-lg-7">
                    <h3 class="py-0"><?= get_the_title(); ?></h3>
                    <p><?= esc_html(get_field('position', get_the_ID())); ?></p>
                    <hr class="border-4 border-primary opacity-100" />
                    <p><?= get_the_content(); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>