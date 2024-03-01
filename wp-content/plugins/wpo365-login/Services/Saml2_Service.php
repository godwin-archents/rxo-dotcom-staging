<?php

namespace Wpo\Services;

use WP_Error;
use \Wpo\Core\Wpmu_Helpers;
use \Wpo\Services\Authentication_Service;
use \Wpo\Services\Error_Service;
use \Wpo\Services\Log_Service;

// Prevent public access to this script
defined('ABSPATH') or die();

if (!class_exists('\Wpo\Services\Saml2_Service')) {

    class Saml2_Service
    {

        /**
         * Iniates a SAML 2.0 request and redirects the user to the IdP.
         * 
         * @since 11.0
         * 
         * @return void
         */
        public static function initiate_request($redirect_to, $params = array())
        {
            Log_Service::write_log('DEBUG', '##### -> ' . __METHOD__);

            /**
             * @since   16.0    Filters the redirect_to url
             */

            $redirect_to = apply_filters('wpo365/cookie/remove/url', $redirect_to);
            $redirect_to = urlencode($redirect_to);

            require_once($GLOBALS['WPO_CONFIG']['plugin_dir'] . '/OneLogin/_toolkit_loader.php');

            $forceAuthn = Options_Service::get_global_boolean_var('saml_force_authn');
            $saml_settings = self::saml_settings();
            $auth = new \OneLogin_Saml2_Auth($saml_settings);
            $auth->login($redirect_to, $params, $forceAuthn);
        }

        /**
         * Gets an attribute / claim from the SAML 2.0 response.
         * 
         * @since   11.0
         * 
         * @param   $name               string  WPO365 User field name (looked up in the claim mappings setting)
         * @param   $saml_attributes    array   Attributes received as part of the SAML response
         * @param   $to_lower           boolean True if the attribute value returned should be converted to lower case
         * 
         * @return  string  Attribute's value as string               
         */
        public static function get_attribute($claim, $saml_attributes, $to_lower = false)
        {

            // TODO Get mappings from configuration
            $claim_mappings = array(
                'preferred_username' => 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name',
                'email' => 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress',
                'first_name' => 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname',
                'last_name' => 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname',
                'full_name' => 'http://schemas.microsoft.com/identity/claims/displayname',
                'tid' => 'http://schemas.microsoft.com/identity/claims/tenantid',
                'objectidentifier' => 'http://schemas.microsoft.com/identity/claims/objectidentifier',
            );

            if (isset($claim_mappings[$claim]) && isset($saml_attributes[$claim_mappings[$claim]]) && is_array($saml_attributes[$claim_mappings[$claim]]) && sizeof($saml_attributes[$claim_mappings[$claim]]) > 0) {
                return $to_lower
                    ? \strtolower(htmlentities($saml_attributes[$claim_mappings[$claim]][0]))
                    : htmlentities($saml_attributes[$claim_mappings[$claim]][0]);
            } elseif (isset($saml_attributes[$claim]) && is_array($saml_attributes[$claim]) && sizeof($saml_attributes[$claim]) > 0) {
                return htmlentities($saml_attributes[$claim][0]);
            }

            return '';
        }

        /**
         * Creates a OneLogin settings object with the settings configured through the WPO365 wizard.
         * 
         * @since   11.0
         * 
         * @return  mixed(array|boolean)   Array with OneLogin (non-advanced) settings or true / false when validating.
         */
        public static function saml_settings($validate = false)
        {
            $base_url = Options_Service::get_global_string_var('saml_base_url');
            $sp_entity_id = Options_Service::get_global_string_var('saml_sp_entity_id');
            $sp_sls_url = Options_Service::get_global_string_var('saml_sp_sls_url');
            $idp_entity_id = Options_Service::get_global_string_var('saml_idp_entity_id');
            $idp_ssos_url = Options_Service::get_global_string_var('saml_idp_ssos_url');
            $idp_sls_url = Options_Service::get_global_string_var('saml_idp_sls_url');
            $x509cert = Options_Service::get_aad_option('saml_x509_cert');
            $sp_acs_url = Options_Service::get_global_string_var('saml_sp_acs_url');

            /**
             * @since 24.0 Filters the AAD Redirect URI e.g. to set it dynamically to the current host.
             */
            $sp_acs_url = apply_filters('wpo365/aad/redirect_uri', $sp_acs_url);

            $log_level = $validate ? 'WARN' : 'ERROR';
            $has_errors = false;

            $exit_on_error = function () use ($validate) {

                if (!$validate) {
                    Authentication_Service::goodbye(Error_Service::SAML2_ERROR);
                    exit();
                }
            };

            if (empty($base_url)) {
                Log_Service::write_log($log_level, __METHOD__ . ' -> SAML 2.0 error (Base URL cannot be empty)');
                $exit_on_error();
                $has_errors = true;
            }

            if (empty($sp_entity_id)) {
                Log_Service::write_log($log_level, __METHOD__ . ' -> SAML 2.0 error (Service Provider Entity ID cannot be empty)');
                $exit_on_error();
                $has_errors = true;
            }

            if (empty($sp_acs_url)) {
                Log_Service::write_log($log_level, __METHOD__ . ' -> SAML 2.0 error (Service Provider Assertion Consumer Service URL cannot be empty)');
                $exit_on_error();
                $has_errors = true;
            }

            if (empty($sp_sls_url)) {
                Log_Service::write_log($log_level, __METHOD__ . ' -> SAML 2.0 error (Service Provider Single Logout Service URL cannot be empty)');
                $exit_on_error();
                $has_errors = true;
            }

            if (empty($idp_entity_id)) {
                Log_Service::write_log($log_level, __METHOD__ . ' -> SAML 2.0 error (Identity Provider Entity ID cannot be empty)');
                $exit_on_error();
                $has_errors = true;
            }

            if (empty($idp_ssos_url)) {
                Log_Service::write_log($log_level, __METHOD__ . ' -> SAML 2.0 error (Identity Provider Single Sign-on Service URL cannot be empty)');
                $exit_on_error();
                $has_errors = true;
            }

            if (empty($idp_sls_url)) {
                Log_Service::write_log($log_level, __METHOD__ . ' -> SAML 2.0 error (Identity Provider Single Logout Service URL cannot be empty)');
                $exit_on_error();
                $has_errors = true;
            }

            if (empty($x509cert)) {
                Log_Service::write_log($log_level, __METHOD__ . ' -> SAML 2.0 error (X509 Certificate cannot be empty)');
                $exit_on_error();
                $has_errors = true;
            }

            if (true === $validate) {
                return !$has_errors;
            }

            $settings = array(
                'strict' => true,
                'debug' => false,
                'baseurl' => $base_url,
                'sp' => array(
                    'entityId' => $sp_entity_id,
                    'assertionConsumerService' => array(
                        'url' => $sp_acs_url,
                        'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                    ),
                    'singleLogoutService' => array(
                        'url' => $sp_sls_url,
                        'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                    ),
                    'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',
                    'x509cert' => '',
                    'privateKey' => '',
                ),
                'idp' => array(
                    'entityId' => $idp_entity_id,
                    'singleSignOnService' => array(
                        'url' => $idp_ssos_url,
                        'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                    ),
                    'singleLogoutService' => array(
                        'url' => $idp_sls_url,
                        'responseUrl' => '',
                        'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                    ),
                    'x509cert' => $x509cert,
                ),
            );

            /**
             * @since 25.0 By default we disable the requested authentication context.
             */
            if (!Options_Service::get_global_boolean_var('saml_enable_requested_authn_context')) {
                $settings['security'] = array(
                    'requestedAuthnContext' => false
                );
            }

            /**
             * @since 11.14
             * 
             * Example:
             * 
             * define( 'WPO_SAML2_ADVANCED_SETTINGS', 
             *  array( 
             *    'security' => array(
             *      'requestedAuthnContext' => array (
             *        'urn:federation:authentication:windows'
             *      )
             *    ) 
             *  )
             * );
             */

            if (defined('WPO_SAML2_ADVANCED_SETTINGS') && is_array(constant('WPO_SAML2_ADVANCED_SETTINGS'))) {
                return array_merge($settings, constant('WPO_SAML2_ADVANCED_SETTINGS'));
            }

            return $settings;
        }

        public static function check_message_id($message_id)
        {
            $cache = Wpmu_Helpers::mu_get_transient('wpo365_saml_message_ids');

            if (empty($cache) || !\is_array($cache)) {
                $cache = array(
                    'last_write_index' => 0,
                    'slots' => array(
                        0 => array($message_id),
                        1 => array(),
                        2 => array(),
                        3 => array(),
                        4 => array(),
                        5 => array(),
                    ),
                );
                return;
            }

            $minutes = intval(date('i'));
            $mod = $minutes % 10;
            $write_slot = $minutes - $mod / 10;

            foreach ($cache['slots'] as $slot) {
                $index = array_search($message_id, $slot);

                if (false !== $index) {
                    Log_Service::write_log('ERROR', __METHOD__ . ' -> SAML 2.0 error (replay attack detected: SAML message ID already used)');
                    Authentication_Service::goodbye(Error_Service::TAMPERED_WITH);
                    exit();
                }
            }

            $cache['slots'][$write_slot][] = $message_id;
            $cache['slots'][(($write_slot + 1) % 6)] = array();

            Wpmu_Helpers::mu_set_transient('wpo365_saml_message_ids', $cache);
        }

        /**
         * Attempts to read the IdP metadata from the App Federation Metadata URL entered by the administrator and 
         * configure WPO365 accordingly.
         * 
         * @since 25.0
         * 
         * @return bool|WP_Error Returns true if the import was successful otherwise an error.
         */
        public static function import_idp_meta()
        {

            if (empty($saml_idp_meta_data_url = Options_Service::get_global_string_var('saml_idp_meta_data_url'))) {
                return new WP_Error('ConfigurationException', sprintf('%s -> The App Federation Metadata URL is not configured', __METHOD__));
            }

            $response = wp_remote_get(
                $saml_idp_meta_data_url,
                array(
                    'method' => 'GET',
                    'timeout' => 15,
                    'headers' => array(
                        'Expect' => ''
                    ),
                    'sslverify' => !Options_Service::get_global_boolean_var('skip_host_verification'),
                )
            );

            if (is_wp_error($response)) {
                return $response;
            }

            $idp_meta = wp_remote_retrieve_body($response);

            if (empty($idp_meta)) {
                return new WP_Error('BodyParseError', sprintf('%s -> No body was detected in the response retrieved from %s', __METHOD__, $saml_idp_meta_data_url));
            }

            $idp_meta_xml = simplexml_load_string($idp_meta);

            if (false === $idp_meta_xml) {
                return new WP_Error('XmlParseError', sprintf('%s -> Body retrieved from %s cannot be loaded as an XML document', __METHOD__, $saml_idp_meta_data_url));
            }

            $imported_idp_values = array(
                'saml_idp_entity_id' => $idp_meta_xml->attributes()->entityID->__toString(),
                'saml_x509_cert' => $idp_meta_xml->IDPSSODescriptor->KeyDescriptor->KeyInfo->X509Data->X509Certificate->__toString(),
                'saml_idp_ssos_url' => $idp_meta_xml->IDPSSODescriptor->SingleSignOnService->attributes()->Location->__toString(),
                'saml_idp_sls_url' => $idp_meta_xml->IDPSSODescriptor->SingleLogoutService->attributes()->Location->__toString(),
            );

            foreach ($imported_idp_values as $option_key => $value) {

                if (!empty($value)) {

                    if (strcasecmp($option_key, 'saml_x509_cert') === 0) {
                        $value = Saml2_Service::format_x509_certificate($value);
                    }

                    if (strcasecmp($option_key, 'saml_idp_entity_id') === 0) {
                        $tenant_id = Saml2_Service::get_tenant_id_from_entity_id($value);

                        if (!empty($tenant_id)) {
                            Options_Service::add_update_option('tenant_id', $tenant_id);
                            Log_Service::write_log('DEBUG', sprintf('%s -> Derived tenant ID with value "%s" from SAML IdP Entity ID "%s"', __METHOD__, $tenant_id, $value));
                        }
                    }

                    Options_Service::add_update_option($option_key, $value);
                    Log_Service::write_log('DEBUG', sprintf('%s -> Imported SAML option "%s" with value "%s" from %s', __METHOD__, $option_key, $value, $saml_idp_meta_data_url));
                } else {
                    Log_Service::write_log('ERROR', sprintf('%s -> Failed to import SAML option "%s" with value "%s" from %s', __METHOD__, $option_key, $value, $saml_idp_meta_data_url));
                }
            }

            return true;
        }


        /**
         * 
         * @return WP_Error|string 
         */
        public static function export_sp_meta()
        {
            $base_url = Options_Service::get_global_string_var('saml_base_url');

            if (empty($base_url)) {
                $base_url = get_option('home');

                if (empty($base_url)) {
                    return new WP_Error('ConfigurationException', sprintf('%s -> The SAML 2.0 Base URL is not configured', __METHOD__));
                }

                Options_Service::add_update_option('saml_base_url', $base_url);
            }

            $base_url = trailingslashit($base_url);

            if (empty($sp_entity_id = Options_Service::get_global_string_var('saml_sp_entity_id'))) {
                $sp_entity_id = sprintf('%s%s', $base_url, uniqid());
                Options_Service::add_update_option('saml_sp_entity_id', $sp_entity_id);
            }

            if (empty($sp_sls_url = Options_Service::get_global_string_var('saml_sp_sls_url'))) {
                $sp_sls_url = sprintf('%swp-login.php&action=loggedout', $base_url);
                Options_Service::add_update_option('saml_sp_sls_url', $sp_sls_url);
            }

            if (empty($sp_acs_url = Options_Service::get_global_string_var('saml_sp_acs_url'))) {
                $sp_acs_url = $base_url;
                Options_Service::add_update_option('saml_sp_acs_url', $sp_acs_url);
            }

            $sp_metadata_valid_until = date("Y-m-d\TH:i:s\Z", strtotime('+48 hours', time()));

            $xml_chunks = array(
                '<?xml version="1.0"?>',
                '<md:EntityDescriptor xmlns:md="urn:oasis:names:tc:SAML:2.0:metadata" validUntil="__##sp_metadata_valid_until##__" entityID="__##sp_entity_id##__">',
                '  <md:SPSSODescriptor AuthnRequestsSigned="true" WantAssertionsSigned="true" protocolSupportEnumeration="urn:oasis:names:tc:SAML:2.0:protocol">',
                '    <md:SingleLogoutService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect" Location="__##sp_sls_url##__" />',
                '    <md:AssertionConsumerService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST" Location="__##sp_acs_url##__" index="1" />',
                '  </md:SPSSODescriptor>',
                '</md:EntityDescriptor>',
            );

            $xml = implode(PHP_EOL, $xml_chunks);

            $xml = str_replace('__##sp_metadata_valid_until##__', $sp_metadata_valid_until, $xml);
            $xml = str_replace('__##sp_entity_id##__', $sp_entity_id, $xml);
            $xml = str_replace('__##sp_sls_url##__', $sp_sls_url, $xml);
            $xml = str_replace('__##sp_acs_url##__', $sp_acs_url, $xml);

            return $xml;
        }

        /**
         * Gets the tenant / directory ID from the SAML entity ID
         * 
         * @param mixed $entity_id 
         * @return string Tenant ID or empty string
         */
        private static function get_tenant_id_from_entity_id($entity_id)
        {
            if (empty($entity_id)) {
                return '';
            }

            $segments = explode('/', $entity_id);

            foreach ($segments as $segment) {

                if (!empty($segment) && strlen($segment) === 36) {
                    return $segment;
                }
            }

            return '';
        }

        /**
         * Rewrites the X509 string into the required format.
         * 
         * @since 25.0
         * 
         * @param mixed $certificate 
         * @return string 
         */
        private static function format_x509_certificate($certificate)
        {
            if (empty($certificate)) {
                return '';
            }

            $chunks = str_split($certificate, 64);
            array_unshift($chunks, '-----BEGIN CERTIFICATE-----');
            $chunks[] = '-----END CERTIFICATE-----' . PHP_EOL;

            return implode(PHP_EOL, $chunks);
        }
    }
}
