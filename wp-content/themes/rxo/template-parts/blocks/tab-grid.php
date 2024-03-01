<?php

/**
 * Block Name: Tab Grid
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
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'light') ? ' text-bg-white' : '');

$abbreviated = get_field('abbreviated');
$title = get_field('title');
$copy = get_field('copy');
$cta_text = get_field('cta_text');
$cta_url = get_field('cta_url');
?>
<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="container position-relative py-3">
        <div class="col-12 my-3 text-center">
            <?php if ($title) : ?>
                <h2><?= $title; ?></h2>
            <?php endif; ?>
            <?php if ($copy) : ?>
                <p><?= $copy; ?></p>
            <?php endif; ?>
        </div>
<?php
    // check if the repeater field has rows of data
    if (have_rows('tab_names')) : ?>
        <div class="nav nav-tabs justify-content-center flex-wrap border-0 border-bottom" id="tabs_<?= $uid; ?>" role="tablist">
            <?php
            while (have_rows('tab_names')) : the_row();
                $tab_title = get_sub_field('tab_name');
                
            ?>
                <button class="nav-link bg-transparent fw-600 px-7 <?= get_row_index() === 1 ? 'active' : '' ?>" id="tab-<?=sanitize_title($tab_title)?>" data-bs-toggle="tab" data-bs-target="#<?=sanitize_title($tab_title)?>" type="button" role="tab" aria-controls="tab-<?=sanitize_title($tab_title)?>-pane" aria-selected="<?= get_row_index() === 1 ? 'true' : 'false' ?>"><?= $tab_title ?></button>
            <?php endwhile; ?>
        </div>
        <div class="tab-content pt-4 pt-md-3 " id="tabs_<?= $uid; ?>Content">
            <?php
            $j=1;
            while (have_rows('tab_names')) : the_row();
                $tab_title = get_sub_field('tab_name');
                $tab_content = get_sub_field('tab_content');
                
            ?>
                <div class="tab-pane fade <?= get_row_index() === 1 ? 'show active' : '' ?>" id="<?=sanitize_title($tab_title)?>" role="tabpanel" aria-labelledby="tab-<?=sanitize_title($tab_title)?>" tabindex="0">
                    <div class="row">
                        <?php
                        $tabcontent_count = 0;
                        while (have_rows('tab_content')) : the_row();
                            $benefits_image = get_sub_field('benefits_image');
                            $benefits_short_description = get_sub_field('benefits_short_description');
                            $benefits_name = get_sub_field('benefits_name');
                            $subtitle = get_sub_field('subtitle');
                            $benefits_url = get_sub_field('benefits_url');
                            $benefits_button_text = get_sub_field('benefits_button_text');
                            $modal_load_more_text = get_sub_field('modal_load_more_text');

                            switch ($benefits_url) {
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
                            <div class="col-12 col-md-3 col-lg-3 pt-3 pb-5 Tabcontent_<?= $j;?>">
                                <?php if (!empty($benefits_image['url'])) { ?>
                                    <img class="mb-3" src="<?php echo $benefits_image['url']; ?>" alt="<?php echo $benefits_image['alt'] ?>" />
                                <?php }
                                
                                if (!empty($subtitle)) { ?>
                                    <p class="mb-0"><?= $subtitle; ?></p>
                                <?php } 
                                if (!empty($benefits_name)) { ?>
                                    <h4 class="mb-3"><?php echo $benefits_name; ?></h4>
                                <?php } ?>

                                <button type="button" class="btn btn-link <?= ($theme === 'light')? ' btn-primary': 'btn-secondary text-primary border-primary';?>" data-bs-toggle="modal" data-bs-target="#benefitsModal_<?= $i; ?>">
                                    <?php echo $benefits_button_text = empty($benefits_button_text) ? "Learn More" : $benefits_button_text; ?>
                                </button>

                                <div class="modal fade modal-benefits" id="benefitsModal_<?= $i; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content overflow-hidden rounded-3 p-3 p-md-5 px-lg-8">
                                            <div class="modal-header p-0">
                                                <h3 class="py-0 text-black"><?= $benefits_name; ?></h3>
                                                <button type="button" class="btn btn-close btn-icon btn-rounded btn-secondary icon-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-black p-0">
                                                <hr class="border-4 border-primary opacity-100" />
                                                <p><?= $benefits_short_description; ?></p>
                                                <p><a class="btn btn-primary" href="<?= $benefits_url; ?>" <?= $link_attributes ?>><?php echo $modal_load_more_text = empty($modal_load_more_text) ? "Load More" : $modal_load_more_text; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php $i++;
                        $tabcontent_count++;
                        endwhile;
                        if($tabcontent_count > 4){
                        ?>
                        <div class="text-center col-12 pt-6 pb-5">
                        <?php if (!empty($cta_text) && !empty($cta_url) && $abbreviated === 'yes') : ?>
                            <a href="<?= $cta_url; ?>" class="btn btn-primary btn m-1"><?= $cta_text; ?></a>   
                        <?php elseif ($abbreviated === 'yes') : ?>        
                            <button type="button" id="showMore_<?= get_row_index(); ?>" class="btnloadmore btn <?= ($theme === 'light')? 'btn-outline-secondary': 'btn-outline-white';?>"><?= $cta_text; ?></button>    
                        <?php endif; ?>    
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <input type="hidden" id="tabindex" value="<?= count(get_field('tab_names')); ?>" />
            <?php 
            $j++;
            endwhile; ?>
            
        </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                No data available
            </div>
        </div>
    <?php endif; ?>
    </div>
</div>
<style>
.tab-pane{
	scroll-margin-top: 9em !important;
}
</style>    
<script>
    
    /*var hash = location.hash.replace(/^#/, '');
    if (hash) {
    var someVarName = $('.nav-tabs button[data-bs-target="#' + hash + '"]');
    var tab = new bootstrap.Tab(someVarName);
    tab.show();
    }

    $('.nav-tabs button').on('shown.bs.tab', function (e) {
    //window.location.hash = e.target.hash;
    window.location.hash = e.target.hash.replace("#", "#" + prefix);
    window.scrollTo(0, 0);
    })
*/
    </script>
    <script>
     $(document).ready(function() {
        //var win = $(window);
        var abbreviated = "<?php echo $abbreviated;?>";
        var tabindex = $('#tabindex').val();
        for(var i = 1; i <= tabindex; i++) {
            if(abbreviated == 'yes'){
                $(".Tabcontent_"+i).hide().slice(0, 4).show();
            }else{
                $(".Tabcontent_"+i).show();
            }
        }

        /*var screen = {
            width: win.width(),
            height: win.height()
        };
        if (screen.width < 800) {*/
           
            $(".btnloadmore").on("click", function(e) {
                var btnID = $(this).attr('id');
                var arr = btnID.split('_');
                $('#'+btnID).blur();
                $(".Tabcontent_"+arr[1]+":hidden").slice(0, 4).slideDown();
                if ($(".Tabcontent_"+arr[1]+":hidden").length == 0) {
                    $('#'+btnID).parent().hide();
                }
            });
        /*}*/
    });
    </script> 