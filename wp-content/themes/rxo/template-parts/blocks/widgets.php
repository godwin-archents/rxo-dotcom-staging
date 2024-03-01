<?php

/**
 * Block Name: Widgets
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
?>
<?php


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


$block_type = get_field('block_type');

$pieces = parse_url(home_url());
$domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
$domain_name = explode('.',$domain);

?>
<?php
/*
echo "UID=".$uid."<br/>";
echo "THEME=".$theme."<br/>";
echo "className=".$className."<br/>";
echo "block_type=".$block_type."<br/>";
*/
?>

<?php

if($block_type=='stay_connected') {

/*  stay Connected */

$section_title = get_field('section_title');

//$selected_form = get_field('choose_form');
$selected_form = 2128;
?>

<div class="<?php echo $uid; ?> <?php echo esc_attr($className); ?> ">
        <div class="container position-relative  py-7 d-flex flex-column ">
            <div class="wp-block-columns is-layout-flex wp-container-3">

                <div class="wp-block-column is-layout-flow">
                    <?php if ($section_title) : ?>
                        <?php if ($theme=='dark') : ?>
                        <h3 class="wp-block-heading has-white-color has-text-color"><?php echo $section_title; ?></h3>
                        <?php endif; ?>
                        <?php if ($theme!='dark') : ?>
                        <h3 class="wp-block-heading has-text-color"><?php echo $section_title; ?></h3>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <div class="wp-block-column is-layout-flow">
                    <?php if ($selected_form) : ?>
                    <?php echo do_shortcode('[wpforms id="'.$selected_form.'"]');?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
</div>

<?php } ?>

 <?php

if($block_type=='curated_series') {

/*  Curated Series */

$section_title = get_field('section_title');

//[125,105]
$selected_posts = get_field('posts');

$button_text = get_field('button_text');
$button_link = get_field('button_link');
$button_id = get_field('button_id');

$max_post_count = 3;
$post_type = 'resource_center';

// Get the current article ID
$current_article_id = get_the_ID();
$exclude_resource_POSTID = get_id_by_slug('all-resources','resource_center');

$excluded_post_ids = (!empty($selected_posts))?array_merge([$current_article_id], $selected_posts):array_merge([$exclude_resource_POSTID],[$current_article_id]);

$post_ids = (!empty($selected_posts))?$selected_posts:'';
$selected_post_count = (!empty($selected_posts))?count($selected_posts):'0';

if ($selected_post_count < $max_post_count) {
    $args = array(
        "post_type" => $post_type,
        'post_status' => 'publish',
        'has_password' => FALSE,
        'posts_per_page' => $max_post_count - $selected_post_count,
        'meta_query'    => array(
            'relation'      => 'AND',
            array(
                'key'       => 'content_toggles',
                'value'     => 'not_recommendations',
                'compare'   => 'NOT LIKE'
            )

        )
    );
    $args['post__not_in'] = $excluded_post_ids;

    $post_category = wp_get_post_terms($current_article_id, $post_type == 'resource_center' ? 'resource_center_category' : 'news_category', array('fields' => 'ids'));

    if ($post_category) {
        $args['tax_query'] = array(
            'relation' => 'OR',
        );

        $args['tax_query'][] = array(
            'taxonomy' => 'resource_center_category',
            'field'    => 'id',
            'terms'    => $post_category,
            'operator' => 'IN',
        );
    }
    
    $rc_curated_posts = new WP_Query($args);  
    $post_ids = (!empty($selected_posts))?array_merge($selected_posts, wp_list_pluck($rc_curated_posts->posts, 'ID')):$rc_curated_posts->posts;
}

$cls_cat_name_min_read = 'mb-3';
$cls_desc_section = 'my-3';
$cls_mb_curated = 'mb-5';

?>

<div class="<?php echo $uid; ?> <?php echo esc_attr($className); ?> rc-curated-series">
<div class="container position-relative py-3">
    <div class="row mt-3-5 mb-6 heading-with-link-end align-items-center">
        <?php if ($section_title) : ?>
            <div class="col-xl-9 col-lg-9 col-md-8 col-12">
                <h3 class="m-0"><?php echo $section_title; ?></h3>
            </div>
        <?php endif; ?>
        <div class="col-xl-3 col-lg-3 col-md-4 col-12 mb-4 mb-md-0 text-end">
            <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
        </div>
    </div>
    <?php if (count($post_ids)) : ?>
        <div class="row mb-11-5">
            <?php
            foreach ($post_ids as $post_id) {
                get_template_part(
                    'template-parts/filter-templates/post-news-article',
                    'news_template',
                    array(
                        'post_type' => 'resource_center',
                        'display_image' => true,
                        'post_layout' => 'three-posts',
                        'post_count' => 3,
                        'theme' => $theme,
                        'id' => $post_id,
                        'cls_cat_name_min_read' => $cls_cat_name_min_read,
                        'cls_desc_section' => $cls_desc_section,
                        'cls_mb_curated' => $cls_mb_curated,
                    )
                );
            }
            ?>
        </div>
        <?php if ($button_placement === 'bottom') : ?>
            <div class="my-5 text-center">
                <a class="btn btn-primary" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
            </div>
        <?php endif; ?>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No data available
            </div>
        </div>
    <?php endif; ?>
</div>
</div>

<?php } ?>

<?php

if( ($block_type=='latest_news') && ($domain_name[0] == 'dotcomdev' || $domain_name[0] == 'dotcomstg' || $domain_name[0] == 'rxo')) {


/* Latest news */

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

$exclude_news_POSTID = get_id_by_slug('press-releases','news_article');

global $wp_session;
$featured_post_id = (isset($wp_session['featured_post_id']))?$wp_session['featured_post_id']:'';

$section_title = get_field('section_title');
$button_placement = get_field('button_placement');
$button_text = get_field('button_text');
$button_link = get_field('button_link');
$button_id = get_field('button_id');

$post_layout = get_field('post_layout');
$post_type = get_field('post_type');
$post_count = get_field('post_count');

$args = array(
    'post_type' => $post_type,
    'post_status' => 'publish',
    'has_password' => FALSE,
    'posts_per_page' => $post_count
);

if($featured_post_id && is_page('news')){
    $args['post__not_in'] = array_merge([$exclude_news_POSTID],[$featured_post_id]);
}else{
    $args['post__not_in'] = array($exclude_news_POSTID);

}
$news_categories = get_field('news_categories');
if ($news_categories) {
    $args['tax_query'] = array(
        'relation' => 'OR'
    );

    foreach ($news_categories as $news_category) {
        $args['tax_query'][] = array(
            'taxonomy' => $news_category->taxonomy,
            'field' => 'slug',
            'terms' => $news_category->slug,
        );
    }
}

// the query
$the_query = new WP_Query($args);
?>

<div id="<?= $uid; ?>" class="<?= $className; ?> position-relative">
<div class="container position-relative py-3">
    <div class="row align-items-center">
        <?php if ($section_title) : ?>
            <div class="col">
                <h3 class="py-3"><?= $section_title; ?></h3>
            </div>
        <?php endif; ?>
        <?php if ($button_placement === 'top') : ?>
            <div class="col-auto mb-4 mb-md-0 text-end">
                <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($the_query->have_posts()) : ?>
        <div class="row">
            <?php while ($the_query->have_posts()) : $the_query->the_post();
                get_template_part(
                    'template-parts/filter-templates/post-news-article',
                    'news_template',
                    array(
                        'display_image' => get_field('display_image'),
                        'hide_category' => get_field('hide_category'),
                        'post_layout' => $post_layout,
                        'post_count' => $post_count,
                        'theme' => $theme,
                        'id' => $post->ID
                    )
                );
            endwhile;
            ?>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php if ($button_placement === 'bottom') : ?>
            <div class="my-5 text-center">
                <a class="btn btn-primary" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
            </div>
        <?php endif; ?>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No data available
            </div>
        </div>
    <?php endif; ?>
</div>    
</div>
<?php } ?>

<?php

if($block_type=='latest_resource_center') {

/* Block Name: Latest Articles  */

$uid = $block['anchor'] ?? 'rxo-block-' . str_replace('block_', '', $block['id']);

$className = 'rxo-block-' . str_replace('acf/rxo-acf-', '', $block['name']);
$className .= ' ' . $block['className'] ?? '';
$className .= ' ' . $block['align'] ?? '';

$theme = get_field('theme');
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : '');

$section_title = get_field('section_title');
$button_text = get_field('button_text');
$button_link = get_field('button_link');
$button_id = get_field('button_id');
$exclude_resource_POSTID = get_id_by_slug('all-resources','resource_center');

$excluded_post_ids = (!empty($selected_posts))?array_merge([$exclude_resource_POSTID],[$current_article_id], $selected_posts):array_merge([$exclude_resource_POSTID],[$current_article_id]);

$args = array(
    'post_type' => 'resource_center',
    'post_status' => 'publish',
    'has_password' => FALSE,
    'orderby' => 'date', 
    'order' => 'DESC',
    'posts_per_page' => 3,
    'post__not_in' => $excluded_post_ids,
    'meta_query' => array (
        'relation' => 'AND',
            array (
                'key' => 'content_toggles',
                'value' => 'not_recommendations',
                'compare' => 'NOT LIKE',
            ),

            array(
                'key'       => 'content_toggles',
                'value'     => 'featured',
                'compare'   => 'NOT LIKE',
            ),
    ),
);


$latest_posts = get_posts($args);


$cls_la_mb_space = ' mb-xl-0 mb-lg-0 mb-sm-5';
?>

<div id="<?= $uid; ?>" class="<?= $className; ?> position-relative rc-latest-articles">
<div class="container position-relative py-3">
    <div class="row align-items-center mb-6">
        <?php if ($section_title) : ?>
            <div class="col-xl-10 col-lg-9 col-md-8 col-12">
                <h3 class="m-0"><?= $section_title; ?></h3>
            </div>
        <?php endif; ?>
        <div class="col-xl-2 col-lg-3 col-md-4 col-12 text-end">
            <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
        </div>
    </div>
    <?php if ($latest_posts) : ?>
        <div class="row mb-4-5">
            <?php foreach($latest_posts as $post):
                get_template_part(
                    'template-parts/filter-templates/post-news-article',
                    'news_template',
                    array(
                        'post_type' => 'resource_center',
                        'theme' => $theme,
                        'id' => $post->ID,
                        'cls_la_mb_space' => $cls_la_mb_space,
                    )
                );
            endforeach;
            ?>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php if ($button_placement === 'bottom') : ?>
            <div class="my-5 text-center">
                <a class="btn btn-primary" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
            </div>
        <?php endif; ?>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No data available
            </div>
        </div>
    <?php endif; ?>
</div>    
</div>

<?php } ?>

<?php

if($block_type=='deeper_dive') {

/*  Deeper Dive */


$section_title = get_field('section_title');
$max_post_count = 2;

$button_text = get_field('button_text');
$button_link = get_field('button_link');
$button_id = get_field('button_id');

$randomize_recommendations = get_field('randomize_recommendations');

$rc_category_section_title = get_field('rc_category_section_title');
$rc_category_section_description = get_field('rc_category_section_description');


$cls_main = '<div class="col-xl-12 col-lg-6 col-12 mb-md-5 mb-sm-5 pe-xl-0">';
$cls_row1 = '<div class="row ps-xl-3">';
$cls_split_left = '<div class="col-xl-5 col-lg-12 col-12 p-xl-0">';
$cls_split_right = '<div class="col-xl-7 col-lg-12 col-12">';
$cls_cat_title = 'rc-cat-link';
$cls_dd_post_title = 'rc-dd-post-title';

$title_cls = is_singular('resource_center') ? 'pb-5 m-0' : 'py-3';
$post_type = 'resource_center';

// For Resource by Category
$rc_taxonomies = get_object_taxonomies(array('post_type' => 'resource_center'));
$exclude_resource_POSTID = get_id_by_slug('all-resources','resource_center');
// Get the current article ID
$current_article_id = get_the_ID();
$excluded_post_ids = array_merge([$current_article_id],[$exclude_resource_POSTID]);


$args = array(
    'post_type' => $post_type,
    'post_status' => 'publish',
    'has_password' => FALSE,
    'posts_per_page' => $max_post_count,
    'meta_query' => array(
        'relation'      => 'AND',
        array(
            'key'       => 'content_toggles',
            'value'     => 'not_recommendations',
            'compare'   => 'NOT LIKE'
        )
    )
);

// RC article detail page
if (is_singular('resource_center')) {
    $args['post__not_in'] = $excluded_post_ids;
}else{
    $args['post__not_in'] = array($exclude_resource_POSTID);
}

// if random flag is checked
if ($randomize_recommendations == true) {
    // the query
    $args['orderby'] = 'rand';
} else {
    // By defult order by latest publish date
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
}

$post_category = wp_get_post_terms($current_article_id, $post_type == 'resource_center' ? 'resource_center_category' : 'news_category', array('fields' => 'ids'));
$post_tags = wp_get_post_terms($current_article_id, 'post_tag', array('fields' => 'ids'));

if ($post_category) {
    $args['tax_query'] = array(
        'relation' => 'AND',
    );

    $args['tax_query'][] = array(
        'taxonomy' => 'resource_center_category',
        'field'    => 'id',
        'terms'    => $post_category,
        'operator' => 'IN',
    );

    if ($post_tags && count($post_tags)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'post_tag',
            'field' => 'id',
            'terms' => $post_tags,
            'operator' => 'IN',
        );
    }
}

$rc_dd_articles = new WP_Query($args);
$rc_dd_articles->post_count = count($rc_dd_articles->posts);

// Condition checking if post count is less than max post count display latest articles of same category as the current post
if (($rc_dd_articles->post_count < $max_post_count) && $post_category) {
    $args['tax_query'] = array(
        'relation' => 'OR',
    );

    $args['tax_query'][] = array(
        'taxonomy' => 'resource_center_category',
        'field'    => 'id',
        'terms'    => $post_category,
        'operator' => 'IN',
    );

    $args['posts_per_page'] = $max_post_count - $rc_dd_articles->post_count;
    $args['post__not_in'] = array_merge($excluded_post_ids, wp_list_pluck($rc_dd_articles->posts, 'ID'));

    $tax_related = new WP_Query($args);
    if ($rc_dd_articles->post_count > 0) {
        $rc_dd_articles->posts = array_merge($rc_dd_articles->posts, $tax_related->posts);
    } else {
        $rc_dd_articles->posts = $tax_related->posts;
    }
    $rc_dd_articles->post_count = count($rc_dd_articles->posts);
}

// Condition checking if post count is less than max post count display latest articles of resource center
if ($rc_dd_articles->post_count < $max_post_count) {
    unset($args['tax_query']);

    $args['posts_per_page'] = $max_post_count - $rc_dd_articles->post_count;
    $args['post__not_in'] = array_merge($excluded_post_ids, wp_list_pluck($rc_dd_articles->posts, 'ID'));

    $post_related = new WP_Query($args);
    if ($rc_dd_articles->post_count > 0) {
        $rc_dd_articles->posts = array_merge($rc_dd_articles->posts, $post_related->posts);
    } else {
        $rc_dd_articles->posts = $post_related->posts;
    }
    $rc_dd_articles->post_count = count($rc_dd_articles->posts);
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?> position-relative">
    <div class="row mt-6 mb-7 heading-with-link-end align-items-center rxo-deeper-dive-sec rxo-deeper-dive-sec--heading">
        <?php if ($section_title) : ?>
            <div class="col-xl-9 col-lg-9 col-md-8 col-12 ps-xl-0 ps-sm-3">
                <h3 class="mt-xl-0 mb-md-0 mb-sm-0"><?= $section_title; ?></h3>
            </div>
        <?php endif; ?>
        <div class="col-xl-3 col-lg-3 col-md-4 col-12 pe-xl-0 ps-sm-3 pe-md-3 text-end">
            <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
        </div>
    </div>

    <div class="row rxo-deeper-dive-sec rxo-deeper-dive-sec--content">
        <div class="col-xl-6 col-lg-12 col-12 rc-deeper-dive-left mb-5 rc-deeper-dive-left rxo-deeper-dive-sec--content-left pe-xl-0">
            <?php if ($rc_dd_articles->have_posts()) : ?>
                <div class="row align-items-start">
                    <?php while ($rc_dd_articles->have_posts()) : $rc_dd_articles->the_post();
                        get_template_part(
                            'template-parts/filter-templates/post-news-article',
                            'news_template',
                            array(
                                'post_type' => 'resource_center',
                                'post_count' => $max_post_count,
                                'theme' => $theme,
                                'id' => get_the_ID(),
                                'cls_main' => $cls_main,
                                'cls_row1' => $cls_row1,
                                'cls_split_left' => $cls_split_left,
                                'cls_split_right' => $cls_split_right,
                                'cls_cat_title' => $cls_cat_title,
                                'cls_dd_post_title' => $cls_dd_post_title,

                            )
                        );
                    endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php elseif (show_block_error()) : ?>
                <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
                    <div class="toast-body">
                        No data available
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-xl-1 col-12">&nbsp;</div>
        <div class="col-xl-5 col-lg-12 col-12 rc-deeper-dive-right rxo-deeper-dive-sec--content-right p-xl-0">
            <div class="resource-center-cat-wrap bg-light">
                <div class="resource-center-cat-wrap-inner">
                    <?php if ($rc_category_section_title) : ?>
                        <h4 class="m-0 pb-3"><?php echo $rc_category_section_title; ?></h4>
                    <?php endif;

                    if (!empty($rc_category_section_description)) : ?>
                        <p class="mb-5"><?= $rc_category_section_description; ?></p>
                        <?php endif;

                    echo '<ul>';
                    if ($rc_taxonomies) :
                        foreach ($rc_taxonomies as $taxonomy) :
                            $terms = get_terms($taxonomy) ?>
                            <?php foreach ($terms as $term) :
                                if ($term->taxonomy == 'resource_center_category') { ?>
                                    <li>
                                        <a class="btn btn-link btn-primary p-0 d-inline" href="<?php echo get_site_url() . '/resource-center/categories/' . $term->slug; ?>" title="<?php echo $term->name; ?>"><?php echo $term->name; ?></a>
                                    </li>
                            <?php }
                            endforeach; ?>
                        <?php endforeach; ?>
                    <?php endif;
                    echo '</ul>'; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>


<?php

if($block_type=='leadership') {

/* Leadership */

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
?>


<div id="<?= $uid; ?>" class="<?= $className; ?>">
<div class="container position-relative py-3">
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
                <div class="text-center col-12 m-auto pt-6 col-md-5 d-lg-none">
                    <button type="button" id="loadMore" class="btn btn-outline-white w-100">View More</button>
                </div>
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
                <div class="text-center col-12 m-auto pt-6 col-md-5 d-lg-none">
                    <button type="button" id="loadMore" class="btn btn-outline-white w-100">View More</button>
                </div>
            </div>
        <?php  } ?>
    </div>
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
<?php } ?>