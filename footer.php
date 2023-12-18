<footer class="bg-light">
    <div class="">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'secondary',
            'container_class' => 'footer-menu',
            'menu_class' => 'nav navbar-nav',
        ));
        ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
