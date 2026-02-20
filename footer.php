<footer class="container-full footer">
    <div class="lh__footer flex-column-center">
        <div class="lh__footer-logo">
            <!-- <a href="#">
                <img src="./assets/imgs/Logo.svg" alt="Larana Logo">
            </a> -->
            <?php if (function_exists('the_custom_logo') && has_custom_logo()) {
                the_custom_logo();
            } else { ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="lh__logo-link">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/imgs/Logo.png'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?> Logo">
                </a>
            <?php } ?>
        </div>
        <p>
            Copyright &copy; <span class="current-year"><?= date("Y") ?></span>
        </p>
        <nav class="lh__footer-navbar">
            <!-- <ul class="lh__footer-nav-links flex-center">
                <li>
                    <a href="#" class="lh__nav-link">Rent</a>
                </li>
                <li>
                    <a href="#" class="lh__nav-link">Buy</a>
                </li>
                <li>
                    <a href="#" class="lh__nav-link">Headline</a>
                </li>
                <li>
                    <a href="#" class="lh__nav-link">Contact
                        Us</a>
                </li>
            </ul> -->
            <?php wp_nav_menu([
                'theme_location' => 'footer-menu',
                'container' => false,
                'menu_class' => 'lh__footer-nav-links flex-center'
            ]); ?>
        </nav>
        <div class="lh__footer-hour">
            <?php $agency_hour = get_option('agency_hour', ''); ?>
            <?php if ($agency_hour) : ?>
                <p>Working hours: <br/> <?php echo esc_html($agency_hour); ?></p>
            <?php endif; ?>
        </div>
    </div>
</footer>
<?php wp_footer() ?>
</body>

</html>