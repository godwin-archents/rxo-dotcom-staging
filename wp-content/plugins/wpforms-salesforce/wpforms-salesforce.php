<?php
/**
 * Plugin Name:       WPForms Salesforce
 * Plugin URI:        https://wpforms.com
 * Description:       Salesforce integration with WPForms.
 * Author:            WPForms
 * Author URI:        https://wpforms.com
 * Version:           1.2.0
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Text Domain:       wpforms-salesforce
 * Domain Path:       languages
 *
 * WPForms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WPForms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPForms. If not, see <https://www.gnu.org/licenses/>.
 *
 * @since     1.0.0
 * @author    WPForms
 * @package   WPFormsSalesforce
 * @license   GPL-2.0+
 * @copyright Copyright (c) 2020, WPForms LLC
 */

use WPFormsSalesforce\Plugin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin constants.
 *
 * @since 1.0.0
 */
// phpcs:disable WPForms.Comments.PHPDocDefine.MissPHPDoc
define( 'WPFORMS_SALESFORCE_VERSION', '1.2.0' );
define( 'WPFORMS_SALESFORCE_FILE', __FILE__ );
define( 'WPFORMS_SALESFORCE_PATH', plugin_dir_path( WPFORMS_SALESFORCE_FILE ) );
define( 'WPFORMS_SALESFORCE_URL', plugin_dir_url( WPFORMS_SALESFORCE_FILE ) );
// phpcs:enable WPForms.Comments.PHPDocDefine.MissPHPDoc

/**
 * Check addon requirements.
 *
 * @since 1.0.0
 */
function wpforms_salesforce_required() {

	if ( PHP_VERSION_ID < 50600 ) {
		add_action( 'admin_init', 'wpforms_salesforce_deactivation' );
		add_action( 'admin_notices', 'wpforms_salesforce_fail_php_version' );

		return;
	}

	if ( ! function_exists( 'wpforms' ) ) {
		return;
	}

	if ( version_compare( wpforms()->version, '1.7.3', '<' ) ) {
		add_action( 'admin_init', 'wpforms_salesforce_deactivation' );
		add_action( 'admin_notices', 'wpforms_salesforce_fail_wpforms_version' );

		return;
	}

	if ( ! wpforms()->is_pro() ) {
		return;
	}

	wpforms_salesforce_plugin();
}
add_action( 'wpforms_loaded', 'wpforms_salesforce_required' );

/**
 * Deactivate the plugin.
 *
 * @since 1.0.0
 */
function wpforms_salesforce_deactivation() {

	deactivate_plugins( plugin_basename( __FILE__ ) );
}

/**
 * Admin notice for a minimum PHP version.
 *
 * @since 1.0.0
 */
function wpforms_salesforce_fail_php_version() {

	echo '<div class="notice notice-error"><p>';
	printf(
		wp_kses( /* translators: %s - WPForms.com documentation page URL. */
			__( 'The WPForms Salesforce plugin has been deactivated. Your site is running an outdated version of PHP that is no longer supported and is not compatible with the Salesforce plugin. <a href="%s" target="_blank" rel="noopener noreferrer">Read more</a> for additional information.', 'wpforms-salesforce' ),
			[
				'a' => [
					'href'   => [],
					'rel'    => [],
					'target' => [],
				],
			]
		),
		'https://wpforms.com/docs/supported-php-version/'
	);
	echo '</p></div>';

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
	// phpcs:enable WordPress.Security.NonceVerification.Recommended
}

/**
 * Admin notice for minimum WPForms version.
 *
 * @since 1.0.0
 */
function wpforms_salesforce_fail_wpforms_version() {

	echo '<div class="notice notice-error"><p>';
	esc_html_e( 'The WPForms Salesforce plugin has been deactivated, because it requires WPForms v1.7.3 or later to work.', 'wpforms-salesforce' );
	echo '</p></div>';

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
	// phpcs:enable WordPress.Security.NonceVerification.Recommended
}

/**
 * Get the instance of the `\WPFormsSalesforce\Plugin` class.
 * This function is useful for quickly grabbing data used throughout the plugin.
 *
 * @since 1.0.0
 *
 * @return Plugin
 */
function wpforms_salesforce_plugin() {

	// Actually, load the Salesforce addon now, as we met all the requirements.
	require_once __DIR__ . '/vendor/autoload.php';

	return Plugin::get_instance();
}
