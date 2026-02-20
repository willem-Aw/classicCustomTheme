<?php
function my_theme_support()
{
    // make title of the page dynamic
    add_theme_support('title-tag');
    // add support for featured image
    add_theme_support('post-thumbnails');
    //menu support
    add_theme_support('menus');

    // register the menu
    register_nav_menu('header-menu', 'Header Menu');
    register_nav_menu('footer-menu', 'Footer Menu');

    // add_theme_support( 'custom-logo' );
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
        // 'header-text' => array( 'site-title', 'site-description' ),
    ));
    // add custom image size
    add_image_size('card-thumb', 400, 280, true); // Hard crop mode
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
function my_theme_title_separator()
{
    return '|';
}

/**
 * Add class to the menu "li"
 */
function my_theme_menu_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}
/**
 * Add class to the menu link "a"
 */
function my_theme_menu_link_class($attributes)
{
    $attributes['class'] = 'lh__nav-link btn-sm btn-primary text-center btn-border-primary';
    return $attributes;
}

// function my_theme_save_sponsor($post_id)
// {
//     // check if the metadata exist && user can edit the post
//     if (array_key_exists('my_theme_sponsor_field', $_POST) && current_user_can('edit_post', $post_id)) {
//         if ($_POST['my_theme_sponsor_field'] == '1') {
//             update_post_meta($post_id, 'my_theme_sponsor_field', '1');
//         } else {
//             delete_post_meta($post_id, 'my_theme_sponsor_field');
//         }
//     }
// }


function my_theme_init()
{
    /**
     * Register a custom taxonomy "room" for posts
     *
     * Purpose:
     * - Groups posts into "Rooms" (works like categories).
     * - Hierarchical = true makes it behave like categories (parent/child).
     * - show_in_rest = true exposes the taxonomy to the block editor / REST API.
     * - show_admin_column = true adds the taxonomy column to the post list in admin.
     *
     * Notes for the recipient:
     * - Change the second argument ('post') to a custom post type slug if you want rooms
     *   to apply to a CPT instead of regular posts.
     * - Edit the labels array to localize or change visible text in the admin UI.
     * - If you add or change rewrite rules, flush permalinks (Settings → Permalinks or
     *   run `wp rewrite flush`) after deployment.
     */
    register_taxonomy(
        'room',
        ['post', 'estate'], // Apply to both posts and estates
        [
            'labels' => [
                'name' => 'Rooms',
                'singular_name' => 'Room',
                'menu_name' => 'Rooms',
                'all_items' => 'All Rooms',
                'edit_item' => 'Edit Room',
                'view_item' => 'View Room',
                'update_item' => 'Update Room',
                'add_new_item' => 'Add New Room',
                'new_item_name' => 'New Room Name',
                'search_items' => 'Search Rooms',
            ],
            'show_in_rest' => true,
            'hierarchical' => true,
            'show_admin_column' => true,
        ]
    );

    /**
     * Register a custom post type "estate" for real estate properties
     *
     * Purpose:
     * - Creates a new content type "Estates" separate from regular posts
     * - Appears in admin menu with building icon
     * - Supports featured images, titles, and content editor
     * - Uses Gutenberg/block editor
     * - Has its own archive page
     *
     * Parameters explained:
     * - 'public' => true: Makes the post type visible in admin and frontend
     * - 'menu_position' => 4: Places menu item after "Posts" in admin
     * - 'menu_icon': Uses WordPress dashicon for visual recognition
     * - 'supports': Enables specific editing features
     * - 'show_in_rest': Enables Gutenberg editor
     * - 'has_archive': Enables listing page at /estate/
     *
     * Notes for the recipient:
     * - Add 'rewrite' => ['slug' => 'properties'] to customize URL structure
     * - Add more 'supports' values for additional features like 'excerpt', 'custom-fields'
     * - After changing 'rewrite' rules, flush permalinks in WP admin
     * - To add custom fields, use Advanced Custom Fields plugin or register meta boxes
     */
    register_post_type('estate', [
        'label' => 'Estates',
        'public' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'thumbnail', 'editor', 'excerpt'],
        'hierarchical' => true,
        // acitivate bloc editor
        'show_in_rest' => true,
        'has_archive' => true,
    ]);
}

add_action('init', 'my_theme_init');
// add the theme support
add_action('after_setup_theme', 'my_theme_support');
// enqueue the style
add_action('wp_enqueue_scripts', 'add_front_theme_assets');
// add filter
// add_filter('wp-title', 'my_theme_title');
add_filter('document_title_separator', 'my_theme_title_separator');
add_filter('nav_menu_css_class', 'my_theme_menu_class');
add_filter('nav_menu_link_attributes', 'my_theme_menu_link_class');
/**
 * Uncomment the code below to add a custom meta box without using a class
 */
// add custom meta box
// add_action('add_meta_boxes', 'my_theme_custom_meta_box');
// on save post
// add_action('save_post', 'my_theme_save_sponsor');

/**
 * Using a class to create a custom meta box
 */
// Register the SponsoringMetaBox
require_once get_template_directory() . '/metaboxes/sponsoring.php';
require_once get_template_directory() . '/options/agency.php';

SponsoringMetaBox::register();
AgencyMenuPage::register();

/**
 * Add custom columns to the Estates admin list view
 * 
 * This adds two custom columns to the estate post type in WordPress admin:
 * 1. 'thumbnail' - Displays the post's featured image thumbnail
 * 2. 'sponsored' - Shows whether the estate is sponsored (Yes/No) based on 'my_theme_sponsor_field' meta
 */
add_filter('manage_estate_posts_columns', function ($columns) {
    return [
        'cb' => $columns['cb'], // Keep the checkbox column
        'thumbnail' => 'Thumbnail', // Add a thumbnail column
        'title' => $columns['title'], // Keep the title column
        'sponsored' => 'Sponsored', // Add a sponsored column
        'date' => $columns['date'], // Keep the date column
    ];
});

/**
 * Render the custom column content for Estates admin list
 * 
 * Callback function that outputs content for the custom columns:
 * - 'thumbnail': Outputs the post thumbnail or 'No image' placeholder
 * - 'sponsored': Outputs 'Yes' or 'No' based on 'my_theme_sponsor_field' meta value
 * 
 * @param string $column_name The name of the column being rendered
 * @param int    $post_id     The ID of the current post
 */
add_filter('manage_estate_posts_custom_column', function ($column_name, $post_id) {
    /* var_dump(func_get_args()); //display the arguments passed to the function for debugging
    die(); */
    if ($column_name === 'thumbnail') {
        $thumbnail = get_the_post_thumbnail($post_id, 'thumbnail');
        echo $thumbnail ? $thumbnail : 'No image';
    } elseif ($column_name === 'sponsored') {
        $is_sponsored = get_post_meta($post_id, 'my_theme_sponsor_field', true);
        echo $is_sponsored ? 'Yes' : 'No';
    }
}, 10, 2);


/* add_filter('manage_posts_columns', function ($columns) {
    return [
        'cb' => $columns['cb'], 
        'title' => $columns['title'],
        'sponsored' => 'Sponsored', 
        'author' => $columns['author'], 
        'categories' => $columns['categories'], 
        'tags' => $columns['tags'], 
        'taxonomy-room' => $columns['taxonomy-room'], 
        'comments' => $columns['comments'], 
        'date' => $columns['date'], 
    ];
}); */

/* add_filter('manage_posts_custom_column', function ($column_name, $post_id) {
    if ($column_name === 'sponsored') {
        $is_sponsored = get_post_meta($post_id, 'my_theme_sponsor_field', true);
        echo $is_sponsored ? 'Yes' : 'No';
    }
}); */

/**
 * Add 'Sponsored' column to the Posts admin list view
 * 
 * Inserts a 'Sponsored' column right after the 'categories' column in the
 * WordPress posts admin list. This allows admins to see which posts are
 * sponsored directly from the posts list table.
 * 
 * @param array $columns Existing columns array
 * @return array Modified columns array with 'sponsored' column added
 */
add_filter('manage_post_posts_columns', function ($columns) {
    $new_columns = [];
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'categories') {
            $new_columns['sponsored'] = 'Sponsored';
        }
    }
    return $new_columns;
});


/**
 * Render the 'Sponsored' column content in Posts admin list
 * 
 * Outputs 'Yes' or 'No' for each post based on whether the post has the
 * sponsorship meta field set. Uses SponsoringMetaBox::META_KEY to retrieve
 * the meta value.
 * 
 * @param string $column_name The column name being rendered
 * @param int    $post_id     The ID of the current post
 */
add_filter('manage_post_posts_custom_column', function ($column_name, $post_id) {
    if ($column_name === 'sponsored') {
        $is_sponsored = get_post_meta($post_id, SponsoringMetaBox::META_KEY, true);
        echo $is_sponsored ? 'Yes' : 'No';
    }
}, 10, 2);

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/css/admin.css');
});