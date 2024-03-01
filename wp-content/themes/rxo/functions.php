<?php

/**
 * Rxo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Rxo
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '0.0.1');
}

define('WPE_GOVERNOR', false);
define('CM_FORM_ID', '4614');
//GET HOSTNAME INFO
$hostname = $_SERVER['SERVER_NAME'];

//Environment variables - Tracking
if ($hostname == 'rxo.com') {
    define('WP_ENV', 'production');
    define('TRACKING_API', 'https://track.rxoapi.com/unitrack/');
    define('TRACKING_MULTIPLE_API', 'https://track.rxoapi.com/unitrack/');
    define('TRACKING_WITH_ZIPCODE_API', 'https://track.rxoapi.com/unitrack/connect/');
    define('TRACKING_LEGACY_API', 'http://legacy-tracking-api.rxo.com/shipments');
    define('TRACKING_LM_URL', 'https://track.rxoapi.com/search?orderid=');
    define('TRACKING_SECRET_API', 'https://login.authxpo.com/connect/token');
    define('TRACKING_CLIENT_ID', 'xpo-dot-com-tracking');
    define('TRACKING_CLIENT_SECRET', 'nad358dYHFgWL44YNJ3mftV9aXyNSABfr483HkYXLDr3ndUbuL5sk5ffN8SmhhGj');

    // Vehicle Services API Credentials - Prod
    define('VS_TOKEN_URL', 'https://api-rxoconnect.rxo.com/oAuthAPI/rest/v1/token');
    define('VS_FETCH_URL', 'https://api-rxoconnect.rxo.com/AutoHaulAPI/rest/v1/Fetch');
    define('VS_CLIENT_ID', 'AutoHaul');
    define('VS_CLIENT_SECRET', 'AxLvApa03dZOXcrf4j8Re419GGJ664mSJgCmaTy8PnoN4qjSqF7sB6x74jl3CBrQ');
    define('VS_CLIENT_SCOPE', 'connect-api rates-api');
    define('VS_GRANT_TYPE', 'client_credentials');
    define('VS_X_API_KEY', '4jq7i9tZCub09jeTWwz6entmx9FbSFiHuVABChzuNwCAjbRO');
    define('VS_FORM_ID', '9427');
} else {
    define('WP_ENV', 'development');
    define('TRACKING_API', 'https://apiconnectdev.rxo.com/Xea.TrackService.Api-Main/unitrack/');
    define('TRACKING_MULTIPLE_API', 'https://apiconnectdev.rxo.com/Xea.TrackService.Api-Main/unitrack/');
    define('TRACKING_WITH_ZIPCODE_API', 'https://apiconnectdev.rxo.com/Xea.TrackService.Api-Main/unitrack/connect/');
    define('TRACKING_LEGACY_API', 'http://legacy-tracking-api.rxo.com/shipments');
    define('TRACKING_LM_URL', 'https://track.xpo.com/search?orderid=');
    define('TRACKING_SECRET_API', 'https://login-sandbox.authxpo.com/connect/token');
    define('TRACKING_CLIENT_ID', 'xpo-fulfilment-network-integration');
    define('TRACKING_CLIENT_SECRET', '6n6qQynnQBzmNG7gHyTnj7s7HS363R');

    // Vehicle Services API Credentials - Development
    define('VS_TOKEN_URL', 'https://api-uat-rxoconnect.rxo.com/oAuthAPI/rest/v1/token');
    define('VS_FETCH_URL', 'https://api-uat-rxoconnect.rxo.com/AutoHaulAPI/rest/v1/Fetch');
    define('VS_CLIENT_ID', 'AutoHaul');
    define('VS_CLIENT_SECRET', 'zfzw4L52AKVfT3Fl8a66cs92G921oEjaZCC545ik4RtL5j2A7iH3lJ8GYghFlvvo');
    define('VS_CLIENT_SCOPE', 'connect-api rates-api');
    define('VS_GRANT_TYPE', 'client_credentials');
    define('VS_X_API_KEY', 'rRKpo7ibrKGOyyKyLFAu0Ilt3zIg2Zqm2Ubmz2jKmJj5Euq4');

    /* Contract Motor Form API Credentials - Development */ 
    define('CM_TOKEN_URL', 'https://rxocrm--training.sandbox.my.salesforce.com/services/oauth2/token');
    define('CM_CLIENT_ID', '3MVG99PRsqIQWIIzL0SE.pw.oiuXta4icgx15WlCJnBGCLGqiy6UMYcbw.XpiQpMoEICJ0csY5VBFCCDhQrbu');
    define('CM_CLIENT_SECRET', '50A5A7F609CDD9A42D728B6FD1A6293BA810BF012CE18AF930EDD16DD40ABC56');
    define('CM_X_API_KEY', '');
    define('CM_USERNAME', 'integrationuser@rxo.com.training');
    define('CM_PASSWORD', 'SfdcRXOIntegrateTraining1!');
    define('CM_API_END_POINT', 'https://rxocrm--training.sandbox.my.salesforce.com/services/data/v58.0/sobjects/Carrier__c');
    define('CM_CLIENT_SCOPE', 'connect-api rates-api');
    define('CM_GRANT_TYPE', 'password');
    define('CM_SECURITY_TOKEN','');

    define('CM_OWNER_ID','0055c000009SU1JAAW');
    define('CM_RECORD_TYPE_ID','012DL000005s0KZYAY');
    define('CM_CURRENCY_CODE','USD');

    if ($hostname == 'dotcomdev.rxo.com') {
        define('VS_FORM_ID', '10544');
        
    } else {
        define('VS_FORM_ID', '8014');
    }
}

// WordPress Multisite Mode: WPO365 configuration for "Dedicated" mode
define('WPO_MU_USE_SUBSITE_OPTIONS', true);
define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);

function is_legacy() {
    $blog_details = get_blog_details();

    if ($blog_details->domain === 'rxo.com' && is_page(2052)) {
        return true;
    }

    return false;
}

// RXO Hide search bar
function hide_search_bar() {

    $blog_details = get_blog_details();

    if ($blog_details->domain === 'internal-tools.dotcomdev.rxo.com' || $blog_details->domain === 'internal-tools.dotcomstg.rxo.com' || $blog_details->domain === 'internal-tools.rxo.com') {
    return true;
    }

    if ($blog_details->domain === 'engage.dotcomdev.rxo.com' || $blog_details->domain === 'engage.dotcomstg.rxo.com' || $blog_details->domain === 'engage.rxo.com') {
        return true;
    }

    return false;
}

if (!function_exists('rxo_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function rxo_setup() {

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'header-primary' => esc_html__('Header Primary', 'rxo'),
                'header-secondary' => esc_html__('Header Secondary', 'rxo'),
                'footer-social' => esc_html__('Footer Social', 'rxo'),
                'footer-privacy' => esc_html__('Footer Privacy', 'rxo'),
                'footer-primary' => esc_html__('Footer Primary', 'rxo'),
            )
        );

        /*/Applications/Visual Studio Code.app/Contents/Resources/app/out/vs/code/electron-sandbox/workbench/workbench.html
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            )
        );
    }
}
add_action('after_setup_theme', 'rxo_setup');

add_image_size('customer-logo', 194, 120);
function custom_image_sizes($size_names) {
    $new_sizes = array(
        'customer-logo' => 'Customers logo',
    );
    return array_merge($size_names, $new_sizes);
}
add_filter('image_size_names_choose', 'custom_image_sizes');

/* Disable WordPress Admin Bar for all users */
add_filter('show_admin_bar', '__return_false');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rxo_content_width() {
    $GLOBALS['content_width'] = apply_filters('rxo_content_width', 640);
}
add_action('after_setup_theme', 'rxo_content_width', 0);


// Filter to allow iframe tags in acf custom fields
add_filter('wp_kses_allowed_html', 'acf_add_allowed_iframe_tag', 99, 2);
function acf_add_allowed_iframe_tag($tags, $context) {

    $tags['iframe'] = array(
        'src' => true,
        'height' => true,
        'width' => true,
        'frameborder' => true,
        'allowfullscreen' => true,
    );

    return $tags;
}

add_filter('generate_rewrite_rules', function ($wp_rewrite) {
    $wp_rewrite->rules = array_merge(
        ['track/[\w-]/?$' => 'index.php?track_id=$matches[1]'],
        $wp_rewrite->rules
    );
});

add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'track_id';
    return $query_vars;
});

add_action('template_redirect', function () {
    $track_id = get_query_var('track_id');
    if ($track_id) {
        include get_template_directory() . 'tracking.php';
        die;
    }
});

/**
 * Register Custom Navigation Walker
 */
function register_navwalker() {
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Common functions.
 */
require_once get_template_directory() . '/inc/common.php';

/**
 * Disabling XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Registering and adding editor-styles
 */
add_theme_support('editor-styles');

function rxo_editor_styles() {
    add_editor_style(array('/css/rxo-all.css', '/css/editor.css'));
}
add_action('admin_init', 'rxo_editor_styles');

function rxo_admin_scripts($hook) {
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.6.0', true);
    //wp_enqueue_script('rxo_admin_script', get_template_directory_uri() . '/js/editor.js', array('jquery'), '3.6.0', true);
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin-post-title.css');
    wp_enqueue_script('admin-post-title', get_template_directory_uri() . '/js/admin-post-title.js', array('jquery'), null, true);
}

add_action('admin_enqueue_scripts', 'rxo_admin_scripts', 99, 1);

/**
 * Enqueue scripts and styles.
 */
function rxo_scripts() {

    if (is_legacy()) {
        wp_enqueue_style('rxo-style', get_template_directory_uri() . '/css/legacy.css', array(), filemtime(get_template_directory() . '/css/legacy.css'));
    } else {
        wp_enqueue_style('rxo-style', get_template_directory_uri() . '/css/rxo-all.css', array(), filemtime(get_template_directory() . '/css/rxo-all.css'));
    }

    wp_deregister_script('jquery');

    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.6.1', true);
    wp_enqueue_script('jquery');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '5.2.1');

    wp_enqueue_script('rxo-scripts', get_template_directory_uri() . '/js/custom.js', array('jquery'), filemtime(get_template_directory() . '/js/custom.js'));

}

add_action('wp_enqueue_scripts', 'rxo_scripts', 99, 1);

function rxo_deregister_scripts() {
    wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'rxo_deregister_scripts');

/**
 * REST API functions
 */
add_role(
    'reader',
    'Reader (API User)',
    array(
        'read' => true,
        // Allows a user to read
        'create_posts' => false,
        // Allows user to create new posts
        'edit_posts' => false,
        // Allows user to edit their own posts
        'edit_others_posts' => false,
        // Allows user to edit others posts too
        'publish_posts' => false,
        // Allows the user to publish posts
        'manage_categories' => false,
        // Allows user to manage post categories
    )
);
include_once(get_stylesheet_directory() . '/inc/rest-api-functions.php');

/**
 * RXO Theme functions.
 */
// Theme related custom function based on the requirements
require_once get_template_directory() . '/inc/theme-functions.php';

// Show only allowed blocks in Gutenberg Editor.
require_once get_template_directory() . '/inc/rxo-allowed-blocks.php';

// Mega Menu
require_once get_template_directory() . '/MenuFields.php';

/**
 * ACF Block functions.
 */

// ACF - Custom functions for ACF blocks for the theme.
require_once get_template_directory() . '/inc/block-functions.php';

// ACF - Add custom styles to ACF Fields in admin side.
require_once get_template_directory() . '/inc/acf-custom-admin-styles.php';

/**
 * WPForms - Functions
 */

// WPForms - Add custom hooks to wp forms to match the design and requirements.
require_once get_template_directory() . '/inc/wpforms-functions.php';

// Enable wpforms dropdown choices values 
add_action('wpforms_fields_show_options_setting', '__return_true');

// Add Rxo form Template File
include_once(get_stylesheet_directory() . '/templates-parts/wpforms/wpforms-rxo-template.php');

/**
 * Regiser news article filter ajax
 */
function rxo_news_filter_posts() {
    $nonce = filter_var($_POST["nonce"], FILTER_SANITIZE_STRING);

    if (!wp_verify_nonce($nonce, 'ajax-nonce')) {
        wp_send_json_error(array('error' => 'Unauthorized'), 401);
    }

    if (!isset($_POST["args"]) || !isset($_POST["paged"]) || !isset($_POST["filters"])) {
        wp_send_json_error(array('error' => 'Bad configuration'), 400);
    }

    $q_args = filter_var($_POST["args"], FILTER_SANITIZE_STRING);

    $q_paged = filter_var($_POST["paged"], FILTER_VALIDATE_INT);

    $q_filters = filter_var($_POST["filters"], FILTER_SANITIZE_STRING);

    $args = json_decode(base64_decode($q_args));

    if (!$args) {
        wp_send_json_error(array('error' => 'Bad configuration'), 400);
    }

    $args = std_object_to_array($args);

    if ($q_filters) {
        parse_str($q_filters, $filters);
    }

    $tax_slug = $args['tax_query'][0]['taxonomy'];
    $hide_category = isset($filters[$tax_slug]) ? false : true;

    if (!empty($filters[$tax_slug])) {
        $args['tax_query'] = array(
            'relation' => 'OR'
        );
        $args['tax_query'][] = array(
            'taxonomy' => $tax_slug,
            'field' => 'slug',
            'terms' => $filters[$tax_slug]
        );
        $hide_category = true;
    }

    if ($filters['order']) {
        $args['order'] = $filters['order'];
    }

    if (!empty($filters['date_after']) && !empty($filters['date_before'])) {
        $date_before = date_create_from_format("j/M/y", $filters['date_before']);
        $filters['date_before'] = !empty($date_before) ? $date_before->format('m/d/Y') : $filters['date_before'];
        $date_after = date_create_from_format("j/M/y", $filters['date_after']);
        $filters['date_after'] = !empty($date_after) ? $date_after->format('m/d/Y') : $filters['date_after'];

        if ($filters['date_after'] === $filters['date_before']) {
            $args['date_query'] = array(
                array(
                    'year' => $date_after->format('Y'),
                    'month' => $date_after->format('m'),
                    'day' => $date_after->format('d')
                ),
            );
        } else {
            $args['date_query'] = array(
                array(
                    'after' => $filters['date_after'],
                    'before' => $filters['date_before'],
                    'inclusive' => true
                ),
            );
        }
    }

    $args['paged'] = $q_paged ? $q_paged : 0;

    $the_query = new WP_Query($args);

    $max_pages = $the_query->max_num_pages;
    $is_max_paged = ($max_pages > $q_paged) ? false : true;

    $html = "";

    ob_start();
    if ($the_query->have_posts()):
        while ($the_query->have_posts()):
            $the_query->the_post();
            get_template_part('template-parts/filter-templates/post-news-article', 'news_template', array('display_image' => true, 'hide_category' => $hide_category));
        endwhile;
    endif;
    $html .= ob_get_contents();
    ob_end_clean();

    wp_reset_postdata();
    wp_send_json_success(array('results' => $html, 'is_max_paged' => $is_max_paged));
    wp_die();
}
add_action('wp_ajax_nopriv_rxo_news_filter_posts', 'rxo_news_filter_posts');
add_action('wp_ajax_rxo_news_filter_posts', 'rxo_news_filter_posts');

/**
 * Filter to change the schema data.
 * Replace $schema_type with schema name like article, review, etc.
 *
 * @param array $entity Snippet Data
 *
 * @return array
 */
add_filter("rank_math/snippet/rich_snippet_article_entity", function ($entity) {
    if (isset($entity['author'])) {
        unset($entity['author']);
        return $entity;
    }
    return $entity;
});

function rxo_create_attachment($filename, $type) {

    if ($type == 'Carrier API') {
        $attachFileName = WP_CONTENT_DIR . '/uploads/json/carrier-api-explorer.json';
    } else if ($type == 'Customer API') {
        $attachFileName = WP_CONTENT_DIR . '/uploads/json/customer-api-explorer.json';
    } else if ($type == 'Managed Transport API') {
        $attachFileName = WP_CONTENT_DIR . '/uploads/json/managed-transportation-api-explorer.json';
    } else {
        return true;
    }

    if (copy($filename, $attachFileName)) {
        $Msg = "File Copied";
    } else {
        $Msg = "Copy Issue";
    }

    return true;
}

function rxo_on_before_cf7_send_mail(\WPCF7_ContactForm $contactForm) {

    $submission = WPCF7_Submission::get_instance();
    if ($submission) {
        $uploaded_data = $submission->get_posted_data();
        $type = $_POST['api-document-type'];
        $uploaded_files = $submission->uploaded_files();
        if ($uploaded_files) {
            foreach ($uploaded_files as $fieldName => $filepath) {
                if (is_array($filepath)) {
                    foreach ($filepath as $key => $value) {
                        $data = rxo_create_attachment($value, $type);
                    }
                } else {
                    $data = rxo_create_attachment($filepath, $type);
                }
            }
        }
    }
}
add_action('wpcf7_before_send_mail', 'rxo_on_before_cf7_send_mail');

/**
 * Regiser resource center article filter ajax
 */
function rxo_resource_center_filter_posts() {
    $nonce = filter_var($_POST["nonce"], FILTER_SANITIZE_STRING);

    if (!wp_verify_nonce($nonce, 'ajax-nonce')) {
        wp_send_json_error(array('error' => 'Unauthorized'), 401);
    }

    if (!isset($_POST["args"]) || !isset($_POST["paged"]) || !isset($_POST["filters"])) {
        wp_send_json_error(array('error' => 'Bad configuration'), 400);
    }

    $q_args = filter_var($_POST["args"], FILTER_SANITIZE_STRING);

    $q_paged = filter_var($_POST["paged"], FILTER_VALIDATE_INT);

    $q_filters = filter_var($_POST["filters"], FILTER_SANITIZE_STRING);

    $args = json_decode(base64_decode($q_args));

    if (!$args) {
        wp_send_json_error(array('error' => 'Bad configuration'), 400);
    }

    $args = std_object_to_array($args);

    if ($q_filters) {
        parse_str($q_filters, $filters);
    }

    $tax_slug = $args['tax_query'][0]['taxonomy'];
    $hide_category = isset($filters[$tax_slug]) ? false : true;

    if (!empty($filters[$tax_slug])) {
        $args['tax_query'] = array(
            'relation' => 'OR'
        );
        $args['tax_query'][] = array(
            'taxonomy' => $tax_slug,
            'field' => 'slug',
            'terms' => $filters[$tax_slug]
        );
        $hide_category = true;
    }

    $args['orderby'] = 'date';
    $args['order'] = 'DESC';

    $args['paged'] = $q_paged ? $q_paged : 0;

    $the_query = new WP_Query($args);

    $max_pages = $the_query->max_num_pages;
    $is_max_paged = ($max_pages > $q_paged) ? false : true;

    $html = "";

    $cls_mb = 'mb-5';

    ob_start();
    if ($the_query->have_posts()):
        while ($the_query->have_posts()):
            $the_query->the_post();
            get_template_part('template-parts/filter-templates/post-news-article', 'news_template', array('display_image' => true, 'hide_category' => false, 'post_type' => 'resource_center', 'id' => get_the_ID(), 'cls_mb' => $cls_mb));
        endwhile;
    endif;
    $html .= ob_get_contents();
    ob_end_clean();

    wp_reset_postdata();
    wp_send_json_success(array('results' => $html, 'is_max_paged' => $is_max_paged));
    wp_die();
}
add_action('wp_ajax_nopriv_rxo_resource_center_filter_posts', 'rxo_resource_center_filter_posts');
add_action('wp_ajax_rxo_resource_center_filter_posts', 'rxo_resource_center_filter_posts');

function femscores_reading_time($postID) {
    $content = get_post_field('post_content', $postID);
    $word_count = str_word_count(strip_tags($content));
    $readingtime = ceil($word_count / 200);
    $timer = " min";
    $totalreadingtime = $readingtime . $timer;
    return $totalreadingtime;
}

function search_pre_get_posts($query) {

    if (!$query->is_admin && $query->is_search) {
        if (isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'resource_center') {
            $query->set('has_password', FALSE);
            $query->set('orderby', 'meta_value');
            $query->set('meta_key', 'short_title');
            $query->set('order', 'ASC');
        } else {
            $query->set('has_password', FALSE);
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
        }
        return $query;
    }
}
add_action('pre_get_posts', 'search_pre_get_posts');

/**
 * Hide Resource Center articles from search results page.
 */
function rxo_search_exclude_filter($query) {

    if (!$query->is_admin && $query->is_search && $query->is_main_query()) {
        //$query->set( 'post__not_in', array( 6635 ) );    
        $args = array(
            'post_type' => 'resource_center',
            'post_status' => 'publish',
            'fields' => 'ids',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'content_toggles',
                    'value' => 'search',
                    'compare' => 'LIKE'
                ),
            ),
        );
        $search_filter_rc_articles = new WP_Query($args);
        $ID_array = $search_filter_rc_articles->posts;
        $ID_array_value = implode(",", $ID_array);
        $query->set('post__not_in', array($ID_array_value));
    }
}
add_action('pre_get_posts', 'rxo_search_exclude_filter');

function rxo_custom_password_protected_form() {
    global $post;
    $label = 'rxo_pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $output = '';
    $output .= '<div class="container position-relative article-width py-8 px-xl-7 d-flex flex-column">
                    <form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" class="rxo-password-protected-form" method="post">
                    <h4 class="font-normal mb-7">' . __('This content is password protected. To view it please enter the password below:') . '</h4>
                    <div class="d-block"><label class="d-block mb-4 cursor-pointer" for="' . $label . '"><strong class="d-block mb-2">' . __('Password') . ' </strong><input name="post_password" id="' . $label . '" type="password" size="20" class="form-control" /></label></div><button type="submit" name="Submit" class="btn btn-primary">' . esc_attr_x('Enter page', 'post password form') . '</button>
                    </form>
                </div>';

    $blog_details = get_blog_details();

    if ($blog_details->domain === 'engage.dotcomdev.rxo.com' || $blog_details->domain === 'engage.dotcomstg.rxo.com' || $blog_details->domain === 'engage.rxo.com') {
        $engage_raytheon_training_page_slug = 'ns2sugcbuays6zi5fttm';
        if (is_page($engage_raytheon_training_page_slug)) {
            $output .= '';
        } else {
            $output .= '<div class="container position-relative py-8 px-xl-7 d-flex flex-column "><div class="rxo-block-cta-banner text-bg-black dark-theme row gx-3 align-items-center overflow-hidden py-3 px-2 px-md-3 px-lg-5 mx-0 rounded-4"><div class="col-12 col-md-6"><h4>Having trouble?</h4><p>Reach out and let us know you’re having difficulty.</p></div><div class="col-12 col-md-6 justify-content-md-end flex-column flex-md-row d-flex flex-wrap gap-md-3"><div id="rxo-block-e34d365f829cee8465166a368a1ae8ed" class="py-3 rxo-block-button ">
            <a class="btn btn-primary btn " href="mailto:rtx_inbound@rxo.com" target="_self">Contact us</a>
            </div></div></div></div>';
        }
    } else {
        $output .= '<div class="container position-relative py-8 px-xl-7 d-flex flex-column "><div class="rxo-block-cta-banner text-bg-black dark-theme row gx-3 align-items-center overflow-hidden py-3 px-2 px-md-3 px-lg-5 mx-0 rounded-4"><div class="col-12 col-md-6"><h4>Having trouble?</h4><p>Reach out and let us know you’re having difficulty.</p></div><div class="col-12 col-md-6 justify-content-md-end flex-column flex-md-row d-flex flex-wrap gap-md-3"><div id="rxo-block-e34d365f829cee8465166a368a1ae8ed" class="py-3 rxo-block-button ">
        <a class="btn btn-primary btn " href="' . site_url() . '/contact-us/" target="_self">Contact us</a>
        </div></div></div></div>';
    }

    return $output;

}
add_filter('the_password_form', 'rxo_custom_password_protected_form', 99);

function search_article_title_filter($where, &$wp_query) {
    global $wpdb;
    if ($search_term = $wp_query->get('search_prod_title')) {
        $where .= ' AND (' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($search_term)) . '%\' OR ' . $wpdb->posts . '.post_content LIKE \'%' . esc_sql($wpdb->esc_like($search_term)) . '%\' )';
    }
    return $where;
}

/**
 *  Function to get post ID By slug 
 */ 
 function get_id_by_slug($page_slug, $slug_page_type = 'page') {
	$find_page = get_page_by_path($page_slug, OBJECT, $slug_page_type);
	if ($find_page) {
		return $find_page->ID;
	} else {
		return null;
	}
}

/**
 * Feature Post - Choose Box - remove password protected posts
 */
function acf_load_not_password_protected_posts_field_choices($field) {
    $exclude_news_POSTID = get_id_by_slug('press-releases','news_article');

    $field['choices'] = array();
    $arr_choices = get_posts(array('post_type' => 'news_article', 'numberposts' => -1, 'post_status' => 'publish', 'has_password' => FALSE,'post__not_in'=>[$exclude_news_POSTID]));
    if (is_array($arr_choices)) {
        foreach ($arr_choices as $choice) {
            $field['choices'][$choice->ID] = $choice->post_title;
        }
    }
    return $field;
}
add_filter('acf/load_field/name=post', 'acf_load_not_password_protected_posts_field_choices');

/**
 * Filter Media & Text block - Add image caption
 */
function rxo_media_text_block_show_caption($block_content, $block) {
    if ($block['blockName'] === 'core/media-text') {
        $mediaId = $block['attrs']['mediaId'];
        if ($mediaId) {
            $image = get_post($mediaId);
            $image_caption = $image->post_excerpt;
            if ($image_caption) {
                $content = str_replace('</figure>', '<figcaption class="rxo-img-caption">' . $image_caption . '</figcaption></figure>', $block_content);
                return $content;
            }
        }
    }
    return $block_content;
}
add_filter('render_block', 'rxo_media_text_block_show_caption', 10, 2);

/**
 * Curated series - Choose Box - exclude all resource post
 */
function acf_load_not_all_resource_post_field_choices($field) {
    $exclude_resource_POSTID = get_id_by_slug('all-resources','resource_center');

    $field['choices'] = array();
    $arr_choices = get_posts(
        array(
         'post_type' => 'resource_center',
         'numberposts' => -1,
         'post_status' => 'publish',
         'has_password' => FALSE,
         'post__not_in'=>[$exclude_resource_POSTID],
         'meta_query'    => array(
            'relation'      => 'AND',
            array(
                'key'       => 'content_toggles',
                'value'     => 'not_recommendations',
                'compare'   => 'NOT LIKE'
            )
         ),
        ));
    if (is_array($arr_choices)) {
        foreach ($arr_choices as $choice) {
            $field['choices'][$choice->ID] = $choice->post_title;
        }
    }
    return $field;
}
add_filter('acf/load_field/name=posts', 'acf_load_not_all_resource_post_field_choices');    

/**
 * Show the banner when a html element with class 'cmplz-show-banner' is clicked
 */
function cmplz_show_banner_on_click() {
	?>
	<script>
        function addEvent(event, selector, callback, context) {
            document.addEventListener(event, e => {
                if ( e.target.closest(selector) ) {
                    callback(e);
                }
            });
        }
        addEvent('click', '.cmplz-show-banner', function(){
            document.querySelectorAll('.cmplz-manage-consent').forEach(obj => {
                obj.click();
            });
        });
	</script>
	<?php
}
add_action( 'wp_footer', 'cmplz_show_banner_on_click', 100 );

// Remove empty p tags from ACF
remove_filter( 'acf_the_content', 'wpautop' );

/**
 * Gets the current post type in the WordPress Admin - For widget block
 */
function rxo_get_current_post_type() {
    global $post, $typenow, $current_screen;
      
    //we have a post so we can just get the post type from that
    if ( $post && $post->post_type )
      return $post->post_type;
      
    //check the global $typenow - set in admin.php
    elseif( $typenow )
      return $typenow;
      
    //check the global $current_screen object - set in sceen.php
    elseif( $current_screen && $current_screen->post_type )
      return $current_screen->post_type;
    
    //lastly check the post_type querystring
    elseif( isset( $_REQUEST['post_type'] ) )
      return sanitize_key( $_REQUEST['post_type'] );
      
    //we do not know the post type!
    return null;
  }

/**
 * Load the blocks related to Custom Post Types - For widget block
 */
function acf_load_block_types_field_choices( $field ) {
    
    $post_type = rxo_get_current_post_type();
    // reset choices
    $choices = array();
    
    if( 'page' == $post_type) {
        $choices[ 'stay_connected' ] = 'Stay Connected';
        $choices[ 'latest_news' ] = 'Latest News';
        $choices[ 'leadership' ] = 'Leadership';
    } elseif ( 'news_article' == $post_type) {
        $choices[ 'latest_news' ] = 'Latest News';
    } elseif ( 'resource_center' == $post_type) {
        $choices[ 'latest_resource_center' ] = 'Latest Resources';
        $choices[ 'curated_series' ] = 'Curated Series';
        $choices[ 'deeper_dive' ] = 'Deeper Dive';
    }
    
    $field['choices'] = $choices;

    // return the field
    return $field;
}
add_filter('acf/load_field/name=block_type', 'acf_load_block_types_field_choices');

/**
 * This will fire at the very end of a (successful) form entry.
 *
 * @link  https://wpforms.com/developers/wpforms_process_complete/
 *
 * @param array  $fields    Sanitized entry field values/properties.
 * @param array  $entry     Original $_POST global.
 * @param array  $form_data Form data and settings.
 * @param int    $entry_id  Entry ID. Will return 0 if entry storage is disabled or using WPForms Lite.
 */
function wpf_dev_process_complete( $fields, $entry, $form_data, $entry_id ) {

    if (absint( $form_data[ 'id' ] ) === absint(VS_FORM_ID)) {
        // Set transient to get the form response and send to other functions
        $rxo_stored_session_vs = sanitize_text_field(get_transient( 'wp_rxo_dotcom_vs' ));
        if ($rxo_stored_session_vs) {
            $vs_response_fields = json_decode(base64_decode($rxo_stored_session_vs));
            $vs_response_data = std_object_to_array($vs_response_fields);
        }

        // Get the full entry object
        $entry = wpforms()->entry->get( $entry_id );

        // Fields are in JSON, so we decode to an array
        $entry_fields = json_decode( $entry->fields, true );

        if($vs_response_data[16][ 'value' ]) { $entry_fields[16][ 'value' ] = $vs_response_data[16][ 'value' ]; }
        if($vs_response_data[17][ 'value' ]) { $entry_fields[17][ 'value' ] = $vs_response_data[17][ 'value' ]; }
        if($vs_response_data[18][ 'value' ]) { $entry_fields[18][ 'value' ] = $vs_response_data[18][ 'value' ]; }
        if($vs_response_data[19][ 'value' ]) { $entry_fields[19][ 'value' ] = $vs_response_data[19][ 'value' ]; }

        // Convert back to json
        $entry_fields = json_encode( $entry_fields );

        // Save changes
        wpforms()->entry->update( $entry_id, array( 'fields' => $entry_fields ), '', '', array( 'cap' => false ) );

        return;
    } else if (absint( $form_data[ 'id' ] ) === absint(CM_FORM_ID)) {
        // Set transient to get the form response and send to other functions
        $rxo_stored_session_cm = sanitize_text_field(get_transient( 'wp_rxo_dotcom_cm' ));
        if ($rxo_stored_session_cm) {
            $cm_response_fields = json_decode(base64_decode($rxo_stored_session_cm));
            $cm_response_data = std_object_to_array($cm_response_fields);
        }

        // Get the full entry object
        $entry = wpforms()->entry->get( $entry_id );

        // Fields are in JSON, so we decode to an array
        $entry_fields = json_decode( $entry->fields, true );

        if($cm_response_data[29][ 'value' ]) { $entry_fields[29][ 'value' ] = $cm_response_data[29][ 'value' ]; }
      
        // Convert back to json
        $entry_fields = json_encode( $entry_fields );

        // Save changes
        wpforms()->entry->update( $entry_id, array( 'fields' => $entry_fields ), '', '', array( 'cap' => false ) );

        return;
    } else {
        return;
    }
}
add_action( 'wpforms_process_complete', 'wpf_dev_process_complete', 10, 4 );

/**
 * Filter applies to entry fields before a form notification email is sent.
 *
 * @link  https://wpforms.com/developers/wpforms_entry_email_data/
 *
 * @param  array  $fields     Sanitized entry field values/properties.
 * @param  array  $entry      Original $_POST global.
 * @param  array  $form_data  Form data and settings.
 *
 * @return array
 */
function wpf_dev_entry_email_data( $fields, $entry, $form_data ) {

    if (absint( $form_data[ 'id' ] ) === absint(VS_FORM_ID)) {

        $vs_response_fields = requestAQuote( $fields );
        set_transient( 'wp_rxo_dotcom_vs', base64_encode(json_encode($vs_response_fields)), MINUTE_IN_SECONDS );
        return $vs_response_fields;
    } else if(absint( $form_data[ 'id' ] ) === absint(CM_FORM_ID)){
        $cm_response_fields = request_ContractMotor_Form_Data( $fields );
        set_transient( 'wp_rxo_dotcom_cm', base64_encode(json_encode($cm_response_fields)), MINUTE_IN_SECONDS );
        return $cm_response_fields;
    }else {
        return $fields;
    }
}
add_filter( 'wpforms_entry_email_data' , 'wpf_dev_entry_email_data', 10, 3  );

/**
 * Vehicle Services - Get Access Tokens
 */
function getAccessTokenForVechicleServiceAPI() {

    // Set the content type
    $headers = array(
        'Content-Type: application/json',
        'x-api-key: ' . VS_X_API_KEY,
    );

    $payload = array(
        'client_id' => VS_CLIENT_ID,
        'client_secret' => VS_CLIENT_SECRET,
        'scope' => VS_CLIENT_SCOPE,
        'grant_type' => VS_GRANT_TYPE
    );

    try {
        $accessTokenCURL = curl_init();
        curl_setopt($accessTokenCURL, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($accessTokenCURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($accessTokenCURL, CURLOPT_URL, VS_TOKEN_URL);
        curl_setopt($accessTokenCURL, CURLOPT_POST, true);
        curl_setopt($accessTokenCURL, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($accessTokenCURL, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($accessTokenCURL);
        $httpcode = curl_getinfo($accessTokenCURL, CURLINFO_HTTP_CODE);
        $error = curl_error($accessTokenCURL);
        curl_close($accessTokenCURL);

        if ($error) {
            error_log("Vehicle Service - Error while retrieving access token " . $error);
            return 0;
        } else {
            if ($httpcode == 200) {
                return json_decode($response, true)['access_token'];
            } else {
                error_log("Vehicle Service - Error : " . $httpcode . $error);
                return 0;
            }
        }
    } catch (\Exception $ex) {
        $errorMessage = $ex->getMessage();
        error_log("Vehicle Service - Error : " . $errorMessage);
        return 0;
    }
}

/**
 * Vehicle Services - Get Vehicle Information using Access Token, Origin & Destination ZIP code and VIN number
 */
function requestAQuote($fields) {
    // retrieve value from the form fields //
    $vin = $fields[14]['value'];
    $origin_zipCode = $fields[9]['value'];
    $destination_zipCode = $fields[13]['value'];

    $access_token = getAccessTokenForVechicleServiceAPI();

    if($access_token == 0) {
        $fields[16]['value'] = '??';
        $fields[17]['value'] = '??';
        $fields[18]['value'] = '??';
        $fields[19]['value'] = '??';
        return $fields;
    }

    $payload = array(
        'vin' => $vin,
        'origin' => array('zipCode' => $origin_zipCode),
        'destination' => array('zipCode' => $destination_zipCode),
    );

    $headers = array(
        'Content-Type: application/json',
        'x-api-key: ' . VS_X_API_KEY,
        'xpoauthorization: ' . $access_token,
    );

    try {
        $vechicleQuoteCurl = curl_init();
        curl_setopt($vechicleQuoteCurl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($vechicleQuoteCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($vechicleQuoteCurl, CURLOPT_URL, VS_FETCH_URL);
        curl_setopt($vechicleQuoteCurl, CURLOPT_POST, true);
        curl_setopt($vechicleQuoteCurl, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($vechicleQuoteCurl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($vechicleQuoteCurl);
        $httpcode = curl_getinfo($vechicleQuoteCurl, CURLINFO_HTTP_CODE);
        $error = curl_error($vechicleQuoteCurl);
        curl_close($vechicleQuoteCurl);
        if ($error) {
            $fields[16]['value'] = '??';
            $fields[17]['value'] = '??';
            $fields[18]['value'] = '??';
            $fields[19]['value'] = '??';
            error_log("Vehicle Service - Error while retrieving quote " . $error);
        } else {
            if ($httpcode == 200) {
                $quote = json_decode($response, true);
                $fields[16]['value'] = $quote['vehicleDetails']['year'];
                $fields[17]['value'] = $quote['vehicleDetails']['make'];
                $fields[18]['value'] = $quote['vehicleDetails']['model'];
                $fields[19]['value'] = '$' . number_format($quote['autoHaulPrice']['price'], 2) . ' USD';
            } else {
                $fields[16]['value'] = '??';
                $fields[17]['value'] = '??';
                $fields[18]['value'] = '??';
                $fields[19]['value'] = '??';
                error_log("Vehicle Service - Request a quote failed");
            }
        }
    } catch (\Exception $ex) {
        $errorMessage = $ex->getMessage();
        error_log("Vehicle Service - Error : " . $errorMessage);
        $fields[16]['value'] = '??';
        $fields[17]['value'] = '??';
        $fields[18]['value'] = '??';
        $fields[19]['value'] = '??';
        return $fields;
    };
    return $fields;
}

/**
 * Contract Motor Form - Get Access Tokens
 */
function getAccessTokenForContractMotorFormAPI() {

    try {
        // Request authentication token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, CM_TOKEN_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'password',
            'client_id' => CM_CLIENT_ID,
            'client_secret' => CM_CLIENT_SECRET,
            'username' => CM_USERNAME,
            'password' => CM_PASSWORD . CM_SECURITY_TOKEN
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Accept: application/x-www-form-urlencoded",
            "Content-Type: application/x-www-form-urlencoded; charset=utf-8",
        ]);
        
        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        if ($error) {
            error_log("Contract Motor Form - Error while retrieving access token " . $error);
            return 0;
        } else {
            if ($httpcode == 200) {
                parse_str($result, $response);

                // Access token for subsequent API requests
                $accessToken = $response['contract_motor_access_token'];
                return $accessToken;
            } else {
                error_log("Contract Motor Form - Error : " . $httpcode . $error);
                return 0;
            }
        }
    } catch (\Exception $ex) {
        $errorMessage = $ex->getMessage();
        error_log("Contract Motor Form - Error : " . $errorMessage);
        return 0;
    }
}

/**
 * Contract Motor Form - Get form data by using OwnerId, RecordTypeId and CurrencyIsoCode
 */
function request_ContractMotor_Form_Data($fields){
 
    // Default values
    $OwnerId = CM_OWNER_ID;
    
    $RecordTypeId = CM_RECORD_TYPE_ID;

    $CurrencyIsoCode = CM_CURRENCY_CODE;

    // Default values from ACF
    global $post;

    $OwnerId1 = get_field('owner_id',$post->ID);
    $RecordTypeId1 = get_field('record_type_id',$post->ID);
    $CurrencyIsoCode1 = get_field('currency_code',$post->ID);

    // Form Field values
    $firstname = $fields[26]['value'];

    $lastname = $fields[27]['value'];

    $Name = $fields[10]['value'];

    $companyname = $fields[10]['value'];

    $phonenumber = $fields[11]['value'];

    $email = $fields[12]['value'];

    $state = $fields[1]['value'];

    $city = $fields[15]['value'];

    $trucksize = $fields[24]['value'];

    $comments = $fields[25]['value'];

    $PriorExperience = $fields[17]['value'];

    $EstablishedContract = $fields[20]['value'];

    $BusinessEntity = $fields[21]['value'];

    $ActiveMCUSDOT = $fields[22]['value'];

    $OwnTruck = $fields[23]['value'];

    $EstablishedContract = !empty($EstablishedContract) ? true : false;

    $BusinessEntity = !empty($BusinessEntity) ? true : false;

    $ActiveMCUSDOT = !empty($ActiveMCUSDOT) ? true : false;  

    $OwnTruck = !empty($OwnTruck) ? true : false;

    $fields[29]['value'] = $post->ID.'=='.$OwnerId1.'-'.$RecordTypeId1.'-'.$CurrencyIsoCode1;
    //return $fields;
    // Get Access Token from API
    $contract_motor_access_token = getAccessTokenForContractMotorFormAPI();

    if($contract_motor_access_token !=0) {
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Bearer ' . $contract_motor_access_token,
        );

        $state = 'AL';

        // Data to be sent in the request body
        $postData = [
            'OwnerId' => $OwnerId,
            'Name' => $Name,
            'CurrencyIsoCode' => $CurrencyIsoCode,
            'RecordTypeId' => $RecordTypeId,
            'City__c' => $city,
            'State_Province__c' => $state,
            'Description__c' => $comments,
            'Email__c' => $email,
            'Active_MC_US_DOT__c' => $ActiveMCUSDOT,
            'Business_Entity__c' => $BusinessEntity,
            'Contact_First_Name__c' => $firstname,
            'Contact_Last_Name__c' => $lastname,
            'Current_Factoring_Company__c' => $companyname,
            'Established_Contract__c' => $EstablishedContract,
            'How_did_you_hear_about_us__c' => $How_did_you_hear_about_us__c,
            'Own_Truck__c' => $OwnTruck,
            'Prior_Experience__c' => $PriorExperience,
            'Truck_Size__c' => $trucksize,
        ];

        // Convert the data to JSON
        $jsonData = json_encode($postData);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, CM_API_END_POINT);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);

        $result_array = json_decode($result, true);

        if($result_array['success']==1) {
            $success_message = 'Successfully Submitted. Reference No:'.$result_array['id'];
            $error_message = '';
            $fields[29]['value'] = $result_array['id'];
        } else {
            $success_message = '';
            $error_message = 'Issue on Data. Please try again after sometime.';
            $fields[29]['value'] = '0';
        }
    }
    return $fields;
}
