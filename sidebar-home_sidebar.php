<?php if (!dynamic_sidebar('home_sidebar')) : ?>

    <div class="home-sidebar-widget">
        <h3 class="home-sidebar-title">Search</h3>
        <?php get_search_form(); ?>
        <h3 class="home-sidebar-title">Archives</h3>
        <ol>
            <?php wp_get_archives(['type' => 'monthly']); ?>
        </ol>
    </div>
<?php endif; ?>