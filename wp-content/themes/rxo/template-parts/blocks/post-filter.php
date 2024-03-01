<?php

/**
 * Block Name: News filter 
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

$url_params = [];
$selected_category = filter_var($_REQUEST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
foreach ($_REQUEST as $key => $value) {
    $url_params[$key] = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

$post_type = get_field('post_type');
$posts_per_page = get_field('posts_per_page');
$post_categories = get_field('post_categories');
$hide_category = false;
$current_page = 1;

$args = array(
    'posts_per_page'    => $posts_per_page,
    'post_type'         => $post_type,
    'post_status'       => 'publish',
    'has_password'      => FALSE,
    'paged'             => $current_page,
    'orderby'           => 'date',
    'order'             => !empty($url_params['order']) ? $url_params['order'] : 'DESC'
);

if (!empty($url_params['date_after']) && !empty($url_params['date_before'])) {
    $date_before = date_create_from_format("j/M/y", $url_params['date_before']);
    $url_params['date_before'] = !empty($date_before) ? $date_before->format('m/d/Y') : $url_params['date_before'];
    $date_after = date_create_from_format("j/M/y", $url_params['date_after']);
    $url_params['date_after'] = !empty($date_after) ? $date_after->format('m/d/Y') : $url_params['date_after'];

    if ($url_params['date_after'] === $url_params['date_before']) {
        $args['date_query'] = array(
            array(
                'year'  => $date_after->format('Y'),
                'month' => $date_after->format('m'),
                'day'   => $date_after->format('d')
            ),
        );
    } else {
        $args['date_query'] = array(
            array(
                'after' => $url_params['date_after'],
                'before' => $url_params['date_before'],
                'inclusive' => true
            ),
        );
    }
}

$cat_index = 0;
$cat_filter = false;

if ($post_categories) {
    foreach ($post_categories as $index => $term) {
        $count = count_posts_with_term($term->taxonomy, $term->slug, $post_type);
        if (!$count) {
            unset($post_categories[$index]);
        }
    }
    $post_categories = array_values($post_categories);

    // Don't combine foreach loops as index needs to be reset
    foreach ($post_categories as $index => $term) {
        if (!empty($url_params[$term->taxonomy]) && $url_params[$term->taxonomy] === $term->slug) {
            $cat_index = $index;
            $cat_filter = true;
            break;
        }
    }

    $args['tax_query'] = array(
        'relation' => 'OR'
    );

    $hide_category = (count($post_categories) > 1) ? false : true;

    if ($cat_filter) {
        $hide_category = true;
        $args['tax_query'][] = array(
            'taxonomy' => $post_categories[$cat_index]->taxonomy,
            'field' => 'slug',
            'terms' => $post_categories[$cat_index]->slug
        );
    } else {
        foreach ($post_categories as $index => $term) {
            $args['tax_query'][] = array(
                'taxonomy' => $term->taxonomy,
                'field' => 'slug',
                'terms' => $term->slug
            );
        }
    }
}

// query posts
$query = new WP_Query($args);

$max_pages = $query->max_num_pages;
$is_max_paged = ($max_pages > $current_page) ? false : true;

if ($cat_filter) {
    $args['tax_query'] = array(
        'relation' => 'OR'
    );
    foreach ($post_categories as $index => $term) {
        $args['tax_query'][] = array(
            'taxonomy' => $term->taxonomy,
            'field' => 'slug',
            'terms' => $term->slug
        );
    }
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="filter-wrapper border-bottom pb-4 mb-2">
        <form id="filter-form" autocomplete="off">
            <div class="row justify-content-between font-demi">
                <?php if (count($post_categories) > 1) : ?>
                    <div class="col-12 taxonomy-filters text-center mb-5">
                        <?php foreach ($post_categories as $index => $term) { ?>
                            <?php if ($index == 0) : ?>
                                <div class="form-check form-check-inline mb-3 p-0">
                                    <input class="btn-check" type="radio" name="<?= $term->taxonomy ?>" id="<?= $term->taxonomy . '-0'; ?>" value="" <?= $index === $cat_index ? 'checked="checked"' : ''; ?>>
                                    <label class="btn btn-secondary" for="<?= $term->taxonomy . '-0'; ?>">All</label>
                                </div>
                            <?php endif; ?>
                            <div class="form-check form-check-inline mb-3 p-0">
                                <input class="btn-check" type="radio" name="<?= $term->taxonomy ?>" id="<?= $term->taxonomy . '-' . $term->term_id ?>" value="<?= $term->slug ?>" <?= ($index > 0) && ($index === $cat_index) ? 'checked="checked"' : ''; ?>>
                                <label class="btn btn-secondary" for="<?= $term->taxonomy . '-' . $term->term_id ?>"><?= $term->name ?></label>
                            </div>
                        <?php } ?>
                    </div>
                <?php endif; ?>
                <div class="col-12 col-md-8 date-filters text-start mb-3">
                    <div class="d-flex align-items-center flex-wrap gap-3" id="filter-daterange" data-post-type="<?= $post_type ?>">
                        <input type="text" class="form-control" placeholder="From" name="date_after">
                        <div>
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24.7071 16.7071C25.0976 16.3166 25.0976 15.6834 24.7071 15.2929L18.3431 8.92893C17.9526 8.53841 17.3195 8.53841 16.9289 8.92893C16.5384 9.31946 16.5384 9.95262 16.9289 10.3431L22.5858 16L16.9289 21.6569C16.5384 22.0474 16.5384 22.6805 16.9289 23.0711C17.3195 23.4616 17.9526 23.4616 18.3431 23.0711L24.7071 16.7071ZM8 17L24 17L24 15L8 15L8 17Z" fill="#000"></path>
                            </svg>
                        </div>
                        <input type="text" class="form-control" placeholder="To" name="date_before">
                    </div>
                </div>
                <div class="col-12 col-md-4 date-sort mb-3">
                    <div class="d-md-flex justify-content-end">
                        <select name="order" class="form-select js-choice">
                            <option selected disabled value="">Sort By</option>
                            <option value="DESC">Newest To Oldest</option>
                            <option value="ASC">Oldest to Newest</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row" id="filtered-results" data-filter-args='<?= base64_encode(json_encode($args)) ?>' data-filter-page="<?= ++$current_page ?>" data-max-paged="<?= $is_max_paged ?>" data-action="rxo_news_filter_posts">
        <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/filter-templates/post-news-article', 'news_template', array('display_image' => true, 'hide_category' => $hide_category));
            endwhile; ?>
        <?php elseif (show_block_error()) : ?>
            <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
                <div class="toast-body">
                    No data available
                </div>
            </div>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </div>
    <h3 id="empty-results" class="text-danger col-12">No results found.</h3>
    <div id="ajax-loading-error" class="mb-5 text-danger"></div>
    <div id="ajax-loader-message" class="mb-5"></div>
</div>
<script>
    $(document).ready(function() {
        selectInputs = $('#<?= $uid; ?>').find('.js-choice');
        [].forEach.call(selectInputs, function(sEl, i) {
            let choices = new Choices(sEl, {
                searchEnabled: false,
                allowHTML: true,
                itemSelectText: '',
            });
        });
    });
</script>