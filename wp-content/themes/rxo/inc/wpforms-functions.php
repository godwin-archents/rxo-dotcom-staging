<?php

/**
 * Output something before your form(s).
 * 
 * @link  https://wpforms.com/developers/wpforms_frontend_output_before/
 *
 * @param array  $form_data Form data and settings.
 * @param object $form      Form post type object.
 */

function wpf_dev_display_submit_before($form_data) {
    if (!is_user_logged_in()) {

        $form_id = absint($form_data['id']);

        _e('<input
            type="hidden"
            name="wpforms[nonce]"
            value="' . esc_attr(wp_create_nonce("wpforms::form_{$form_id}")) . '"/>');
    }
}

add_action('wpforms_display_submit_before', 'wpf_dev_display_submit_before', 10, 1);

/**
 * Change the pre-loader icon
 *
 * @link https://wpforms.com/developers/how-to-change-the-pre-loader-icon-on-submit/
 *
 */

function custom_wpforms_display_submit_spinner_src($src, $form_data) {
    // Enter the URL to the loading image in between the single quotes
    return get_template_directory_uri() . '/images/spinner.svg';
}

add_filter('wpforms_display_submit_spinner_src', 'custom_wpforms_display_submit_spinner_src', 10, 2);

/**
 * Add nonce code field validation.
 *
 * @link   https://wpforms.com/developers/how-to-add-coupon-code-field-validation-on-your-forms/
 */

function wpf_dev_validate_nonce($fields, $entry, $form_data) {
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

function wpf_dev_char_restrict() {
    ?>

    <script type="text/javascript">
        jQuery(function ($) {
            $('.wpf-char-restrict').on('keypress', function (e) {

                var regex = new RegExp('^[a-zA-Z ]+$');
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

                if (!regex.test(key)) {

                    //$("div.wpf-char-restrict").html( "Please enter valid name" ).css("label.wpforms-error");

                    $("div.wpf-char-restrict label.wpforms-error").html("Please enter valid name");

                    e.preventDefault();
                    return false;
                }
            });

            $('.wpf-char-restrict-company').on('keypress', function (e) {

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
            $('.wpf-char-restrict').bind('copy paste', function (e) {

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

function wpf_dev_frontend_output_success($form_data, $fields, $entry_id) {

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

/**
 * Change the sublabels for the Address field for the "US Address Scheme" for "Request a Quote (Expedite) - Standard" and "Request a Quote (Brokerage) - Standard" forms
 *
 * @link https://wpforms.com/developers/how-to-change-the-address-field-sublabels/
 */
function rxo_wpf_dev_address_field_properties_usa( $properties, $field, $form_data ) {

    // check for address scheme
    if ( $field[ 'scheme' ] === 'us' ) {
        // Change sublabel values
        $properties[ 'inputs' ][ 'address1' ][ 'sublabel' ][ 'value' ] = __( 'Address 1' );
        $properties[ 'inputs' ][ 'address2' ][ 'sublabel' ][ 'value' ] = __( 'Address 2' );
        $properties[ 'inputs' ][ 'postal' ][ 'sublabel' ][ 'value' ] = __( 'ZIP / Postal Code' );
        return $properties;
    } else {
        return;
    }
}
add_filter( 'wpforms_field_properties_address', 'rxo_wpf_dev_address_field_properties_usa', 10, 3 );

/**
 * Add a custom (DD-MonthName-YY) formats for the Date field Date Picker.
 *
 * @link   https://wpforms.com/developers/how-to-create-additional-formats-for-the-date-field/
 */
function rxo_wpf_dev_date_field_formats( $formats ) {

    // Adds new format 24/Nov/23
    $formats[ 'd/M/y' ] = 'd/M/y';

    return $formats;
}
add_filter( 'wpforms_datetime_date_formats', 'rxo_wpf_dev_date_field_formats', 10, 1 );
