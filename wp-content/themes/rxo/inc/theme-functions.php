<?php

function no_wordpress_login_errors() {
    return 'Login failed: Invalid username or password.';
}
add_filter('login_errors', 'no_wordpress_login_errors');

function item_class_on_li($classes, $item, $args) {
    if (isset($args->li_class)) {
        $classes[] = $args->li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'item_class_on_li', 1, 3);

/**
 * Move page title on sidebar
 */
function rxo_custom_page_attributes_metabox() {
    // Add a custom meta box to get the page title entered in the popup.
    add_meta_box(
        'rxo_custom_page_attributes_metabox', // Unique ID
        'Page Title', // Box title
        'rxo_custom_page_attributes_metabox_content', // Content callback function
        'page', // Post type
        'side', // Context
        'high' // Priority
    );
}
add_action('add_meta_boxes_page', 'rxo_custom_page_attributes_metabox');

// Add a custom meta box to pages - admin side
function rxo_custom_page_attributes_metabox_content($post) {
    // Get the current page title and remove the default value
    $page_title = str_replace('Auto Draft', '', get_the_title($post->ID));

    // Output the title input field
    echo '<input type="text" id="custom_page_title" name="custom_page_title" value="' . esc_attr($page_title) . '" size="30" required />';
}

function rxo_custom_field_prompt_and_set_title() {
    if (is_admin() && function_exists('register_block_type')) {
        // Check if the current screen is for editing a post or adding a new post
        $current_screen = get_current_screen();
        if ($current_screen->post_type === 'page' && $current_screen->base === 'post') { ?>
            <div id="main-section">
                <div class="customModal" id="customTitleModal">
                    <div class="headerModal">
                        <a href="#" class="cancelModal">X</a>
                    </div>
                    <form class="form-page-title">
                        <div class="contentModal">
                            <label>Enter page title</label>
                            <input type="text" placeholder="Page title" required id="customTitleInput"/>    
                        </div>
                        <div class="footerModal">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div><!-- Popup -->
            </div><!-- Popup Transparent Background -->
            <?php // Check if the post title is empty
            $post_id = isset($_GET['post']) ? $_GET['post'] : 0;
            $post_title = get_the_title($post_id);

            if (empty($post_title)) { ?>
                <script type="text/javascript">
                    jQuery(document).ready(function($) {

                        // Wait for the DOM to be fully loaded                        
                        // Flag to track if the custom field value has been set
                        let customFieldHasBeenSet = false;

                        // Open the modal
                        $("#customTitleModal").css("display","block");
                        $('#main-section').css("display","block");
                        
                        $('#customTitleModal form').submit(function(event) {
                            event.preventDefault(); 
                            // Prompt the user for the custom field value
                            let customFieldValue = $('#customTitleInput').val();

                            // Check if the user entered a value
                            if (customFieldValue !== "") {
                                // Set the flag to true to indicate that the value has been set
                                customFieldHasBeenSet = true; 

                                // Update the post title with the custom field value
                                wp.data.dispatch('core/editor').editPost({ title: customFieldValue });
                                $('#custom_page_title').val(customFieldValue);
                                
                                // Close the modal
                                $('#main-section').fadeOut();
                                $('#customTitleModal').fadeOut();
                            }
                        });
                    });
                </script>
            <?php
            }
        }
    }
}
add_action('admin_footer', 'rxo_custom_field_prompt_and_set_title');

/**
 * Allow editors to see Appearance menu
 */ 
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );

function rxo_hide_menu() {

    if(!current_user_can( 'activate_plugins' )) {
        // Hide theme selection page
        remove_submenu_page( 'themes.php', 'themes.php' );

        // Hide widgets page
        remove_submenu_page( 'themes.php', 'widgets.php' );

        // Hide customize page
        global $submenu;
        unset($submenu['themes.php'][6]);
    }
} 
add_action('admin_head', 'rxo_hide_menu');
