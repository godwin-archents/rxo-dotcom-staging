<?php

/**
 * Block Name: Video
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

$video_url = get_field('video_url');
$poster_image = get_field('poster_image') ? get_field('poster_image') : '';

if(!empty($poster_image)) {
    $cls_video_play_icon = 'rxo-video-play-icon';
}

?>
<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="container position-relative py-xl-4-5 py-lg-4-5 py-md-4-5 py-sm-6">
        <?php if($video_url):?>
            <div class="rxo-video-section <?= $cls_video_play_icon;?>">
                <?php if($poster_image):?>
                <img src="<?=$poster_image;?>">
                <?php endif; ?>
                <?=$video_url;?>
            </div>
        <?php elseif (show_block_error()) : ?>
            <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
                <div class="toast-body">
                    No video is available
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script>
        $(function() { 
            var videos  = $(".rxo-video-section");

                videos.on("click", function() {
                    var elm = $(this),
                        conts   = elm.contents(),
                        le      = conts.length,
                        ifr     = null;

                    for(var i = 0; i<le; i++){
                        if(conts[i].nodeType == 8) ifr = conts[i].textContent;
                    }

                    elm.addClass("player").html(conts);
                    elm.off("click");
                });
        });
    </script>
</div>