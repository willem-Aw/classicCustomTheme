<footer class="container-full footer">
    <div class="lh__footer flex-column-center">
        <div class="lh__footer-logo">
            <a href="#">
                <img src="./assets/imgs/Logo.svg" alt="Larana Logo">
            </a>
        </div>
        <p>
            Copyright &copy; <span class="current-year">2025</span>
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
    </div>
</footer>
<?php wp_footer() ?>
</body>

</html>