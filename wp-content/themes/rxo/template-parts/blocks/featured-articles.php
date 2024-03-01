<?php

/**
 * Block Name: Featured Articles
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

//$post_type = get_field('post_type');
$exclude_resource_POSTID = get_id_by_slug('all-resources','resource_center');
$max_post_count = 3;

$args = array(
    'numberposts'   => $max_post_count,
    'post_type'     => 'resource_center',
    'post_status'  => 'publish',
    'has_password' => FALSE,
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' => array($exclude_resource_POSTID),
    'meta_query'    => array(
        'relation'      => 'AND',
        array(
            'key'       => 'content_toggles',
            'value'     => 'featured',
            'compare'   => 'LIKE'
        ),
        array(
            'key'       => 'content_toggles',
            'value'     => 'not_recommendations',
            'compare'   => 'NOT LIKE'
        )
    )
);

$featured_posts = get_posts($args);
$featured_post_count = count($featured_posts);
$excluded_post_ids = array_column($featured_posts,'ID');
if($featured_post_count < $max_post_count) {
    $rc_args = array(
        "post_type" => 'resource_center',
        'post_status' => 'publish',
        'has_password' => FALSE,
        'orderby' =>'date',
        'order'=>'DESC',
        'meta_query'    => array(
            'relation'      => 'AND',
            array(
                'key'       => 'content_toggles',
                'value'     => 'not_recommendations',
                'compare'   => 'NOT LIKE'
            )
    
        )
    );
   $rc_args['posts_per_page'] = $max_post_count - $featured_post_count;
   $rc_args['post__not_in'] = array_merge($excluded_post_ids, [$exclude_resource_POSTID]);
   $rc_latest = get_posts($rc_args);
   if ($featured_post_count > 0) {
        $featured_posts = array_merge($featured_posts, $rc_latest);
    } else {
        $featured_posts = $rc_latest;
    }
   $featured_post_count = count($featured_posts);
}


$i = 0;
$check = 0; ?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <?php if ($featured_posts) : ?>
        <div class="row resource-center-wrap mt-6 mb-5-75 ">
        <?php foreach($featured_posts as $post) {
                $id = $post->ID;    
                $cat = get_post_taxonomies($id);
                if ($cat[0] == 'post_tag') {
                    unset($cat[0]);
                    $cat = array_values($cat);
                }
                $terms = get_the_terms($id, $cat[0]);
                $category = $terms[0]->name;
                
                $post_link = get_site_url().'/resource-center/'.$post->post_name;
                
                $short_title = get_field('short_title', $id);
                $short_description = get_field('short_description', $post->ID);
                $long_description = get_field('long_description',$post->ID); 
                if($i == 0) { ?>
                    <div class="col-xl-7 col-lg-12 col-12">
                        <div class="card-image overflow-hidden mb-2 rounded-4 ratio ratio-16x9">
                            <a href="<?= $post_link; ?>">
                                <?php if (!empty(get_the_post_thumbnail($id))) { ?>
                                    <?= get_the_post_thumbnail($id); ?>
                                <?php } else {
                                    echo '<img src="https://rxo.com/wp-content/uploads/2022/11/RXO_Graphic_LI_Brad_Post28.jpg" alt="RXO-Image" />';
                                } ?>
                            </a>                           
                        </div>

                        <p class="fw-600 m-0"><strong> <a href="<?= get_bloginfo('url').'/resource-center/categories/'. $terms[0]->slug; ?>"><?=$category;?></a>&nbsp;-&nbsp;<span class="gray-txt"><?php echo femscores_reading_time($id) .' read'; ?></span></strong></p>
                        
                        <?php if(!empty($short_title) || !empty($post->post_title)) { ?>
                            <h3 class="my-2"><a class="inherit-color" href="<?= $post_link; ?>"><?= ($short_title)?$short_title : $post->post_title; ?></a></h3>
                        <?php } ?>

                        <p>
                            <?php if(!empty($short_description)) { 
                                echo $short_description;
                            } elseif(!empty($long_description)) {
                                echo wp_trim_words( $long_description, 37 );
                            } else {
                                echo wp_trim_words($post->post_content , 37 );
                            } ?>
                        </p>
                        
                        <?php if(!empty($post_link)) { ?>
                            <a href="<?= $post_link ?>" class="btn btn-primary mb-sm-5">Read full article</a>
                        <?php } ?>

                    </div>
                <?php } else { 
                    if ($check==0){
                        echo '<div class="col-xl-5 col-lg-12 col-12">
                        <div class="row">';
                    }
                        
                    $id = $post->ID;
                    $post_link = get_site_url().'/resource-center/'.$post->post_name; ?>

                    <div class="col-xl-12 col-lg-6 col-12">
                        <div class="row mb-6">
                            <div class="col-xl-7 col-lg-12 col-12 ps-xl-3">            
                                <div class="card-image overflow-hidden rounded-4 mb-3 ratio ratio-16x9">
                                    <a href="<?= $post_link ?>">
                                        <?php if (!empty(get_the_post_thumbnail($id))) { ?>
                                            <?= get_the_post_thumbnail($id); ?>
                                        <?php } else {
                                            echo '<img src="https://rxo.com/wp-content/uploads/2022/11/RXO_Graphic_LI_Brad_Post28.jpg" alt="RXO-Image" />';
                                        } ?>
                                    </a>
                                </div>
                            </div><!-- #col-6 -->
                            <div class="col-xl-5 col-lg-12 col-12 ps-xl-0">                
                                <p class="mb-1"><strong> <a href="<?= get_bloginfo('url').'/resource-center/categories/'.$terms[0]->slug ?>/"><?= $category; ?></a>&nbsp;-&nbsp;<span class="gray-txt"><?php echo femscores_reading_time($id) .' read'; ?></span></strong></p>  

                                <?php if(!empty($short_title) || !empty($post->post_title)) { ?>
                                    <h5 class="post-link-title pt-0 my-2">
                                        <a href="<?= $post_link ?>" class="inherit-color">
                                            <?= ($short_title) ? $short_title : $post->post_title; ?>
                                        </a>
                                    </h5>
                                <?php } ?>
                                
                                <p class="mb-2">
                                <?php if(!empty($short_description)) { 
                                        echo $short_description;
                                    } elseif(!empty($long_description)) {
                                        echo wp_trim_words( $long_description, 8 );
                                    } else {
                                        echo wp_trim_words($post->post_content , 8 );
                                    } ?>
                                </p>

                                <div>
                                    <a href="<?= $post_link ?>" class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" <?= $link_attributes ?>><strong>Learn more</strong></a>
                                </div><!-- #col-6 -->
                            </div><!-- #row -->
                        </div>
                    </div>
                        
                    <?php if ($check==0){
                        echo '</div">';
                    } ?>

                    <?php if ($check==0){
                        echo '</div">';
                        $check=1;
                    } ?>

                <?php }
             $i++; } ?>
                </div>
                </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No data available
            </div>
        </div>
    <?php endif; ?>
</div>