<?php

/**
 * Block Name: Article with sidebar
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// create id attribute for specific styling
$uid = 'spinco-acf-container-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'spinco-block ' . str_replace('acf/spinco-acf-', '', $block['name']);
if (!empty($block['className'])) {
    $className .= sprintf(' %s', $block['className']);
}

if (!empty($block['align'])) {
    $className .= sprintf(' align%s', $block['align']);
}

$mode = get_field('theme');

if ($mode === 'dark') {
    $className .= ' bg-dark text-white ';
}


$display_sidebar = get_field('display_sidebar');
$facebook_url = $twitter_url = $linkedin_url = $email_url = null;
if ($display_sidebar) {

    global $wp;

    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . esc_url(wp_get_current_url());
    $twitter_url = 'https://twitter.com/intent/tweet?url=' . esc_url(wp_get_current_url());
    $linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' .  esc_url(wp_get_current_url());
    $email_url = 'mailto:?subject=I wanted you to see this site&amp;body=Check out this site '  .  esc_url(wp_get_current_url());
}

$icon_color = '#000000';
?>
<div class="<?php echo $uid; ?> <?php echo esc_attr($className); ?> py-8 container">
    <div class="row">
        <div class="col-12 col-lg-9">
            <div class="article-width me-xl-0 ms-0 ms-xl-auto px-0">
                <InnerBlocks />
            </div>
        </div>
        <?php if ($display_sidebar) : ?>
            <div class="col-12 col-lg-3">
                <div class="row">
                    <?php
                    // check if the repeater field has rows of data
                    if (have_rows('media_contacts')) : ?>
                        <div class="col-12 col-md-4 col-lg-12 pb-6">
                            <div class="pb-2 border-bottom border-secondary"><b>Media Contact</b></div>
                            <?php
                            // loop through the rows of data
                            while (have_rows('media_contacts')) : the_row();
                                $name = get_sub_field('name');
                                $number = get_sub_field('number');
                                $email = get_sub_field('email');
                            ?>
                                <h5 class="py-2"><?= $name ?></h5>
                                <a href="tel:<?= $number ?>" class="d-block pb-2"><?= $number ?></a>
                                <a href="mailto:<?= $email ?>" class="d-block pb-2"><?= $email ?></a>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    // check if the repeater field has rows of data
                    if (have_rows('investor_contacts')) : ?>
                        <div class="col-12 col-md-4 col-lg-12 pb-6">
                            <div class="pb-2 border-bottom border-secondary"><b>Investor Contact</b></div>
                            <?php
                            // loop through the rows of data
                            while (have_rows('investor_contacts')) : the_row();
                                $name = get_sub_field('name');
                                $number = get_sub_field('number');
                                $email = get_sub_field('email');
                            ?>
                                <h5 class="py-2"><?= $name ?></h5>
                                <a href="tel:<?= $number ?>" class="d-block pb-2"><?= $number ?></a>
                                <a href="mailto:<?= $email ?>" class="d-block pb-2"><?= $email ?></a>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <div class="col-12 col-md-4 col-lg-12">
                        <div class="pb-2 border-bottom border-secondary"><b>Share</b></div>
                        <div class="py-2">
                            <div class="d-inline-block px-2">
                                <a href="<?php echo $facebook_url; ?>" target="_blank" rel="noopener noreferrer">
                                    <svg fill="<?php echo $icon_color; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20" height="20">
                                        <path d="M12,27V15H8v-4h4V8.852C12,4.785,13.981,3,17.361,3c1.619,0,2.475,0.12,2.88,0.175V7h-2.305C16.501,7,16,7.757,16,9.291V11 h4.205l-0.571,4H16v12H12z" />
                                    </svg>
                                </a>
                            </div>
                            <div class="d-inline-block px-2">
                                <a href="<?php echo $twitter_url; ?>" target="_blank" rel="noopener noreferrer">
                                    <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.2918 16.5001C13.8371 16.5001 17.9652 10.2474 17.9652 4.82667C17.9652 4.65089 17.9613 4.4712 17.9535 4.29542C18.7566 3.71467 19.4496 2.99533 20 2.1712C19.2521 2.50396 18.458 2.72127 17.6449 2.81574C18.5011 2.30255 19.1421 1.49635 19.4492 0.546594C18.6438 1.02392 17.763 1.36063 16.8445 1.5423C16.2257 0.884756 15.4075 0.449386 14.5164 0.303498C13.6253 0.15761 12.711 0.309331 11.9148 0.735202C11.1186 1.16107 10.4848 1.83738 10.1115 2.65955C9.73825 3.48172 9.64619 4.40397 9.84961 5.2837C8.21874 5.20186 6.62328 4.77821 5.16665 4.0402C3.71002 3.3022 2.42474 2.26632 1.39414 0.999719C0.870333 1.90282 0.710047 2.97149 0.945859 3.98853C1.18167 5.00557 1.79589 5.89466 2.66367 6.47511C2.01219 6.45443 1.37498 6.27902 0.804688 5.96339V6.01417C0.804104 6.96191 1.13175 7.88061 1.73192 8.6141C2.3321 9.34758 3.16777 9.85059 4.09687 10.0376C3.49338 10.2027 2.85999 10.2268 2.2457 10.1079C2.50788 10.923 3.01798 11.6359 3.70481 12.1471C4.39164 12.6583 5.22093 12.9423 6.07695 12.9595C4.62369 14.101 2.82848 14.7202 0.980469 14.7173C0.652739 14.7168 0.325333 14.6967 0 14.6571C1.87738 15.8616 4.06128 16.5013 6.2918 16.5001Z" fill="<?php echo $icon_color; ?>" />
                                    </svg>
                                </a>
                            </div>
                            <div class="d-inline-block px-2">
                                <a href="<?php echo $linkedin_url; ?>" target="_blank" rel="noopener noreferrer">
                                    <svg fill="<?php echo $icon_color; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20" height="20">
                                        <path d="M9,25H4V10h5V25z M6.501,8C5.118,8,4,6.879,4,5.499S5.12,3,6.501,3C7.879,3,9,4.121,9,5.499C9,6.879,7.879,8,6.501,8z M27,25h-4.807v-7.3c0-1.741-0.033-3.98-2.499-3.98c-2.503,0-2.888,1.896-2.888,3.854V25H12V9.989h4.614v2.051h0.065 c0.642-1.18,2.211-2.424,4.551-2.424c4.87,0,5.77,3.109,5.77,7.151C27,16.767,27,25,27,25z" />
                                    </svg>
                                </a>
                            </div>
                            <div class="d-inline-block px-2">
                                <a href="<?php echo $email_url; ?>" target="_blank" rel="noopener noreferrer">
                                    <svg width="20" height="20" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M45,7H3a3,3,0,0,0-3,3V38a3,3,0,0,0,3,3H45a3,3,0,0,0,3-3V10A3,3,0,0,0,45,7Zm-.64,2L24,24.74,3.64,9ZM2,37.59V10.26L17.41,22.17ZM3.41,39,19,23.41l4.38,3.39a1,1,0,0,0,1.22,0L29,23.41,44.59,39ZM46,37.59,30.59,22.17,46,10.26Z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>