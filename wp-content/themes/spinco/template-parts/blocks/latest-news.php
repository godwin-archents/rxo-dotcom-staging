<?php

/**
 * Block Name: Latest news
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 */

// create id attribute for specific styling
$uid = 'spinco-block-' . $block['id'];

$className = 'spinco-block ' . str_replace('acf/spinco-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$mode = get_field('theme');

if ($mode === 'dark') {
    $className .= ' bg-dark text-white ';
}

$mode = get_field('theme');
$className .= ($mode === 'dark') ? ' bg-black text-white' : '';

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
    'posts_per_page' => $post_count
);

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
    <div class="row align-items-center">
        <?php if ($section_title) : ?>
            <div class="col">
                <h2 class="py-3"><?= $section_title; ?></h2>
            </div>
        <?php endif; ?>
        <?php if ($button_placement === 'top') : ?>
            <div class="col-auto mb-4 mb-md-0 text-end">
                <a class="btn btn-link <?= ($mode === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($the_query->have_posts()) : ?>
        <div class="row gx-5">
            <?php while ($the_query->have_posts()) : $the_query->the_post();
                get_template_part(
                    'template-parts/filter-templates/post-news-article',
                    'news_template',
                    array(
                        'display_image' => get_field('display_image'),
                        'hide_category' => get_field('hide_category'),
                        'post_layout' => $post_layout,
                        'post_count' => $post_count,
                        'mode' => $mode,
                        'id' => $post->ID
                    )
                );
            endwhile;
            ?>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php if ($button_placement === 'bottom') : ?>
            <div class="my-5 text-center">
                <a class="btn <?= ($mode === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $button_link; ?>" <?= $button_id ? 'id="' . $button_id . '"' : ''; ?>><?= $button_text; ?></a>
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