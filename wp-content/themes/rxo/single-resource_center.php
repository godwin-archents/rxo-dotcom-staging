<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Rxo
 */

get_header();

$post_id = get_the_ID();
?>

<main id="primary" class="site-main">
        <div class="row">
        <?php if($post->post_name!='all-resources') { ?>
            <div class="position-relative pt-5 d-flex flex-column ">
                <?php $post_link = get_the_permalink();
                    $link_attributes = '';
                    $link_text = 'Learn more';

                    $category = '';
                    $cat = get_post_taxonomies(get_the_ID());
                    if ($cat[0] == 'post_tag') {
                        unset($cat[0]);
                        $cat = array_values($cat);
                    }
                    $terms = get_the_terms(get_the_ID(), $cat[0]);
                    $category = $terms[0]->name;

                    if (get_field('attachment_link', get_the_ID())) {
                        $attachment_link = get_field('attachment_link', get_the_ID());
                        $link_attributes = 'download target="_blank" rel="noopener"';
                        $link_text = 'Download PDF';
                    } ?>

                    <?php if ( $post->post_password ) {
                        $publish_status = 'protected';
                    } else {
                        $publish_status = 'public';
                    }

                    if($post->post_password && !post_password_required()) { ?>

                        <div class="container position-relative py-0 d-flex flex-column">
                            <div class="mb-4 ratio ratio-16x9">
                                <div class="card-image mb-4 overflow-hidden rounded-4">
                                    <?php if (!empty(get_the_post_thumbnail($post_id))) { ?>
                                        <?= get_the_post_thumbnail($post_id); ?>
                                    <?php } else {
                                        echo '<img src="https://rxo.com/wp-content/uploads/2022/11/RXO_Graphic_LI_Brad_Post28.jpg" alt="RXO-Image" />';
                                    } ?>
                                </div>
                            </div>
                        </div>

                        <div class="container position-relative  py-0 d-flex flex-column">
                            <div class="row pb-5 rc-detail-top-meta">
                                <div class="col-xl-8 col-lg-7 col-md-5 col-12 me-auto">
                                    <p><strong><a href="<?= get_bloginfo('url') .'/resource-center/categories/'.$terms[0]->slug ?>/"><?= $category; ?></a>&nbsp;-&nbsp;<span class="gray-txt"><?php echo femscores_reading_time(get_the_ID()) .' read'; ?></span></strong></p>
                                </div>
                                <div class="col-xl-4 col-lg-5 col-md-7 col-12 ps-0 text-end">
                                    <div class="d-inline-block px-2">
                                        <?php if(!empty($attachment_link)) { ?>
                                            <a class="btn btn-link btn-primary" href="<?= $attachment_link; ?>" <?= $link_attributes; ?>><strong><?= $link_text; ?></strong></a>
                                            <a class="text-secondary" href="<?= $attachment_link; ?>" <?= $link_attributes; ?>>
                                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.5 16.7075C1.1 16.7075 0.75 16.5575 0.45 16.2575C0.15 15.9575 0 15.6075 0 15.2075V11.6325H1.5V15.2075H14.5V11.6325H16V15.2075C16 15.6075 15.85 15.9575 15.55 16.2575C15.25 16.5575 14.9 16.7075 14.5 16.7075H1.5ZM8 12.8825L3.175 8.05752L4.25 6.98252L7.25 9.98252V0.70752H8.75V9.98252L11.75 6.98252L12.825 8.05752L8 12.8825Z" fill="black"/>
                                                </svg></strong>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div class="d-inline-block px-2">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_link; ?>" target="_blank" rel="noopener noreferrer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                <path d="M24 12.7809C24 6.11293 18.6274 0.70752 12 0.70752C5.37258 0.70752 0 6.11293 0 12.7809C0 18.8069 4.3882 23.8018 10.125 24.7075V16.2708H7.07812V12.7809H10.125V10.1209C10.125 7.09507 11.9166 5.42367 14.6576 5.42367C15.9701 5.42367 17.3438 5.65947 17.3438 5.65947V8.63065H15.8306C14.34 8.63065 13.875 9.56138 13.875 10.5171V12.7809H17.2031L16.6711 16.2708H13.875V24.7075C19.6118 23.8018 24 18.8069 24 12.7809Z" fill="black"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="d-inline-block px-2">
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_link; ?>" target="_blank" rel="noopener noreferrer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                <path d="M22.2234 0.70752H1.77187C0.792187 0.70752 0 1.48096 0 2.43721V22.9731C0 23.9294 0.792187 24.7075 1.77187 24.7075H22.2234C23.2031 24.7075 24 23.9294 24 22.9778V2.43721C24 1.48096 23.2031 0.70752 22.2234 0.70752ZM7.12031 21.1591H3.55781V9.70283H7.12031V21.1591ZM5.33906 8.14189C4.19531 8.14189 3.27188 7.21846 3.27188 6.07939C3.27188 4.94033 4.19531 4.01689 5.33906 4.01689C6.47813 4.01689 7.40156 4.94033 7.40156 6.07939C7.40156 7.21377 6.47813 8.14189 5.33906 8.14189ZM20.4516 21.1591H16.8937V15.5903C16.8937 14.2638 16.8703 12.5528 15.0422 12.5528C13.1906 12.5528 12.9094 14.0013 12.9094 15.4966V21.1591H9.35625V9.70283H12.7687V11.2685H12.8156C13.2891 10.3685 14.4516 9.41689 16.1813 9.41689C19.7859 9.41689 20.4516 11.7888 20.4516 14.8731V21.1591Z" fill="black"/>
                                            </svg>  
                                        </a>
                                    </div>
                                    <div class="d-inline-block px-2">
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo $post_link; ?>" target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="21" viewBox="0 0 24 21" fill="none">
                                            <path d="M7.55016 20.5336C16.6045 20.5336 21.5583 12.9051 21.5583 6.29176C21.5583 6.0773 21.5536 5.85808 21.5442 5.64362C22.5079 4.93509 23.3395 4.05748 24 3.05203C23.1025 3.45799 22.1496 3.72312 21.1739 3.83837C22.2013 3.21227 22.9705 2.22869 23.3391 1.06997C22.3726 1.65231 21.3156 2.06311 20.2134 2.28475C19.4708 1.48253 18.489 0.95137 17.4197 0.773384C16.3504 0.595398 15.2532 0.7805 14.2977 1.30007C13.3423 1.81965 12.5818 2.64475 12.1338 3.64782C11.6859 4.65088 11.5754 5.77605 11.8195 6.84934C9.86249 6.7495 7.94794 6.23263 6.19998 5.33225C4.45203 4.43187 2.90969 3.16807 1.67297 1.62279C1.0444 2.7246 0.852057 4.0284 1.13503 5.26921C1.418 6.51001 2.15506 7.59473 3.19641 8.30289C2.41463 8.27765 1.64998 8.06365 0.965625 7.67858V7.74053C0.964925 8.8968 1.3581 10.0176 2.07831 10.9125C2.79852 11.8074 3.80132 12.421 4.91625 12.6492C4.19206 12.8507 3.43198 12.88 2.69484 12.735C3.00945 13.7294 3.62157 14.5991 4.44577 15.2228C5.26997 15.8465 6.26512 16.193 7.29234 16.214C5.54842 17.6067 3.39417 18.3621 1.17656 18.3585C0.783287 18.3579 0.390399 18.3334 0 18.2851C2.25286 19.7546 4.87353 20.535 7.55016 20.5336Z" fill="black"/>
                                        </svg>
                                        </a>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    
                        <div class="container position-relative py-0 d-flex flex-column">
                            <div class="row pb-5">
                                <h1><?php the_title();?></h1>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(empty($post->password) && $publish_status == 'public') { ?>
                        <div class="container position-relative  py-0 d-flex flex-column">
                            <div class="mb-4 ratio ratio-16x9">
                                <div class="card-image mb-4 overflow-hidden rounded-4">
                                    <?php if (!empty(get_the_post_thumbnail($post_id))) { ?>
                                            <?= get_the_post_thumbnail($post_id); ?>
                                        <?php } else {
                                            echo '<img src="https://rxo.com/wp-content/uploads/2022/11/RXO_Graphic_LI_Brad_Post28.jpg" alt="RXO-Image" />';
                                        } ?>
                                </div>
                            </div>
                        </div>

                        <div class="container position-relative py-0 d-flex flex-column">
                            <div class="row pb-5 rc-detail-top-meta">
                                <div class="col-xl-8 col-lg-7 col-md-5 col-12 me-auto">
                                    <p><strong><a href="<?= get_bloginfo('url') .'/resource-center/categories/'.$terms[0]->slug ?>/"><?= $category; ?></a>&nbsp;-&nbsp;<span class="gray-txt"><?php echo femscores_reading_time(get_the_ID()) .' read'; ?></span></strong></p>
                                </div>
                                <div class="col-xl-4 col-lg-5 col-md-7 col-12 ps-0 text-end">
                                    <div class="d-inline-block px-2">
                                        <?php if(!empty($attachment_link)) { ?>
                                            <a class="btn btn-link btn-primary" href="<?= $attachment_link; ?>" <?= $link_attributes; ?>><strong><?= $link_text; ?></strong></a>
                                            <a class="text-secondary" href="<?= $attachment_link; ?>" <?= $link_attributes; ?>>
                                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.5 16.7075C1.1 16.7075 0.75 16.5575 0.45 16.2575C0.15 15.9575 0 15.6075 0 15.2075V11.6325H1.5V15.2075H14.5V11.6325H16V15.2075C16 15.6075 15.85 15.9575 15.55 16.2575C15.25 16.5575 14.9 16.7075 14.5 16.7075H1.5ZM8 12.8825L3.175 8.05752L4.25 6.98252L7.25 9.98252V0.70752H8.75V9.98252L11.75 6.98252L12.825 8.05752L8 12.8825Z" fill="black"/>
                                                </svg></strong>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div class="d-inline-block px-2">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_link; ?>" target="_blank" rel="noopener noreferrer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                <path d="M24 12.7809C24 6.11293 18.6274 0.70752 12 0.70752C5.37258 0.70752 0 6.11293 0 12.7809C0 18.8069 4.3882 23.8018 10.125 24.7075V16.2708H7.07812V12.7809H10.125V10.1209C10.125 7.09507 11.9166 5.42367 14.6576 5.42367C15.9701 5.42367 17.3438 5.65947 17.3438 5.65947V8.63065H15.8306C14.34 8.63065 13.875 9.56138 13.875 10.5171V12.7809H17.2031L16.6711 16.2708H13.875V24.7075C19.6118 23.8018 24 18.8069 24 12.7809Z" fill="black"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="d-inline-block px-2">
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_link; ?>" target="_blank" rel="noopener noreferrer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                <path d="M22.2234 0.70752H1.77187C0.792187 0.70752 0 1.48096 0 2.43721V22.9731C0 23.9294 0.792187 24.7075 1.77187 24.7075H22.2234C23.2031 24.7075 24 23.9294 24 22.9778V2.43721C24 1.48096 23.2031 0.70752 22.2234 0.70752ZM7.12031 21.1591H3.55781V9.70283H7.12031V21.1591ZM5.33906 8.14189C4.19531 8.14189 3.27188 7.21846 3.27188 6.07939C3.27188 4.94033 4.19531 4.01689 5.33906 4.01689C6.47813 4.01689 7.40156 4.94033 7.40156 6.07939C7.40156 7.21377 6.47813 8.14189 5.33906 8.14189ZM20.4516 21.1591H16.8937V15.5903C16.8937 14.2638 16.8703 12.5528 15.0422 12.5528C13.1906 12.5528 12.9094 14.0013 12.9094 15.4966V21.1591H9.35625V9.70283H12.7687V11.2685H12.8156C13.2891 10.3685 14.4516 9.41689 16.1813 9.41689C19.7859 9.41689 20.4516 11.7888 20.4516 14.8731V21.1591Z" fill="black"/>
                                            </svg>  
                                        </a>
                                    </div>
                                    <div class="d-inline-block px-2">
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo $post_link; ?>" target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="21" viewBox="0 0 24 21" fill="none">
                                            <path d="M7.55016 20.5336C16.6045 20.5336 21.5583 12.9051 21.5583 6.29176C21.5583 6.0773 21.5536 5.85808 21.5442 5.64362C22.5079 4.93509 23.3395 4.05748 24 3.05203C23.1025 3.45799 22.1496 3.72312 21.1739 3.83837C22.2013 3.21227 22.9705 2.22869 23.3391 1.06997C22.3726 1.65231 21.3156 2.06311 20.2134 2.28475C19.4708 1.48253 18.489 0.95137 17.4197 0.773384C16.3504 0.595398 15.2532 0.7805 14.2977 1.30007C13.3423 1.81965 12.5818 2.64475 12.1338 3.64782C11.6859 4.65088 11.5754 5.77605 11.8195 6.84934C9.86249 6.7495 7.94794 6.23263 6.19998 5.33225C4.45203 4.43187 2.90969 3.16807 1.67297 1.62279C1.0444 2.7246 0.852057 4.0284 1.13503 5.26921C1.418 6.51001 2.15506 7.59473 3.19641 8.30289C2.41463 8.27765 1.64998 8.06365 0.965625 7.67858V7.74053C0.964925 8.8968 1.3581 10.0176 2.07831 10.9125C2.79852 11.8074 3.80132 12.421 4.91625 12.6492C4.19206 12.8507 3.43198 12.88 2.69484 12.735C3.00945 13.7294 3.62157 14.5991 4.44577 15.2228C5.26997 15.8465 6.26512 16.193 7.29234 16.214C5.54842 17.6067 3.39417 18.3621 1.17656 18.3585C0.783287 18.3579 0.390399 18.3334 0 18.2851C2.25286 19.7546 4.87353 20.535 7.55016 20.5336Z" fill="black"/>
                                        </svg>
                                        </a>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    
                        <div class="container position-relative py-0 d-flex flex-column">
                            <div class="row pb-5">
                                <h1><?php the_title();?></h1>
                            </div>
                        </div>
                    <?php } ?>

                <?php while (have_posts()) :
                    the_post();

                    get_template_part('template-parts/content', get_post_type());

                endwhile; // End of the loop.
                ?>
                
            </div>
            <?php } else if($post->post_name=='all-resources') {
                while (have_posts()) :
                    the_post();

                    get_template_part('template-parts/content', get_post_type());

                endwhile; // End of the loop.
            } ?>    
        </div>
</main><!-- #main -->

<?php
get_footer(); ?>
