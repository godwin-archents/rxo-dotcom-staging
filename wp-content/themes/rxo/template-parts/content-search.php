<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rxo
 */

$id = get_the_ID();

$title = get_the_title($id);
$short_title = get_field('short_title',$id);
$short_description = get_field('short_description',$id);
$long_description = get_field('long_description',$id);

$content_post = get_post($id);
$full_content = $content_post->post_content;
$post_type = $content_post->post_type;

$pieces = parse_url(home_url());
$domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
$domain_name = explode('.',$domain);
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('my-6'); ?>>

    
    <?php if($post_type == 'resource_center') { ?>
        <h5 class="m-0 mb-4"><?php echo ($short_title) ? $short_title : $title; ?></h5>
    <?php } else { ?>
        <?php the_title('<h5 class="m-0 mb-4">', '</h5>') ?>    
    <?php } ?>
    
    <?php if($post_type == 'resource_center') { ?>
            <p  class="m-0 mb-4 <?php echo $cls_desc_section; ?>">
                <?php if(!empty($short_description)) {
                    echo $short_description;
                } elseif(!empty($long_description)) {
                    echo wp_trim_words( $long_description, 15 );
                } else {
                    if(!empty($full_content)) {
                        echo wp_trim_words($full_content , 15 );
                    } else {
                        echo wp_trim_words('No content found', 15 );
                    }
                } ?>
            </p>
        <?php } else { ?>
            <p><?php if(!empty($full_content)) {
                    echo wp_trim_words($full_content , 15 );
                } else {
                    echo wp_trim_words('No content found', 15 );
                } ?></p>
        <?php } ?>  

    <?php if($domain_name[0] == 'internal-tools'){
        $url_type = get_field('policy_url',$id);
        $link_attributes = '';
        switch ($url_type) {
            case 'download_file':
                $file = get_field('attachment',$id);
                $link = $file['url'];
                break;
            case 'external_url':
                $link = get_field('external_url',$id);
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

        ?>
        <?php if(!empty($link)) { ?>
          <a href="<?= $link ?>" class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" <?= $link_attributes ?>> <?php echo ($link_type=='file')?'Download file':'View site';?> </a>
          
          <?php if($link_type=='file') { ?>
                <a class="text-secondary" href="<?= $link; ?>" <?= $link_attributes; ?>>
                <strong><svg style="margin-top: 6px; margin-left: 6px;" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M1.5 16.7075C1.1 16.7075 0.75 16.5575 0.45 16.2575C0.15 15.9575 0 15.6075 0 15.2075V11.6325H1.5V15.2075H14.5V11.6325H16V15.2075C16 15.6075 15.85 15.9575 15.55 16.2575C15.25 16.5575 14.9 16.7075 14.5 16.7075H1.5ZM8 12.8825L3.175 8.05752L4.25 6.98252L7.25 9.98252V0.70752H8.75V9.98252L11.75 6.98252L12.825 8.05752L8 12.8825Z" fill="black"/>
                  </svg></strong>
                </a>
            <?php } ?>

            <?php if($link_type=='external') { ?>
                <a class="text-secondary" href="<?= $link; ?>" <?= $link_attributes; ?>>
                    <strong><svg style="margin-top: 6px; margin-left: 6px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                    </svg></strong>
                </a>
            <?php } ?>
          <?php } ?>
    <?php }else{ ?>

        <?php if($post_type == 'leadership') { ?>
            <?php $search_permalink = preg_replace('#^https?://#i', '', _truncate_post_slug(get_permalink(),'40')); ?>
            <?php $leadership_permalink = esc_url(home_url('/about-us/leadership/#nav-executive')); ?>
            <a href="<?php echo $leadership_permalink; ?>" target="_blank" class="btn btn-link btn-primary alignleft p-0" rel="noreferrer noopener"><?php echo 'www.'.$search_permalink; ?></a>
        <?php } else { ?>
            <?php $search_permalink = preg_replace('#^https?://#i', '', _truncate_post_slug(get_permalink(),'40')); ?>
            <a href="<?php echo get_permalink() ?>" target="_blank" class="btn btn-link btn-primary alignleft p-0" rel="noreferrer noopener"><?php echo 'www.'.$search_permalink; ?></a>
        <?php } ?> 

    <?php } ?> 
</div>