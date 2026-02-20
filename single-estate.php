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

        <section class="container-full prd-listing has-padding">
            <h2>Related posts</h2>
            <div class="lh__listing-product room-type">
                <ul class="grid prd-listing lh__room-type-cards grid">
                    <?php
                    $terms = array_map(function ($term) {
                        return $term->term_id;
                    }, get_the_terms(get_the_ID(), 'room') ?: []);
                    $query = new WP_Query([
                        'post_not_in' => [get_the_ID()],
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'orderby' => 'rand',
                        'tax_query' => [
                            [
                                'taxonomy' => 'room',
                                'terms' => $terms,
                            ],
                        ],
                        /* 'meta_query' => [
                            [
                                'key' => SponsoringMetaBox::META_KEY,
                                'compare' => 'NOT EXISTS', // Only get posts that are not sponsored
                            ],
                        ], */
                    ]);
                    while ($query->have_posts()): $query->the_post();
                    ?>
                        <li class="item lh__room-type-card">
                            <?php get_template_part('parts/post-card'); ?>
                        </li>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </ul>
                <div class="flex-center pagination-wrapper">
                    <?= paginate_links(); ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php else: ?>
    <h2>No posts found</h2>
<?php endif; ?>

<?php get_footer() ?>