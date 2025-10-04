<?php get_header() ?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post() ?>
        <section class="container-full has-padding">
            <h1><?= the_title() ?></h1>
            <!-- check if the sponsor field is checked-->
            <?php //if (get_post_meta(get_the_ID(), 'my_theme_sponsor_field', true) === '1'): ?>
                <!-- If using the class SponsoringMetaBox -->
            <?php if (get_post_meta(get_the_ID(), SponsoringMetaBox::META_KEY, true) === '1'): ?>
                <p><strong>This is a sponsored post</strong></p>
            <?php endif; ?>

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