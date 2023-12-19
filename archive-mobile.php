<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (have_posts()) :
                if (is_archive()) {
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    the_archive_description('<div class="taxonomy-description">', '</div>');
                } else {
                    echo '<h1 class="page-title">Mobiles</h1>';
                }
            endif;
            ?>
        </div>


        <div class="col-xs-12">
            <div class="row">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="product-item">
                            <div class="thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array('class' => 'img-responsive img-thumbnail')); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="caption">
                                <h3><a class="text-decoration-none text-info" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="price text-warning"><strong>Price:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_price', true)); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="col-xs-12 text-center ">
            <?php the_posts_navigation(); ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
