<?php

/**
 * Rxo Theme Customizer
 *
 * @package Rxo
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function rxo_customize_register($wp_customize)
{
    // Sections, settings and controls will be added here
    $wp_customize->add_section(
        'rxo_opitons',
        array(
            'title'       => __('RXO Settings', 'rxo'),
            'priority'    => 160,
            'capability'  => 'edit_theme_options',
            'description' => __('Change rxo site options.', 'rxo'),
        )
    );

    $wp_customize->add_setting(
        'site_moniker',
        array(
            'default'       => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'site_moniker',
        array(
            'type'          => 'text',
            'priority'      => 10,
            'section'       => 'rxo_opitons',
            'label'         => __('Site Moniker', 'rxo'),
            'description'   => __('Moniker will display next to the logo', 'rxo'),
        )
    );
}
add_action('customize_register', 'rxo_customize_register');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function rxo_customize_preview_js()
{
    wp_enqueue_script('rxo-customizer', get_template_directory_uri() . '/js/customizer.js', array('jquery', 'customize-preview'), filemtime(get_template_directory_uri() . '/js/customizer.js'), true);
}
add_action('customize_preview_init', 'rxo_customize_preview_js');
