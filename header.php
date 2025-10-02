<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body>
    <header class="container-full header">
        <div class="lh__navbar container flex-space-between">
            <!-- <div class="lh__logo">
                <a href="#" class="lh__logo-link">
                    <img src="./assets/imgs/Logo.svg" alt="Larana Hotel Logo">
                </a>
            </div> -->
            <div class="lh__logo">
                <?php if (function_exists('the_custom_logo') && has_custom_logo()) {
                    the_custom_logo();
                } else { ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="lh__logo-link">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/imgs/Logo.png'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?> Logo">
                    </a>
                <?php } ?>
            </div>

            <nav class="lh__navbar-menu">
                <?php wp_nav_menu([
                    'theme_location' => 'header-menu',
                    'container' => false,
                    'menu_class' => 'lh__nav-links flex-end'
                ]); ?>
                <!-- <ul class="lh__nav-links flex-end">
                    <li>
                        <a href="./rent.html"
                            class="lh__nav-link btn-sm btn-primary text-center btn-border-primary">Rent</a>
                    </li>
                    <li>
                        <a href="./buy.html" class="lh__nav-link btn-sm btn-primary text-center btn-border-primary">Buy</a>
                    </li>
                    <li>
                        <a href="#" class="lh__nav-link btn-sm btn-primary text-center btn-border-primary">Headline</a>
                    </li>
                    <li>
                        <a href="#" class="lh__nav-link btn-sm btn-primary text-center btn-border-primary">Contact
                            Us</a>
                    </li>
                </ul> -->
            </nav>
            <form class="flex">
                <input type="search" placeholder="Search" aria-label="Search">
                <button class="btn-sm btn-primary text-center btn-border-primary" type="submit">Search</button>
            </form>
        </div>
    </header>