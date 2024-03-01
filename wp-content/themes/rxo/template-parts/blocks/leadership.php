<?php

/**
 * Block Name: Leadership
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

$button_text = get_field('leadership_button_text');

$executive_IDs = array();
if (have_rows('executives')) :
    while (have_rows('executives')) : the_row();
        $executive_IDs[] = get_sub_field('leadership_name');
    endwhile;
endif;
if (!empty($executive_IDs)) {
    $exeargs = array(
        'post_type'         => 'leadership',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby' => 'post__in',
        'post__in' => $executive_IDs,
    );

    $exec_query = new WP_Query($exeargs);
}

$directors_IDs = array();
if (have_rows('board_of_directors')) :
    while (have_rows('board_of_directors')) : the_row();
        $directors_IDs[] = get_sub_field('board_leadership_name');
    endwhile;
endif;

if (!empty($directors_IDs)) {
    $boardargs = array(
        'post_type'         => 'leadership',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'           => 'post__in',
        'post__in'             => $directors_IDs,

    );

    $board_query = new WP_Query($boardargs);
}

if (!empty($executive_IDs)) {
    $executive_leaderCount = count($executive_IDs);
} else {
    $executive_leaderCount = 0;
}

if (!empty($directors_IDs)) {
    $directors_leaderCount = count($directors_IDs);
} else {
    $directors_leaderCount = 0;
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="border-0 border-bottom justify-content-center nav nav-tabs" id="tabs_<?= $uid; ?>" role="tablist">
        <?php if (!empty($executive_IDs)) { ?>
            <button class="active nav-link bg-transparent fw-600" id="nav-executive-tab" data-bs-toggle="tab" data-bs-target="#nav-executive" type="button" role="tab" aria-controls="nav-executive" aria-selected="true">Executive Team</button>
        <?php }
        if (!empty($directors_IDs)) { ?>
            <button class="nav-link bg-transparent fw-600" id="nav-directors-tab" data-bs-toggle="tab" data-bs-target="#nav-directors" type="button" role="tab" aria-controls="nav-directors" aria-selected="false">Board of Directors</button>
        <?php } ?>
    </div>
    <div class="pt-4 pt-md-3 tab-content" id="nav-tabContent">
        <?php if (!empty($executive_IDs)) { ?>
            <div class="tab-pane fade show active" id="nav-executive" role="tabpanel" aria-labelledby="nav-executive-tab">
                <div class="row m-n3">
                    <?php
                    while ($exec_query->have_posts()) {
                        $exec_query->the_post();
                        get_template_part('template-parts/filter-templates/post-leadership');
                    }
                    ?>
                </div>
                <?php if($executive_leaderCount>4) { ?>
                <div class="text-center col-12 m-auto pt-6 col-md-5 d-lg-none d-xl-none">
                    <button type="button" id="loadMore" class="btn btn-outline-white w-100">View More</button>
                </div>
                <?php } ?>
            </div>
        <?php }
        if (!empty($directors_IDs)) { ?>
            <div class="tab-pane fade" id="nav-directors" role="tabpanel" aria-labelledby="nav-directors-tab">
                <div class="row m-n3">
                    <?php
                    while ($board_query->have_posts()) {
                        $board_query->the_post();
                        get_template_part('template-parts/filter-templates/post-leadership');
                    }

                    ?>
                </div>
                <?php if($directors_leaderCount>4) { ?>
                <div class="text-center col-12 m-auto pt-6 col-md-5 d-lg-none">
                    <button type="button" id="loadMore" class="btn btn-outline-white w-100">View More</button>
                </div>
                <?php } ?>
            </div>
        <?php  } ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        var win = $(window);

        var screen = {
            width: win.width(),
            height: win.height()
        };
        if (screen.width < 800) {
            $(".content").hide().slice(0, 4).show();
            $("#loadMore").on("click", function(e) {
                $("#loadMore").blur();
                $(".content:hidden").slice(0, 4).slideDown();
                if ($(".content:hidden").length == 0) {
                    $("#loadMore").parent().hide();
                }
            });
        }
    });
</script>