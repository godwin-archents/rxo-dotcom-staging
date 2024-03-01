<?php

/**
 * Block Name: Leadership section
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 */

// create id attribute for specific styling
$uid = 'spinco-acf-container-' . $block['id'];

$className = 'spinco-block ' . str_replace('acf/spinco-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$mode = get_field('theme');

if ($mode === 'dark') {
    $className .= ' bg-black text-white ';
}

$button_text = get_field('leadership_button_text');

$exeargs = array(
    'post_type'         => 'leadership',
    'post_status'       => 'publish',
    'posts_per_page'    => -1,
    'orderby' => 'post__in',
    'post__in' => array(2035, 2338, 2591, 2036, 2578, 2341, 2340, 2037, 2343, 2357, 2344, 2346),
    'tax_query' => array(
        array(
            'taxonomy' => 'leadership_category',
            'field'    => 'slug',
            'terms'    => 'executive-team',
        )
    )
);
$exec_query = new WP_Query($exeargs);
//$exec_query = array_reverse($exec_query_array);

// $boardargs = array(
//     'post_type'         => 'leadership',
//     'post_status'       => 'publish',
//     'posts_per_page'    => -1,
//     'orderby'           => 'ID',
//     'order'             => 'ASC',
//     'tax_query' => array(
//         array(
//             'taxonomy' => 'leadership_category',
//             'field'    => 'slug',
//             'terms'    => 'board-of-directors',
//         )
//     )
// );

// $board_query = new WP_Query($boardargs);
//$board_query = array_reverse($board_query_array);

?>

<div class="<?= $uid; ?> <?= esc_attr($className); ?>">
    <nav>
        <div class="border-0 border-bottom justify-content-center nav nav-tabs" id="nav-tab" role="tablist">
            <button class="active nav-link bg-transparent fw-600" id="nav-executive-tab" data-bs-toggle="tab" data-bs-target="#nav-executive" type="button" role="tab" aria-controls="nav-executive" aria-selected="true">Executive Team</button>
            <!-- <button class="nav-link bg-transparent fw-600" id="nav-directors-tab" data-bs-target="#nav-directors" type="button" role="tab" aria-controls="nav-directors" aria-selected="false">Board of Directors</button> -->
        </div>
    </nav>
    <div class="pt-4 pt-md-3 tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-executive" role="tabpanel" aria-labelledby="nav-executive-tab">
            <div class="row m-n3">
                <?php if ($exec_query->have_posts()) {
                    while ($exec_query->have_posts()) {
                        $exec_query->the_post();
                        get_template_part('template-parts/filter-templates/post-leadership');
                    }
                } ?>
            </div>
            <div class="text-center col-12 m-auto pt-6 col-md-5 d-lg-none">
                <button type="button" id="loadMore" class="btn btn-outline-white w-100">View More</button>
            </div>
        </div>
        <!-- <div class="tab-pane fade" id="nav-directors" role="tabpanel" aria-labelledby="nav-directors-tab">
            <div class="d-flex m-n3">
                <?php
                // if ($board_query->have_posts()) {
                //     while ($board_query->have_posts()) {
                //         $board_query->the_post();
                //         get_template_part('template-parts/filter-templates/post-leadership');
                //     }
                // }
                ?>
            </div>
        </div> -->
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