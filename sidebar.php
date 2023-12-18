<aside id="sidebar" class="widgets-area bg-light p-4">
    <div class="widget mb-4">
        <h3 class="h5">Android Categories</h3>
        <ul class="list-unstyled">
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'android_category',
                'hide_empty' => false,
            ));

            foreach ($terms as $term) {
                echo '<li><a href="' . get_term_link($term) . '" class="text-decoration-none text-dark">' . $term->name . '</a></li>';
            }
            ?>
        </ul>
    </div>

    <div class="widget mb-4">
        <h3 class="h5">Archives</h3>
        <ul class="list-unstyled">
            <?php
            $args = array(
                'type' => 'monthly',
                'post_type' => 'mobile',
            );

            echo wp_get_archives($args);
            ?>
        </ul>
    </div>

    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>

