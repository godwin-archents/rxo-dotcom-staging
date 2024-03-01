<?php
/*
 * Template Name: Carrier API Solution
 * description: Template for api solution page
 */

get_header();
?>
<?php
$get_site_url    = get_site_url();
$file = $get_site_url.'/wp-content/uploads/json/carrier-api-explorer.json';
?>
<main id="primary" class="site-main">
    
    <div class="py-0">
    <!--<redoc spec-url="<?= $file ?>"></redoc>-->
    <div id="redoc-container"></div>
    <script src="https://cdn.redoc.ly/redoc/latest/bundles/redoc.standalone.js"></script>
    <script>
    Redoc.init('<?= $file ?>', {
    scrollYOffset: 134
    }, document.getElementById('redoc-container'))
    </script>
    </div>
</main>
<style>
    div.menu-content {
        top:130px !important;
    }
    .sc-eCApnc {
       /* padding: 130px 0px !important; */
    }
    .jzOqkP img {
        width: 15px !important;
    }
    
	@media (prefers-reduced-motion: no-preference) {
	:root {
		scroll-behavior: unset !important;
	}
	}
</style>
<?php get_footer(); ?>