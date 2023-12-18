
<div class="col-xs-12 col-sm-6 col-md-4 w-25 h-25">
    <article id="post-<?php the_ID(); ?>" <?php post_class('product-item mb-4'); ?>>
        <div class="card h-100">
            <?php if (has_post_thumbnail()) : ?>
                <a class="" href="<?php echo esc_url(get_permalink()); ?>">
                    <?php the_post_thumbnail('thumbnail', array('class' => 'card-img-top img-fluid')); ?>
                </a>
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title">
                    <a class="text-secondary text-decoration-none" href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
                </h5>
                <div class="product-details">
                    <?php
                    $price = get_post_meta(get_the_ID(), '_price', true);
                    if (!empty($price)) {
                        echo '<p class="card-text">Price: ' . esc_html($price) . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </article>
</div>