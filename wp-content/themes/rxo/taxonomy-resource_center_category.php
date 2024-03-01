<?php

/**
 * The template for displaying all Resource Center category articles
 *
 * @link https://developer.wordpress.org/themes/template-files-section/custom-post-type-template-files/
 * 
 * @package Rxo
 */

get_header();

$rc_tax = $wp_query->get_queried_object();
$exclude_resource_POSTID = get_id_by_slug('all-resources','resource_center');

$args = array(
    'posts_per_page'    => -1,
    'post_type'         => 'resource_center',
    'post_status'       => 'publish',
    'has_password'      => FALSE,
    'orderby'           => 'date',
    'order'             => 'DESC',
    'post__not_in' => array($exclude_resource_POSTID),
    'tax_query' => array(

        'relation' => 'AND',

        array(
            'taxonomy' => 'resource_center_category',
            'field'    => 'slug',
            'terms'    => $rc_tax->slug,
        ),
    ),
);

$rc_tax_args = new WP_Query($args);

$cls_btm_space = 'mb-5';
$no_cat_link = false;

?>

<main id="primary" class="site-main">
    <div class="container-fluid px-0 py-9 bg-pattern-search">
        <div class="container">
        <?php if($rc_tax->name !='') { ?>
            <h2 class="text-black"><?=$rc_tax->name;?></h2>
        <?php } ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-12 mb-5">
                <?php if ($rc_tax_args->have_posts()) : ?>
                <div class="row align-items-start">
                    <?php while ($rc_tax_args->have_posts()) : $rc_tax_args->the_post();
                        get_template_part(
                            'template-parts/filter-templates/post-news-article',
                            'news_template',
                            array(
                                'post_type' => 'resource_center',
                                'cls_btm_space' => $cls_btm_space,
                                'no_cat_link'  => $no_cat_link
                            )
                        );
                    endwhile; ?>
                </div>
                <?php wp_reset_postdata();
                elseif (show_block_error()) : ?>
                <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
                    <div class="toast-body">
                        No Resource Center Articles available
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
