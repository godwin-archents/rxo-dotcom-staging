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

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'policy',
    'posts_per_page' => 4,
    'paged' => $paged, 
    'post_status' => 'publish',
    'orderby'=>'date',
    'order'=>'DESC',
);
$query = new WP_Query($args);

?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
  <div class="row justify-content-start">
    <div class="col-12 col-xl-8 col-lg-8 col-md-12">
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

                global $post;
                if ( $post->post_password ) {
                    $publish_status = 'protected';
                } else {
                    $publish_status = 'public';
                }
        ?>
      <div class="d-flex align-items-start mt-6">
        <div class="col">
          <h4 class="post-link-title mt-0">
            <?= get_the_title(); ?>
          </h4>
          <?php if (get_the_content()) : ?>
            <p><?php if(empty($post->password) && $publish_status == 'protected') { 
                echo 'This content is password protected.';
              }
              else{
                  echo wp_trim_words(get_the_content() , 25 );
              } ?></p>
          <?php endif; ?>
          <?php if(!empty($link)) { ?>
          <a href="<?= $link ?>" class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" <?= $link_attributes ?>> <?php echo ($link_type=='file')?'Download file':'View site';?> </a>
          
          <?php if($link_type=='file') { ?>
                <a class="text-secondary" href="<?= $link; ?>" <?= $link_attributes; ?>>
                  <svg style="margin-top: 6px; margin-left: 6px;" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
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
    <nav class="navigation pagination my-3 d-sm-block d-md-block d-lg-none d-xl-none" aria-label="Posts">
        <div class="nav-links">
        <?php 
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '&paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf( '<i></i> %1$s', __( 'PREV', 'text-domain' ) ),
                'next_text'    => sprintf( '%1$s <i></i>', __( 'NEXT', 'text-domain' ) ),
                'add_args'     => false,
                'add_fragment' => '',
            ) );
        ?>
        </div>
    </nav>
    <div class="col-12 col-xl-4 col-lg-4 col-md-12">
      <div class="w-100">
        <div class="col-12 mt-6">
          <h3 class="m-0 border-1 border-bottom text-black">Policies by Topic</h3>
        </div>
      </div>
      <ul class="mt-3">
        <li><a href="#">Credit Policies</a></li>
        <li><a href="#">Ethics</a></li>
        <li><a href="#">GSO</a></li>
        <li><a href="#">HR</a></li>
        <li><a href="#">InfoSec</a></li>
        <li><a href="#">Procurement</a></li>
        <li><a href="#">etc...</a></li>
      </ul>
    </div>
    <nav class="navigation pagination my-3 d-sm-none d-md-none d-lg-block d-xl-block" aria-label="Posts">
        <div class="nav-links">
        <?php 
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '&paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf( '<i></i> %1$s', __( 'PREV', 'text-domain' ) ),
                'next_text'    => sprintf( '%1$s <i></i>', __( 'NEXT', 'text-domain' ) ),
                'add_args'     => false,
                'add_fragment' => '',
            ) );
        ?>
        </div>
    </nav>
  </div>
</div>

