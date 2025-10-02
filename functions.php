<?php
function my_theme_support()
{
    // make title of the page dynamic
    add_theme_support('title-tag');
    // add support for featured image
    add_theme_support( 'post-thumbnails' );
    //menu support
    add_theme_support( 'menus' );

    // register the menu
    register_nav_menu('header-menu', 'Header Menu');
    register_nav_menu('footer-menu', 'Footer Menu');

    // add_theme_support( 'custom-logo' );
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
        // 'header-text' => array( 'site-title', 'site-description' ),
    ) );
    
}

// function to add the front assets
function add_front_theme_assets()
{
    wp_register_style('theme-front-style', get_template_directory_uri() . '/assets/css/style.css');
    wp_register_script('theme-front-script', get_template_directory_uri() . '/assets/script/script.js', [], false, array('in_footer' => true));
    wp_enqueue_style('theme-front-style');
    wp_enqueue_script('theme-front-script');
}

function my_theme_title($title)
{
    if (is_home()) {
        $title = get_bloginfo('name') . ' | ' . get_bloginfo('description');
    } elseif (is_single()) {
        $title = single_post_title('', false) . ' | ' . get_bloginfo('name');
    } elseif (is_page()) {
        $title = get_the_title() . ' | ' . get_bloginfo('name');
    } elseif (is_category()) {
        $title = single_cat_title('', false) . ' | ' . get_bloginfo('name');
    } elseif (is_tag()) {
        $title = single_tag_title('', false) . ' | ' . get_bloginfo('name');
    } elseif (is_author()) {
        $title = get_the_author() . ' | ' . get_bloginfo('name');
    } elseif (is_search()) {
        $title = 'Search results for "' . get_search_query() . '" | ' . get_bloginfo('name');
    } elseif (is_404()) {
        $title = '404 Not Found | ' . get_bloginfo('name');
    }
    return $title;
}

/**
 * Change the title separator
 */
function my_theme_title_separator(){
    return '|';
}

/**
 * Add class to the menu "li"
 */
function my_theme_menu_class($classes){
    $classes[] = 'nav-item';
    return $classes;
}
/**
 * Add class to the menu link "a"
 */
function my_theme_menu_link_class($attributes){
    $attributes['class'] = 'lh__nav-link btn-sm btn-primary text-center btn-border-primary';
    return $attributes;
}

// add the theme support
add_action('after_setup_theme', 'my_theme_support');
// enqueue the style
add_action('wp_enqueue_scripts', 'add_front_theme_assets');
// filter
// add_filter('wp-title', 'my_theme_title');
add_filter( 'document_title_separator', 'my_theme_title_separator' );
add_filter('nav_menu_css_class','my_theme_menu_class' );
add_filter('nav_menu_link_attributes','my_theme_menu_link_class' );