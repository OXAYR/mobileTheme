<footer class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-2">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'secondary',
                    'container_class' => 'footer-menu',
                    'menu_class' => 'nav navbar-nav',
                ));
                ?>
            </div>

            <div class="col-md-6">
                <?php echo do_shortcode("[footer_form]"); ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
