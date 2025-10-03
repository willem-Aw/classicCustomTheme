<?php

/**
 * The front page template file --> "Homepage"
 *
 */
?>


<?php get_header() ?>
<!-- <h1>This is the homepage</h1>
<?php //if (have_posts()): 
?>
    <?php //while (have_posts()): the_post() 
    ?>
        <section class="container-full room-type">
            <div class="lh__room-type grid">
                <div class="lh__room-type-cards grid">
                    <div class="lh__room-type-card">
                        <figure>
                            <a href="#">
                                <img src="<?php //the_post_thumbnail('medium'); 
                                            ?>" alt="Room Type Image">
                            </a>
                        </figure>
                        <div class="lh__room-type-card-content flex-column-between">
                            <h3><a href="<?php //the_permalink() 
                                            ?>"><?php //the_title() 
                                                ?></a></h3>
                            <p class="lh_excerpt"><?php //echo get_the_excerpt(); 
                                                    ?></p>
                            <p>
                                <span>4 people</span>
                                <span>4 m<sup>2</sup></span>
                            </p>
                            <p>
                                <strong>
                                    400$
                                </strong>
                            </p>
                            <a href="<?php //the_permalink() 
                                        ?>" class="btn-sm btn btn-primary btn-border-primary text-center">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php //endwhile; 
    ?>
<?php //else: 
?>
    <h2>No posts found</h2>
<?php //endif; 
?> -->

<?php
// Query only posts (replacing the default loop)
$posts_query = new WP_Query([
    'post_type'      => 'post',
    // 'posts_per_page' => 10,
]); ?>

<?php if ($posts_query->have_posts()): ?>
    <section class="container-full room-type">
        <div class="lh__room-type grid">
            <div class="lh__room-type-cards grid">

                <?php while ($posts_query->have_posts()): $posts_query->the_post(); ?>

                    <div class="lh__room-type-card">
                        <figure>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php the_title_attribute(); ?>">
                            </a>
                        </figure>
                        <div class="lh__room-type-card-content flex-column-between">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="lh_excerpt"><?php echo get_the_excerpt(); ?></p>
                            <p>
                                <span>4 people</span>
                                <span>4 m<sup>2</sup></span>
                            </p>
                            <p>
                                <strong>400$</strong>
                            </p>
                            <a href="<?php the_permalink(); ?>" class="btn-sm btn btn-primary btn-border-primary text-center">See More</a>
                        </div>
                    </div>

                <?php endwhile; ?>

            </div>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php else: ?>
    <h2>No posts found</h2>
<?php endif; ?>
<?php get_footer() ?>