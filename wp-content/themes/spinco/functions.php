<?php

/**
 * SpinCo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SpinCo
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '0.0.1');
}

define('WPE_GOVERNOR', false);

if (!function_exists('spinco_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function spinco_setup()
    {

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
                'header-primary' => esc_html__('Header Primary', 'spinco'),
                'footer-social' => esc_html__('Footer Social', 'spinco'),
            )
        );

        /*
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
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }
}
add_action('after_setup_theme', 'spinco_setup');

add_image_size('customer-logo', 194, 120);
function custom_image_sizes($size_names)
{
    $new_sizes = array(
        'customer-logo' => 'Customers logo',
    );
    return array_merge($size_names, $new_sizes);
}
add_filter('image_size_names_choose', 'custom_image_sizes');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function spinco_content_width()
{
    $GLOBALS['content_width'] = apply_filters('spinco_content_width', 640);
}
add_action('after_setup_theme', 'spinco_content_width', 0);

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

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

function spinco_editor_styles()
{
    add_editor_style(array('/css/all.css', '/css/editor.css'));
}
add_action('admin_init', 'spinco_editor_styles');

function spinco_admin_scripts($hook)
{
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.6.0', true);
    wp_enqueue_script('spinco_admin_script', get_template_directory_uri() . '/js/editor.js', array('jquery'), '3.6.0', true);
}

add_action('admin_enqueue_scripts', 'spinco_admin_scripts', 99, 1);

/**
 * Enqueue scripts and styles.
 */
function spinco_scripts()
{
    if (is_page(1974)) {
        wp_enqueue_style('spinco-style-old', get_template_directory_uri() . '/css/all.min.css', array(), filemtime(get_template_directory() . '/css/all.min.css'));
    } else {
        wp_enqueue_style('spinco-style', get_template_directory_uri() . '/css/all.css', array(), filemtime(get_template_directory() . '/css/all.css'));
    }

    wp_deregister_script('jquery');

    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '3.6.0', true);
    wp_enqueue_script('jquery');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '5.2.0');
    wp_enqueue_script('spinco-scripts', get_template_directory_uri() . '/js/custom.js', array('jquery'), filemtime(get_template_directory() . '/js/custom.js'));
}
add_action('wp_enqueue_scripts', 'spinco_scripts', 99, 1);

function spinco_deregister_scripts()
{
    wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'spinco_deregister_scripts');


/**
 * ACF Block functions.
 */
require_once get_template_directory() . '/inc/block-functions.php';

/**
 * Enable wpforms dropdown choices values 
 */
add_action('wpforms_fields_show_options_setting', '__return_true');

/**
 * Add Newco form Template File
 */
include_once(get_stylesheet_directory() . '/templates-parts/wpforms/wpforms-newco-template.php');

function no_wordpress_login_errors()
{
    return 'Login failed: Invalid username or password.';
}
add_filter('login_errors', 'no_wordpress_login_errors');

/**
 * Output something before your form(s).
 * 
 * @link  https://wpforms.com/developers/wpforms_frontend_output_before/
 *
 * @param array  $form_data Form data and settings.
 * @param object $form      Form post type object.
 */

function wpf_dev_display_submit_before($form_data)
{
    if (!is_user_logged_in()) {

        $form_id    = absint($form_data['id']);

        _e('<input
            type="hidden"
            name="wpforms[nonce]"
            value="' . esc_attr(wp_create_nonce("wpforms::form_{$form_id}")) . '"/>');
    }
}

add_action('wpforms_display_submit_before', 'wpf_dev_display_submit_before', 10, 1);


/**
 * Add nonce code field validation.
 *
 * @link   https://wpforms.com/developers/how-to-add-coupon-code-field-validation-on-your-forms/
 */

function wpf_dev_validate_nonce($fields, $entry, $form_data)
{
    $form_id = absint($form_data['id']);

    if (
        !is_user_logged_in() && (empty($entry['nonce']) || !wp_verify_nonce($entry['nonce'], "wpforms::form_{$form_id}"))
    ) {
        wpforms()->process->errors[$form_data['id']]['footer'] = esc_html__('Something went wrong. Please reload the page and try again');
    }
}
add_action('wpforms_process', 'wpf_dev_validate_nonce', 10, 3);

/**
 * Turn off the email suggestion.
 *
 * @link  https://wpforms.com/developers/how-to-disable-the-email-suggestion-on-the-email-form-field/
 */

add_filter('wpforms_mailcheck_enabled', '__return_false');


/**
 * Restrict special characters from forms fields with special CSS class
 * Apply the class "wpf-char-restrict" to the field to enable.
 *
 * @link https://wpforms.com/developers/how-to-restrict-special-characters-from-a-form-field/
 */

function wpf_dev_char_restrict()
{
?>

    <script type="text/javascript">
        jQuery(function($) {
            $('.wpf-char-restrict').on('keypress', function(e) {

                var regex = new RegExp('^[a-zA-Z ]+$');
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

                if (!regex.test(key)) {

                    //$("div.wpf-char-restrict").html( "Please enter valid name" ).css("label.wpforms-error");

                    $("div.wpf-char-restrict label.wpforms-error").html("Please enter valid name");

                    e.preventDefault();
                    return false;
                }
            });

            $('.wpf-char-restrict-company').on('keypress', function(e) {

                var regex = new RegExp('^[a-zA-Z 0-9]+$');
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

                if (!regex.test(key)) {

                    //$("div.wpf-char-restrict-company").html( "Please enter valid company name" ).css("label.wpforms-error"); 

                    $("div.wpf-char-restrict-company  label.wpforms-error").html("Please enter valid company name");

                    e.preventDefault();
                    return false;
                }
            });

            //Prevent any copy and paste features to by-pass the restrictions
            $('.wpf-char-restrict').bind('copy paste', function(e) {

                var regex = new RegExp('^[a-zA-Z ]+$');
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

                if (!regex.test(key)) {
                    alert("Pasting feature has been disabled for this field"); // Put any message here
                    e.preventDefault();
                    return false;
                }
            });

        });
    </script>

<?php
}
add_action('wpforms_wp_footer_end', 'wpf_dev_char_restrict', 10);

/*
 * Display confirmation message and form after successful submission.
 *
 * @link  https://wpforms.com/developers/how-to-display-the-confirmation-and-the-form-again-after-submission/
 *
 */

function wpf_dev_frontend_output_success($form_data, $fields, $entry_id)
{

    // Optional, you can limit to specific forms. Below, we restrict output to form #235.
    // if (absint($form_data['id']) !== 2128) {
    //     return;
    // }

    // Reset the fields to blank
    unset(
        $_GET['wpforms_return'],
        $_POST['wpforms']['id']
    );

    // Uncomment this line out if you want to clear the form field values after submission
    unset($_POST['wpforms']['fields']);

    // Actually render the form.
    wpforms()->frontend->output($form_data['id']);
}

add_action('wpforms_frontend_output_success', 'wpf_dev_frontend_output_success', 99, 3);
