<?php

/**
 * Block Name: Text Grid
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
$highlights_per_row = get_field('highlights_per_row');
if($highlights_per_row == 2 || $highlights_per_row == 4){
    $className .= ' text-bg-primary';
}else{
    $className .= ($theme === 'green') ? ' text-bg-primary' : (($theme === 'light') ? ' text-bg-white' : '');
}
$section_title = get_field('section_title');
$section_description = get_field('section_description');
$column_class = "col-12 ";
// switch ($highlights_per_row) {
//     case 4:
//         $column_class .= "col-md-6 col-lg-6 col-xl-3 mb-sm-6 mb-md-0 mb-lg-6 mb-xl-0";
//         break;
//     case 3:
//         $column_class .= "col-md-12 col-lg-4 col-xl-4 mb-sm-6 mb-md-6 mb-lg-6 mb-xl-6";
//         break;
//     case 2:
//         $column_class .= "col-md-6 col-lg-6";
//         break;
//     default:
//         $column_class .= "col-md-6 col-lg-6";
//         break;
// }

if($highlights_per_row == '4') {
    $column_class .= "four-column col-md-6 col-lg-6 col-xl-3 mb-sm-6 mb-md-6 mb-lg-4 mb-xl-0";

    $text_alignment = ' text-xl-center text-lg-center text-md-left text-sm-left ';
    $desc_width = ' w-xl-75 w-lg-75 w-md-100 w-sm-100 m-auto ';

} else {
    $column_class .= "three-column col-md-12 col-lg-4 col-xl-4 mb-sm-6 mb-md-6 mb-lg-4 mb-xl-0";

    $text_alignment = ' ';
    $desc_width = ' ';
}
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">

    <!-- 2 Column -->
    <?php if($highlights_per_row == '2') : ?>
        <div class="container position-relative py-sm-6 py-md-8 py-lg-8 py-xl-10">
            <div class="row justify-content-start <?= ((!empty($section_title) && empty($section_description))?'text-center':''); ?>">
                <?php if ($section_title) : ?>
                    <div class="col-12 col-lg-6 col-xl-6">
                        <h2 class="m-0 mb-sm-5 mb-md-6 mb-lg-0 p-0 text-xl-start text-lg-start text-md-center text-sm-center"><?= $section_title; ?></h2>
                    </div>
                <?php endif; ?>
                <div class="col-12 col-lg-1 col-xl-1 d-none d-xl-block d-lg-block">&nbsp;</div>
                <?php if ($section_description) : ?>
                    <div class="col-12 col-lg-5 col-xl-5"><?= $section_description; ?></div>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
    <!-- 3 and 4 Column -->
    <?php //if($highlights_per_row == '3') : ?>
        <div class="container position-relative py-sm-6 py-md-8 py-lg-8 py-xl-10">
                <div class="row text-start">
                    <?php
                    $col_cnt = 0;
                    $highlight_sets = get_field('highlight_sets');
                    if (is_array($highlight_sets)) {
                        $col_cnt = count($highlight_sets);
                    }
                    
                    // check if the repeater field has rows of data
                    if (have_rows('highlight_sets')) :
                        // loop through the rows of data
                        $post_cnt = 1;
                        while (have_rows('highlight_sets')) : the_row();
                            $title = get_sub_field('title');
                            $description = get_sub_field('description');
                            //$col_cnt = get_row_index();
                            if($post_cnt == 1) :

                                $m_btm_4_5 = (!empty($section_title) || !empty($section_description)) ? 'mb-4-5' : '0'; ?>
                                <div class="row justify-content-start <?= $m_btm_4_5; ?> <?= $text_alignment = !empty($text_alignment) ? $text_alignment : ''; (!empty($section_title) && !empty($section_description)) ? 'text-left' : 'text-center '; ?>">
                                    <?php if(!empty($section_description)) : ?>
                                        <?php if (!empty($section_title)) : ?>
                                            <div class="col-12">
                                                <h2 class="m-0 p-0 mb-sm-3 mb-md-4 mb-lg-4 mb-xl-4"><?= $section_title; ?></h2>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12 <?= $desc_width; ?>"><?= $section_description; ?></div>
                                    <?php else : ?>
                                        <?php if (!empty($section_title)) : ?>
                                            <div class="col-12">
                                                <h2 class="m-0 p-0 text-xl-center text-lg-center text-md-start text-sm-start"><?= $section_title; ?></h2>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="<?= $column_class ?>">
                                <div class="d-flex align-items-start">
                                    <div class="col">
                                        <?php if ($title) : ?>
                                            <h4 class="post-link-title m-0 p-0 mb-sm-3 mb-md-3 mb-lg-4 mb-xl-4"><?= $title ?></h4>
                                        <?php endif; ?>
                                        <?php if ($description) : ?>
                                            <p><?= $description ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php $post_cnt++; endwhile; ?>
                    <?php else : ?>
                        <div class="row justify-content-center text-center">
                            <?php if(!empty($section_description)) : ?>
                                <?php if(!empty($section_title)) : ?>
                                    <div class="col-12">
                                        <h2 class="m-0 p-0 mb-sm-3 mb-md-4 mb-lg-4 mb-xl-4"><?= $section_title; ?></h2>
                                    </div>
                                <?php endif; ?>
                                <div class="col-12 <?= $desc_width; ?>"><?= $section_description; ?></div>
                            <?php else : ?>
                                <?php if(!empty($section_title)) : ?>
                                    <div class="col-12">
                                        <h2 class="m-0 p-0 text-xl-center text-lg-center text-md-start text-sm-start"><?= $section_title; ?></h2>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>            
            </div>
        </div>
    <?php endif; ?>

    <?php /* if ($section_description && $highlights_per_row !='2') : ?> -->
        <div class="row align-items-center">
            <div class="col-12 col-lg-8 col-xl-6"><?= $section_description; ?></div>
        </div>
    <?php endif; ?>
    <div class="row text-start">
        <?php
        // check if the repeater field has rows of data
        if (have_rows('highlight_sets')) :
            // loop through the rows of data
            while (have_rows('highlight_sets')) : the_row();
                $title = get_sub_field('title');
                $description = get_sub_field('description');
        ?>
                <div class="<?= $column_class ?> mt-5">
                    <div class="d-flex align-items-start">
                        <div class="col">
                            <h5 class="post-link-title mt-0">
                                <?php if ($title) : ?>
                                    <?= $title ?>
                                <?php endif; ?>
                            </h5>
                            <?php if ($description) : ?>
                                <p><?= $description ?></p>
                            <?php endif; ?>
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
</div>*/ ?>
</div>