<?php

/**
 * Block Name: Latest news
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

if( !empty($block['className']) ) { $className .= ' ' . $block['className']; }

if( !empty($block['align']) ) { $className .= ' ' . $block['align']; }

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
                        'id' => get_the_ID()
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