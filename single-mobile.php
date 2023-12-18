<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="product-navigation">
                        <div class="d-flex justify-content-between">
                            <div class="col-xs-6 text-left"><?php previous_post_link(); ?></div>
                            <div class="col-xs-6 text-right"><?php next_post_link(); ?></div>
                        </div>
                    </div>
                    <div class="text-center">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="thumbnail-container">
                                <?php the_post_thumbnail('medium', array('class' => 'img-responsive center-block')); ?>
                            </div>
                            <div class="text-xl-center text-warning">Price: <?php echo st_meta(get_the_ID(), '_price', true)); ?> </div>
                        <?php endif; ?>
                    </div>
                    <div class="product-details">
                        <h3>Specification</h3>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
									<td>RAM</td>
									<td><?php echo esc_html(get_post_meta(get_the_ID(), '_ram', true)); ?></td>
								</tr>
								<tr>
									<td>Front Camera</td>
									<td><?php echo esc_html(get_post_meta(get_the_ID(), '_front_camera', true)); ?></td>
								</tr>
								<tr>
									<td>Back Camera</td>
									<td><?php echo esc_html(get_post_meta(get_the_ID(), '_back_camera', true)); ?></td>
								</tr>
								<tr>
									<td>Screen Resolution</td>
									<td><?php echo esc_html(get_post_meta(get_the_ID(), '_screen_resolution', true)); ?></td>
								</tr>
								<tr>
									<td>ROM</td>
									<td><?php echo esc_html(get_post_meta(get_the_ID(), '_rom', true)); ?></td>
								</tr>
								<tr>
									<td>Price</td>
									<td class="price"><?php echo esc_html(get_post_meta(get_the_ID(), '_price', true)); ?></td>
								</tr>
                            </tbody>
                        </table>
                        <?php if (current_user_can('manage_options')) : ?>
                            <div class="edit-link"><?php edit_post_link('Edit Product', '<p>', '</p>'); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="product-description">
                        <?php if (the_content()) : ?>
                            <h3>Description</h3>
                            <?php the_content(); ?>
                        <?php endif; ?>
                    </div>
                </article>

                
                <?php
                $terms = get_the_terms(get_the_ID(), 'android_category');

                if (!empty($terms)) {
                    $term_ids = array();
                    foreach ($terms as $term) {
                        $term_ids[] = $term->term_id;
                    }

                    $related_args = array(
                        'post_type'      => 'mobile',
                        'posts_per_page' => 3,
                        'post__not_in'   => array(get_the_ID()),
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'android_category',
                                'field'    => 'id',
                                'terms'    => $term_ids,
                            ),
                        ),
                        'orderby'        => 'rand',
                    );

                    $related_query = new WP_Query($related_args);

                    if ($related_query->have_posts()) :
                ?>
                        <div class="related-products">
                            <h2>Related Mobile Phones</h2>
                            <div class="row">
                                <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="related-product">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?>
                                                <h3><?php the_title(); ?></h3>
                                            </a>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                <?php
                        wp_reset_postdata();
                    endif;
                }
                ?>
            <?php endwhile; endif; ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
