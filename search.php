<?php get_header() ?>

<?php if (have_posts()): ?>
    <section class="container-full prd-listing has-padding">

        <div class="form-wrapper">
            <form class="flex">
                <div class="lh__sponsoring-filter flex">
                    <input type="checkbox" name="my_theme_sponsor_field" id="sponsored" value="1" <?= (isset($_GET['my_theme_sponsor_field']) && $_GET['my_theme_sponsor_field'] == '1') ? 'checked' : '' ?> />
                    <label for="sponsored">Sponsored posts only</label>
                </div>
                <input type="search" placeholder="Search" aria-label="Search" name="s" value="<?= get_search_query() ?>" class="input-search" />
                <button class="btn-sm btn-primary text-center btn-border-primary" type="submit">Search</button>
            </form>
        </div>

        <h1 class="mb-regular">Your search result for "<?= get_search_query() ?>"</h1>

        <div class="lh__listing-product room-type">
            <ul class="grid prd-listing lh__room-type-cards grid">

                <?php while (have_posts()): the_post() ?>

                    <li class="item lh__room-type-card">
                        <?php get_template_part('parts/post-card'); ?>
                    </li>


                <?php endwhile; ?>

            </ul>
            <div class="flex-center pagination-wrapper">
                <?= paginate_links(); ?>
            </div>
        </div>
    </section>
<?php else: ?>
    <h2>No posts found</h2>
<?php endif; ?>

<?php get_footer() ?>