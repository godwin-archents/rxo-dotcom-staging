<?php

/**
 * Block Name: Deeper Dive
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

$section_title = get_field('section_title');
$max_post_count = 2;

$button_text = get_field('button_text');
$button_link = get_field('button_link');
$button_id = get_field('button_id');

$randomize_recommendations = get_field('randomize_recommendations');

$rc_category_section_title = get_field('rc_category_section_title');
$rc_category_section_description = get_field('rc_category_section_description');

$show_search_bar_or_deeper_dive = get_field('show_search_bar_or_deeper_dive');

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

if($show_search_bar_or_deeper_dive == "deeper_dive_articles") {          
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
     
}

?>

<div id="<?= $uid; ?>" class="<?= $className; ?> position-relative pt-6 pb-xl-6 pb-lg-0 pb-md-0 pb-sm-0">

    <?php if ( !empty($section_title) || !empty($button_link) ) : ?>
        <div class="row mb-6 heading-with-link-end align-items-center rxo-deeper-dive-sec rxo-deeper-dive-sec--heading">
            <div class="col-xl-9 col-lg-9 col-md-8 col-12 ps-xl-0 ps-sm-3">
                <h3 class="mt-xl-0 mb-md-0 mb-sm-0"><?= $section_title; ?></h3>
            </div>            
            <div class="col-xl-3 col-lg-3 col-md-4 col-12 pe-xl-0 ps-sm-3 pe-md-3 text-end">
                <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
            </div>
        </div>
    <?php endif; ?>

    <div class="row rxo-deeper-dive-sec rxo-deeper-dive-sec--content <?php if($show_search_bar_or_deeper_dive != "deeper_dive_articles") { echo 'align-items-center'; } ?>">
        <div class="col-xl-6 col-lg-12 col-12 rc-deeper-dive-left mb-5 rxo-deeper-dive-sec--content-left pe-xl-0">
        <?php 
        if($show_search_bar_or_deeper_dive == "deeper_dive_articles") {
            if ($rc_dd_articles->have_posts()) : ?>
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
            <?php } else { ?>
            <div class="container p-0">
                <h4>Search all RXO resources</h4>
                <form class="align-items-center border-2 border-bottom border-primary-dark d-flex" action="/" method="GET" id="searchform-page">
                    <input type="text" placeholder="Search for people, technology, capabilities, etc" name="s" id="search-page-input" class="form-control flex-grow-1 order-1 border-0 bg-transparent" oninput="searchTypeFunction()" required>
                    <input type="hidden" name="post_type" value="resource_center" />
                    <button class="btn btn-link py-0" type="submit" aria-label="search">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6368 11.8022C9.52023 12.6702 8.11723 13.187 6.59352 13.187C2.95202 13.187 0 10.235 0 6.59352C0 2.95202 2.95202 0 6.59352 0C10.235 0 13.187 2.95202 13.187 6.59352C13.187 8.11718 12.6702 9.52013 11.8023 10.6366L16 14.8343L14.8344 15.9998L10.6368 11.8022ZM11.5387 6.59352C11.5387 9.32463 9.32463 11.5387 6.59352 11.5387C3.8624 11.5387 1.64838 9.32463 1.64838 6.59352C1.64838 3.8624 3.8624 1.64838 6.59352 1.64838C9.32463 1.64838 11.5387 3.8624 11.5387 6.59352Z" fill="#1C1C1C"></path>
                        </svg>
                    </button>
                    <button id="search-page-clear-btn" class="btn btn-link py-0 order-3" type="button" aria-label="close searchbar" onclick="searchClearFunction()">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.53267 8L15.6633 1.86253C16.0886 1.43681 16.0886 0.745011 15.6633 0.31929C15.2381 -0.10643 14.5471 -0.10643 14.1218 0.31929L7.99114 6.45676L1.86047 0.337029C1.43522 -0.0886917 0.744186 -0.0886917 0.318937 0.337029C-0.106312 0.762749 -0.106312 1.45455 0.318937 1.88027L6.44961 8L0.336656 14.1375C-0.0885936 14.5632 -0.0885936 15.255 0.336656 15.6807C0.761905 16.1064 1.45293 16.1064 1.87818 15.6807L8.00886 9.54324L14.1395 15.6807C14.5648 16.1064 15.2558 16.1064 15.6811 15.6807C16.1063 15.255 16.1063 14.5632 15.6811 14.1375L9.53267 8Z" fill="#1C1C1C"></path>
                        </svg>
                    </button>
                </form>
            </div>
        <?php } ?>
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