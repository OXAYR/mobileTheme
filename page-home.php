<?php
get_header();
?>

<div class="container">
    <div class="row">

        <div class="col-xs-12 col-sm-8">

            <?php
            $currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'mobile', 
                'posts_per_page' => 2,
                'paged' => $currentPage
            );
            query_posts($args);

            if (have_posts()): ?>
				<h3>Featured Posts</h3>
                <div class="row">
                    <?php while (have_posts()): the_post(); ?>
                        <div class="col-md-6 mb-4">
                            <div class="card  h-50 w-50">
                                <?php if (has_post_thumbnail()): ?>
                                    <img src="<?php the_post_thumbnail_url('small'); ?>" class="card-img-top img-fluid" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>

                                <div class="card-body">
                                    <?php the_title(sprintf('<h5 class="card-title"><a href="%s" class="text-decoration-none">', esc_url(get_permalink())), '</a></h5>'); ?>
                                    <p class="card-text"><?php the_excerpt(); ?></p>
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
                        </div>
                    <?php endwhile; ?>
                </div>

                <?php
              
            else:
                echo '<h3>No posts found.</h3>';
            endif;
            ?>
        </div>

        <div class="col-xs-12 col-sm-4">
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>

<?php
get_footer();
?>
