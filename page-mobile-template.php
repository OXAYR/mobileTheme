<?php
/*
Template Name: Mobile Template
*/

get_header();
?>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'      => 'mobile',
    'posts_per_page' => 3,
    'paged'          => $paged,
);

$loop = new WP_Query($args); ?>
<div class="d-flex flex-row col-md-8 ">
    <?php
if ($loop->have_posts()) :
    while ($loop->have_posts()) : $loop->the_post(); 
    
        get_template_part('content', 'archive');
        ?>
       
        <?php
    endwhile;
?>
    <div class="col-md-4">
                        <?php get_sidebar(); ?>
                    </div>
    </div>
    <div class="col-8 ">
    <?php
    echo '<div class="pagination d-flex justify-content-between mb-5 pb-5">';
    next_posts_link('Older Posts ',$loop->max_num_pages);
    previous_posts_link(' Newer Posts',$loop->max_num_pages);
    echo '</div>';
else :
    echo 'No posts found';
endif;

wp_reset_postdata();
?>
</div>

 <?php get_footer(); ?> 
