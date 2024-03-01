<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Rxo
 */

global $wp_query;
$posts_found    = $wp_query->found_posts;

$excerpt_length = $args['excerpt_length'] ?? 90;
$theme = $args['theme'];
$id = $args['id'];

$title = get_the_title($id);
$short_title = get_field('short_title',$id);
$short_description = get_field('short_description',$id);

$category = '';
$cat = get_post_taxonomies($id);
if ($cat[0] == 'post_tag') {
    unset($cat[0]);
    $cat = array_values($cat);
}
$terms = get_the_terms($id, $cat[0]);
$category = $terms[0]->name;


$publish_date = get_the_date("M. j, Y", $id);

$post_link = get_the_permalink($id);
$link_attributes = '';
$link_text = 'Learn more';


/* Captch Concept : Start */

// Get the search count and time difference
$rxo_user_visit = array(
    'time' => date('Y-m-d g:i:s a'),
    'count' => 1
);

//session_start();

//$rxo_stored_session = sanitize_text_field($_SESSION['wp_rxo_dotcom_search']);
// $rxo_stored_session = filter_var($_SESSION['wp_rxo_dotcom_search'], FILTER_SANITIZE_STRING);
$rxo_stored_session = sanitize_text_field(get_transient( 'wp_rxo_dotcom_search' ));

//echo 'rxo_stored_session'.$rxo_stored_session;

// Check if the session is already set
if ($rxo_stored_session) {
   
    // retrieve the session data and convert to PHP array
    $rxo_previous_visit = json_decode(base64_decode($rxo_stored_session));
    $rxo_previous_visit = std_object_to_array($rxo_previous_visit);

    //print_r($rxo_previous_visit);

    // Check time difference between last visit and present visit is less than 1 minute
    $dateTimeObject1 = date_create($rxo_previous_visit['time']);
    $dateTimeObject2 = date_create($rxo_user_visit['time']);

    $difference = date_diff($dateTimeObject1, $dateTimeObject2);

    if ($difference->i < 1) {

        $rxo_user_visit['count'] = $rxo_previous_visit['count'] + 1;
        $rxo_user_visit['time'] = $rxo_previous_visit['time'];
    }
}

//$_SESSION["wp_rxo_dotcom_search"] = base64_encode(json_encode($rxo_user_visit));

set_transient( 'wp_rxo_dotcom_search', base64_encode(json_encode($rxo_user_visit)), time() + (60 * 1) );

/* Captch Concept : End */

get_header();

$pieces = parse_url(home_url());
$domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
$domain_name = explode('.',$domain);
?>
<main id="primary" class="site-main">
    <div class="container-fluid px-0 py-9 bg-pattern-search">
        <div class="container">
            <?php $search_query = sanitize_text_field( get_search_query() );
            if($search_query =='') { ?>
                <h2 class="text-black">Search Results</h2>
            <?php } else if($search_query !='') { ?>
                <h2 class="text-black">Search Results - <?php echo esc_html( $search_query ); ?></h2>
            <?php } ?>
        </div>
    </div>
    <div class="container py-6">
        <div class="row">
            <div class="col-12">
                <form class="align-items-center border-2 border-bottom border-primary-dark d-flex" action="/" method="GET" id="searchform-page">
                    <input type="text" placeholder="Search for people, technology, capabilities, etc" name="s" id="search-page-input" class="form-control flex-grow-1 order-1 border-0 bg-transparent h3 m-0 py-1" value="<?= get_search_query(); ?>" required="" oninput="searchTypeFunction()" />
                    <?php if($_GET['post_type'] && $_GET['post_type']=="resource_center"){?>
                    <input type="hidden" name="post_type" value="resource_center" />
                    <?php } ?>
                    <button class="btn btn-link py-0 order-0" type="submit" aria-label="search">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6368 11.8022C9.52023 12.6702 8.11723 13.187 6.59352 13.187C2.95202 13.187 0 10.235 0 6.59352C0 2.95202 2.95202 0 6.59352 0C10.235 0 13.187 2.95202 13.187 6.59352C13.187 8.11718 12.6702 9.52013 11.8023 10.6366L16 14.8343L14.8344 15.9998L10.6368 11.8022ZM11.5387 6.59352C11.5387 9.32463 9.32463 11.5387 6.59352 11.5387C3.8624 11.5387 1.64838 9.32463 1.64838 6.59352C1.64838 3.8624 3.8624 1.64838 6.59352 1.64838C9.32463 1.64838 11.5387 3.8624 11.5387 6.59352Z" fill="#1C1C1C"></path>
                        </svg>
                    </button>
                    <button id="search-page-clear-btn" class="btn btn-link py-0 order-3" type="button" aria-label="close searchbar" onclick="searchClearFunction()">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.53267 8L15.6633 1.86253C16.0886 1.43681 16.0886 0.745011 15.6633 0.31929C15.2381 -0.10643 14.5471 -0.10643 14.1218 0.31929L7.99114 6.45676L1.86047 0.337029C1.43522 -0.0886917 0.744186 -0.0886917 0.318937 0.337029C-0.106312 0.762749 -0.106312 1.45455 0.318937 1.88027L6.44961 8L0.336656 14.1375C-0.0885936 14.5632 -0.0885936 15.255 0.336656 15.6807C0.761905 16.1064 1.45293 16.1064 1.87818 15.6807L8.00886 9.54324L14.1395 15.6807C14.5648 16.1064 15.2558 16.1064 15.6811 15.6807C16.1063 15.255 16.1063 14.5632 15.6811 14.1375L9.53267 8Z" fill="#1C1C1C"></path>
                        </svg>
                    </button>                  

                    <?php if ($rxo_user_visit['count'] > 5) { ?>
                        <script>
                            console.log(<?= $rxo_user_visit['count'] ?>);
                        </script>
                        <!-- Container to add recaptcha for bws recaptcha plugin -->
                        <div class="recaptcha-notice">
                        <?= apply_filters('gglcptch_display_recaptcha', '', 'my_custom_form'); ?>
                        </div>
                        <div class="col-12 fs-7 my-3 anchor-font-inherit" style="position: absolute; bottom: 50px;">
                            This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy"
                                target="_blank" rel="noopener">Privacy
                                Policy</a> and <a href="https://policies.google.com/terms" target="_blank"
                                rel="noopener">Terms of Service</a> apply.
                        </div>
                    <?php } ?>
                </form>
            </div>
            <div class="col-12">
                About <?= $posts_found; ?> results found
            </div>
        </div>

        <div class="row text-start mt-6">
            <div class="col-xl-7 col-lg-7 col-md-12 col-12">
                <div class="d-flex align-items-start">
                    <div class="col-12">
                        <?php
                        if (have_posts()) {
                            while (have_posts()) : the_post();
                                get_template_part('template-parts/content', 'search');
                            endwhile; 
                        } else { ?>
                            <div class="row py-5">
                                <div class="col-12">
                                    <?php
                                    get_template_part('template-parts/content', 'none');
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="d-xl-none d-lg-none d-md-block d-sm-block">
                    <?php the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('PREV', 'rxo'),
                        'next_text' => __('NEXT', 'rxo'),
                    )); ?>
                </div>
            </div>

            <div class="col-xl-5 col-lg-5 col-md-12 col-12">
                <div class="d-flex align-items-start">
                    <div class="col">
                        <?php if($domain_name[0] != 'internal-tools'){ ?>
                        <form class="track-form search-page-track-form align-items-center mb-3" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
                            <div class="w-100">
                                <div class="col-12 mt-6">
                                    <h3 class="m-0 border-1 border-bottom text-black">Track a shipment</h3>    
                                </div>
                                <div class="col-12 py-5">
                                    <input type="text" maxlength="255" placeholder="" name="ShipmentNumber" id="search-input-order" class="form-control" required />
                                </div>
                                <div class="col-12 pb-3">
                                    <button class="btn btn-primary" type="submit" aria-label="search">Track</button>
                                </div>
                            </div>
                        </form><!-- #Track a Shipments -->

                        <div class="search-press-releases">
                            <?php 
                            $exclude_news_POSTID = get_id_by_slug('press-releases','news_article');
                            $args = array(
                                'post_type' => 'news_article',
                                'post_status' => 'publish',
                                'has_password' => FALSE,
                                'post__not_in'=>array($exclude_news_POSTID),
                                'posts_per_page' => 2,
                                'search_prod_title' => get_search_query(),  
                                'orderby'=>'title',
                                'order'=>'ASC',                       
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'news_category',
                                        'field' => 'slug',
                                        'terms' => 'press-release'
                                    )
                                )
                            );
                            add_filter( 'posts_where', 'search_article_title_filter', 10, 2 );
                            // the query
                            $the_query = new WP_Query($args);
                            remove_filter( 'posts_where', 'search_article_title_filter', 10, 2 );
                             ?>
                            <?php if ($the_query->have_posts()) { ?>
                            <?php } else { ?>
                            <?php
                            $args = array(
                                'post_type' => 'news_article',
                                'post_status' => 'publish',
                                'has_password' => FALSE,
                                'post__not_in'=>array($exclude_news_POSTID),
                                'posts_per_page' => 2,
                                'orderby'=>'title',
                                'order'=>'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'news_category',
                                        'field' => 'slug',
                                        'terms' => 'press-release'
                                    )
                                )
                            );
                            // the query
                            $the_query = new WP_Query($args);                            
                            ?>    
                            <?php } ?>    
                            <?php if ($the_query->have_posts()) : ?>
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="mt-3 mb-5 border-1 border-bottom text-black">Press Releases</h3>    
                                </div>
                                <?php while ($the_query->have_posts()) : $the_query->the_post();  

                                $cat = get_post_taxonomies($id);
                                if ($cat[0] == 'post_tag') {
                                    unset($cat[0]);
                                    $cat = array_values($cat);
                                }

                                $terms = get_the_terms($id, $cat[0]);
                                $category = $terms[0]->name;

                                $title = get_the_title($id);
                                $short_title = get_field('short_title',$id);
                                $short_description = get_field('short_description',$id);

                                $post_link = get_the_permalink($id);
                                $link_attributes = '';
                                $link_text = 'Learn more';

                                $content_post = get_post($id);
                                $full_content = $content_post->post_content; ?>
                                    
                                <div class="col-xl-6 col-lg-12 col-md-12 col-12 pe-xl-0">
                                    <div class="card-image mb-4 overflow-hidden rounded-4 ratio ratio-16x9"><a href="<?= $post_link ?>">                                    
                                        <?php if (!empty(get_the_post_thumbnail(get_the_ID()))) { ?>
                                            <?= get_the_post_thumbnail(get_the_ID()); ?>
                                        <?php } else {
                                            echo '<img src="https://rxo.com/wp-content/uploads/2022/11/RXO_Graphic_LI_Brad_Post28.jpg" alt="RXO-Image" />';
                                        } ?>
                                    </a></div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-12 col-12 ps-xl-3">
                                    <p clasS="m-0"><strong><span class="gray-txt"><a href="<?= get_bloginfo('url');?>/news/press-releases"><?= $category; ?></a></b>&nbsp;-&nbsp;<?php echo femscores_reading_time($id) .' read'; ?></span></strong></p>

                                    <h5 class="post-link-title pt-0 my-2">
                                        <a href="<?= $post_link ?>" class="inherit-color" <?= $link_attributes ?>><?= ($short_title)?$short_title:$title; ?></a>
                                    </h5>
                                    
                                    <p>
                                        <?php if(!empty($short_description)) {
                                            echo $short_description;
                                        } else {
                                            echo wp_trim_words($full_content , 8 );
                                        } ?>
                                    </p>
                                    
                                    <div class="mb-4">
                                        <a href="<?= $post_link ?>" class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" <?= $link_attributes ?>>
                                            <?= $link_text; ?>
                                        </a>
                                    </div>
                                </div>
                                <?php endwhile; 
                                else:
                                    "No Press Releases Found.";
                                endif;
                                wp_reset_postdata();?>
                            </div>
                        </div><!-- #Press Releases -->
                        <?php   ?>
                        <div class="search-resources">
                            <?php 
                            $exclude_resource_POSTID = get_id_by_slug('all-resources','resource_center');
                            $args = array(  
                                'post_type' => 'resource_center',
                                'post_status' => 'publish',
                                'has_password' => FALSE,
                                'post__not_in'=>array($exclude_resource_POSTID),
                                'posts_per_page' => 2,
                                'search_prod_title' => get_search_query(),
                                'meta_key' =>'short_title',
                                'orderby'=>'meta_value',
                                'order'=>'ASC'                         
                            );
                            add_filter( 'posts_where', 'search_article_title_filter', 10, 2 );
                            // the query
                            $the_query = new WP_Query($args);
                            remove_filter( 'posts_where', 'search_article_title_filter', 10, 2 );
                             ?>
                             <?php if ($the_query->have_posts()) { ?>
                            <?php } else { ?>
                            <?php
                            $args = array(
                                'post_type' => 'resource_center',
                                'post_status' => 'publish',
                                'has_password' => FALSE,
                                'post__not_in'=>array($exclude_resource_POSTID),
                                'posts_per_page' => 2,
                                'meta_key' =>'short_title',
                                'orderby'=>'meta_value',
                                'order'=>'ASC'                         
                            );
                            // the query
                            $the_query = new WP_Query($args);
                            ?>    
                            <?php } ?>  
                            <?php if ($the_query->have_posts()) : ?>
                                <div class="row">
                                    <div class="col-12 px-3">
                                        <h3 class="mb-5 border-1 border-bottom text-black">Resources</h3>    
                                    </div>
                                    <?php while ($the_query->have_posts()) : $the_query->the_post();  
                                    
                                    $cat = get_post_taxonomies($id);
                                    if ($cat[0] == 'post_tag') {
                                        unset($cat[0]);
                                        $cat = array_values($cat);
                                    }
                                    $terms = get_the_terms($id, $cat[0]);
                                    $category = $terms[0]->name;

                                    $title = get_the_title($id);
                                    $short_title = get_field('short_title',$id);
                                    $short_description = get_field('short_description',$id);
                                    $long_description = get_field('long_description',$id);

                                    $content_post = get_post($id);
                                    $full_content = $content_post->post_content;
                                    $post_link = get_the_permalink($id);
                                    $link_attributes = '';
                                    $link_text = 'Learn more';
                                    
                                    ?>
                                        
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-12 pe-xl-0">
                                        <div class="card-image mb-4 overflow-hidden rounded-4 ratio ratio-16x9"><a href="<?= $post_link ?>">
                                            <?php if (!empty(get_the_post_thumbnail(get_the_ID()))) { ?>
                                            <?= get_the_post_thumbnail(get_the_ID()); ?>
                                            <?php } else {
                                                echo '<img src="https://rxo.com/wp-content/uploads/2022/11/RXO_Graphic_LI_Brad_Post28.jpg" alt="RXO-Image" />';
                                            } ?>
                                        </a></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-12 ps-xl-3">
                                        <p class="m-0"><strong><span class="gray-txt"><a href="<?= get_bloginfo('url') .'/resource-center/categories/'.$terms[0]->slug ?>/"><?= $category; ?></a>&nbsp;-&nbsp;<?php echo femscores_reading_time($id) .' read'; ?></span></strong></p>

                                        <h5 class="post-link-title pt-0 my-2">
                                            <a href="<?= $post_link ?>" class="inherit-color" <?= $link_attributes ?>><?= ($short_title)?$short_title:$title; ?></a>
                                        </h5>
                                        
                                        <p class="my-1 <?php echo $cls_desc_section; ?>">
                                            <?php if(!empty($short_description)) {
                                                echo $short_description;
                                            } elseif(!empty($long_description)) {
                                                echo wp_trim_words( $long_description, 8 );
                                            } else {
                                                echo wp_trim_words($full_content , 8 );
                                            } ?>
                                        </p>
                                        <div class="mb-4">
                                            <a href="<?= $post_link ?>" class="btn btn-link <?= ($theme === 'dark' ? 'btn-secondary' : 'btn-primary') ?>" <?= $link_attributes ?>>
                                                <?= $link_text; ?>
                                            </a>
                                        </div>
                                    </div>
                                    <?php endwhile; 
                                    else:
                                        "No Resources Found.";
                                    endif;
                                    wp_reset_postdata();?>
                                </div>
                        </div><!-- #Resources -->
                        <?php }else if($domain_name[0] == 'internal-tools'){ ?>
                        <div class="">
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
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="d-xl-block d-lg-block d-md-none d-sm-none">
                <?php the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('PREV', 'rxo'),
                    'next_text' => __('NEXT', 'rxo'),
                )); ?>
            </div>
        </div><!-- #row -->
    </div>
</main><!-- #main -->
<?php
get_footer();
