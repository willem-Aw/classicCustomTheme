<?php get_header() ?>

<?php if (have_posts()): ?>
    <section class="container-full prd-listing has-padding">
        <div class="lh__listing-product room-type">
            <ul class="grid prd-listing lh__room-type-cards grid">

                <?php while (have_posts()): the_post() ?>

                    <li class="item lh__room-type-card">
                        <div class="lh__room-type-card">
                            <figure>
                                <a href="#">
                                    <img src="<?php the_post_thumbnail('medium'); ?>" alt="Room Type Image">
                                </a>
                            </figure>
                            <div class="lh__room-type-card-content flex-column-between">
                                <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                                <p class="lh_excerpt"><?= get_the_excerpt(); ?></p>
                                <p>
                                    <span>4 people</span>
                                    <span>4 m<sup>2</sup></span>
                                </p>
                                <p>
                                    <strong>
                                        400$
                                    </strong>
                                </p>
                                <a href="<?php the_permalink() ?>" class="btn-sm btn btn-primary btn-border-primary text-center">See More</a>
                            </div>
                        </div>
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