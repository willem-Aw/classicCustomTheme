<?php
function my_theme_support()
{
    add_theme_support('title-tag');
}

// function to add the front assets
function add_front_theme_assets()
{
    wp_register_style('theme-front-style', get_template_directory_uri() . '/assets/css/style.css');
    wp_register_script('theme-front-script', get_template_directory_uri() . '/assets/script/script.js', [], false, array('in_footer' => true));
    wp_enqueue_style('theme-front-style');
    wp_enqueue_script('theme-front-script');
}

add_action('after_setup_theme', 'my_theme_support');
// enqueue the style
add_action('wp_enqueue_scripts', 'add_front_theme_assets');
