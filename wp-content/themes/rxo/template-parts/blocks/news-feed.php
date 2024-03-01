
<?php

/**
 * Block Name: News Feed
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

if( !empty($block['className']) ) { $className .= ' ' . $block['className']; }

if( !empty($block['align']) ) { $className .= ' ' . $block['align']; }

$theme = get_field('theme');
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : '');

$feed_url = get_field('feed_url');

?>

<?php if ($feed_url) :
    $news = ''; 
    $my_curl = curl_init();
    curl_setopt($my_curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($my_curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($my_curl, CURLOPT_URL, $feed_url);
    $result = curl_exec($my_curl);
    $httpcode = curl_getinfo($my_curl, CURLINFO_HTTP_CODE);
    if ($httpcode != 200) {
        if ($_REQUEST['action'] != "edit") {
            echo '<script>location.href = "/news-feed-error/";</script>';
        }
        echo '<script>console.log("feed_error ' . $httpcode . '", "' . curl_error($my_curl) . '");</script>';
        $news = '';
    } else {
        $news = json_decode($result, true);
    }
    curl_close($my_curl); 

    $topicArray=array();
    foreach ( $news as $newsdata ) { 
        if (!in_array($newsdata['CustomerLabel'], $topicArray)) {
            array_push($topicArray,$newsdata['CustomerLabel']);
        }            
    }

    $newsArray=array();

    $wp_rxo_news_feed_topic = sanitize_text_field(get_transient('wp_rxo_news_feed_topic'));
    if ($wp_rxo_news_feed_topic && !isset($_REQUEST['topic'])) {
        $rxo_news_topic = json_decode(base64_decode($wp_rxo_news_feed_topic));
        $rxo_news_topic = std_object_to_array($rxo_news_topic);    
        $_REQUEST['topic'] =  $rxo_news_topic;    
    }
    

    if(isset($_REQUEST['topic'])){
        $topicFilter = urldecode($_REQUEST['topic']);
        set_transient( 'wp_rxo_news_feed_topic', base64_encode(json_encode($topicFilter)), 0 );
        if($topicFilter=='All Topics') {
            foreach ( $news as $newsdata ) {
                array_push($newsArray,$newsdata);
            }
        } else {
            foreach ( $news as $newsdata ) {
                if($topicFilter==$newsdata['CustomerLabel']){
                    array_push($newsArray,$newsdata);
                }                
            }
        }
    } else if(isset($rxo_news_topic) && $rxo_news_topic!='') {
        $topicFilter = $rxo_news_topic;
        $_REQUEST['topic'] =  $topicFilter;
        set_transient( 'wp_rxo_news_feed_topic', base64_encode(json_encode($topicFilter)), 0 );
        if($topicFilter=='All Topics') {
            foreach ( $news as $newsdata ) {
                array_push($newsArray,$newsdata);
            }
        } else {
            foreach ( $news as $newsdata ) {
                if($topicFilter==$newsdata['CustomerLabel']){
                    array_push($newsArray,$newsdata);
                }                
            }
        }
    } else {
        foreach ( $news as $newsdata ) {
            array_push($newsArray,$newsdata);
        }
    }

    ?>
<?php endif; 

if(!empty($newsArray))
{
    $newsChunks = array_chunk($newsArray, 10);
}
?>
<div class="<?= $uid; ?> <?= $className; ?> rxo-block-top-story-card">
    <div class="container position-relative py-0">
        <div class="row">
            <h2 class="m-0 p-60 d-xl-block d-lg-block d-md-none d-sm-none">See the latest transportation headlines</h2>
            <div class="d-xl-flex d-lg-flex d-md-none d-sm-none flex-row flex-nowrap top-story-card-wrap">
                <?php $boxcount = 0;
                foreach ( $news as $newsdata ) { 
                    if($boxcount < 3) { ?>
                    <div class="col-mid-4">
                        <div class="d-flex gap-2 top-story-card-info">
                            <h3 class="tsc-title ellipsis ellipsis--4"><?php echo $newsdata['SourceTitle']; ?></h3>
                            <a href="<?php echo $newsdata['SourceUrl']; ?>" class="tsc-btn-arrow" target="_blank" >&nbsp;</a>
                        </div>
                    </div>
                    <?php $boxcount++;
                    }
                } ?> 
            </div>
        </div>
    </div>
</div>
<div id="<?= $uid; ?>" class="<?= $className; ?> rxo-block-article-blurb py-xl-7 py-lg-7 py-md-5 py-sm-5">
    <div class="container position-relative py-0">
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-4 d-xl-none d-lg-none d-md-block d-sm-block sticky-top">
                <div class="d-grid gap-2">
                    <h5>Filter Articles by Topic</h5>
                    <select name="topic_filter" id="topic_filter" class="form-select js-choice" onchange="OnchagneTopic(this.value)">
                            <option selected value="All Topics">All Topics</option>
                            <?php foreach ( $topicArray as $topicdata ) { 
                                /* Remove 'Top Articles for' from article title */
                                $topicTitle = $topicdata;
                                $topicTitle = str_replace("Top Articles for", "", $topicTitle);
                            ?>
                                <option value="<?php echo $topicdata; ?>" <?php if($topicdata==$topicFilter) { echo 'selected'; }  ?>><?php echo $topicTitle; ?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>
            <?php /*<div class="col-12 col-lg-7 col-xl-7">
                <div class="d-grid gap-xl-7 gap-lg-7 gap-md-5 gap-sm-5">
                    <?php foreach ( $newsArray as $newsArraydata ) { ?>
                        <div class="d-grid gap-1">
                            <div class="d-grid ab-top-info-wrap">
                                <div class="ab-top-info">
                                    <div class="d-grid gap-1">
                                        <h5><?php echo $newsArraydata['SourceTitle']; ?></h5>
                                        <p><a href="?topic=<?php echo urlencode($topicdata); ?>" class="fw-700"><?php echo $newsArraydata['CustomerLabel']; ?></a></p>
                                    </div>
                                    <p class="article-blurb-subtitle"><?php echo $newsArraydata['Source']['title']; ?> - Published <?php echo $newsArraydata['PublishedDate']; ?></p>
                                </div>
                                <div class="article-blurb-right desktop">
                                <a href="<?php echo $newsArraydata['SourceUrl']; ?>" class="ab-icon-arrow" target="_blank" >View Article</a></div>
                            </div>
                            <div class="ellipsis ellipsis--4 article-blurb-content" title="<?php echo strip_tags($newsArraydata['Summary']); ?>"><?php echo $newsArraydata['Summary']; ?></div>
                            <div class="article-blurb-right mobile">
                                <a href="<?php echo $newsArraydata['SourceUrl']; ?>" class="ab-icon-arrow" target="_blank" >View Article</a>
                            </div>
                        </div> <!-- grid -->
                    <?php } ?> 
                </div>
            </div> */ ?>
            <div class="col-12 col-lg-7 col-xl-7">
                <div class="d-grid gap-xl-7 gap-lg-7 gap-md-5 gap-sm-5" id="records-container">
                <!-- Records will be loaded here -->
                </div>
               <div id="ajax-loader-message" class="mb-5"></div>
            </div>
            
            <div class="col-1 d-xl-block d-lg-block d-md-none d-sm-none">&nbsp;</div>
            <div class="col-12 col-lg-4 col-xl-4 d-sm-none d-md-none d-lg-block d-xl-block nf-border-left sticky-top">
                <div class="d-grid gap-5">
                    <h5 class="ellipsis ellipsis--2">Filter Articles by Topic</h5>
                    <ul class="nf-all-topics d-grid gap-3 list-unstyled">                
                        <li class="p-0"><a href="?topic=<?php echo urlencode('All Topics'); ?>" <?php if(!isset($_REQUEST['topic'])) { ?> class="topic-link topic-link--selected" <?php } else if(urldecode($_REQUEST['topic'])=='All Topics') { ?> class="topic-link topic-link--selected" <?php } else { ?> class="topic-link" <?php } ?> >All Topics</a></li>
                        <?php foreach ( $topicArray as $topicdata ) { 
                           /* Remove 'Top Articles for' from article title */
                           $topicTitle = $topicdata;
                            $topicTitle = str_replace("Top Articles for", "", $topicTitle);
                        ?>
                            <li class="p-0">
                                <a href="?topic=<?php echo urlencode($topicdata); ?>" <?php if(!isset($_REQUEST['topic'])) { ?> class="topic-link" <?php } else if(urldecode($_REQUEST['topic'])==$topicdata) { ?> class="topic-link topic-link--selected" <?php } else { ?> class="topic-link" <?php } ?> ><?php echo $topicTitle; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div> 
            </div> 
        </div> <!-- row -->
        
    </div> <!-- container -->
</div> <!-- block -->
<script>
$(document).ready(function() {
    selectInputs = $('#<?= $uid; ?>').find('.js-choice');
    [].forEach.call(selectInputs, function(sEl, i) {
        let choices = new Choices(sEl, {
            searchEnabled: false,
            allowHTML: true,
            itemSelectText: '',
        });
    });
});

function OnchagneTopic(value){
    var topic = encodeURIComponent(value);
    var url = window.location.href.split('?')[0];
    location.href = url+'?topic='+topic;
}

jQuery(document).ready(function($) {
    var chunkIndex = 0;
    var chunks = <?php echo json_encode($newsChunks); ?>;
    var chunkSize = 10;
    var container = $('#records-container');
    var loadingIcon = $('#ajax-loader-message'); 
    var loadingDelay = 1000;
  
    function loadNextNewsChunk() {
        if (chunkIndex < chunks.length) {
            var chunk = chunks[chunkIndex++];
           
            chunk.forEach(function(newsData) {
                /* Remove 'Top Articles for' from article title */
                var title = newsData['CustomerLabel'];
                var replaceTitle = "Top Articles for";
                var CustomerLabelResult = title.replace(replaceTitle,'');
                
                var recordHtml = `
                    <div class="d-grid gap-1">
                        <div class="d-grid ab-top-info-wrap">
                            <div class="ab-top-info">
                                <div class="d-grid gap-1">
                                    <h5>${newsData['SourceTitle']}</h5>
                                    <p><a href="?topic=${encodeURIComponent(newsData['CustomerLabel'])}" class="fw-700">${CustomerLabelResult}</a></p>
                                    </div>
                                <p class="article-blurb-subtitle">${newsData['Source']['title']} - Published ${newsData['PublishedDate']}</p>
                            </div>
                            <div class="article-blurb-right desktop">
                                <a href="${newsData['SourceUrl']}" class="ab-icon-arrow" target="_blank">View Article</a>
                            </div>
                        </div>
                        <div class="ellipsis ellipsis--4 article-blurb-content" title="${newsData['Summary']}">${newsData['Summary']}</div>
                        <div class="article-blurb-right mobile">
                            <a href="${newsData['SourceUrl']}" class="ab-icon-arrow" target="_blank">View Article</a>
                        </div>
                    </div>
                `;
                container.append(recordHtml);
            });
        }
      
        // Check if all records are loaded
        if (chunkIndex === chunks.length) {
            $(window).off('scroll'); // Remove scroll event handler if all records are loaded
            loadingIcon.hide(); // Hide loading icon when all chunks are loaded
        }
    }

    $(window).on('scroll', function() {
    var FooterHeight = 400;
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - FooterHeight) {
            loadingIcon.show(); // Show loading icon before loading next chunk
            setTimeout(function() {
                loadNextNewsChunk();
            }, loadingDelay);
        }
    });
    loadNextNewsChunk(); // Initial load
});

</script>
