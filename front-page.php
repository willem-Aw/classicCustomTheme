<?php get_header() ?>
<h1>This is the homepage</h1>
<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post() ?>
        <section class="container-full room-type">
            <div class="lh__room-type grid">
                <div class="lh__room-type-cards grid">
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
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php else: ?>
    <h2>No posts found</h2>
<?php endif; ?>
<?php get_footer() ?>