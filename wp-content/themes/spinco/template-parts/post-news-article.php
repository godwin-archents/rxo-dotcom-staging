<?php

/**
 * Template part for displaying latest news posts in custom filter block
 */
/** @var array $args */

$excerpt_length = isset($args['excerpt_length']) ? $args['excerpt_length'] : 130;
?>

<div class="col-12 col-md-6 col-lg-4 py-2 my-4">
    <!-- added the 2nd param get_the_ID() as suggested by latest ACF plugin update -->
    <div class="font-demi fs-5 mt-4">
       
            <?php
                $cat = get_post_taxonomies(get_the_ID());
                if ($cat[0] == 'post_tag') {
                    unset($cat[0]);
                    $cat = array_values($cat);
                }
                $terms = get_the_terms(get_the_ID(), $cat[0]);
            ?>
            <?= $terms[0]->name ?>
    
    </div>

    <h2 class="post-link-title">
        <!-- External News Link Check Condition -->
        <p>
            &nbsp;&#124;&nbsp; <?= get_the_date("M. j, Y", $post->ID); ?>
        </p>
       
            <a href="<?php echo get_the_permalink(); ?>" class="text-decoration-underline-hover inherit-color">
                <?php echo the_title() ?>
            </a>
        
    </h2>

    <div>
       
        <p><?php echo post_excerpt($excerpt_length); ?></p>
    </div>
    <a href="<?php echo get_the_permalink(); ?>" class="btn btn-link text-primary text-decoration-underline">
        Read More
    </a>
        
</div>