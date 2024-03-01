/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
    // Site moniker.
    wp.customize('site_moniker', function (value) {
        value.bind(function (newValue) {
            $('.site-moniker').text(newValue);
        });
    });
}(jQuery));
