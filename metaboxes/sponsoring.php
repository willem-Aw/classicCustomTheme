<?php

class SponsoringMetaBox
{
    const META_KEY = 'my_theme_sponsor_field';

    public static function register()
    {
        // add custom meta box
        add_action('add_meta_boxes', [self::class, 'add_meta_box']);
        // on save post
        add_action('save_post', [self::class, 'save_meta_box']);
    }


    /**
     * Adds a meta box to the post editing screen
     * 
     * @param string $id         - Meta box ID (self::META_KEY)
     * @param string $title      - Title of the meta box
     * @param callable $callback - Function that fills the box with the desired content
     * @param string $screen    - The screen where to show the box (post, page, custom_post_type)
     * @param string $context   - The context within the screen where the box should display 
     *                           ('normal', 'side', 'advanced')
     */
    public static function add_meta_box()
    {
        add_meta_box(self::META_KEY, 'Sponsoring', [self::class, 'render_meta_box'], 'post', 'side');
    }

    public static function render_meta_box($post)
    {
        /**
         * the post here is a WP_Post object
         */
        $value = get_post_meta($post->ID, self::META_KEY, true);
?>
        <input type="hidden" value="0" name="<?php self::META_KEY ?>" />
        <input type="checkbox" value="1" name="<?php self::META_KEY ?>" id="sponsor_field" <?= ($value == '1' ? 'checked' : '') ?> />
        <label for="sponsor_field" class="components-checkbox-control__label">Is this a sponsored post ?</label>
<?php
    }

    public static function save_meta_box($post)
    {
        /**
         * the post here is the post ID
         */
        // check if the metadata exist && user can edit the post
        if (array_key_exists(self::META_KEY, $_POST) && current_user_can('edit_post', $post)) {
            if ($_POST[self::META_KEY] == '1') {
                update_post_meta($post, self::META_KEY, '1');
            } else {
                delete_post_meta($post, self::META_KEY);
            }
        }
    }
}
