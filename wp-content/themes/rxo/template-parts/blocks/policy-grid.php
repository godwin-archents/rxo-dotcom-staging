<?php

/**
 * Block Name: Policy
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
$className .= ' ' . $block['className'] ?? '';
$className .= ' ' . $block['align'] ?? '';

$theme = get_field('theme');
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : '');

$policy_link_type = get_field('policy_link_type');
$section_title = get_field('section_title');
$section_button_link = get_field('button_link');
$section_button_text = get_field('button_text');
$column_border = get_field('column_border');
$columns_per_row = get_field('columns_per_row');
$column_class = "col-12 ";
switch ($columns_per_row) {
    case 5:
        $column_class .= "col-md-6 col-lg";
        break;
    case 4:
        $column_class .= "col-md-6 col-lg-3";
        break;
    case 2:
        $column_class .= "col-md-12 col-lg-6";
        break;
    case 1:
        $column_class .= "col-md-12 col-lg-12";
        break;
    default:
        $column_class .= "col-md-6 col-lg-4";
        break;
}

$args = array(
    'post_type' => 'policy',
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'orderby'=>'date',
    'order'=>'DESC',
);

if($policy_link_type == 'link'){
    $args['meta_query'] = array(
        'relation'      => 'AND',
        array(
            'key'       => 'policy_url',
            'value'     => 'external_url',
            'compare'   => '='
        ),
    );
}elseif($policy_link_type == 'file'){
    $args['meta_query'] = array(
        'relation'      => 'AND',
        array(
            'key'       => 'policy_url',
            'value'     => 'download_file',
            'compare'   => '='
        ),
    );
}else{
    
}
/*echo '<pre>';
print_r($args);
echo '</pre>'; */
$query = new WP_Query($args);

?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="row align-items-center">
        <?php if ($section_title) : ?>
            <div class="col">
                <h3><?= $section_title; ?></h3>
            </div>
        <?php endif; ?>
        <?php if ($section_button_link) : ?>
            <div class="col-auto mb-4 mb-md-0 text-end">
                <a class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" href="<?= $section_button_link; ?>"><?= $section_button_text; ?></a>
            </div>
        <?php endif; ?>
    </div>
    <div class="row text-start mt-3 <?= $columns_per_row === 5 ? 'row-cols-lg-5' : '' ?>">
        <?php
        // check if the repeater field has rows of data
        if($query->have_posts()) :
            // loop through the rows of data
            while ($query->have_posts()): $query->the_post();
                $url_type = get_field('policy_url',get_the_ID());
                $link_attributes = '';
                switch ($url_type) {
                    case 'download_file':
                        $file = get_field('attachment',get_the_ID());
                        $link = $file['url'];
                        break;
                    case 'external_url':
                        $link = get_field('external_url',get_the_ID());
                        break;
                    default:
                        $link = '';
                }

                $link_type = get_link_type($link);
                switch ($link_type) {
                    case 'file':
                        $link_attributes = 'download target="_blank"';
                        break;
                    case 'external':
                        $link_attributes = 'target="_blank"';
                        break;
                    default:
                        $link_attributes = '';
                }

                $link_text = ($policy_link_type == 'all')?'View policies':'Learn More';
                global $post;
                if ( $post->post_password ) {
                    $publish_status = 'protected';
                } else {
                    $publish_status = 'public';
                }
                
        ?>
                <div class="<?= $column_class ?> mt-6">
                    <div class="d-flex align-items-start <?= $column_border ? 'border-black border-top pt-5' : '' ?>">
                        <div class="col">
                            <h4 class="post-link-title mt-0">
                                <?= get_the_title(); ?>
                            </h4>
                            
                           <p><?php if(empty($post->password) && $publish_status == 'protected') { 
                              echo 'This content is password protected.';
                            }
                            else{
                                echo wp_trim_words(get_the_content() , 25 );
                            } ?></p>
                            <?php if(!empty($link)) { ?>
                                <a href="<?= $link ?>" class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" <?= $link_attributes ?>>
                                <?= $link_text; ?> 
                                </a>

                                <?php if($link_type=='file' && $policy_link_type !='all' ) { ?>
                                <a class="text-secondary" href="<?= $link; ?>" <?= $link_attributes; ?>>
                                    <svg style="margin-top: 6px; margin-left: 6px;" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.5 16.7075C1.1 16.7075 0.75 16.5575 0.45 16.2575C0.15 15.9575 0 15.6075 0 15.2075V11.6325H1.5V15.2075H14.5V11.6325H16V15.2075C16 15.6075 15.85 15.9575 15.55 16.2575C15.25 16.5575 14.9 16.7075 14.5 16.7075H1.5ZM8 12.8825L3.175 8.05752L4.25 6.98252L7.25 9.98252V0.70752H8.75V9.98252L11.75 6.98252L12.825 8.05752L8 12.8825Z" fill="black"/>
                                    </svg></strong>
                                </a>
                                <?php } ?>
                                <?php if($link_type=='external_url' && $policy_link_type !='all') { ?>
                                    <a class="text-secondary" href="<?= $link; ?>" <?= $link_attributes; ?>>
                                        <strong><svg style="margin-top: 6px; margin-left: 6px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                        </svg></strong>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
            elseif (show_block_error()) : ?>
            <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
                <div class="toast-body">
                    <?php esc_html_e('No data available to show'); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>