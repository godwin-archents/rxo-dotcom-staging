<?php

/**
 * Template part for displaying news article posts in custom filter block
 */
/** @var array $args */
if( isset($args['post_type']) && !empty($args['post_type']) ) { $post_type = $args['post_type']; } else { $post_type = ''; }
if( isset($args['excerpt_length']) && !empty($args['excerpt_length']) ) { $excerpt_length = $args['excerpt_length']; } else { $excerpt_length = 130; }
if( isset($args['hide_category']) && !empty($args['hide_category']) ) { $hide_category = $args['hide_category']; } else { $hide_category = false; }
if( isset($args['post_count']) && !empty($args['post_count']) ) { $post_count = $args['post_count']; } else { $post_count = 3; }
if( isset($args['post_layout']) && !empty($args['post_layout']) ) { $post_layout = $args['post_layout']; } else { $post_layout = 'three-posts'; }
if( isset($args['theme']) && !empty($args['theme']) ) { $theme = $args['theme']; } else { $theme = ''; }
 if( isset($args['id']) && !empty($args['id']) ) { $id = $args['id']; } else { $id = ''; } 

$title = get_the_title($id);

// Resource Center latest articles 
$short_title = get_field('short_title',$id);
$short_description = get_field('short_description',$id);
$long_description = get_field('long_description',$id);

$content_post = get_post($id);
$full_content = $content_post->post_content;

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
    $attachment_link = get_field('attachment_link', $id);
    $link_attributes = 'download target="_blank" rel="noopener"';
    $link_text = 'Download Report';
}

// Latest News
if( isset($args['display_image']) && !empty($args['display_image']) ) { $display_image = $args['display_image']; } else { $display_image = ''; } 

// All Posts section
if( isset($args['cls_btm_space']) && !empty($args['cls_btm_space']) ) { $cls_btm_space = $args['cls_btm_space']; } else { $cls_btm_space = ''; }
if( isset($args['no_cat_link']) && !empty($args['no_cat_link']) ) { $no_cat_link = $args['no_cat_link']; } else { $no_cat_link = ''; }
if( isset($args['col_mid_spacing']) && !empty($args['col_mid_spacing']) ) { $col_mid_spacing = $args['col_mid_spacing']; } else { $col_mid_spacing = ''; }

// Latest Article section
if( isset($args['cls_la_mb_space']) && !empty($args['cls_la_mb_space']) ) { $cls_la_mb_space = $args['cls_la_mb_space']; } else { $cls_la_mb_space = ''; }

// Deeper Dive Section fields
if( isset($args['cls_main']) && !empty($args['cls_main']) ) { $cls_main = $args['cls_main']; } else { $cls_main = ''; }
if( isset($args['cls_row1']) && !empty($args['cls_row1']) ) { $cls_row1 = $args['cls_row1']; } else { $cls_row1 = ''; }
if( isset($args['cls_split_left']) && !empty($args['cls_split_left']) ) { $cls_split_left = $args['cls_split_left']; } else { $cls_split_left = ''; }
if( isset($args['cls_split_right']) && !empty($args['cls_split_right']) ) { $cls_split_right = $args['cls_split_right']; } else { $cls_split_right = ''; }
if( isset($args['cls_dd_mb2']) && !empty($args['cls_dd_mb2']) ) { $cls_dd_mb2 = $args['cls_dd_mb2']; } else { $cls_dd_mb2 = ''; }
if( isset($args['cls_cat_title']) && !empty($args['cls_cat_title']) ) { $cls_cat_title = $args['cls_cat_title']; } else { $cls_cat_title = ''; }
if( isset($args['cls_dd_post_title']) && !empty($args['cls_dd_post_title']) ) { $cls_dd_post_title = $args['cls_dd_post_title']; } else { $cls_dd_post_title = ''; }

// Curated Series
if( isset($args['cls_cat_name_min_read']) && !empty($args['cls_cat_name_min_read']) ) { $cls_cat_name_min_read = $args['cls_cat_name_min_read']; } else { $cls_cat_name_min_read = ''; }
if( isset($args['cls_desc_section']) && !empty($args['cls_desc_section']) ) { $cls_desc_section = $args['cls_desc_section']; } else { $cls_desc_section = ''; }
if( isset($args['cls_mb_curated']) && !empty($args['cls_mb_curated']) ) { $cls_mb_curated = $args['cls_mb_curated']; } else { $cls_mb_curated = ''; }

// All RC posts
if( isset($args['cls_mb']) && !empty($args['cls_mb']) ) { $cls_mb = $args['cls_mb']; } else { $cls_mb = ''; }

if($post_type == 'resource_center' || is_singular( 'resource_center' )) {
    $cls = 'col-12 '.$cls_mb_curated.' '.$cls_btm_space. ' '.$cls_mb. ' '. $cls_la_mb_space;
} else {
    $cls = 'col-12 py-2 my-4';
}

$cls .= ' ' . ($post_layout == 'two-posts' ? 'col-lg-6' : 'col-lg-4');
$cls .= ' ' . ($post_count > 3 ? 'col-md-6' : 'col-md-12');

if(empty($cls_main)) { ?>

    <div class="<?= $cls ?>">

        <?php } if(!empty($cls_main)) {
            echo $cls_main;
        } if(!empty($cls_row1)) {
            echo $cls_row1;
        } 
        
        if(!empty($cls_split_left)) {
            echo $cls_split_left;
        }
        
        if(!empty($display_image) || $post_type == 'resource_center') { ?>

            <div class="card-image mb-4 overflow-hidden rounded-4 ratio ratio-16x9">
                <a href="<?= $post_link ?>">
                    <?php if (!empty(get_the_post_thumbnail($id))) { ?>
                        <?= get_the_post_thumbnail($id); ?>
                    <?php } else {
                        echo '<img src="https://rxo.com/wp-content/uploads/2022/11/RXO_Graphic_LI_Brad_Post28.jpg" alt="RXO-Image" />';
                    } ?>
                </a>
            </div>

        <?php } 

        if(!empty($cls_split_left)) {
            echo '</div>';
        } 
        
        if(!empty($cls_split_right)) {
            echo $cls_split_right;
        } ?>

            
        <?php if(is_tax('resource_center_category')) { ?>
            <p class="mb-2">
                <strong>
                    <span class="gray-txt"><?php echo femscores_reading_time($id) .' read'; ?></span>
                </strong>
            </p>
        <?php } elseif($post_type == 'resource_center' || is_singular( 'resource_center' )) { ?>
            <p class="mb-2 <?php echo $cls_cat_name_min_read.' '.$cls_cat_title ; ?>">
                <strong>
                    <a href="<?= get_bloginfo('url').'/resource-center/categories/'.$terms[0]->slug ?>"><?= $category; ?></a>&nbsp;-&nbsp;<span class="gray-txt"><?php echo femscores_reading_time($id) .' read'; ?></span>
                </strong>
            </p>
        <?php } else { ?>
            <p><strong><?= $category; ?></strong></p>
        <?php } ?>
        
    
        <?php if($cls_dd_post_title) { ?>
            <h5 class="post-link-title pt-0 m-0 mb-2 <?php echo $cls_dd_post_title; ?> ">  
        <?php } else { ?>
            <h4 class="post-link-title pt-0 m-0 mb-2">  
        <?php } ?>
            <?php if($post_type == 'resource_center' || is_singular( 'resource_center' )) { ?>
                <a href="<?= $post_link ?>" class="inherit-color"><?php echo ($short_title) ? $short_title : $title; ?></a>
            <?php } else { ?>
                <a href="<?= $post_link ?>" class="inherit-color" <?= $link_attributes ?>><?php echo $title; ?></a>
            <?php } ?>
        <?php if($cls_dd_post_title) { ?>
            </h5>  
        <?php } else { ?>
            </h4> 
        <?php } ?>

        <?php if($post_type == 'resource_center' || is_singular( 'resource_center' )) { ?>
            <p class="my-1 mb-2 <?php echo $cls_desc_section; ?>">
                <?php if(!empty($short_description)) {
                    echo $short_description;
                } elseif(!empty($long_description)) {
                    echo wp_trim_words( $long_description, 8 );
                } else {
                    echo wp_trim_words($full_content , 8 );
                } ?>
            </p>
        <?php } else { ?>
            <p><?= post_excerpt_by_id($id, $excerpt_length); ?></p>
        <?php } ?>

        <?php if($post_type == 'resource_center' || is_singular( 'resource_center' )) { ?>
            <div>
                <a href="<?= $post_link ?>" class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?> p-0">Learn more</a>
            </div>
        <?php } else { ?>
            <div class="mt-4">
                <a href="<?= $post_link ?>" class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" <?= $link_attributes ?>><?= $link_text; ?></a>
            </div>
        <?php } ?>
        

        <?php if(!empty($cls_split_right)) {
            echo '</div>';
        }
        
        if(!empty($cls_row1)) {
            echo '</div>';
        } if(!empty($cls_main)) {
            echo '</div>';
        } 

if(empty($cls_main)) { ?>
    </div>
<?php } ?>