<?php

/**
 * The template for displaying search forms in Classic Custom Theme
 */
?>


<form class="flex" action="<?= esc_url( home_url( '/' ) ); ?>" method="get">
    <input type="search" placeholder="Search" aria-label="Search" name="s" value="<?= get_search_query(); ?>" required>
    <button class="btn-sm btn-primary text-center btn-border-primary" type="submit">Search</button>
</form>