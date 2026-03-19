<?php

function my_customize_register(WP_Customize_Manager $wp_manager)
{
    /* Appearance options */
    $wp_manager->add_section('my_theme_appearance', [
        'title' => 'Personalize Appearance',
        'description' => 'Customize the appearance of your website',
    ]);

    $wp_manager->add_setting('header_color', [
        'default' => '#DFDFCA',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_manager->add_control(new WP_Customize_Color_Control($wp_manager, 'header_color_control', [
        'label' => 'Header Color',
        'section' => 'my_theme_appearance',
        'settings' => 'header_color',
    ]));
    // to display the color in the header, we will use get_theme_mod('header_color') in the header.php file

    /* Social links options settings */
    $wp_manager->add_section('my_theme_social_links', [
        'title' => 'Personalize Social Links',
        'description' => 'Customize the socials of your website',
    ]);

    $wp_manager->add_setting('facebook_icon', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ]);


    $wp_manager->add_control(new WP_Customize_Media_Control($wp_manager, 'facebook_icon_control', [
        'label' => __('Facebook Icon', 'theme_textdomain'),
        'section' => 'my_theme_social_links',
        'mime_type' => 'image',
        'settings' => 'facebook_icon',
    ]));


    $wp_manager->add_setting('facebook_url', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    ]);

    $wp_manager->add_control(new WP_Customize_Control($wp_manager, 'facebook_url_control', [
        'label' => __('Facebook URL', 'theme_textdomain'),
        'type' => 'url',
        'section' => 'my_theme_social_links',
        'settings' => 'facebook_url',
    ]));
    // to display the facebook icon and url in the footer, we will use get_theme_mod('facebook_icon') and get_theme_mod('facebook_url') in the footer.php file
}

add_action('customize_register', 'my_customize_register');
/* Enqueue the appearance script for live preview */
add_action('customize_preview_init', function() {
    wp_enqueue_script('my-theme-appearance-script', get_template_directory_uri() . '/assets/script/appearance.js', ['jquery', 'customize-preview'], null, true);
});
