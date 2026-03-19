<?php

class YoutubeWidgets extends WP_Widget
{

    public function __construct()
    {
        return parent::__construct('youtube_widget', 'Youtube Widget');
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {

            $title = apply_filters('widget_title', $instance['title']); // Allow plugins/themes to modify the widget title
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $youtubeID = $instance['youtube'] ?? '';

        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . esc_attr($youtubeID) . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        // Set default value for title
        $title = $instance['title'] ?? '';
        $youtubeID = $instance['youtube'] ?? '';
?>
        <p>
            <label for="<?= $this->get_field_id('title') ?>">Title</label>
            <input
                type="text"
                name="<?= $this->get_field_name('title') ?>"
                value="<?= esc_attr($title) ?>"
                id="<?php $this->get_field_name('title') ?>"
                class="widefat">
        </p>

        <p>
            <label for="<?= $this->get_field_id('youtube') ?>">Youtube ID</label>
            <input
                type="text"
                name="<?= $this->get_field_name('youtube') ?>"
                value="<?= esc_attr($youtubeID) ?>"
                id="<?php $this->get_field_name('youtube') ?>"
                class="widefat">
        </p>
<?php
    }

    public function update($new_instance, $old_instance)
    {

        return $new_instance;
    }
}
