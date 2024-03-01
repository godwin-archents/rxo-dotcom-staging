<?php

/**
 * Template part for displaying news article posts in custom filter block
 */
/** @var array $args */

$excerpt_length = $args['excerpt_length'] ?? 130;
$hide_category = $args['hide_category'] ?? false;
$post_count = $args['post_count'] ?? 3;
$post_layout = $args['post_layout'] ?? 'three-posts';
$mode = $args['mode'];
$id = $args['id'];

$title = get_the_title($id);

$category = '';

if (!$hide_category) {
    $cat = get_post_taxonomies($id);
    if ($cat[0] == 'post_tag') {
        unset($cat[0]);
        $cat = array_values($cat);
    }
    $terms = get_the_terms($id, $cat[0]);
    $category = $terms[0]->name;
}

$publish_date = get_the_date("M. j, Y", $id);

$post_link = get_the_permalink($id);
$link_attributes = '';
$link_text = 'Learn more';

if (get_field('attachment_link', $id)) {
    $post_link = get_field('attachment_link', $id);
    $link_attributes = 'download target="_blank" rel="noopener noreferrer"';
    $link_text = 'Download Report';
}

$cls = 'col-12 py-2 my-4';
$cls .= ' ' . ($post_layout == 'two-posts' ? 'col-lg-6' : 'col-lg-4');
$cls .= ' ' . ($post_count > 3 ? 'col-md-6' : 'col-md-12');

?>

<div class="<?= $cls ?>">
    <?php if ($args['display_image']) : ?>
        <div class="card-image mb-4 overflow-hidden rounded-4"><?= the_post_thumbnail('post-thumbnail'); ?></div>
    <?php endif; ?>

    <p><b><?= $category; ?></b></p>

    <h4 class="post-link-title pt-0 m-0">
        <a href="<?= $post_link ?>" class="inherit-color" <?= $link_attributes ?>>
            <?= $title; ?>
        </a>
    </h4>
    <p><?= post_excerpt_by_id($id, $excerpt_length); ?></p>
    <div class="mt-4">
        <a href="<?= $post_link ?>" class="btn btn-link <?= ($mode === 'dark' ? 'text-white' : 'text-black') ?>" <?= $link_attributes ?>>
            <?= $link_text; ?>
        </a>
    </div>
</div>