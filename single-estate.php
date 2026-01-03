<?php get_header() ?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post() ?>
        <section class="container-full has-padding">
            <h1><?= the_title() ?></h1>
            <figure>
                <?= the_post_thumbnail('large'); ?>
            </figure>
            <div>
                <?= the_content() ?>
            </div>
        </section>
    <?php endwhile; ?>
<?php else: ?>
    <h2>No posts found</h2>
<?php endif; ?>

<?php get_footer() ?>